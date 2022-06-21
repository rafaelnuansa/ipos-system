@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/report/report_transaction/style.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/css/datedropper.css') }}">
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Laporan Penjualan Produk</h4>
      <div class="print-btn-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="mdi mdi-export print-icon"></i>
            </div>
            <button class="btn btn-print" type="button" data-toggle="modal" data-target="#cetakModal">Export Laporan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row modal-group">
  <div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cetakModalLabel">Export Laporan</h5>
          <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/report/product/export') }}" name="export_form" method="POST" target="_blank">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group row">
                  <div class="col-5 border rounded-left offset-col-1">
                    <div class="form-radio">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jns_laporan" value="period" checked> Periode</label>
                    </div>
                  </div>
                  <div class="col-5 border rounded-right">
                    <div class="form-radio">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jns_laporan" value="manual"> Manual</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 period-form">
                <div class="form-group row">
                  <div class="col-10 p-0 offset-col-1">
                    <p>Pilih waktu dan periode</p>
                  </div>
                  <div class="col-4 p-0 offset-col-1">
                    <input type="number" class="form-control form-control-lg time-input number-input dis-backspace input-notzero" name="time" value="1" min="1" max="4">
                  </div>
                  <div class="col-6 p-0">
                    <select class="form-control form-control-lg period-select" name="period">
                      <option value="minggu" selected="">Minggu</option>
                      <option value="bulan">Bulan</option>
                      <option value="tahun">Tahun</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12 manual-form" hidden="">
                <div class="form-group row">
                  <div class="col-10 p-0 offset-col-1">
                    <p>Pilih tanggal awal dan akhir</p>
                  </div>
                  <div class="col-10 p-0 offset-col-1 input-group mb-2">
                    <input type="text" name="tgl_awal_export" class="form-control form-control-lg date" placeholder="Tanggal awal">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="mdi mdi-calendar calendar-icon"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-10 p-0 offset-col-1 input-group">
                    <input type="text" name="tgl_akhir_export" class="form-control form-control-lg date" placeholder="Tanggal akhir">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="mdi mdi-calendar calendar-icon"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-export">Export</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card card-noborder b-radius">
      <div class="card-body">
        <div class="row">
          <div class="col-12 mb-2">
            <form name="filter" action="{{ url('/report/product/filter') }}" method="POST">
              @csrf
              <div class="form-group row align-items-center filter-group">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 input-group">
                  <input type="text" name="tgl_awal" class="form-control form-control-lg date" placeholder="Tanggal awal">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="mdi mdi-calendar calendar-icon"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 input-group tgl-akhir-div">
                  <input type="text" name="tgl_akhir" class="form-control form-control-lg date" placeholder="Tanggal akhir">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="mdi mdi-calendar calendar-icon"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-12 col-12 filter-btn-div">
                  <button class="btn btn-filter btn-sm btn-block" type="submit">Filter</button>
                </div>
              </div>
            </form>
          </div>
        	<div class="col-12">
              <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <th>Kode Barang</th>
                        <th>Tanggal</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Modal</th>
                        <th>Laba</th>
                    </thead>

                    @php
                    @endphp

                        @foreach($transactions as $product)
                        <tr>
                            <td>
                              <span class="bold-td">{{ $product->nama_barang }}</span>
                              <span class="light-td mt-1">{{ $product->kode_barang }}</span>
                            </td>
                            <td>
                              <span class="bold-td mt-1">{{ date('d M, Y', strtotime($product->created_at)) . ' Jam ' . date('H:i', strtotime($product->created_at)) }}</span>
                            </td>
                          <td><span class="ammount-box-2 bg-secondary"><i class="mdi mdi-cube-outline"></i></span> {{ $product->jumlah }}</td>
                          <td>
                            <span class="bold-td">Rp. {{ number_format($product->harga,2,',','.') }}</span>
                          </td>
                          <td>
                            <span class="bold-td">Rp. {{ number_format($product->total_barang,2,',','.') }}</span>
                          </td>
                          <td>
                            <span class="bold-td">Rp. {{ number_format($product->modal,2,',','.') }}</span>
                          </td>
                          <td>
                            @php
                            $laba = $product->total_barang - $product->modal;
                            @endphp
                            <span class="bold-td">Rp. {{ number_format($product->laba,2,',','.') }}</span>
                          </td>
                        </tr>
                        @endforeach

                  @php
                     $semua_jumlah = 0;
                      $semua_jumlah += $jumlah;
                  @endphp

                  <tfoot class="bg-secondary">
                    <td></td>
                    <td></td>
                    <td class="font-weight-bold"><span class="ammount-box-2 bg-secondary"><i class="mdi mdi-cube-outline"></i></span> {{ $semua_jumlah }} </td>
                    <td></td>
                    <td><span class="font-weight-bold">Rp.{{ number_format($sub_total,2,',','.') }}</span></td>
                    <td><span class="font-weight-bold">Rp.{{ number_format($total_modal,2,',','.') }}</span></td>
                    <td><span class="font-weight-bold">Rp.{{ number_format($total_laba,2,',','.') }}</span></td>
                  </tfoot>
                </table>

              </div>
              <div class="pagination mt-4">
              {{ $transactions->links() }}
              </div>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/datedropper.js') }}"></script>
<script src="{{ asset('js/report/report_product/script.js') }}"></script>
<script type="text/javascript">

function changeData(chart, label_array, data_array){
  chart.data = {
      labels: label_array,
      datasets: [{
          label: '',
          data: data_array,
          backgroundColor: 'RGB(211, 234, 252)',
          borderColor: 'RGB(44, 77, 240)',
          borderWidth: 3
      }]
  }
  chart.update();
}

</script>
@endsection
