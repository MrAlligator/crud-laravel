<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ $subTitle }}</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/bootstrapv5.1.3/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">

    @include('partials.topbar')

    <div id="layoutSidenav">

        @include('partials.sidebar')

        @yield('content')

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('partials.modals')

    @include('partials.js')

    @if ($active === 'emp')
        @include('partials.pagejs.jstest')
    @elseif ($active === 'soh')
        @include('partials.pagejs.jssoh')
    @endif

</body>

</html>
