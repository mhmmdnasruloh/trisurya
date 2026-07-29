<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->orderBy('name');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate(20)->appends($request->except('page'));
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.form');
    }

    public function store(Request $request)
    {
        $request->validate(['code' => 'required|unique:products', 'name' => 'required', 'price' => 'numeric']);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate(['code' => 'required|unique:products,code,'.$product->id, 'name' => 'required']);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Data Product berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product berhasil dihapus.');
    }

    public function exportExcel()
    {
        $products = Product::orderBy('name')->get();
        $filename = 'laporan_produk_' . date('Ymd_His') . '.xls';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fwrite($file, "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /></head><body>");
            fwrite($file, '<table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-family:Arial,sans-serif;font-size:12px;">');
            fwrite($file, '<tr style="background:#1f4e78;color:#ffffff;font-weight:bold;"><th>Kode</th><th>Nama Produk</th><th>Deskripsi</th><th>Harga</th><th>Stok</th><th>Nilai Stok</th><th>Status Stok</th></tr>');

            foreach ($products as $product) {
                $price = number_format($product->price, 0, ',', '.');
                $stockValue = $product->price * $product->stock;
                $stockStatus = $product->stock <= 0 ? 'Habis' : ($product->stock < 5 ? 'Stok Rendah' : 'Normal');

                $description = htmlspecialchars($product->description ?? '', ENT_QUOTES, 'UTF-8');
                $name = htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8');
                $code = htmlspecialchars($product->code, ENT_QUOTES, 'UTF-8');
                $stockStatus = htmlspecialchars($stockStatus, ENT_QUOTES, 'UTF-8');

                fwrite($file, '<tr>');
                fwrite($file, "<td>{$code}</td>");
                fwrite($file, "<td>{$name}</td>");
                fwrite($file, "<td>{$description}</td>");
                fwrite($file, "<td>{$price}</td>");
                fwrite($file, "<td>{$product->stock}</td>");
                fwrite($file, "<td>" . number_format($stockValue, 0, ',', '.') . "</td>");
                fwrite($file, "<td>{$stockStatus}</td>");
                fwrite($file, '</tr>');
            }

            fwrite($file, '</table></body></html>');
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
