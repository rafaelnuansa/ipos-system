<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Acces;
use App\Produksi;

class ProduksiController extends Controller
{
    public function index(){
        $id_account = Auth::id();
        $check_access = Access::where('user', $id_account)->first();
        if($check_access->kelola_laporan == 1){
        	// $products = ::all()->sortBy('kode_barang');
            // $supply_system = Supply_system::first();

        	// return view('produksi.product', compact('products', 'supply_system'));
            return view('produksi.index');
        }else{
            return back();
        }
    }
}
