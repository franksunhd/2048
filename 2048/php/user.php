<?php
	header("Content-Type:text/html;charset=UTF-8;");
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$score = $_POST['score'];
	$con = mysqli_connect("w.rdc.sae.sina.com.cn",'2xlomwm4xz','zi5j04ji1i5wzl535k5lmi52yji0m4jwmhmx5ji4','app_franksunhd1','3306');
	if(!$con) {
		exit("数据库链接失败");
	}
	mysqli_set_charset($con,'UTF8');
	
	$sql = "select * from app where App_phone='{$phone}'";
	$result  = mysqli_query($con, $sql);
	$num = mysqli_num_rows($result);
	$JsonArr = array();
	if($num >= 1){
		// 有这个用户,然后判断当前值是不是大于那个值,大于则更新,小于则不动
		$arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$jsonScore = $arr[0]['App_score'];
		//当前分数超出 数据库的分数,则更新
		if($score > intval($jsonScore)){
			$sql2 = "update app set App_score = '{$score}' where App_phone = '{$phone}'";
			$result  = mysqli_query($con, $sql2);
			// 插入完成取出降序前5
			$sql1 = "SELECT * FROM app ORDER BY App_score DESC limit 5";
			$result1  = mysqli_query($con, $sql1);
			$arr1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
			if($result1 && $result){
				$JsonArr[0] = 1;  // 取值成功
				$JsonArr[1] = $arr1;
			} else {
				$JsonArr[0] = 2; // 取值失败
			}
		} else {
			// 插入完成取出降序前5
			$sql1 = "SELECT * FROM app ORDER BY App_score DESC limit 5";
			$result1  = mysqli_query($con, $sql1);
			$arr1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
			if($result1){
				$JsonArr[0] = 1;  // 取值成功
				$JsonArr[1] = $arr1;
			} else {
				$JsonArr[0] = 2; // 取值失败
			}
		}
	} else {
		// 没有这个用户
		$sql1 = "insert into app(`App_name`,`App_phone`,`App_score`) values('{$name}','{$phone}','{$score}')";
		$result  = mysqli_query($con, $sql1);
		// 插入完成取出降序前5
		$sql1 = "SELECT * FROM app ORDER BY App_score DESC limit 5";
		$result1  = mysqli_query($con, $sql1);
		$arr1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
		if($result1 && $result){
			$JsonArr[0] = 1;  // 取值成功
			$JsonArr[1] = $arr1;
		} else {
			$JsonArr[0] = 2; // 取值失败
		}
	}

	$json = json_encode($JsonArr);
	echo $json;
	mysqli_close($con);
	
	
?>