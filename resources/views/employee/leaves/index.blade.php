@extends('layouts.app')

@section('title', 'Daftar Cuti')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Daftar Cuti</h4>
                {{-- <p class="mb-0">Your business dashboard template</p> --}}
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Cuti</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Cuti</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Cuti</h4>

                    <a class="btn btn-primary btn-sm" href="{{ route('employee.leaves.create') }}">
                        Add<span class="btn-icon-right pl-2"><i class="fa fa-plus"></i></span></a>
                </div>
                <div class="card-body ">
                    <div class="table-responsive ">
                        @include('messages.alerts')
                        @if ($leaves->count())
                            <table class="table table-hover" style="min-width: 850px">
                                <thead>
                                    <tr>
                                        <th>
                                            #</th>
                                        <th>
                                            Tanggal Ajuan</th>
                                        <th>
                                            Alasan</th>
                                        <th>
                                            Status</th>
                                        <th>
                                            Setengah Hari Kerja</th>
                                        <th>
                                            Mulai Cuti</th>
                                        <th>
                                            Akhir Cuti</th>
                                        <th>
                                            Deskripsi</th>
                                        <th></th>
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

                                                {{ $leave->reason }}

                                            </td>
                                            <td>
                                                <h5>
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
                                            <td>
                                                {{ ucfirst($leave->half_day) }}
                                            </td>
                                            <td>
                                                {{ $leave->start_date->format('d-m-Y') }}
                                            </td>
                                            @if ($leave->end_date)
                                                <td>
                                                    {{ $leave->end_date->format('d-m-Y') }}</td>
                                            @else
                                                <td>Single Day</td>
                                            @endif
                                            <td>{{ $leave->description }}</td>
                                            <td>
                                                @if ($leave->status !== 'approved')
                                                    <a href="{{ route('employee.leaves.edit', ['employee_id' => $employee->id, 'leave_id' => $leave->id]) }}"
                                                        class="mr-4" title="Edit"><i class="fa fa-pencil"></i></a>
                                                @endif
                                                <a href="javascript:void()" data-toggle="modal"
                                                    data-target="#deleteModalCenter{{ $index + 1 }}" title="Batal">
                                                    <i class="fa fa-close color-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @for ($i = 1; $i < $leaves->count() + 1; $i++)
                                <div class="modal fade" id="deleteModalCenter{{ $i }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Pembatalan</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin ingin membatalkan pengajuan ini?
                                                    <span class="text-danger">Pengajuan yang dibatalkan tidak dapat
                                                        dikembalikan</span>
                                                </p>
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tidak</button>
                                                <form
                                                    action="{{ route('employee.leaves.delete', $leaves->get($i - 1)->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            @endfor
                        @else
                            <div class="alert alert-light solid"><strong>Ups!</strong> Tidak ada data
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- /.content -->

@endsection

@section('extra-js')
    <script>
        function showDate() {
            var multipleDays = document.querySelector('select[name="multiple-days"]').value;
            var halfDay = document.getElementById('half-day');
            if (multipleDays === 'no') {
                halfDay.classList.add('hide-input');
            } else {
                halfDay.classList.remove('hide-input');
            }
        }
    @endsection
