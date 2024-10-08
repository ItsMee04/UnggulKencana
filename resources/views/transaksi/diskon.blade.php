@extends('layouts.main')
@section('title', 'Diskon')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Diskon Produk</h4>
                        <h6>Kelola Diskon Anda</h6>
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
                            data-feather="plus-circle" class="me-2"></i> Tambah Diskon</a>
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
                                    <th>No.</th>
                                    <th>Nama Diskon</th>
                                    <th>Nilai Diskon</th>
                                    <th>Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diskon as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->diskon }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge badge-bgsuccess">Aktif</span>
                                            @else
                                                <span class="badge badge-bgdanger">Tidak Aktif</span>
                                            @endif
                                        </td>
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
                                                <a class="me-2 p-2"
                                                    onclick="confirm_modal('delete-diskon/{{ $item->id }}');"
                                                    data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- DETAIL DISKON -->
                                    <div class="modal fade" id="modaldetail{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Diskon</h4><button aria-label="Close"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Diskon</label>
                                                            <input type="text" value="{{ $item->nama }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nilai Diskon</label>
                                                            <input type="text" value="{{ $item->diskon }}"
                                                                class="form-control" readonly>
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

                                    <!-- EDIT DISKON -->
                                    <div class="modal fade" id="modaledit{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Diskon</h4><button aria-label="Close"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="diskon/{{ $item->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Diskon</label>
                                                            <input type="text" name="nama"
                                                                value="{{ $item->nama }}" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nilai Diskon</label>
                                                            <input type="text" name="diskon"
                                                                value="{{ $item->diskon }}" class="form-control">
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
                    <h4 class="modal-title">Tambah Diskon</h4><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form action="diskon" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label">Nama Dison</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nilai Dison</label>
                            <input type="text" name="diskon" class="form-control">
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
                        <button type="submit" class="btn btn-primary">Save changes</button>
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