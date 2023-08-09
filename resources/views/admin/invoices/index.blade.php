<html>

<head>
	<meta charset="utf-8">
	<title>Invoice</title>
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

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 8.5in;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        header {
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header span,

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }


        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }


        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }


        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2) {
            width: 26%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }


        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }


	</style>
</head>


<body>
<header>
	<h1>Invoice</h1>
	<address>
		<p>{{ $order->user?->name }}</p>
		@if($order->is_custom_address)
			<p>{{ $order->addres }}</p>
			<p>{{ $order->phone_number }}</p>
		@else
			<p>{{ $order->user?->address }}</p>
			<p>{{ $order->user?->phone }}</p>
		@endif
	</address>

	<article>
		<table class="meta">
			<tr>
				<th><span>Invoice #</span></th>
				<td><span>{{ $order->order_number }}</span></td>
			</tr>
			<tr>
				<th><span>Tanggal</span></th>
				<td><span>{{ $order->created_at->format('d M Y H:i') }}</span></td>
			</tr>
			<tr>
				<th><span>Jasa Pengiriman</span></th>
				<td><span>{{ $order->expedisi }}</span></td>
			</tr>
			<tr>
				<th><span>Total Berat</span></th>
				<td><span>{{ $order->weight }} Gram</span></td>
			</tr>
			@if ($order->tracking_number)
				<tr>
					<th><span>Resi</span></th>
					<td><span>{{ $order->tracking_number }}</span></td>
				</tr>
			@endif
		</table>
		<table class="inventory">
			<thead>
			<tr>
				<th><span>Produk</span></th>
				<th><span>Harga</span></th>
				<th><span>Jumlah</span></th>
				<th><span>Subtotal</span></th>
			</tr>
			</thead>
			<tbody>
			@php
				$finalTotal = 0;
			@endphp
			@foreach($order->items as $item)
				@php
					$finalTotal += $item->price;
				@endphp
				<tr>
					<td><span>{{ $item->product?->name ?? "-" }}</span></td>
					<td><span> {{ "Rp " . number_format($item->product?->price??0, 0, ",", ".") }}</span>
					</td>
					<td><span>{{ $item->quantity }}</span></td>
					<td>
						<span>{{ formatToRupiah($item->price) }}</span>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<table class="balance">
			<tr>
				<th><span>Ongkos Kirim</span></th>
				<td><span>{{ formatToRupiah($order->ongkir) }}</span></td>
			</tr>
			<tr>
				<th><span>Sub Total</span></th>
				<td><span>{{ formatToRupiah($finalTotal) }}</span></td>
			</tr>
			<tr>
				<th><span>Total</span></th>
				<td><span>{{ formatToRupiah($finalTotal + $order->ongkir) }}</span></td>
			</tr>
			</tr>
		</table>
	</article>

</header>
</body>

</html>
