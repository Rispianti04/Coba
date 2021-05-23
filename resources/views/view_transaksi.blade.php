@extends('adminlte::page')

@section('title', 'Transaction ')

@section('content_header')
<h1 class="text-center text-bold">TRANSACTION</h1>
@stop
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          {{ __('Transaction Setting') }}

        </div>
        <div class="card-body">
          <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Add Transaction</button>
          <a href="{{ route('admin.print.produk') }}"target="_blank" class="btn btn-secondary mb-5"><i class="fa fa-print"></i> Print To PDF</a></button>
          <div class="btn-group mb-5" role="group" aria-label="Basis Example">

          </div>
          <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>NAME</th>
                <th>BUYER</th>
                <th>CATEGORIES</th>
                <th>BRANDS</th>
                <th>PRICE</th>
                <th>AMOUNT</th>
                <th>TOTAL</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach($trans as $key)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$key->name}}</td>
                <td>
                  {{$key->pembeli}}
                </td>
                <td>{{$key->categories_id}}</td>
                <td>{{$key->brands_id}}</td>
                <td>{{$key->harga}}</td>
                <td>{{$key->stok}}</td>
                <td>{{$key->total}}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="btn-edit-data" class="btn" data-toggle="modal" data-target="#editData" data-id="{{ $key->id }}" data-stok="{{$key->stok}}" data-categories_id="{{$key->categories_id}}" data-brands_id="{{$key->brands_id}}"><i class="fa fa-edit"></i></button>
                    <button type="button" id="btn-delete-data" class="btn" data-toggle="modal" data-target="#deleteData" data-id="{{ $key->id }}" data-photo="{{ $key->photo }}" data-name="{{$key->name}}"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
        <form method="post" action="{{ route('admin.transaksi.submit') }}" enctype="multipart/form-data">
          @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" placeholder="Input name of product" class="form-control" name="name" id="name" required />
              </div>
              <div class="form-group col-md-6 ml-auto">
                <label for="pembeli">Buyer</label>
                <input type="text" class="form-control" placeholder="Input Name of Buyer" name="pembeli" id="pembeli" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="penerbit">Categories</label>
            <div class="input-group">
              <select class="custom-select" name="categories_id" id="categories_id" placeholder="Input Categories" aria-label="Example select with button addon">
                <option selected>Choose here....</option>
                @php
                $data=App\Models\Categories::get();
                @endphp
                @foreach($data as $key)
                <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach
              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="penerbit">Brands</label>
            <div class="input-group">
              <select class="custom-select" name="brands_id" id="brands_id" placeholder="Input Brands" aria-label="Example select with button addon">
                <option selected>Choose here....</option>
                @php
                $data=App\Models\Brands::get();
                @endphp
                @foreach($data as $key)
                <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach
              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="stok">Amount</label>
            <div class="input-group mb-3">
              <input type="number" name="stok" id="stok" min="0" placeholder="Input purchase amount" class="form-control" aria-label="Amount (to the nearest dollar)">

            </div>
          </div>
          <div class="form-group">
            <label for="harga">Price</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              @php
              $data=App\Models\Product::get();

              @endphp
              <input type="number" name="harga" id="harga" min="0" placeholder="Input Price" class="form-control" aria-label="Amount (to the nearest dollar)">

            </div>
          </div>
          <div class="form-group">
            <label for="total">TOTAL</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" name="total" id="total" min="0" placeholder="Total" class="form-control" aria-label="Amount (to the nearest dollar)">

            </div>
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
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit  Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.transaksi.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit-name">Name</label>
                <input type="text" class="form-control" name="name" id="edit-name" required />
              </div>
              <div class="form-group">
                <label for="edit-pembeli">Buyer</label>
                <input type="text" class="form-control" name="pembeli" id="edit-pembeli" required />
              </div>
              <div class="form-group">
                <label for="edit-jumlah">Amount</label>
                <input type="number" class="form-control" name="stok" id="edit-jumlah" required />
              </div>
              <div class="form-group">
                <label for="edit-harga">Price</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" name="harga" id="edit-harga" min="0" class="form-control" aria-label="Amount (to the nearest dollar)">

                </div>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit-total">Total</label>
                <input type="number" min="0" class="form-control" name="total" id="edit-total" />
              </div>
              <div class="form-group">
                <label for="edit-kategori">Categories</label>
                <div class="input-group">
                  <select class="custom-select" name="categories_id" id="edit-kategori" aria-label="Example select with button addon" required>
                    @php
                    $data=App\Models\Categories::get();
                    @endphp
                    @foreach($data as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                    @endforeach
                  </select>

                </div>
              </div>
              <div class="form-group">
                <label for="edit-merek">Brands</label>
                <div class="input-group">
                  <select class="custom-select" name="brands_id" id="edit-merek" aria-label="Example select with button addon" required>
                    @php
                    $data=App\Models\Brands::get();
                    @endphp
                    @foreach($data as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                    @endforeach
                  </select>

                </div>
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
<div class="modal fade" id="deleteData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to delete this data <strong class="font-italic" id="delete-name"></strong>?
        <form method="post" action="{{ route('admin.transaksi.delete') }}" enctype="multipart/form-data">
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
@section('js')
<script>
  $(function() {

    $(document).on('click', '#btn-delete-data', function() {
      let id = $(this).data('id');
      let name = $(this).data('name');
      $('#delete-id').val(id);
      $('#delete-name').text(name);
      console.log("hallo");
    });



    $(document).on('click', '#btn-edit-data', function() {
      let id = $(this).data('id');

      $.ajax({
        type: "get",
        url: baseurl + '/admin/ajaxadmin/dataTransaksi/' + id,
        dataType: 'json',
        success: function(res) {
          $('#edit-id').val(res.id);
          $('#edit-name').val(res.name);
          $('#edit-jumlah').val(res.stok);
          $('#edit-harga').val(res.harga);
          $('#edit-kategori').val(res.categories_id);
          $('#edit-merek').val(res.brands_id);
          $('#edit-pembeli').val(res.pembeli);
          $('#edit-total').val(res.total);


        },
      });
    });

  });
</script>
@stop
