<table class="table table-bordered">
    <tr>
      <th>Nama</th>
      <td>{{ $item->transaction->user->first_name }}</td>
    </tr>
    <tr>
      <th>Email</th>
      <td>{{ $item->transaction->user->email }}</td>
    </tr>
    <tr>
      <th>Nomor</th>
      <td>{{ $item->transaction->user->phone }}</td>
    </tr>
    <tr>
      <th>Alamat</th>
      <td>{{ $item->transaction->user->address }}</td>
    </tr>
    <tr>
      <th>Total Transaksi</th>
      <td> {{ 'Rp ' . number_format($item->transaction->total_price ?? 0, 0, ".", "." ) }}</td>
    </tr>
    <tr>
      <th>Status Transaksi</th>
      <td>{{ $item->transaction->status }}</td>
    </tr>
    <tr>
      <th>Pembelian Produk</th>
      <td>
        <table class="tabble table-bordered w-100">
          <tr>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Harga</th>
          </tr>
          {{-- {{ dd($item->product) }} --}}
          {{-- @foreach ($item as $item) --}}
              <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product->type }}</td>
                <td> {{ 'Rp' . number_format($item->transaction->total_price ?? 0, 0, ".", "." ) }}</td>
              </tr>
          {{-- @endforeach --}}
        </table>
      </td>
    </tr>
  </table>
<div class="row">
        <div class="col-4">
        <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-block">
            <i class="fa fa-check"></i> Set Sukses
        </a>
        </div>
        <div class="col-4">
        <a href="{{ route('transactions.status', $item->id) }}?status=FAILED" class="btn btn-danger btn-block">
            <i class="fa fa-times"></i> Set Gagal
        </a>
        </div>
        <div class="col-4">
        <a href="{{ route('transactions.status', $item->id) }}?status=PENDING" class="btn btn-warning btn-block">
            <i class="fa fa-spinner"></i> Set Pending
        </a>
        </div>
    </div>
