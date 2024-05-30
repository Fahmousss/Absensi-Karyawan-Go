<li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-single-04"></i><span
            class="nav-text">Karyawan</span></a>
    <ul aria-expanded="false">
        <li><a href="{{ route('admin.employees.index') }}">Daftar Karyawan</a></li>
        <li><a href="{{ route('admin.employees.attendance') }}">Absensi Karyawan</a></li>
        <li><a href="{{ route('admin.leaves.index') }}">Cuti Karyawan</a></li>
    </ul>
</li>
<li><a href="{{route('admin.recap.index')}}" aria-expanded="false"><i class="ti ti-file"></i><span class="nav-text">Rekapitulasi
            Absensi</span></a></li>
