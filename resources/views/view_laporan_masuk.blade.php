@extends('adminlte::page')

@section('title', 'Laporan Masuk')

@section('content_header')
<h1 class="text-center text-bold">LAPORAN MASUK</h1>
@stop
@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header">
     {{ __('Laporan Setting') }}

    </div>
    <div class="card-body">
        <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#modalTambahData"><i class="fa fa-plus"></i> Add Data</button>
     <a href="{{route('admin.print.masuk')}}" target="_blank" class="btn btn-secondary mb-5"><i class="fa fa-print"></i>Print to PDF</a>

     <div class="btn-group mb-5" role="group" aria-label="Basis Example">

     </div>
     <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAME</th>
                <th>DATE</th>
                <th>AMOUNT</th>
                <th>ACTION</th>

            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach($masuk as $key)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$key->name}}</td>
                <td>{{$key->tanggal}}</td>
                <td>{{$key->jumlah}}</td>
                <td>
                    <div class="btn-group" roles="group" aria-label="Basic Example">
                        <button type="button" id="btn-edit-comes" class="btn" data-toggle="modal" data-target="#modalEdit" data-id="{{ $key->id }}" data-name="{{ $key->name }}" data-tanggal="{{ $key->tanggal }}" data-jumlah="{{ $key->jumlah }}"><i class="fa fa-edit"></i></button>
                        <button type="button" id="btn-delete-comes" class="btn" data-toggle="modal" data-target="#modalDeleteData" data-id="{{ $key->id }}" data-name="{{$key->name}}"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>

<!-- Modal Tambah Data -->

<div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post" action="{{ route('admin.masuk.submit') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" placeholder="Input Name" name="name" id="name" required />
    </div>
        {{-- <label for="penerbit">Nama</label>
        <div class="input-group">
          <select class="custom-select" name="products_id" id="products_id" placeholder="Input Product" aria-label="Example select with button addon">
            <option selected>Pilih....</option>
            @php
            $data=App\Models\Lmasuk::get();
            @endphp
            @foreach($data as $key)
            <option value="{{$key->id}}">{{$key->name}}</option>
            @endforeach
          </select>

        </div> --}}
    <div class="form-group">
        <label for="tanggal">Date</label>
        <input type="text" id ="date" class="date form-control" name="tanggal" id="tanggal" required />
    </div>
    <div class="form-group">
        <label for="jumlah">Amount</label>
        <input type="text" class="form-control" placeholder="Input Amount" name="jumlah" id="jumlah" required />
    </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-primary">Add</button>
</form>
</div>
</div>
</div>
</div>
<!-- Modal Tambah Data -->

<!-- Modal Edit Data -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post" action="{{ route('admin.masuk.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="edit-name">Name</label>
                <input type="text" class="form-control" name="name" id="edit-name" required />
            </div>
            <div class="form-group">
                <label for="edit-tanggal">Date</label>
                <input type="text" class="form-control" name="tanggal" id="edit-tanggal" required />
            </div>
            <div class="form-group">
                <label for="edit-jumlah">Amount</label>
                <input type="text" class="form-control" name="jumlah" id="edit-jumlah" required />
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
<input type="hidden" name="id" id="edit-id" />

<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-success">Update</button>
</div>
</form>
</div>
</div>
</div>
</div>

<!-- Modal Edit Data -->

<!-- Modal Hapus Data -->
<div class="modal fade" id="modalDeleteData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
    <div class="modal-body">
        Are you sure delete this data???<strong class="font-bold" id="delete-nama"></strong>?
        <form method="post" action="{{ route('admin.masuk.delete') }}" enctype="multipart/form-data">
    @csrf
    @method('DELETE')
        </div>
<div class="modal-footer">
<input type="hidden" name="id" id="delete-id" value="" />
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-danger">Delete</button>
</form>
</div>
</div>
</div>
</div>
@stop
@section('footer')
    <strong>CopyRight &copy; {{date('Y')}}
    <a href="#" target="_blank">Rispianti Officiall Hoodie</a>.</strong> All Right reserved
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(function() {
        $("#date").datepicker({
            format: 'yyyy-mm-dd', // Notice the Extra space at the beginning
            autoclose: true,
            todayHighlight: true,
            // viewMode: "date",
            // minViewMode: "date"
        });
    //     $('.date').datepicker({
    //    format: 'mm-dd-yyyy'
    //     });

        $(document).on('click', '#btn-edit-comes', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let tanggal = $(this).data('tanggal');
            let jumlah = $(this).data('jumlah');
            $('#edit-name').val(name);
            $('#edit-tanggal').val(tanggal);
            $('#edit-jumlah').val(jumlah);
            $('#edit-id').val(id);

            // $.ajax({
            //     type: "get",
            //     url: baseurl + '/admin/ajaxadmin/dataCategories/' + id,
            //     dataType: 'json',
            //     success: function(res) {
            //         console.log(res);
            //     },
            // });
        });

        $(document).on('click', '#btn-delete-comes', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#delete-id').val(id);
            $('#delete-name').text(name);
        });
    });
</script>
@stop
