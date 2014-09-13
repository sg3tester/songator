-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `content` (`id`, `name`, `heading`, `body`, `data`, `hidden`) VALUES
(1,	'home',	'Homepage',	'<div id=\"sg-main\"> \n      <div class=\"container\">\n        <div class=\"jumbotron\">\n          <h1>DJ JDC\'s otevřený playlist</h1>\n          <br />\n          <p>Chcete slyšet na AsianStyle párty svou oblíbenou písničku? Přidejte ji do\n             playlistu právě teď! Do databáze DJova playlistu jste již přidali více než 1000 tipů. Přispějte i svými dalšími tipy!</p>\n             <br />\n          <p>\n            <a n:href=\"song:add\" class=\"btn btn-primary btn-lg\" role=\"button\">Přidat song</a>\n            <a n:href=\"song:list\" class=\"btn btn-default btn-lg\" role=\"button\">Procházet songy</a>\n          </p>\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-about\" class=\"container\">\n      <div class=\"page-header text-center\">\n      <h1>Co je DJ\'s otevřený playlist?</h1>\n      <p class=\"lead\">Nahlédnout a přispět do playlistu může kdokoli a kdekoli</p>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-8\">\n          <p>DJ JDC se v rámci zpětné vazby a zlepšování opět rozhodl dát prostor zase VÁM! Prostřednictvím tohoto malého portálu můžete dát DJovi tipy na songy, které byste rádi na AS párty slyšeli a zatančili si na ně. Stačí k tomu jediné - Poslat váš tip přes náš formulář!</p>\n          <p>Pro více informací ohledně DJova playlistu sledujte JDC\'s oficiální Facebook (dejte mu lajk, uděláte mu tím radost a zachráníte život dvaceti kočičkám a třem tisícům stromů :P) a pro všeobecné informace ohledně párty sledujte server AsianStyle.cz</p>\n        </div>\n        <div class=\"col-md-4 text-center\">\n        <img src=\"img/music.png\" />\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-video\">\n      <div class=\"container\">\n        <div class=\"page-header text-center\">\n        <h1>Co je AsianStyle party?</h1>\n        <p class=\"lead\">Největší pařba na asijskou hudbu v Česku!</p>\n        </div>\n        <div class=\"row\">\n          <div class=\"col-md-7\">\n            <iframe width=\"640\" height=\"360\" src=\"http://www.youtube.com/embed/yEqDOBZ7DK8\" frameborder=\"0\" allowfullscreen></iframe>\n          </div>\n          <div class=\"col-md-5\">\n            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam imperdiet neque velit, in lobortis massa accumsan in. Sed sollicitudin felis urna. Proin sollicitudin lacus sit amet nunc pulvinar tempor. Aliquam libero sem, volutpat nec nisl fermentum, imperdiet sodales dui. Integer ligula nulla, lacinia vitae mollis nec, tincidunt ac leo. Suspendisse viverra luctus dui ut accumsan. Aliquam sit amet consectetur diam. Proin adipiscing nisi quis quam tempor, ut commodo magna volutpat. Praesent ante lorem, commodo sed neque quis, porta vulputate enim. Mauris dictum risus ut turpis fringilla egestas.</p>\n            <p>Quisque at fringilla justo, nec placerat ante. Quisque posuere nisi tellus, a iaculis sem vestibulum sit amet. Pellentesque posuere hendrerit nunc vitae sodales. Vivamus nisi mi, feugiat et odio nec, consectetur blandit lorem. Sed dictum lectus at eros dapibus, a porta nibh adipiscing. Praesent lacinia vulputate dignissim. Nam facilisis volutpat odio, a molestie erat pulvinar vitae.</p>\n          </div>\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-party\" class=\"container\">\n      <div class=\"page-header text-center\">\n        <h1>Kdy a kde bude další AS párty?</h1>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-8\">\n          <p class=\"lead\">Zatím není známo, kdy a kde se bude konat nadcházející AsianStyle párty.<br />O případném konání této akce budeme informovat.</p>\n          <div class=\"text-center\"><img src=\"img/dolby.png\" /></div>\n        </div>\n        <div class=\"col-md-4\">\n          <div class=\"panel panel-default\">\n          <div class=\"panel-heading\">\n            <h3 class=\"panel-title\">Proběhlé akce</h3>\n          </div>\n            <div class=\"list-group\">\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">AsianStyle party <small class=\"sg-light\">20. duben 2013</small></a>\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">AsianStyle party 2 - CZHW víkend <small class=\"sg-light\">11. srpen 2013</small></a>\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">Narozeninová AsianStyle party <small class=\"sg-light\">7. prosinec 2013</small></a>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-staff\" class=\"container\">\n      <div class=\"page-header text-center\">\n        <h1>Kdo je na párty DJ?</h1>\n        <p class=\"lead\">Na této akci vás krmí hudbou DJ JDC</p>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-4\">\n          <img src=\"img/dj.png\" />\n        </div>\n        <div class=\"col-md-4\">\n          <h3>About DJ</h3>\n          <p>Kdo je vlastně ten DJ JDC? Myslím, že odpově na tuto otázku neuhodnete, jelikož je to člověk, jako každý jiný. A nebo ne? Každopádně ať už je co je, hudbu prostě miluje, a už je jakéhokoli druhu. Nejraději má ovšem tu asijskou a proto se ve svém volném čase věnuje hraní asijské hudby na AsianStyle párty. Pokud se někdy přijdete podívat, ať už ze zvědavosti, nebo si jen tak zatancovat, zajisté usyšíte K-POP, C-POP, J-POP, Thai-Pop a další asijské žánry a styly.</p>\n        </div>\n        <div class=\"col-md-4\">\n          <h3>Správci playlistu</h3>\n          <ul>\n            <li><strong>JDC</strong> <small>DJ, Admin</small></li>\n            <li><strong>Syrinox</strong> <small>Asistentka</small></li>\n          </ul>\n        </div>\n      </div>\n      <div id=\"sg-social\" class=\"text-center\">\n        <a href=\"https://www.facebook.com/officialJDC\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/facebook-icon.png\" alt=\"\" /></a>\n        <a href=\"http://www.twitter.com/JarDacan\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/twitter-icon.png\" alt=\"\" /></a>\n        <a href=\"https://plus.google.com/u/0/+JaroslavJDCVojt&iacute;&scaron;ek\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/google-plus-icon.png\" alt=\"\" /></a>\n        <a href=\"http://www.youtube.com/user/cunoryp\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/youtube-icon.png\" alt=\"\" /></a>\n      </div>\n    </div>\n    \n    <div id=\"sg-contact\" class=\"container\">\n      <div class=\"page-header text-center\">\n        <h1>Kontaktujte nás</h1>\n        <p class=\"lead\">Sdělte nám své dotazy, názory, připomínky</p>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-6\">\n          <form role=\"form\">\n            <h3>Zanechte vzkaz</h3>\n            <p>Než nám zanecháte vzkaz, přečtěte si <a href=\"#\">Často kladené dotazy.</a></p>\n            <div class=\"form-group\">\n              <div class=\"input-group\">\n                <span class=\"input-group-addon\">@</span>\n                <input name=\"email\" type=\"text\" class=\"form-control\" placeholder=\"Váš e-mail\">\n              </div>\n            </div>\n            <div class=\"form-group\">\n              <div class=\"input-group\">\n                <span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-envelope\"></i></span>\n                <input name=\"subject\" type=\"text\" class=\"form-control\" placeholder=\"Zadejte předmět zprávy\">\n              </div>\n            </div>\n            <div class=\"form-group\">\n              <textarea name=\"text\" type=\"text\" class=\"form-control\" placeholder=\"Napište zprávu\"></textarea>\n            </div>\n            <input type=\"submit\" class=\"btn btn-default\" value=\"Odeslat\">\n          </form>\n        </div>\n      </div>\n    </div>',	'',	1),
(2,	'rules',	'Pravidla přidávání songů',	'<h3>Pravidla Songatoru</h3>\n\n<p>Tady jednoho krásného dne budou pravidla přidávání songů :P</p>',	'',	0);

