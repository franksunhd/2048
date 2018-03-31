/** 
 * Created by Kay on 2016/3/7. 
 */

// --------------------------------------------------------------------------------------------------------------------  
var board = new Array();
var score = 0;
var hasConflicted = new Array(); // 用来判断每个格子是否已经发生过碰撞，从而避免一下子加好几个格子  
$(document).ready(function(){
	newgame();
});

$("#btn1").click(function() {
	newgame();
	$("#page02").css("display", "none");
});

function newgame() {
	// 初始化棋盘格  
	init();
	// 在随机两个格子生成数字  
	generateOneNumber();
	generateOneNumber();
}

// --------------------------------------------------------------------------------------------------------------------  
/* 
 *  1、初始化棋盘格 gridCell 
 *  2、初始化二维数组 用于存储数据 board 
 *  3、初始化数据 清零 updateBoardView(); 
 */
var flag = false;

function init() {
	flag = true;
	for(var i = 0; i < 4; i++)
		for(var j = 0; j < 4; j++) {
			var gridCell = $("#grid-cell-" + i + "-" + j);
			gridCell.css('top', getPosition(i));
			gridCell.css('left', getPosition(j));
		}

	for(var i = 0; i < 4; i++) {
		board[i] = new Array();
		hasConflicted[i] = new Array();
		for(var j = 0; j < 4; j++) {
			board[i][j] = 0;
			hasConflicted[i][j] = false;
		}
	}

	updateBoardView();

	score = 0;

	updateScore(score);

}

// --------------------------------------------------------------------------------------------------------------------  
// 初始化数据，就是将数据可视化！根据board[i][j]存的数值来画图！  
function updateBoardView() {
	$(".number-cell").remove();
	for(var i = 0; i < 4; i++)
		for(var j = 0; j < 4; j++) {
			$("#grid-container").append('<div class="number-cell" id="number-cell-' + i + '-' + j + '"></div>');
			var theNumberCell = $('#number-cell-' + i + '-' + j);

			if(board[i][j] == 0) {
				theNumberCell.css("width", "px");
				theNumberCell.css("height", "0px");
				theNumberCell.css("top", getPosition(i) + 50);
				theNumberCell.css("left", getPosition(j) + 50);
			} else {
				theNumberCell.css('width', '60px');
				theNumberCell.css('height', '60px');
				theNumberCell.css('top', getPosition(i));
				theNumberCell.css('left', getPosition(j));
				theNumberCell.css('background-color', getNumberBackgroundColor(board[i][j]));
				theNumberCell.css('color', getNumberColor(board[i][j]));
				theNumberCell.text(board[i][j]);
			}
			hasConflicted[i][j] = false;
		}
}

// --------------------------------------------------------------------------------------------------------------------  
// 随机选一个格子生成一个数字  
function generateOneNumber() {

	if(nospace(board))
		return false;

	// 随机一个位置  
	var randx = parseInt(Math.floor(Math.random() * 4));
	var randy = parseInt(Math.floor(Math.random() * 4));

	// 设置一个时间参数，50次以内系统还未生成一个空位置，那么就进行人工找一个空位置  
	var times = 0;
	while(times < 50) {
		if(board[randx][randy] == 0)
			break;

		randx = parseInt(Math.floor(Math.random() * 4));
		randy = parseInt(Math.floor(Math.random() * 4));

		times++;
	}
	if(times == 50) {
		for(var i = 0; i < 4; i++)
			for(var j = 0; j < 4; j++) {
				if(board[i][j] == 0) {
					randx = i;
					randy = j;
				}
			}
	}

	// 随机一个数字  
	var randNumber = Math.random() < 0.5 ? 2 : 4;

	// 在随机位置显示随机数字  
	board[randx][randy] = randNumber;
	showNumberWithAnimation(randx, randy, randNumber);

	return true;
}

