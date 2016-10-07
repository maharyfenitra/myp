<?php 
//include '../../library/example.php';
include 'lang.php';

$lang = new Lang();
$t=$lang->getLangageItem();
$n=count($t);
$page=1;

if(isset($_GET['page'])){
	$page=$_GET['page'];
}
$next_page=$page+1;
$next_10_page=$page+10;
$prev_10_page=$page;
$prev_page=$page;
if($page>1){
	$prev_page=$page-1;
}
if($page>10){
	$prev_10_page=$page-10;
}
?>
<script src="jquery.js"></script>
<script src="jquery-ui.js"></script>
<link href="jquery-ui.css"
	rel="stylesheet">
<style>
.toggler {
	width: 200px;
	height: 100px;
	position: fixed;
	left: 0px;
}

#button {
	padding: .5em 1em;
	text-decoration: none;
}

#effect {
	width: 240px;
	height: 135px;
	padding: 0.4em;
	position: relative;
}

#effect h3 {
	margin: 0;
	padding: 0.4em;
	text-align: center;
}
</style>
<script>
$(function() {
// run the currently selected effect
function runEffect() {
// get effect type from
//var selectedEffect = $( "#effectTypes" ).val();
var selectedEffect = "bounce";
// most effect types need no options passed by default
var options = {};
// some effects have required parameters
if ( selectedEffect === "scale" ) {
options = { percent: 100 };
} else if ( selectedEffect === "size" ) {
options = { to: { width: 280, height: 185 } };
}
// run the effect
$( "#effect" ).show( selectedEffect, options, 500, callback );
};
//callback function to bring a hidden box back
function callback() {
setTimeout(function() {
$( "#effect:visible" ).removeAttr( "style" ).fadeOut();
}, 1000 );
};
// set effect from select menu value
$( ".update" ).click(function() {
runEffect();
});
$( "#effect" ).hide();
});
</script>

<div class="toggler">
	<div id="effect" class="ui-widget-content ui-corner-all">
		<h3 class="ui-widget-header ui-corner-all">Update</h3>
		<p>Your requeste was a Success!</p>
	</div>
</div>
<table width="100%">
	<tr>
		<td><input type='button' id='add' value='Add new type' class="box" />

		</td>
		<td></td>
	</tr>
</table>
<!--  <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script> -->
<script type="text/javascript">

$(document).on('click', '#add', function() {
	var reponse = prompt("Please enter Item", "");
	

})
</script>
<!--  
<table width="100%">
	<tr>
		<td>
			<form method="POST"
				action="index.php?view=listitem&page=<?php echo $prev_10_page; ?>">
				<input type='submit' class='box' value="<<"  />
</form>
		
		</td>
		<td>
			<form method="POST"
				action="index.php?view=listitem&page=<?php echo $prev_page; ?>">
				<input type='submit' class='box' value="<" />
</form>
		
		</td>

		<td>
			<form method="POST"
				action="index.php?view=listitem&page=<?php echo $next_page; ?>">
				<input type='submit' class='box' style="float: right;" value=">" />
			</form>
		</td>

		<td>
			<form method="POST"
				action="index.php?view=listitem&page=<?php echo $next_10_page; ?>">
				<input type='submit' class='box' value=">>" style="float: right;" />
			</form>
		</td>
	</tr>

</table>-->
<table width="100%" border="0" align="center" cellpadding="5"
	cellspacing="1" class="entryTable">
	<tr align="center" id="listTableHeader">
		<td>N</td>
		<td>Item</td>
		<td>Englesh</td>
		<td>French</td>
		<td>Deutch</td>
		<td>Plognais</td>
		<td>spain</td>
		<td>italiano</td>
		<td>nederland</td>
		<td>Cz</td>
		<td>update</td>
	</tr>
	<?php 
	$i=0;
	$p_page=$page-1;
	$_v_max=$page*10;
	$_v_min=$p_page*10;
	$_j=0;
	foreach ($t as $te){
		
			$_j++;
			?>
	<tr>
		<td><?php echo $i;?></td>
		<td>
		<input type="hidden" id="p_item_<?php echo $i?>" value="<?php echo $te['item']?>"/>
		<textarea id="textarea_item_<?php echo $i?>" rows="10" cols="15">
		
				<?php 
				$p_item=$te['item'];
				echo $te['item']?>
			</textarea></td>
		<td><textarea id="textarea_eng_<?php echo $i?>" rows="10" cols="15">
				<?php 
				$p_eng=$te['_eng'];
				echo $te['_eng'];
				?>
			</textarea></td>
		<td><textarea id="textarea_fr_<?php echo $i?>" rows="10" cols="15">
				<?php 
				$p_fr=$te['fr'];
				echo $te['fr'];?>
			</textarea></td>
		<td><textarea id="textarea_de_<?php echo $i?>" rows="10" cols="15">
				<?php 
				$p_de=$te['de'];
				echo $te['de'];?>
			</textarea></td>
		<td><textarea id="textarea_pl_<?php echo $i?>" rows="10" cols="15">
				<?php 
				$p_pl=$te['pl'];
				echo $te['pl'];?>
			</textarea></td>
		<td><textarea id="textarea_es_<?php echo $i?>" rows="10" cols="15">
				<?php 
				echo $te['es'];
				$p_es=$te['es'];
				?>
			</textarea></td>
		<td><textarea id="textarea_it_<?php echo $i?>" rows="10" cols="15">
				<?php 
				echo $te['it'];
				$p_it=$te['it'];
				?>
			</textarea></td>
		<td><textarea id="textarea_nl_<?php echo $i?>" rows="10" cols="15">
				<?php 
				echo $te['nl'];
				$p_nl=$te['nl'];
				?>
			</textarea></td>
		<td><textarea id="textarea_cz_<?php echo $i?>" rows="10" cols="15">
				<?php 
				echo $te['cz'];
				$p_cz=$te['cz'];
				?>
			</textarea></td>
		<td><input type='button' class='update' id="Update_<?php echo $i?>" value='Update' />
	 <script type="text/javascript">
	 
	 $("#Update_<?php echo $i?>").click(function (){
   	  
         alert("<?php echo $p_item?>"+"  <?php echo $i?>");


         $.post("cycle.php",
       		  
        		 {  p_item : $("#p_item_<?php echo $i?>").val(),
               item : $("#textarea_item_<?php echo $i?>").val(),
                 _en : $("#textarea_eng_<?php echo $i?>").val(),
                   fr: $("#textarea_fr_<?php echo $i?>").val(),
                   de: $("#textarea_de_<?php echo $i?>").val(),
                   pl: $("#textarea_pl_<?php echo $i?>").val(),
                   es: $("#textarea_es_<?php echo $i?>").val(),
                   it: $("#textarea_it_<?php echo $i?>").val(),
                   nl: $("#textarea_nl_<?php echo $i?>").val(),
                   cz: $("#textarea_cz_<?php echo $i?>").val()
     	   },
	                  
           		   function(data){
           		     alert("Data Loaded: _eng");
           		   },'text'
           		 );

        
                                     });     

	 </script>
	</tr>


	</td>
	<?php  $i++;
	}
	?>
</table>

