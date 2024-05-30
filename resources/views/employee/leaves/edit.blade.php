@extends('layouts.app')

@section('title', 'Edit Pengajuan')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit Pengajuan</h4>

            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('employee.leaves.index') }}">Cuti</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('employee.leaves.create') }}">Pengajuan Cuti</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('messages.alerts')
                    <form action="{{ route('employee.leaves.update', $leave->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Alasan</label>
                            <input type="text" name="reason" value="{{ $leave->reason }}" class="form-control">
                            @error('reason')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="description" class="form-control">{{ $leave->description }}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($leave->end_date)
                            <div class="form-group">
                                <label>Lebih dari satu hari ?</label>
                                <select class="form-control" name="multiple-days" onchange="showDate()">
                                    <option value="yes" selected>Ya</option>
                                    <option value="no">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group d-none" id="half-day">
                                <label>Setengah Hari Kerja</label>
                                <select class="form-control" name="half-day">
                                    <option value="no">Tidak</option>
                                    <option value="yes">Ya</option>
                                </select>
                            </div>
                            <div class="form-group" id="range-group">
                                <label for="">Rentang Tanggal: </label>
                                <input type="text" name="date_range" id="date_range" class="form-control">
                                @error('date_range')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group d-none" id="date-group">
                                <label for="">Seleksi Tanggal </label>
                                <input type="text" name="date" id="date" class="form-control">
                            </div>
                        @else
                            <div class="form-group">
                                <label>Multiple Days</label>
                                <select class="form-control" name="multiple-days" onchange="showDate()">
                                    <option value="yes">Ya</option>
                                    <option value="no" selected>Tidak</option>
                                </select>
                            </div>
                            <div class="form-group" id="half-day">
                                <label>Setengah Hari Kerja</label>
                                <select class="form-control" name="half-day">
                                    @if ($leave->half_day == 'no')
                                        <option value="no" selected>Tidak</option>
                                        <option value="yes">Ya</option>
                                    @else
                                        <option value="no">Tidak</option>
                                        <option value="yes" selected>Ya</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group d-none" id="range-group">
                                <label for="">Rentang Tanggal: </label>
                                <input type="text" name="date_range" id="date_range" class="form-control">
                                @error('date_range')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group" id="date-group">
                                <label for="">Seleksi Data </label>
                                <input type="text" name="date" id="date" class="form-control">
                            </div>
                        @endif
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-block btn-primary" type="submit">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('extra-js')
    <script>
        $(document).ready(function() {
            startDate = moment('{{ $leave->start_date }}');
            if ('{{ $leave->end_date }}') {
                endDate = new Date('{{ $leave->end_date }}');
                $('#date_range').daterangepicker({
                    "startDate": startDate,
                    "endDate": endDate,
                    "locale": {
                        "format": "DD-MM-YYYY",
                    }
                });

                $('#date').daterangepicker({
                    "singleDatePicker": true,
                    "locale": {
                        "format": "DD-MM-YYYY",
                    }
                });
            } else {
                $('#date_range').daterangepicker({
                    "locale": {
                        "format": "DD-MM-YYYY",
                    }
                });
                $('#date').daterangepicker({
                    "startDate": startDate,
                    "singleDatePicker": true,
                    "locale": {
                        "format": "DD-MM-YYYY",
                    }
                });
            }
        });

        function showDate() {
            $('#range-group').toggleClass('d-none');
            $('#date-group').toggleClass('d-none');
            $('#half-day').toggleClass('d-none');
        }
    </script>
@endsection
