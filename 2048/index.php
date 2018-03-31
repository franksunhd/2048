
<?php
require_once "./php/jssdk.php";
$jssdk = new JSSDK("wxcf974b0036523ca6", "1c3f3729adf7abf05e8f3c7e5b5a0cab");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>2048游戏</title>  
    <link rel="stylesheet" type="text/css" href="./css/2048.css"/>
</head>  
<body>  
	<!-- page01代表登录注册 -->
	<div id="page01">
		<div id="LoginBox">
			<div class="inputGroup">
				<label for="userNum">用户名:</label>
				<input type="text" id="userNum" placeholder="请输入用户名"/>
				<div id="show1" class="show"></div>
			</div>
			<div class="inputGroup">
				<label for="phoneNum">手机号:</label>
				<input type="text" name="phoneNum" id="phoneNum"  placeholder="请输入手机号"/>	
				<div id="show2" class="show"></div>
			</div>
			<div class="inputGroup">				
				<input type="button" name="btn" id="btn"/>
			</div>
		</div>
	</div>
	<!-- page02代表结束显示页面 -->
	<div id="page02">
		<div id="LoginBox1">
			<!-- 您的分数 -->
			<div class="inputGroup1">
				<div class="show1">您的成绩为:</div>
				<div id="show3" class="show1"></div>
			</div>
			<!-- 前5排名 -->
			<div class="inputGroup1">
				<table id="list" border="1" cellspacing="0" cellpadding="0">
					<thead><tr><th>序号</th><th>用户</th><th>最高记录</th></tr></thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="inputGroup1">				
				<input type="button" name="btn" id="btn1"/>
			</div>
		</div>
	</div>
	<!-- page03代表游戏界面 -->
	<div id="page03">
		<!-- 绘制标题 -->  
		<header>  
		    <h2>
			    	<span style="color: indianred;">2</span>
			    	<span style="color: lawngreen;">0</span>
			    	<span style="color: orange;">4</span>
			    	<span style="color: dodgerblue;">8</span>
		    </h2>  
		    <button id="newgamebutton">开启新游戏</button>  
		    <p id="score1">目前得分:<span id="score">0</span></p>  
		</header>  
		<!-- 绘制棋盘格 -->  
		<div id="grid-container">  
		    <div class="grid-cell" id="grid-cell-0-0"></div>  
		    <div class="grid-cell" id="grid-cell-0-1"></div>  
		    <div class="grid-cell" id="grid-cell-0-2"></div>  
		    <div class="grid-cell" id="grid-cell-0-3"></div>  
		  
		    <div class="grid-cell" id="grid-cell-1-0"></div>  
		    <div class="grid-cell" id="grid-cell-1-1"></div>  
		    <div class="grid-cell" id="grid-cell-1-2"></div>  
		    <div class="grid-cell" id="grid-cell-1-3"></div>  
		  
		    <div class="grid-cell" id="grid-cell-2-0"></div>  
		    <div class="grid-cell" id="grid-cell-2-1"></div>  
		    <div class="grid-cell" id="grid-cell-2-2"></div>  
		    <div class="grid-cell" id="grid-cell-2-3"></div>  
		  
		    <div class="grid-cell" id="grid-cell-3-0"></div>  
		    <div class="grid-cell" id="grid-cell-3-1"></div>  
		    <div class="grid-cell" id="grid-cell-3-2"></div>  
		    <div class="grid-cell" id="grid-cell-3-3"></div>  
		</div>  
	</div>

</body>  
</html>  
<script src="js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="./js/touch.js"></script>  
<script type="text/javascript" src="./js/support2048.js"></script>  
<script type="text/javascript" src="./js/showAnimation.js"></script>  
<script type="text/javascript" src="./js/main2048.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
	$(function(){
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
		  wx.ready(function () {
    			// 在这里调用 API
    				// 分享给朋友
    				wx.onMenuShareAppMessage({
    					title: '分享给朋友', // 分享标题
    					desc: '这是我做的2048游戏', // 分享描述
    					link: 'http://1.franksunhd1.applinzi.com/2048/index.php', 
    					imgUrl: 'http://1.franksunhd1.applinzi.com/jssdk/01.jpg',
    					success: function () {
    						// 用户确认分享后执行的回调函数
    						alert("分享成功!");
    					},
    					cancel: function () {
    						// 用户取消分享后执行的回调函数
    						alert("分享失败!");
    					}
    				});
    			
    				// 分享到朋友圈
			    wx.onMenuShareTimeline({
			    title: '分享到朋友圈', // 分享标题
			    link: 'http://1.franksunhd1.applinzi.com/2048/index.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
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
    			
      			wx.onMenuShareQQ({
      				title: '分享到QQ', // 分享标题
      				desc: '这是我做的2048游戏', // 分享描述
      				link: 'http://1.franksunhd1.applinzi.com/2048/index.php', // 分享链接
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
    			
    		  });
	});
</script>