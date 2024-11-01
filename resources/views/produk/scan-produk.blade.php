@extends('layouts.main')
@section('title', 'Produk')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Detail Produk</h4>
                    <h6>Full detail dari Produk</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bar-code-view">
                                @foreach ($produk as $itemBarcode)
                                    {!! DNS2D::getBarcodeSVG($itemBarcode->kodeproduk, 'QRCODE') !!}
                                @endforeach
                            </div>
                            <div class="productdetails">
                                <ul class="product-bar">
                                    @foreach ($produk as $item)
                                        <li>
                                            <h4>Kode Produk</h4>
                                            <h6>{{ $item->kodeproduk }} </h6>
                                        </li>
                                        <li>
                                            <h4>Nama</h4>
                                            <h6>{{ $item->nama }}</h6>
                                        </li>
                                        <li>
                                            <h4>Jenis</h4>
                                            <h6>{{ $item->jenis->jenis }}</h6>
                                        </li>
                                        <li>
                                            <h4>Berat</h4>
                                            <h6>{{ $item->berat }}</h6>
                                        </li>
                                        <li>
                                            <h4>Karat</h4>
                                            <h6>{{ $item->karat }}</h6>
                                        </li>
                                        <li>
                                            <h4>Harga</h4>
                                            <h6>{{ 'Rp. ' . number_format($item->harga_jual) }}</h6>
                                        </li>
                                        <li>
                                            <h4>Keterangan</h4>
                                            <h6>{{ $item->keterangan }}</h6>
                                        </li>
                                        <li>
                                            <h4>Status</h4>
                                            @if ($item->status == 1)
                                                <h6><span class="badge badge-bgsuccess">Ready</span></h6>
                                            @else
                                                <h6><span class="badge badge-bgdanger">Sold</span></h6>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="slider-product-details">
                                <div class="owl-carousel owl-theme product-slide">
                                    <div class="slider-product">
                                        @foreach ($produk as $itemImage)
                                            <img src="{{ asset('storage/Image/' . $itemImage->image) }}" alt="img"
                                                style="display: block; margin: auto; max-width: 100%; height: auto;">
                                            <h4>{{ $itemImage->nama }}</h4>
                                            <h6>581kb</h6>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
