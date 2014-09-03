<?php

header('HTTP/1.1 503 Service Unavailable');
header('Retry-After: 300'); // 5 minutes in seconds

?>
<!DOCTYPE html>
<meta charset="windows-1250">
<meta name="robots" content="noindex">
<meta name="generator" content="Nette Framework">

<style>
	body { color: #333; background: white; width: 500px; margin: 100px auto }
	h1 { font: bold 47px/1.5 sans-serif; margin: .6em 0 }
	p { font: 21px/1.5 Georgia,serif; margin: 1.5em 0 }
</style>

<title>Stránka je momentálně nedostupná</title>

<h1>Cvičená opice tuní songátor</h1>
Co to znamená? Naše cvičená opička zdatná v programování momentálně maká na drobných úprvách a vylepšeních v songátoru. Vydržte prosím několik minut, než to zase pojede. Mezitím si můžete krátit čas zpěvem ^^</p>
Čas vypnutí: 0:21.<br /> Předpokládaný čas zapnutí portálu: 12:00

<?php

exit;
