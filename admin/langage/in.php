<?php 
include 'lang.php';

$l=new Lang();
//echo $_SERVER['REQUEST_URI']."<br>" ;
$l->insert("_en", "mahary", "slt");
//$l->update("_en", "mahary_fenitra", "Je suis mahary fenitra","mahary","_en")
$l->update("_en", "mahary", "Je suis mahary mahary fenitra","mahary","_en");

?>

<script src="jquery.js"></script>
<script src="jquery-ui.js"></script>
<link href="jquery-ui.css" rel="stylesheet">
<style>
.toggler { width: 500px; height: 200px; }
#button { padding: .5em 1em; text-decoration: none; }
#effect { width: 240px; height: 135px; padding: 0.4em; position: relative; }
#effect h3 { margin: 0; padding: 0.4em; text-align: center; }
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
$( "#button" ).click(function() {
runEffect();
});
$( "#effect" ).hide();
});
</script>

<div class="toggler">
<div id="effect" class="ui-widget-content ui-corner-all">
<h3 class="ui-widget-header ui-corner-all">Update</h3>
<p>
     Your requeste was a Success!
</p>
</div>
</div>

<button id="button" class="ui-state-default ui-corner-all">Run Effect</button>

