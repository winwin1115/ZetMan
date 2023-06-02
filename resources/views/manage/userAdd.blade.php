@extends('layouts.manage')
@section('title', '会員追加')
@section('content')
    <admin-user-register-component />
@endsection

{{--  @include("../components/head")
<body>
    <div id="app">
		<div class="wrap flex__wrap f__start input__area">
            @can('owner-only')
            @include("../components/sidebar")
            @endcan
			<div class="wrap__right">
                <admin-user-register-component></admin-user-register-component>
            </div>
		</div>
	</div>
	@include("../components/footer")
</body>
</html>  --}}