INSERT INTO `interpret` (`id`, `nazev`, `desc`, `interpret_id`, `valid`, `picture`, `user_id`, `pridal`, `datum`) VALUES
(1,	'2NE1',	'2NE1 ( korejsky 투애니원 se vyslovuje „To anyone“ nebo „Twenty-one“ ) je čtyřčlenná jihokorejská dívčí skupina vytvořená YG Entertainment. Nejprve jste je mohli vidět v obchodní kampani pro LG spolu s chlapeckou skupinou Big Bang. Jejich první debutový singl „Fire“, který byl (a pořád je) úspěšný, vyšel 6. května 2009. Hned na to 17. května 2009 skupina vystoupila se svým prvním singlem na Inkigayo SBS. Název skupiny 2NE1 je zkratka pro „Nový vývoj 21. století“.',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(2,	'21',	'2NE1 alias',	1,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(3,	'BIGBANG',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(4,	'2PM',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(5,	'Girls\' Generation',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(6,	'SNSD',	'',	5,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(7,	'Miss A',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(8,	'이블',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(9,	'Super Junior',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(10,	'f(x)',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(11,	'G-Dragon',	'GD je king',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(12,	'GD',	'blablabla GD je king',	11,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(13,	'CL',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(14,	'Sistar',	'',	NULL,	0,	'',	NULL,	'',	'2014-09-05 22:38:31'),
(15,	'Brown Eyed Girls',	'BEG',	NULL,	0,	'',	1,	'JDC',	'2014-09-05 22:38:31'),
(16,	'EXO',	'',	NULL,	0,	'',	1,	'JDC',	'2014-09-05 22:38:31'),
(17,	'BEG',	'',	15,	0,	'',	1,	'JDC',	'2014-09-05 22:38:31'),
(21,	'EvoL',	'',	8,	0,	'',	1,	'JDC',	'2014-09-05 22:38:31');

INSERT INTO `navbar` (`id`, `factory`, `config`, `dock`, `level`) VALUES
(1,	'\\App\\Controls\\IPlaylistBarFactory',	'{\"barname\":\"Playlist\",\"pages\":[{\"title\":\"Pravidla přidávání songů\",\"link\":\"page:rules\",\"presenter\":true},{\"title\":\"FAQ\",\"link\":\"page:faq\",\"presenter\":true}]}',	'left',	0),
(2,	'\\App\\Controls\\ILoginBarFactory',	'',	'right',	0),
(3,	'\\App\\Controls\\IInterpretBarFactory',	'',	'left',	1),
(4,	'\\App\\Controls\\IBlogBarFactory',	'',	'left',	2);

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(3,	'page_rules',	'rules'),
(4,	'page_home',	'home'),
(5,	'songator_wip',	'0'),
(6,	'songator_status',	'enabled'),
(7,	'songator_msg',	'Přidávání songů bylo uzavřeno. Všem děkujeme za spolupráci.'),
(8,	'songlist_reguser_add',	'0'),
(9,	'ucp_allow_register',	'1'),
(10,	'ucp_twitter_login',	'1'),
(11,	'songlist_mode',	'open'),
(12,	'songlist_allowed_players',	'youtube.com;soundcloud.com;dailymotion.com'),
(14,	'meta_robots',	'noindex, nofollow'),
(15,	'ga_code',	'<enter Google Analytics code here>');

INSERT INTO `zanr` (`id`, `name`, `popis`, `datum`) VALUES
(1,	'K-POP',	'Korejská populární hudba',	'2014-09-05 22:39:22'),
(2,	'J-POP',	'Japonská populární hudba',	'2014-09-05 22:39:22'),
(3,	'J-ROCK',	'Japonský rock',	'2014-09-05 22:39:22'),
(4,	'C-POP',	'Čínská populární hudba',	'2014-09-05 22:39:22'),
(7,	'Thai-Pop',	'Thajská populární hudba',	'2014-09-13 08:19:59'),
(8,	'K-ROCK',	'',	'2014-09-13 08:25:00');

-- 2014-09-13 08:50:53
