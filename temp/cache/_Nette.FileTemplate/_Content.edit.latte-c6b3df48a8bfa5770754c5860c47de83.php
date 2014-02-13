<?php //netteCache[01]000400a:2:{s:4:"time";s:21:"0.74395300 1389645564";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:78:"/var/www/playlist/libs/SystemModule/StaticContent/templates/Content/edit.latte";i:2;i:1375540906;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/libs/SystemModule/StaticContent/templates/Content/edit.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'o5wqtiyqp0')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb32ab8ff534_content')) { function _lb32ab8ff534_content($_l, $_args) { extract($_args)
?><div id="lside">
    <h2>Upravit stránku</h2>
<?php $_ctrl = $_control->getComponent("editor"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</div>
<div id="rside">
    <h2>Úkoly</h2>
    <ul>
	<li><a href="<?php echo htmlSpecialChars($_control->link("default")) ?>"><span class="icon-list"></span>Seznam stránek</a></li>
	<li><a href="<?php echo htmlSpecialChars($_control->link("system:content")) ?>"><span class="icon-hdd"></span>Správa obsahu</a></li>
    </ul>
</div>
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb55e41e978f_head')) { function _lb55e41e978f_head($_l, $_args) { extract($_args)
?>	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/datetimepicker.js"></script>
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/tinymce/tinymce.min.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/editor.js"></script>
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
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 