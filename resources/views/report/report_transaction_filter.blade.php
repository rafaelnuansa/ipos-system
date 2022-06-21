@foreach($dates as $date)
<li class="txt-light">{{ date('d M, Y', strtotime($date)) }}</li>
@php
$transactions = \App\Transaction::select('kode_transaksi')
->whereDate('transactions.created_at', $date)
->distinct()
->latest()
->get();
@endphp
<div class="table-responsive">
  <table class="table table-custom">
    <tr>
        <th>Kode Transaksi</th>
        <th>Total</th>
        <th>Bayar</th>
        <th>Kembali</th>
        <th>Modal</th>
        <th>Laba</th>
      <th></th>
    </tr>
    @foreach($transactions as $transaction)
    <tr>
      @php
      $transaksi = \App\Transaction::where('kode_transaksi', $transaction->kode_transaksi)
      ->select('transactions.*')
      ->first();
      $products = \App\Transaction::where('kode_transaksi', $transaction->kode_transaksi)
      ->select('transactions.*')
      ->get();
      $tgl_transaksi = \App\Transaction::where('kode_transaksi', '=' , $transaction->kode_transaksi)
      ->select('created_at')
      ->first();
        $modal = \App\Transaction::where('kode_transaksi', $transaction->kode_transaksi)
        ->sum('modal');
        $laba = $transaksi->total - $modal;
      @endphp

     <td class="td-1">
        <span class="d-block font-weight-bold big-font">{{ $transaction->kode_transaksi }}</span>
        @if ($transaksi->manual_transaksi)
        <span class="d-block txt-light">{{ $transaksi->manual_transaksi }}</span>
        @else
            {{-- <span class="d-block txt-light"> - </span> --}}
        @endif
        <span class="d-block txt-light">{{ date('d M, Y', strtotime($tgl_transaksi->created_at)) . ' Jam ' . date('H:i', strtotime($tgl_transaksi->created_at)) }}</span>
      </td>
      <td><span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp. {{ number_format($transaksi->total,2,',','.') }}</td>
      <td class="text-success font-weight-bold">- Rp. {{ number_format($transaksi->bayar,2,',','.') }}</td>
      <td>Rp. {{ number_format($transaksi->kembali,2,',','.') }}</td>
      <td>Rp. {{ number_format($modal,2,',','.') }}</td>
      <td>Rp. {{ number_format($laba,2,',','.') }}</td>
      <td>{{ $transaksi->manual_transaksi }}</td>
      <td>
        <button class="btn btn-selengkapnya font-weight-bold" type="button" data-target="#dropdownTransaksi{{ $transaction->kode_transaksi }}"><i class="mdi mdi-chevron-down arrow-view"></i></button>
      </td>
    </tr>
    <tr id="dropdownTransaksi{{ $transaction->kode_transaksi }}" data-status="0" class="dis-none">
      <td colspan="7" class="dropdown-content">
        <div class="d-flex justify-content-between align-items-center">
          <div class="kasir mb-3">
            Kasir : {{ $transaksi->kasir }}
          </div>
          <div class="total-barang mb-3">
            Total Barang : {{ $products->count() }}
          </div>
        </div>
        <table class="table">
          @foreach($products as $product)
          <tr>
            <td><span class="numbering">{{ $loop->iteration }}</span></td>
            <td>
              <span class="bold-td">{{ $product->nama_barang }}</span>
              <span class="light-td mt-1">{{ $product->kode_barang }}</span>
            </td>
            <td><span class="ammount-box-2 bg-secondary"><i class="mdi mdi-cube-outline"></i></span> {{ $product->jumlah }}</td>
            <td>
              <span class="light-td mb-1">Harga per 0,25</span>
              <span class="bold-td">Rp. {{ number_format($product->harga,2,',','.') }}</span>
            </td>
            <td>
              <span class="light-td mb-1">Harga Total Barang</span>
              <span class="bold-td">Rp. {{ number_format($product->total_barang,2,',','.') }}</span>
            </td>
            <td>
              <span class="light-td mb-1">Modal</span>
              <span class="bold-td">Rp. {{ number_format($product->modal,2,',','.') }}</span>
            </td>
            <td>
              <span class="light-td mb-1">Laba</span>
              <span class="bold-td">Rp. {{ number_format($product->laba,2,',','.') }}</span>
            </td>
          </tr>
          @endforeach
        </table>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endforeach
