<?php //netteCache[01]000375a:2:{s:4:"time";s:21:"0.35915400 1389654662";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:53:"/var/www/playlist/app/ASParty/templates/Hup/log.latte";i:2;i:1389654570;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/app/ASParty/templates/Hup/log.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'dqi67mpruf')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb06580b7468_content')) { function _lb06580b7468_content($_l, $_args) { extract($_args)
?><table class="nesys-table" width="100%">
	<thead>
		<th>Timestamp</th>
		<th>IP</th>
		<th>Song</th>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($logs as $log): ?>
			<tr>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($log->timestamp, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($log->ip, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($log->ref("songy","songy_id")->interpret, ENT_NOQUOTES) ?>
 - <?php echo Nette\Templating\Helpers::escapeHtml($log->ref("songy","songy_id")->song, ENT_NOQUOTES) ?></td>
			</tr>
<?php $iterations++; endforeach ?>
	</tbody>
</table><?php
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