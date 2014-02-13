<?php //netteCache[01]000367a:2:{s:4:"time";s:21:"0.19544700 1387648278";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:45:"/var/www/playlist/app/templates/Sign/in.latte";i:2;i:1371228422;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/app/templates/Sign/in.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '59la19tnoz')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba7bef55975_content')) { function _lba7bef55975_content($_l, $_args) { extract($_args)
 ?>
<div id="<?php echo $_control->getSnippetId('prihlasit') ?>"><?php call_user_func(reset($_l->blocks['_prihlasit']), $_l, $template->getParameters()) ?>
</div><?php
}}

//
// block _prihlasit
//
if (!function_exists($_l->blocks['_prihlasit'][] = '_lb245062ef68__prihlasit')) { function _lb245062ef68__prihlasit($_l, $_args) { extract($_args); $_control->validateControl('prihlasit')
?><div class="nadpis">
    <h1>Přihlášení</h1>
</div>
<div class="page-obsah">

<?php $iterations = 0; foreach ($flashes as $flash): ?><div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>

<?php $_ctrl = $_control->getComponent("signInForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

</div>
<?php
}}

//
// block downmenu
//
if (!function_exists($_l->blocks['downmenu'][] = '_lbe9ceac0f60_downmenu')) { function _lbe9ceac0f60_downmenu($_l, $_args) { extract($_args)
?><ul>
	<li><a <?php if ($smsel == 1): ?>class="selected"<?php endif  ?> href="<?php echo htmlSpecialChars($_control->link("sign:in")) ?>
"><span class="icon-circle"></span>Přihlásit</a></li>
	<li><a <?php if ($smsel == 2): ?>class="selected"<?php endif  ?> href="<?php echo htmlSpecialChars($_control->link("sign:up")) ?>
"><span class="icon-circle"></span>Registrovat</a></li>
	<li><a <?php if ($smsel == 3): ?>class="selected"<?php endif  ?> href="<?php echo htmlSpecialChars($_control->link("sign:rules")) ?>
"><span class="icon-circle"></span>Podmínky služby</a></li>
</ul>
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
$robots = 'noindex' ?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['downmenu']), $_l, get_defined_vars()) ; 