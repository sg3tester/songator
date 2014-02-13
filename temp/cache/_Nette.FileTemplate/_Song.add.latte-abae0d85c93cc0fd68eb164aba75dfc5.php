<?php //netteCache[01]000383a:2:{s:4:"time";s:21:"0.55722600 1384601068";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:61:"C:\xampp\htdocs\playlist\app\ASParty\templates\Song\add.latte";i:2;i:1384460152;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\playlist\app\ASParty\templates\Song\add.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'w55dzlu3u0')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbb64069c2a4_title')) { function _lbb64069c2a4_title($_l, $_args) { extract($_args)
?>Přidat song<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbf6bc976b13_content')) { function _lbf6bc976b13_content($_l, $_args) { extract($_args)
?><h2><?php echo Nette\Templating\Helpers::escapeHtml($page->nazev, ENT_NOQUOTES) ?></h2>
<?php echo $page->content ?>

<h2>Přidat song do playlistu</h2>
<?php $iterations = 0; foreach ($flashes as $flash): ?><div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;if ($wip == false && $active || $user->isAllowed("article","add")): $_ctrl = $_control->getComponent("addSong"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;endif ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb3348d78112_head')) { function _lb3348d78112_head($_l, $_args) { extract($_args)
?><script>
    var req = "";
    var req2 = "";
    function loadSongs() {
	if ($("#song").val() != "") {
	    $("#song").addClass("ui-autocomplete-loading");
		if (req != "")
		    req.abort();
		req = $.get(<?php echo Nette\Templating\Helpers::escapeJs($_presenter->link("song:bindSong")) ?>,{ interpret: $("#interpret").val(), song: $("#song").val() }).done(function(data){
		    $("#song").removeClass("ui-autocomplete-loading");
		    $("#existujici").html(data);
		    $("#existujici").show();
		});	
	}
    }
    function matchInterpret() {
		if (req2 != "")
		    req2.abort();
		req2 = $.get(<?php echo Nette\Templating\Helpers::escapeJs($_presenter->link("song:matchInterpret")) ?>,{ interpret: $("#interpret").val() }).done(function(data){
		    $("#matched").html(data);
		    $("#matched").show();
		});	
    }
    $(function() {
	var wt;
	$("#song").parent().append('<div id="existujici"></div>');
	$("#interpret").parent().append('<div id="matched"></div>');
	$("#existujici").hide();
	$("#matched").hide();
	/*var availableInterprets = [<?php $iterations = 0; foreach ($rows as $row): echo Nette\Templating\Helpers::escapeJs($row->interpret) ?>
,<?php $iterations++; endforeach ?>];
	var availableSongs = [<?php $iterations = 0; foreach ($rows as $row): echo Nette\Templating\Helpers::escapeJs($row->song) ?>
,<?php $iterations++; endforeach ?>];
	$( "#interpret" ).autocomplete({
	    source: availableInterprets
	});*/
	
	 $( "#interpret" ).autocomplete({
	    source: <?php echo Nette\Templating\Helpers::escapeJs($_presenter->link("song:bindInterpret")) ?>,
	    minLength: 2,
	    select: function() {
		matchInterpret();
		loadSongs();
	    }
	}).on("input",function(){
	    loadSongs();
	}).change(matchInterpret);

	$("#song").on("input",function(){
	    loadSongs();
	});
    });

</script><?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 