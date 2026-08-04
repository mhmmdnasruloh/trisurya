# Alur Aplikasi Skripsi

Dokumen ini menjelaskan alur sistem dari login sampai pengelolaan invoice, beserta tata letak file penting di proyek Laravel.

---

## 1. Ringkasan Arsitektur

Aplikasi ini dibuat dengan Laravel. Alur utama dibagi menjadi:

- Authentication / Login
- Role / Hak akses
- Quotation (penawaran)
- Invoice (tagihan)
- Payment (pembayaran)
- Cashflow (arus kas)
- Report / Export

Semua logika utama berada di folder:
- `app/Http/Controllers`
- `app/Models`
- `routes/web.php`
- `app/Http/Middleware`
- `database/migrations`
- `database/factories`
- `database/seeders`

---

## 2. Login dan Role

### 2.1 Login

File penting:
- `app/Http/Controllers/AuthController.php`
- `routes/web.php`

Alurnya:
1. User membuka `/login`.
2. `AuthController::showLoginForm()` menampilkan halaman login.
3. Form login disubmit ke `AuthController::login()`.
4. Laravel menggunakan `Auth::attempt($credentials)` untuk memeriksa `username` dan `password`.
5. Jika berhasil, session login dibuat dan user diarahkan ke `dashboard`.
6. Jika gagal, kembali ke halaman login dengan pesan error.

### 2.2 Role dan middleware

File penting:
- `app/Http/Middleware/CheckRole.php`
- `bootstrap/app.php`
- `routes/web.php`

Alurnya:
1. Semua route penting dibungkus oleh `auth` middleware.
2. Route untuk fitur tertentu juga dibungkus `role:manager,admin`.
3. `CheckRole` memeriksa `auth()->user()->role`.
4. Jika role tidak sesuai, request dibatalkan dengan `abort(403)`.
5. Ada aturan khusus: jika role adalah `owner`, maka owner juga diberi akses untuk route yang mengizinkan `manager`.

Peran `role` disimpan di tabel `users` dan digunakan di model `User`.

---

## 3. Model Users dan Hak Akses

File penting:
- `app/Models/User.php`

Fungsi penting:
- `isManager()`
- `isAdmin()`
- `isOwner()`
- `isSales()`
- `hasFullAccess()`

Artinya:
- Owner = akses paling luas
- Admin = akses penuh terhadap invoice, quotation, payment, report, dll
- Manager = akses hampir sama dengan admin dalam route `role:manager,admin`
- Sales = biasanya mengelola quotation dan pelanggan

---

## 4. Alur data utama

### 4.1 Quotation (Penawaran)

File penting:
- `app/Http/Controllers/QuotationController.php`
- `app/Models/Quotation.php`

Alur:
1. Akses halaman quotation list.
2. Buat quotation baru lewat `create()`.
3. Form quotation mengumpulkan `customer`, `sales`, `product`, dan `items`.
4. `store()` menyimpan quotation dan item detail ke tabel `quotation_items`.
5. Total penawaran dihitung dari item.
6. Stok produk dikurangi di `reduceStock()` ketika quotation dibuat.
7. Jika quotation diubah, stok lama dikembalikan dulu lalu stok baru dikurangi.
8. Quotation tidak boleh dihapus jika sudah memiliki invoice.
9. `approved_date` hanya aktif/tersimpan saat status `Approved`.
10. `closed_date` hanya aktif/tersimpan saat status `Closed`.

Catatan penting:
- Saat Delivery Order dibuat, sistem saat ini tidak melakukan pemotongan stok lagi karena stok sudah dipotong saat quotation dibuat.
- Jika pelanggan membatalkan pesanan setelah Delivery Order diterbitkan dan invoice sudah masuk cashflow, stok tidak otomatis dikembalikan di alur sekarang; perlu penanganan pembatalan/retur terpisah.
- Jika invoice dicancel atau dihapus, cashflow terkait harus dibatalkan secara manual atau logika revert cashflow perlu ditambah.

Hubungan model:
- `Quotation` belongsTo `Customer`
- `Quotation` belongsTo `User` sebagai sales
- `Quotation` hasMany `QuotationItem`
- `Quotation` hasMany `Invoice`

