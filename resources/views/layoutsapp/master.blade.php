<!DOCTYPE html>
<html lang="en">

@include('layoutsapp.appconfig')

<body>
    @include('layoutsapp.partials.navbar')
    @include('layoutsapp.partials.sidebar')


    <main style="margin-top: 58px">
        <div class="container-fluid pt-4">
            @yield('content')
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
            <!-- Toast d'installation -->
            <div class="toast align-items-center text-white bg-info border-0" role="alert" id="installToast">
                <div class="d-flex">
                    <div class="toast-body">
                        <!-- Le message sera inséré dynamiquement -->
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-mdb-dismiss="toast"></button>
                </div>
            </div>
        </div>
    </main>

    @include('layoutsapp.partials.script')
</body>


</html>