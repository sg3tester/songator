
function matchInterpret(json, selector) {
	$(selector).removeClass("sg-mi sg-mi-matched sg-mi-alias sg-mi-youmean text-success text-info text-danger text-primary text-warning"); //reset
	$(selector).parent().removeClass("has-success has-warning has-error"); //reset parent
	$(selector).addClass("sg-mi"); //base class
	if (json.match) {
		if (json.distance === 0) {
			if (json.alias === false) {
				$(selector).addClass("text-success sg-mi-matched");
				$(selector).parent().addClass("has-success");
				$(selector).html("Interpret <strong>"+json.matched+"</strong> je v našem registru");
			}
			else {
				$(selector).addClass("text-info sg-mi-alias");
				$(selector).html("Interpret <strong>"+json.matched+"</strong> je aliasem pro <strong>"+json.alias+"</strong>");
			}
		}
		else {
			$(selector).addClass("text-warning sg-mi-youmean");
			$(selector).parent().addClass("has-warning");
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
