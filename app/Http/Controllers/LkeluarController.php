<?php

namespace App\Http\Controllers;

use App\Models\Lkeluar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use PDF;

class LkeluarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keluar = Lkeluar::all();
        return view('view_laporan_keluar', compact('user', 'keluar'));
    }

    public function tambah_closes(Request $req)
    {
        $keluar = new Lkeluar;

        $keluar->name = $req->get('name');
        $keluar->tanggal = $req->get('tanggal');
        $keluar->jumlah = $req->get('jumlah');

        $keluar->save();

        $notification = array(
            'message' => 'Data barang keluar berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.keluar')->with($notification);
    }
    //proses ajax
    public function getDataCloses($id)
    {
        $keluar = Lkeluar::find($id);

        return response()->jsonp($keluar);
    }

    public function update_closes(Request $req)
    {

        $keluar = Lkeluar::find($req->get('id'));

        $keluar->name = $req->get('name');
        $keluar->tanggal = $req->get('tanggal');
        $keluar->jumlah = $req->get('jumlah');

        $keluar->save();

        $notification = array(
            'message' => 'Data barang keluar berhasil diedit',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.keluar')->with($notification);
    }

    public function delete_closes(Request $req)
    {
        $keluar = Lkeluar::find($req->get('id'));

        $keluar->delete();

        $notification = array(
            'message' => 'Data barang keluar berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.keluar')->with($notification);
    }

    public function print_keluar()
    {
        $keluar = Lkeluar::all();

        $pdf = PDF::loadview('print_keluar', ['keluar' => $keluar]);
        return $pdf->download('data_barang_keluar.pdf');
    }
}
