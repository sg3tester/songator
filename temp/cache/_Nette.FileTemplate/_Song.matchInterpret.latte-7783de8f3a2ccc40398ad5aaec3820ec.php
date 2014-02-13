<?php //netteCache[01]000387a:2:{s:4:"time";s:21:"0.31494300 1389638343";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:65:"/var/www/playlist/app/ASParty/templates/Song/matchInterpret.latte";i:2;i:1389638337;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/app/ASParty/templates/Song/matchInterpret.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'fmf6edhnda')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb41c4524dc5_content')) { function _lb41c4524dc5_content($_l, $_args) { extract($_args)
;if ($matches->count()): $valid = $matches->fetch()->valid ;if ($valid != $matching): ?>
<p>Měl(a) jsi na mysli <a href="#" id="match"><?php echo Nette\Templating\Helpers::escapeHtml($valid, ENT_NOQUOTES) ?></a>?</p>
<script>$("#match").click(function() {
	    $("#interpret").val($(this).text());
	    matchInterpret();
	    loadSongs();
	    return false;
	 });
</script>
<?php else: ?>
	<div class="interpret-valid">
		<span class="icon-ok-sign"></span>Interpret <?php echo Nette\Templating\Helpers::escapeHtml($matching, ENT_NOQUOTES) ?> je v našem registru</span>
	</div>
<?php endif ;else: endif ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = FALSE; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
 if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 