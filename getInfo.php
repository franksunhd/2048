<?php
	header("Content-Type:text/html;charset=UTF-8");
	include 'network.php';
	// 授权:第一步,获取 code, 也就是把要执行的 url 放到微信特定的一个连接里面,
	// 然后执行,执行后的页面也可以直接通过 get 请求的方式获取 code
	$code = $_GET['code'];

	// 第二步,根据 code 换取微信网页授权的 access_toen,此Token非彼 token
	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxcf974b0036523ca6&secret=1c3f3729adf7abf05e8f3c7e5b5a0cab&code={$code}&grant_type=authorization_code";
	echo httpGet($url);
?>