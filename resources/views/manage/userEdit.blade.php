@extends('layouts.manage')
@section('title', '会員情報編集')
@section('content')
    <admin-user-edit-component :id="{{ $id }}" />
@endsection

{{--  @include("../components/head")
<body>
    <div id="app">
		<div class="wrap flex__wrap f__start input__area">
			@include("../components/sidebar")
			<div class="wrap__right">
                <admin-user-edit-component :id="{{ $id }}" />
			</div>
		</div>
	</div>
	@include("../components/footer")
</body>
</html>  --}}
