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
				<th style="width: 20%"><span>Deskripsi</span></th>
				<th style="width: 20%"><span>Stok</span></th>
				<th style="width: 20%"><span>Batas Minimal Stok</span></th>
			</tr>
			</thead>
			<tbody>
			@foreach($products as $key => $product)
				<tr>
					<td><span>{{$key+1}}</span></td>
					<td><span>{{$product->name ?? "-"}}</span></td>
					<td><span>{{$product->description ?? "-"}}</span></td>
					<td><span>{{ $product->quantity ?? 0 }}</span></td>
					<td><span>{{ $product->quantity_threshold ?? 0 }}</span></td>

				</tr>
			@endforeach
			</tbody>
		</table>
	</article>

</header>
</body>

</html>
