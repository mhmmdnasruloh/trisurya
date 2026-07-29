<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query()->orderBy('name');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $customers = $query->paginate(20)->appends($request->except('page'));
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.form');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.form', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate(['name' => 'required']);
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Data Customer berhasil diupdate.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->quotations()->exists()) {
            return back()->with('error', 'Customer tidak dapat dihapus karena memiliki quotation terkait. Hapus atau pindahkan quotation terlebih dahulu.');
        }

        $customer->delete();
        return back()->with('success', 'Customer berhasil dihapus.');
    }
}
