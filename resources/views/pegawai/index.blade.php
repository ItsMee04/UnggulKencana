@extends('layouts.main')
@section('title', 'Pegawai')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Pegawai</h4>
                        <h6>Kelola Pegawai Anda</h6>
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
                            data-feather="plus-circle" class="me-2"></i> Tambah Pegawai</a>
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
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>
                                            <div class="userimgname">
                                                @if ($item->avatar != null)
                                                    <a data-bs-effect="effect-sign" data-bs-toggle="modal"
                                                        href="#modaldetail{{ $item->id }}" class="product-img">
                                                        <img src="{{ asset('storage/avatar/' . $item->avatar) }}"
                                                            alt="avatar">
                                                    </a>
                                                @else
                                                    <a data-bs-effect="effect-sign" data-bs-toggle="modal"
                                                        href="#modaldetail{{ $item->id }}" class="product-img">
                                                        <img src="{{ asset('assets') }}/img/notfound/notfound.jpg"
                                                            alt="avatar">
                                                    </a>
                                                @endif
                                                <div>
                                                    <a data-bs-effect="effect-sign" data-bs-toggle="modal"
                                                        href="#modaldetail{{ $item->id }}">{{ $item->nama }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->jabatan->jabatan }}</td>
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
                                                <a class="me-2 p-2" data-bs-effect="effect-sign" data-bs-toggle="modal"
                                                    href="#modaluser{{ $item->id }}">
                                                    <i data-feather="user-check" class="feather-user"></i>
                                                </a>
                                                <a class="me-2 p-2"
                                                    onclick="confirm_modal('delete-pegawai/{{ $item->id }}');"
                                                    data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- DETAIL PEGAWAI -->
                                    <div class="modal fade" id="modaldetail{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Pegawai</h4><button aria-label="Close"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label">NIP</label>
                                                            <input type="text" value="{{ $item->nip }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" value="{{ $item->nama }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kontak</label>
                                                                <input type="text" value="{{ $item->kontak }}"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Jabatan</label>
                                                            <input type="text" value="{{ $item->jabatan->jabatan }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class=" mb-3">
                                                            <div class="new-employee-field">
                                                                <label class="form-label">Avatar</label>
                                                                <div class="profile-pic-upload">
                                                                    <div class="profile-pic active-profile">
                                                                        @if ($item->avatar != null)
                                                                            <img src="{{ asset('storage/avatar/' . $item->avatar) }}"
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
                                                            <label class="form-label">Alamat</label>
                                                            <textarea class="form-control" readonly>{{ $item->alamat }}</textarea>
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

                                    <!-- EDIT PEGAWAI -->
                                    <div class="modal fade" id="modaledit{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Pegawai</h4><button aria-label="Close"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="pegawai/{{ $item->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label">NIP</label>
                                                            <input type="text" name="nip"
                                                                value="{{ $item->nip }}" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" name="nama"
                                                                    value="{{ $item->nama }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kontak</label>
                                                                <input type="text" name="kontak"
                                                                    value="{{ $item->kontak }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Jabatan</label>
                                                            <select class="select" name="jabatan">
                                                                <option>Pilih Jabatan</option>
                                                                @foreach ($jabatan as $itemjabatan)
                                                                    <option value="{{ $itemjabatan->id }}"
                                                                        @if ($item->jabatan_id == $itemjabatan->id) selected="selected" @endif>
                                                                        {{ $itemjabatan->jabatan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class=" mb-3">
                                                            <div class="new-employee-field">
                                                                <label class="form-label">Avatar</label>
                                                                <div class="profile-pic-upload">
                                                                    <div class="profile-pic active-profile preview2"
                                                                        id="preview2">
                                                                        @if ($item->avatar != null)
                                                                            <img src="{{ asset('storage/avatar/' . $item->avatar) }}"
                                                                                alt="avatar">
                                                                        @else
                                                                            <img src="{{ asset('assets') }}/img/notfound/notfound.jpg"
                                                                                alt="avatar">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="file" class="form-control" name="avatar"
                                                                    id="image2">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Alamat</label>
                                                            <textarea class="form-control" name="alamat">{{ $item->alamat }}</textarea>
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

                                    <!-- USER PEGAWAI -->
                                    <div class="modal fade" id="modaluser{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Create Account</h4><button aria-label="Close"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="user/{{ $item->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" name="name"
                                                                value="{{ $item->nama }}" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" name="email"
                                                                value="{{ $item->user->email }}" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" name="password" class="form-control">
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
                    <h4 class="modal-title">Create Employee</h4><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form action="pegawai" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kontak</label>
                            <input type="text" name="kontak" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <select class="select" name="jabatan">
                                <option>Pilih Jabatan</option>
                                @foreach ($jabatan as $itemjabatan)
                                    <option value="{{ $itemjabatan->id }}">{{ $itemjabatan->jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="new-employee-field">
                            <label class="form-label">Avatar</label>
                            <div class="profile-pic-upload">
                                <div class="profile-pic active-profile preview" id="preview">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Avatar</label>
                            <div class="col-md-12">
                                <input id="image" type="file" class="form-control" name="avatar">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat"></textarea>
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
