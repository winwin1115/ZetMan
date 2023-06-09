@extends('layouts.public')
@section('title', '広告出稿仮登録完了')
@section('content')
    <div class="content__header">
        <div class="content__title">
            <h1 class="h1">おすすめ足場業者</h1>
            <span class="en">Recommended Company</span>
        </div>
    </div>
    <div class="content__floar">
        <div class="content__floar__inner">
            <div class="content__box">
                <div class="content__box__inner">
                    @foreach ($advertisements as $advertisement)
                    <div class="content__input">
                        <div class="headline sponcer_name">{{ $advertisement->company }}</div>
                        <div class="input__sponcer">
                            <a href="{{ $advertisement->url }}"><img src="{{ $advertisement->img_url }}" target="_blank" rel="noopener"></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

{{--  @include("../components/head")
<body>
    <div class="wrap flex__wrap f__start f__center">
        <div class="wrap__center">
            <div class="allWrapper input__area">
                <div class="content__wrap">
                    <div class="content__section">

                        <div class="content__header">
                            <div class="content__title">
                                <h1 class="h1">おすすめ足場業者</h1>
                                <span class="en">Recommended Company</span>
                            </div>
                        </div>
                        <div class="content__floar">
                            <div class="content__floar__inner">
                                <div class="content__box">
                                    <div class="content__box__inner">
                                        @foreach ($advertisements as $advertisement)
                                        <div class="content__input">
                                        <div class="headline sponcer_name">{{ $advertisement->company }}</div>
                                        <div class="input__sponcer">
                                            <a href="{{ $advertisement->url }}"><img src="{{ $advertisement->img_url }}" target="_blank" rel="noopener"></a>
                                        </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>  --}}
