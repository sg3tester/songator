<?php //netteCache[01]000381a:2:{s:4:"time";s:21:"0.39280500 1389645556";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:59:"/var/www/playlist/libs/SystemModule/templates/@layout.latte";i:2;i:1375540906;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/libs/SystemModule/templates/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '1o68cvw7tn')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb478699329c_title')) { function _lb478699329c_title($_l, $_args) { extract($_args)
;echo Nette\Templating\Helpers::escapeHtml($sitename, ENT_NOQUOTES) ?> - Adminex NESys control panel<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb4337644c06_head')) { function _lb4337644c06_head($_l, $_args) { extract($_args)
;
}}

//
// block header
//
if (!function_exists($_l->blocks['header'][] = '_lbc7b7d0cc4f_header')) { function _lbc7b7d0cc4f_header($_l, $_args) { extract($_args)
?>	<header>
	    <a class="fleft" id="backlink" href="<?php echo htmlSpecialChars($_control->link(":Homepage:default")) ?>
"><span class="symboled">&#xf112;</span> Zpět na <?php echo Nette\Templating\Helpers::escapeHtml($sitename, ENT_NOQUOTES) ?></a>
	    <a class="fright" href="<?php echo htmlSpecialChars($_control->link(":Sign:out")) ?>
"><span class="symboled">&#xf011;</span> Odhlásit</a>
	    <div class="cl"></div>
	<div class="web-width">
	<div id="banner">
	    <h1><a style="color: inherit; text-decoration: none" href="<?php echo htmlSpecialChars($_control->link("System:default")) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($sitename, ENT_NOQUOTES) ?> - Správa systému NESys</a></h1>
	    <h3>Adminex control panel</h3>
	</div>
	</div>
	    
	</header>
<?php
}}

//
// block menu
//
if (!function_exists($_l->blocks['menu'][] = '_lb9c6a1c6aca_menu')) { function _lb9c6a1c6aca_menu($_l, $_args) { extract($_args)
?>	<menu>
	<div id="menu" class="web-width">
<?php $_ctrl = $_control->getComponent("menu"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->renderTree() ?>
	</div>
	</menu>
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="description" content="" />
<?php if (isset($robots)): ?>	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

	<title><?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->striptags(ob_get_clean())  ?></title>

	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/nesys.css" />
	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/adminex.css" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/roboto.css" />
	<link rel="stylesheet" media="print" href="<?php echo htmlSpecialChars($basePath) ?>/css/print.css" />
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script type="application/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.ajaxform.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/live-form-validation.js"></script>
	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

</head>

<body>
	<script> document.documentElement.className+=' js' </script>

	
<?php call_user_func(reset($_l->blocks['header']), $_l, get_defined_vars()) ; call_user_func(reset($_l->blocks['menu']), $_l, get_defined_vars()) ; Nette\Diagnostics\Debugger::barDump(get_defined_vars(), "Template " . str_replace(dirname(dirname($template->getFile())), "\xE2\x80\xA6", $template->getFile())) ?>
	<div id="obsah" class="web-width">
<?php $iterations = 0; foreach ($flashes as $flash): ?>	<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
	</div>
	<div class="cl"></div>
	<footer>Adminex control panel <?php echo Nette\Templating\Helpers::escapeHtml(SystemModule\Adminex::VERSION, ENT_NOQUOTES) ?>
 | PHP <?php echo Nette\Templating\Helpers::escapeHtml(PHP_VERSION, ENT_NOQUOTES) ?> |
		NESys <?php echo Nette\Templating\Helpers::escapeHtml(Nesys\NesysCore::VERSION, ENT_NOQUOTES) ?>
 (<?php echo Nette\Templating\Helpers::escapeHtml(Nesys\NesysCore::NICKNAME, ENT_NOQUOTES) ?>
) API-<?php echo Nette\Templating\Helpers::escapeHtml(Nesys\NesysCore::API, ENT_NOQUOTES) ?> |
		Nette Framework <?php echo Nette\Templating\Helpers::escapeHtml(Nette\Framework::VERSION, ENT_NOQUOTES) ?></footer>
</body>
</html>
