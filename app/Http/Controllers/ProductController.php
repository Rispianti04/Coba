<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use PDF;

use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $barang = Product::all();
        return view('view_product', compact('user', 'barang'));
    }


    public function add_product(Request $req)
    {
        $barang = new Product;

        $barang->name = $req->get('name');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');
        $barang->harga = $req->get('harga');
        $barang->stok = $req->get('stok');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_barang_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_barang',
                $filename
            );

            $barang->photo = $filename;



        }
        $barang->save();
        $notification = array(
            'message' => 'Data Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product')->with($notification);
    }

    public function edit_product(Request $req){
        // dd($req->all());
        $barang = Product::find($req->get('id'));

        $barang->name = $req->get('name');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');
        $barang->harga = $req->get('harga');
        $barang->stok = $req->get('stok');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_barang_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_barang',
                $filename
            );

            Storage::delete('public/photo_barang/' . $req->get('old_photo'));

            $barang->photo = $filename;
        }

        $barang->save();

        $notification = array(
            'message' => 'Data Successfully Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product')->with($notification);
    }
    public function getDataProduct($id)
    {
        $barang = Product::find($id);

        return response()->json($barang);
    }

    public function destroy(Request $req){
        $barang = Product::find($req->id);

        Storage::delete('public/photo_barang/' . $req->get('old_photo'));
        $barang->delete();

        $notification = array(
            'message' => 'Data Successfully Deleted',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product')->with($notification);
    }

    // public function laporan_masuk()
    // {
    //     $user = Auth::user();
    //     $barang = Product::all();
    //     return view('view_laporan_masuk', compact('user', 'barang'));
    // }

    public function print_produk(){
        $barang = Product::all();

        $pdf = PDF ::loadview('print_produk', ['barang'=>$barang]);
        return $pdf->download('data_barang_masuk.pdf');
    }
}
