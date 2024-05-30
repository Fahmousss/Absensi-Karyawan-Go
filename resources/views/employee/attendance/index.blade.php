@extends('layouts.app')

@section('title', 'Riwayat Absensi')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Riwayat Absensi</h4>
                </div>
                <div class="card-body ">
                    <div class="table-responsive ">
                        @include('messages.alerts')

                        @if ($attendances->count())
                            <table class="table table-hover " style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th class="text-start">#
                                        </th>
                                        <th class="">
                                            Tanggal</th>
                                        <th class="text-center">
                                            Status</th>
                                        <th class="text-center">
                                            Waktu Absensi</th>
                                        <th class="text-center">
                                            Lokasi Absensi</th>
                                        <th class="text-center">
                                            Waktu Selesai</th>
                                        <th class="text-center">
                                            Lokasi Selesai</th>
                                        <th class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $index => $attendance)
                                        <tr>
                                            <td>
                                                {{ $index + 1 }}

                    </div>
                    </td>
                    @if ($attendance->registered == 'yes')
                        <td>

                            {{ $attendance->created_at->format('d-m-Y') }}

                        </td>
                        @if ($attendance->created_at->format('H:i:s') >= '09:00:00')
                            <td>
                                <span class="badge badge-warning">Terlambat</span>
                            </td>
                            
                        @elseif($attendance->created_at->format('H:i:s') <= '09:00:00' && $attendance->updated_at->format('H:i:s') >= '18:00:00')
                            <td>
                                <span class="badge badge-success">Lembur</span>
                            </td>
                            @else
                        <td>

                            <span class="badge badge-success">Hadir</span>

                        </td>
                        @endif
                        <td class="align-middle text-center">


                            {{ $attendance->created_at->format('H:i:s') }}

                        </td>
                        <td class="align-middle text-center">


                            {{ $attendance->entry_location }}

                        </td>
                        <td class="align-middle text-center">


                            {{ $attendance->updated_at->format('H:i:s') }}

                        </td>
                        <td class="align-middle text-center">


                            {{ $attendance->exit_location }}

                        </td>
                        <td class="align-middle">

                        </td>
                    @elseif($attendance->registered == 'no')
                        <td>
                            {{ $attendance->created_at->format('d-m-Y') }}
                        </td>
                        <td>

                            <span class="badge badge-danger">Tidak Hadir</span>

                        </td>
                        <td class="align-middle text-center">

                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">

                            Belum ada riwayat
                            </p>
                        </td>

                        <td class="align-middle">

                        </td>
                    @elseif($attendance->registered == 'minggu' || $attendance->registered == 'hari libur')
                        <td>

                            {{ $attendance->created_at->format('d-m-Y') }}

                        </td>
                        <td>

                            <span class="badge badge-info">Libur</span>

                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>

                        <td class="align-middle">

                        </td>
                    @elseif($attendance->registered == 'leave')
                        <td>

                            {{ $attendance->created_at->format('d-m-Y') }}

                        </td>
                        <td>

                            <span class="badge badge-info">Cuti</span>

                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            Belum ada riwayat
                            </p>
                        </td>
                    @else
                        <td>




                            {{ $attendance->created_at->format('d-m-Y') }}

                        </td>
                        <td>

                            <span class="badge badge-warning">Setengah jam
                                kerja</span>

                        </td>
                        <td class="align-middle text-center">



                            {{ $attendance->created_at->format('H:i:s') }}
                            </p>
                        </td>
                        <td class="align-middle text-center">


                            {{ $attendance->entry_location }}
                            </p>
                        </td>
                        <td class="align-middle text-center">
                            -
                        </td>
                        <td class="align-middle text-center">
                            -
                        </td>
                        <td class="align-middle">

                        </td>
                    @endif
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                @else
                    <div class="alert alert-light solid"><strong>Ups!</strong> Data Karyawan kosong
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


@endsection
