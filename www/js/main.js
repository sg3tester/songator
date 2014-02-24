
function matchInterpret(json, selector) {
	if (json.match) {
		if (json.distance === 0) {
			if (json.alias === false) {
				$(selector).html("Interpret <strong>"+json.matched+"</strong> je v našem registru");
			}
			else {
				$(selector).html("Interpret <strong>"+json.matched+"</strong> je aliasem pro <strong>"+json.alias+"</strong>");
			}
		}
		else {
			$(selector).html("Měli jste na mysli <strong>"+json.matched+"</strong>?");
		}
	}
	else {
		$(selector).html(null);
	}
}

$(document).ready(function(){
	$(".reason").click(function(){
	    $("#reason").val($(this).text());
	    return false;
	}); 
});
