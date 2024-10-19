<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Unggul Kencana | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon.png">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/animate.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/feather.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/owlcarousel/owl.carousel.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toatr.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
</head>

<body>

    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>Order Detail</h4>
                    <h6>{{ $kodeproduk }}</h6>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-sales-split">
                    <h2>Detail Transaction : {{ $kodeproduk }}</h2>
                    {{-- <ul>
                        <li>
                            <a href="/print-order-transaction/{{ $transaksi->transaksi_id }}" target="__blank"><i
                                    data-feather="printer" class="feather-rotate-ccw" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Print Nota"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i data-feather="download" class="feather-rotate-ccw"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Print Nota"></i></a>
                        </li>
                    </ul> --}}
                </div>
                {{-- <div class="invoice-box table-height"
                    style="max-width: 1600px;width:100%;overflow: auto;margin:15px auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
                        <tbody>
                            <tr class="top">
                                <td colspan="6" style="padding: 5px;vertical-align: top;">
                                    <table style="width: 100%;line-height: inherit;text-align: left;">
                                        <tbody>

                                            <tr>
                                                <td
                                                    style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;">
                                                        <font
                                                            style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                            Pelanggan</font>
                                                    </font><br>
                                                    <font style="vertical-align: inherit;">
                                                        <font
                                                            style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                            {{ $transaksi->pelanggan->nama }}</font>
                                                    </font><br>
                                                    <font style="vertical-align: inherit;">
                                                        <font
                                                            style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                            {{ $transaksi->pelanggan->kontak }}</font>
                                                    </font><br>
                                                    <font style="vertical-align: inherit;">
                                                        <font
                                                            style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                            {{ $transaksi->pelanggan->alamat }}</font>
                                                    </font><br>
                                                </td>
                                                <td
                                                    style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;">
                                                        <font
                                                            style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                            Invoice</font>
                                                    </font><br>
                                                    <font style="vertical-align: inherit;">
                                                        <font
                                                            style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                            Payment Status</font>
                                                    </font><br>
                                                    <font style="vertical-align: inherit;">
                                                        <font
                                                            style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                            Sales</font>
                                                    </font><br>
                                                </td>
                                                <td
                                                    style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;">
                                                        <font
                                                            style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                            &nbsp;</font>
                                                    </font><br>
                                                    <font style="vertical-align: inherit;">
                                                        @if ($transaksi->status == 1)
                                                            <font
                                                                style="vertical-align: inherit;font-size: 14px;color:#ff0000;font-weight: 400;">
                                                                <span class="badge bg-danger">UN PAID</span>
                                                            </font>
                                                        @else
                                                            <font
                                                                style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">
                                                                <span class="badge bg-success">PAID</span>
                                                            </font>
                                                        @endif
                                                    </font><br>
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000000;font-weight: 400;">
                                                        <strong>{{ $transaksi->users->pegawai->nama }}</strong>
                                                    </font>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr class="heading " style="background: #F3F2F7;">
                                <td
                                    style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                    Product Name
                                </td>
                                <td
                                    style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                    Weight
                                </td>
                                <td
                                    style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                    Carat
                                </td>
                                <td
                                    style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                    Price
                                </td>
                                <td
                                    style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                    Subtotal
                                </td>
                                <td
                                    style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                    Print Surat Product
                                </td>
                            </tr>
                            @foreach ($keranjang as $item)
                                <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                                    <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                                        <img src="{{ asset('storage/Image/' . $item->produk->image) }}" alt="img"
                                            class="me-2" style="width:40px;height:40px;">
                                        {{ $item->produk->nama }}
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                        {{ $item->produk->berat }} grams
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                        {{ $item->produk->karat }}
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                        {{ 'Rp.' . ' ' . number_format($item->produk->harga_jual) }}
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                        {{ 'Rp.' . ' ' . number_format($item->total) }}
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"
                                            data-feather="printer"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li class="total">
                                        <h4>Sub Total</h4>
                                        <h5 class="text-danger">{{ 'Rp.' . ' ' . number_format($subtotal) }}</h5>
                                    </li>
                                    <li class="total">
                                        <h4>Discount</h4>
                                        <h5>{{ $transaksi->diskon }} %</h5>
                                    </li>
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5 class="text-success">{{ 'Rp.' . ' ' . number_format($transaksi->total) }}
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/jquery-3.7.1.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/feather.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/jquery.slimscroll.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/owlcarousel/owl.carousel.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/plugins/toastr/toastr.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/select2/js/select2.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/js/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/apexchart/apexcharts.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/plugins/apexchart/chart-data.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/sweetalert/sweetalert2.all.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/plugins/sweetalert/sweetalerts.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets') }}/plugins/fileupload/fileupload.min.js"></script>

    <script src="{{ asset('assets') }}/js/theme-script.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/script.js" type="text/javascript"></script>
</body>
