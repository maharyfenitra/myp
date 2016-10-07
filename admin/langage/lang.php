<?php

include '../../customer/library/include/db.php'; 
  class Lang{
  	
  	function __construct(){
  		
  	} 
  	
  	function getAllItem(){
  		$table = array();
  		$sql="select distinct item from language_items";
  		$resultat=dbQuery_($sql);
  		$i=0;
  	
  		while($rang=mysql_fetch_array($resultat)){
  			$table[$i]=$rang['item'];
  			$i++;
  		}
  		return $table;
  	}
  	function addNewItem($lang,$item,$text){
  		if($this->itemExiste($item)){
  			return false;
  		}
  		$this->insert($lang, $item, $text);
  		return true;
  	}
  	function insert($lang, $item, $text){
  		if($this->itemExiste($item)) return false;
  		$sql="INSERT language_items (lang, item,text)
  		VALUES ('$lang', '$item','$text')";
  		dbQuery_($sql);
  		return true;
  	}
  	function update($lang, $item, $text,$p_item,$p_lang){
  		
  		if($item===$p_item&&$lang===$p_lang){
  			$sql="UPDATE `language_items` SET `text`='".$text."'
  			WHERE `item`='".$p_item."' AND `lang`='".$p_lang."'";
  			dbQuery_($sql);
  			return true;
  		}
  		
  		$sql="UPDATE `language_items` SET `lang`='".$lang."' ,`item`='".$item."' ,`text`='".$text."' 
  		         WHERE `item`='".$p_item."' AND `lang`='".$p_lang."'";
  		dbQuery_($sql);
  		return true;
  	}
  	function itemExiste($item){
  		$sql="select distinct item from language_items";
  		$resultat=dbQuery_($sql);
  		while($rang=mysql_fetch_array($resultat)){
  			
  			if($item==$rang['item'])
  			{   
  				return true;
  			}
  		}
  		return false;	
  	}
  	function getLangageItem(){
  		$tableLangage=array();
  		$tableitem=$this->getAllItem();
  		foreach($tableitem as $item){
  			
  			                     $sql1=   "select `text`  from language_items where  lang='de' and item='".$item."'";
  			                     $sql2=   "select `text`  from language_items where  lang='fr' and item='".$item."'";
  			                     $sql3=   "select `text`  from language_items where  lang='it' and item='".$item."'";
  			                     $sql4=   "select `text`  from language_items where  lang='es' and item='".$item."'";
  			                     $sql5=   "select `text`  from language_items where  lang='pl' and item='".$item."'";
  			                     $sql6=   "select `text`  from language_items where  lang='nl' and item='".$item."'";
  			                     $sql7=   "select `text`  from language_items where  lang='cz' and item='".$item."'";
  			                     $sql8=   "select `text`  from language_items where  lang='_en' and item='".$item."'";

  			                     /*   union select `text` as `fr` from language_items where lang ='fr' and item='".$item."'
  			                        union select `text` as `it` from language_items where lang ='it' and item='".$item."'
  			                        union select `text` as `es` from language_items where lang ='es' and item='".$item."'
  			                        union select `text` as `pl` from language_items where lang ='pl' and item='".$item."'
  		                        	union select `text` as `nl` from language_items where lang ='nl' and item='".$item."'
  		                        	union select `text` as `cz` from language_items where lang ='cz' and item='".$item."'"; */
  			$resultat1=dbQuery_($sql1);
  			$resultat2=dbQuery_($sql2);    
  			$resultat3=dbQuery_($sql3);
  			$resultat4=dbQuery_($sql4);
  			$resultat5=dbQuery_($sql5);
  			$resultat6=dbQuery_($sql6);
  			$resultat7=dbQuery_($sql7);
  			$resultat8=dbQuery_($sql8);
  			$rang1=mysql_fetch_array($resultat1);
  			$rang2=mysql_fetch_array($resultat2);
  			$rang3=mysql_fetch_array($resultat3);
  			$rang4=mysql_fetch_array($resultat4);
  			$rang5=mysql_fetch_array($resultat5);
  			$rang6=mysql_fetch_array($resultat6);
  			$rang7=mysql_fetch_array($resultat7);
  			$rang8=mysql_fetch_array($resultat8);
  			$tableLangage[$item]= array(
  						'item' =>$item,
  						'de' => $rang1['text'],
  				        'fr' => $rang2['text'],
  				        'it' => $rang3['text'],
  				        'es' => $rang4['text'],
  				        'pl' => $rang5['text'],
  				        'nl' => $rang6['text'],
  				        'cz' => $rang7['text'],
  				        '_eng' =>$rang8['text']
  						);
  						
  		}
  		return $tableLangage;
  	}
  	
  }
  
?>