// --------------------------------------------------------------------------------------------------------------------  
// 移动端和 pc 端检测函数
function browserRedirect() {
	var sUserAgent = navigator.userAgent.toLowerCase();
	var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
	var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
	var bIsMidp = sUserAgent.match(/midp/i) == "midp";
	var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
	var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
	var bIsAndroid = sUserAgent.match(/android/i) == "android";
	var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
	var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
	if(bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
		// 移动端
		touch.on('#page03', 'touchstart', function(ev) {
			ev.preventDefault();
		});
		touch.on('#page03', 'swiperight', function(ev) {
			// 向右滑动
			if(moveRight()) {
				setTimeout("generateOneNumber()", 210);
				setTimeout("isgameover()", 300);
			};
		});
		touch.on('#page03', 'swipeleft', function(ev) {
			// 向左滑动
			if(moveLeft()) {
				setTimeout("generateOneNumber()", 210);
				setTimeout("isgameover()", 300);
			};
		});
		touch.on('#page03', 'swipeup', function(ev) {
			// 向上滑动
			if(moveUp()) {
				setTimeout("generateOneNumber()", 210);
				setTimeout("isgameover()", 300);
			};
		});
		touch.on('#page03', 'swipedown', function(ev) {
			// 向下滑动
			if(moveDown()) {
				setTimeout("generateOneNumber()", 210);
				setTimeout("isgameover()", 300);
			};
		});

		touch.on('#newgamebutton', 'tap click', function() {
			newgame();
		});
	} else {
		// PC 端
		// 判断键盘的响应时间 上下左右
		$(document).keydown(function(event) {
			switch(event.keyCode) {
				case 37: // left 向左移动  
					if(moveLeft()) {
						setTimeout("generateOneNumber()", 210);
						setTimeout("isgameover()", 300);
					};
					break;
				case 38: // up 向上移动  
					if(moveUp()) {
						setTimeout("generateOneNumber()", 210);
						setTimeout("isgameover()", 300);
					};
					break;
				case 39: // right 向右移动  
					if(moveRight()) {
						setTimeout("generateOneNumber()", 210);
						setTimeout("isgameover()", 300);
					};
					break;
				case 40: // down 向下移动  
					if(moveDown()) {
						setTimeout("generateOneNumber()", 210);
						setTimeout("isgameover()", 300);
					};
					break;
			}
		});
	}
}
browserRedirect();

// --------------------------------------------------------------------------------------------------------------------  
// 向左移动  
function moveLeft() {

	// 1、首先，判断能否向左移动  
	if(!canMoveLeft(board))
		return false;

	/*2、如果可以向左移动： 
	 *   ①当前的数字是否为0，不为0则进行左移 board[i][j] != 0 
	 *   ②如果左侧为空格子，则数字进行一个移位操作 board[i][k] == 0 
	 *   ③如果左侧有数字且不相等，则数字还是进行移位操作 noBlockHorizontal 
	 *   ④如果左侧有数字且相等，则数字进行相加操作 board[i][k] == board[i][j] 
	 */
	for(var i = 0; i < 4; i++)
		for(var j = 1; j < 4; j++) {
			if(board[i][j] != 0) {
				for(var k = 0; k < j; k++) {
					if(board[i][k] == 0 && noBlockHorizontal(i, k, j, board)) {
						//move  
						showMoveAnimation(i, j, i, k);
						board[i][k] = board[i][j];
						board[i][j] = 0;
						continue;
					} else if(board[i][k] == board[i][j] && noBlockHorizontal(i, k, j, board) && !hasConflicted[i][k]) {
						//move  
						showMoveAnimation(i, j, i, k);
						//add  
						board[i][k] += board[i][j];
						board[i][j] = 0;
						//add score  
						score += board[i][k];
						updateScore(score);

						hasConflicted[i][k] = true;
						continue;
					}
				}
			}
		}
	// 3、初始化数据 updateBoardView()  
	// 为显示动画效果，设置该函数的等待时间200毫秒  
	setTimeout("updateBoardView()", 200);
	return true;
}

// --------------------------------------------------------------------------------------------------------------------  
// 向上移动  
function moveUp() {

	if(!canMoveUp(board))
		return false;

	//moveUp  
	for(var j = 0; j < 4; j++)
		for(var i = 1; i < 4; i++) {
			if(board[i][j] != 0) {
				for(var k = 0; k < i; k++) {
					if(board[k][j] == 0 && noBlockVertical(j, k, i, board)) {
						//move  
						showMoveAnimation(i, j, k, j);
						board[k][j] = board[i][j];
						board[i][j] = 0;
						continue;
					} else if(board[k][j] == board[i][j] && noBlockVertical(j, k, i, board) && !hasConflicted[k][j]) {
						//move  
						showMoveAnimation(i, j, k, j);
						//add  
						board[k][j] += board[i][j];
						board[i][j] = 0;
						//add score  
						score += board[k][j];
						updateScore(score);

						hasConflicted[k][j] = true;
						continue;
					}
				}
			}
		}
	setTimeout("updateBoardView()", 200);
	return true;
}

