$(document).ready(function() {
	$(".kart").bind("click", function() {
		$("#kart").show();
	});
	
	$("#close").bind("click", function() {
		$("#kart").hide();
	});
});