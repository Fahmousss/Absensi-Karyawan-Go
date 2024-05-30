<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table {
            width: 100%;
            border-spacing: 0px;
            /* margin-bottom: 1rem; */
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            /* vertical-align: top; */
            /* border-top: 1px solid #dee2e6; */
        }

        .table thead th {
            vertical-align: bottom;
            /* border-bottom: 1px solid #dee2e6; */
        }

        .table tbody+tbody {
            /* border-top: 1px solid #dee2e6; */
        }

        .table .table {
            background-color: #fff;
        }

        .table-sm th,
        .table-sm td {
            /* padding: 0.3rem; */
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            /* border-bottom-width: 1px; */
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .text-primary {
            color: #007bff !important;
        }

        .text-secondary {
            color: #6c757d !important;
        }

        .text-dark {
            color: #343a40 !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .text-light {
            color: #f8f9fa !important;
        }

        .text-white {
            color: #fff !important;
        }

        .text-body {
            color: #212529 !important;
        }

        .text-black-50 {
            color: rgba(0, 0, 0, 0.5) !important;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Rekapitulasi Absensi</h1>
        <p class="text-center"><strong>Periode :</strong> {{ $filter }}</p>
    <div class="card-body ">
        <div class="table-responsive ">
            @include('messages.alerts')

            @if ($attendances->count())
                <table class="table table-bordered" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th class="text-start">No
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
    <script>
        window.print();
    </script>
</body>

</html>
