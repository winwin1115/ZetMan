@extends('layouts.public')
@section('title', '広告出稿仮登録完了')
@section('content')
    <div class="allWrapper input__area">
        <div class="content__wrap">
            <div class="content__section">
                <div class="content__header">
                    <div class="content__title">
                        <h1 class="h1">契約完了</h1>
                        <span class="en">Member Registration Completed</span>
                    </div>
                </div>
                <div class="content__floar">
                    <div class="content__floar__inner">
                        <div class="content__box">
                            <div class="content__box__inner">
                                <div class="content__text">
                                    <p>契約が完了しました。<br>本日より広告が開始します。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content__submit f__center">
            <div class="submit__box">
                <a href="/sponcer">広告を確認する</a>
            </div>
        </div>
    </div>
@endsection
{{--  @include("../components/head")
<body>
	<div id="app">
		<div class="wrap flex__wrap f__start input__area">
			<div class="wrap__center">
				<div class="allWrapper">
					<div class="content__wrap">
						<div class="content__section">

							<div class="content__header">
								<div class="content__title">
									<h1 class="h1">契約完了</h1>
									<span class="en">Member Registration Completed</span>
								</div>
							</div>

							<div class="content__floar">
								<div class="content__floar__inner">
									<div class="content__box">
										<div class="content__box__inner">
											<div class="content__text">
												<p>契約が完了しました。<br>本日より広告が開始します。</p>
											</div>
										</div>
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