// --------------------------------------------------------------------------------------------------------------------  
// 向右移动  
function moveRight() {
	if(!canMoveRight(board))
		return false;

	//moveRight  
	for(var i = 0; i < 4; i++)
		for(var j = 2; j >= 0; j--) {
			if(board[i][j] != 0) {
				for(var k = 3; k > j; k--) {
					if(board[i][k] == 0 && noBlockHorizontal(i, j, k, board)) {
						//move  
						showMoveAnimation(i, j, i, k);
						board[i][k] = board[i][j];
						board[i][j] = 0;
						continue;
					} else if(board[i][k] == board[i][j] && noBlockHorizontal(i, j, k, board) && !hasConflicted[i][k]) {
						//move  
						showMoveAnimation(i, j, i, k);
						//add  
						board[i][k] += board[i][j];
						board[i][j] = 0;
						//add score  
						score += board[i][k];
						updateScore(score);

						hasConflicted[i][k] = true;
						continue;
					}
				}
			}
		}
	setTimeout("updateBoardView()", 200);
	return true;
}

// --------------------------------------------------------------------------------------------------------------------  
// 向下移动  
function moveDown() {
	if(!canMoveDown(board))
		return false;

	//moveDown  
	for(var j = 0; j < 4; j++)
		for(var i = 2; i >= 0; i--) {
			if(board[i][j] != 0) {
				for(var k = 3; k > i; k--) {
					if(board[k][j] == 0 && noBlockVertical(j, i, k, board)) {
						//move  
						showMoveAnimation(i, j, k, j);
						board[k][j] = board[i][j];
						board[i][j] = 0;
						continue;
					} else if(board[k][j] == board[i][j] && noBlockVertical(j, i, k, board) && !hasConflicted[k][j]) {
						//move  
						showMoveAnimation(i, j, k, j);
						//add  
						board[k][j] += board[i][j];
						board[i][j] = 0;
						//add score  
						score += board[k][j];
						updateScore(score);

						hasConflicted[k][j] = true;
						continue;
					}
				}
			}
		}
	setTimeout("updateBoardView()", 200);
	return true;
}

// --------------------------------------------------------------------------------------------------------------------  

// 游戏结束
function isgameover() {
	if(nospace(board) && nomove(board)) {
		if(flag) {
			gameover();
			over();
			flag = false;
		}
	}
}

function over() {
	// 游戏结束,将分数,姓名,手机提交到数据库
	$.ajax({
		type: "post",
		url: "./php/user.php",
		async: true,
		data: {
			name: localStorage.name,
			phone: localStorage.phone,
			score: score
		},
		success: function(data) {
			// 1代表更新数据成功.2代表更新失败,3代表插入成功,4代表插入失败,5代表没有更新数据
			// 6代表取值成功,7代表取值失败
			var ArrData = JSON.parse(data); // 数据对象类型
			if(ArrData[0] == 1) {
				// 插入成功,取值成功
				var html = '';
				for(var i = 0; i < ArrData[1].length; i++) {
					var j = 1 + i;
					html += "<tr><td>" + j + "</td><td>" + ArrData[1][i]['App_name'] + "</td><td>" + ArrData[1][i]['App_score'] + "</td></tr>";
				}
				$("#list tbody").append(html);
				$("#show3").text(score);
				$("#page02").css("display", "block");
			} else {
				console.log("失败了!");
			}
		}
	});
}

$("#page02").click(function() {
	$(this).css("display", "none");
	newgame();
});

function gameover() {
	alert("游戏结束: 你的得分是:" + score);
}

$("#btn").click(function() {
	var name = $.trim($("#userNum").val());
	var phone = $.trim($("#phoneNum").val());
	if(name == "") {
		$('#show1').text("请输入你的昵称!");
	} else {
		$('#show1').text("");
		if(phone == "") {
			$('#show2').text("请输入你的手机号!");
		} else {
			if(!checkPhone(phone)){
				$('#show2').text("手机格式不正确!");
			} else {
				$('#show2').text("");
				localStorage.name = name;
				localStorage.phone = phone;
				$("#page01").css("display", "none");
				$("#page03").css("display", "block");
			}
			
		}
	}
});

function checkPhone(phone){ 
    if(!(/^1[34578]\d{9}$/.test(phone)))
    return false;
    return true;
}