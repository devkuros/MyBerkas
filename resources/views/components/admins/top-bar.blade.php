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
                <li class="menu single-menu {{ set_active('roles.index') }}{{ set_active('assignments.create') }}{{ set_active('permission.index') }}{{ set_active('assign.create') }}">
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
                        <li class="{{ set_active('assign.create') }}">
                            <a href="{{route('assign.create')}}"> User Role </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('layanan surat')
                <li class="menu single-menu {{ set_active('arsip.index') }}{{ set_active('cetak.index') }}{{ set_active('template.index') }}{{ set_active('pengaturan.index') }}">
                    <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                            <span>Layanan Surat</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="layanansurat" data-parent="#topAccordion">
                            <li class="{{ set_active('template.index') }}">
                                <a href="{{route('template.index')}}"> Template Surat </a>
                            </li>
                            <li class="{{ set_active('pengaturan.index') }}">
                                <a href="{{route('pengaturan.index')}}"> Pengaturan Surat </a>
                            </li>
                            <li class="{{ set_active('cetak.index') }}">
                                <a href="{{route('cetak.index')}}"> Cetak Surat </a>
                            </li>
                            <li class="{{ set_active('arsip.index') }}">
                                <a href="{{route('arsip.index')}}"> Arsip Surat </a>
                            </li>
                    </ul>
                </li>
                @endcan

                @can('assign surat')
                <li class="menu single-menu {{ set_active('category.index') }}{{ set_active('masuks.index') }}{{ set_active('keluars.index') }}">
                    <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                            <span>Data Master</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="suratmasuk" data-parent="#topAccordion">
                        @can('assign category')
                            <li class="{{ set_active('category.index') }}">
                                <a href="{{route('category.index')}}"> Kategori Surat </a>
                            </li>
                        @endcan
                        <li class="{{ set_active('masuks.index') }}">
                            <a href="{{route('masuks.index')}}"> Surat Masuk </a>
                        </li>
                        <li class="{{ set_active('keluars.index') }}">
                            <a href="{{route('keluars.index')}}"> Surat Keluar </a>
                        </li>
                    </ul>
                </li>

                <li class="menu single-menu {{ set_active('industri.keluar') }}{{ set_active('fakultas.keluar') }}{{ set_active('fakultas.index') }}{{ set_active('industri.index') }}">
                    <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                            <span>Arsip Surat</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="suratmasuk" data-parent="#topAccordion">

                        <li class="sub-sub-submenu-list {{ set_active('fakultas.index') }}{{ set_active('industri.index') }}">
                            <a href="#starter-kit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Surat Masuk <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                            <ul class="collapse list-unstyled sub-submenu eq-animated eq-fadeInUp" id="starter-kit" data-parent="#more">
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

                        <li class="sub-sub-submenu-list {{ set_active('industri.keluar') }}{{ set_active('fakultas.keluar') }}">
                            <a href="#starter-kit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Surat Keluar <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                            <ul class="collapse list-unstyled sub-submenu eq-animated eq-fadeInUp" id="starter-kit" data-parent="#more">
                                <li class="{{ set_active('fakultas.keluar') }}">
                                    <a href="{{route('fakultas.keluar')}}"> Fakultas Teknologi Industri </a>
                                </li>
                                <li class="{{ set_active('industri.keluar') }}">
                                    <a href="{{route('industri.keluar')}}"> Teknik Industri </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
                @endcan

                @hasrole('super admin')
                <li class="menu single-menu {{ set_active('admin.jabatan') }}{{ set_active('admin.pejabat') }}">
                    <a href="#" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span>Admin Menu</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="adminmeny" data-parent="#topAccordion">
                        <li class="sub-sub-submenu-list {{ set_active('admin.jabatan') }}{{ set_active('admin.pejabat') }}">
                            <a href="#starter-kit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Pejabat <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                            <ul class="collapse list-unstyled sub-submenu eq-animated eq-fadeInUp" id="starter-kit" data-parent="#more">
                                <li class="{{ set_active('admin.jabatan') }}">
                                    <a href="{{route('admin.jabatan')}}"> Jabatan </a>
                                </li>
                                <li class="{{ set_active('admin.pejabat') }}">
                                    <a href="{{route('admin.pejabat')}}"> Pejabat </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
                @endhasrole

            </ul>
        </nav>
    </div>
@endhasanyrole
<!--  END TOPBAR  -->
