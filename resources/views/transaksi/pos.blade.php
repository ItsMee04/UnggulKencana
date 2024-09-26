@extends('layouts.main')
@section('title', 'POS')
@section('content')
    <div class="page-wrapper pos-pg-wrapper">
        <div class="content pos-design p-0">
            <div class="row align-items-start pos-wrapper">
                <div class="col-md-12 col-lg-8">
                    <div class="pos-categories tabs_wrapper">
                        <h5>Jenis Perhiasan</h5>
                        <p>Pilih Dari Jenis Di Bawah Ini</p>
                        <ul class="tabs owl-carousel pos-category">
                            <li id="all">
                                <a href="javascript:void(0);">
                                    <img src="assets/img/categories/category-01.png" alt="Categories">
                                </a>
                                <h6><a href="javascript:void(0);">All Categories</a></h6>
                                <span>80 Items</span>
                            </li>
                            @foreach ($jenis as $item)
                                <li id="{{ $item->id }}">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('storage/Icon/' . $item->icon) }}" alt="Categories">
                                    </a>
                                    <h6><a href="javascript:void(0);">{{ $item->jenis }}</a></h6>
                                    <span>{{ $produk->where('jenis_id', $item->id)->count() }} Item</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="pos-products">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-3">Produk</h5>
                            </div>
                            <div class="tabs_container">
                                <div class="tab_content active" data-tab="all">
                                    <div class="row">
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-01.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">IPhone 14
                                                        64GB</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>30 Pcs</span>
                                                    <p>$15800</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-02.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Computer</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">MacBook
                                                        Pro</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>140 Pcs</span>
                                                    <p>$1000</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-03.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Rolex
                                                        Tribute V3</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>220 Pcs</span>
                                                    <p>$6800</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-04.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Red Nike
                                                        Angelo</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>78 Pcs</span>
                                                    <p>$7800</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-05.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Airpod
                                                        2</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>47 Pcs</span>
                                                    <p>$5478</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-06.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Blue White
                                                        OGR</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>54 Pcs</span>
                                                    <p>$987</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-07.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">IdeaPad
                                                        Slim 5 Gen 7</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>74 Pcs</span>
                                                    <p>$1454</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-08.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">SWAGME</a>
                                                </h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>14 Pcs</span>
                                                    <p>$6587</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-09.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Timex Black
                                                        SIlver</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>24 Pcs</span>
                                                    <p>$1457</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-10.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Computer</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Tablet 1.02
                                                        inch</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>14 Pcs</span>
                                                    <p>$4744</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-11.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                </h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Fossil Pair
                                                        Of 3 in 1 </a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>40 Pcs</span>
                                                    <p>$789</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                            <div class="product-info default-cover card">
                                                <a href="javascript:void(0);" class="img-bg">
                                                    <img src="assets/img/products/pos-product-18.png" alt="Products">
                                                    <span><i data-feather="check" class="feather-16"></i></span>
                                                </a>
                                                <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                <h6 class="product-name"><a href="javascript:void(0);">Green Nike
                                                        Fe</a></h6>
                                                <div class="d-flex align-items-center justify-content-between price">
                                                    <span>78 Pcs</span>
                                                    <p>$7847</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($jenisProduk as $itemJenis)
                                    <div class="tab_content" data-tab="{{ $itemJenis->jenis_id }}">
                                        <div class="row">
                                            @foreach ($produk as $item)
                                                <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                                                    <div class="product-info default-cover card">
                                                        <a href="javascript:void(0);" class="img-bg">
                                                            <img src="{{ asset('storage/Image/' . $item->image) }}"
                                                                alt="Products">
                                                        </a>
                                                        <h6 class="cat-name"><a
                                                                href="javascript:void(0);">{{ $item->nama }}</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Airpod
                                                                2</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <span>47 Pcs</span>
                                                            <p>$5478</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 ps-0">
                    <aside class="product-order-list">
                        <div class="head d-flex align-items-center justify-content-between w-100">
                            <div class>
                                <h5>Order List</h5>
                                <span>Transaction ID : #65565</span>
                            </div>
                            <div class>
                                <a class="confirm-text" href="javascript:void(0);"><i data-feather="trash-2"
                                        class="feather-16 text-danger"></i></a>
                                <a href="javascript:void(0);" class="text-default"><i data-feather="more-vertical"
                                        class="feather-16"></i></a>
                            </div>
                        </div>
                        <div class="customer-info block-section">
                            <h6>Customer Information</h6>
                            <div class="input-block d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <select class="select">
                                        <option>Walk in Customer</option>
                                        <option>John</option>
                                        <option>Smith</option>
                                        <option>Ana</option>
                                        <option>Elza</option>
                                    </select>
                                </div>
                                <a href="#" class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#create"><i data-feather="user-plus" class="feather-16"></i></a>
                            </div>
                            <div class="input-block">
                                <select class="select">
                                    <option>Search Products</option>
                                    <option>IPhone 14 64GB</option>
                                    <option>MacBook Pro</option>
                                    <option>Rolex Tribute V3</option>
                                    <option>Red Nike Angelo</option>
                                    <option>Airpod 2</option>
                                    <option>Oldest</option>
                                </select>
                            </div>
                        </div>
                        <div class="product-added block-section">
                            <div class="head-text d-flex align-items-center justify-content-between">
                                <h6 class="d-flex align-items-center mb-0">Product Added<span class="count">2</span></h6>
                                <a href="javascript:void(0);" class="d-flex align-items-center text-danger"><span
                                        class="me-1"><i data-feather="x" class="feather-16"></i></span>Clear all</a>
                            </div>
                            <div class="product-wrap">
                                <div class="product-list d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                        data-bs-target="#products">
                                        <a href="javascript:void(0);" class="img-bg">
                                            <img src="assets/img/products/pos-product-16.png" alt="Products">
                                        </a>
                                        <div class="info">
                                            <span>PT0005</span>
                                            <h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
                                            <p>$2000</p>
                                        </div>
                                    </div>
                                    <div class="qty-item text-center">
                                        <a href="javascript:void(0);"
                                            class="dec d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                data-feather="minus-circle" class="feather-14"></i></a>
                                        <input type="text" class="form-control text-center" name="qty"
                                            value="4">
                                        <a href="javascript:void(0);"
                                            class="inc d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                data-feather="plus-circle" class="feather-14"></i></a>
                                    </div>
                                    <div class="d-flex align-items-center action">
                                        <a class="btn-icon edit-icon me-2" href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit-product">
                                            <i data-feather="edit" class="feather-14"></i>
                                        </a>
                                        <a class="btn-icon delete-icon confirm-text" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-14"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-list d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                        data-bs-target="#products">
                                        <a href="javascript:void(0);" class="img-bg">
                                            <img src="assets/img/products/pos-product-17.png" alt="Products">
                                        </a>
                                        <div class="info">
                                            <span>PT0235</span>
                                            <h6><a href="javascript:void(0);">Iphone 14</a></h6>
                                            <p>$3000</p>
                                        </div>
                                    </div>
                                    <div class="qty-item text-center">
                                        <a href="javascript:void(0);"
                                            class="dec d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                data-feather="minus-circle" class="feather-14"></i></a>
                                        <input type="text" class="form-control text-center" name="qty"
                                            value="3">
                                        <a href="javascript:void(0);"
                                            class="inc d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                data-feather="plus-circle" class="feather-14"></i></a>
                                    </div>
                                    <div class="d-flex align-items-center action">
                                        <a class="btn-icon edit-icon me-2" href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit-product">
                                            <i data-feather="edit" class="feather-14"></i>
                                        </a>
                                        <a class="btn-icon delete-icon confirm-text" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-14"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-list d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                        data-bs-target="#products">
                                        <a href="javascript:void(0);" class="img-bg">
                                            <img src="assets/img/products/pos-product-16.png" alt="Products">
                                        </a>
                                        <div class="info">
                                            <span>PT0005</span>
                                            <h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
                                            <p>$2000</p>
                                        </div>
                                    </div>
                                    <div class="qty-item text-center">
                                        <a href="javascript:void(0);"
                                            class="dec d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                data-feather="minus-circle" class="feather-14"></i></a>
                                        <input type="text" class="form-control text-center" name="qty"
                                            value="1">
                                        <a href="javascript:void(0);"
                                            class="inc d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                data-feather="plus-circle" class="feather-14"></i></a>
                                    </div>
                                    <div class="d-flex align-items-center action">
                                        <a class="btn-icon edit-icon me-2" href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit-product">
                                            <i data-feather="edit" class="feather-14"></i>
                                        </a>
                                        <a class="btn-icon delete-icon confirm-text" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-14"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-list d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                        data-bs-target="#products">
                                        <a href="javascript:void(0);" class="img-bg">
                                            <img src="assets/img/products/pos-product-17.png" alt="Products">
                                        </a>
                                        <div class="info">
                                            <span>PT0005</span>
                                            <h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
                                            <p>$2000</p>
                                        </div>
                                    </div>
                                    <div class="qty-item text-center">
                                        <a href="javascript:void(0);"
                                            class="dec d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                data-feather="minus-circle" class="feather-14"></i></a>
                                        <input type="text" class="form-control text-center" name="qty"
                                            value="1">
                                        <a href="javascript:void(0);"
                                            class="inc d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                data-feather="plus-circle" class="feather-14"></i></a>
                                    </div>
                                    <div class="d-flex align-items-center action">
                                        <a class="btn-icon edit-icon me-2" href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit-product">
                                            <i data-feather="edit" class="feather-14"></i>
                                        </a>
                                        <a class="btn-icon delete-icon confirm-text" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-14"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-section">
                            <div class="selling-info">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="input-block">
                                            <label>Order Tax</label>
                                            <select class="select">
                                                <option>GST 5%</option>
                                                <option>GST 10%</option>
                                                <option>GST 15%</option>
                                                <option>GST 20%</option>
                                                <option>GST 25%</option>
                                                <option>GST 30%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="input-block">
                                            <label>Shipping</label>
                                            <select class="select">
                                                <option>15</option>
                                                <option>20</option>
                                                <option>25</option>
                                                <option>30</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="input-block">
                                            <label>Discount</label>
                                            <select class="select">
                                                <option>10%</option>
                                                <option>10%</option>
                                                <option>15%</option>
                                                <option>20%</option>
                                                <option>25%</option>
                                                <option>30%</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-total">
                                <table class="table table-responsive table-borderless">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td class="text-end">$60,454</td>
                                    </tr>
                                    <tr>
                                        <td>Tax (GST 5%)</td>
                                        <td class="text-end">$40.21</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-end">$40.21</td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td class="text-end">$60,454</td>
                                    </tr>
                                    <tr>
                                        <td class="danger">Discount (10%)</td>
                                        <td class="danger text-end">$15.21</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td class="text-end">$64,024.5</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="block-section payment-method">
                            <h6>Payment Method</h6>
                            <div class="row d-flex align-items-center justify-content-center methods">
                                <div class="col-md-6 col-lg-4 item">
                                    <div class="default-cover">
                                        <a href="javascript:void(0);">
                                            <img src="assets/img/icons/cash-pay.svg" alt="Payment Method">
                                            <span>Cash</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 item">
                                    <div class="default-cover">
                                        <a href="javascript:void(0);">
                                            <img src="assets/img/icons/credit-card.svg" alt="Payment Method">
                                            <span>Debit Card</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 item">
                                    <div class="default-cover">
                                        <a href="javascript:void(0);">
                                            <img src="assets/img/icons/qr-scan.svg" alt="Payment Method">
                                            <span>Scan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid btn-block">
                            <a class="btn btn-secondary" href="javascript:void(0);">
                                Grand Total : $64,024.5
                            </a>
                        </div>
                        <div class="btn-row d-sm-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="btn btn-info btn-icon flex-fill" data-bs-toggle="modal"
                                data-bs-target="#hold-order"><span class="me-1 d-flex align-items-center"><i
                                        data-feather="pause" class="feather-16"></i></span>Hold</a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-icon flex-fill"><span
                                    class="me-1 d-flex align-items-center"><i data-feather="trash-2"
                                        class="feather-16"></i></span>Void</a>
                            <a href="javascript:void(0);" class="btn btn-success btn-icon flex-fill"
                                data-bs-toggle="modal" data-bs-target="#payment-completed"><span
                                    class="me-1 d-flex align-items-center"><i data-feather="credit-card"
                                        class="feather-16"></i></span>Payment</a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
