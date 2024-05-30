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
                                            <h4 class="text-primary">{{ $employee->first_name . ' ' . $employee->last_name }}</h4>
                                            <p>{{ $employee->desg }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                        <div class="profile-email">
                                            <h4 class="text-muted">{{$employee->user->email}}</h4>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div id="profile-settings" class="tab-pane fade active show">
                            <div class="pt-3">
                                <div class="settings-form">
                                    <h4 class="text-primary text-center">Biodata</h4>
                                    <table class="table profile-table table-hover text-justify">
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
       
    </div>
@endsection
