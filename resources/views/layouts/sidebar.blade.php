<div class="aside">
        <div class="aside-header">
            <h3 class="aside-title"><img src="{{ asset('/') }}./assets/images/icon.png" width="50" alt=""> AIS-ONLINE</h3>

            <div class="aside-addon">
                <button class="btn btn-label-success btn-icon btn-lg" data-toggle="aside">
                    <i class="fa fa-times aside-icon-minimize"></i>

                    <i class="fa fa-thumbtack aside-icon-maximize"></i>


                </button>
            </div>
        </div>
        <div class="aside-body" data-simplebar data-simplebar-direction="ltr">
            <!-- BEGIN Menu -->
            <div class="menu">

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

                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle {{
                        Request::is('report-vendor-load') || Request::is('supir-mobil') ||
                        Request::is('report-vendor-discharge') ||
                        Request::is('report-vendor-trucking')
                         ? 'active' : ''}}">
                            <div class="menu-item-icon">
                                <i class="bi bi-truck-front-fill"></i>
                            </div>
                            <span class="menu-item-text">VENDOR MOBIL TRUCK</span>
                            <div class="menu-item-addon">
                                <i class="menu-item-caret caret"></i>
                            </div>
                        </button>


                    <div class="menu-submenu">

                        <div class="menu-item">
                            <a href="/supir-mobil" data-menu-path="/supir-mobil" class="menu-item-link {{ Request::is('rekening-bank*') ? 'active' : '' }}">
                                <div class="menu-item-icon">
                                    <i class="menu-item-bullet"></i>
                                </div>
                                <span class="menu-item-text">DATA</span>
                            </a>

                        </div>
                        <div class="menu-item">
                            <button class="menu-item-link menu-item-toggle
                            {{
                                Request::is('report-vendor-load') || Request::is('report-vendor-discharge')
                                || Request::is('report-vendor-trucking')
                                ? 'active' : ''
                            }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REPORT</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                            <!-- BEGIN Menu Submenu -->
                            <div class="menu-submenu">
                                <div class="menu-item">
                                    <a href="/report-vendor-load" data-menu-path="/datatable/basic/base.html" class="menu-item-link {{  Request::is('report-vendor-load') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">LOAD</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/report-vendor-discharge" data-menu-path="/datatable/basic/footer.html" class="menu-item-link {{  Request::is('report-vendor-discharge') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">DISCHARGE</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/report-vendor-trucking" data-menu-path="/datatable/basic/scrollable.html" class="menu-item-link {{  Request::is('report-vendor-trucking') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">TRUCKING</span>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>



                <div class="menu-item">
                    <a href="/ongkos-supir" data-menu-path="/ongkos-supir" class="menu-item-link {{ Request::is('ongkos-supir*') ? 'active' : '' }}">
                        <div class="menu-item-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <span class="menu-item-text">DEPOSIT TRUCKING</span>
                    </a>

                </div>



                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle
                    {{
                        Request::is('seal') || Request::is('damage-seal') || Request::is('report-seal')
                        ? 'active' : ''

                        }}

                    ">
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
                            <a href="/seal" data-menu-path="/seal" class="menu-item-link
                            {{ Request::is('seal') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">INPUT SEAL</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/damage-seal" data-menu-path="" class="menu-item-link {{ Request::is('damage-seal') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">DAMAGE SEAL</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/report-seal" data-menu-path="" class="menu-item-link {{ Request::is('report-seal') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REPORT & STOCK SEAL</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>

                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle
                    {{
                        Request::is('spk') || Request::is('report-spk')
                        ? 'active' : ''

                        }}

                    ">
                        <div class="menu-item-icon">
                            <i class="fa fa-list-ol"></i>
                        </div>
                        <span class="menu-item-text">SPK</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="/spk" data-menu-path="/spk" class="menu-item-link
                            {{ Request::is('spk') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">INPUT SPK</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="/report-spk" data-menu-path="" class="menu-item-link {{ Request::is('report-spk') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REPORT & STOCK SPK</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>




                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle
                    {{
                    Request::is('planload') || Request::is('planload/*') || Request::is('planload-edit/*') ||
                    Request::is('processload') || Request::is('processload-create/*') ||
                    Request::is('realisasi-load') || Request::is('realisasi-load-create/*') || Request::is('processload-edit/*')
                    || Request::is('realisasi-pod') || Request::is('realisasi-pod-create/*')
                     ? 'active' : ''

                    }}">
                        <div class="menu-item-icon">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <span class="menu-item-text">LOAD</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="/planload" data-menu-path="" class="menu-item-link {{ Request::is('planload/*') ||  Request::is('planload') || Request::is('planload-edit/*') ? 'active' : ''  }} ">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">LOAD-PLAN</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/processload" data-menu-path="/elements/advanced/block-ui.html" class="menu-item-link {{ Request::is('processload') || Request::is('processload-create/*') || Request::is('processload-edit/*') ? 'active' : ''
                        }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">LOAD-PROCESS</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/realisasi-load" data-menu-path="/elements/advanced/carousel.html" class="menu-item-link {{ Request::is('realisasi-load') || Request::is('realisasi-load-create/*')
                            ? 'active' : ''}}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REALISASI POL</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/realisasi-pod" data-menu-path="/elements/advanced/carousel.html" class="menu-item-link {{ Request::is('realisasi-pod') || Request::is('realisasi-pod-create/*')
                            ? 'active' : ''}}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">REALISASI POD</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>
                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle
                    {{
                    Request::is('plandischarge') || Request::is('plandischarge/*') || Request::is('plandischarge-edit/*') ||
                    Request::is('processdischarge') || Request::is('processdischarge-create/*') ||
                    Request::is('realisasi-discharge') || Request::is('realisasi-discharge-create/*')
                     ? 'active' : ''

                    }}">                        <div class="menu-item-icon">
                            <i class="fa fa-external-link-square"></i>
                        </div>
                        <span class="menu-item-text">DISCHARGE</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="/plandischarge" data-menu-path="" class="menu-item-link {{ Request::is('plandischarge') || Request::is('plandischarge/*') || Request::is('plandischarge-edit/*') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">DISCHARGE-PLAN</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/processdischarge" data-menu-path="" class="menu-item-link {{ Request::is('processdischarge') || Request::is('processdischarge-create/*') ? 'active' : ''}}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">DISCHARGE-PROCESS</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/realisasi-discharge" data-menu-path="" class="menu-item-link {{ Request::is('realisasi-discharge') || Request::is('realisasi-discharge-create/*') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">DISCHARGE-REALISASI</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>

                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle
                    {{
                    Request::is('truckingplan') || Request::is('truckingplan/*') || Request::is('plantrucking-edit/*') ||
                    Request::is('truckingprocess') || Request::is('truckingprocess-create/*') ||
                    Request::is('realisasi-trucking') || Request::is('truckingrealisasi-create/*')
                     ? 'active' : ''

                    }}">                          <div class="menu-item-icon">
                            <i class="fa fa-truck"></i>
                        </div>
                            <span class="menu-item-text">TRUCKING</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="/truckingplan" data-menu-path="" class="menu-item-link {{ Request::is('truckingplan') || Request::is('truckingplan/*') || Request::is('plantrucking-edit/*') ? 'active' : ''  }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">TRUCKING-PLAN</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/truckingprocess" data-menu-path="" class="menu-item-link {{ Request::is('truckingprocess') || Request::is('truckingprocess-create/*') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">TRUCKING-PROCESS</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/realisasi-trucking" data-menu-path="" class="menu-item-link {{ Request::is('realisasi-trucking') || Request::is('truckingrealisasi-create/*') ? 'active' : '' }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">TRUCKING-REALISASI</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>



                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle {{
                        Request::is('invoice-load') || Request::is('invoice-discharge') || Request::is('invoice-trucking') ||
                        Request::is('invoice-load-create/*') || Request::is('invoice-discharge-create/*') || Request::is('invoice-trucking-create/*')
                        ? 'active' : '' }}">
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
                            <a href="/invoice-load" data-menu-path="" class="menu-item-link {{ Request::is('invoice-load') || Request::is('invoice-load-create/*') ? 'active' : ''}}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">LOAD INV</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="/invoice-discharge" data-menu-path="" class="menu-item-link {{ Request::is('invoice-discharge') || Request::is('invoice-discharge-create/*') ? 'active' : ''}}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">DISCHARGE INV</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/invoice-trucking" data-menu-path="" class="menu-item-link {{ Request::is('invoice-trucking') || Request::is('invoice-trucking-create/*') ? 'active' : ''}}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">TRUCKING INV</span>
                            </a>
                        </div>



                    </div>
                    <!-- END Menu Submenu -->
                </div>
                <div class="menu-item">
                    <button class="menu-item-link menu-item-toggle {{
                    Request::is('summary-report-load') || Request::is('cost-report-load') || Request::is('container-report-load') ||
                    Request::is('summary-report-discharge') || Request::is('cost-report-discharge') || Request::is('container-report-discharge') ||
                    Request::is('summary-report-trucking') || Request::is('cost-report-trucking') || Request::is('container-report-trucking')
                     ? 'active' : ''}}">
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
                            <button class="menu-item-link menu-item-toggle
                            {{
                                Request::is('cost-report-load') || Request::is('cost-report-discharge')
                                || Request::is('cost-report-trucking')
                                ? 'active' : ''
                            }}">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">COST REPORT</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                            <!-- BEGIN Menu Submenu -->
                            <div class="menu-submenu">
                                <div class="menu-item">
                                    <a href="/cost-report-load" data-menu-path="/datatable/basic/base.html" class="menu-item-link {{  Request::is('cost-report-load') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">LOAD</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/cost-report-discharge" data-menu-path="/datatable/basic/footer.html" class="menu-item-link {{  Request::is('cost-report-discharge') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">DISCHARGE</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/cost-report-trucking" data-menu-path="/datatable/basic/scrollable.html" class="menu-item-link {{  Request::is('cost-report-trucking') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">TRUCKING</span>
                                    </a>
                                </div>

                            </div>

                        </div>

                        <div class="menu-item">
                            <button class="menu-item-link menu-item-toggle
                            {{
                                Request::is('summary-report-load') || Request::is('summary-report-discharge')
                                || Request::is('summary-report-trucking')
                                ? 'active' : ''
                            }}
                            ">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">SUMMARY REPORT</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                            <!-- BEGIN Menu Submenu -->
                            <div class="menu-submenu">
                                <div class="menu-item">
                                    <a href="/summary-report-load" data-menu-path="/summary-report-load" class="menu-item-link {{  Request::is('summary-report-load') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">LOAD</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/summary-report-discharge" data-menu-path="/datatable/basic/footer.html" class="menu-item-link {{  Request::is('summary-report-discharge') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">DISCHARGE</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/summary-report-trucking" data-menu-path="/datatable/basic/scrollable.html" class="menu-item-link {{  Request::is('summary-report-trucking') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">TRUCKING</span>
                                    </a>
                                </div>

                            </div>

                        </div>
                        <div class="menu-item">
                            <button class="menu-item-link menu-item-toggle
                            {{
                                Request::is('container-report-load') || Request::is('container-report-discharge')
                                || Request::is('container-report-trucking')
                                ? 'active' : ''
                            }}

                            ">
                                <i class="menu-item-bullet"></i>
                                <span class="menu-item-text">CONTAINER REPORT</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                            <!-- BEGIN Menu Submenu -->
                            <div class="menu-submenu">
                                <div class="menu-item">
                                    <a href="/container-report-load" data-menu-path="/datatable/basic/base.html" class="menu-item-link {{  Request::is('container-report-load') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">LOAD</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/container-report-discharge" data-menu-path="/datatable/basic/footer.html" class="menu-item-link {{  Request::is('container-report-discharge') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">DISCHARGE</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="/container-report-trucking" data-menu-path="/datatable/basic/scrollable.html" class="menu-item-link {{  Request::is('container-report-trucking') ? 'active' : ''}}">
                                        <i class="menu-item-bullet"></i>
                                        <span class="menu-item-text">TRUCKING</span>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- END Menu Submenu -->
                </div>

            </div>
            <!-- END Menu -->
            </div>
            <div class="aside-addon">

                <img class="aside-icon-maximize" src="{{ asset('/') }}./assets/images/icon.png" width="50" alt="">
            </div>


        </div>


</div>
