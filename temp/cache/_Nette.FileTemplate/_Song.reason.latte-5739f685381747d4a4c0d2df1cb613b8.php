<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.36726400 1384602240";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:64:"C:\xampp\htdocs\playlist\app\ASParty\templates\Song\reason.latte";i:2;i:1384560004;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\playlist\app\ASParty\templates\Song\reason.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '41xo6gtkll')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb37b39a095b_content')) { function _lb37b39a095b_content($_l, $_args) { extract($_args)
;$iterations = 0; foreach ($flashes as $flash): ?><div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>
<h2>Udejte důvod zamítnutí</h2>
<div class="box">
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("reason") ? "reason" : $_control["reason"]), array()) ;$_input = (is_object("note") ? "note" : $_form["note"]); echo $_input->getControl()->addAttributes(array()) ?><br />
<?php $_input = (is_object("odeslat") ? "odeslat" : $_form["odeslat"]); echo $_input->getControl()->addAttributes(array()) ?>
 <a href="<?php echo htmlSpecialChars($_control->link("list#track$id")) ?>">Přeskočit</a>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
</div>
<div class="box">
    <ul>
	<li><a href="#" class="reason">Není taneční song</a></li>
	<li><a href="#" class="reason">Není k dispozici v požadované kvalitě</a></li>
	<li><a href="#" class="reason">Remixy nejsou povoleny</a></li>
	<li><a href="#" class="reason">Nehodí se na párty</a></li>
	<li><a href="#" class="reason">Zamítnut managementem AsianStyle.cz</a></li>
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