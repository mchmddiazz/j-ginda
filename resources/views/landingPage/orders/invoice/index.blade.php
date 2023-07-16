<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* reset */

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

        /* content editable */

        *[contenteditable] {
            border-radius: 0.25em;
            min-width: 1em;
            outline: 0;
        }

        *[contenteditable] {
            cursor: pointer;
        }

        *[contenteditable]:hover,
        *[contenteditable]:focus,
        td:hover *[contenteditable],
        td:focus *[contenteditable],
        img.hover {
            background: #DEF;
            box-shadow: 0 0 1em 0.5em #DEF;
        }

        span[contenteditable] {
            display: inline-block;
        }

        /* heading */

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

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

        /* header */

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

        header span,
        header img {
            display: block;
            float: right;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

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

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

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

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

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
            width: 38%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

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

        /* javascript */

        .add,
        .cut {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .add,
        .cut {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .add {
            margin: -2.5em 0 0;
        }

        .add:hover {
            background: #00ADEE;
        }

        .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .cut {
            -webkit-transition: opacity 100ms ease-in;
        }

        tr:hover .cut {
            opacity: 1;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }
        }

        @page {
            margin: 0;
        }

    </style>
</head>

<body>
    <header>
        <h1>Invoice</h1>
        <address contenteditable>
            <p>{{ $orderGet->first_name }} &nbsp; {{ $orderGet->last_name }}</p>
            @if (!empty($orderGet->address2))
            <p>{{ $orderGet->addres2 }}</p>
            @else
            <p>{{ $orderGet->address }}</p>
            @endif
            <p>{{ $orderGet->phone_number }}</p>
        </address>
        <span><img alt="" src="{{ asset('logo/logoAlfitri.png')}}" style="width:100%; height:50px;"></span>
    </header>
    <article>
        <h1>Penerima</h1>
        <table class="meta">
            <tr>
                <th><span contenteditable>Invoice #</span></th>
                <td><span contenteditable>{{ $orderGet->order_number }}</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Tanggal</span></th>
                <td><span contenteditable>{{ $orderGet->created_at->format('d M Y H:i') }}</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Jasa Pengiriman</span></th>
                <td><span contenteditable>{{ $orderGet->expedisi }}</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Total Berat</span></th>
                <td><span contenteditable>{{ $orderGet->weight }} Gram</span></td>
            </tr>
            @if (!empty($orderGet->tracking_number))
            <tr>
                <th><span contenteditable>Resi</span></th>
                <td><span contenteditable>{{ $orderGet->tracking_number }} Gram</span></td>
            </tr>
            @endif
            
        </table>
        <table class="inventory">
            <thead>
                <tr>
                    <th><span contenteditable>Produk</span></th>
                    <th><span contenteditable>Deskripsi</span></th>
                    <th><span contenteditable>Harga</span></th>
                    <th><span contenteditable>Jumlah</span></th>
                    <th><span contenteditable>Subtotal</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $item)
                <tr>
                    <td><span contenteditable>{{ $item->name_product }}</span></td>
                    <td><span contenteditable>{!!\Illuminate\Support\Str::limit(html_entity_decode($item->descriptionn),150,"...")!!}</span></td>
                    <td><span contenteditable> {{ "Rp " . number_format($item->price_products, 0, ",", ".") }}</span></td>
                    <td><span contenteditable>{{ $item->quantity_item }}</span></td>
                    <td><span>{{ "Rp " . number_format($item->price_products * $item->quantity_item, 0, ",", ".") }}</span></td>
                
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="balance">
            <tr>
                <th><span contenteditable>Ongkos Kirim</span></th>
                <td><span>{{ "Rp " . number_format($orderGet->ongkir, 2, ',', '.') }}</span></td>
            </tr>
            <tr>
                <th><span contenteditable>Total</span></th>
                <td><span>{{ "Rp " . number_format($orderGet->grand_total, 2, ',', '.') }}</span></td>
            </tr>
            </tr>
        </table>
    </article>
</body>

</html>
