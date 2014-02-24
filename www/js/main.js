
function matchInterpret(json, selector) {
	$(selector).removeClass("sg-mi sg-mi-matched sg-mi-alias sg-mi-youmean"); //reset
	$(selector).addClass("sg-mi"); //base class
	if (json.match) {
		if (json.distance === 0) {
			if (json.alias === false) {
				$(selector).addClass("sg-matched");
				$(selector).html("Interpret <strong>"+json.matched+"</strong> je v našem registru");
			}
			else {
				$(selector).addClass("sg-alias");
				$(selector).html("Interpret <strong>"+json.matched+"</strong> je aliasem pro <strong>"+json.alias+"</strong>");
			}
		}
		else {
			$(selector).addClass("sg-youmean");
			$(selector).html("Měli jste na mysli <strong>"+json.matched+"</strong>?");
		}
	}
	else {
		$(selector).html(null); //hide
	}
}

$(document).ready(function(){
	$(".reason").click(function(){
	    $("#reason").val($(this).text());
	    return false;
	}); 
});
