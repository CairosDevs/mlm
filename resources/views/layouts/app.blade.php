<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Setting::get('app_name') }}</title>
    <!--favicon-->
    {{--
    <link rel="icon" href="{{ asset('template/assets/images/favicon-32x32.png') }}" type="image/png" /> --}}
    <!--plugins-->

    <link href="{{ asset('template/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('template/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('template/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('template/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/css/icons.css') }}" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/css/header-colors.css') }}" />

    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* For Chrome, Safari, Edge, Opera */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        
        /* For Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
    
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">

        @include('layouts.navigation')
        <main>
            {{ $slot }}
        </main>

    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2023. All right reserved.</p>
    </footer>
    
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('template/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('template/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    {{-- <script src="{{ asset('template/assets/js/index2.js') }}"></script> --}}
    <!--app JS-->
    <script src="{{ asset('template/assets/js/app.js') }}"></script>
    <script src="{{ asset('template/assets/js/mlm.js') }}"></script>
   <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});

            var success = "{{ session('success') }}";

            if (success) {
                Swal.fire({
                    title: "¡Éxito!",
                    text: success,
                    icon: "success",
                });
                
            }
            
            var error = "{{ session('error') }}";

            if (error) {
                Swal.fire({
                    title: "Tuvimos un problema!",
                    text: error,
                    icon: "error",
                });
            }

		});
    </script>
    
    @livewireScripts

    @stack('scripts')
</body>

</html>
