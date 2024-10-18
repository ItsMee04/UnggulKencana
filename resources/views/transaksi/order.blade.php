@extends('layouts.main')
@section('title', 'Order')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Orders List</h4>
                        <h6>Manage Your Purchase</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" onClick="window.location.href=window.location.href" data-bs-placement="top"
                            title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
            </div>

            <div class="card table-list-card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a href class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
                            </div>
                        </div>
                        <div class="search-path">
                        </div>
                        <div class="form-sort">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Transaksi</th>
                                    <th>ID Keranjang</th>
                                    <th>Pelanggan</th>
                                    <th>Grand Total</th>
                                    <th>Payment Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a
                                                href="order/{{ $item->transaksi_id }}"><strong>{{ $item->transaksi_id }}</strong></a>
                                        </td>
                                        <td>{{ $item->id_keranjang }}</td>
                                        <td>{{ $item->pelanggan->nama }}</td>
                                        <td>{{ 'Rp.' . ' ' . number_format($item->total) }}
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge bg-danger"> Unpaid</span>
                                            @else
                                                <span class="badge bg-success"> Paid</span>
                                            @endif
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                @if ($item->status == 1)
                                                    <a class="me-2 p-2 mb-0" data-bs-effect="effect-sign"
                                                        href="order/{{ $item->transaksi_id }}">
                                                        <i data-feather="eye" class="action-eye"></i>
                                                    </a>
                                                    <a class="me-2 p-2"
                                                        onclick="confirm_modal('confirmPayment/{{ $item->id }}');"
                                                        data-bs-toggle="modal" data-bs-target="#modal_confirm">
                                                        <i data-feather="check-circle" class="feather-trash-2"></i>
                                                    </a>
                                                @else
                                                    <a class="me-2 p-2 mb-0" data-bs-effect="effect-sign"
                                                        href="order/{{ $item->transaksi_id }}">
                                                        <i data-feather="eye" class="action-eye"></i>
                                                    </a>
                                                @endif
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

    <!-- Modal Popup untuk delete-->
    <div class="modal custom-modal fade" id="modal_confirm">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <div class="icon-head">
                        <a href="javascript:void(0);">
                            <i data-feather="check-circle" class="feather-40"></i>
                        </a>
                    </div>
                    <h4>Payment Confirm</h4>
                    <p class="mb-0">Confirm this payment ?</p>
                    <div class="modal-footer d-sm-flex justify-content-between">
                        <a id="confirm" class="btn btn-secondary flex-fill" data-dismiss="modal">Finish</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript untuk popup modal Delete-->
    <script type="text/javascript">
        function confirm_modal(delete_url) {
            $('#modal_confirm').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirm').setAttribute('href', delete_url);
        }
    </script>
@endsection
