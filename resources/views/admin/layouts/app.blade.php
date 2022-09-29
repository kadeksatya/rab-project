
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}} - {{$page_name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    @stack('style')
</head>

<body>
    @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="showErrors" data-message="{{ $error }}" ></span>
                @endforeach
    @endif
    @if (session('message'))
    <span class="success" data-message="{{session('message')}}"></span>
    @endif
    <div class="app">
        <div class="layout">
            @include('admin.layouts.header')

            @include('admin.layouts.sidebar')

            <!-- Page Container START -->
            <div class="page-container">

                <!-- Content Wrapper START -->
                <div class="main-content">

                        @stack('breadcrumb')

                    <!-- Content goes Here -->
                    @yield('content')
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright © 2019 Theme_Nate. All rights reserved.</p>
                        <span>
                            <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span>
                    </div>
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->


        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{asset('assets/js/vendors.min.js')}}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <!-- page js -->
    <script src="{{asset('assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('script')

    <script>
        $(document).ready(function () {
            $('.showErrors').show(function(){
            let message = $(this).data('message');

                Swal.fire(
                    'Opss..',
                    message,
                    'error'
                )
            })
            $('.success').show(function () {
                let message = $(this).data('message')
                Swal.fire(
                    'Success',
                    message,
                    'success'
                )
            });
            $(document).on('click', '.delete-item', function () {
                var url = $(this).data('url');
                Swal.fire({
                    title: 'Warning',
                    text: "Are you sure for delete this ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data("id");
                        var token = $("meta[name='csrf-token']").attr("content");
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function (data) {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                )
                                window.location.reload().time(3)
                            }
                        });
                    }
                })
            })
        });
    </script>

</body>

</html>
