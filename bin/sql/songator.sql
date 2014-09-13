-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nadpis` varchar(80) NOT NULL,
  `perex` text NOT NULL,
  `content` longtext NOT NULL,
  `datum` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blog` (`id`, `nadpis`, `perex`, `content`, `datum`, `user_id`) VALUES
(1,	'Testovací článek',	'Mauris sollicitudin gravida enim, ac egestas urna fringilla in. Donec accumsan purus eget turpis congue euismod. Vivamus massa elit, suscipit vestibulum ipsum quis, hendrerit cursus risus. Vivamus leo nisi, sagittis eget dignissim at, gravida ut mauris. Vestibulum porttitor feugiat augue, ac interdum ipsum ultrices eget. Ut consequat in felis id ultricies. Sed eget aliquet tellus, eu gravida tellus. Maecenas gravida magna vitae metus mollis, non scelerisque ante laoreet. ',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pellentesque eros quis enim interdum, at ornare neque aliquet. Etiam a erat at lacus ullamcorper pretium a non arcu. Donec tristique viverra faucibus. Cras a dui euismod ligula euismod malesuada eu quis felis. Fusce elementum massa in sem porta, nec euismod ligula convallis. Suspendisse varius metus sapien, sed congue leo laoreet quis. Cras odio turpis, sodales non sodales eu, dignissim sit amet massa. Praesent tempus, tortor id tincidunt pellentesque, lacus arcu posuere magna, sed venenatis urna ipsum a sapien. Vivamus sed tortor non elit interdum dapibus. In eros mi, cursus id sapien tristique, sollicitudin feugiat magna. Phasellus turpis mauris, molestie sollicitudin ante vel, blandit tristique justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque nunc leo, luctus a massa id, lobortis tincidunt arcu. Fusce ac scelerisque odio, gravida hendrerit dui. Fusce volutpat libero dolor, ac placerat leo iaculis non. Nunc vestibulum ultricies nisl. ',	'2014-04-06 10:25:36',	1),
(2,	'Další zajebanej test, pitcho!',	'Etiam commodo nibh vel pharetra pretium. Donec ultricies elit lectus, nec fringilla quam fermentum non. Morbi et eros pharetra, interdum tellus ac, feugiat nisi. Sed imperdiet viverra metus, id accumsan sem suscipit sed. Nulla congue orci ac nunc elementum, id posuere dui iaculis. Vestibulum erat sem, tristique vitae viverra vitae, euismod id elit. Nulla nec ante pharetra, fringilla mi sed, rutrum turpis. Cras euismod nibh eget metus iaculis, vitae venenatis lorem posuere. ',	'Etiam enim sem, aliquet sed lacinia sed, lobortis in urna. Duis commodo, diam at pulvinar rhoncus, purus arcu blandit leo, eu consectetur elit libero molestie purus. Duis at nisl magna. Praesent sit amet eros at dolor interdum aliquam. Vivamus tempus pretium sem ac molestie. Proin at elit egestas, dictum orci quis, tincidunt eros. In blandit odio nec erat venenatis bibendum. Curabitur velit mi, tincidunt ac pellentesque non, sodales mattis dolor. Nulla et nunc euismod, porttitor ligula eget, imperdiet ipsum. Cras id laoreet arcu, ut vulputate est. Praesent faucibus, augue eu placerat consequat, neque urna consequat magna, at porttitor turpis nisl eget urna. Sed ut nulla at metus scelerisque ultrices nec id sapien. Mauris urna sem, vestibulum adipiscing arcu at, iaculis gravida mi. Maecenas fermentum quam ut lobortis commodo. Quisque tempor, erat eu lacinia lacinia, ipsum nisl feugiat tellus, vel molestie libero dui eu erat. Sed vestibulum consequat urna vel pharetra. ',	'2014-04-06 11:14:29',	1),
(3,	'Další pitchus',	'asdfasfd asdfas a asdf asdf asdfas dfsdfsfas dfa sdf asdf asdfas fas df as',	'sdfasf sdf asfas df sdyxcvxc x xyvxycv',	'2014-04-06 13:52:01',	1);

DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `blog_tag_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blog_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blog_tag` (`id`, `blog_id`, `tag_id`) VALUES
(1,	1,	2),
(2,	1,	3),
(3,	1,	1),
(4,	2,	1),
(5,	2,	4),
(6,	3,	1),
(7,	3,	3),
(8,	3,	5),
(9,	1,	7);

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `heading` varchar(70) NOT NULL,
  `body` longtext NOT NULL,
  `data` mediumtext NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `content` (`id`, `name`, `heading`, `body`, `data`, `hidden`) VALUES
(1,	'home',	'Homepage',	'<div id=\"sg-main\"> \n      <div class=\"container\">\n        <div class=\"jumbotron\">\n          <h1>DJ JDC\'s otevřený playlist</h1>\n          <br />\n          <p>Chcete slyšet na AsianStyle párty svou oblíbenou písničku? Přidejte ji do\n             playlistu právě teď! Do databáze DJova playlistu jste již přidali více než 1000 tipů. Přispějte i svými dalšími tipy!</p>\n             <br />\n          <p>\n            <a n:href=\"song:add\" class=\"btn btn-primary btn-lg\" role=\"button\">Přidat song</a>\n            <a n:href=\"song:list\" class=\"btn btn-default btn-lg\" role=\"button\">Procházet songy</a>\n          </p>\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-about\" class=\"container\">\n      <div class=\"page-header text-center\">\n      <h1>Co je DJ\'s otevřený playlist?</h1>\n      <p class=\"lead\">Nahlédnout a přispět do playlistu může kdokoli a kdekoli</p>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-8\">\n          <p>DJ JDC se v rámci zpětné vazby a zlepšování opět rozhodl dát prostor zase VÁM! Prostřednictvím tohoto malého portálu můžete dát DJovi tipy na songy, které byste rádi na AS párty slyšeli a zatančili si na ně. Stačí k tomu jediné - Poslat váš tip přes náš formulář!</p>\n          <p>Pro více informací ohledně DJova playlistu sledujte JDC\'s oficiální Facebook (dejte mu lajk, uděláte mu tím radost a zachráníte život dvaceti kočičkám a třem tisícům stromů :P) a pro všeobecné informace ohledně párty sledujte server AsianStyle.cz</p>\n        </div>\n        <div class=\"col-md-4 text-center\">\n        <img src=\"img/music.png\" />\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-video\">\n      <div class=\"container\">\n        <div class=\"page-header text-center\">\n        <h1>Co je AsianStyle party?</h1>\n        <p class=\"lead\">Největší pařba na asijskou hudbu v Česku!</p>\n        </div>\n        <div class=\"row\">\n          <div class=\"col-md-7\">\n            <iframe width=\"640\" height=\"360\" src=\"http://www.youtube.com/embed/yEqDOBZ7DK8\" frameborder=\"0\" allowfullscreen></iframe>\n          </div>\n          <div class=\"col-md-5\">\n            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam imperdiet neque velit, in lobortis massa accumsan in. Sed sollicitudin felis urna. Proin sollicitudin lacus sit amet nunc pulvinar tempor. Aliquam libero sem, volutpat nec nisl fermentum, imperdiet sodales dui. Integer ligula nulla, lacinia vitae mollis nec, tincidunt ac leo. Suspendisse viverra luctus dui ut accumsan. Aliquam sit amet consectetur diam. Proin adipiscing nisi quis quam tempor, ut commodo magna volutpat. Praesent ante lorem, commodo sed neque quis, porta vulputate enim. Mauris dictum risus ut turpis fringilla egestas.</p>\n            <p>Quisque at fringilla justo, nec placerat ante. Quisque posuere nisi tellus, a iaculis sem vestibulum sit amet. Pellentesque posuere hendrerit nunc vitae sodales. Vivamus nisi mi, feugiat et odio nec, consectetur blandit lorem. Sed dictum lectus at eros dapibus, a porta nibh adipiscing. Praesent lacinia vulputate dignissim. Nam facilisis volutpat odio, a molestie erat pulvinar vitae.</p>\n          </div>\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-party\" class=\"container\">\n      <div class=\"page-header text-center\">\n        <h1>Kdy a kde bude další AS párty?</h1>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-8\">\n          <p class=\"lead\">Zatím není známo, kdy a kde se bude konat nadcházející AsianStyle párty.<br />O případném konání této akce budeme informovat.</p>\n          <div class=\"text-center\"><img src=\"img/dolby.png\" /></div>\n        </div>\n        <div class=\"col-md-4\">\n          <div class=\"panel panel-default\">\n          <div class=\"panel-heading\">\n            <h3 class=\"panel-title\">Proběhlé akce</h3>\n          </div>\n            <div class=\"list-group\">\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">AsianStyle party <small class=\"sg-light\">20. duben 2013</small></a>\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">AsianStyle party 2 - CZHW víkend <small class=\"sg-light\">11. srpen 2013</small></a>\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">Narozeninová AsianStyle party <small class=\"sg-light\">7. prosinec 2013</small></a>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n    \n    <div id=\"sg-staff\" class=\"container\">\n      <div class=\"page-header text-center\">\n        <h1>Kdo je na párty DJ?</h1>\n        <p class=\"lead\">Na této akci vás krmí hudbou DJ JDC</p>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-4\">\n          <img src=\"img/dj.png\" />\n        </div>\n        <div class=\"col-md-4\">\n          <h3>About DJ</h3>\n          <p>Kdo je vlastně ten DJ JDC? Myslím, že odpově na tuto otázku neuhodnete, jelikož je to člověk, jako každý jiný. A nebo ne? Každopádně ať už je co je, hudbu prostě miluje, a už je jakéhokoli druhu. Nejraději má ovšem tu asijskou a proto se ve svém volném čase věnuje hraní asijské hudby na AsianStyle párty. Pokud se někdy přijdete podívat, ať už ze zvědavosti, nebo si jen tak zatancovat, zajisté usyšíte K-POP, C-POP, J-POP, Thai-Pop a další asijské žánry a styly.</p>\n        </div>\n        <div class=\"col-md-4\">\n          <h3>Správci playlistu</h3>\n          <ul>\n            <li><strong>JDC</strong> <small>DJ, Admin</small></li>\n            <li><strong>Syrinox</strong> <small>Asistentka</small></li>\n          </ul>\n        </div>\n      </div>\n      <div id=\"sg-social\" class=\"text-center\">\n        <a href=\"https://www.facebook.com/officialJDC\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/facebook-icon.png\" alt=\"\" /></a>\n        <a href=\"http://www.twitter.com/JarDacan\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/twitter-icon.png\" alt=\"\" /></a>\n        <a href=\"https://plus.google.com/u/0/+JaroslavJDCVojt&iacute;&scaron;ek\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/google-plus-icon.png\" alt=\"\" /></a>\n        <a href=\"http://www.youtube.com/user/cunoryp\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/youtube-icon.png\" alt=\"\" /></a>\n      </div>\n    </div>\n    \n    <div id=\"sg-contact\" class=\"container\">\n      <div class=\"page-header text-center\">\n        <h1>Kontaktujte nás</h1>\n        <p class=\"lead\">Sdělte nám své dotazy, názory, připomínky</p>\n      </div>\n      <div class=\"row\">\n        <div class=\"col-md-6\">\n          <form role=\"form\">\n            <h3>Zanechte vzkaz</h3>\n            <p>Než nám zanecháte vzkaz, přečtěte si <a href=\"#\">Často kladené dotazy.</a></p>\n            <div class=\"form-group\">\n              <div class=\"input-group\">\n                <span class=\"input-group-addon\">@</span>\n                <input name=\"email\" type=\"text\" class=\"form-control\" placeholder=\"Váš e-mail\">\n              </div>\n            </div>\n            <div class=\"form-group\">\n              <div class=\"input-group\">\n                <span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-envelope\"></i></span>\n                <input name=\"subject\" type=\"text\" class=\"form-control\" placeholder=\"Zadejte předmět zprávy\">\n              </div>\n            </div>\n            <div class=\"form-group\">\n              <textarea name=\"text\" type=\"text\" class=\"form-control\" placeholder=\"Napište zprávu\"></textarea>\n            </div>\n            <input type=\"submit\" class=\"btn btn-default\" value=\"Odeslat\">\n          </form>\n        </div>\n      </div>\n    </div>',	'',	1),
(2,	'rules',	'Pravidla přidávání songů',	'<h3>Pravidla Songatoru</h3>\n\n<p>Tady jednoho krásného dne budou pravidla přidávání songů :P</p>',	'',	0);

DROP TABLE IF EXISTS `interpret`;
CREATE TABLE `interpret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `interpret_id` int(11) DEFAULT NULL,
  `valid` tinyint(4) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pridal` varchar(255) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `interpret_id` (`interpret_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `interpret_ibfk_1` FOREIGN KEY (`interpret_id`) REFERENCES `interpret` (`id`) ON DELETE SET NULL,
  CONSTRAINT `interpret_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `who` varchar(255) NOT NULL,
  `message` text,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `log` (`id`, `media`, `event`, `user_id`, `who`, `message`, `datum`) VALUES
(176,	'song',	'add',	1,	'JDC',	'JDC přidal(a) do playlistu song  - Do you love mes',	'2014-09-07 11:33:17'),
(177,	'song',	'reject',	1,	'JDC',	'JDC zamítl(a) song 2NE1 - Do you love mes (Duplicita)',	'2014-09-07 11:39:27'),
(178,	'song',	'approve',	1,	'JDC',	'JDC schválil(a) song smrdíš - Muhehehe',	'2014-09-07 12:26:33'),
(179,	'song',	'add',	1,	'JDC',	'JDC přidal(a) do playlistu song test - testlol',	'2014-09-10 09:36:00'),
(180,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:34:11'),
(181,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:38:43'),
(182,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:39:10'),
(183,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:39:15'),
(184,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:40:02'),
(185,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:40:12'),
(186,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:51:42'),
(187,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele JDC',	'2014-09-11 14:51:51'),
(188,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele Buhehe',	'2014-09-11 16:06:53'),
(189,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele Testak',	'2014-09-11 16:10:29'),
(190,	'User',	'edit',	1,	'JDC',	'JDC editoval(a) profil uživatele Testak',	'2014-09-11 16:10:37'),
(191,	'System',	'edit',	1,	'JDC',	'JDC změnila(a) nastavení',	'2014-09-11 17:12:57'),
(192,	'System',	'edit',	1,	'JDC',	'JDC změnila(a) nastavení',	'2014-09-11 17:15:30'),
(193,	'System',	'edit',	1,	'JDC',	'JDC změnila(a) nastavení',	'2014-09-11 17:15:59'),
(194,	'auth',	'logout',	1,	'JDC',	'Uživatel JDC se odhlásil',	'2014-09-11 17:28:05'),
(195,	'auth',	'login',	7,	'Testak',	'Přihlásil se uživatel Testak',	'2014-09-11 17:28:13'),
(196,	'song',	'approve',	7,	'Testak',	'Testak schválil(a) song SISTAR19 - Ma Boy',	'2014-09-11 17:29:37'),
(197,	'song',	'reject',	7,	'Testak',	'Testak zamítl(a) song Sistar - asfsd (Není taneční song)',	'2014-09-11 17:29:48'),
(198,	'System',	'edit',	7,	'Testak',	'Testak změnila(a) nastavení',	'2014-09-11 17:30:50'),
(199,	'auth',	'login',	7,	'Testak',	'Přihlásil se uživatel Testak',	'2014-09-11 18:12:55'),
(200,	'System',	'edit',	7,	'Testak',	'Testak změnila(a) nastavení',	'2014-09-11 18:13:24'),
(201,	'auth',	'logout',	7,	'Testak',	'Uživatel Testak se odhlásil',	'2014-09-11 18:28:30'),
(202,	'auth',	'login',	1,	'JDC',	'Uživatel JDC se přihlásil prostřednictvím Twitteru',	'2014-09-11 18:28:40'),
(203,	'CMS',	'edit',	1,	'JDC',	'JDC uprvila(a) stránku home',	'2014-09-11 18:33:42'),
(204,	'auth',	'login',	7,	'Testak',	'Přihlásil se uživatel Testak',	'2014-09-11 18:36:54'),
(205,	'User',	'delete',	1,	'JDC',	'JDC smazala(a) uživatele testevent',	'2014-09-13 08:15:57'),
(206,	'User',	'delete',	1,	'JDC',	'JDC smazala(a) uživatele testevent2',	'2014-09-13 08:16:15'),
(207,	'Genre',	'add',	1,	'JDC',	'JDC přidala(a) žánr ',	'2014-09-13 08:19:59'),
(208,	'Genre',	'add',	1,	'JDC',	'JDC přidala(a) žánr K-ROCK',	'2014-09-13 08:25:00'),
(209,	'CMS',	'edit',	1,	'JDC',	'JDC uprvila(a) stránku rules',	'2014-09-13 08:27:21'),
(210,	'Interpret',	'delete',	1,	'JDC',	'JDC smazala(a) interpreta Pokusník',	'2014-09-13 08:32:15'),
(211,	'Interpret',	'delete',	1,	'JDC',	'JDC smazala(a) interpreta smrdíš',	'2014-09-13 08:32:20'),
(212,	'Interpret',	'delete',	1,	'JDC',	'JDC smazala(a) interpreta Johohohoooo',	'2014-09-13 08:32:25');

DROP TABLE IF EXISTS `navbar`;
CREATE TABLE `navbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factory` varchar(255) NOT NULL,
  `config` mediumtext NOT NULL,
  `dock` varchar(16) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `navbar` (`id`, `factory`, `config`, `dock`, `level`) VALUES
(1,	'\\App\\Controls\\IPlaylistBarFactory',	'{\"barname\":\"Playlist\",\"pages\":[{\"title\":\"Pravidla přidávání songů\",\"link\":\"page:rules\",\"presenter\":true},{\"title\":\"FAQ\",\"link\":\"page:faq\",\"presenter\":true}]}',	'left',	0),
(2,	'\\App\\Controls\\ILoginBarFactory',	'',	'right',	0),
(3,	'\\App\\Controls\\IInterpretBarFactory',	'',	'left',	1),
(4,	'\\App\\Controls\\IBlogBarFactory',	'',	'left',	2);

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `song`;
CREATE TABLE `song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `interpret_name` varchar(255) NOT NULL,
  `interpret_id` int(11) DEFAULT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'waiting',
  `zanr_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zadatel` varchar(255) NOT NULL,
  `link` varchar(512) NOT NULL,
  `note` varchar(255) NOT NULL,
  `pecka` tinyint(4) NOT NULL,
  `instro` tinyint(4) NOT NULL,
  `remix` tinyint(4) NOT NULL,
  `wishlist_only` tinyint(4) NOT NULL,
  `reason_code` varchar(32) DEFAULT NULL COMMENT 'R10_GENERAL, R20_DUPLICITY, R21_QUALITY, R22_UNACCEPTABLE, R30_ILEGAL, R31_RULES, R40_INVALID, R99_UNKNOWN',
  `revisor` int(11) DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vzkaz` text NOT NULL,
  `private_vzkaz` tinyint(4) NOT NULL,
  `image` text NOT NULL COMMENT 'JSON',
  PRIMARY KEY (`id`),
  KEY `interpret_id` (`interpret_id`),
  KEY `user_id` (`user_id`),
  KEY `revisor` (`revisor`),
  KEY `zanr_id` (`zanr_id`),
  CONSTRAINT `song_ibfk_1` FOREIGN KEY (`interpret_id`) REFERENCES `interpret` (`id`) ON DELETE SET NULL,
  CONSTRAINT `song_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `song_ibfk_3` FOREIGN KEY (`revisor`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `song_ibfk_4` FOREIGN KEY (`zanr_id`) REFERENCES `zanr` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `song` (`id`, `name`, `interpret_name`, `interpret_id`, `status`, `zanr_id`, `user_id`, `zadatel`, `link`, `note`, `pecka`, `instro`, `remix`, `wishlist_only`, `reason_code`, `revisor`, `datum`, `vzkaz`, `private_vzkaz`, `image`) VALUES
(1,	'Pokus',	'Pokusník',	NULL,	'approved',	1,	NULL,	'anonymous',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-17 15:54:54',	'',	0,	''),
(2,	'dgdgf',	'cvbxcvb',	NULL,	'approved',	2,	NULL,	'me',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-17 15:58:04',	'lorem ipsum...',	0,	''),
(3,	'Do you love me',	'2NE1',	1,	'approved',	1,	NULL,	'JDC',	'',	'2NE1 <3',	1,	0,	0,	0,	'0',	1,	'2014-02-19 11:07:45',	'I love 2NE1 <3',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/92137737.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/92137737.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/92137737.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/92137737.png\",\"size\":\"extralarge\"}]'),
(5,	'stsddg',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-20 17:49:48',	'',	0,	''),
(6,	'xcvyxcvxyc',	'sdfsdf',	NULL,	'rejected',	2,	1,	'JarDacan',	'',	'Není taneční song',	0,	0,	0,	0,	'0',	1,	'2014-02-20 17:56:31',	'',	0,	''),
(7,	'xcvyxcvxyc',	'sdfsdf',	NULL,	'rejected',	2,	1,	'JarDacan',	'',	'Nehodí se na párty',	0,	0,	0,	0,	'0',	1,	'2014-02-20 17:57:22',	'',	0,	''),
(8,	'rttz',	'ttt',	NULL,	'rejected',	2,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-02-20 18:02:49',	'',	0,	''),
(9,	'zutzu',	'21',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-20 18:04:06',	'',	0,	''),
(11,	'xxb',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-20 18:07:39',	'',	0,	''),
(12,	'dfgdfg',	'dfgdf',	NULL,	'rejected',	1,	1,	'JarDacan',	'',	'Není taneční song',	0,	0,	1,	0,	'0',	1,	'2014-02-20 22:53:33',	'',	0,	''),
(13,	'Ugly',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'I love 2NE1',	1,	1,	0,	0,	'0',	1,	'2014-02-21 12:24:20',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91321991.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91321991.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91321991.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91321991.png\",\"size\":\"extralarge\"}]'),
(14,	'Lonely',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'jkhkjhk',	0,	1,	0,	0,	'0',	1,	'2014-02-21 12:25:27',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91321991.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91321991.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91321991.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91321991.png\",\"size\":\"extralarge\"}]'),
(15,	'Can\'t nobody',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-23 11:38:09',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/98580719.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/98580719.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/98580719.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/98580719.png\",\"size\":\"extralarge\"}]'),
(16,	'Fantastic baby',	'BIGBANG',	3,	'approved',	1,	NULL,	'JDC',	'',	'',	1,	0,	0,	0,	'0',	1,	'2014-02-23 11:40:29',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/74978658.jpg\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/74978658.jpg\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/74978658.jpg\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/74978658.jpg\",\"size\":\"extralarge\"}]'),
(17,	'Mr. Mr',	'Girls\' Generation',	5,	'approved',	1,	1,	'JarDacan',	'http://www.youtube.com/watch?v=Qq1TaTGrAIQ',	'SNSD <3',	0,	0,	0,	0,	'0',	1,	'2014-02-24 21:49:27',	'',	0,	'null'),
(18,	'Falling in love',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'https://soundcloud.com/vipbjshow/2ne1-falling-in-love',	'2NE1 4ever <3',	1,	0,	0,	0,	'0',	1,	'2014-02-25 15:56:18',	'sdbdsgf dfg dfg sdg dg dgsd g cvxyjcvh xuicvy xicv uvyxuichvxui xyýváxyýcva asudfa sudf',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91317337.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91317337.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91317337.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91317337.png\",\"size\":\"extralarge\"}]'),
(19,	'I love you',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'http://www.dailymotion.com/video/xs0yef_2ne1-i-love-you-sub-espanol-hangul-romanizacion_music',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-28 12:43:24',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/79706415.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/79706415.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/79706415.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/79706415.png\",\"size\":\"extralarge\"}]'),
(20,	'I Got a Boy',	'Girls\' Generation',	5,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-28 19:24:34',	'test asasdfasdf asdf asdf asdfasdf',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/85611815.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/85611815.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/85611815.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/85611815.png\",\"size\":\"extralarge\"}]'),
(21,	'Crush',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'http://www.youtube.com/watch?v=OODTt2kahI0',	'',	1,	0,	0,	0,	'0',	1,	'2014-03-10 11:36:48',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(22,	'Come Back Home',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'http://www.youtube.com/watch?v=vLbfv-AAyvQ',	'',	0,	0,	0,	0,	'0',	1,	'2014-03-10 11:44:33',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(23,	'너 아님 안돼 (Gotta Be You)',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'https://www.youtube.com/watch?v=pbQP9Q2tNoU',	'',	0,	0,	0,	0,	NULL,	1,	'2014-03-19 13:49:09',	'2NE1 <3',	1,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99748523.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99748523.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99748523.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99748523.png\",\"size\":\"extralarge\"}]'),
(24,	'Beautiful Hangover',	'BIGBANG',	3,	'waiting',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-03-19 13:53:33',	'twertwert',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/50585459.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/50585459.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/50585459.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/50585459.png\",\"size\":\"extralarge\"}]'),
(25,	'We are a bit different',	'EvoL',	8,	'waiting',	1,	NULL,	'Lolek',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-03-19 13:56:23',	'',	0,	'null'),
(26,	'High High',	'GD&TOP',	3,	'rejected',	1,	1,	'JDC',	'',	'Není taneční song',	0,	0,	0,	0,	'0',	1,	'2014-03-20 10:25:58',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/72210402.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/72210402.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/72210402.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/72210402.png\",\"size\":\"extralarge\"}]'),
(28,	'Happy',	'2NE1',	1,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-06 20:21:17',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(29,	'Oh my friend',	'BIGBANG',	3,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-06 20:21:47',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/81637739.jpg\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/81637739.jpg\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/81637739.jpg\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/81637739.jpg\",\"size\":\"extralarge\"}]'),
(30,	'saasfsadf',	'sfsf',	NULL,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-09 21:57:45',	'Lol tajnej vzkaz',	1,	''),
(31,	'dsgfsdf',	'ddgf',	NULL,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-09 21:59:16',	'veřejný',	0,	''),
(32,	'tst',	'test',	NULL,	'rejected',	3,	NULL,	'lolokol',	'',	'Není k dispozici v požadované kvalitě',	0,	0,	0,	0,	'0',	1,	'2014-04-11 19:10:02',	'ffgdfgv cxvb dgfdg dgf ',	0,	'null'),
(33,	'sfsfcx',	'ssdf',	NULL,	'approved',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-11 19:23:58',	'xcvxcvxcv',	1,	''),
(34,	'asdasd',	'adasd',	5,	'approved',	2,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 07:53:42',	'',	0,	'null'),
(35,	'aasas',	'asasd',	NULL,	'rejected',	2,	1,	'JDC',	'',	'Není k dispozici v požadované kvalitě',	0,	0,	0,	0,	'0',	1,	'2014-04-12 07:58:28',	'sadasd',	0,	''),
(36,	'sdsdsdsd',	'sdsdds',	NULL,	'approved',	4,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 08:02:40',	'',	0,	''),
(37,	'asdasd',	'2NE1',	1,	'approved',	3,	NULL,	'lolk',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 08:03:46',	'',	0,	''),
(38,	'wfefef',	'wfwfwfwf',	NULL,	'approved',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 08:05:15',	'wefwefefef',	0,	''),
(39,	'Scream',	'2NE1',	1,	'waiting',	2,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-13 00:55:20',	'tohle je tajnej vzkaz',	1,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(40,	'sdfsdfgdgf',	'ddfgdfg',	NULL,	'waiting',	1,	3,	'test',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-13 20:13:55',	'sdfgsdgf cvvcvbcvb',	1,	''),
(41,	'dgfsdfgsdfg',	'gsdgsdgf',	NULL,	'waiting',	3,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-13 21:17:14',	'sdfgsdgf',	0,	''),
(42,	'do you love me',	'2NE1',	1,	'rejected',	2,	1,	'JDC',	'',	'Zamítnut managementem AsianStyle.cz',	0,	0,	0,	0,	'0',	1,	'2014-06-14 09:02:57',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/92137737.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/92137737.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/92137737.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/92137737.png\",\"size\":\"extralarge\"}]'),
(43,	'lolok',	'pokus',	NULL,	'rejected',	1,	1,	'JDC',	'',	'Test',	0,	0,	0,	0,	'0',	1,	'2014-06-14 09:39:32',	'',	0,	''),
(44,	'Hands up',	'2PM',	4,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-06-14 21:42:27',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/75480240.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/75480240.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/75480240.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/75480240.png\",\"size\":\"extralarge\"}]'),
(45,	'lljjk',	'2NE1',	1,	'approved',	1,	NULL,	'test',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-06-15 21:25:15',	'',	0,	''),
(46,	'I am the best',	'2NE1',	1,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-06-22 14:10:29',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/78068228.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/78068228.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/78068228.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/78068228.png\",\"size\":\"extralarge\"}]'),
(47,	'hate you',	'2NE1',	1,	'rejected',	1,	1,	'JDC',	'',	'Duplicita',	0,	0,	0,	0,	'R20_DUPLICITY',	1,	'2014-06-22 14:15:09',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91321991.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91321991.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91321991.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91321991.png\",\"size\":\"extralarge\"}]'),
(48,	'Kill Bill',	'Brown Eyed Girls',	15,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-07-18 19:21:08',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91890905.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91890905.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91890905.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91890905.png\",\"size\":\"extralarge\"}]'),
(49,	'test',	'test',	NULL,	'approved',	2,	4,	'test2',	'',	'',	0,	0,	1,	1,	'0',	1,	'2014-07-23 20:22:15',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/53193637.jpg\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/53193637.jpg\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/53193637.jpg\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/53193637.jpg\",\"size\":\"extralarge\"}]'),
(50,	'Be mine',	'2NE1',	1,	'approved',	1,	1,	'JDC',	'http://www.youtube.com/watch?v=vZtd_m3VDJI',	'',	0,	0,	0,	1,	NULL,	1,	'2014-08-17 08:48:37',	'2NE1 Be mine',	1,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/78477882.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/78477882.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/78477882.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/78477882.png\",\"size\":\"extralarge\"}]'),
(51,	'lolk',	'test',	NULL,	'waiting',	3,	1,	'JDC',	'http://www.youtube.com/watch?v=vZtd_m3VDJI',	'',	0,	0,	0,	0,	'',	NULL,	'2014-09-03 10:33:30',	'',	0,	'null'),
(53,	'Get Up',	'이블',	8,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'',	NULL,	'2014-09-05 14:41:55',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/98365711.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/98365711.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/98365711.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/98365711.png\",\"size\":\"extralarge\"}]'),
(54,	'lokus',	'pokus',	NULL,	'waiting',	2,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'',	NULL,	'2014-09-05 17:40:37',	'',	0,	'null'),
(55,	'mehehel',	'pokus',	NULL,	'waiting',	3,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'',	NULL,	'2014-09-05 17:41:15',	'',	0,	'null'),
(60,	'testlol',	'test',	NULL,	'waiting',	3,	1,	'JDC',	'http://www.google.com',	'',	0,	0,	0,	0,	'',	NULL,	'2014-09-10 09:36:00',	'',	0,	'null'),
(61,	'testjk',	'test',	NULL,	'approved',	1,	NULL,	'sdfsf',	'',	'',	0,	0,	0,	0,	NULL,	NULL,	'2014-09-10 12:29:26',	'',	0,	''),
(62,	'Fire',	'2NE1',	1,	'waiting',	1,	1,	'JDC',	'',	'',	1,	0,	0,	0,	NULL,	1,	'2014-09-10 15:58:20',	'',	0,	''),
(63,	'qwerwqer',	'sdfasdfasdf',	NULL,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	NULL,	1,	'2014-09-10 16:02:17',	'',	0,	''),
(64,	'test',	'SISTAR',	14,	'waiting',	2,	1,	'JDC',	'',	'',	0,	0,	0,	0,	NULL,	1,	'2014-09-10 16:02:36',	'',	0,	''),
(65,	'oío j',	'tz',	NULL,	'waiting',	4,	1,	'JDC',	'',	'',	0,	0,	0,	0,	NULL,	1,	'2014-09-10 16:02:48',	'',	0,	''),
(66,	'asfsd',	'Sistar',	14,	'rejected',	1,	1,	'JDC',	'',	'Není taneční song',	0,	0,	0,	0,	'R10_GENERAL',	7,	'2014-09-10 16:03:01',	'',	0,	''),
(69,	'Ma Boy',	'SISTAR19',	14,	'approved',	1,	1,	'JDC',	'',	'test asistent',	1,	0,	0,	0,	NULL,	7,	'2014-09-10 16:08:08',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/87950451.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/87950451.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/87950451.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/87950451.png\",\"size\":\"extralarge\"}]');

DROP TABLE IF EXISTS `song_likes`;
CREATE TABLE `song_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `song_id` (`song_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `song_likes_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE,
  CONSTRAINT `song_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `song_likes` (`id`, `song_id`, `user_id`, `date`) VALUES
(3,	28,	1,	'2014-06-14 07:53:36'),
(4,	29,	1,	'2014-06-14 07:56:45'),
(5,	25,	1,	'2014-06-14 08:22:51'),
(6,	22,	1,	'2014-06-14 08:25:19'),
(7,	37,	1,	'2014-06-14 12:32:59'),
(8,	22,	1,	'2014-06-15 19:18:51'),
(9,	21,	1,	'2014-06-15 20:00:58'),
(10,	18,	1,	'2014-06-15 20:01:27'),
(11,	47,	1,	'2014-07-18 18:09:56'),
(12,	49,	4,	'2014-07-23 20:22:57'),
(13,	48,	1,	'2014-07-26 14:56:40'),
(14,	21,	1,	'2014-08-17 09:40:26'),
(15,	50,	1,	'2014-09-03 09:12:09'),
(16,	46,	1,	'2014-09-03 10:15:28'),
(17,	44,	1,	'2014-09-03 10:15:43'),
(18,	48,	1,	'2014-09-03 10:21:57'),
(19,	29,	1,	'2014-09-03 10:22:38'),
(20,	21,	1,	'2014-09-03 10:23:03'),
(21,	18,	1,	'2014-09-03 10:23:53'),
(22,	45,	1,	'2014-09-03 11:05:36'),
(23,	50,	1,	'2014-09-04 10:15:51'),
(24,	22,	1,	'2014-09-04 10:16:17'),
(25,	17,	1,	'2014-09-04 10:16:38'),
(26,	3,	1,	'2014-09-04 10:16:55'),
(27,	21,	1,	'2014-09-04 12:32:51'),
(28,	50,	1,	'2014-09-05 21:23:24'),
(29,	21,	1,	'2014-09-05 21:47:32'),
(30,	17,	1,	'2014-09-05 21:48:46'),
(31,	3,	1,	'2014-09-05 21:51:40'),
(32,	18,	1,	'2014-09-06 09:04:08'),
(33,	48,	5,	'2014-09-06 10:14:30'),
(34,	28,	5,	'2014-09-06 10:15:23'),
(35,	18,	5,	'2014-09-06 10:15:29'),
(36,	21,	5,	'2014-09-06 10:15:36'),
(37,	48,	1,	'2014-09-07 12:40:04'),
(38,	50,	1,	'2014-09-10 09:41:31'),
(39,	39,	1,	'2014-09-10 09:46:03'),
(40,	69,	1,	'2014-09-11 13:22:55'),
(41,	69,	7,	'2014-09-11 18:37:00'),
(42,	62,	7,	'2014-09-11 18:37:13'),
(43,	50,	7,	'2014-09-11 18:37:18'),
(44,	48,	7,	'2014-09-11 18:37:22'),
(45,	62,	1,	'2014-09-11 18:39:22'),
(46,	48,	1,	'2014-09-11 18:39:30'),
(47,	50,	1,	'2014-09-11 18:39:38'),
(48,	44,	1,	'2014-09-11 18:39:43'),
(49,	21,	1,	'2014-09-11 18:39:54'),
(50,	21,	7,	'2014-09-11 18:40:05'),
(51,	53,	1,	'2014-09-12 13:10:41');

DROP TABLE IF EXISTS `storage`;
CREATE TABLE `storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `type` varchar(64) NOT NULL,
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tag` (`id`, `name`) VALUES
(1,	'test'),
(2,	'k-pop'),
(3,	'hudba'),
(4,	'DJ'),
(5,	'kecy'),
(6,	'pitchoviny'),
(7,	'srajdy');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(64) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(24) NOT NULL,
  `auth_service` varchar(24) NOT NULL,
  `auth_token` varchar(32) NOT NULL,
  `first_login` tinyint(1) NOT NULL DEFAULT '1',
  `realname` varchar(255) NOT NULL,
  `about` varchar(512) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `twitter_acc` varchar(64) NOT NULL,
  `www` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`, `registered`, `ip`, `auth_service`, `auth_token`, `first_login`, `realname`, `about`, `avatar`, `twitter_acc`, `www`) VALUES
(1,	'JDC',	'',	'jdc@2ne1.cz',	'admin',	'2014-02-18 11:15:07',	'',	'twitter',	'364921955',	0,	'JDC (이지민)',	'Producer, Song writer, DJ, Programmer, Author, Editor, Amatuer writer, Lyrics writer and Blogger in JDC Entertainment.',	'http://pbs.twimg.com/profile_images/2548714957/zxmzvsd9so5cjvkco9eq_normal.jpeg',	'JarDacan',	'http://www.jdc.2ne1.cz'),
(3,	'test',	'$2y$10$v9d592UJJ/uw9Ijb/Qb6xuOuKYk2AJ5.WKlffEI3kFv3YzRx7fLWW',	'test@test.localhost',	'user',	'2014-04-13 20:00:34',	'',	'songator',	'',	0,	'Testovací účet',	'',	'',	'',	''),
(4,	'test2',	'$2y$10$9BRwmWIZmGXbHYJN734bluIr/i/rT9xnqFWS1tTIXZqFzmQBZM6xW',	'test@test.localhostt',	'user',	'2014-07-23 20:18:50',	'',	'songator',	'',	0,	'test2',	'',	'',	'',	''),
(5,	'tester',	'$2y$10$xVd1050eeXIGABlp.qCbb.16uqEKIeIAUscEFHsBXU/E2cx3P0mBK',	'test@test.local',	'user',	'2014-09-06 09:30:48',	'',	'songator',	'',	0,	'tester',	'',	'',	'',	''),
(6,	'Buhehe',	'$2y$10$xVd1050eeXIGABlp.qCbb.4GhxWkIIsELESAlNTXzJc9n8Dpjj2VC',	'buhehe@lol.kok',	'user',	'2014-09-11 16:06:53',	'',	'songator',	'',	1,	'',	'',	'',	'',	''),
(7,	'Testak',	'$2y$10$xVd1050eeXIGABlp.qCbb.4GhxWkIIsELESAlNTXzJc9n8Dpjj2VC',	'testak@lol.sd',	'asistent',	'2014-09-11 16:10:29',	'',	'songator',	'',	0,	'Testak',	'',	'',	'',	''),
(10,	'Testmail',	'$2y$10$xVd1050eeXIGABlp.qCbb.4GhxWkIIsELESAlNTXzJc9n8Dpjj2VC',	'test@mail.lol',	'user',	'2014-09-12 17:17:04',	'',	'songator',	'',	1,	'',	'',	'',	'',	''),
(11,	'Testmail2',	'$2y$10$xVd1050eeXIGABlp.qCbb.4GhxWkIIsELESAlNTXzJc9n8Dpjj2VC',	'test@mail.loll',	'user',	'2014-09-12 17:18:06',	'',	'songator',	'',	1,	'',	'',	'',	'',	''),
(12,	'Testmail3',	'$2y$10$xVd1050eeXIGABlp.qCbb.4GhxWkIIsELESAlNTXzJc9n8Dpjj2VC',	'test@mail.lolf',	'user',	'2014-09-12 17:22:28',	'',	'songator',	'',	1,	'',	'',	'',	'',	'');

DROP TABLE IF EXISTS `zanr`;
CREATE TABLE `zanr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `popis` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `zanr` (`id`, `name`, `popis`, `datum`) VALUES
(1,	'K-POP',	'Korejská populární hudba',	'2014-09-05 22:39:22'),
(2,	'J-POP',	'Japonská populární hudba',	'2014-09-05 22:39:22'),
(3,	'J-ROCK',	'Japonský rock',	'2014-09-05 22:39:22'),
(4,	'C-POP',	'Čínská populární hudba',	'2014-09-05 22:39:22'),
(7,	'Thai-Pop',	'Thajská populární hudba',	'2014-09-13 08:19:59'),
(8,	'K-ROCK',	'',	'2014-09-13 08:25:00');

-- 2014-09-13 08:49:58
