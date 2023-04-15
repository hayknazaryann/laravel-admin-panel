<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#companies-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Companies</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="companies-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('companies.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('companies.index') }}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#employees-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Employees</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="employees-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('employees.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('employees.index') }}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>

</aside>
