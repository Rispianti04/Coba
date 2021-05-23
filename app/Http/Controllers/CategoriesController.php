<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategori = Categories::all();
        return view('view_categories', compact('user', 'kategori'));
    }

    public function add_categories(Request $req)
    {
        $kategori = new Categories;

        $kategori->name = $req->get('name');
        $kategori->description = $req->get('description');

        $kategori->save();

        $notification = array(
            'message' => 'Data Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.kategori')->with($notification);
    }
    //proses ajax
    public function getDataCategories($id)
    {
        $kategori = Categories::find($id);

        return response()->json($kategori);
    }

    public function update_categories(Request $req)
    {

        $kategori = Categories::find($req->get('id'));

        $kategori->name = $req->get('name');
        $kategori->description = $req->get('description');

        $kategori->save();

        $notification = array(
            'message' => 'Data Successfully Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.kategori')->with($notification);
    }

    public function delete_categories(Request $req)
    {
        $kategori = Categories::find($req->get('id'));

        $kategori->delete();

        $notification = array(
            'message' => 'Data Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.kategori')->with($notification);
    }
}
