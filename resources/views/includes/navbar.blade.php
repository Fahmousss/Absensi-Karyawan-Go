<!-- Navbar -->

<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    {{-- Blank Space --}}
                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item flex items-center font-light">
                        <p class="mb-0">{{ Auth::user()->name }}</p>
                    </li>
                    <li class="nav-item dropdown header-profile">
                        
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            @if (Auth::user()->employee)
                                        <img src="{{ asset( 'folder_photo/'. Auth::user()->employee->photo ) }}" class=" rounded-circle " alt="User Image" />
                                        @else
                                        <img src="{{asset('/images/pasfoto.jpg')}}" class=" rounded-circle " alt="User Image">
                                        @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if ( Auth::user()->employee )
                            <a href="{{ route('employee.profile-edit', $employee->id) }}" class="dropdown-item">
                                <i class="icon-user"></i>
                                <span class="ml-2">Profile </span>
                            </a>
                            @else
                            
                            
                            @endif
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="icon-key"></i>
                                <span class="ml-2">Logout </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </div>
</div>