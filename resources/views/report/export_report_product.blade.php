<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pemasukan ({{ date('d M, Y', strtotime($tgl_awal)) . ' - ' . date('d M, Y', strtotime($tgl_akhir))}})</title>
	<style type="text/css">
		html{
			font-family: "Arial", sans-serif;
			margin: 0;
			padding: 0;
		}
		.header{
			background-color: #d3eafc;
			padding: 60px 20px;
		}
		.body{
			padding: 20px 20px;
		}
		/* Text */
		.text-20{
			font-size: 20px;
		}
		.text-18{
			font-size: 18px;
		}
		.text-16{
			font-size: 16px;
		}
		.text-14{
			font-size: 14px;
		}
		.text-12{
			font-size: 12px;
		}
		.text-10{
			font-size: 10px;
		}
		.font-bold{
			font-weight: bold;
		}
		.text-left{
			text-align: left;
		}
		.text-right{
			text-align: right;
		}
		.txt-dark{
			color: #5b5b5b;
		}
		.txt-dark2{
			color: #1d1d1d;
		}
		.txt-blue{
			color: #2a4df1;
		}
		.txt-light{
			color: #acacac;
		}
		.txt-green{
			color: #19d895;
		}
		p{
			margin: 0;
		}

		.d-block{
			display: block;
		}
		.w-100{
			width: 100%;
		}
		.img-td{
			width: 60px;
		}
		.img-td img{
			width: 3rem;
		}
		.mt-2{
			margin-top: 10px;
		}
		.mb-1{
			margin-bottom: 5px;
		}
		.mb-4{
			margin-bottom: 20px;
		}
		.pt-30{
			padding-top: 30px;
		}
		.pt-15{
			padding-top: 15px;
		}
		.pt-5{
			padding-top: 5px;
		}
		.pb-5{
			padding-bottom: 5px;
		}
		table{
			border-collapse: collapse;
		}
		thead tr td{
			border-bottom: 0.5px solid #d9dbe4;
			color: #7e94f6;
			font-size: 12px;
			padding: 5px;
			text-transform: uppercase;
		}
		tbody tr td{
			padding: 7px;
		}
		.border-top-foot{
			border-top: 0.5px solid #d9dbe4;
		}
		.mr-20{
			margin-right: 20px;
		}
		ul{
			padding: 0;
		}
		ul li{
			list-style-type: none;
		}
		.w-300p{
			width: 300px;
		}
	</style>
</head>
<body>
	<div class="header">
		<table class="w-100">
			<tr>
				<td class="text-left">
					<p class="text-15 txt-blue font-bold">LAPORAN PEMASUKAN</p>
					<p class="text-12 txt-dark d-block mb-1">{{ $market->nama_toko }}</p>
					<p class="text-10 txt-dark d-block">{{ $market->alamat }}</p>
					<p class="text-10 txt-dark d-block">{{ $market->no_telp }}</p>
				</td>
			</tr>
			<tr>
				<td class="text-left txt-blue text-12 font-bold pt-30" colspan="2">Periode Laporan</td>
				<td class="text-right text-12 txt-dark pt-30">{{ \Carbon\Carbon::now()->isoFormat('DD MMM, Y') }}</td>
			</tr>
			<tr>
				<td class="text-left text-12 txt-dark2" colspan="2">{{ date('d M, Y', strtotime($tgl_awal)) . ' - ' . date('d M, Y', strtotime($tgl_akhir))}}</td>
				@php
				$nama_users = explode(' ',auth()->user()->nama);
				$nama_user = $nama_users[0];
				@endphp
				<td class="text-right text-12 txt-blue">Oleh {{ $nama_user }}</td>
			</tr>
		</table>
	</div>
	<div class="body">
		<ul>
			<table class="w-100 mb-4">
				<thead style="background: #ddd">
					<tr>
                        <th class="text-12">Nama & Kode</th>
                        <th class="text-12">Tanggal</th>
                        <th class="text-12">Quantity</th>
                        <th class="text-12">Harga</th>
                        <th class="text-12">Subtotal</th>
                        <th class="text-12">Modal</th>
                        <th class="text-12">Laba</th>
					</tr>
				</thead>
				<tbody>

                    @foreach($transactions as $product)
                    <tr>
                        <td>
                          <span class="text-10 txt-dark2 d-block">{{ $product->nama_barang }}</span>
                          <span class="text-10 txt-light d-block">{{ $product->kode_barang }}</span>
                        </td>
                        <td>
                          <span class="text-12 txt-dark">{{ date('d M, Y', strtotime($product->created_at)) }}</span>
                        </td>
                      <td><span class="text-12 txt-dark"> {{ $product->jumlah }}</span></td>
                      <td>
                        <span class="text-12">Rp. {{ number_format($product->harga,2,',','.') }}</span>
                      </td>
                      <td>
                        <span class="text-12">Rp. {{ number_format($product->total_barang,2,',','.') }}</span>
                      </td>
                      <td>
                        <span class="text-12">Rp. {{ number_format($product->modal,2,',','.') }}</span>
                      </td>
                      <td>
                        @php
                        $laba = $product->total_barang - $product->modal;
                        @endphp
                        <span class="text-12">Rp. {{ number_format($product->laba,2,',','.') }}</span>
                      </td>
                    </tr>
                    @endforeach
				</tbody>
			</table>
		</ul>
		<table class="w-100">
			<tfoot>
				<tr>
					<td class="border-top-foot"></td>
				</tr>
				<tr>
					<td class="text-14 pt-15 text-right">
						<span class="text-12 mr-5">Pemasukan : </span>
						<span class="txt-blue font-bold text-12">Rp. {{ number_format($total_barang,2,',','.') }}</span><br>
						<span class="text-12 mr-5">Total Modal : </span>
						<span class="txt-blue font-bold text-12">Rp. {{ number_format($total_modal,2,',','.') }}</span><br>
						<span class="text-12 mr-5">Total Laba : </span>
						<span class="txt-blue font-bold text-12">Rp. {{ number_format($total_laba,2,',','.') }}</span><br>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>
