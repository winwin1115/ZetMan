@extends('layouts.public')
@section('title', '本登録')
@section('content')
<div class="content__wrap input__area">
<div class="content__section">
    <form action="{{ route('user.main_register') }}" method="POST">
        @csrf
        @if ($errors->any())
        <div class="alert content__error">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div class="content__header">
            <div class="content__title">
                <p class="textCenter">基本情報のご登録をお願いいたします。</p>
            </div>
        </div>
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="content__floar">
            <div class="content__floar__inner">
                <div class="content__box">
                    <div class="content__box__inner">
                        <div class="content__input">
                            <div class="headline attention must">お名前</div>
                            <div class="input__box">
                                <input class="borderType" type="text" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="content__input">
                            <div class="headline attention must">パスワード（5文字以上）</div>
                            <div class="input__box">
                                <input class="borderType" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="content__input">
                            <div class="headline attention must">会社名（屋号）</div>
                            <div class="input__box">
                                <input class="borderType" type="text" name="company" value="{{ old('company') }}">
                            </div>
                        </div>
                        <div class="content__input">
                            <div class="headline attention must">代表者の携帯番号</div>
                            <div class="input__box">
                                <input class="borderType" type="number" name="phone" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="content__input">
                            <div class="headline attention must">都道府県</div>
                            <div class="input__box selectBox">
                                <select class="bgType" name="prefecture_id" required>
                                    @foreach ($prefectures as $prefecture)
                                    <option
                                        value="{{ $prefecture->id }}"
                                        @if (old('prefecture_id') == $prefecture->id) selected @endif>
                                        {{ $prefecture->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="content__confirmation">
                            <label class="checkbox__label">
                                <a href="/terms/privacy" class="textLink" target="_blank" rel="noopener">規約</a>に同意する
                                <input type="checkbox" name="is_agreed" required>
                                <div class="checkbox__block"></div>
                            </label>
                        </div>
                        <div class="content__submit f__center">
                            <div class="submit__box">
                                <input class="clickonce" type="submit" name="" value="登録">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
@endsection

{{--  @include("../components/head")
<body>
    <div id="app">
        <div class="wrap flex__wrap f__start input__area">
            <div class="wrap__center">
                <div class="allWrapper">
                    <form action="{{ route('user.main_register') }}" method="POST">
                        @csrf
                        <div class="content__wrap">
                            <div class="content__section">
                                @if ($errors->any())
                                <div class="alert content__error">
                                    @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                                @endif
                                <div class="content__header">
                                    <div class="content__title">
                                        <p class="textCenter">基本情報のご登録をお願いいたします。</p>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="content__floar">
                                    <div class="content__floar__inner">
                                        <div class="content__box">
                                            <div class="content__box__inner">
                                                <div class="content__input">
                                                    <div class="headline attention must">お名前</div>
                                                    <div class="input__box">
                                                        <input class="borderType" type="text" name="name" value="{{ old('name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">パスワード（5文字以上）</div>
                                                    <div class="input__box">
                                                        <input class="borderType" type="password" name="password" required>
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">会社名（屋号）</div>
                                                    <div class="input__box">
                                                        <input class="borderType" type="text" name="company" value="{{ old('company') }}">
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">代表者の携帯番号</div>
                                                    <div class="input__box">
                                                        <input class="borderType" type="number" name="phone" value="{{ old('phone') }}" required>
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">都道府県</div>
                                                    <div class="input__box selectBox">
                                                        <select class="bgType" name="prefecture_id" required>
                                                            @foreach ($prefectures as $prefecture)
                                                            <option
                                                                value="{{ $prefecture->id }}"
                                                                @if (old('prefecture_id') == $prefecture->id) selected @endif>
                                                                {{ $prefecture->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="content__confirmation">
                                                    <label class="checkbox__label">
                                                        <a href="/terms/privacy" class="textLink" target="_blank" rel="noopener">規約</a>に同意する
                                                        <input type="checkbox" name="is_agreed" required>
                                                        <div class="checkbox__block"></div>
                                                    </label>
                                                </div>
                                                <div class="content__submit f__center">
                                                    <div class="submit__box">
                                                        <input class="clickonce" type="submit" name="" value="登録">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

