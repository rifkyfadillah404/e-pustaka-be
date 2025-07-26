<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>E-Pustaka Dashboard</title>
    <meta name="description" content="E-Pustaka Admin Dashboard" />
    <meta name="keywords" content="e-pustaka, library, admin" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Global Stylesheets Bundle -->
    <link href="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/global/plugins.bundle.css"
        rel="stylesheet" type="text/css" />
    <link href="https://preview.keenthemes.com/metronic8/demo1/assets/css/style.bundle.css" rel="stylesheet"
        type="text/css" />

    <!-- Custom Responsive CSS -->
    <style>
        /* Responsive Sidebar Styles */
        @media (max-width: 991.98px) {
            .app-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .app-sidebar.show {
                transform: translateX(0);
            }

            .app-main {
                margin-left: 0 !important;
                transition: margin-left 0.3s ease-in-out;
            }

            .dashboard-card {
                margin-bottom: 1rem;
            }

            /* Mobile card adjustments */
            .col-md-6.col-lg-6.col-xl-6.col-xxl-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (min-width: 992px) {
            .app-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 1000;
                transition: width 0.3s ease-in-out;
            }

            .app-main {
                margin-left: 225px;
                transition: margin-left 0.3s ease-in-out;
            }

            /* Sidebar minimized state */
            body.app-sidebar-minimize .app-sidebar {
                width: 70px;
            }

            body.app-sidebar-minimize .app-main {
                margin-left: 70px;
            }

            body.app-sidebar-minimize .menu-title {
                display: none;
            }

            body.app-sidebar-minimize .app-sidebar-logo-default {
                display: none;
            }

            body.app-sidebar-minimize .app-sidebar-logo-minimize {
                display: block;
            }
        }

        @media (max-width: 767.98px) {

            /* Extra small devices adjustments */
            .card-header .card-title .fs-2hx {
                font-size: 2rem !important;
            }

            .app-toolbar {
                padding: 1rem 0;
            }

            .page-heading {
                font-size: 1.5rem !important;
            }

            /* Chart container responsive */
            #monthlyChart {
                height: 250px !important;
            }
        }

        @media (max-width: 575.98px) {

            /* Mobile phones */
            .app-container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .card-header .card-title .fs-2hx {
                font-size: 1.5rem !important;
            }

            .row.g-5 {
                --bs-gutter-x: 1rem;
                --bs-gutter-y: 1rem;
            }
        }

        /* Sidebar overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            transition: opacity 0.3s ease-in-out;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Smooth transitions for all interactive elements */
        .dashboard-card,
        .menu-item,
        .app-sidebar,
        .app-main {
            transition: all 0.3s ease-in-out;
        }

        /* Hover effects enhancement */
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
        }

        /* Mobile menu button enhancement */
        #kt_app_sidebar_mobile_toggle {
            background-color: #009ef7;
            color: white;
            border-radius: 0.5rem;
        }

        #kt_app_sidebar_mobile_toggle:hover {
            background-color: #0084d4;
            transform: scale(1.05);
        }
    </style>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <!-- Header -->
            @include('layouts.partials.header')

            <!-- Sidebar -->
            @include('layouts.partials.sidebar')

            <!-- Main Content -->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">

                    <!-- Toolbar -->
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <h1
                                    class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                    Dashboard</h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="#" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-muted">Dashboard</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-xxl">

                            <!-- Stats Row -->
                            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                <!-- Total Books -->
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10 dashboard-card"
                                        data-card="books"
                                        style="background-color: #F1416C;background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/patterns/vector-1.png'); transition: all 0.3s ease;">
                                        <div class="card-header pt-5">
                                            <div class="card-title d-flex flex-column">
                                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">2,451</span>
                                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total
                                                    Books</span>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex align-items-end pt-0">
                                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                                <div
                                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                    <span>43 Today</span>
                                                    <span>+18%</span>
                                                </div>
                                                <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                    <div class="bg-white rounded h-8px" role="progressbar"
                                                        style="width: 76%;" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Active Users -->
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10 dashboard-card"
                                        data-card="users"
                                        style="background-color: #7239EA;background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/patterns/vector-1.png'); transition: all 0.3s ease;">
                                        <div class="card-header pt-5">
                                            <div class="card-title d-flex flex-column">
                                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">1,234</span>
                                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Active
                                                    Users</span>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex align-items-end pt-0">
                                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                                <div
                                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                    <span>12 Today</span>
                                                    <span>+8%</span>
                                                </div>
                                                <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                    <div class="bg-white rounded h-8px" role="progressbar"
                                                        style="width: 65%;" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Borrowed Books -->
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10 dashboard-card"
                                        data-card="books"
                                        style="background-color: #17C653;background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/patterns/vector-1.png'); transition: all 0.3s ease;">
                                        <div class="card-header pt-5">
                                            <div class="card-title d-flex flex-column">
                                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">842</span>
                                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Borrowed
                                                    Books</span>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex align-items-end pt-0">
                                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                                <div
                                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                    <span>28 Today</span>
                                                    <span>+12%</span>
                                                </div>
                                                <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                    <div class="bg-white rounded h-8px" role="progressbar"
                                                        style="width: 84%;" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending Returns -->
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10 dashboard-card"
                                        data-card="books"
                                        style="background-color: #FFC700;background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/patterns/vector-1.png'); transition: all 0.3s ease;">
                                        <div class="card-header pt-5">
                                            <div class="card-title d-flex flex-column">
                                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">145</span>
                                                <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Pending
                                                    Returns</span>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex align-items-end pt-0">
                                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                                <div
                                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                    <span>5 Today</span>
                                                    <span>-3%</span>
                                                </div>
                                                <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                    <div class="bg-white rounded h-8px" role="progressbar"
                                                        style="width: 45%;" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Charts and Activity Row -->
                            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                <!-- Recent Activity -->
                                <div class="col-xl-6">
                                    <div class="card card-flush h-xl-100 dashboard-card" data-card="reports"
                                        style="transition: all 0.3s ease;">
                                        <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                                            style="background-image:url('https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/shapes/top-green.png')"
                                            data-bs-theme="light">
                                            <h3 class="card-title align-items-start flex-column text-white pt-15">
                                                <span class="fw-bold fs-2x mb-3">Recent Activity</span>
                                                <div class="fs-4 text-white">
                                                    <span class="opacity-75">Latest library activities and
                                                        updates</span>
                                                </div>
                                            </h3>
                                        </div>

                                        <div class="card-body mt-n20">
                                            <div class="mt-n20 position-relative">
                                                <div class="row g-3 g-lg-6">
                                                    <div class="col-6">
                                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                            <div class="symbol symbol-30px me-5 mb-8">
                                                                <span class="symbol-label">
                                                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                        <svg width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3"
                                                                                d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="12" width="7"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="7" width="12"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <div class="text-gray-900 fw-bold fs-6 mb-2">Book Borrowed
                                                            </div>
                                                            <div class="text-gray-400 fw-semibold fs-7">John Doe
                                                                borrowed "The Great Gatsby"</div>
                                                            <div class="text-gray-400 fw-semibold fs-8 mt-1">2h ago
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                            <div class="symbol symbol-30px me-5 mb-8">
                                                                <span class="symbol-label">
                                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                                        <svg width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3"
                                                                                d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="12" width="7"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="7" width="12"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <div class="text-gray-900 fw-bold fs-6 mb-2">New Book Added
                                                            </div>
                                                            <div class="text-gray-400 fw-semibold fs-7">"1984" by
                                                                George Orwell</div>
                                                            <div class="text-gray-400 fw-semibold fs-8 mt-1">5h ago
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                            <div class="symbol symbol-30px me-5 mb-8">
                                                                <span class="symbol-label">
                                                                    <span class="svg-icon svg-icon-1 svg-icon-danger">
                                                                        <svg width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3"
                                                                                d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="12" width="7"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="7" width="12"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <div class="text-gray-900 fw-bold fs-6 mb-2">Book Returned
                                                            </div>
                                                            <div class="text-gray-400 fw-semibold fs-7">Sarah returned
                                                                "Pride and Prejudice"</div>
                                                            <div class="text-gray-400 fw-semibold fs-8 mt-1">1d ago
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                            <div class="symbol symbol-30px me-5 mb-8">
                                                                <span class="symbol-label">
                                                                    <span class="svg-icon svg-icon-1 svg-icon-warning">
                                                                        <svg width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.3"
                                                                                d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="12" width="7"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                            <rect x="6" y="7" width="12"
                                                                                height="2" rx="1"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <div class="text-gray-900 fw-bold fs-6 mb-2">Overdue Alert
                                                            </div>
                                                            <div class="text-gray-400 fw-semibold fs-7">3 books are
                                                                overdue</div>
                                                            <div class="text-gray-400 fw-semibold fs-8 mt-1">2d ago
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Monthly Statistics -->
                                <div class="col-xl-6">
                                    <div class="card card-flush h-xl-100 dashboard-card" data-card="reports"
                                        style="transition: all 0.3s ease;">
                                        <div class="card-header pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bold text-dark">Monthly Statistics</span>
                                                <span class="text-gray-400 pt-2 fw-semibold fs-6">Books borrowed this
                                                    month</span>
                                            </h3>

                                            <div class="card-toolbar">
                                                <div class="btn btn-sm btn-light d-flex align-items-center px-4">
                                                    <div class="text-gray-600 fw-bold">25 Jun 2025 - 24 Jul 2025</div>
                                                    <span class="svg-icon svg-icon-1 ms-2 me-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body pt-6">
                                            <canvas id="monthlyChart" class="h-350px w-100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Global Javascript Bundle -->
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/global/plugins.bundle.js"></script>
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/js/scripts.bundle.js"></script>

    <!-- Custom Chart Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyChart').getContext('2d');

            // Sample data for the chart
            const chartData = {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Books Borrowed',
                    data: [65, 78, 90, 81],
                    borderColor: '#17C653',
                    backgroundColor: 'rgba(23, 198, 83, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#17C653',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            };

            const config = {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            },
                            ticks: {
                                color: '#7E8299'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#7E8299'
                            }
                        }
                    },
                    elements: {
                        point: {
                            hoverBackgroundColor: '#17C653'
                        }
                    }
                }
            };

            new Chart(ctx, config);
        });

        // Responsive Sidebar Management
        const sidebar = document.getElementById('kt_app_sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mobileToggle = document.getElementById('kt_app_sidebar_mobile_toggle');
        const sidebarToggle = document.getElementById('kt_app_sidebar_toggle');

        // Mobile sidebar toggle
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                if (window.innerWidth <= 991.98) {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                }
            });
        }

        // Sidebar overlay click to close
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }

        // Desktop sidebar minimize toggle
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                if (window.innerWidth > 991.98) {
                    document.body.classList.toggle('app-sidebar-minimize');
                }
            });
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991.98) {
                // Desktop view
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            } else {
                // Mobile view
                document.body.classList.remove('app-sidebar-minimize');
            }
        });

        // Sidebar and Dashboard Cards Interaction
        const sidebarItems = document.querySelectorAll('[data-menu]');
        const dashboardCards = document.querySelectorAll('[data-card]');

        sidebarItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                // Only apply hover effects on desktop
                if (window.innerWidth > 991.98) {
                    const menuType = this.getAttribute('data-menu');

                    // Reset all cards
                    dashboardCards.forEach(card => {
                        card.style.transform = 'scale(1)';
                        card.style.boxShadow = 'none';
                        card.style.filter = 'brightness(1)';
                    });

                    // Highlight matching cards
                    const matchingCards = document.querySelectorAll(`[data-card="${menuType}"]`);
                    matchingCards.forEach(card => {
                        card.style.transform = 'scale(1.05)';
                        card.style.boxShadow = '0 10px 30px rgba(0,0,0,0.3)';
                        card.style.filter = 'brightness(1.1)';
                    });
                }
            });

            item.addEventListener('mouseleave', function() {
                // Reset all cards when leaving sidebar (desktop only)
                if (window.innerWidth > 991.98) {
                    dashboardCards.forEach(card => {
                        card.style.transform = 'scale(1)';
                        card.style.boxShadow = 'none';
                        card.style.filter = 'brightness(1)';
                    });
                }
            });

            // Mobile click interaction
            item.addEventListener('click', function(e) {
                if (window.innerWidth <= 991.98) {
                    e.preventDefault();

                    // Close sidebar on mobile after click
                    setTimeout(() => {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    }, 200);

                    // Brief highlight effect for mobile
                    const menuType = this.getAttribute('data-menu');
                    const matchingCards = document.querySelectorAll(`[data-card="${menuType}"]`);
                    matchingCards.forEach(card => {
                        card.style.transform = 'scale(1.02)';
                        card.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
                        setTimeout(() => {
                            card.style.transform = 'scale(1)';
                            card.style.boxShadow = 'none';
                        }, 300);
                    });
                }
            });
        });
    </script>
</body>

</html>
