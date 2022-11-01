<!DOCTYPE html>
<html lang="en">

@include('mahasiswa-layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('mahasiswa-layouts.navbar')
        
        @include('mahasiswa-layouts.breadcrumbs')

        @yield('content')
        
        {{-- @include('mahasiswa-layouts.footer') --}}
        
    </div>
    
    @include('mahasiswa-layouts.script')

    @yield('script')

</body>

</html>