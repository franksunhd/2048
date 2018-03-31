<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxcf974b0036523ca6", "1c3f3729adf7abf05e8f3c7e5b5a0cab");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
  <title></title>
  <style type="text/css">
  	body {
  		background-color: #0f0;
  		font-size: 50px;
  	}
  </style>
</head>
<body>
  <p>测试页面</p>
  <p><a href="./aa.html">古诗</a></p>
  <button id="btn1"> 打开相机</button>
  <button id="btn2"> 打开相册</button>
  <button id="btn3"> 上传图片</button>
  <button id="btn4"> 下载图片</button>
  <button id="btn5"> 获取网络状态接口</button>
  <button id="btn6"> 关闭当前页面</button>
  <button id="btn7"> 微信扫一扫</button>
  <button id="btn8"> 共享收货地址接口</button>
  <div id="img1"><img src="01.jpg"/></div>
  
</body>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入
   * 	“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，
   * 	Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：
   * 	http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，
   * 如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，	
   * 可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  
  // 通过config接口注入权限验证配置
  wx.config({
    debug: false,  // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      "onMenuShareTimeline","onMenuShareAppMessage","onMenuShareQQ","onMenuShareWeibo",
      "onMenuShareQZone","startRecord","stopRecord","onVoiceRecordEnd","playVoice",
      "pauseVoice","stopVoice","onVoicePlayEnd","uploadVoice","downloadVoice","chooseImage",
      "previewImage","uploadImage","downloadImage","translateVoice","getNetworkType","openLocation",
      "getLocation","hideOptionMenu","showOptionMenu","hideMenuItems","showMenuItems",
      "hideAllNonBaseMenuItem","showAllNonBaseMenuItem","closeWindow","scanQRCode",
      "chooseWXPay","openProductSpecificView","addCard","chooseCard","openCard"
    ]
  });
  
  // 通过 ready 接口处理验证成功的验证
  wx.ready(function () {
    // 在这里调用 API
    
    // 分享到朋友圈
    wx.onMenuShareTimeline({
    title: '分享到朋友圈', // 分享标题
    link: 'http://1.franksunhd1.applinzi.com/jssdk/aa.html', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
    imgUrl: 'http://1.franksunhd1.applinzi.com/jssdk/01.jpg', // 分享图标
    success: function () {
    // 用户确认分享后执行的回调函数
    		alert("分享成功!");
	},
	
	cancel: function () {
	    // 用户取消分享后执行的回调函数
			alert("分享失败!");
	    }
	});
	
	// 分享给朋友
	wx.onMenuShareAppMessage({
		title: '分享给朋友', // 分享标题
		desc: '这是我的微信接口测试', // 分享描述
		link: 'http://1.franksunhd1.applinzi.com/jssdk/aa.html', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
		imgUrl: 'http://1.franksunhd1.applinzi.com/jssdk/01.jpg', // 分享图标
		type: '', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function () {
			// 用户确认分享后执行的回调函数
			alert("分享成功!");
		},
		cancel: function () {
			// 用户取消分享后执行的回调函数
			alert("分享失败!");
		}
	});
	
	// 分享到 QQ
	
	wx.onMenuShareQQ({
		title: '分享到QQ', // 分享标题
		desc: '这是我的微信接口测试', // 分享描述
		link: 'http://1.franksunhd1.applinzi.com/jssdk/aa.html', // 分享链接
		imgUrl: 'http://1.franksunhd1.applinzi.com/jssdk/01.jpg', // 分享图标
		success: function () {
			// 用户确认分享后执行的回调函数
			alert("分享成功!");
		},
		cancel: function () {
			// 用户取消分享后执行的回调函数
			alert("分享失败!");
		}
	});
	
	
	$("#btn1").click(function(){
		// 拍照接口
		wx.chooseImage({
			count: 9, // 默认9
			sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
			sourceType: ['camera'], // 可以指定来源是相册还是相机，默认二者都有
			success: function (res) {
			var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			}
		});
	});
	
	$("#btn2").click(function(){
		// 从手机相册中选图接口
		wx.chooseImage({
			count: 9, // 默认9
			sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
			sourceType: ['album'], // 可以指定来源是相册还是相机，默认二者都有
			success: function (res) {
			var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			}
		});
	});
	
	// 预览图片
	$("#img1").click(function(){
		wx.previewImage({
		current: 'http://1.franksunhd1.applinzi.com/jssdk/01.jpg', // 当前显示图片的http链接
		urls: ['http://1.franksunhd1.applinzi.com/jssdk/01.jpg'] // 需要预览的图片http链接列表
		});
	});
	
	// 上传图片
	$("#btn3").click(function(){
		wx.uploadImage({
			localId: '', // 需要上传的图片的本地ID，由chooseImage接口获得
			isShowProgressTips: 1, // 默认为1，显示进度提示
			success: function (res) {
				var serverId = res.serverId; // 返回图片的服务器端ID
			}
		});
	});
	
	// 下载图片
	$("#btn4").click(function(){
		wx.downloadImage({
			serverId: 'http://1.franksunhd1.applinzi.com/jssdk/01.jpg', // 需要下载的图片的服务器端ID，由uploadImage接口获得
			isShowProgressTips: 1, // 默认为1，显示进度提示
			success: function (res) {
				var localId = res.localId; // 返回图片下载后的本地ID
			}
		});
	});
	
	// 获取网络状态接口
	$("#btn5").click(function(){
		wx.getNetworkType({
		success: function (res) {
			var networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
			}
		});
	});
	
	// 关闭当前页面
	$("#btn6").click(function(){
		wx.closeWindow();
	});
	
	// 微信扫一扫
	$("#btn7").click(function(){
		wx.scanQRCode({
		needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
		scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
		success: function (res) {
			var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
			}
		});
	});
	
	// 共享收货地址接口
	$("#btn8").click(function(){
		wx.openAddress({
		success: function (res) {
			var userName = res.userName; // 收货人姓名
			var postalCode = res.postalCode; // 邮编
			var provinceName = res.provinceName; // 国标收货地址第一级地址（省）
			var cityName = res.cityName; // 国标收货地址第二级地址（市）
			var countryName = res.countryName; // 国标收货地址第三级地址（国家）
			var detailInfo = res.detailInfo; // 详细收货地址信息
			var nationalCode = res.nationalCode; // 收货地址国家码
			var telNumber = res.telNumber; // 收货人手机号码
			}
		});
	});
	
	
  });
</script>
</html>
