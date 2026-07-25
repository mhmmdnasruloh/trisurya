<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('fullname')->paginate(20);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'fullname' => 'required',
            'role' => 'required'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        
        User::create($data);
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'fullname' => 'required',
            'role' => 'required'
        ]);

        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Data User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['message' => 'Tidak bisa menghapus akun Anda sendiri!']);
        }

        // Cek data terkait dengan user ini
        $relatedData = [];
        
        // Cek customers yang di-create oleh user ini
        $customerCount = \DB::table('customers')->where('created_by', $user->id)->count();
        if ($customerCount > 0) {
            $relatedData[] = "$customerCount data Customer";
        }

        // Cek quotations yang di-create oleh user ini
        $quotationCount = \DB::table('quotations')->where('sales_id', $user->id)->count();
        if ($quotationCount > 0) {
            $relatedData[] = "$quotationCount data Quotation";
        }

        // Cek invoices yang terkait melalui quotation
        $invoiceCount = \DB::table('invoices')
            ->join('quotations', 'invoices.quotation_id', '=', 'quotations.id')
            ->where('quotations.sales_id', $user->id)
            ->count();
        if ($invoiceCount > 0) {
            $relatedData[] = "$invoiceCount data Invoice";
        }

        // Cek delivery notes terkait
        $dnCount = \DB::table('delivery_notes')
            ->join('invoices', 'delivery_notes.invoice_id', '=', 'invoices.id')
            ->join('quotations', 'invoices.quotation_id', '=', 'quotations.id')
            ->where('quotations.sales_id', $user->id)
            ->count();
        if ($dnCount > 0) {
            $relatedData[] = "$dnCount data Delivery Note";
        }

        // Cek cashflow yang di-create oleh user ini
        $cfCount = \DB::table('cashflow')->where('created_by', $user->id)->count();
        if ($cfCount > 0) {
            $relatedData[] = "$cfCount data Cashflow";
        }

        // Jika ada data terkait, cegah penghapusan
        if (!empty($relatedData)) {
            $message = 'Tidak bisa menghapus user ini karena masih ada data terkait: ' . implode(', ', $relatedData) . '. Hapus atau reassign data tersebut terlebih dahulu.';
            return back()->withErrors(['message' => $message]);
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'fullname' => 'required|string|max:255',
            'password' => 'nullable|min:6'
        ]);

        $data = $request->except(['password', '_token', '_method']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('profile')->with('success', 'Profil berhasil diupdate.');
    }
}
