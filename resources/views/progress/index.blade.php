@extends('layouts.public')
@section('title', '案件詳細')
@section('content')
    <client-project-show-component
        :id="{{ $id }}"
        :is-open="{{ $isOpen }}"
    />
@endsection

{{-- @include("../components/head")
<body>
	<div id="app">
		<div class="wrap flex__wrap f__start input__area">
			<div class="wrap__center">
                <client-project-show-component
                    :id="{{ $id }}"
                    :is-open="{{ $isOpen }}"
                />
			</div>
		</div>
	</div>
	@include("../components/footer")
</body>
</html> --}}
