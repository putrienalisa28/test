<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="" data-template="vertical-menu-template-no-customizer">

<head>

    <style>
        .small-cell {
            width: 0px;
            font-size: 0px;
            padding: 0;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        .txt {
            border: 1px solid #fff;
            width: 100%;
        }
    </style>

    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ENV('APP_NAME') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"> -->

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('vendor/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/fonts/tabler-icons.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/fonts/flag-icons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('vendor/css/rtl/core.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/css/rtl/theme-default.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('vendor/css/rtl/theme-semi-dark.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/node-waves/node-waves.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">


    <link rel="stylesheet" href="{{ url('vendor/sweetalert2/dist/sweetalert2.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ url('vendor/libs/sweetalert2/sweetalert2.css') }}" /> --}}
    <link rel="stylesheet" href="{{ url('vendor/libs/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/typeahead-js/typeahead.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/nouislider/nouislider.css') }}">
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('vendor/css/pages/app-chat.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/libs/spinkit/spinkit.css') }}" />


    <!-- Helpers -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ url('vendor/js/helpers.js') }}"></script>


    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('js/config.js') }}"></script>
    <script src="{{ url('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    {{-- <script src="{{ url('vendor/libs/sweetalert2/sweetalert2.js') }}"></script> --}}
    <script>
        function swAlertConfirm(url, title = "Are you sure?", text = "It will be saved!", data = []) {
            // alert(data);
            $(".btn-save").attr('disabled', true);
            $(".btn-save").html('Loading...');
            Swal.fire({
                title: title,
                text: "It will be saved!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve) => {
                        // Simulasikan proses penyimpanan data di sini
                        var formData = data;
                        $.ajax({
                            url: String(url),
                            type: "POST",
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);
                                Swal.fire('Success!', String(response.message),
                                    'success');
                                if (response.code == 200) {
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire('Error : ' + String(response.code), String(
                                        response
                                        .message), 'warning');
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 2000);
                                }
                                $(".btn-save").attr('disabled', false);
                                $(".btn-save").html('Save');
                            },
                            error: function(xhr, text) {
                                console.log(xhr);
                                Swal.fire('Error : ' + String(xhr.responseJSON.code),
                                    String(xhr
                                        .responseJSON
                                        .message), 'error');
                                $(".btn-save").attr('disabled', false);
                                $(".btn-save").html('Save');
                            }
                        });
                    });
                },
            }).then((result) => {
                if (!result.isConfirmed) {
                    $(".btn-save").attr('disabled', false);
                    $(".btn-save").html('Save');
                }
            });
        }
    </script>





</head>

