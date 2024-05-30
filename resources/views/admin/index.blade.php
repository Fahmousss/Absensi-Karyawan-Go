@extends('layouts.app')        

@section('title', 'Dashboard')

@section('content')

<row class="">
  <div class="col-md-8 mx-auto">
    <div class="jumbotron">
      <h1 class="display-4 text-primary">Selamat Datang di Panel Admin Website Absensi</h1>
      <p class="lead"></p>
      <hr class="my-4">
      {{-- <p>Silahkan Mulai Absensi<a href="{{route('employee.attendance.create')}}" class=""> di sini </a></p> --}}
    </div>
  </div>
</row>

@endsection