### 4.2 Invoice (Tagihan)

File penting:
- `app/Http/Controllers/InvoiceController.php`
- `app/Models/Invoice.php`

Alur:
1. Invoice dibuat dari quotation yang sudah berstatus `Approved` atau `Fully Invoiced`.
2. `create()` memilih quotation dan membuat nomor invoice otomatis.
3. `store()` menyimpan invoice dengan total sesuai quotation.
4. Status awal invoice diset `Belum Bayar` dan `paid_amount` diset 0.
5. Invoice bisa diedit oleh owner/admin.
6. Update invoice menghitung ulang `total` dari quotation dan mengizinkan perubahan tanggal, jatuh tempo, dan `non_vat`.
7. Invoice bisa dihapus hanya oleh owner.

Hubungan model:
- `Invoice` belongsTo `Quotation`
- `Invoice` hasMany `Payment`
- `Invoice` hasMany `Cashflow`

### 4.3 Payment (Pembayaran)

File penting:
- `app/Http/Controllers/PaymentController.php`
- `app/Models/Payment.php`

Alur:
1. Payment dibuat dari halaman invoice tertentu.
2. Hanya owner/admin/manager dapat membuat, lihat, dan hapus pembayaran.
3. `store()` menyimpan payment.
4. Setelah payment dibuat, `paid_amount` invoice ditambah.
5. Status invoice direcalculate melalui `Invoice::recalculateStatus()`:
   - `Lunas` jika jumlah dibayar >= total
   - `DP` jika ada pembayaran parsial
   - `Belum Bayar` jika belum ada pembayaran
6. Cashflow otomatis tercatat setiap ada payment.
7. Saat payment dihapus, cashflow payment juga dihapus dan status invoice di-update ulang.

### 4.4 Cashflow

File penting:
- `app/Models/Cashflow.php`

Alur:
- Cashflow dipakai untuk mencatat arus kas masuk dari pembayaran invoice.
- Setiap payment membuat entri `Cashflow` dengan `source='payment'`.
- Saat invoice dihapus, cashflow yang terhubung ke invoice juga dibersihkan.

### 4.5 Delivery Note

File penting:
- `app/Http/Controllers/DeliveryNoteController.php`
- `app/Models/DeliveryNote.php`

Alur singkat:
- Delivery note terhubung ke invoice.
- Data pengiriman dan status dicatat di tabel `delivery_notes`.
- Export laporan delivery menggunakan `ReportController`.
- Pembatalan setelah Delivery Order diterbitkan belum otomatis mengembalikan stok dalam alur saat ini.
- Jika invoice sudah tercatat di cashflow, pembatalan harus menangani pembatalan cashflow / refund secara khusus.

### 4.6 Report dan Export

File penting:
- `app/Http/Controllers/ReportController.php`

Laporan tersedia untuk:
- invoices
- quotations
- deliveries

Catatan:
- Export hanya boleh diakses oleh user dengan `hasFullAccess()`.
- Admin tidak dapat mengakses halaman laporan (`auth()->user()->role === 'admin'` diblokir).

---

## 5. Tata letak file penting

### Controller utama
- `app/Http/Controllers/AuthController.php` = login/logout
- `app/Http/Controllers/UserController.php` = manajemen user
- `app/Http/Controllers/QuotationController.php` = penawaran
- `app/Http/Controllers/InvoiceController.php` = tagihan / invoice
- `app/Http/Controllers/PaymentController.php` = pembayaran
- `app/Http/Controllers/ReportController.php` = laporan export
- `app/Http/Controllers/DeliveryNoteController.php` = surat jalan
- `app/Http/Controllers/CustomerController.php` = customer
- `app/Http/Controllers/ProductController.php` = produk

### Model utama
- `app/Models/User.php`
- `app/Models
tQuotation.php`
- `app/Models
tQuotationItem.php`
- `app/Models
tInvoice.php`
- `app/Models
tPayment.php`
- `app/Models
tCashflow.php`
- `app/Models
tDeliveryNote.php`
- `app/Models
tCustomer.php`
- `app/Models
tProduct.php`

