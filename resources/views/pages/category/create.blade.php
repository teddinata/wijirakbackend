@extends('layouts.default')

@section('title')
    Tambah Kategori - Wiji Rak
@endsection

@section('content')
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
    <div class="card">
        <div class="card-header">
            <strong>Tambah Kategori</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route ('category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">Kategori</label>
                    <input type="text"
                    name="name"
                    value="{{ old ('name') }}"
                    class="form-control @error('name') is-invalid @enderror"/>
                @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image" class="form-control-label">Ikon Kategori</label>
                    <input type="file"
                           name="image"
                           required
                           class="form-control
                           @error('image') is-invalid @enderror"/>
                    @error('image') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Tambah Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
