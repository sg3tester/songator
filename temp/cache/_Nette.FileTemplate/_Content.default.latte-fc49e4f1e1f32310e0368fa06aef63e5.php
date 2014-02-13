<?php //netteCache[01]000403a:2:{s:4:"time";s:21:"0.15180600 1389645562";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:81:"/var/www/playlist/libs/SystemModule/StaticContent/templates/Content/default.latte";i:2;i:1375540906;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/libs/SystemModule/StaticContent/templates/Content/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'kqr69md1ku')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe7944ccee4_content')) { function _lbe7944ccee4_content($_l, $_args) { extract($_args)
?><div id="lside">
    <h2>Správa statických stránek</h2>
<?php if ($obsah == null): ?>
    <p class="list-empty">Seznam stránek je prázdný.</p>
<?php else: ?>
    <table class="nesys-table" width="100%">
	<thead>
	    <tr>
		<td>ID</td>
		<td>Stránka</td>
		<td>Shortcut</td>
		<td>Akce</td>
	    </tr>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($obsah) as $stranka): ?>
	    <tr<?php if ($_l->tmp = array_filter(array($iterator->isOdd() ? 'odd' : 'even'))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>
		<td width="24"><?php echo Nette\Templating\Helpers::escapeHtml($stranka->id, ENT_NOQUOTES) ?></td>
		<td width="200"><?php echo Nette\Templating\Helpers::escapeHtml($stranka->nazev, ENT_NOQUOTES) ?></td>
		<td width="88"><?php echo Nette\Templating\Helpers::escapeHtml($stranka->shortcut, ENT_NOQUOTES) ?></td>
		<td width="15" class="symboled spaced"><a title="Upravit" href="<?php echo htmlSpecialChars($_control->link("edit", array($stranka->id))) ?>
">&#xf040;</a> <a title="Smazat" href="<?php echo htmlSpecialChars($_control->link("delete!", array($stranka->id))) ?>
">&#xf014;</a></td>
	    </tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	</tbody>
    </table>
<?php endif ?>
</div>
<div id="rside">
    <h2>Úkoly</h2>
    <ul>
	<li><a href="<?php echo htmlSpecialChars($_control->link("edit")) ?>"><span class="icon-plus-sign"></span>Přidat stránku</a></li>
	<li><a href="<?php echo htmlSpecialChars($_control->link("system:content")) ?>"><span class="icon-hdd"></span>Správa obsahu</a></li>
    </ul>
</div><?php
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