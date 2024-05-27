<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function ShowTransaction()
    {
        return view('admin-transaction-data');
    }
    public function ShowCatalog()
    {
        $products = DB::table('produk')
            ->select('produk_id', 'nama_produk', 'image', 'deskripsi', 'harga')
            ->paginate(5);

        return view('admin-catalog', ['products' => $products]);
    }
    public function AddNewProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|min:10',
            'selected_category_id'=>'required',
            'price' => 'required',
            'size' => 'required',
            'amount' => 'required',
            'image'=>'required'
        ]);

        $fileName = time().$request->file('image')->getClientOriginalName();
        $request->image->move(public_path('assets'), $fileName);

        $insert = DB::table('PRODUK')->insert([
            'nama_produk' => $validatedData['name'],
            'deskripsi' => $validatedData['description'],
            'kategori_id' => $validatedData['selected_category_id'],
            'image' => 'assets/'.$fileName,
            'harga' => $validatedData['price'],
        ]);

        $produkid = DB::select('select max(produk_id) from produk;');

        $insert = DB::table('PRODUK')->insert([
            'USERNAME' => $validatedData['username'],
            'PASSWORD' => Hash::make($validatedData['password']),
            'EMAIL' => $validatedData['email'],
            'PHONE_NUMBER' => $validatedData['phone'],
            'ADDRESS' => $validatedData['address'],
        ]);


        if ($insert) {
            return redirect('/admin/manageproduct')->with('success', 'New Product Successfuly Added!');
        } else {
            return redirect('/')->with('error', 'Error occurred during Adding Product. Please Try Again!');
        }
    }
    public function EditProduct(Request $request)
    {
        
    }

}
