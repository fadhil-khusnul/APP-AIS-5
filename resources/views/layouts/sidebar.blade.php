<div class="aside">
        <div class="aside-header">
            <h3 class="aside-title">APP AIS-5</h3>
            <div class="aside-addon">
                <button class="btn btn-label-primary btn-icon btn-lg" data-toggle="aside">
                    <i class="fa fa-times aside-icon-minimize"></i>
                    <i class="fa fa-thumbtack aside-icon-maximize"></i>
                </button>
            </div>
        </div>
        <div class="aside-body" data-simplebar data-simplebar-direction="ltr">
            <!-- BEGIN Menu -->
            <div class="menu">
                {{-- <div class="menu-item">
                    <a href="index.html" data-menu-path="/index.html" class="menu-item-link">
                        <div class="menu-item-icon">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <span class="menu-item-text">Dashboard</span>
                        <div class="menu-item-addon">
                            <span class="badge badge-success">New</span>
                        </div>
                    </a>
                </div> --}}
                <!-- BEGIN Menu Section -->
                <div class="menu-section">
                    <div class="menu-section-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </div>
                    <h2 class="menu-section-text">MENU</h2>
                </div>
                <!-- END Menu Section -->
                <div class="menu-item">
                    <a href="/data" data-menu-path="/data" class="menu-item-link {{ Request::is('data*') ? 'active' : '' }}">
                        <div class="menu-item-icon">
                            <i class="fa fa-folder-open"></i>
                        </div>
                        <span class="menu-item-text">DATA</span>
                    </a>
                </div>



                {{-- <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle">
                        <div class="menu-item-icon">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <span class="menu-item-text">MONITORING</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="elements/advanced/avatar.html" data-menu-path="/elements/advanced/avatar.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REASON OF CANCELATION</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="elements/advanced/block-ui.html" data-menu-path="/elements/advanced/block-ui.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">CANCEL</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="elements/advanced/carousel.html" data-menu-path="/elements/advanced/carousel.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REPORT CANCEL</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div> --}}
                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle">
                        <div class="menu-item-icon">
                            <i class="fa fa-ban"></i>
                        </div>
                        <span class="menu-item-text">SEAL</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="/seal" data-menu-path="/seal" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">INPUT SEAL</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="elements/advanced/block-ui.html" data-menu-path="/elements/advanced/block-ui.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">DAMAGE SEAL</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="elements/advanced/carousel.html" data-menu-path="/elements/advanced/carousel.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REPORT & STOCK SEAL</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>

                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle">
                        <div class="menu-item-icon">
                            <i class="far fa-clone"></i>
                        </div>
                        <span class="menu-item-text">ACTIVITY</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <button class="menu-item-link menu-item-toggle {{ Request::is('planload/*') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">JOB ORDER PLAN</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                            <!-- BEGIN Menu Submenu -->
                            <div class="menu-submenu">
                                <div class="menu-item">
                                    <a href="/planload" data-menu-path="/planload" class="menu-item-link {{ Request::is('/planload/*') || Request::is('planload/create') ? 'active' : '' }}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">LOAD</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/plandischarge" data-menu-path="/plandischarge" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">DISCHARGE</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/plandischarge" data-menu-path="/plandischarge" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">TRUCKING</span>
                                    </a>
                                </div>

                            </div>
                            <!-- END Menu Submenu -->
                        </div>
                        <div class="menu-item">
                            <button class="menu-item-link menu-item-toggle">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">JOB ORDER PROCESS</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                            <!-- BEGIN Menu Submenu -->
                            <div class="menu-submenu">
                                <div class="menu-item">
                                    <a href="/processload" data-menu-path="/processload" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">LOAD</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/processload" data-menu-path="/processload" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">ALIH KAPAL</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/processload" data-menu-path="/processload" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">BATAL MUAT</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="datatable/advanced/column-visibility.html" data-menu-path="/datatable/advanced/column-visibility.html" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">DISCHARGE</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="datatable/advanced/column-visibility.html" data-menu-path="/datatable/advanced/column-visibility.html" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">TRUKCING</span>
                                    </a>
                                </div>

                            </div>
                            <!-- END Menu Submenu -->
                        </div>
                        <div class="menu-item">
                            <button class="menu-item-link menu-item-toggle">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">JOB ORDER REALISASI</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                            <!-- BEGIN Menu Submenu -->
                            <div class="menu-submenu">
                                <div class="menu-item">
                                    <a href="datatable/advanced/column-rendering.html" data-menu-path="/datatable/advanced/column-rendering.html" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">LOAD</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="datatable/advanced/column-visibility.html" data-menu-path="/datatable/advanced/column-visibility.html" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">DISCHARGE</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="datatable/advanced/column-visibility.html" data-menu-path="/datatable/advanced/column-visibility.html" class="menu-item-link">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">TRUCKING</span>
                                    </a>
                                </div>

                            </div>
                            <!-- END Menu Submenu -->
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>

                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle">
                        <div class="menu-item-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <span class="menu-item-text">INVOICE</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="elements/advanced/avatar.html" data-menu-path="/elements/advanced/avatar.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">CREATE INV</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="elements/advanced/block-ui.html" data-menu-path="/elements/advanced/block-ui.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">DAILY OPERATIONAL COST</span>
                            </a>
                        </div>


                    </div>
                    <!-- END Menu Submenu -->
                </div>
                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle">
                        <div class="menu-item-icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <span class="menu-item-text">REPORT</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="elements/advanced/avatar.html" data-menu-path="/elements/advanced/avatar.html" class="menu-item-link">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REPORT JOB ORDER</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>

            </div>
            <!-- END Menu -->
            </div>
        </div>
</div>
