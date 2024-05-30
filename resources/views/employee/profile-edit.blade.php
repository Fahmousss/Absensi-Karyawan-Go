@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="profile">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo"></div>
                        <div class="profile-photo">
                            <img src="{{ asset('folder_photo/' . $employee->photo) }}" class="img-fluid rounded-circle"
                                alt="">
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                        <div class="profile-name">
                                            <h4 class="text-primary">
                                                {{ $employee->first_name . ' ' . $employee->last_name }}</h4>
                                            <p>{{ $employee->desg }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                        <div class="profile-email">
                                            <h4 class="text-muted">{{ Auth::user()->email }}</h4>
                                            <p>Email</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div id="profile-settings" class="tab-pane fade active show">
                            <div class="pt-3">
                                <div class="settings-form">
                                    <h4 class="text-primary text-center">Biodata</h4>
                                    <table class="table profile-table table-hover">
                                        <tr>
                                            <td>First Name</td>
                                            <td class="text-end">{{ $employee->first_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>{{ $employee->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>{{ $employee->dob->format('d M, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>{{ $employee->sex }}</td>
                                        </tr>

                                        <tr>
                                            <td>Join Date</td>
                                            <td>{{ $employee->join_date->format('d M, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Designation</td>
                                            <td>{{ $employee->desg }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $employee->department->name }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab"
                                        class="nav-link active show">Setting</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="profile-settings" class="tab-pane fade active show">
                                    <div class="pt-3">
                                        <div class="settings-form">

                                            <form action="{{ route('employee.profile-update', $employee->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" placeholder="Nama awal"
                                                            value="{{ $employee->first_name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name"
                                                            value="{{ $employee->last_name }}" placeholder="Password"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" name="dob" id="dob" class="form-control"
                                                        max="2005-12-31">
                                                </div>
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender">
                                                        @if ($employee->sex === 'Male')
                                                            <option value="Male" selected="">Male</option>
                                                            <option value="Female">Female</option>
                                                        @else
                                                            <option value="Male">Male</option>
                                                            <option value="Female" selected>Female</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Gabung Pada</label>
                                                    <input type="date" name="join_date" id="join_date"
                                                        class="form-control">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <select class="form-control" name="desg">
                                                            @foreach ($desgs as $desg)
                                                                <option value="{{ $desg }}"
                                                                    @if ($desg === $employee->desg) selected @endif>
                                                                    {{ $desg }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Department</label>
                                                        <select name="department_id" class="form-control">
                                                            @foreach ($departments as $department)
                                                                <option value="{{ $department->id }}"
                                                                    @if ($department->id === $employee->department_id) selected @endif>
                                                                    {{ $department->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Photo</label>
                                                    <input type="file" name="photo" class="form-control-file">
                                                    @error('photo')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
