<!--  BEGIN TOPBAR  -->
@hasanyrole($roles)
    <div class="topbar-nav header navbar" role="banner">
        <nav id="topbar">
            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="/">
                        <img src="assets/img/90x90.jpg" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="/" class="nav-link"> MyBerkas </a>
                </li>
            </ul>

            <ul class="list-unstyled menu-categories" id="topAccordion">

                <li class="menu single-menu {{ set_active('dashboard') }}">
                    <a href="{{ route('dashboard') }}" aria-expanded="true">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>

                @can('assign permission')
                <li class="menu single-menu {{ set_active('roles.index') }}{{ set_active('assignments.create') }}{{ set_active('permission.index') }}">
                    <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            <span>Role & Permission</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="suratmasuk" data-parent="#topAccordion">
                        <li class="{{ set_active('roles.index') }}">
                            <a href="{{route('roles.index')}}"> Role </a>
                        </li>
                        <li class="{{ set_active('permission.index') }}">
                            <a href="{{route('permission.index')}}"> Permission </a>
                        </li>
                        <li class="{{ set_active('assignments.create') }}">
                            <a href="{{route('assignments.create')}}"> Assignment </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('assign surat')
                <li class="menu single-menu {{ set_active('category.index') }}{{ set_active('masuks.index') }}">
                    <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                            <span>Data Master</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="suratmasuk" data-parent="#topAccordion">
                        <li class="{{ set_active('category.index') }}">
                            <a href="{{route('category.index')}}"> Kategori Surat </a>
                        </li>
                        <li class="{{ set_active('masuks.index') }}">
                            <a href="{{route('masuks.index')}}"> Surat Masuk </a>
                        </li>
                    </ul>
                </li>

                <li class="menu single-menu {{ set_active('fakultas.index') }}{{ set_active('industri.index') }}">
                    <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                            <span>Surat Masuk</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="suratmasuk" data-parent="#topAccordion">
                        @can('fti')
                            <li class="{{ set_active('fakultas.index') }}">
                                <a href="{{route('fakultas.index')}}"> Fakultas Teknologi Industri </a>
                            </li>
                        @endcan

                        @can('teknik industri')
                            <li class="{{ set_active('industri.index') }}">
                                <a href="{{route('industri.index')}}"> Teknik Industri </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan

            </ul>
        </nav>
    </div>
@endhasanyrole
<!--  END TOPBAR  -->
