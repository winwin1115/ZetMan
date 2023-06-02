
@include("../components/head")
<link rel="stylesheet" type="text/css" href="{{ asset('css/process.css') }}">

<body>
    <div id="app">
        {{-- {{dd($isCharge, $loginId, $isViewer)}} --}}
        {{-- @include("../components/nav") --}}
        <div class="wrap l-flex f__start">
            <board
                is-charge="{{ $isCharge }}"
                user-name="{{ $userName }}"
                login-id="{{ $loginId }}"
                is-viewer="{{ $isViewer }}"
                url-prefix="{{ $urlPrefix }}"
            />
        </div>
    </div>
    @include("../components/footer")
</body>
</html>
