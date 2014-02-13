<?php //netteCache[01]000385a:2:{s:4:"time";s:21:"0.10600200 1389644088";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:63:"/var/www/playlist/app/ASParty/templates/Interpreti/detail.latte";i:2;i:1385156699;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/app/ASParty/templates/Interpreti/detail.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ri06qv9pq6')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb853313769e_content')) { function _lb853313769e_content($_l, $_args) { extract($_args)
?><h2><?php echo Nette\Templating\Helpers::escapeHtml($interpret->valid, ENT_NOQUOTES) ?></h2>
<p><?php echo Nette\Templating\Helpers::escapeHtml($template->replace($interpret->aliases, ',', ', '), ENT_NOQUOTES) ?></p>
<?php if ($interpret->asprofil): ?>
<a href="http://www.asianstyle.cz/profily/<?php echo htmlSpecialChars($interpret->asprofil) ?>
"><img src="<?php echo htmlSpecialChars($basePath) ?>/img/aslogo_nano.png" /> Profil na AsianStyle.cz</a>
<?php endif ?>

<h3>Songy tohoto interpreta v playlistu</h3>
<div class="songy">
<?php $iterations = 0; foreach ($songy as $song): ?>
    <div class="song">
	<div class="song-status <?php echo htmlSpecialChars($song->status) ?>"></div>
	<div class="song-info">
	<h3><?php echo Nette\Templating\Helpers::escapeHtml($song->interpret, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($song->song, ENT_NOQUOTES) ?></h3>
	<div class="song-zanr"><?php echo Nette\Templating\Helpers::escapeHtml($song->zanr, ENT_NOQUOTES) ?></div>
	<div class="song-cell"><span class="icon-calendar" title="Přidán"></span><?php echo Nette\Templating\Helpers::escapeHtml($song->datum, ENT_NOQUOTES) ?></div>
	<div class="song-cell"><span class="icon-user" title="Žadatel"></span><?php echo Nette\Templating\Helpers::escapeHtml($song->zadatel, ENT_NOQUOTES) ?></div>
<?php if ($song->vzkaz): ?>
	<div class="song-cell"><span class="icon-comment" title="Vzkaz pro DJe"></span><?php echo Nette\Templating\Helpers::escapeHtml($song->vzkaz, ENT_NOQUOTES) ?></div>
<?php endif ;if ($song->note): ?>
	<div class="song-cell"><span class="icon-info-sign dj-note" title="Poznámka DJe"></span><?php echo Nette\Templating\Helpers::escapeHtml($song->note, ENT_NOQUOTES) ?></div>
<?php endif ?>
	<div class="song-youtube"><a href="<?php echo htmlSpecialChars($song->yt) ?>" target="_blank"><span class="icon-play"></span>Play song</a></div>
	</div>
    </div>
<?php $iterations++; endforeach ?>
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 