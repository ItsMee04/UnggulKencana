@extends('layouts.main')
@section('title', 'Produk')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Produk</h4>
                        <h6>Kelola Produk Anda</h6>
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
                <div class="card-body pb-0">
                    <div class="table-top">
                        <div class="input-blocks search-set mb-0">
                            <div class="search-input">
                                <a href class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
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
                                    <th>Karat</th>
                                    <th>Harga</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            {!! DNS2D::getBarcodeSVG($item->kodeproduk, 'QRCODE', 2, 2) !!}
                                            <a href="scanner/{{ $item->kodeproduk }}">
                                                <span>{{ $item->kodeproduk }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="productimgname">
                                                <a href="javascript:void(0);" class="product-img stock-img">
                                                    <img src="{{ asset('storage/Image/' . $item->image) }}" alt="product">
                                                </a>
                                                {{ $item->nama }}
                                            </div>
                                        </td>
                                        <td>{{ $item->berat }} / grams</td>
                                        <td>{{ $item->karat }}</td>
                                        <td>{{ 'Rp.' . ' ' . number_format($item->harga_jual) }}</td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 edit-icon  p-2" data-bs-effect="effect-sign"
                                                    data-bs-toggle="modal" href="#modaldetail{{ $item->id }}">
                                                    <i data-feather="eye" class="feather-eye"></i>
                                                </a>
                                                <a class="me-2 p-2" data-bs-effect="effect-sign" data-bs-toggle="modal"
                                                    href="#modaledit{{ $item->id }}">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <a class="me-2 p-2" href="downloadBarcode/{{ $item->id }}">
                                                    <i data-feather="download" class="feather-edit"></i>
                                                </a>
                                                <a class="me-2 p-2"
                                                    onclick="confirm_modal('/delete-produk/{{ $item->id }}');"
                                                    data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- DETAIL PRODUK -->
                                    <div class="modal fade" id="modaldetail{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Produk</h4><button aria-label="Close"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label">Kode Produk</label>
                                                            <input type="text" value="{{ $item->kodeproduk }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama</label>
                                                            <input type="text" value="{{ $item->nama }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Berat</label>
                                                                <input type="text" value="{{ $item->berat }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Karat</label>
                                                                <input type="text" value="{{ $item->karat }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Harga Jual</label>
                                                                <input type="text" value="{{ $item->harga_jual }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Harga Beli</label>
                                                                <input type="text" value="{{ $item->harga_beli }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Keterangan</label>
                                                            <textarea class="form-control" readonly>{{ $item->keterangan }}</textarea>
                                                        </div>
                                                        <div class=" mb-3">
                                                            <div class="new-employee-field">
                                                                <label class="form-label">Image</label>
                                                                <div class="profile-pic-upload">
                                                                    <div class="profile-pic active-profile">
                                                                        @if ($item->image != null)
                                                                            <img src="{{ asset('storage/Image/' . $item->image) }}"
                                                                                alt="avatar">
                                                                        @else
                                                                            <img src="{{ asset('assets') }}/img/notfound/notfound.jpg"
                                                                                alt="avatar">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            @if ($item->status == 1)
                                                                <input type="text" value="Aktif" class="form-control"
                                                                    readonly>
                                                            @else
                                                                <input type="text" value="Tidak Aktif"
                                                                    class="form-control" readonly>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-cancel"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- EDIT PRODUK -->
                                    <div class="modal fade" id="modaledit{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Produk</h4><button aria-label="Close"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/produk/{{ $item->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label">Kode Produk</label>
                                                            <input type="text" value="{{ $item->kodeproduk }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama</label>
                                                            <input type="text" value="{{ $item->nama }}"
                                                                class="form-control" name="nama">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Berat</label>
                                                                <input type="text" value="{{ $item->berat }}"
                                                                    class="form-control" name="berat">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Karat</label>
                                                                <input type="text" value="{{ $item->karat }}"
                                                                    class="form-control" name="karat">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Harga Jual</label>
                                                                <input type="text" value="{{ $item->harga_jual }}"
                                                                    class="form-control" name="hargajual">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Harga Beli</label>
                                                                <input type="text" value="{{ $item->harga_beli }}"
                                                                    class="form-control" name="hargabeli">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan">{{ $item->keterangan }}</textarea>
                                                        </div>
                                                        <div class=" mb-3">
                                                            <div class="new-employee-field">
                                                                <label class="form-label">Image</label>
                                                                <div class="profile-pic-upload">
                                                                    <div class="profile-pic active-profile preview2"
                                                                        id="preview2">
                                                                        @if ($item->image != null)
                                                                            <img src="{{ asset('storage/Image/' . $item->image) }}"
                                                                                alt="avatar">
                                                                        @else
                                                                            <img src="{{ asset('assets') }}/img/notfound/notfound.jpg"
                                                                                alt="avatar">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="file" class="form-control" name="image"
                                                                    id="image2">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select class="select" name="status">
                                                                <option>Pilih Status</option>
                                                                <option value="1"
                                                                    @if ($item->status == 1) selected="selected" @endif>
                                                                    Aktif</option>
                                                                <option value="2"
                                                                    @if ($item->status == 2) selected="selected" @endif>
                                                                    Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-cancel"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addEmployee">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form action="/produk" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label">Kode Produk</label>
                            <input type="text" name="kodeproduk" class="form-control" value="{{ $kodeproduk }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Berat</label>
                                <input type="text" name="berat" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Karat</label>
                                <input type="text" name="karat" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Harga Jual</label>
                                <input type="text" name="hargajual" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Harga Beli</label>
                                <input type="text" name="hargabeli" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select class="select" name="jenis">
                                <option>Pilih Jenis</option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->id }}"> {{ $item->jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" rows="4" name="keterangan"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6 new-employee-field">
                                <label class="form-label">Avatar</label>
                                <div class="profile-pic-upload">
                                    <div class="profile-pic active-profile preview" id="preview">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Image</label>
                                <div class="col-md-12">
                                    <input id="image" type="file" class="form-control" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="select" name="status">
                                <option>Pilih Status</option>
                                <option value="1"> Aktif</option>
                                <option value="2"> Tidak Aktif</option>
                            </select>
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

        const imgInput = document.getElementById('image')
        const previewImage = document.getElementById('preview')

        imgInput.addEventListener("change", () => {
            const file = imgInput.files[0]
            const reader = new FileReader;

            reader.addEventListener("load", () => {
                previewImage.innerHTML = ""
                const img = document.createElement("img")
                img.src = reader.result

                previewImage.appendChild(img)
            })

            reader.readAsDataURL(file)
        })
    </script>
@endsection
