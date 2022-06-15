@extends('layouts.frontend')

@section('title')
    Wiji Rak - Bukti Bayar
@endsection

@section('content')
     <!-- Shopping Cart Section Begin -->
     <section class="checkout-section spad">
        <div class="container">
            <form action="{{ route('store-bukti-bayar', ['id' => $id]) }}" class="checkout-form" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        {{--  --}}
                        <h4>Kirim Bukti Pembayaran</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="transactions_id">Nomor Invoice<span>*</span></label>
                                <input disabled type="text" name="transactions_id" id="transactions_id" value="{{ $transaction->code }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="nama_pengirim">Nama Pengirim<span>*</span></label>
                                <input type="text" name="nama_pengirim" id="nama_pengirim" value="{{old('nama_pengirim')}}"
                                    class="form-control @error('nama_pengirim') 's-invalid'@enderror">
                                @error('nama_pengirim')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="tanggal_transfer">Tanggal Transfer<span>*</span></label>
                                <input type="date" name="tanggal_transfer" id="tanggal_transfer" value="{{old('tanggal_transfer')}}"
                                    class="form-control @error('tanggal_transfer') 's-invalid'@enderror">
                                @error('tanggal_transfer')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="bank_pengirim">Bank Pengirim<span>*</span></label>
                                <input type="text" name="bank_pengirim" id="bank_pengirim" value="{{old('bank_pengirim')}}"
                                    class="form-control @error('bank_pengirim') 's-invalid'@enderror">
                                @error('bank_pengirim')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="rekening_pengirim">No Rekening Pengirim<span>*</span></label>
                                <input type="text" name="rekening_pengirim" id="rekening_pengirim" value="{{old('rekening_pengirim')}}"
                                    class="form-control @error('rekening_pengirim') 's-invalid'@enderror">
                                @error('rekening_pengirim')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="penerima">Transfer ke mana?</label>
                                {{-- select option for banks --}}
                                <select class="form-control mb-4" name="penerima" id="penerima"  class="form-control @error('penerima') 's-invalid'@enderror">
                                    <option value="">Pilih Bank</option>
                                    <option value="bri">Bank BRI</option>
                                    <option value="bni">Bank BNI</option>
                                    <option value="mandiri">Bank Mandiri</option>
                                    <option value="gopay">Gopay</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="total_transfer">Jumlah Transfer<span>*</span></label>
                                <input type="text" name="total_transfer" id="total_transfer" value="{{old('total_transfer')}}"
                                    class="form-control @error('total_transfer') 's-invalid'@enderror">
                                @error('total_transfer')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="foto">Upload Bukti Bayar<span>*</span></label>
                                <input class="form-control" name="foto" type="file" id="foto"
                                    class="form-control @error('foto') 's-invalid'@enderror">
                                @error('foto')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Detail</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Bank <span>Rekening</span></li>
                                    <li class="fw-normal">Bank Mandiri <span>90000 123 123 123</span></li>
                                    <li class="fw-normal">BCA<span>90000 321 312 321</span></li>
                                    <li class="fw-normal">BNI <span>90000 987 987 987</span></li>
                                    <li class="fw-normal">Gopay <span>085 515 123 123</span></li>
                                    <li class="total-price">TOTAL BELANJA <span>Rp 240.000.000</span></li>
                                    <li class="total-price">+ Kode Unik <span>123</span></li>
                                    <li class="total-price">TOTAL TRANSFER <span>Rp 240.000.123</span></li>
                                </ul>
                                <div class="mt-2 mb-4">
                                   <H6><strong>* HARAP TRANSFER SESUAI JUMLAH UNTUK MEMPERCEPAT PROSES VALIDASI</strong></H6>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" onclick="return confirm('Yakin untuk menigirim data?')" class="site-btn place-btn">KIRIM BUKTI BAYAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
