<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function ShowCategory()
    {
        if (session()->has('KATEGORI_ID') && !session()->has('BRAND')) {
            if (session()->has('BRAND')){
                session()->pull('BRAND');
            }
            $id = session('KATEGORI_ID');
            $dataProducts = DB::table('produk')
            ->select('PRODUK_ID', 'NAMA_PRODUK', 'IMAGE', 'HARGA')
            ->where('KATEGORI_ID', '=', $id)
            ->paginate(9);
            // session()->pull('KATEGORI_ID');

        } else if (session()->has('BRAND')){
            if (session()->has('KATEGORI_ID')){
                session()->pull('KATEGORI_ID');
            }
            $brand = session('BRAND');
            $dataProducts = DB::table('produk')
            ->select('PRODUK_ID', 'NAMA_PRODUK', 'IMAGE', 'HARGA')
            ->where('NAMA_PRODUK', 'like', '%' . $brand . '%')
            ->paginate(9);
            session()->pull('BRAND');
        }else{
            $dataProducts = DB::table('produk')
            ->select('PRODUK_ID', 'NAMA_PRODUK', 'IMAGE', 'HARGA')
            ->paginate(9);
        }

        $categories = $this->getCategories();
        $randomProducts = $this->getRandomProducts();
        return view("category", [
            "dataProducts" => $dataProducts,
            "dataCategories" =>  $categories,
            "dataRandomProducts" => $randomProducts
        ]);
    }

    private function getCategories(){
        $categories = collect(DB::select('select * from kategori'));
        return $categories;
    }

    public function filterCategory(Request $request){
        $id = $request->input('id');
        if (session()->has('KATEGORI_ID')){
            session()->pull('KATEGORI_ID');
        }
        $request->session()->put('KATEGORI_ID', $id);
    }

    public function clearFilter(){
        if (session()->has('KATEGORI_ID')){
            session()->pull('KATEGORI_ID');
        }
    }

    public function filterBrand(Request $request){
        $brand = $request->input('brand');
        if (session()->has('BRAND')){
            session()->pull('BRAND');
        }
        $request->session()->put('BRAND', $brand);
    }

    public static function getRandomProducts(){
        $products = collect(DB::select('select * from vRandomProducts'));
        return $products;
    }
}