<body>

    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->

            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="container-fluid">
                    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                        <a href="index.html" class="app-brand-link gap-2">
                            {{-- <span class="app-brand-logo demo"> --}}
                            <img src="{{ url('img/mca.jpg') }}" style="height: 50px;">
                            {{-- </span> --}}
                            <span class="app-brand-text demo menu-text fw-bold">SEWING SYSTEM</span>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                            <i class="ti ti-x ti-sm align-middle"></i>
                        </a>
                    </div>

                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">


                            <!-- Style Switcher -->
                            <li class="nav-item me-2 me-xl-0">
                                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                    <i class="ti ti-md"></i>
                                </a>
                            </li>
                            <!--/ Style Switcher -->

                            <!-- Quick links  -->
                            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="ti ti-layout-grid-add ti-md"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end py-0">
                                    <div class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                                            <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Add shortcuts"><i class="ti ti-sm ti-apps"></i></a>
                                        </div>
                                    </div>
                                    <div class="dropdown-shortcuts-list scrollable-container">
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-calendar fs-4"></i>
                                                </span>
                                                <a href="app-calendar.html" class="stretched-link">Calendar</a>
                                                <small class="text-muted mb-0">Appointments</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-file-invoice fs-4"></i>
                                                </span>
                                                <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                                                <small class="text-muted mb-0">Manage Accounts</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-users fs-4"></i>
                                                </span>
                                                <a href="app-user-list.html" class="stretched-link">User App</a>
                                                <small class="text-muted mb-0">Manage Users</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-lock fs-4"></i>
                                                </span>
                                                <a href="app-access-roles.html" class="stretched-link">Role
                                                    Management</a>
                                                <small class="text-muted mb-0">Permission</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-chart-bar fs-4"></i>
                                                </span>
                                                <a href="index.html" class="stretched-link">Dashboard</a>
                                                <small class="text-muted mb-0">User Profile</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-settings fs-4"></i>
                                                </span>
                                                <a href="pages-account-settings-account.html"
                                                    class="stretched-link">Setting</a>
                                                <small class="text-muted mb-0">Account Settings</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-help fs-4"></i>
                                                </span>
                                                <a href="pages-help-center-landing.html" class="stretched-link">Help
                                                    Center</a>
                                                <small class="text-muted mb-0">FAQs & Articles</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-square fs-4"></i>
                                                </span>
                                                <a href="modal-examples.html" class="stretched-link">Modals</a>
                                                <small class="text-muted mb-0">Useful Popups</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- Quick links -->

                            <!-- Notification -->
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="ti ti-bell ti-md"></i>
                                    <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end py-0">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            {{-- <img src="../../assets/img/avatars/1.png" alt
                                                                class="h-auto rounded-circle" /> --}}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                                                        <p class="mb-0">Won the monthly best seller gold badge</p>
                                                        <small class="text-muted">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Charles Franklin</h6>
                                                        <p class="mb-0">Accepted your connection</p>
                                                        <small class="text-muted">12hr ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            {{-- <img src="../../assets/img/avatars/2.png" alt
                                                                class="h-auto rounded-circle" /> --}}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">New Message ✉️</h6>
                                                        <p class="mb-0">You have new message from Natalie</p>
                                                        <small class="text-muted">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="ti ti-shopping-cart"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                                                        <p class="mb-0">ACME Inc. made new order $1,154</p>
                                                        <small class="text-muted">1 day ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            {{-- <img src="../../assets/img/avatars/9.png" alt
                                                                class="h-auto rounded-circle" /> --}}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Application has been approved 🚀</h6>
                                                        <p class="mb-0">Your ABC project application has been
                                                            approved.</p>
                                                        <small class="text-muted">2 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="ti ti-chart-pie"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Monthly report is generated</h6>
                                                        <p class="mb-0">July monthly financial report is generated
                                                        </p>
                                                        <small class="text-muted">3 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            {{-- <img src="../../assets/img/avatars/5.png" alt
                                                                class="h-auto rounded-circle" /> --}}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Send connection request</h6>
                                                        <p class="mb-0">Peter sent you connection request</p>
                                                        <small class="text-muted">4 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            {{-- <img src="../../assets/img/avatars/6.png" alt
                                                                class="h-auto rounded-circle" /> --}}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">New message from Jane</h6>
                                                        <p class="mb-0">Your have new message from Jane</p>
                                                        <small class="text-muted">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-warning"><i
                                                                    class="ti ti-alert-triangle"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">CPU is running high</h6>
                                                        <p class="mb-0">CPU Utilization Percent is currently at
                                                            88.63%,</p>
                                                        <small class="text-muted">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-menu-footer border-top">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                                            View all notifications
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ Notification -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link
                                dropdown-toggle hide-arrow me-auto"
                                    href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online mx-auto">
                                        <img src="{{ asset('img/avatars/user.png') }}" alt
                                            class="h-auto rounded-circle" />
                                    </div>
                                </a>
                            </li>
                            <span class="fw-semibold d-inline-block ">Putri Ena Lisa (Prgorammer)</span>

                            <li class="nav-item me-3 me-xl-1">
                                <a class="nav-link hide-arrow" href="{{ route('logout') }}"><i
                                        class="ti ti-logout ti-md"></i></a>
                            </li>

                            <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
                        <input type="text" class="form-control search-input border-0" placeholder="Search..."
                            aria-label="Search..." />
                        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                    </div>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Menu -->
                    <aside id="layout-menu" style="z-index: 1000;"
                        class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                        <div class="container-fluid d-flex h-100">
                            <ul class="menu-inner">
                                <!-- Dashboards -->
                                <li class="menu-item">
                                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                        <div data-i18n="Dashboards">Dashboards</div>
                                    </a>

                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="index.html" class="menu-link">
                                                <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                                                <div data-i18n="Analytics">Analytics</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="dashboards-crm.html" class="menu-link">
                                                <i class="menu-icon tf-icons ti ti-3d-cube-sphere"></i>
                                                <div data-i18n="CRM">CRM</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="dashboards-ecommerce.html" class="menu-link">
                                                <i class="menu-icon tf-icons ti ti-atom-2"></i>
                                                <div data-i18n="eCommerce">eCommerce</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>



                                <!-- Apps -->
                                {{-- @foreach ($menuHeaders as $key => $item)
                                    <li class="menu-item ">
                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                            <i class="menu-icon tf-icons {{ $item->icon }}"></i>
                                            <div data-i18n="Apps">{{ $item->menuhdr_title }}</div>
                                        </a>
                                        <ul class="menu-sub" style="width: 350px;">


                                            @foreach ($item->subMenus as $key => $subMenu)
                                                <li class="menu-item w-100">
                                                    <a href="{{ asset($subMenu->menudtl_link) }}"
                                                        class="menu-link {{ count($subMenu->subMenuDetails) > 0 ? 'menu-toggle' : '' }}">
                                                        <i
                                                            class="menu-icon tf-icons ti {{ count($subMenu->subMenuDetails) > 0 ? 'ti-corner-down-right-double' : 'ti-point' }}"></i>
                                                        <div data-i18n="Invoice">{{ $subMenu->menudtl_title }}</div>
                                                    </a>
                                                    @foreach ($subMenu->subMenuDetails as $key => $detail)
                                                        <ul class="menu-sub">
                                                            @foreach ($subMenu->subMenuDetails as $key => $detail)
                                                                <li class="menu-item w-100">
                                                                    <a href="{{ asset($detail->menudtlsub_link) }}"
                                                                        class="menu-link">
                                                                        <div data-i18n="List">
                                                                            {{ $detail->menudtlsub_title }}</div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endforeach
                                                </li>
                                            @endforeach --}}
                                            {{-- <li class="menu-item">
                                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                                    <i class="menu-icon tf-icons ti ti-users"></i>
                                                    <div data-i18n="Users">Users</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="app-user-list.html" class="menu-link">
                                                            <div data-i18n="List">List</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                                            <div data-i18n="View">View</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="app-user-view-account.html"
                                                                    class="menu-link">
                                                                    <div data-i18n="Account">Account</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="app-user-view-security.html"
                                                                    class="menu-link">
                                                                    <div data-i18n="Security">Security</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="app-user-view-billing.html"
                                                                    class="menu-link">
                                                                    <div data-i18n="Billing & Plans">Billing & Plans
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="app-user-view-notifications.html"
                                                                    class="menu-link">
                                                                    <div data-i18n="Notifications">Notifications</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="app-user-view-connections.html"
                                                                    class="menu-link">
                                                                    <div data-i18n="Connections">Connections</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li> --}}
                                            <li class="menu-item">
                                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                                    <i class="menu-icon tf-icons ti ti-settings"></i>
                                                    <div data-i18n="Roles & Permissions">Programming Test</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="{{ asset('test/input') }}" class="menu-link">
                                                            <div data-i18n="Roles">Input</div>
                                                        </a>
                                                        <a href="{{ asset('test/royalti') }}" class="menu-link">
                                                            <div data-i18n="Roles">Royalti</div>
                                                        </a>
                                                    </li>
                                                    {{-- <li class="menu-item">
                                                        <a href="app-access-permission.html" class="menu-link">
                                                            <div data-i18n="Permission">Permission</div>
                                                        </a>
                                                    </li> --}}
                                                {{-- </ul>
                                            </li> --}}
                                        </ul>
                                    </li>
                                {{-- @endforeach --}}


                            </ul>
                        </div>
                    </aside>

                    <!-- Layout container -->
                    <div class="layout-page">
                        <!-- Navbar -->


                        <!-- / Navbar -->

                        <!-- Content wrapper -->
                        <div class="content-wrapper">
                            <!-- Content -->

                            @yield('content')
                            <!-- / Content -->

                            <!-- Footer -->
                            <footer class="content-footer footer bg-footer-theme">
                                <div class="container-fluid">
                                    <div
                                        class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                        <div>
                                            ©
                                            <script>
                                                document.write(new Date().getFullYear());
                                            </script>
                                            , made with ❤️ by <a href="https://sambugroup.com/" target="_blank"
                                                class="fw-semibold">PEL</a>
                                        </div>
                                        {{-- <div>
                                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://pixinvent.ticksy.com/" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div> --}}
                                    </div>
                                </div>
                            </footer>
                            <!-- / Footer -->

                            <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>

                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>

                <!-- Drag Target Area To SlideIn Menu On Small Screens -->
                <div class="drag-target"></div>
            </div>
            <!-- / Layout wrapper -->

            <!-- Core JS -->

            <script src="{{ url('vendor/libs/select2/select2.js') }}"></script>
            <script src="{{ url('vendor/libs/tagify/tagify.js') }}"></script>
            {{-- <script src="{{ url('vendor/js/bootstrap.js') }}"></script> --}}
            <script src="{{ url('vendor/js/bootstrap.js') }}"></script>
            <script src="{{ url('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
            <!-- <script src="{{ url('vendor/libs/node-waves/node-waves.js') }}"></script> -->

            <!-- <script src="{{ url('vendor/libs/hammer/hammer.js') }}"></script> -->
            <!-- <script src="{{ url('vendor/libs/i18n/i18n.js') }}"></script> -->
            <!-- <script src="{{ url('vendor/libs/typeahead-js/typeahead.js') }}"></script> -->

            <script src="{{ url('vendor/js/menu.js') }}"></script>


    <script src="{{ url('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>


  
    <script src="{{ url('js/tables-datatables-basic.js') }}"></script>

            <!-- Vendors JS -->
            <script src="{{ url('vendor/libs/moment/moment.js') }}"></script>
            <script src="{{ url('vendor/libs/nouislider/nouislider.js') }}"></script>
            <script src="{{ url('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
            <script src="{{ url('vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>

            <!-- Main JS -->
            <script src="{{ url('js/main.js') }}"></script>

            <!-- Page JS -->
            <script src="{{ url('js/forms-selects.js') }}"></script>
            <script src="{{ url('js/forms-sliders.js') }}"></script>
            <script src="{{ url('js/tpm.js') }}"></script>



</body>

</html>
