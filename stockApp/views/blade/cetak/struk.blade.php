<style>
    #printArea {
        display: none;
    }

    @media print {
        #noPrintArea {
            display: none;
        }
        #printArea {
           display: block;
        }

        body {
            font-family: "Calibri", "Tahoma", "Candara", serif;
            color: #000;
        }

        @page { size: 2.36in 11.69in;  margin: 0mm; }

        .side {
            margin: 0mm;
            padding: 10mm;
            width: 82mm;
            height: 125.5mm;
            float: left;
            font-size: 10px;
        }

        .side.label-pengiriman {
            font-size: 12px;
            border-right: 1mm dotted #000;
        }

        .side.botl {
            border-top: 1mm dotted #000;
            border-right: 1mm dotted #000;
        }
        .side.botr {
            border-top: 1mm dotted #000;
        }

        .side img {
            width: 205px;
            height: 41px;
        }

        .pagebreak { page-break-before: always; }

        .product-list {
            display: flex;
            font-size: 12px;
        }

        .product-list .product-name {
            width: 60%;
        }

        .product-list .product-qty {
            width: 10%;
        }

        .product-list .product-price {
            width: 40%;
        }

        .product-list.detail {
            margin-left: 5mm;
        }

        .side.invoice .label-pengiriman {
            font-size: 11px;
        }
    }
    </style>
    <div id="noPrintArea">
        <div class="example-print">Mutiara Kafe</div>
    </div>

    <div id="printArea">
        <body>
            <div class="side invoice">
                <b>Mutiara Kafe</b><br>
                Jl. Puri Kembangan, Kedoya Selatan<br>
                Jakarta Barat
                <hr>
                Tanggal Bayar: <b>{{ $orders->pay_at }}</b><br>
                Nama Pelanggan: <b>{{ $orders->customer_name }}</b><br>
                Nama Waiters: <b>{{ $orders->waiters }}</b><br>
                Kode Meja: <b>{{ $orders->table_code }}</b><br>
                <hr>

                @foreach ($orders_cart as $key_cart => $value_cart)
                <div class="product-list detail">
                    <div class="product-name">{{ $value_cart->product_name }}</div>
                    <div class="product-qty">
                        @if(!empty($value_cart->product_id))
                        {{ $value_cart->qty.' x' }}
                        @endif
                    </div>
                    <div class="product-price">{{ rupiah($value_cart->unit_price) }}</div>
                </div>
                <div class="product-list detail">
                        <div class="product-name" style="text-align: right;">Sub Total</div>
                        <div class="product-qty">&nbsp;</div>
                        <div class="product-price" style="border-bottom: 1px dotted #000;">{{ rupiah($value_cart->price) }}</div>
                    </div>
                @endforeach
                <hr>
                <div class="product-list detail">
                    <div class="product-name">Total Belanja</div>
                    <div class="product-qty"></div>
                    <div class="product-price">{{ rupiah($orders->total_price) }}</div>
                </div>
                <div class="product-list detail">
                    <div class="product-name">Bayar</div>
                    <div class="product-qty"></div>
                    <div class="product-price">{{ rupiah($orders->pay) }}</div>
                </div>
                <div class="product-list detail">
                        <div class="product-name">Kembalian</div>
                        <div class="product-qty"></div>
                        <div class="product-price">{{ rupiah($orders->refund) }}</div>
                    </div>
                <hr>
                <p style="text-align: center;">
                    <b><i>terimakasih atas kunjungan anda</i></b>
                </p>
            </div>
            <div class="pagebreak"></div>
        </body>
    </div>

    <script type="text/javascript">
        var callback = function(){
          window.print();
        };

        if (
            document.readyState === "complete" ||
            (document.readyState !== "loading" && !document.documentElement.doScroll)
        ) {
          callback();
        } else {
          document.addEventListener("DOMContentLoaded", callback);
        }
    </script>
