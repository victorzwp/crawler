<?php
/**
  *爬虫数据分析器1.0
  *copyright icecoding
  *
  */

include "../config.php";

$history_id=$_GET['id'];//初始化历史id

/*
 *返回当前关键字（或用户名）的id
 *返回int
 *每个分析都有相应的唯一的id对应
 */
function getId(){

global $history_id;
return $history_id;

}


/*
 *返回当前关键字（或用户名）
 *返回string
 */
function getHistoryName(){

$resultarray=getconf('crawler_history',' where history_id = '.getId());

return $resultarray[0][1];

}


/*
 *返回当前使用的是三个模版类中的哪一个，方便对其做出符合此类别个性的定制化应用。
 *返回int 1代表第一类模版，2代表第二类，3代表第三类
 */
function getModelCategory(){

$resultarray=getconf('crawler_history',' where history_id = '.getId());

//print_r($resultarray);

return $resultarray[0][2];

}



/*
 *返回所有用户此次分析选用的模版对应的id
 *返回一个数组
 */


function getAllModelId(){
	
	$resultarray=getconf('crawler_contents',' where history_id = '.getId());
	$idarray=array();
	for($i=0;$i<count($resultarray);$i++){
		if(in_array($resultarray[$i][3],$idarray)){
			continue;
			
		}else{
		$idarray[]=$resultarray[$i][3];
		}
	}
	//print_r($idarray);
	return $idarray;
}


/*
 *返回某个模版的model_id对应的模版名
 *返回一个字符串
 */


function getModelName($model_id){
	
	$resultarray=getconf('crawler_model_category',' where model_id = '.$model_id);

	return $resultarray[0][2];
}





/*根据传入的modelid
 *返回当前用户名的所有好友列表
 *返回数组存放所有好友名
 */


function getFriendslist($model_id){
	
	$resultarray=getconf('crawler_contents',' where history_id = '.getId().' and rc_id = 2 and mc_id = '.$model_id);
	$namearray=split(',',$resultarray[0][1]);
	//print_r($namearray);
	return $namearray;
}



/*返回当所有文章列表
 *根据传入的modelid 若没有传id则获取所有调用模版的文章，若有id就根据传入的模版的id获取文章
 *返回数组
 */


function getArticles($model_id=-1){
	
	if($model_id==-1){
		
		$resultarray=getconf('crawler_contents',' where history_id = '.getId().' and rc_id = 1');
		
	}else{
		$resultarray=getconf('crawler_contents',' where history_id = '.getId().' and rc_id = 1 and mc_id = '.$model_id);
		
		
	}
	
	
	
	//$namearray=split(',',$resultarray[0][1]);
	//print_r($resultarray);
	return $resultarray;
}




/*返回当所有状态
 *根据传入的modelid 若没有传id则获取所有调用模版的状态，若有id就根据传入的模版的id获取状态
 *返回数组
 */


function getSays($model_id=-1){
	
	if($model_id==-1){
		
		$resultarray=getconf('crawler_contents',' where history_id = '.getId().' and rc_id = 3');
		
	}else{
		$resultarray=getconf('crawler_contents',' where history_id = '.getId().' and rc_id = 3 and mc_id = '.$model_id);
		
		
	}
	
	
	
	//$namearray=split(',',$resultarray[0][1]);
	//print_r($resultarray);
	return $resultarray;
}







?>