<?php //netteCache[01]000384a:2:{s:4:"time";s:21:"0.09776100 1384616966";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:62:"C:\xampp\htdocs\playlist\app\ASParty\templates\Song\list.latte";i:2;i:1384616938;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\playlist\app\ASParty\templates\Song\list.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'nbey1afsgc')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb41cefaf150_title')) { function _lb41cefaf150_title($_l, $_args) { extract($_args)
?>Seznam songů<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb52dec7226f_content')) { function _lb52dec7226f_content($_l, $_args) { extract($_args)
?><h2>Seznam žádaných songů na AsianStyle párty</h2>
<div class="hledat">
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("search") ? "search" : $_control["search"]), array()) ?>
    <?php $_input = (is_object("search") ? "search" : $_form["search"]); echo $_input->getControl()->addAttributes(array()) ?>
 <?php $_input = (is_object("hledej") ? "hledej" : $_form["hledej"]); echo $_input->getControl()->addAttributes(array()) ?>

<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
</div>
<?php if ($user->isAllowed("system","view")): ?>
<p><?php if (!$wip): ?><a href="<?php echo htmlSpecialChars($_control->link("wipOn!")) ?>
">Zapnout WIP režim</a><?php else: ?><a href="<?php echo htmlSpecialChars($_control->link("wipOff!")) ?>
">Vypnout WIP režim</a><?php endif ?></p>
<?php endif ?>
<p>Filtrovat: <a href="<?php echo htmlSpecialChars($_control->link("this", array('status' => null))) ?>
">Vše</a> | <a href="<?php echo htmlSpecialChars($_control->link("this", array('status' => 'approved'))) ?>
">Zařazené</a> | <a href="<?php echo htmlSpecialChars($_control->link("this", array('status' => 'waiting'))) ?>
">Čekající</a> | <a href="<?php echo htmlSpecialChars($_control->link("this", array('status' => 'rejected'))) ?>
">Vyřazené</a></p> 
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("attrFilter") ? "attrFilter" : $_control["attrFilter"]), array()) ?>
<p>Třídit dle atributů: <?php $_input = (is_object("pecka") ? "pecka" : $_form["pecka"]); echo $_input->getControl()->addAttributes(array()) ?>
 <span class="icon-star pecka" title="Pecka song"></span> <?php $_input = (is_object("instro") ? "instro" : $_form["instro"]); echo $_input->getControl()->addAttributes(array()) ?>
 <span class="icon-music instro" title="Song s instrem"></span> <?php $_input = (is_object("note") ? "note" : $_form["note"]); echo $_input->getControl()->addAttributes(array()) ?>
 <span class="icon-info-sign dj-note" title="Poznámka DJe"></span> <?php $_input = (is_object("tridit") ? "tridit" : $_form["tridit"]); echo $_input->getControl()->addAttributes(array()) ?></p>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ;if ($search && $navrhovany): if ($search != $navrhovany): ?>
<div id="matched" class="fs16">
    <p>Měl(a) jsi na mysli <a href="<?php echo htmlSpecialChars($_control->link("this", array('search' => $navrhovany))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($navrhovany, ENT_NOQUOTES) ?></a>?</p>
</div>
<?php endif ;endif ;if ($songy->count() == 0): if ($search == null): ?>
<p>Playlist je prázdný</p>
<?php else: ?>
<p>Výraz "<?php echo Nette\Templating\Helpers::escapeHtml($search, ENT_NOQUOTES) ?>" nebyl nalezen</p>
<?php endif ;else: $iterations = 0; foreach ($flashes as $flash): ?><div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>
<p>V seznamu se aktuálně nachází <b><?php echo Nette\Templating\Helpers::escapeHtml($songy->count(), ENT_NOQUOTES) ?></b> songů.</p>
<table class="nesys-table" width="100%">
	<thead>
	    <tr>
<?php $iterations = 0; foreach ($heads as $head): if ($head->type == "ASC"): $sort = $head->head." DESC" ;else: $sort = $head->head." ASC" ;endif ;if ($head->matched): ?>
		<td><a class="lighted" href="<?php echo htmlSpecialChars($_control->link("this", array('sort' => $sort))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($head->caption, ENT_NOQUOTES) ?>
 <?php if ($head->type == "ASC"): ?><span class="icon-caret-down"></span><?php else: ?>
