@extends('adminlte::page')

@section('Official Hoodie')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header "><center>{{ __('WELCOME THIS PAGE') }}</center></div>

                <div class="card-body">
                    @if ($user->roles_id==1)
                    Your loged as admin

                    @else ($user->roles_id ==2)
                    Your loged as user
                    <!-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> -->
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>

<div class="ecommerce-gallery" data-mdb-zoom-effect="true" data-mdb-auto-height="true">
  <div class="row py-3 shadow-5">
    <div class="col-3 mt-1">
      <div class="lightbox">
        <img
          src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14a.jpg"
          alt="Gallery image 1"
          class="ecommerce-gallery-main-img active w-100"
        />
      </div>
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        alt="Gallery image 4"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg"
        alt="Gallery image 2"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg"
        alt="Gallery image 3"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        alt="Gallery image 4"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg"
        alt="Gallery image 2"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg"
        alt="Gallery image 3"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        alt="Gallery image 4"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        alt="Gallery image 4"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg"
        alt="Gallery image 3"
        class="w-100"
      />
    </div>
    <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg"
        alt="Gallery image 2"
        class="w-100"
      />
    </div>
      <div class="col-3 mt-1">
      <img
        src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        data-mdb-img="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15a.jpg"
        alt="Gallery image 4"
        class="w-100"
      />
    </div>

  </div>
</div>
  </div>
</div>

    </div>
    <div class="py-5 text-right"><a href="#" class="btn btn-dark px-5 py-3 text-uppercase">Show me more</a></div>
  </div>
</div>
@endsection
@section('footer')
    <strong>CopyRight &copy; {{date('Y')}}
    <a href="#" target="_blank">Rispianti Officiall Hoodie</a>.</strong> All Right reserved
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
