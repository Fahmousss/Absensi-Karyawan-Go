@extends('layouts.app')

@section('title', 'Rekapitulasi Absensi')

@section('content')

<div class="row page-titles mx-0">
   <div class="col-sm-6 p-md-0">
       <div class="welcome-text">
           <h4>Rekapitulasi Absensi Karyawan</h4>
           {{-- <p class="mb-0">Your business dashboard template</p> --}}
       </div>
   </div>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{ route('admin.recap.print', $filter) }}" class="btn btn-primary btn-sm">
                     Print<span class="btn-icon-right pl-2"><i
                         class="ti ti-printer"></i></span> </a>
                   {{-- <a href="{{ route('admin.recap.print', $filter )}}" class="btn btn-primary ">Print</a> --}}
                    {{-- <h4 class="card-title">Rekapitulasi Absensi</h4> --}}
                    
                    <form action="{{ route('admin.recap.index') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <select name="filter" id="month" class=" custom-select">
                                 <option value="all">Semua</option>
                                <option value="jan">January</option>
                                <option value="feb">February</option>
                                <option value="mar">March</option>
                                <option value="apr">April</option>
                                <option value="may">May</option>
                                <option value="jun">June</option>
                                <option value="jul">July</option>
                                <option value="aug">August</option>
                                <option value="sep">September</option>
                                <option value="oct">October</option>
                                <option value="nov">November</option>
                                <option value="dec">December</option>

                            </select>

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-body ">
                    <div class="table-responsive ">
                        @include('messages.alerts')

                        @if ($attendances->count())
                            <table class="table table-bordered table-responsive-sm " style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th class="text-start">#
                                        </th>
                                        <th class="">
                                            Nama</th>
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

                                    </tr>
                                </thead>
                                <tbody class="small">
                                    @foreach ($attendances as $index => $attendance)
                                        <tr>
                                            <td>
                                                {{ $index + 1 }}


                                            </td>
                                            <td>
                                                {{ $attendance->employee->first_name . ' ' . $attendance->employee->last_name }}
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

@endsection
