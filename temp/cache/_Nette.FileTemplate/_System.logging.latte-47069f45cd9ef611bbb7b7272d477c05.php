<?php //netteCache[01]000388a:2:{s:4:"time";s:21:"0.75368200 1390613684";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"/var/www/playlist/libs/SystemModule/templates/System/logging.latte";i:2;i:1375540908;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/libs/SystemModule/templates/System/logging.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'rcizqco4za')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9dac773eba_content')) { function _lb9dac773eba_content($_l, $_args) { extract($_args)
?><div id="lside">
    <h2>Prohlížeč logů</h2>
    <div class="logarea">
    <?php echo $log ?>

    </div>
</div>
<div id="rside">
    <h2>Výběr logu</h2>
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("logSelect") ? "logSelect" : $_control["logSelect"]), array()) ?>
    <?php $_input = (is_object("log") ? "log" : $_form["log"]); echo $_input->getControl()->addAttributes(array()) ?><br />
    <?php $_input = is_object("type") ? "type" : $_form["type"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array())->startTag() ?>
Typ logu:</label> <?php $_input = (is_object("type") ? "type" : $_form["type"]); echo $_input->getControl()->addAttributes(array()) ?><br />
<?php $_input = (is_object("view") ? "view" : $_form["view"]); echo $_input->getControl()->addAttributes(array()) ;Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
</div>

<script> $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }); </script>
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