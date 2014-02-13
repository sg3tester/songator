<?php //netteCache[01]000379a:2:{s:4:"time";s:21:"0.23747700 1389646256";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:57:"/var/www/playlist/app/ASParty/templates/Hup/default.latte";i:2;i:1382698833;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/app/ASParty/templates/Hup/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'xr5a0fz3nf')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb1cc11a18f8_content')) { function _lb1cc11a18f8_content($_l, $_args) { extract($_args)
?><h2>Hlavní uzávěr songátoru</h2>
Status songátoru: <?php if ($status): ?><span style="border-radius: 5px; background-color: green; padding-left: 5px; padding-right: 5px; color: white; font-family: RobotoMedium">Zapnut</span><br /><?php else: ?>

<span style="border-radius: 5px; background-color: red; padding-left: 5px; padding-right: 5px; color: white; font-family: RobotoMedium">Vypnut</span><br /><?php endif ?>

<a class="button-master" href="<?php echo htmlSpecialChars($_control->link("switch!")) ?>
">Switch On/Off</a>
<h2>Zpráva uživatelům</h2>
<?php $_ctrl = $_control->getComponent("frmZprava"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
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