<span class="icon-caret-up"></span><?php endif ?></a></td>
<?php else: ?>
		<td><a href="<?php echo htmlSpecialChars($_control->link("this", array('sort' => $sort))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($head->caption, ENT_NOQUOTES) ?></a></td>
<?php endif ;$iterations++; endforeach ?>
		<td>Žánr</td>
		<td>Žadatel</td>
		<td>Status</td>
		<td>Vzkaz</td>
		<td><span class="icon-cog"></span></td>
	    </tr>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($songy) as $song): $interpret = $song->ref("podobne","interpret") ;$revizor = $song->ref("users","revidedby") ?>
	    <tr id="track<?php echo htmlSpecialChars($song->id) ?>"<?php if ($_l->tmp = array_filter(array($iterator->isOdd() ? 'odd' : 'even'))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>
		<td width="64"><?php echo Nette\Templating\Helpers::escapeHtml($template->date($song->datum, 'd.m.y'), ENT_NOQUOTES) ?></td>
		<td width="150"><?php if ($interpret): ?><span class="valid"><a target="_blank" href="<?php echo htmlSpecialChars($_control->link("interpreti:detail", array($interpret->valid))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($song->interpret, ENT_NOQUOTES) ?>
</a></span><span class="verified" title="Validní název interpreta"></span><?php else: ?>
<i><?php echo Nette\Templating\Helpers::escapeHtml($song->interpret, ENT_NOQUOTES) ?>
</i><?php endif ?></td>
		<td width="200"><?php echo Nette\Templating\Helpers::escapeHtml($song->song, ENT_NOQUOTES) ?>
 <?php if ($song->pecka): ?><span class="icon-star pecka" title="Tenhle song je pecka!"></span><?php endif ;if ($song->instro): ?>
<span class="icon-music instro" title="K dispozici je instrumentálka"></span><?php endif ;if ($song->note != null): ?>
<span class="icon-info-sign dj-note" title="Poznámka DJe: <?php echo htmlSpecialChars($song->note) ?>
"></span><?php endif ?></td>
		<td width="48"><?php echo Nette\Templating\Helpers::escapeHtml($song->zanr, ENT_NOQUOTES) ?></td>
		<td width="64"><?php echo Nette\Templating\Helpers::escapeHtml($song->zadatel, ENT_NOQUOTES) ?></td>
		<td width="40">
<?php if ($song->status == "waiting"): ?>
		    <span class="status waiting">Čeká</span>
<?php elseif ($song->status == "approved"): ?>
		    <span class="status approved" title="Schválil(a): <?php echo htmlSpecialChars($revizor->user) ?>">Zařazen</span>
<?php elseif ($song->status == "rejected"): ?>
		    <span class="status rejected" title="Zamítl(a): <?php echo htmlSpecialChars($revizor->user) ?>">Vyřazen</span>
<?php endif ?>
		</td>
		<td width="180"><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($song->vzkaz, 127), ENT_NOQUOTES) ?></td>
		<td class="cmd" width="72">
		    <a title="Detail" href="<?php echo htmlSpecialChars($_control->link("view", array($song->id))) ?>
"><span class="icon-external-link"></span></a>
<?php if ($user->isAllowed("system","view")): ?>
		    <a title="Schválit" data-confirm="Schválit song?" href="<?php echo htmlSpecialChars($_control->link("approve!", array($song->id))) ?>
"><span class="icon-ok"></span></a>
		    <a title="Zamítnout" data-confirm="Zamítnout song?" href="<?php echo htmlSpecialChars($_control->link("reject!", array($song->id))) ?>
"><span class="icon-remove"></span></a>
<?php endif ?>
		    <?php if ($song->yt != null): ?><a href="<?php echo htmlSpecialChars($song->yt) ?>
" target="_blank" title="Poslechnout"><span class="icon-play"></span></a><?php endif ?>

		</td>
	    </tr>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	</tbody>
    </table>
<?php endif ;
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