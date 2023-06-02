{{-- layouts --}}
@include("../components/head")
<body>
    <div id="app">
        <div class="wrap flex__wrap f__start">
            @can('owner-only')
                @include("../components/sidebar-manage")
            @endcan
            <div class="wrap__right">
                @yield('content')
            </div>
        </div>
    </div>
    @include("../components/footer")
</body>
</html>
