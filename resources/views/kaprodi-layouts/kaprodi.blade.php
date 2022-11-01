<!DOCTYPE html>
<html lang="en">

@include('kaprodi-layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('kaprodi-layouts.navbar')

        @include('kaprodi-layouts.sidebar')

        @yield('content')


    </div>


    @include('admin-layouts.script')

</body>

</html>