<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'E-Pustaka Admin')</title>
    <meta name="description" content="E-Pustaka Admin Dashboard" />
    <meta name="keywords" content="e-pustaka, library, admin" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Global Stylesheets Bundle -->
    <link href="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/global/plugins.bundle.css"
        rel="stylesheet" type="text/css" />
    <link href="https://preview.keenthemes.com/metronic8/demo1/assets/css/style.bundle.css" rel="stylesheet"
        type="text/css" />

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" />

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet" />

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

            /* Mobile table adjustments */
            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
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
            .app-toolbar {
                padding: 1rem 0;
            }

            .page-heading {
                font-size: 1.5rem !important;
            }

            .card-header {
                padding: 1rem;
            }

            .table th,
            .table td {
                padding: 0.5rem;
            }
        }

        @media (max-width: 575.98px) {
            .app-container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .btn-group .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
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

        /* Table enhancements */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .action-buttons .btn {
            margin-right: 0.25rem;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        /* Modal enhancements */
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        /* Loading state */
        .table-loading {
            position: relative;
        }

        .table-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Smooth transitions */
        .app-sidebar,
        .app-main,
        .btn,
        .card {
            transition: all 0.3s ease-in-out;
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

        /* Menu hover effects */
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
        }
    </style>

    @stack('styles')
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
                                    @yield('page-title', 'Master Data')
                                </h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                    </li>
                                    @yield('breadcrumb')
                                </ul>
                            </div>
                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                @yield('toolbar-actions')
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Javascript Bundle -->
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/global/plugins.bundle.js"></script>
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/js/scripts.bundle.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <!-- Custom Admin Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                } else {
                    document.body.classList.remove('app-sidebar-minimize');
                }
            });

            // DataTable default configuration
            if (typeof $.fn.DataTable !== 'undefined') {
                $.extend(true, $.fn.dataTable.defaults, {
                    responsive: true,
                    pageLength: 25,
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        },
                        emptyTable: "Tidak ada data yang tersedia",
                        zeroRecords: "Tidak ada data yang cocok"
                    },
                    dom: '<"row"<"col-sm-6 d-flex align-items-center justify-content-start"l><"col-sm-6 d-flex align-items-center justify-content-end"f>>' +
                        '<"table-responsive"t>' +
                        '<"row"<"col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"i><"col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"p>>'
                });
            }

            // Global AJAX setup for CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Global delete confirmation
            window.confirmDelete = function(url, title = 'Apakah Anda yakin?', text =
                'Data yang dihapus tidak dapat dikembalikan!') {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create form and submit
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = $('meta[name="csrf-token"]').attr('content');

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            };

            // Global success message
            window.showSuccess = function(message = 'Operasi berhasil!') {
                Swal.fire({
                    title: 'Berhasil!',
                    text: message,
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false
                });
            };

            // Global error message
            window.showError = function(message = 'Terjadi kesalahan!') {
                Swal.fire({
                    title: 'Error!',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            };

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>

</html>
