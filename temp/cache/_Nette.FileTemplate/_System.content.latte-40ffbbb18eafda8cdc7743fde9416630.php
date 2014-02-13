<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.65108500 1389645559";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"/var/www/playlist/libs/SystemModule/templates/System/content.latte";i:2;i:1375540908;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/libs/SystemModule/templates/System/content.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '6nsvpykny9')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb665a34074a_content')) { function _lb665a34074a_content($_l, $_args) { extract($_args)
?><div id="lside">
    <h2>Správa obsahu</h2>
    <p>Moduly pro správu obsahu CMS NESys.</p>
    
        <div class="navi">
	<ul>
<?php $iterations = 0; foreach ($contentmenu as $item): if ($user->isAllowed($item->permsResource,$item->permsCapability)): ?>
	    <li <?php if ($item->restricted): endif ?>><a href="<?php echo htmlSpecialChars($_control->link($item->target)) ?>
"><?php if ($item->additional->icon != null): ?><span<?php if ($_l->tmp = array_filter(array($item->additional->icon))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
></span><?php endif ;echo Nette\Templating\Helpers::escapeHtml($item->caption, ENT_NOQUOTES) ?></a></li>
<?php endif ;$iterations++; endforeach ?>
	</ul>
    </div>
    <br />
    </div>
<div id="rside">
    <h2>Stručný přehled</h2>
    <p>
	V systému se nachází celkem:<br />
	<summary><b><?php echo Nette\Templating\Helpers::escapeHtml($articlecount, ENT_NOQUOTES) ?></b> článků<br />
	<b>x</b> videí<br />
	<b>x</b> galerií<br />
	<b>x</b> obrázků<br />
	<b>x</b> projektů<br />
	<b>x</b> hodnocení<br />
	<b>x</b> komentářů<br />
	<b><?php echo Nette\Templating\Helpers::escapeHtml($usrcount, ENT_NOQUOTES) ?></b> uživatelů</summary>.
    </p>
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