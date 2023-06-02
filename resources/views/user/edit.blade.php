
@extends('layouts.user')
@section('title', 'プロフィール編集')
@section('content')
<div class="allWrapper input__area">
    <form @if ($isCharge) action="{{ route('charge.user.update') }}" @else action="{{ route('user.update') }}" @endif method="POST">
        @csrf
        <div class="content__wrap">
            <div class="content__section">

                <!-- バリデーションエラー時の表示 -->
                @if ($errors->any())
                <div class="alert alert-danger content__error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('message'))
                    @if ($isCharge)
                    <script>
                        alert('会員情報を更新しました。');
                        window.location.href = '/charge/user';
                    </script>
                    @else
                    <script>
                        alert('会員情報を更新しました。');
                        window.location.href = '/user';
                    </script>
                    @endif
                @endif

                <div class="content__header">
                    <div class="content__title">
                        <h1 class="h1">会員情報編集</h1>
                        <span class="en">User Edit</span>
                    </div>
                </div>

                <div class="content__floar">
                    <div class="content__floar__inner">
                        <div class="content__box">
                            <!-- 担当者でログインしている場合の表示 -->
                            @if ($isCharge)
                            <div class="content__box__inner">
                                <div class="content__input">
                                    <div class="headline attention must">お名前</div>
                                    <div class="input__box">
                                        <input class="bgType" type="text" name="name"
                                            value="{{ old('name', $loginCharge->name) }}">
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline attention must">携帯番号（ハイフン不要）</div>
                                    <div class="input__box">
                                        <input class="bgType" type="text" name="phone"
                                            value="{{ old('phone', $loginCharge->phone) }}">
                                    </div>
                                </div>
                            </div>
                            @else
                            <!-- ユーザーでログインしている場合の表示 -->
                            <div class="content__box__inner">
                                <div class="content__input">
                                    <div class="headline attention must">お名前</div>
                                    <div class="input__box">
                                        <input class="bgType" type="text" name="name"
                                            value="{{ old('name', $user->name) }}">
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline attention must">メールドレス</div>
                                    <div class="input__box">
                                        <input class="bgType" type="email" name="email"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline attention must">会社名（屋号）</div>
                                    <div class="input__box">
                                        <input class="bgType" type="text" name="company"
                                            value="{{ old('company', $user->company) }}">
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline attention must">代表者の電話番号（ハイフン不要）</div>
                                    <div class="input__box">
                                        <input class="bgType" type="tel" name="phone"
                                            value="{{ old('phone', $user->phone) }}" pattern="\d*"/>
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline attention must">都道府県</div>
                                    <div class="input__wrap">
                                        <div class="input__box selectBox">
                                            <select class="bgType" name="prefecture_id">
                                                @foreach ($prefectures as $prefecture)
                                                <option value="{{ $prefecture->id }}" @if (old('prefecture_id',
                                                    $user->prefecture_id) == $prefecture->id) selected @endif>
                                                    {{ $prefecture->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="content__submit f__center">
                    <div class="submit__box">
                        <input class="clickonce" type="submit" name="" value="会員情報更新">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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
                <div class="allWrapper">
                    <form @if ($isCharge) action="{{ route('charge.user.update') }}" @else action="{{ route('user.update') }}" @endif method="POST">
                        @csrf
                        <div class="content__wrap">
                            <div class="content__section">

                                <!-- バリデーションエラー時の表示 -->
                                @if ($errors->any())
                                <div class="alert alert-danger content__error">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @if (session('message'))
                                    @if ($isCharge)
                                    <script>
                                        alert('会員情報を更新しました。');
                                        window.location.href = '/charge/user';
                                    </script>
                                    @else
                                    <script>
                                        alert('会員情報を更新しました。');
                                        window.location.href = '/user';
                                    </script>
                                    @endif
                                @endif

                                <div class="content__header">
                                    <div class="content__title">
                                        <h1 class="h1">会員情報編集</h1>
                                        <span class="en">User Edit</span>
                                    </div>
                                </div>

                                <div class="content__floar">
                                    <div class="content__floar__inner">
                                        <div class="content__box">
                                            <!-- 担当者でログインしている場合の表示 -->
                                            @if ($isCharge)
                                            <div class="content__box__inner">
                                                <div class="content__input">
                                                    <div class="headline attention must">お名前</div>
                                                    <div class="input__box">
                                                        <input class="bgType" type="text" name="name"
                                                            value="{{ old('name', $loginCharge->name) }}">
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">携帯番号（ハイフン不要）</div>
                                                    <div class="input__box">
                                                        <input class="bgType" type="text" name="phone"
                                                            value="{{ old('phone', $loginCharge->phone) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <!-- ユーザーでログインしている場合の表示 -->
                                            <div class="content__box__inner">
                                                <div class="content__input">
                                                    <div class="headline attention must">お名前</div>
                                                    <div class="input__box">
                                                        <input class="bgType" type="text" name="name"
                                                            value="{{ old('name', $user->name) }}">
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">メールドレス</div>
                                                    <div class="input__box">
                                                        <input class="bgType" type="email" name="email"
                                                            value="{{ old('email', $user->email) }}">
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">会社名（屋号）</div>
                                                    <div class="input__box">
                                                        <input class="bgType" type="text" name="company"
                                                            value="{{ old('company', $user->company) }}">
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">代表者の電話番号（ハイフン不要）</div>
                                                    <div class="input__box">
                                                        <input class="bgType" type="tel" name="phone"
                                                            value="{{ old('phone', $user->phone) }}" pattern="\d*"/>
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">都道府県</div>
                                                    <div class="input__wrap">
                                                        <div class="input__box selectBox">
                                                            <select class="bgType" name="prefecture_id">
                                                                @foreach ($prefectures as $prefecture)
                                                                <option value="{{ $prefecture->id }}" @if (old('prefecture_id',
                                                                    $user->prefecture_id) == $prefecture->id) selected @endif>
                                                                    {{ $prefecture->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="content__submit f__center">
                                    <div class="submit__box">
                                        <input class="clickonce" type="submit" name="" value="会員情報更新">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include("../components/footer")
</body>
</html>  --}}
