<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.82825800 1384610604";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\xampp\htdocs\playlist\app\ASParty\templates\Song\bindSong.latte";i:2;i:1384466341;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\playlist\app\ASParty\templates\Song\bindSong.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '70qav9e03l')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbbc21ccd2c1_content')) { function _lbbc21ccd2c1_content($_l, $_args) { extract($_args)
;if ($songy->count() > 0): ?>
<h4>Nalezené songy v playlistu</h4>
<ul>
<?php $iterations = 0; foreach ($songy as $song): ?>
    <li><?php echo Nette\Templating\Helpers::escapeHtml($song->interpret, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($song->song, ENT_NOQUOTES) ?></li>
<?php $iterations++; endforeach ?>
</ul>
<?php if (!$more): ?><a onclick="window.open(this.href,'1384443567617','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" href="<?php echo htmlSpecialChars($_control->link("bindSong", array($interpret, $song, 'more' => true))) ?>
">Zobrazit všechny</a>
<?php endif ;else: ?>
<p>Žádný podobný song není zařazen v playlistu</p>
<?php endif ;
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