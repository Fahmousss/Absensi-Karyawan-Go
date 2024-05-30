@extends('layouts.app')

@section('title', 'Pengajuan Cuti')

@section('extra-css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}"> --}}
@endsection
@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Pengajuan Cuti</h4>

            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('employee.leaves.index') }}">Cuti</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Pengajuan Cuti</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('messages.alerts')
                    <form action="{{ route('employee.leaves.store', $employee->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">Alasan</label>
                            <select class="form-control" name="reason">
                                <option value="Sakit" selected>Sakit</option>
                                <option value="Cuti">Cuti</option>
                            </select>
                            @error('reason')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lebih dari Sehari ?</label>
                            <select class="form-control" name="multiple-days" onchange="showDate()">
                                <option value="yes" selected>Ya</option>
                                <option value="no">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group d-none" id="half-day">
                            <label>Setengah Jam Kerja</label>
                            <select class="form-control" name="half-day">
                                <option value="no">Tidak</option>
                                <option value="yes">Ya</option>
                            </select>
                        </div>
                        <div class="form-group " id="range-group">
                            <label for="">Rentang Tanggal: </label>
                            <input type="text" name="date_range" class="form-control" id="date_range">
                            @error('date_range')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group d-none" id="date-group">
                            <label for="">Seleksi Data </label>
                            <input type="text" name="date" id="date" class="form-control">
                        </div>

                        <div class="card-footer text-center">
                            <button class="btn btn-block btn-primary" type="submit">Ajukan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('extra-js')
    <script>
        $(document).ready(function() {
            $('#date_range').daterangepicker({
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse',
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

        });

        function showDate() {
            $('#range-group').toggleClass('d-none');
            $('#date-group').toggleClass('d-none');
            $('#half-day').toggleClass('d-none');
        }
    </script>
    {{-- <script src="{{ asset('assets/js/daterangepicker.js') }}"></script> --}}
@endsection
@endsection
