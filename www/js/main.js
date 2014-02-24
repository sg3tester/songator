
function matchInterpret(json) {
	console.info(json.matching);
	return "lol";
}

$(document).ready(function(){
	$(".reason").click(function(){
	    $("#reason").val($(this).text());
	    return false;
	}); 
});
