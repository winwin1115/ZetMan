@extends('layouts.user')
@section('title', 'メモ登録')
@section('content')

<div class="allWrapper input__area">
    <form @if ($isCharge) action="{{ route('charge.memo.store') }}" @else action="{{ route('memo.store') }}" @endif method="POST">
        @csrf
        <div class="content__wrap">
            <div class="content__section">
                <div class="content__header">
                    <div class="content__title">
                        <h1 class="h1">メモ登録</h1>
                        <span class="en">Memo Add</span>
                    </div>
                </div>
                {{-- バリデーションエラー時の表示 --}}
                @if ($errors->any())
                <div class="content__error" style="margin-top: 1em;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="content__floar">
                    <div class="content__floar__inner">
                        <div class="content__box">
                            <div class="content__box__inner">
                                <div class="content__input">
                                    <div class="headline attention must">スタッフ</div>
                                    <div class="input__wrap">
                                        <div class="input__box selectBox">
                                            <select name="staff_id" class="bgType">
                                                @foreach($staffs as $staff)
                                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                                @endforeach
                                                <option value="0">未定</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline attention must">メモ日付</div>
                                    {{--  <div class="input__wrap">
                                        <div class="input__box">
                                            <input type="text" class="bgType" name="">
                                            <input class="bgType" type="text" name="phone" value="{{ old('phone', $charge->phone) }}">
                                        </div>
                                    </div>  --}}
                                    <div class="input__wrap flex__wrap v__center">
                                        <datepicker-module
                                            mode="new"
                                        >
                                        </datepicker-module>
                                        <div class="input__box type">
                                            <select class="bgType" name="time_type" required style="min-width: 70px !important;">
                                                <option value="0">未定</option>
                                                <option value="1">AM</option>
                                                <option value="2">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline attention must">メモ詳細</div>
                                    <div class="input__wrap">
                                        <div class="input__box">
                                            <textarea name="remarks" class="bgType" placeholder="メモ詳細" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__submit f__center">
                <div class="submit__box">
                    <button class="clickonce" type="submit">登録</button>
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
                    <form @if ($isCharge) action="{{ route('charge.memo.store') }}" @else action="{{ route('memo.store') }}" @endif method="POST">
                        @csrf
                        <div class="content__wrap">
                            <div class="content__section">
                                <div class="content__header">
                                    <div class="content__title">
                                        <h1 class="h1">メモ登録</h1>
                                        <span class="en">Memo Add</span>
                                    </div>
                                </div>
                                <!-- バリデーションエラー時の表示 -->
                                @if ($errors->any())
                                <div class="content__error" style="margin-top: 1em;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="content__floar">
                                    <div class="content__floar__inner">
                                        <div class="content__box">
                                            <div class="content__box__inner">
                                                <div class="content__input">
                                                    <div class="headline attention must">スタッフ</div>
                                                    <div class="input__wrap">
                                                        <div class="input__box selectBox">
                                                            <select name="staff_id" class="bgType">
                                                                @foreach($staffs as $staff)
                                                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                                                @endforeach
                                                                <option value="0">未定</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">メモ日付</div>
                                                    <div class="input__wrap flex__wrap v__center">
                                                        <datepicker-module
                                                            mode="new"
                                                        >
                                                        </datepicker-module>
                                                        <div class="input__box type">
                                                            <select class="bgType" name="time_type" required style="min-width: 70px !important;">
                                                                <option value="0">未定</option>
                                                                <option value="1">AM</option>
                                                                <option value="2">PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content__input">
                                                    <div class="headline attention must">メモ詳細</div>
                                                    <div class="input__wrap">
                                                        <div class="input__box">
                                                            <textarea name="remarks" class="bgType" placeholder="メモ詳細" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content__submit f__center">
                                <div class="submit__box">
                                    <button class="clickonce" type="submit">登録</button>
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
