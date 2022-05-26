@extends('layouts.default')

@section('title')
    Ubah Barang - Just Kidd
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Ubah Barang</strong>
            <small>{{$item->name}}</small>
        </div>
        <div class="card-body card-block">
            <form action="{{ route ('products.update', $item->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="categories_id" class="form-control-label">Kategori</label>
                    <select name="categories_id" required class="form-control
                            @error('categories_id') is-invalid @enderror">
                            <option value="{{ $item->categories_id }}">Jangan diubah</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>
                @error('categories_id') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="name" class="form-control-label"> Nama Barang</label>
                    <input type="text"
                           name="name"
                           value="{{ old ('name') ? old ('name') : $item->name }}"
                           class="form-control @error('name') is-invalid @enderror"/>
                @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="type" class="form-control-label"> Tipe Barang</label>
                    <input type="text"
                    name="type"
                    value="{{ old ('type') ? old('type') : $item->type}}"
                    class="form-control @error('type') is-invalid @enderror"/>
                </div>
                <div class="form-group">
                    <label for="tags" class="form-control-label">Tags</label>
                    <input type="text"
                           name="tags"
                           value="{{ old ('tags') ? old ('tags') : $item->tags }}"
                           class="form-control @error('tags') is-invalid @enderror"/>
                @error('tags') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="sku" class="form-control-label">SKU</label>
                    <input type="text"
                           name="sku"
                           value="{{ old ('sku') ? old ('sku') : $item->sku }}"
                           class="form-control @error('sku') is-invalid @enderror"/>
                @error('sku') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="weight" class="form-control-label"> Nama Barang</label>
                    <input type="text"
                           name="weight"
                           value="{{ old ('weight') ? old ('weight') : $item->weight }}"
                           class="form-control @error('weight') is-invalid @enderror"/>
                @error('weight') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                @error('type') <div class="text-muted">{{ $message }}</div> @enderror
                <div class="form-group">
                    <label for="description" class=" form-control-label"> Deskripsi Barang</label>
                    <textarea name="description"
                class="ckeditor form-control @error('description') is-invalid @enderror">{{old('description') ? old('description') : $item->description }}</textarea>
                @error('description') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="price" class="form-control-label"> Harga Barang</label>
                    <input type="number"
                           name="price"
                           value="{{ old ('price') ? old('price') : $item->price }}"
                           class="form-control @error('price') is-invalid @enderror"/>
                    @error('price') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="quantity" class="form-control-label"> Jumlah Barang</label>
                    <input type="number"
                           name="quantity"
                           value="{{ old ('quantity') ? old('quantity') : $item->quantity }}"
                           class="form-control @error('quantity') is-invalid @enderror"/>
                    @error('quantity') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Ubah Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
