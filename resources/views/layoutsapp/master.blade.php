<!DOCTYPE html>
<html lang="en">

@include('layoutsapp.appconfig')
<body>
    @include('layoutsapp.partials.navbar')
    @include('layoutsapp.partials.sidebar')

    @include('layoutsapp.partials.mobile-sidebar')

    <main style="margin-top: 58px">
    <div class="container pt-4">
            @yield('content')
        </div>
    </main>

    @include('layoutsapp.partials.script')
</body>
</html>
