<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) == null ? '' : 'collapsed' }}" href="{{ route('admin') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @foreach(\App\Enums\ResourcesEnum::NAMES as $resource)
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) == $resource ? '' : 'collapsed' }}" data-bs-target="#{{$resource}}-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>{{ ucfirst($resource) }}</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="{{$resource}}-nav" class="nav-content {{ request()->segment(2) == $resource ? 'show' : 'collapse' }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ request()->segment(2) == $resource && request()->segment(3) == 'create' ? 'active' : '' }}" href="{{ route($resource.'.create') }}">
                            <i class="bi bi-circle"></i><span>Create</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->segment(2) == $resource && !request()->segment(3)? 'active' : '' }}" href="{{ route($resource.'.index') }}">
                            <i class="bi bi-circle"></i><span>List</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endforeach
    </ul>

</aside>
