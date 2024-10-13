@extends('layouts.main')
@section('title', 'Produk')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4></h4>
                        <h6></h6>
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
                <div class="page-btn">
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployee"><i
                            data-feather="plus-circle" class="me-2"></i> Tambah Produk</a>
                </div>
                <div class="page-btn">
                    <a href="#" class="btn btn-added btn-secondary" onclick="history.back()"><i
                            data-feather="arrow-left" class="me-2"></i>Kembali Ke Produk</a>
                </div>
            </div>

            <div class="card table-list-card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a href="javascript:void(0);" class="btn btn-searchset"><i data-feather="search"
                                        class="feather-search"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive product-list">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Berat</th>
                                    <th>Karat</th>
                                    <th>Harga</th>
                                    <th>ActionM</th>
                            </thead>
                            <tbody>
                                @foreach ($nampan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            <span>{{ $item->produk->kodeproduk }}</span>
                                        </td>
                                        <td>
                                            <div class="productimgname">
                                                <a href="javascript:void(0);" class="product-img stock-img">
                                                    <img src="{{ asset('storage/Image/' . $item->produk->image) }}"
                                                        alt="product">
                                                </a>
                                                <a href="javascript:void(0);"> {{ $item->produk->nama }}</a>
                                            </div>
                                        </td>
                                        <td> {{ $item->produk->berat }} / grams</td>
                                        <td>{{ $item->produk->karat }}</td>
                                        <td>{{ 'Rp.' . ' ' . number_format($item->produk->harga) }}</td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2"
                                                    onclick="confirm_modal('/delete-nampan-produk/{{ $item->id }}');"
                                                    data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addEmployee">
        <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form action="/produkNampan/{{ $nampanID }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-start">
                        <div class="table-responsive product-list">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th class="no-sort">
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>No.</th>
                                        <th>Kode Produk</th>
                                        <th>Nama</th>
                                        <th>Berat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox" name="items[]" value="{{ $item->id }}">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td><span>{{ $item->kodeproduk }}</span></td>
                                            <td>
                                                <div class="productimgname">
                                                    <a href="javascript:void(0);" class="product-img stock-img">
                                                        <img src="{{ asset('storage/Image/' . $item->image) }}"
                                                            alt="product">
                                                    </a>
                                                    <a href="javascript:void(0);">{{ $item->nama }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $item->berat }} / grams</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Popup untuk delete-->
    <div class="modal custom-modal fade" id="modal_delete">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Perhatian !!</h4>
                        <p class="mt-3">Yakin menghapus data ini ?</p>
                        <a id="delete_link" class="btn btn-danger my-2" data-dismiss="modal">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript untuk popup modal Delete-->
    <script type="text/javascript">
        function confirm_modal(delete_url) {
            $('#modal_delete').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>
@endsection
