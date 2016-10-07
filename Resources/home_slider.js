$(function () {
	$('#liste_articles').anythingSlider({
		   width			: 430,
		   height			: 390,
		   buildArrows		: false,
		   autoPlayLocked	: true,
		   delay			: 6000,
		   hashTags         : false,
		   appendControlsTo : '#controles_slider'
		 });
	$('#liste_articles p#rubrique_article').each(function (index) {
		var offset = $(this).parent().find("h2").outerHeight();
		$(this).css("top",offset+5+"px");
	 });
});
