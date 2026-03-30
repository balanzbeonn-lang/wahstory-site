<?php 
class myCart{

	public function getProducts($whereCond = array('cat'=>''),$orderBy = array('id'=>'desc'),$limit = array(0,PAGESIZE)){
	$result = array();
		//Setting Basic SQL Query
		$sql = "SELECT * from `products` WHERE 1=1 ";
		//Checking if Where Condition
		if(!empty($whereCond)){
			foreach( $whereCond as $k=>$v){
				$sql .= " AND `".$k."`='".$v."'" ;  			
			}
		}
		//Checking if Order by cluase set
		if(!empty($orderBy )){
			foreach($orderBy as $ko=>$vo){
				$sql .= " ORDER BY $ko $vo ";
			}
		}
		//Setting Limit 
		if(!empty($limit)){
		// foreach($limit as $kl=>$vl){
				$sql .= "LIMIT $limit[0], $limit[1]";
			//}
		}
		
		$r = executeQuery($sql);
		while($rec = mysqli_fetch_object($r)){
			$result[] = $rec;
		}
		return $result;

	}
	
	function getCategory($catId){
		if($catId==''){
			echo "Sorry! No Category Id found. Please provide Category id to proceed";
			exit;
		}
		$sql = executeQuery("SELECT * FROM `category` WHERE 1=1 AND `id`='".$catId."'");
		$Record = mysqli_fetch_object($sql);
		return $Record;
	
	}
	
	function getCatTitle($id){
		$rec = getSingleResult("SELECT title from `category` where `id` = '".$id."'");
		return $rec;
	}
	
	function getProductFldById($fld,$pid){
		return getSingleResult("SELECT `".$fld."` FROM `products` WHERE `id` = '".$pid."'");
	}
	
	function getProductTitle($pid){
		return $this->getProductFldById("title",$pid);
	}
	
	function getProductImageUrl($pid){
		$imgName = $this->getProductFldById("image",$pid);
		$url = ADMIN_URL."uploads/".$imgName;
		return $url;
	}
	function getProductPrice($pid){
		$price = $this->getProductFldById("price",$pid);
		return $price;
	}
	
	function getAllTempOrder($uid){
		$tempOrder = getSingleResult("SELECT count(*) from `temp_order` WHERE `uid` = '".$uid."' and `order_status` = '0'");
		if($tempOrder<1){
			return false;
		}
		$sql = executeQuery("SELECT * FROM `temp_order` WHERE `uid` = '".$uid."' and `order_status` = 0 GROUP BY `pid`");
		while($res = mysqli_fetch_array($sql)){
			$Record[] = $res;
		}
		return $Record;
	}
	
	function getTotalQty($pid){
		return getSingleResult("SELECT `qty` FROM `temp_order` WHERE `pid` = '".$pid."' ");
	}
	
	function getCartQty($pid){
		return getSingleResult("SELECT `qty` FROM `temp_order` WHERE `pid` = '".$pid."' and `uid`='".$_SESSION['USER_ID']."' and `order_status` = '0' ");
	}
	
	function getCartCount($uid){
		$tempOrder = getSingleResult("SELECT count(*) from `temp_order` WHERE `uid` = '".$uid."' and `order_status` = '0'");
		if($tempOrder>0){
			return true;
		}
		return false;
	}
	
	
	function getProductsByType($type){
		
	}
}


?>