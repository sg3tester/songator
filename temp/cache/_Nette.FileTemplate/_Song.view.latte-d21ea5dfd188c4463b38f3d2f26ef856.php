<?php //netteCache[01]000377a:2:{s:4:"time";s:21:"0.54704700 1389639750";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:55:"/var/www/playlist/app/ASParty/templates/Song/view.latte";i:2;i:1380025497;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/app/ASParty/templates/Song/view.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'tuxwuzolxj')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbe007db730b_title')) { function _lbe007db730b_title($_l, $_args) { extract($_args)
?>Detail songu <?php echo Nette\Templating\Helpers::escapeHtml($song->interpret, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($song->song, ENT_NOQUOTES) ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbcb72d8daac_content')) { function _lbcb72d8daac_content($_l, $_args) { extract($_args)
;if ($song == null): ?>
<p>Tento song není v našem playlistu</p>
<?php else: ?>
<h2>Detail songu <?php echo Nette\Templating\Helpers::escapeHtml($song->interpret, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($song->song, ENT_NOQUOTES) ?>
 <small><a href="<?php echo htmlSpecialChars($_control->link("list#track$song->id")) ?>
">Najít v seznamu</a></small></h2>
<b>Interpret:</b> <?php echo Nette\Templating\Helpers::escapeHtml($song->interpret, ENT_NOQUOTES) ?><br />
<b>Název songu:</b> <?php echo Nette\Templating\Helpers::escapeHtml($song->song, ENT_NOQUOTES) ?><br />
<b>Žánr:</b> <?php echo Nette\Templating\Helpers::escapeHtml($song->zanr, ENT_NOQUOTES) ?><br />
<b>Status:</b> <div class="stav"><?php if ($song->status == "waiting"): ?>

		    <span class="status waiting">Čeká</span>
<?php elseif ($song->status == "approved"): ?>
		    <span class="status approved">Zařazen</span>
<?php elseif ($song->status == "rejected"): ?>
		    <span class="status rejected">Vyřazen</span>
		    <?php endif ?></div><br />
		    <b>Link k poslechnutí:</b> <?php if ($song->yt != null): ?><a href="<?php echo htmlSpecialChars($song->yt) ?>
" target="_blank"><?php echo Nette\Templating\Helpers::escapeHtml($song->yt, ENT_NOQUOTES) ?>
</a><?php else: ?><i>Není k dispozici</i><?php endif ?><br />
		    <b>Vzkaz pro DJe:</b><br />
<?php if ($song->vzkaz == null): ?>
		    <i>Vzkaz není dostupný</i>
<?php endif ?>
		    <p><?php echo Nette\Templating\Helpers::escapeHtml($song->vzkaz, ENT_NOQUOTES) ?></p>
		    <b>Poznámka DJe:</b><br />
<?php if ($song->note == null): ?>
		    <i>Není k dispozici</i>
<?php endif ?>
		    <p><?php echo Nette\Templating\Helpers::escapeHtml($song->note, ENT_NOQUOTES) ?></p>
		    
		    <?php if ($song->instro): ?><span class="instro"><span class="icon-music"></span>K dispozici je také instrumentálka</span><br /><?php endif ?>

		    <?php if ($song->pecka): ?><span class="pecka"><span class="icon-star"></span>Tenhle song je pecka!</span><br /><?php endif ?>

		    
<?php if ($user->isAllowed("system","view")): $iterations = 0; foreach ($flashes as $flash): ?>
		    <div class="flash <?php echo htmlSpecialChars($flash->type) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>
		    <div class="adminbar">
			<a data-confirm="Schválit song?" href="<?php echo htmlSpecialChars($_control->link("approve!", array($song->id))) ?>
"><span class="icon-ok"></span>Schválit</a>
			<a data-confirm="Zamítnout song?" href="<?php echo htmlSpecialChars($_control->link("reject!", array($song->id))) ?>
"><span class="icon-remove"></span>Zamítnout</a>
			<a href="<?php echo htmlSpecialChars($_control->link("edit!", array($song->id))) ?>
"><span class="icon-edit"></span>Upravit</a>
			<a data-confirm="Smazat song?" href="<?php echo htmlSpecialChars($_control->link("delete!", array($song->id))) ?>
"><span class="icon-trash"></span>Smazat</a>
		    </div>		    
<?php endif ;endif ;
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 