<?php //netteCache[01]000367a:2:{s:4:"time";s:21:"0.42914900 1389645556";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:45:"/var/www/playlist/libs/Murdej/Menu/Menu.latte";i:2;i:1371378661;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/libs/Murdej/Menu/Menu.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'kzgo1g1jhq')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block link
//
if (!function_exists($_l->blocks['link'][] = '_lb6d36336c36_link')) { function _lb6d36336c36_link($_l, $_args) { extract($_args)
;if ($node->url): ?>
		<a href="<?php echo htmlSpecialChars($node->url) ?>"<?php if ($_l->tmp = array_filter(array($node->itemClass))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>
<?php else: ?>
		<span<?php if ($_l->tmp = array_filter(array($node->itemClass))) echo ' class="' . htmlSpecialChars(implode(" ", array_unique($_l->tmp))) . '"' ?>>
<?php endif ?>
	<?php echo Nette\Templating\Helpers::escapeHtml($node->name, ENT_NOQUOTES) ?>

	<?php if ($node->link): ?></a><?php else: ?></span><?php endif ?>

<?php
}}

//
// block node
//
if (!function_exists($_l->blocks['node'][] = '_lb5e53748f58_node')) { function _lb5e53748f58_node($_l, $_args) { extract($_args)
;if ($node): if (!isset($hideName) || !$hideName): call_user_func(reset($_l->blocks['link']), $_l, array('node' => $node) + get_defined_vars()) ;else: $hideName = false ;endif ;if ($node->nodes && ($showAll || in_array($node, $path) || $node->isRootNode)): ?>
	<ul class="level-<?php echo htmlSpecialChars($level) ?>">
<?php $level++ ;$iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($node->nodes) as $subNode): ?>		<li>
<?php call_user_func(reset($_l->blocks['node']), $_l, array('node' => $subNode) + get_defined_vars()) ?>
		</li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;$level-- ?>
	</ul>
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>


<?php if ($templateType == "nav"): $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($path) as $node): call_user_func(reset($_l->blocks['link']), $_l, array('node' => $node) + get_defined_vars()) ?>
		<?php if (!$iterator->isLast()): ?> <?php echo Nette\Templating\Helpers::escapeHtml($navSeparator, ENT_NOQUOTES) ?>
 <?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;elseif ($templateType == "single"): if ($startNode): $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($startNode->nodes) as $subNode): call_user_func(reset($_l->blocks['link']), $_l, array('node' => $subNode) + get_defined_vars()) ?>
			<?php if (!$iterator->isLast()): ?> <?php echo Nette\Templating\Helpers::escapeHtml($singleSeparator, ENT_NOQUOTES) ?>
 <?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;endif ;elseif ($templateType == "tree"): $level=1 ;call_user_func(reset($_l->blocks['node']), $_l, array('node' => $startNode, 'hideName' => true, 'showSubnodes' => true) + get_defined_vars()) ;endif ;