
function matchInterpret(json, selector) {
	$(selector).removeClass("sg-mi sg-mi-matched sg-mi-alias sg-mi-youmean text-success text-info text-danger text-primary text-warning"); //reset
	$(selector).parent().removeClass("has-success has-warning has-error has-feedback"); //reset parent
	$(selector).addClass("sg-mi"); //base class
	if (json.match) {
		if (json.distance === 0) {
			if (json.alias === false) {
				$(selector).addClass("text-success sg-mi-matched");
				$(selector).parent().addClass("has-success");
				$(selector).html("<i class='glyphicon glyphicon-ok'></i> Interpret <strong>"+json.matched+"</strong> je v našem registru");
			}
			else {
				$(selector-"-feedback").addClass("glyphicon-info-sign");
				$(selector).addClass("text-info sg-mi-alias");
				$(selector).html("<i class='glyphicon glyphicon-info-sign'></i> Interpret <strong>"+json.matched+"</strong> je aliasem pro <strong><a class='match' href='#'>"+json.alias+"</a></strong>");
			}
		}
		else {
			$(selector).addClass("text-warning sg-mi-youmean");
			$(selector).parent().addClass("has-warning");
			$(selector).html("<i class='glyphicon glyphicon-question-sign'></i> Měli jste na mysli <strong><a class='match' href='#'>"+json.matched+"</a></strong>?");
		}
	}
	else {
		$(selector).html(null); //hide
	}
	$(".match").click(setMatch);
}

function rndColor() {
	var n = Math.floor((Math.random()*5)+1); 
	switch (n) {
		case 1:
			return "text-primary";
		case 2:
			return "text-success";
		case 3:
			return "text-info";
		case 4:
			return "text-warning";
		case 5:
			return "text-danger";
	}
}

function matchSong(json, selector) {
	$(selector).removeClass("sg-mi sg-mi-matched sg-mi-alias sg-mi-youmean text-success text-info text-danger text-primary text-warning"); //reset
	$(selector).parent().removeClass("has-success has-warning has-error has-feedback"); //reset parent
	$(selector).addClass("sg-mi"); //base class
	if (json.match) {
		if (json.matched && json.matching.interpret) {
				$(selector).addClass("text-danger sg-mi-matched");
				$(selector).parent().addClass("has-error");
				$(selector).html("<i class='glyphicon glyphicon-warning-sign'></i> Song <strong>"+json.matched.interpret+" - "+json.matched.name+"</strong> je již v playlistu");
			}
			
		else {
			$(selector).html('<strong><ul id="ms-list" class="list-inline"></ul></strong>');
			json.similar.forEach(function(entry){
				$("#ms-list").append('<li class="'+rndColor()+'">'+entry.interpret+" - "+entry.name+"</li>");
			});
		}
	}
	else {
		$(selector).html(null); //hide
	}
}

function setMatch() {
	$("#interpret").val($(this).text());
	$("#interpret").change();
	return false;
}

$(document).ready(function(){
	$(".reason").click(function(){
	    $("#reason").val($(this).text());
	    return false;
	});
	$(".match").click(setMatch);
});
