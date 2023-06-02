@extends('layouts.manage')
@section('title', '運営者一覧')
@section('content')
    <div class="allWrapper">
        <div id="app">
            <div class="content__wrap">
                <div class="content__section">
                    {{-- ユーザー情報更新後のメッセージ表示 --}}
                    @if (session('message'))
                        <p>{{ session('message') }}</p>
                    @endif

                    <div class="content__header">
                        <div class="content__title">
                            <h1 class="h1">運営者一覧</h1>
                            <span class="en">Manager List</span>
                        </div>
                    </div>
                    <!-- スマホ表示 -->
                    <div class="tab">
                        <admin-manager-index-sp-component :active-managers="{{ $activeManagers }}" :stopped-managers="{{ $stoppedManagers }}"></admin-manager-index-sp-component>
                    </div>
                    <div class="pc">

                    <!-- PC表示 -->
                        <admin-manager-index-pc-component :active-managers="{{ $activeManagers }}" :stopped-managers="{{ $stoppedManagers }}"></admin-manager-index-pc-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--  @include("../components/head")
<body>
    <div id="app">
        <div class="wrap flex__wrap f__start">
            @include("../components/sidebar")
            <div class="wrap__right">
                <div class="allWrapper">
                    <div id="app">
                        <div class="content__wrap">
                            <div class="content__section">
                                @if (session('message'))
                                    <p>{{ session('message') }}</p>
                                @endif

                                <div class="content__header">
                                    <div class="content__title">
                                        <h1 class="h1">運営者一覧</h1>
                                        <span class="en">Manager List</span>
                                    </div>
                                </div>
                                <!-- スマホ表示 -->
                                <div class="tab">
                                    <admin-manager-index-sp-component :active-managers="{{ $activeManagers }}" :stopped-managers="{{ $stoppedManagers }}"></admin-manager-index-sp-component>
                                </div>
                                <div class="pc">

                                <!-- PC表示 -->
                                    <admin-manager-index-pc-component :active-managers="{{ $activeManagers }}" :stopped-managers="{{ $stoppedManagers }}"></admin-manager-index-pc-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("../components/footer")
</body>
</html>  --}}
