@extends('layouts.frontend')

@section('title')
    Profile
@endsection

@section('content')
<section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{ $user->first_name }} {{ $user->last_name }}</h5>
              <p class="text-muted mb-1">@ {{ $user->username }}</p>
              <p class="text-muted mb-4">{{ $user->address }}</p>
              <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-primary">Edit Profile</button>
              </div>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-outline-primary ms-1">Chat Admin</button>
            </div>
            </div>
          </div>

        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->first_name }} {{ $user->last_name }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->phone }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Province, City</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->province }}, {{ $user->city }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->address }}</p>
                </div>
              </div>
                <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Postcode</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->postcode }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Username</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->username }}</p>
                </div>
              </div>
              <hr>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4 mb-md-0">
            <div class="card-body">
                      <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex  align-items-center p-3 justify-content-between">
                            <i class="fa fa-shopping-cart" aria-hidden="true"><b> {{ $transaction }}</b> Total Jumlah Pembelian</i>
                            <i class="fa fa-dollar" aria-hidden="true"> Kamu sudah melakukan pembelian sebesar <b> {{ 'Rp' . number_format($total ?? 0, 0, ".", ".")  }}</b></i>
                        </li>

                      </ul>
              <div class="row mt-3 mb-3">
                  <div class="col-md-2">Photo</div>
                  <div class="col-md-3 align-items-center">Produk / Kode Pembelian</div>
                  <div class="col-md-4">Waktu Pembelian</div>
                  <div class="col-md-3">Total Pembelian</div>
              </div>
              @foreach ($transaction_detail as $item)
              {{-- <p class="mb-1" style="font-size: .77rem;">{{ $item->product->name }}</p> --}}
              <div class="row mt-2">
                <div class="col-md-2 mb-4">
                <img
                    src="{{ url($item->product->galleries->first()->photo ?? '') }}"
                   class="w-75"
                />
                </div>
                <div class="col-md-3">
                    {{$item->product->name ?? ''}} <br />
                   <strong>({{ $item->transaction->code }}) </strong>
                </div>
                <div class="col-md-4">
                    {{$item->created_at ?? ''}}
                </div>
                <div class="col-md-3">
                    {{ 'Rp' . number_format($item->transaction->total_price ?? 0, 0, ".", "." ) }}
                </div>

            </div>
              @endforeach

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
