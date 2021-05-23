<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use PDF;

class TransaksiController extends Controller
{
    public function index(){
        $user = Auth::user();
        $trans = Transaksi::all();
        return view('view_transaksi', compact('user', 'trans'));
    }

    public function add_transaction(Request $req){
        $trans = new Transaksi;

        $trans->name=$req->get('name');
        $trans->pembeli = $req->get('pembeli');
        $trans->stok=$req->get('stok');
        $trans->harga=$req->get('harga');
        $trans->total=$req->get('total');
        $trans->categories_id=$req->get('categories_id');
        $trans->brands_id=$req->get('brands_id');

        $trans->save();

        $notification = array(
            'message' => 'Transaction Successfully',
            'alert' => 'success'
        );
        return redirect()->route('admin.transaksi')->with($notification);
    }
    public function update_transaction(Request $req){
        $trans = Transaksi::find($req->get('id'));


        $trans->name = $req->get('name');
        $trans->pembeli = $req->get('pembeli');
        $trans->stok = $req->get('stok');
        $trans->harga = $req->get('harga');
        $trans->total = $req->get('total');
        $trans->categories_id = $req->get('categories_id');
        $trans->brands_id = $req->get('brands_id');

        $trans->save();

        $notification = array(
            'message' => 'Transaction Successfully',
            'alert' => 'success'
        );
        return redirect()->route('admin.transaksi')->with($notification);
    }
    public function getDataTransaksi($id)
    {
        $trans = Transaksi::find($id);

        return response()->json($trans);
    }
    public function destroy(Request $req)
    {
        $trans = Transaksi::find($req->id);

        $trans->delete();

        $notification = array(
            'message' => 'Data Successfully Deleted',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.transaksi')->with($notification);
    }
    // public function laporan_keluar()
    // {
    //     $user = Auth::user();
    //     $trans = Transaksi::all();
    //     return view('view_laporan_keluar', compact('user', '$trans'));
    // // }
    // public function print_produk()
    // {
    //     $barang = Transaksi::all();

    //     $pdf = PDF::loadview('print_produk', ['barang'=>$barang]);
    //     return $pdf->download('data_barang_masuk.pdf');
    // }

    public function print_produk()
    {
        $barang = Transaksi::all();

        $pdf = PDF::loadview('print_produk', ['barang' => $barang]);
        return $pdf->download('data_barang_transaksi.pdf');
    }

}
