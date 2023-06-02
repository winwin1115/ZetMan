@extends('layouts.manage')
@section('title', '会員情報詳細')
@section('content')
    <admin-user-show-component :id="{{ $id }}"></admin-user-show-component>
@endsection
{{--  @include("../components/head")
<body>
	<div id="app">
		<div class="wrap flex__wrap f__start input__area">
			@include("../components/sidebar")
			<div class="wrap__right">
                <admin-user-show-component :id="{{ $id }}"></admin-user-show-component>
			</div>
		</div>
	</div>
	@include("../components/footer")
</body>
</html>  --}}
