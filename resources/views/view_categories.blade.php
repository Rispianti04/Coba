@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
<h1 class="text-center text-bold">CATEGORIES</h1>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Categories Setting') }}

                </div>
                <div class="card-body">
                    <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#modalTambahData"><i class="fa fa-plus"></i> Add Data</button>

                    <div class="btn-group mb-5" role="group" aria-label="Basis Example">

                    </div>
                    <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>CATEGORIES</th>
                                <th>DESCRIPTION</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($kategori as $key)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$key->name}}</td>
                                <td>{{$key->description}}</td>
                                <td>
                                    <div class="btn-group" roles="group" aria-label="Basic Example">
                                        <button type="button" id="btn-edit-categories" class="btn" data-toggle="modal" data-target="#modalEdit" data-id="{{ $key->id }}" data-name="{{ $key->name }}" data-description="{{ $key->description }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" id="btn-delete-categories" class="btn" data-toggle="modal" data-target="#modalDeleteData" data-id="{{ $key->id }}" data-name="{{$key->name}}"><i class="fa fa-trash"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Input Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.kategori.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Categories Name</label>
                        <input type="text" class="form-control" placeholder="Input Categories name" name="name" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" aria-label="With textarea" placeholder="Input Desription" name="description" id="description" required></textarea>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.kategori.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="edit-name">Categories name</label>
                                <input type="text" class="form-control" name="name" id="edit-name" required />
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Description</label>
                                <textarea class="form-control" aria-label="With textarea" name="description" id="edit-description" required></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete this data <strong class="font-italic" id="delete-nama"></strong>?
                <form method="post" action="{{ route('admin.kategori.delete') }}" enctype="multipart/form-data">
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

<!-- Modal Hapus Data -->
@stop

@section('js')
<script>
    $(function() {
        $(document).on('click', '#btn-edit-categories', function() {
            let id = $(this).data('id');
            // let name = $(this).data('name');
            // let description = $(this).data('description');
            // $('#edit-name').val(name);
            // $('#edit-description').val(description);
            // $('#edit-id').val(id);

            $.ajax({
                type: "get",
                url: baseurl + '/admin/ajaxadmin/dataCategories/' + id,
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#edit-name').val(res.name);
                    $('#edit-description').val(res.description);
                    $('#edit-id').val(res.id);
                },
            });
        });

        $(document).on('click', '#btn-delete-categories', function() {
            let id = $(this).data('id');
            let nama = $(this).data('name');
            $('#delete-id').val(id);
            $('#delete-nama').text(nama);
        });
    });
</script>
@stop
