<?php //netteCache[01]000367a:2:{s:4:"time";s:21:"0.86761300 1389651723";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:45:"/var/www/playlist/app/templates/@layout.latte";i:2;i:1389651718;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: /var/www/playlist/app/templates/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'uj6spzaob7')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb595921e207_title')) { function _lb595921e207_title($_l, $_args) { extract($_args)
;echo Nette\Templating\Helpers::escapeHtml($sitedesc, ENT_NOQUOTES) ;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb1fc1ed3e15_head')) { function _lb1fc1ed3e15_head($_l, $_args) { extract($_args)
;
}}

//
// block header
//
if (!function_exists($_l->blocks['header'][] = '_lb3db8ff88ab_header')) { function _lb3db8ff88ab_header($_l, $_args) { extract($_args)
?>	<div class="webwidth">
	    <header>
		<a href="<?php echo htmlSpecialChars($_control->link(":homepage:default")) ?>"><img src="<?php echo htmlSpecialChars($basePath) ?>/img/as_party_logo2beta.png" /></a>
		<?php if ($devel): ?><div class='devel'><?php echo Nette\Templating\Helpers::escapeHtml($develMsg, ENT_NOQUOTES) ?>
</div><?php endif ?>

	    </header>
	    <menu>
		<ul>
		    <li><a href="<?php echo htmlSpecialChars($_control->link(":homepage:default")) ?>
">Domů</a></li>
		    <li><a href="<?php echo htmlSpecialChars($_control->link(":song:add")) ?>">Přidat song</a></li>
		    <li><a href="<?php echo htmlSpecialChars($_control->link(":song:list")) ?>
">Seznam songů</a></li>
		    <li><a href="<?php echo htmlSpecialChars($_control->link(":homepage:kontakt")) ?>
">Kontakt</a></li>
		</ul>
	    </menu>
	    <div class="admin">
<?php if ($isLoggedIn): ?>
	    <h1><?php echo Nette\Templating\Helpers::escapeHtml($uzivatel, ENT_NOQUOTES) ?><span style="font-size: 10px">&nbsp;
		
			<a href="<?php echo htmlSpecialChars($_control->link("sign:out")) ?>">Odhlásit</a></span></h1>
<?php else: ?>
	    <br />
	    <h1><a href="<?php echo htmlSpecialChars($_control->link("sign:in")) ?>">DJ's secret</a></h1>
<?php endif ;if ($user->isAllowed("system","view")): ?>
	    <a href="<?php echo htmlSpecialChars($_control->link(":system:system:default")) ?>
">Správa systému</a>
<?php endif ?>
	    </div>
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
<?php if (isset($robots)): ?>	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- <meta http-equiv="cache-control" content="no-cache" /> -->
	<meta name="author" content="JDC Entertainment" />
	<meta name="description" content="Otevřený playlist na AsianStyle párty DJe JDC" />
	<meta name="generator" content="Nesys/Nette" />
	<meta name="keywords" content="JDC,hudba,playlist,párty,DJ,Asian Style,Nesys,2ne1.cz,JDC Entertainment,help,tvorba,music,asie,K-POP,J-POP,Thaipop,asijská hudba" />
	<title><?php echo Nette\Templating\Helpers::escapeHtml($sitename, ENT_NOQUOTES) ?>
 - <?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->striptags(ob_get_clean())  ?></title>
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/nesys.css" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/roboto.css" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/slider.css" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/style.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.png" />
	<link rel="stylesheet" href="<?php echo htmlSpecialChars($basePath) ?>/css/font-awesome.css" />
	<script type="application/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/live-form-validation.js"></script>
	<script type="application/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.aw-showcase.min.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/funkce.js"></script>
	<script>
	    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	    ga('create', 'UA-37944322-5', '2ne1.cz');
	    ga('send', 'pageview');

	</script>
	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

</head>

<body>
	<script> document.documentElement.className+=' js' </script>

	
<?php call_user_func(reset($_l->blocks['header']), $_l, get_defined_vars()) ; Nette\Diagnostics\Debugger::barDump(get_defined_vars(), "Template " . str_replace(dirname(dirname($template->getFile())), "\xE2\x80\xA6", $template->getFile())) ?>
	    <div class="content">
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
	    </div>

	    <footer>
		<div class="footmenu">
		    <ul>
			<li><a href="<?php echo htmlSpecialChars($_control->link("interpreti:")) ?>">Seznam interpretů</a></li>
			<li><a href="<?php echo htmlSpecialChars($_control->link("homepage:dj")) ?>">About DJ</a></li>
			<li><a href="<?php echo htmlSpecialChars($_control->link("homepage:asparty")) ?>
">About AsianStyle party</a></li>
			<li><a href="<?php echo htmlSpecialChars($_control->link("homepage:kontakt")) ?>
">Kontakt</a></li>
		    </ul>
		</div>
		<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FofficialJDC&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
		<div class="copy">Copyright &copy; 2013-2014 - JDC Entertainment & AsianStyle</div>
		<div class="powered">Powered by Nesys</div>
		<div class="partners">
		    <a href="http://jdc.2ne1.cz/" target="_blank"><img src="<?php echo htmlSpecialChars($basePath) ?>/img/jdcent.png" /></a>
		    <a href="http://www.asianstyle.cz/" target="_blank"><img src="<?php echo htmlSpecialChars($basePath) ?>/img/as.png" /></a>
		</div>
	    </footer>
	</div>
</body>
</html>
