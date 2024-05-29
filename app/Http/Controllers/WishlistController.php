<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function ShowWishlist()
    {
        session()->pull('KATEGORI_ID'); // PENTING !! BUAT HAPUS KATEGORI SUPAYA G NGEBUG
        session()->pull('BRAND');// PENTING !! BUAT HAPUS BRAND SUPAYA G NGEBUG
        session()->pull('MINPRICE');
        session()->pull('MAXPRICE');
        
        $userID = HomeController::getUserID();
        $dataWishlist = $this->getWishlist($userID);
        return view("Wishlist", [
            "dataWishlist" => $dataWishlist
        ]);
    }

    private function getWishlist(int $id)
    {
        $dataCart = collect(DB::select('CALL pGetWishlist(?)', [$id]));
        return $dataCart;
    }

    public function deleteWishlist(Request $request)
    {
        $id = $request->input('id');

        $delete = DB::table('DETAIL_WISHLIST')
            ->where('PRODUK_ID', $id)
            ->delete();

        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Successfully updated.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Update failed']);
        }

    }
}
