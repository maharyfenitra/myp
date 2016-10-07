<?php 
class ListEO{
private $list;
private $i;
	function __construct(){
	   $this->i=0;
	   $this->list= array();
	}
	function add($value){
		//echo $value.' </br>' ;
		$this->list[$i.'__']=$value;
		//echo $this->list[$i.'__'].'</br>';
		$this->i=$this->i+1;
		//echo $this->i.' '.$this->list[$i.'__'].'</br>';
	}
	function get($i){
		return  $this->list[$i];
	}
	function set($i,$value){
		$this->list[$i]=$value;
	}
	function contain($value){
	//	echo $value.' </br>' ;
	$l_1=$this->list;
		foreach ($l_1 as $v){
			if($v==$value){
				echo 'Contient </br>';
				
				return true;
			}
		}
		
		return false;
	}
	function getList(){
		return $this->list;
	}
	function showAllItem(){
		$l_2=$this->list;
		echo count($l_2).' ';
		foreach($l_2 as $l){
			echo $l.'</br>';
		}
		
	}
	
}
?>