### Route & middleware
- `routes/web.php`
- `app/Http/Middleware/CheckRole.php`
- `bootstrap/app.php`

### Database
- `database/migrations/` = struktur tabel
- `database/factories/` = pembuat data dummy
- `database/seeders/` = data awal

---

## 6. Alur logis lengkap untuk sidang

### A. Login dan akses
1. Ketika user membuka aplikasi, diarahkan ke `/login`.
2. Jika belum login, tidak bisa masuk ke `dashboard` dan route internal.
3. Setelah login, user dapat mengakses fitur sesuai `role`.
4. Semua route sensitif dijaga oleh `auth` middleware.
5. Route pembayaran, laporan, dan manajemen user ditambah `role:manager,admin`.

### B. Mengelola quotation
1. Sales membuat quotation dengan memilih customer, sales, produk.
2. Sistem membuat nomor quotation otomatis (`QUO-YYYY-XXXX`).
3. Quotation menyimpan item detail dan total harga.
4. Stok produk berkurang saat quotation dibuat.
5. Quotation bisa disunting oleh owner/admin.
6. Quotation hanya bisa dihapus jika belum ada invoice terkait.

### C. Mengelola invoice
1. Owner/admin membuat invoice dari quotation yang sudah disetujui.
2. Invoice menyimpan nomor otomatis (`INV-YYYY-XXXX`), tanggal, due date, total, dan status.
3. Status awal invoice adalah `Belum Bayar`.
4. Invoice dapat diedit oleh owner/admin.
5. Invoice dapat dihapus oleh owner.
6. Saat invoice ditampilkan, bisa dicetak dari `invoices.print`.

### D. Pembayaran
1. Owner/admin/manager memasukkan pembayaran untuk invoice.
2. Setelah pembayaran tersimpan, invoice `paid_amount` bertambah.
3. Status invoice diperbarui otomatis.
4. Sistem mencatat transaksi ke tabel `cashflow`.
5. Hapus payment akan menghapus cashflow payment dan memperbarui status invoice.

### E. Laporan dan export
1. Hanya user dengan akses penuh dapat export.
2. Export menghasilkan file Excel untuk invoice, quotation, dan delivery note.
3. Format laporan disiapkan dari query model dan diunduh menggunakan `FastExcel`.

---

## 7. Penjelasan singkat database Laravel

### Migration
- `database/migrations/` berisi skrip pembuatan/ubah tabel.
- Contoh: `create_database_tables.php` membuat tabel `users`.
- Jalankan `php artisan migrate` untuk membuat tabel.

### Factory
- `database/factories/` berisi kode untuk membuat data contoh.
- Contoh: `UserFactory.php` membuat user palsu.
- Digunakan untuk testing dan demo.

### Seeder
- `database/seeders/` berisi kode untuk mengisi data awal.
- Misal membuat user admin default.
- Jalankan `php artisan db:seed`.

---

## 8. Tips presentasi untuk sidang

1. Jelaskan dulu arsitektur Laravel: routes -> controller -> model -> view.
2. Tunjukkan alur login: `routes/web.php` -> `AuthController` -> `User`.
3. Jelaskan kontrol akses: `CheckRole` dan `role` pada route.
4. Tunjukkan alur invoice: `QuotationController` -> `InvoiceController` -> `PaymentController` -> `Cashflow`.
5. Tegaskan bahwa data inti adalah `users`, `quotations`, `invoices`, `payments`, dan `cashflow`.
6. Sebutkan bahwa migration membuat struktur, factory contoh data, dan seeder data awal.

---

## 9. Kesimpulan

- `Login` = autentikasi user.
- `Role` = kontrol hak akses.
- `Quotation` = proses penawaran dan stok produk.
- `Invoice` = proses tagihan dari quotation.
- `Payment` = proses pembayaran dan update kas.
- `Cashflow` = catatan arus kas dari pembayaran.
- `Report` = export data bisnis.

Dokumen ini cukup ringkas untuk ditampilkan dalam presentasi sidang, dan bisa dikembangkan menjadi PDF dengan mengonversi file Markdown ini.
