
<?php
function is_mobile () {
	$useragents = array('iPhone','iPod','Android.*Mob','Opera.*Mini','blackberry','Windows.*Phone');
	$pattern = '/'.implode('|', $useragents).'/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-language" content="ja">
	<meta name="format-detection" content="telephone=no">
	<title>CATTOBI</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}?<?php echo date('Ymd-Hi'); ?>">

	<!-- favicon -->
	<link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="16x16" type="image/png" />
	<link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32" type="image/png" />
	<link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="48x48" type="image/png" />
	<link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="62x62" type="image/png" />
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />

    <!-- スマホ用アイコン -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/favicon.png') }}" />

    <!-- vue.js IE対応 -->
    <script src="https://www.promisejs.org/polyfills/promise-6.1.0.min.js"></script>
</head>
