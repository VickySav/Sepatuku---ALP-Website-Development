<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function ShowCart()
    {
        session()->pull('KATEGORI_ID'); // PENTING !! BUAT HAPUS KATEGORI SUPAYA G NGEBUG
        $userID = HomeController::getUserID();
        $dataCart = $this->getCart($userID);
        return view("Cart", [
            "dataCart" => $dataCart
        ]);
    }

    private function getCart(int $id)
    {
        $dataCart = collect(DB::select('CALL pGetCart(?)', [$id]));
        return $dataCart;
    }

    public function updateCart(Request $request)
    {
    $id = $request->input('id');
    $size = $request->input('size');
    $cartValue = $request->input('cart');

    // Update the Cart column in the database

        DB::table('DETAIL_CART')
        ->where('PRODUK_ID', $id)
        ->where('UKURAN', $size)
        ->update(['JUMLAH' => $cartValue]);

        return response()->json(['success' => true]);
    }


    public function deleteCart(Request $request)
    {
        $id = $request->input('id');
        $size = $request->input('size');

        $update = DB::table('DETAIL_CART')
            ->where('PRODUK_ID', $id)
            ->where('UKURAN', $size)
            ->update(['JUMLAH' => 0]);

        if ($update) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Update failed']);
        }

    }

    public function addCart(Request $request)
    {
    $userID = HomeController::getUserID();
    $cartID = DB::table('CART')
    ->select('CART_ID')
    ->where('ACCOUNT_ID', '=', $userID)
    ->first();

    $productID = $request->input('id');
    $ukuran = $request->input('size');
    $jumlah = $request->input('qty'); // 3
    $stockAvailable = DB::table('DETAIL_PRODUK')
    ->select('JUMLAH')
    ->where('PRODUK_ID', '=', $productID)
    ->where('UKURAN','=', $ukuran)
    ->get(); // 3

    if ($cartID) {
        $ID = $cartID->CART_ID; // Access the wishlist ID property
        $checkDuplicate = DB::table('DETAIL_CART')
                        ->select('JUMLAH')
                        ->where('CART_ID','=', $ID)
                        ->where('PRODUK_ID', '=', $productID)
                        ->where('UKURAN', '=', $ukuran)
                        ->first(); //1

        if ($checkDuplicate !== null && $checkDuplicate->JUMLAH >= 0) {
            // Extract numerical value from $stockAvailable
            $stockAvailableValue = $stockAvailable->first()->JUMLAH;
            $stockValidate = $stockAvailableValue - $checkDuplicate->JUMLAH; //2
        } else {
            $stockValidate = 0;
        }

        if ($checkDuplicate !== null  && $jumlah>$stockValidate)  {
            return response()->json(['success' => true, 'message' => 'You have reached the maximum']);
        }
        else if($checkDuplicate !== null && $jumlah<=$stockValidate) {
            $totalCart =  $checkDuplicate->JUMLAH + $jumlah;
                $update =  DB::table('DETAIL_CART')
                            ->where('PRODUK_ID', $productID)
                            ->where('UKURAN', $ukuran)
                            ->update(['JUMLAH' =>  $totalCart]);
                if ($update) {
                    return response()->json(['success' => true, 'message' => 'Item added to cart successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Please choose the shoes size first']);
                }
        }
        else
        {
            $insert =  DB::table('DETAIL_CART')
                        ->insert([
                            'CART_ID' => $ID,
                            'PRODUK_ID' => $productID,
                            'UKURAN' => $ukuran,
                            'JUMLAH'=> $jumlah
                        ]);
                if ($insert) {
                    return response()->json(['success' => true, 'message' => 'Item added to cart successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Please choose the shoes size first']);
                }
        }

        // if (blank($checkDuplicate))  {
        //     $insert =  DB::table('DETAIL_CART')
        //                 ->insert([
        //                     'CART_ID' => $ID,
        //                     'PRODUK_ID' => $productID,
        //                     'UKURAN' => $ukuran,
        //                     'JUMLAH'=> $jumlah
        //                 ]);
        //         if ($insert) {
        //             return response()->json(['success' => true, 'message' => 'Item added to cart successfully']);
        //         } else {
        //             return response()->json(['success' => false, 'message' => 'Insert failed']);
        //         }
        // }
        // else if($jumlah>$stockValidate) {
        //     return response()->json(['success' => true, 'message' => 'You have reached the maximum']);
        // } else {
        //     $totalCart =  $checkDuplicate->JUMLAH + $jumlah;
        //     $update =  DB::table('DETAIL_CART')
        //                 ->where('PRODUK_ID', $productID)
        //                 ->where('UKURAN', $ukuran)
        //                 ->update(['JUMLAH' =>  $totalCart]);
        //     if ($update) {
        //         return response()->json(['success' => true, 'message' => 'Updated from cart']);
        //     } else {
        //         return response()->json(['success' => false, 'message' => 'Delete failed']);
        //     }
        // }


    }

    }
    // public function deleteCart($produkID,$size)
    // {
    //     dd ($produkID);
    //     DB::table('DETAIL_CART')
    //     ->where('PRODUK_ID', $produkID)
    //     ->where('UKURAN', $size)
    //     ->update(['JUMLAH' => 0]);

    //     session()->flash('success','Item has been removed');

    // }

    }
