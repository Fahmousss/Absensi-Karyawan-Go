@extends('layouts.app')

@section('title', 'Daftar Cuti Karyawan')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Daftar Cuti Karyawan</h4>
                {{-- <p class="mb-0">Your business dashboard template</p> --}}
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.leaves.index') }}">Cuti</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Cuti Karyawan</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        @include('messages.alerts')
                        @if ($leaves->count())
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="">
                                            #</th>
                                        <th class="">
                                            Tanggal Ajuan</th>
                                        <th class="">
                                            Nama</th>
                                        <th class="text-center ">
                                            Alasan</th>
                                        <th class="text-center ">
                                            Status</th>
                                        <th class="text-center ">
                                            Setengah Jam Kerja</th>
                                        <th class="text-center ">
                                            Awal Cuti</th>
                                        <th class="text-center ">
                                            Akhir Cuti</th>
                                        <th class="text-center ">
                                            Deskripsi</th>
                                        <th class=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $index => $leave)
                                        <tr>
                                            <td>

                                                {{ $index + 1 }}

                                            </td>
                                            <td>

                                                {{ $leave->created_at->format('d-m-Y') }}

                                            </td>
                                            <td>

                                                {{ $leave->employee->first_name . ' ' . $leave->employee->last_name }}

                                            </td>

                                            <td class="">


                                                {{ $leave->reason }}


                                            </td>
                                            <td class="">

                                                <span
                                                    @if ($leave->status == 'pending') class="badge badge-warning"
                                                    @elseif($leave->status == 'declined')
                                                    class="badge badge-danger"
                                                    @elseif($leave->status == 'approved')
                                                    class="badge badge-success" @endif>
                                                    {{ ucfirst($leave->status) }}
                                                </span>
                                                </h5>
                                            </td>
                                            <td class="">
                                                {{ ucfirst($leave->half_day) }}

                                            </td>
                                            <td class="">


                                                {{ $leave->start_date->format('d-m-Y') }}

                                            </td>
                                            @if ($leave->end_date)
                                                <td class="">


                                                    {{ $leave->end_date->format('d-m-Y') }}

                                                </td>
                                            @else
                                                <td class="">


                                                    Single Day

                                                </td>
                                            @endif
                                            <td class="">

                                                {{ $leave->description }}

                                            </td>
                                            <td>
                                                <a class="mr-4" data-toggle="modal"
                                                    data-target="#deleteModalCenter{{ $index + 1 }}"title="Ubah Status">
                                                    <i class="ti ti-more color-muted"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @for ($i = 1; $i < $leaves->count() + 1; $i++)
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter{{ $i }}"
                                    aria-labelledby="deleteModalCenterTitle1{{ $i }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah Status Cuti</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.leaves.update', $leaves->get($i - 1)->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group text-center">
                                                        <label for="">Pilih Status</label>
                                                        <select name="status" class="form-control">
                                                            <option hidden disabled selected value> ---- </option>
                                                            <option value="pending">Pending</option>
                                                            <option value="approved">Diterima</option>
                                                            <option value="declined">Ditolak</option>
                                                        </select>
                                                    </div>


                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            <div class="alert alert-light solid"><strong>Ups!</strong>Tidak ada data
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
