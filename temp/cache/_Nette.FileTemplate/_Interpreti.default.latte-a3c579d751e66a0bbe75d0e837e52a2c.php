<?php //netteCache[01]000393a:2:{s:4:"time";s:21:"0.40391000 1385151259";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:71:"C:\xampp\htdocs\playlist\app\ASParty\templates\Interpreti\default.latte";i:2;i:1384615015;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\playlist\app\ASParty\templates\Interpreti\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'l9f8v5sugz')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb204f77959d_content')) { function _lb204f77959d_content($_l, $_args) { extract($_args)
;$startLetter = "" ?>
<h2>Seznam interpretů</h2>
<ul class="interpreti">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($interpreti) as $interpret): if ($startLetter != Nette\Utils\Strings::upper($interpret->valid[0])): $startLetter = Nette\Utils\Strings::upper($interpret->valid[0]) ?>
    <?php if (!$iterator->isFirst()): ?></ul></div><?php endif ?>

<div>
    <li class="big"><b><?php echo Nette\Templating\Helpers::escapeHtml($startLetter, ENT_NOQUOTES) ?></b></li>
    <ul>
<?php endif ?>
	<li><a href="<?php echo htmlSpecialChars($_control->link("interpreti:detail", array($interpret->valid))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($interpret->valid, ENT_NOQUOTES) ?>
</a><?php if ($interpret->asprofil): ?> <a href="http://www.asianstyle.cz/profily/<?php echo htmlSpecialChars($interpret->asprofil) ?>
" target="_blank"><img src="<?php echo htmlSpecialChars($basePath) ?>/img/aslogo_nano.png" title="Profil na AsianStyle.cz" /></a><?php endif ?>
 <a class="toolicon" title="Vyhledat songy tohoto interpreta" href="<?php echo htmlSpecialChars($_control->link("song:list", array('search' => $interpret->valid))) ?>
"><span class="icon-search"></span></a></li>
<?php if ($iterator->isLast()): ?></ul></div><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</ul><?php
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
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 