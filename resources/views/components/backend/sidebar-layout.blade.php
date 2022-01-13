<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('admin.dashboard')}}" class="brand-link">
            <img src="{{asset('assets/adminlte/dist/img/AdminLTELogo.png')}}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('assets/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Administrator</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    @if(Auth::user()->role_id == '1')
                        <li class="nav-header">MASTER DATA</li>

                        <li class="nav-item">
                            <a href="{{route('admin.penyakit')}}"
                               class="nav-link {{($tagSubMenu == 'penyakit')?"active":"";}}">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA PENYAKIT
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.gejala')}}" class="nav-link {{($tagSubMenu == 'gejala')?"active":"";}}">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA GEJALA
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../gallery.html" class="nav-link">
                                <i class="nav-icon fa fa-clipboard-list"></i>
                                <p>
                                    DATA PRODUK
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
