@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Resolusi</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Resolusi</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('components.alert')
            <!--begin::Category-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    @if (auth()->user()->role == 'Mahasiswa')
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Add customer-->
                        <a href="{{ route('mentoring.create') }}" class="btn btn-primary me-2">Input Resolusi</a>
                        <a href="{{ route('mentoring.cetak') }}" class="btn btn-success">Cetak</a>
                        <!--end::Add customer-->
                    </div>
                    <!--end::Card toolbar-->
                    @endif
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    </div>
                                </th>
                                <th class="min-w-50px">No</th>
                                <th class="min-w-150px">Tanggal</th>
                                <th class="min-w-150px">Topik</th>
                                {{-- <th class="min-w-150px">TTD</th> --}}
                                <th class="min-w-150px">Kegiatan</th>
                                @if (auth()->user()->role == 'Mahasiswa' || auth()->user()->role == 'Admin')
                                <th class="min-w-150px">Ket</th>
                                @endif
                                @if (auth()->user()->role == 'Mentor')
                                <th class="text-center min-w-150px">Keterangan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($data as $item)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    </div>
                                </td>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->isoFormat('D MMMM Y') }}</td>
                                <td>{{ $item->jadwal->topik }}</td>
                                {{-- <td>
                                    @if ($item->signature != NULL)
                                        <a href="{{ url(Storage::url($item->signature)) }}" target="_blank"><img src="{{ url(Storage::url($item->signature)) }}" width="30" alt=""></a>
                                    @endif
                                </td> --}}
                                <td>{{ $item->deskripsi }}</td>
                                @if (auth()->user()->role == 'Mahasiswa' || auth()->user()->role == 'Admin')
                                <td>
                                    @if ($item->ket == 1)
                                        Disetujui
                                    @elseif ($item->ket != NULL)
                                        <a href="{{ route('mentoring.lihat-revisi', $item->id) }}" class="btn btn-warning btn-sm">Lihat Revisi</a>
                                    @endif
                                </td>
                                @endif
                                @if (auth()->user()->role == 'Mentor')
                                <td class="text-center">
                                    {{-- <a href="{{ route('mentoring.acc', $item->id) }}" class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Edit">
                                        <i class="ki-duotone ki-pencil fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a> --}}
                                    @if ($item->ket == NULL || $item->ket == 1)
                                    <input type="checkbox" class="redirectCheckbox" data-id="{{ $item->id }}" @checked($item->ket == 1) @disabled($item->ket == 1)>
                                    @else
                                        {{ $item->ket }}
                                    @endif
                                    @if ($item->ket == NULL)
                                    <a href="{{ route('mentoring.revisi', $item->id) }}" class="btn btn-flex btn-primary btn-sm ms-3" data-bs-toggle="tooltip" title="Revisi">
                                        Revisi
                                    </a>
                                    @endif
                                    {{-- <a href="{{ route('mentoring.edit', $item->id) }}" class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Edit">
                                        <i class="ki-duotone ki-pencil fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a> --}}
                                    {{-- <a href="{{ route('mentoring.destroy', $item->id) }}" class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this data?')) {document.getElementById('delete-form-{{ $item->id }}').submit();}">
                                        <i class="ki-duotone ki-trash fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('mentoring.destroy', $item->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form> --}}
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
@endsection

@push('plugin-scripts')
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="assets/js/custom/apps/ecommerce/catalog/categories.js"></script>
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
@endpush

@push('custom-scripts')
<script>
    // Dapatkan semua elemen checkbox dengan class 'redirectCheckbox'
    var checkboxes = document.querySelectorAll('.redirectCheckbox');

    // Tambahkan event listener untuk setiap checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Dapatkan ID dari atribut data
            var itemId = this.getAttribute('data-id');

            if (this.checked) {
                window.location.href = '{{ route('mentoring.acc', ['mentoring' => ':itemId']) }}'.replace(':itemId', itemId);
            }
        });
    });
</script>
@endpush
