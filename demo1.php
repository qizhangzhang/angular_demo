<?php
	$type = $_POST["type"];
	
	if(isset($type)){//存在为true
			
		if($type == "checkBookname"){
			$flag = "";
			$json = file_get_contents("user1.json"); //获取user1.json里的数据 json格式
			$arr_json = json_decode($json,true);//将json格式的数据转化为数组类型的数据
			echo json_encode($arr_json); //echo 返回前台的值  json_encode 将数组类型转换为json类型的数据
		}
		
		if($type == "insert"){
			$flag = true;
			$id = $_POST['id'];
			$bookName = $_POST["bookName"];
			$writer = $_POST["writer"];
			
			$array = array('id'=>$id,'bookName' => $bookName,'writer' => $writer);
			
			$json = file_get_contents("user1.json");
			$arr_json = json_decode($json,true);
			
			array_push($arr_json,$array);
			
			$json = json_encode($arr_json);
			file_put_contents("user1.json",$json);
			
			echo json_encode($json);
		}
		//删除
		if($type == 'detele'){
			// $flag = true;
			$bookName = $_POST['bookName'];
			$json = file_get_contents('user1.json');
			$arr_json = json_decode($json,true);

			for($i = 0;$i<count($arr_json);$i++){
				if($arr_json[$i]['bookName'] == $bookName){
					array_splice($arr_json,$i,1);
					$flag = true;
					//编码json文件
					$json = json_encode($arr_json);
					// 保存文件
					file_put_contents('user1.json', $json);
				}
			}
			echo json_encode($json);
		}
		// 修改
		if($type == 'amend'){
			$flag = true;
			$id = $_POST['id'];
			$bookName = $_POST['bookName'];
			$writer = $_POST['writer'];
			$json = file_get_contents('user1.json');
			$arr_json = json_decode($json,true);

			for($i = 0;$i<count($arr_json);$i++){
				if($arr_json[$i]['id'] == $id){
					$arr_json[$i]['bookName'] = $bookName;
					$arr_json[$i]['writer'] = $writer;
					
					//编码json文件
					$json = json_encode($arr_json);
					//保存文件
					file_put_contents('user1.json',$json);
					echo json_encode($json);
				}
			}
			
		}
	}
	
?>