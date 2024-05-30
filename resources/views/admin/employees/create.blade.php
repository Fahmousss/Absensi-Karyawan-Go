@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Tambah Karyawan</h4>

            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Karyawan</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Karyawan</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('messages.alerts')
                    <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')


                        <div>
                            <div class="form-group">
                                <label>Nama Awal</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}"
                                    class="form-control">
                                @error('first_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Akhir</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                @error('last_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dob">Tanggal Lahir</label>
                                <input type="date" name="dob" id="dob" class="form-control" max="2005-12-31">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="sex" class="form-control">
                                    <option hidden disabled selected value> -- Pilih Opsi -- </option>
                                    @if (old('sex') == 'Male')
                                        <option value="Male" selected>Laki-Laki</option>
                                        <option value="Female">Perempuan</option>
                                    @elseif (old('sex') == 'Female')
                                        <option value="Male">Perempuan</option>
                                        <option value="Female" selected>Perempuan</option>
                                    @else
                                        <option value="Male">Laki-Laki</option>
                                        <option value="Female">Perempuan</option>
                                    @endif
                                </select>
                                @error('sex')
                                    <div class="text-danger">
                                        Please select an valid option
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group form-material">
                                <label for="join_date">Tanggal Bergabung</label>
                                <input type="date" name="join_date" id="join_date" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Jabatan</label>
                                    <select name="desg" class="form-control">
                                        <option hidden disabled selected value> -- Pilih Opsi -- </option>
                                        @foreach ($desgs as $desg)
                                            <option value="{{ $desg }}"
                                                @if (old('desg') == $desg) selected @endif>
                                                {{ $desg }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('desg')
                                        <div class="text-danger">
                                            Silahkan Pilih Opsi Valid
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Department</label>
                                    <select name="department_id" class="form-control">
                                        <option hidden disabled selected value> -- Pilih Opsi -- </option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if (old('department_id') == $department->id) selected @endif>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <div class="text-danger">
                                            Silahkan Pilih Opsi Valid
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gaji</label>
                                <input type="text" name="salary" value="{{ old('salary') }}" class="form-control">
                                @error('salary')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="input-group mb-3 custom_file_input">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload Foto</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="photo" class="form-control custom-file-input "
                                        id="photo">
                                    <label class="custom-file-label" for="photo"></label>
                                    @error('photo')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                                @error('password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" class="form-control">
                                @error('password_confirmation')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="card-footer text-center">

                            <button class="btn btn-block btn-primary" type="submit">Tambah</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('extra-js')
    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var label = document.querySelector('label[for="photo"]');
            label.textContent = fileName;
        });
    </script>
  
@endsection
@endsection
