<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.35065500 1389645556";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"/var/www/playlist/libs/SystemModule/templates/System/default.latte";i:2;i:1375540908;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/libs/SystemModule/templates/System/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '7ca9r5rjcl')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb61d2b44365_content')) { function _lb61d2b44365_content($_l, $_args) { extract($_args)
?><div id="lside">
    <h2>2NE1.cz - Administrace</h2>
    Vítej, <b><?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->user, ENT_NOQUOTES) ?></b>!<br />
    Jste v roli oprávnění <b><?php echo Nette\Templating\Helpers::escapeHtml($perms->getRoleName($role), ENT_NOQUOTES) ?></b><br /><br />
    Aktuálně tu je registrováno <b><?php echo Nette\Templating\Helpers::escapeHtml($usrcount, ENT_NOQUOTES) ?></b> uživatelů, z toho:
    <p class="usercounts"><b><?php echo Nette\Templating\Helpers::escapeHtml($admincount, ENT_NOQUOTES) ?></b> adminů<br />
	<b><?php echo Nette\Templating\Helpers::escapeHtml($sefredaktorcount, ENT_NOQUOTES) ?></b> šéfredaktorů<br />
	<b><?php echo Nette\Templating\Helpers::escapeHtml($redaktorcount, ENT_NOQUOTES) ?></b> redaktorů<br />
	<b><?php echo Nette\Templating\Helpers::escapeHtml($bjcount, ENT_NOQUOTES) ?></b> registrovných Black Jacků<br />
	<b><?php echo Nette\Templating\Helpers::escapeHtml($regusercount, ENT_NOQUOTES) ?></b> běžných uživatelů.</p>
</div>
<div id="rside">
    <h2>Online uživatelé</h2>
    <small style="color: #999999"><center>(za posledních 5 minut)</center></small>
<?php $iterations = 0; foreach ($online as $usr): ?>
    <span style="font-weight: bold"<?php if ($_l->tmp = array_filter(array($usr->pohlavi == 'M' ? 'male':null, $usr->pohlavi == 'F' ? 'female':null))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>
><?php if ($usr->role == 'admin'): ?><span class="icon-star"></span><?php endif ;if ($usr->role == 'editor'): ?>
<span class="icon-star-empty"></span><?php endif ;if ($usr->role == 'author'): ?>
<span class="icon-star-half"></span><?php endif ;echo Nette\Templating\Helpers::escapeHtml($usr->user, ENT_NOQUOTES) ?></span>&nbsp;
<?php $iterations++; endforeach ?>
</div>
<?php
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