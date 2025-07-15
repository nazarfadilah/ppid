<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                        <i class="mdi me-2 mdi-gauge"></i><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('pages-profile') ? 'active' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                        <i class="mdi me-2 mdi-account-check"></i><span class="hide-menu">Profile</span>
                    </a>
                </li>
               
             
                
                <li class="sidebar-item {{ Request::is('quizzesKecermatan') ? 'active' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                        <i class="mdi mdi-history"></i><span class="hide-menu"> Pengajuan Keberatan</span>
                    </a>
                </li>
                
                <li class="sidebar-item {{ Request::is('quizzesKecermatan') ? 'active' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                        <i class="mdi mdi-history"></i><span class="hide-menu"> Permohonan Informasi</span>
                    </a>
                </li>
                
                <li class="sidebar-item {{ Request::is('quizzesKecermatan') ? 'active' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                        <i class="mdi mdi-history"></i><span class="hide-menu"> Laporan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('gallery') ? 'active' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('galleries.index') }}" aria-expanded="false">
                        <i class="mdi mdi-image-album"></i><span class="hide-menu"> Gallery</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <a class="sidebar-link waves-effect waves-dark sidebar-link">
                            <button type="submit" aria-expanded="false" style="background: none; border: none; padding: 0; color: inherit; cursor: pointer;">
                                <i class="mdi me-2 mdi-logout"></i>
                                <span class="hide-menu">Logout</span>
                            </button>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <div class="sidebar-footer">
       
    </div>
</aside>
