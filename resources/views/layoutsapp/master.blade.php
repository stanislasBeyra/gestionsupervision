<!DOCTYPE html>
<html lang="en">

@include('layoutsapp.appconfig')
<body>
    @include('layoutsapp.partials.navbar')
    @include('layoutsapp.partials.sidebar')

    @include('layoutsapp.partials.mobile-sidebar')

    <main style="margin-top: 58px">
    <div class="container-fluid pt-4">
            @yield('content')
        </div>
    </main>

    @include('layoutsapp.partials.script')
</body>
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/service-worker.js')
            .then(function(registration) {
                console.log('Service Worker enregistré avec succès:', registration);
            })
            .catch(function(error) {
                console.log('L\'enregistrement du Service Worker a échoué:', error);
            });
        });
    }
</script>

</html>
