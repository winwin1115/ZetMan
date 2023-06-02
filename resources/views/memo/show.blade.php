@extends('layouts.user')
@section('title', 'メモ詳細')
@section('content')
    <memo-show-component
        :id="{{ $id }}"
        is-success="{{ session('success-message') }}"
        is-viewer="{{ $isViewer }}"
        url-prefix="{{ $urlPrefix }}"
    />
@endsection

{{--  @include("../components/head")
<body>
	<div id="app">
		<!-- スマホのみのメニューバー -->
		@include("../components/nav")
		<div class="wrap flex__wrap f__start input__area">
			@include("../components/sidebar")
			<div class="wrap__right">
                @include("../components/header")
                <memo-show-component
                    :id="{{ $id }}"
                    is-success="{{ session('success-message') }}"
                    is-viewer="{{ $isViewer }}"
                    url-prefix="{{ $urlPrefix }}"
                >
                </memo-show-component>
			</div>
		</div>
	</div>
	@include("../components/footer")
</body>
</html>  --}}
