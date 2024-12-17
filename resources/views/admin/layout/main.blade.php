<!DOCTYPE html>
<html lang="en">

@include('admin.layout.head')
<body>
    @include('admin.layout.sidebar')
    @include('admin.layout.header')
    @yield('content')
    @include('admin.layout.footer')
    @include('admin.layout.script')
    @yield('custom-script')
</body>
</html>