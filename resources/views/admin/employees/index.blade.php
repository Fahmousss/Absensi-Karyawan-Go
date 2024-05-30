@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Daftar Karyawan</h4>
                {{-- <p class="mb-0">Your business dashboard template</p> --}}
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Karyawan</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Karyawan</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Karyawan</h4>
                    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary btn-sm">
                        Add<span class="btn-icon-right pl-2"><i
                            class="fa fa-plus"></i></span> </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('messages.alerts')
                        @if ($employees->count())
                            <table id="example" class="table items-center" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th class="text-start">Karyawan</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Departemen</th>
                                        <th class="text-center">Employed</th>
                                        <th class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $index => $employee)
                                        <tr>
                                            <td class="text-start">

                                                {{ $employee->first_name . ' ' . $employee->last_name }}

                                            </td>
                                            <td class="text-center">
                                                {{ $employee->desg }}
                                            </td>
                                            <td class="text-center">
                                                {{ $employee->department->name }}
                                            </td>
                                            <td class="text-center">
                                                <span>{{ $employee->join_date->format('d M, Y') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.employees.profile', $employee->id) }}"
                                                    class="mr-4" title="Lihat"><i class="ti ti-eye color-muted"></i>
                                                </a>
                                                <a href="javascript:void()" data-toggle="modal"
                                                    data-target="#exampleModalCenter{{ $index + 1 }}" title="Hapus"><i
                                                        class="fa fa-close color-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @for ($i = 1; $i < $employees->count() + 1; $i++)
                                {{-- Modal --}}
                                <div class="modal fade" id="exampleModalCenter{{ $i }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Confirm</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin ingin menghapus data ini?
                                                    <span class="text-danger">Data yang dihapus tidak dapat
                                                        dikembalikan</span>
                                                </p>
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <form
                                                    action="{{ route('admin.employees.delete', $employees->get($i - 1)->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            <div class="alert alert-light solid"><strong>Ups!</strong> Data Karyawan kosong
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
