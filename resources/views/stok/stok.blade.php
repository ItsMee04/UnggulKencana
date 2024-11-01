@extends('layouts.main')
@section('title', 'Manage Stok')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Manage Stok</h4>
                        <h6>Kelola Stok Produk Anda</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"
                            onClick="window.location.href=window.location.href"><i data-feather="rotate-ccw"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
            </div>
            <div class="card col-6">
                <div class="card-header">
                    <h5 class="card-title">
                        <marquee>STOK</marquee>
                    </h5>
                </div>
                <div class="card-body">
                    <form id="FilterForm">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Tanggal Dari</label>
                                <input type="date" name="tglDari" id="tglDari" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Tanggal Sampai</label>
                                <input type="date" name="tglSampai" id="tglSampai" class="form-control">
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" id="filterSearch" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card table-list-card">
                <div class="card-body pb-0">
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nampan</th>
                                    <th>Total Produk</th>
                                    <th>Total Berat</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets') }}/js/jquery-3.7.1.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/filterStok.js" type="text/javascript"></script>
@endsection
