<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            @can('admin-access')
                <li><a href="{{route('admin.index')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                            class="nav-text">Dashboard</span></a></li>
                @include('includes.admin.sidebar_items')
            @endcan

            @can('employee-access')
                <li><a href="{{ route('employee.index') }}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                            class="nav-text">Dashboard</span></a></li>
                @include('includes.employee.sidebar_items')
            @endcan
        </ul>
    </div>
</div>
