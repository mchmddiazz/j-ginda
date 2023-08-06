<html>

<head>
	<meta charset="utf-8">
	<title>Laporan Keuangan</title>
	<style>
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        body{
	        padding-top: 2rem;
        }

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }


        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        .transaksi {
            padding: 3rem;
        }
	</style>
</head>


<body>
<header>
	<h1 style="padding-top: 5rem">Laporan Keuangan</h1>
	<address>

	</address>

	<article>
		<table class="transaksi">
			<thead>
			<tr>
				<th><span>Nomor</span></th>
				<th style="width: 20%"><span>Nama</span></th>
				<th style="width: 20%"><span>Order Number</span></th>
				<th><span>Total</span></th>
				<th><span>Jumlah Barang</span></th>
				<th><span>Ongkir</span></th>
				<th><span>Ekspedisi</span></th>
				<th><span>Berat Barang</span></th>

			</tr>
			</thead>
			<tbody>
			@php
				$totalPenjualan = 0;
			@endphp
			@foreach($orders as $key => $order)
				<tr>
					<td><span>{{$key+1}}</span></td>
					<td><span>{{ ucwords($order->user?->name ?? "-")}}</span></td>
					<td><span>{{$order->order_number ?? "-"}}</span></td>
					<td><span>{{ formatToRupiah($order->grand_total ?? 0) }}</span></td>
					<td><span>{{$order->item_count ?? 0}}</span></td>
					<td><span>{{ formatToRupiah($order->ongkir ?? 0) }}</span></td>
					<td><span>{{$order->expedisi ?? "-"}}</span></td>
					<td><span>{{ ($order->weight ?? 0) . " grams"}}</span></td>
				</tr>
				@php
					$totalPenjualan += $order->grand_total ?? 0;
				@endphp
			@endforeach
			<tr>
				<td><span>Total Debit</span></td>
				<td colspan="7"><spa>{{formatToRupiah($totalPenjualan)}}</spa></td>
			</tr>
			</tbody>
		</table>
	</article>

</header>
</body>

</html>
