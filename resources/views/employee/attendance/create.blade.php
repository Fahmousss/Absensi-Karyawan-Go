@extends('layouts.app')

@section('title', 'Absensi')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Absensi Hari ini <?php $time = date('H:i:s');
                    $dt = date('d-M-Y');
                    echo $dt . ' ' . $time; ?>
                    </h3>


                    @include('messages.alerts')
                    @if (!$attendance)
                        <form role="form" method="post" action="{{ route('employee.attendance.store', $employee->id) }}">
                        @else
                            <form role="form" method="post"
                                action="{{ route('employee.attendance.update', $attendance->id) }}">
                                @method('PUT')
                    @endif
                    @csrf
                    
                        <?php  { ?>
                        @if (!$attendance)
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="entry_time">Waktu Absensi</label>
                                        <input type="text" class="form-control text-center" name="entry_time"
                                            id="entry_time" placeholder="--:--:--" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="entry_location">Lokasi Absensi</label>
                                        <input type="text" class="form-control text-center" id="entry_loc"
                                            placeholder="Location Loading..." disabled />
                                        <input type="text" name="entry_location" name="entry_location"
                                            id="entry_location" hidden>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="entry_ip">IP Address</label>
                                        <input type="text" class="form-control text-center" id="entry_ip"
                                            name="entry_ip" placeholder="X.X.X.X" disabled />
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="entry_time">Waktu Absensi</label>
                                        <input type="text" value="{{ $attendance->created_at->format('d-m-Y,  H:i:s') }}"
                                            class="form-control text-center" name="entry_time" id="entry_time"
                                            placeholder="--:--:--" disabled style="background: #333; color:#f4f4f4" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="entry_location">Lokasi Absensi</label>
                                        <input type="text" class="form-control text-center" name="entry_location"
                                            value="{{ $attendance->entry_location }}" placeholder="..." disabled
                                            style="background: #333; color:#f4f4f4" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="entry_ip">IP Address</label>
                                        <input type="text" class="form-control text-center" id="entry_ip"
                                            value="{{ $attendance->entry_ip }}" name="entry_ip" placeholder="X.X.X.X"
                                            disabled style="background: #333; color:#f4f4f4" />
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (!$registered_attendance)
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exit_time">Waktu Selesai</label>
                                        <input type="text" class="form-control text-center" name="exit_time"
                                            id="exit_time" placeholder="--:--:--" disabled />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exit_location">Lokasi Selesai</label>
                                        <input type="text" class="form-control text-center" id="exit_loc"
                                            @if ($attendance) placeholder="Location Loading..."
                                                
                                            @else
                                            placeholder="..." @endif
                                            disabled />
                                        <input type="text" name="exit_location" id="exit_location" hidden>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exit_ip">IP Address</label>
                                        <input type="text" class="form-control text-center" id="exit_ip" name="exit_ip"
                                            placeholder="X.X.X.X" disabled />
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exit_time">Waktu Selesai</label>
                                        <input type="text" class="form-control text-center" name="exit_time"
                                            id="exit_time" value="{{ $attendance->updated_at->format('d-m-Y,  H:i:s') }}"
                                            placeholder="--:--:--" disabled style="background: #333; color:#f4f4f4" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exit_location">Lokasi Selesai</label>
                                        <input type="text" class="form-control text-center" name="exit_location"
                                            value="{{ $attendance->exit_location }}" placeholder="..." disabled
                                            style="background: #333; color:#f4f4f4" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exit_ip">IP Address</label>
                                        <input type="text" class="form-control text-center" id="exit_ip"
                                            name="exit_ip" value="{{ $attendance->exit_ip }}" placeholder="X.X.X.X"
                                            disabled style="background: #333; color:#f4f4f4" />
                                    </div>
                                </div>
                            </div>
                        @endif

                    
                <!-- /.card-body -->
                @if (!$registered_attendance)
                    <div class="card-footer">
                        @if (!$attendance)
                            <button type="submit" class="btn btn-primary">
                                Absen Masuk
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary pull-right">
                                Absen Keluar/Selesai
                            </button>
                        @endif
                    </div>
                @endif
                <?php } ?>

                </form>
            </div>
        </div>
    </div>
    </div>


@endsection

@section('extra-js')
    <script>
        $(document).ready(function() {
            if ("geolocation" in navigator) {
                console.log("gl available");
                navigator.geolocation.getCurrentPosition(position => {
                    console.log(position.coords.latitude + "," + position.coords.longitude);

                    $.post("/employee/attendance/get-location", {
                        lat: position.coords.latitude,
                        lon: position.coords.longitude,
                        '_token': $('meta[name=csrf-token]').attr('content'),
                    }, function(data) {
                        console.log(!'{{ $registered_attendance }}')
                        $('#entry_loc').val(data);
                        $('#entry_location').val(data);
                        if ('{{ $attendance }}') {
                            $('#exit_loc').val(data);
                            $('#exit_location').val(data);
                        }
                    });
                }, function() {
                    $('#address').val('Denied Permission to retreive location');
                });
            } else {
                $('#address').html("Location not available");
            }
        });
    </script>
@endsection
