@extends('layouts.user')
@section('title', 'メモ一覧')
@section('content')

<div class="allWrapper">
    <div class="content__wrap">
        <div class="content__section">

            {{-- バリデーションエラー時の表示 --}}
            @if ($errors->any())
            <div class="alert alert-danger content__error">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- 更新後のメッセージ表示 --}}
            @if (session('message'))
                <p>{{ session('message') }}</p>
            @endif

            <div class="content__header">
                <div class="content__title">
                    <h1 class="h1">メモ一覧</h1>
                    <span class="en">Memo List</span>
                </div>
                {{--  <div class="content__edit">
                    <ul>
                        <li><a @if ($isCharge) href="{{ route('charge.charges.add') }}" @else href="{{ route('charges.add') }}" @endif>新規追加</a></li>
                    </ul>
                </div>  --}}
                <div class="content__edit">
                    <ul>
                        <li>
                            <a @if ($isCharge) href="{{ route('charge.memo.add') }}" @else href="{{ route('memo.add') }}" @endif>新規追加</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content__floar">
                <div class="content__floar__inner">
                    <!-- スマホ表示 -->
                    <div class="tab">
                        @if (count($memos) > 0)
                            @foreach ($memos as $remark)
                                <div class="content__box common__list prime__list">
                                    {{--  <a @if ($isCharge) href="{{ route('charge.charges.show', $charge->id) }}" @else href="{{ route('charges.show', $charge->id) }}" @endif>
                                        <div class="content__box__inner">
                                            <div class="common__list__head">
                                                <div class="supplement">
                                                    <span class="sub">名前</span>
                                                </div>
                                                <div class="title"><span>{{ $charge->name }}</span></div>
                                            </div>
                                            <div class="phone"><img src="{{ asset('assets/img/icon-sp-black.png') }}" alt="">
                                                {{ $charge->phone }}
                                            </div>
                                        </div>
                                    </a>  --}}
                                    <a @if ($isCharge) href="{{ route('charge.memo.show', $remark->id) }}" @else href="{{ route('memo.show', $remark->id) }}" @endif>
                                        <div class="content__box__inner">
                                            <div class="common__list__head">
                                                <div class="supplement">
                                                    <span class="sub">内容</span>
                                                </div>
                                                <div class="title">
                                                    <span style="font-weight: 400;">{!! nl2br(e($remark->remarks)) ?? '未定' !!}</span>
                                                </div>
                                            </div>
                                            <div class="phone" style="margin-bottom: 5px;">
                                                <span>
                                                    <img src="{{ asset('assets/img/icon_calender_black.png') }}" alt="">
                                                    {{ date_format($remark->work_on, 'Y年m月d日') ?? '未定' }} /
                                                    @if($remark->time_type == 0)未定
                                                    @elseif($remark->time_type == 1)AM
                                                    @elseif($remark->time_type == 2)PM
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="phone">
                                                <span>
                                                    <img src="{{ asset('assets/img/icon_charge_black.png') }}" alt="">
                                                    {{ $remark->staff_name ?? '未定' }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="pc">
                    <!-- PC表示 -->
                        @if (count($memos) > 0)
                        <table class="matrer__list">
                            <thead>
                                <tr>
                                    <th>スタッフ</th>
                                    <th>日付</th>
                                    <th>メモ内容</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($memos as $remark)
                                <tr>
                                    {{--  <td>
                                        <a @if ($isCharge) href="{{ route('charge.charges.show', $charge->id) }}" @else href="{{ route('charges.show', $charge->id) }}" @endif>
                                            <span class="title">{{ $charge->name }}</span>
                                        </a>
                                    </td>  --}}
                                    <td style="white-space: nowrap;">
                                        <a @if ($isCharge) href="{{ route('charge.memo.show', $remark->id) }}" @else href="{{ route('memo.show', $remark->id) }}" @endif>
                                            {{ $remark->staff->name ?? '未定' }}
                                        </a>
                                    </td>
                                    {{--  <td>{{ $remark->work_on ?? '未定' }}</td>  --}}
                                    <td style="white-space: nowrap;">
                                        {{ date_format($remark->work_on, 'Y年m月d日') ?? '未定' }} /
                                        @if($remark->time_type == 0)未定
                                        @elseif($remark->time_type == 1)AM
                                        @elseif($remark->time_type == 2)PM
                                        @endif
                                    </td>
                                    <td>{!! nl2br(e($remark->remarks)) ?? '未設定' !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



{{--  @include("../components/head")
<body>
	<div id="app">
		<!-- スマホのみのメニューバー -->
		@include("../components/nav")
		<div class="wrap flex__wrap f__start">
			@include("../components/sidebar")
			<div class="wrap__right">
				@include("../components/header")
				<div class="allWrapper">
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

                            <!-- 更新後のメッセージ表示 -->
                            @if (session('message'))
                                <p>{{ session('message') }}</p>
                            @endif

                            <div class="content__header">
								<div class="content__title">
									<h1 class="h1">メモ一覧</h1>
									<span class="en">Memo List</span>
                                </div>
                                <div class="content__edit">
									<ul>
                                        <li>
                                            <a @if ($isCharge) href="{{ route('charge.memo.add') }}" @else href="{{ route('memo.add') }}" @endif>新規追加</a>
                                        </li>
									</ul>
								</div>
							</div>
							<div class="content__floar">
								<div class="content__floar__inner">
									<!-- スマホ表示 -->
									<div class="tab">
                                        @if (count($memos) > 0)
                                            @foreach ($memos as $remark)
                                                <div class="content__box common__list prime__list">
                                                    <a @if ($isCharge) href="{{ route('charge.memo.show', $remark->id) }}" @else href="{{ route('memo.show', $remark->id) }}" @endif>
                                                        <div class="content__box__inner">
                                                            <div class="common__list__head">
                                                                <div class="supplement">
                                                                    <span class="sub">内容</span>
                                                                </div>
                                                                <div class="title">
                                                                    <span style="font-weight: 400;">{!! nl2br(e($remark->remarks)) ?? '未定' !!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="phone" style="margin-bottom: 5px;">
                                                                <span>
                                                                    <img src="{{ asset('assets/img/icon_calender_black.png') }}" alt="">
                                                                    {{ date_format($remark->work_on, 'Y年m月d日') ?? '未定' }} /
                                                                    @if($remark->time_type == 0)未定
                                                                    @elseif($remark->time_type == 1)AM
                                                                    @elseif($remark->time_type == 2)PM
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="phone">
                                                                <span>
                                                                    <img src="{{ asset('assets/img/icon_charge_black.png') }}" alt="">
                                                                    {{ $remark->staff_name ?? '未定' }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

									<div class="pc">
                                    <!-- PC表示 -->
                                        @if (count($memos) > 0)
										<table class="matrer__list">
											<thead>
												<tr>
													<th>スタッフ</th>
													<th>日付</th>
													<th>メモ内容</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach ($memos as $remark)
												<tr>
                                                    <td style="white-space: nowrap;">
                                                        <a @if ($isCharge) href="{{ route('charge.memo.show', $remark->id) }}" @else href="{{ route('memo.show', $remark->id) }}" @endif>
                                                            {{ $remark->staff_name ?? '未定' }}
                                                        </a>
                                                    </td>
                                                    <td style="white-space: nowrap;">
                                                        {{ date_format($remark->work_on, 'Y年m月d日') ?? '未定' }} /
                                                        @if($remark->time_type == 0)未定
                                                        @elseif($remark->time_type == 1)AM
                                                        @elseif($remark->time_type == 2)PM
                                                        @endif
                                                    </td>
                                                    <td>{!! nl2br(e($remark->remarks)) ?? '未設定' !!}</td>
                                                </tr>
                                                @endforeach
											</tbody>
                                        </table>
                                        @endif
                                    </div>
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
