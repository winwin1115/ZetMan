{{-- layouts --}}
@include("../components/head")
<body>
    <div id="app">
        <div class="wrap flex__wrap f__start f__center">
            <div class="wrap__center">
                <div class="allWrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include("../components/footer")
</body>
</html>
