@extends('layouts.app')

@section('title', 'Absensi Karyawan')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Absensi Karyawan</h4>
                {{-- <p class="mb-0">Your business dashboard template</p> --}}
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Karyawan</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Absensi Karyawan</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Absensi Karyawan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('messages.alerts')
                        @if ($employees->count())
                            <table id="example" class="table items-center" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th class="text-start">Nama</th>
                                        <th class="text-center">Riwayat Database</th>
                                        <th class="text-center">Riwayat Awal Absensi</th>
                                        <th class="text-center">Riwayat Absensi</th>
                                        <th class="text-center">Riwayat Akhir Absensi</th>
                                        <th class="text-center">Lokasi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $index => $employee)
                                        <tr>
                                            <td class="text-start">

                                                {{ $employee->first_name . ' ' . $employee->last_name }}

                                            </td>
                                            @if ($employee->attendanceToday)
                                                <td class="text-center">

                                                    <span class="badge badge-success">Terekam</span>

                                                </td>
                                                <td class="text-center">

                                                    Terekam sejak
                                                    {{ $employee->attendanceToday->created_at->format('H:i:s') }} <br>
                                                    {{ $employee->attendanceToday->entry_location }}<br> dengan alamat
                                                    IP {{ $employee->attendanceToday->entry_ip }}


                                                </td>
                                                <?php if ($employee->attendanceToday->time <= 9 && $employee->attendanceToday->time >= 7) { ?>
                                                <td class="text-center">

                                                    <span class="badge badge-success">Hadir</span>

                                                </td>
                                                <?php } elseif ($employee->attendanceToday->time > 9 && $employee->attendanceToday->time <= 12) {
                                        ?>
                                                <td class="text-center">

                                                    <span class="badge badge-warning">Terlambat</span>

                                                </td>
                                                <?php
                                        } else {
                                        ?><td class="text-center">

                                                    <span class="badge badge-danger">Absensi Tidak Valid</span>

                                                </td>
                                                <?php
                                        } ?>
                                                <td class="text-center">

                                                    Terekam sejak
                                                    {{ $employee->attendanceToday->updated_at->format('H:i:s') }} dari
                                                    {{ $employee->attendanceToday->exit_location }} dengan alamat IP
                                                    {{ $employee->attendanceToday->exit_ip }}

                                                </td>
                                            @else
                                                <td class="text-center">

                                                    <span class="badge badge-light">Belum ada riwayat</span>

                                                </td class="text-center">
                                                <td class="text-center">

                                                    <span class="badge badge-light">Belum ada riwayat</span>

                                                </td>
                                                <td class="text-center">

                                                    <span class="badge badge-light">Belum ada riwayat</span>

                                                </td>
                                                <td class="text-center">

                                                    <span class="badge badge-light">Belum ada riwayat</span>

                                                </td>
                                            @endif
                                            <td>
                                                <div class="text-center ">
                                                    <?php
                                                    $conn = mysqli_connect('localhost', 'root', '', 'absensi');
                                                    $loc2 = mysqli_query($conn, 'SELECT * FROM attendances');
                                                    while ($loc = mysqli_fetch_array($loc2)) {
                                                        if (!empty($loc['entry_location'])) {
                                                            echo $loc['entry_location'];
                                                        } else {
                                                            echo ' - ';
                                                        }
                                                    } ?>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($employee->attendanceToday)
                                                    <a href="javascript:void()" data-toggle="modal"
                                                        data-target="#deleteModalCenter{{ $employee->attendanceToday->id }}"><i
                                                            class="fa fa-close color-danger"></i></a>
                                                @else
                                                    No action
                                            </td>
                                    @endif
                                    </tr>
                        @endforeach
                        </tbody>
                        </table>
                        @for ($i = 1; $i < $employees->count() + 1; $i++)
                            {{-- Modal --}}
                            @if ($employees->get($i - 1)->attendanceToday)
                                <div class="modal fade"
                                    id="deleteModalCenter{{ $employees->get($i - 1)->attendanceToday->id }}">
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
                                                    action="{{ route('admin.employees.attendance.delete', $employees->get($i - 1)->attendanceToday->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    @else
                        <div class="alert alert-light solid"><strong>Ups!</strong> Belum ada yang absen hari ini
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->





@endsection
