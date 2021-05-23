<?php

namespace App\Http\Controllers;

use App\Models\Lmasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use PDF;

class LmasukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $masuk = Lmasuk::all();
        return view('view_laporan_masuk', compact('user', 'masuk'));
    }

    public function tambah_comes(Request $req)
    {
        $masuk = new Lmasuk;

        $masuk->name = $req->get('name');
        $masuk->tanggal = $req->get('tanggal');
        $masuk->jumlah = $req->get('jumlah');

        $masuk->save();

        $notification = array(
            'message' => 'Data barang masuk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.masuk')->with($notification);
    }
    //proses ajax
    public function getDataComes($id)
    {
        $masuk = Lmasuk::find($id);

        return response()->jsonp($masuk);
    }

    public function update_comes(Request $req)
    {

        $masuk = Lmasuk::find($req->get('id'));

        $masuk->name = $req->get('name');
        $masuk->tanggal = $req->get('tanggal');
        $masuk->jumlah = $req->get('jumlah');

        $masuk->save();

        $notification = array(
            'message' => 'Data barang masuk berhasil diedit',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.masuk')->with($notification);
    }

    public function delete_comes(Request $req)
    {
        $masuk = Lmasuk::find($req->get('id'));

        $masuk->delete();

        $notification = array(
            'message' => 'Data barang masuk berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.masuk')->with($notification);
    }

    public function print_masuk()
    {
        $masuk = Lmasuk::all();

        $pdf = PDF::loadview('print_masuk', ['masuk' => $masuk]);
        return $pdf->download('data_barang_masuk.pdf');
    }
}
