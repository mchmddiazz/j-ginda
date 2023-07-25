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
				<th style="width: 20%"><span>Order Number</span></th>
				<th style="width: 30%"><span>Deskripsi Transaksi</span></th>
				<th><span>Nominal Transaksi</span></th>
				<th><span>Tipe Transaksi</span></th>
				<th><span>Saldo Akhir</span></th>
				<th><span>Tanggal Transaksi</span></th>
			</tr>
			</thead>
			<tbody>
			@php
				$saldoAkhir = 0;
			@endphp
			@foreach($transactions as $key => $transaction)
				<tr>
					<td><span>{{$key+1}}</span></td>
					<td><span>{{$transaction->order?->order_number ?? "-"}}</span></td>
					<td><span>{{$transaction->description ?? "-"}}</span></td>
					<td><span>{{ formatToRupiah($transaction->amount)}}</span></td>
					<td><span>{{strtoupper($transaction->type)}}</span></td>
					<td><span>{{ formatToRupiah($transaction->saldo)}}</span></td>
					<td><span>{{$transaction->created_at}}</span></td>
				</tr>

				@php
					$saldoAkhir = $transaction->saldo;
				@endphp
			@endforeach
			<tr>
				<td><span>Total Debit</span></td>
				<td colspan="6"><spa>{{formatToRupiah($total_debit)}}</spa></td>
			</tr>
			<tr>
				<td><span>Total Credit</span></td>
				<td colspan="6"><spa>{{formatToRupiah($total_credit)}}</spa></td>
			</tr>
			<tr>
				<td><span>Saldo Akhir</span></td>
				<td colspan="6"><spa>{{formatToRupiah($saldoAkhir)}}</spa></td>
			</tr>

			</tbody>

		</table>
	</article>

</header>
</body>

</html>
