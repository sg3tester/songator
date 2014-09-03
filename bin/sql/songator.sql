-- Adminer 4.0.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+02:00';
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
(1,	'home',	'Homepage',	'<div id=\"sg-main\"> \r\n      <div class=\"container\">\r\n        <div class=\"jumbotron\">\r\n          <h1>DJ JDC\'s otevřený playlist</h1>\r\n          <br />\r\n          <p>Chcete slyšet na AsianStyle párty svou oblíbenou písničku? Přidejte ji do\r\n             playlistu právě teď! Do databáze DJova playlistu jste již přidali více než 1000 tipů. Přispějte i svými dalšími tipy!</p>\r\n             <br />\r\n          <p>\r\n            <a href=\"#\" class=\"btn btn-primary btn-lg\" role=\"button\">Přidat song</a>\r\n            <a href=\"#\" class=\"btn btn-default btn-lg\" role=\"button\">Procházet songy</a>\r\n          </p>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    \r\n    <div id=\"sg-about\" class=\"container\">\r\n      <div class=\"page-header text-center\">\r\n      <h1>Co je DJ\'s otevřený playlist?</h1>\r\n      <p class=\"lead\">Nahlédnout a přispět do playlistu může kdokoli a kdekoli</p>\r\n      </div>\r\n      <div class=\"row\">\r\n        <div class=\"col-md-8\">\r\n          <p>DJ JDC se v rámci zpětné vazby a zlepšování opět rozhodl dát prostor zase VÁM! Prostřednictvím tohoto malého portálu můžete dát DJovi tipy na songy, které byste rádi na AS párty slyšeli a zatančili si na ně. Stačí k tomu jediné - Poslat váš tip přes náš formulář!</p>\r\n          <p>Pro více informací ohledně DJova playlistu sledujte JDC\'s oficiální Facebook (dejte mu lajk, uděláte mu tím radost a zachráníte život dvaceti kočičkám a třem tisícům stromů :P) a pro všeobecné informace ohledně párty sledujte server AsianStyle.cz</p>\r\n        </div>\r\n        <div class=\"col-md-4 text-center\">\r\n        <img src=\"img/music.png\" />\r\n        </div>\r\n      </div>\r\n    </div>\r\n    \r\n    <div id=\"sg-video\">\r\n      <div class=\"container\">\r\n        <div class=\"page-header text-center\">\r\n        <h1>Co je AsianStyle party?</h1>\r\n        <p class=\"lead\">Největší pařba na asijskou hudbu v Česku!</p>\r\n        </div>\r\n        <div class=\"row\">\r\n          <div class=\"col-md-7\">\r\n            <iframe width=\"640\" height=\"360\" src=\"http://www.youtube.com/embed/yEqDOBZ7DK8\" frameborder=\"0\" allowfullscreen></iframe>\r\n          </div>\r\n          <div class=\"col-md-5\">\r\n            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam imperdiet neque velit, in lobortis massa accumsan in. Sed sollicitudin felis urna. Proin sollicitudin lacus sit amet nunc pulvinar tempor. Aliquam libero sem, volutpat nec nisl fermentum, imperdiet sodales dui. Integer ligula nulla, lacinia vitae mollis nec, tincidunt ac leo. Suspendisse viverra luctus dui ut accumsan. Aliquam sit amet consectetur diam. Proin adipiscing nisi quis quam tempor, ut commodo magna volutpat. Praesent ante lorem, commodo sed neque quis, porta vulputate enim. Mauris dictum risus ut turpis fringilla egestas.</p>\r\n            <p>Quisque at fringilla justo, nec placerat ante. Quisque posuere nisi tellus, a iaculis sem vestibulum sit amet. Pellentesque posuere hendrerit nunc vitae sodales. Vivamus nisi mi, feugiat et odio nec, consectetur blandit lorem. Sed dictum lectus at eros dapibus, a porta nibh adipiscing. Praesent lacinia vulputate dignissim. Nam facilisis volutpat odio, a molestie erat pulvinar vitae.</p>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    \r\n    <div id=\"sg-party\" class=\"container\">\r\n      <div class=\"page-header text-center\">\r\n        <h1>Kdy a kde bude další AS párty?</h1>\r\n      </div>\r\n      <div class=\"row\">\r\n        <div class=\"col-md-8\">\r\n          <p class=\"lead\">Zatím není známo, kdy a kde se bude konat nadcházející AsianStyle párty.<br />O případném konání této akce budeme informovat.</p>\r\n          <div class=\"text-center\"><img src=\"img/dolby.png\" /></div>\r\n        </div>\r\n        <div class=\"col-md-4\">\r\n          <div class=\"panel panel-default\">\r\n          <div class=\"panel-heading\">\r\n            <h3 class=\"panel-title\">Proběhlé akce</h3>\r\n          </div>\r\n            <div class=\"list-group\">\r\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">AsianStyle party <small class=\"sg-light\">20. duben 2013</small></a>\r\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">AsianStyle party 2 - CZHW víkend <small class=\"sg-light\">11. srpen 2013</small></a>\r\n              <a class=\"list-group-item\" href=\"#\" target=\"blank\">Narozeninová AsianStyle party <small class=\"sg-light\">7. prosinec 2013</small></a>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    \r\n    <div id=\"sg-staff\" class=\"container\">\r\n      <div class=\"page-header text-center\">\r\n        <h1>Kdo je na párty DJ?</h1>\r\n        <p class=\"lead\">Na této akci vás krmí hudbou DJ JDC</p>\r\n      </div>\r\n      <div class=\"row\">\r\n        <div class=\"col-md-4\">\r\n          <img src=\"img/dj.png\" />\r\n        </div>\r\n        <div class=\"col-md-4\">\r\n          <h3>About DJ</h3>\r\n          <p>Kdo je vlastně ten DJ JDC? Myslím, že odpově na tuto otázku neuhodnete, jelikož je to člověk, jako každý jiný. A nebo ne? Každopádně ať už je co je, hudbu prostě miluje, a už je jakéhokoli druhu. Nejraději má ovšem tu asijskou a proto se ve svém volném čase věnuje hraní asijské hudby na AsianStyle párty. Pokud se někdy přijdete podívat, ať už ze zvědavosti, nebo si jen tak zatancovat, zajisté usyšíte K-POP, C-POP, J-POP, Thai-Pop a další asijské žánry a styly.</p>\r\n        </div>\r\n        <div class=\"col-md-4\">\r\n          <h3>Správci playlistu</h3>\r\n          <ul>\r\n            <li><strong>JDC</strong> <small>DJ, Admin</small></li>\r\n            <li><strong>Syrinox</strong> <small>Asistentka</small></li>\r\n          </ul>\r\n        </div>\r\n      </div>\r\n      <div id=\"sg-social\" class=\"text-center\">\r\n        <a href=\"https://www.facebook.com/officialJDC\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/facebook-icon.png\" alt=\"\" /></a>\r\n        <a href=\"http://www.twitter.com/JarDacan\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/twitter-icon.png\" alt=\"\" /></a>\r\n        <a href=\"https://plus.google.com/u/0/+JaroslavJDCVojt&iacute;&scaron;ek\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/google-plus-icon.png\" alt=\"\" /></a>\r\n        <a href=\"http://www.youtube.com/user/cunoryp\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/youtube-icon.png\" alt=\"\" /></a>\r\n      </div>\r\n    </div>\r\n    \r\n    <div id=\"sg-contact\" class=\"container\">\r\n      <div class=\"page-header text-center\">\r\n        <h1>Kontaktujte nás</h1>\r\n        <p class=\"lead\">Sdělte nám své dotazy, názory, připomínky</p>\r\n      </div>\r\n      <div class=\"row\">\r\n        <div class=\"col-md-6\">\r\n          <form role=\"form\">\r\n            <h3>Zanechte vzkaz</h3>\r\n            <p>Než nám zanecháte vzkaz, přečtěte si <a href=\"#\">Často kladené dotazy.</a></p>\r\n            <div class=\"form-group\">\r\n              <div class=\"input-group\">\r\n                <span class=\"input-group-addon\">@</span>\r\n                <input name=\"email\" type=\"text\" class=\"form-control\" placeholder=\"Váš e-mail\">\r\n              </div>\r\n            </div>\r\n            <div class=\"form-group\">\r\n              <div class=\"input-group\">\r\n                <span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-envelope\"></i></span>\r\n                <input name=\"subject\" type=\"text\" class=\"form-control\" placeholder=\"Zadejte předmět zprávy\">\r\n              </div>\r\n            </div>\r\n            <div class=\"form-group\">\r\n              <textarea name=\"text\" type=\"text\" class=\"form-control\" placeholder=\"Napište zprávu\"></textarea>\r\n            </div>\r\n            <input type=\"submit\" class=\"btn btn-default\" value=\"Odeslat\">\r\n          </form>\r\n        </div>\r\n      </div>\r\n    </div>',	'',	1),
(2,	'rules',	'Pravidla přidávání songů',	'dfgsdfgsdfgsdfg',	'',	0);

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
  PRIMARY KEY (`id`),
  KEY `interpret_id` (`interpret_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `interpret_ibfk_1` FOREIGN KEY (`interpret_id`) REFERENCES `interpret` (`id`) ON DELETE SET NULL,
  CONSTRAINT `interpret_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `interpret` (`id`, `nazev`, `desc`, `interpret_id`, `valid`, `picture`, `user_id`, `pridal`) VALUES
(1,	'2NE1',	'2NE1,21',	NULL,	0,	'',	NULL,	''),
(2,	'21',	'2NE1 alias',	1,	0,	'',	NULL,	''),
(3,	'BIGBANG',	'',	NULL,	0,	'',	NULL,	''),
(4,	'2PM',	'',	NULL,	0,	'',	NULL,	''),
(5,	'Girls\' Generation',	'',	NULL,	0,	'',	NULL,	''),
(6,	'SNSD',	'',	5,	0,	'',	NULL,	''),
(7,	'Miss A',	'',	NULL,	0,	'',	NULL,	''),
(8,	'EvoL',	'',	NULL,	0,	'',	NULL,	''),
(9,	'Super Junior',	'',	NULL,	0,	'',	NULL,	''),
(10,	'f(x)',	'',	NULL,	0,	'',	NULL,	''),
(11,	'G-Dragon',	'',	NULL,	0,	'',	NULL,	''),
(12,	'GD',	'',	11,	0,	'',	NULL,	''),
(13,	'CL',	'',	NULL,	0,	'',	NULL,	''),
(14,	'Sistar',	'',	NULL,	0,	'',	NULL,	'');

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `who` varchar(255) NOT NULL,
  `resource` text,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `log` (`id`, `media`, `event`, `user_id`, `who`, `resource`, `datum`) VALUES
(1,	'logger',	'test',	1,	'JarDacan',	NULL,	'2014-03-19 13:29:40'),
(2,	'logger',	'test',	1,	'JDC',	'BasePresenter',	'2014-03-19 13:31:21'),
(3,	'logger',	'test',	1,	'JDC',	'2',	'2014-03-19 13:32:06'),
(4,	'logger',	'test',	1,	'JDC',	'2',	'2014-03-19 13:33:09'),
(5,	'logger',	'test',	1,	'JDC',	'2',	'2014-03-19 13:33:22'),
(6,	'logger',	'test',	NULL,	'JDC',	'2',	'2014-03-19 13:33:23'),
(7,	'logger',	'test',	NULL,	'ANONYMOUS',	NULL,	'2014-03-19 13:33:44'),
(8,	'logger',	'test',	NULL,	'GUEST',	NULL,	'2014-03-19 13:36:13'),
(9,	'logger',	'test',	NULL,	'GUEST',	NULL,	'2014-03-19 13:36:17'),
(10,	'logger',	'test',	1,	'JarDacan',	NULL,	'2014-03-19 13:36:19'),
(11,	'logger',	'system_log',	NULL,	'SYSTEM',	NULL,	'2014-03-19 13:41:07'),
(12,	'song',	'reject',	1,	'JarDacan',	'{\"id\":\"12\",\"reason\":\"Není taneční song\"}',	'2014-03-19 14:03:08'),
(13,	'song',	'approve',	1,	'JarDacan',	'{\"id\":\"17\"}',	'2014-03-19 14:13:08'),
(14,	'auth',	'logout',	NULL,	'GUEST',	NULL,	'2014-03-19 14:32:21'),
(15,	'auth',	'login',	1,	'JarDacan',	'{\"service\":\"twitter\"}',	'2014-03-19 14:32:28'),
(16,	'auth',	'logout',	1,	'JarDacan',	NULL,	'2014-03-19 14:33:49'),
(17,	'auth',	'login',	1,	'JarDacan',	'{\"service\":\"twitter\"}',	'2014-03-19 14:34:10'),
(18,	'song',	'add',	1,	'JarDacan',	'{\"id\":23,\"vzkaz\":\"2NE1 <3\"}',	'2014-03-19 14:49:09'),
(19,	'song',	'add',	1,	'JarDacan',	'{\"id\":24,\"interpret\":\"BIGBANG\",\"song\":\"Beautiful Hangover\",\"vzkaz\":\"twertwert\"}',	'2014-03-19 14:53:33'),
(20,	'auth',	'logout',	1,	'JarDacan',	NULL,	'2014-03-19 14:54:32'),
(21,	'song',	'add',	NULL,	'Lolek',	'{\"id\":25,\"interpret\":\"EvoL\",\"song\":\"We are a bit different\",\"vzkaz\":\"\"}',	'2014-03-19 14:56:23'),
(22,	'auth',	'login',	1,	'JarDacan',	'{\"service\":\"twitter\"}',	'2014-03-19 14:57:58'),
(23,	'auth',	'logout',	1,	'JarDacan',	NULL,	'2014-03-19 14:59:33'),
(24,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 14:59:41'),
(25,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 15:11:01'),
(26,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 15:11:07'),
(27,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 15:12:01'),
(28,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 15:12:19'),
(29,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 15:41:08'),
(30,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 15:41:15'),
(31,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 15:42:16'),
(32,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 15:42:22'),
(33,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 15:44:10'),
(34,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 15:44:16'),
(35,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 15:45:12'),
(36,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 15:45:19'),
(37,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 15:52:59'),
(38,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 15:53:06'),
(39,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 16:13:12'),
(40,	'auth',	'login',	NULL,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 16:13:18'),
(41,	'auth',	'logout',	NULL,	'JDC',	NULL,	'2014-03-19 16:15:42'),
(42,	'auth',	'login',	NULL,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 16:15:49'),
(43,	'auth',	'logout',	NULL,	'JDC',	NULL,	'2014-03-19 16:17:00'),
(44,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 16:17:07'),
(45,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 16:35:36'),
(46,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 16:37:43'),
(47,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 16:40:38'),
(48,	'auth',	'logout',	NULL,	'GUEST',	NULL,	'2014-03-19 16:40:58'),
(49,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 16:48:57'),
(50,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 17:37:59'),
(51,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 17:38:48'),
(52,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 17:48:39'),
(53,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 17:48:45'),
(54,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 17:55:19'),
(55,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 17:55:25'),
(56,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 18:17:43'),
(57,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 18:17:49'),
(58,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-19 18:42:51'),
(59,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-19 18:42:59'),
(60,	'song',	'approve',	1,	'JDC',	'{\"id\":\"22\"}',	'2014-03-19 19:04:23'),
(61,	'song',	'approve',	1,	'JDC',	'{\"id\":\"21\"}',	'2014-03-20 11:24:42'),
(62,	'song',	'add',	1,	'JDC',	'{\"id\":26,\"interpret\":\"GD&TOP\",\"song\":\"High High\",\"vzkaz\":\"\"}',	'2014-03-20 11:25:58'),
(63,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-20 12:04:59'),
(64,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-20 12:06:09'),
(65,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-20 12:06:42'),
(66,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-20 12:06:48'),
(67,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-20 12:07:41'),
(68,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-20 12:07:46'),
(69,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-03-20 12:09:51'),
(70,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-03-20 12:09:57'),
(71,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-05 12:34:39'),
(72,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-05 12:57:28'),
(73,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-05 12:57:32'),
(74,	'song',	'add',	1,	'JDC',	'{\"id\":27,\"interpret\":\"safsdf\",\"song\":\"\",\"vzkaz\":\"\"}',	'2014-04-05 16:18:39'),
(75,	'song',	'add',	1,	'JDC',	'{\"id\":28,\"interpret\":\"2NE1\",\"song\":\"Happy\",\"vzkaz\":\"\"}',	'2014-04-06 22:21:17'),
(76,	'song',	'add',	1,	'JDC',	'{\"id\":29,\"interpret\":\"BIGBANG\",\"song\":\"Oh my friend\",\"vzkaz\":\"\"}',	'2014-04-06 22:21:47'),
(77,	'song',	'add',	1,	'JDC',	'{\"id\":30,\"interpret\":\"sfsf\",\"song\":\"saasfsadf\",\"vzkaz\":\"Lol tajnej vzkaz\"}',	'2014-04-09 23:57:45'),
(78,	'song',	'add',	1,	'JDC',	'{\"id\":31,\"interpret\":\"ddgf\",\"song\":\"dsgfsdf\",\"vzkaz\":\"veřejný\"}',	'2014-04-09 23:59:16'),
(79,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-11 18:44:46'),
(80,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-11 18:44:55'),
(81,	'song',	'add',	NULL,	'lolokol',	'{\"id\":32,\"interpret\":\"test\",\"song\":\"tst\",\"vzkaz\":\"ffgdfgv cxvb dgfdg dgf \"}',	'2014-04-11 21:10:02'),
(82,	'song',	'add',	1,	'JDC',	'{\"id\":33,\"interpret\":\"ssdf\",\"song\":\"sfsfcx\",\"vzkaz\":\"xcvxcvxcv\"}',	'2014-04-11 21:23:58'),
(83,	'song',	'approve',	1,	'JDC',	'{\"id\":\"33\",\"name\":null,\"interpret\":null}',	'2014-04-11 22:20:03'),
(84,	'song',	'approve',	1,	'JDC',	'{\"id\":\"33\",\"name\":\"sfsfcx\",\"interpret\":\"ssdf\"}',	'2014-04-11 22:24:41'),
(85,	'song',	'reject',	1,	'JDC',	'{\"id\":\"32\",\"reason\":\"Není k dispozici v požadované kvalitě\",\"name\":\"tst\",\"interpret\":\"test\"}',	'2014-04-11 22:45:51'),
(86,	'song',	'add',	1,	'JDC',	'{\"id\":34,\"interpret\":\"adasd\",\"song\":\"asdasd\",\"vzkaz\":\"\"}',	'2014-04-12 09:53:42'),
(87,	'song',	'add',	1,	'JDC',	'{\"id\":35,\"interpret\":\"asasd\",\"song\":\"aasas\",\"vzkaz\":\"sadasd\"}',	'2014-04-12 09:58:28'),
(88,	'song',	'add',	1,	'JDC',	'{\"id\":36,\"interpret\":\"sdsdds\",\"song\":\"sdsdsdsd\",\"vzkaz\":\"\"}',	'2014-04-12 10:02:40'),
(89,	'song',	'add',	NULL,	'lolk',	'{\"id\":37,\"interpret\":\"2NE1\",\"song\":\"asdasd\",\"vzkaz\":\"\"}',	'2014-04-12 10:03:46'),
(90,	'song',	'add',	1,	'JDC',	'{\"id\":38,\"interpret\":\"wfwfwfwf\",\"song\":\"wfefef\",\"vzkaz\":\"wefwefefef\"}',	'2014-04-12 10:05:15'),
(91,	'song',	'add',	1,	'JDC',	'{\"id\":39,\"interpret\":\"2NE1\",\"song\":\"Scream\",\"vzkaz\":\"tohle je tajnej vzkaz\"}',	'2014-04-13 02:55:20'),
(92,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-13 02:59:46'),
(93,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-13 02:59:54'),
(94,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-13 19:52:12'),
(95,	'auth',	'login',	3,	'test',	'{\"service\":\"songator\"}',	'2014-04-13 22:00:44'),
(96,	'song',	'add',	3,	'test',	'{\"id\":40,\"interpret\":\"ddfgdfg\",\"song\":\"sdfsdfgdgf\",\"vzkaz\":\"sdfgsdgf cvvcvbcvb\"}',	'2014-04-13 22:13:55'),
(97,	'auth',	'logout',	3,	'test',	NULL,	'2014-04-13 22:20:59'),
(98,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-13 22:21:06'),
(99,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-13 22:25:09'),
(100,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-13 22:32:11'),
(101,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-13 22:44:04'),
(102,	'auth',	'login',	3,	'test',	'{\"service\":\"songator\"}',	'2014-04-13 22:44:11'),
(103,	'auth',	'logout',	3,	'test',	NULL,	'2014-04-13 22:44:13'),
(104,	'auth',	'login',	3,	'test',	'{\"service\":\"songator\"}',	'2014-04-13 22:44:34'),
(105,	'auth',	'logout',	3,	'test',	NULL,	'2014-04-13 22:44:37'),
(106,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-13 22:45:48'),
(107,	'song',	'add',	1,	'JDC',	'{\"id\":41,\"interpret\":\"gsdgsdgf\",\"song\":\"dgfsdfgsdfg\",\"vzkaz\":\"sdfgsdgf\"}',	'2014-04-13 23:17:14'),
(108,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-13 23:19:42'),
(109,	'auth',	'login',	3,	'test',	'{\"service\":\"songator\"}',	'2014-04-13 23:19:52'),
(110,	'auth',	'logout',	3,	'test',	NULL,	'2014-04-13 23:29:12'),
(111,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-13 23:29:17'),
(112,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-04-14 00:22:08'),
(113,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-04-14 00:22:16'),
(114,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-06-09 21:11:44'),
(115,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-06-11 21:59:30'),
(116,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-06-11 22:00:11'),
(117,	'song',	'add',	1,	'JDC',	'{\"id\":42,\"interpret\":\"2NE1\",\"song\":\"do you love me\",\"vzkaz\":\"\"}',	'2014-06-14 11:02:57'),
(118,	'song',	'add',	1,	'JDC',	'{\"id\":43,\"interpret\":\"pokus\",\"song\":\"lolok\",\"vzkaz\":\"\"}',	'2014-06-14 11:39:32'),
(119,	'song',	'approve',	1,	'JDC',	'{\"id\":\"23\",\"name\":\"Gotta be you\",\"interpret\":\"2NE1\"}',	'2014-06-14 14:56:16'),
(120,	'song',	'approve',	1,	'JDC',	'{\"id\":\"1\",\"name\":\"Pokus\",\"interpret\":\"Pokusník\"}',	'2014-06-14 15:08:09'),
(121,	'song',	'approve',	1,	'JDC',	'{\"id\":\"1\",\"name\":\"Pokus\",\"interpret\":\"Pokusník\"}',	'2014-06-14 15:15:10'),
(122,	'song',	'approve',	1,	'JDC',	'{\"id\":\"34\",\"name\":\"asdasd\",\"interpret\":\"adasd\"}',	'2014-06-14 15:16:44'),
(123,	'song',	'approve',	1,	'JDC',	'{\"id\":\"19\",\"name\":\"I love you\",\"interpret\":\"2NE1\"}',	'2014-06-14 15:16:57'),
(124,	'song',	'approve',	1,	'JDC',	'{\"id\":\"23\",\"name\":\"Gotta be you\",\"interpret\":\"2NE1\"}',	'2014-06-14 15:17:47'),
(125,	'song',	'approve',	1,	'JDC',	'{\"id\":\"9\",\"name\":\"zutzu\",\"interpret\":\"21\"}',	'2014-06-14 15:18:51'),
(126,	'song',	'reject',	1,	'JDC',	'{\"id\":\"6\",\"reason\":\"Není taneční song\",\"name\":\"xcvyxcvxyc\",\"interpret\":\"sdfsdf\"}',	'2014-06-14 15:21:25'),
(127,	'song',	'approve',	1,	'JDC',	'{\"id\":\"36\",\"name\":\"sdsdsdsd\",\"interpret\":\"sdsdds\"}',	'2014-06-14 15:22:12'),
(128,	'song',	'reject',	1,	'JDC',	'{\"id\":\"35\",\"reason\":\"Není k dispozici v požadované kvalitě\",\"name\":\"aasas\",\"interpret\":\"asasd\"}',	'2014-06-14 15:22:38'),
(129,	'song',	'approve',	1,	'JDC',	'{\"id\":\"37\",\"name\":\"asdasd\",\"interpret\":\"2NE1\"}',	'2014-06-14 15:23:19'),
(130,	'song',	'approve',	1,	'JDC',	'{\"id\":\"37\",\"name\":\"asdasd\",\"interpret\":\"2NE1\"}',	'2014-06-14 15:23:25'),
(131,	'song',	'approve',	1,	'JDC',	'{\"id\":\"38\",\"name\":\"wfefef\",\"interpret\":\"wfwfwfwf\"}',	'2014-06-14 15:23:34'),
(132,	'song',	'reject',	1,	'JDC',	'{\"id\":\"26\",\"reason\":\"Není taneční song\",\"name\":\"High High\",\"interpret\":\"GD&TOP\"}',	'2014-06-14 15:25:46'),
(133,	'song',	'reject',	1,	'JDC',	'{\"id\":\"42\",\"reason\":\"Zamítnut managementem AsianStyle.cz\",\"name\":\"do you love me\",\"interpret\":\"2NE1\"}',	'2014-06-14 15:30:05'),
(134,	'song',	'add',	1,	'JDC',	'{\"id\":44,\"interpret\":\"2PM\",\"song\":\"Hands up\",\"vzkaz\":\"\"}',	'2014-06-14 23:42:27'),
(135,	'song',	'add',	NULL,	'test',	'{\"id\":45,\"interpret\":\"2NE1\",\"song\":\"lljjk\",\"vzkaz\":\"\"}',	'2014-06-15 23:25:15'),
(136,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-06-15 23:28:51'),
(137,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-06-15 23:32:11'),
(138,	'song',	'add',	1,	'JDC',	'{\"id\":46,\"interpret\":\"2NE1\",\"song\":\"I am the best\",\"vzkaz\":\"\"}',	'2014-06-22 16:10:30'),
(139,	'song',	'add',	1,	'JDC',	'{\"id\":47,\"interpret\":\"2NE1\",\"song\":\"hate you\",\"vzkaz\":\"\"}',	'2014-06-22 16:15:09'),
(140,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-07-18 19:40:53'),
(141,	'song',	'approve',	1,	'JDC',	'{\"id\":\"45\",\"name\":\"lljjk\",\"interpret\":\"2NE1\"}',	'2014-07-18 20:09:21'),
(142,	'song',	'reject',	1,	'JDC',	'{\"id\":\"43\",\"reason\":\"Test\",\"name\":\"lolok\",\"interpret\":\"pokus\"}',	'2014-07-18 20:09:37'),
(143,	'song',	'add',	1,	'JDC',	'{\"id\":48,\"interpret\":\"Brown Eyed Girls\",\"song\":\"Kill Bill\",\"vzkaz\":\"\"}',	'2014-07-18 21:21:08'),
(144,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-07-20 10:28:30'),
(145,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-07-23 22:06:25'),
(146,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-07-23 22:12:43'),
(147,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-07-23 22:14:50'),
(148,	'auth',	'logout',	1,	'JDC',	NULL,	'2014-07-23 22:15:20'),
(149,	'auth',	'login',	4,	'test2',	'{\"service\":\"songator\"}',	'2014-07-23 22:19:01'),
(150,	'song',	'add',	4,	'test2',	'{\"id\":49,\"interpret\":\"test\",\"song\":\"test\",\"vzkaz\":\"\"}',	'2014-07-23 22:22:15'),
(151,	'auth',	'logout',	4,	'test2',	NULL,	'2014-07-23 22:23:53'),
(152,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-07-23 22:23:58'),
(153,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-07-29 23:07:38'),
(154,	'song',	'approve',	1,	'JDC',	'{\"id\":\"49\",\"name\":\"test\",\"interpret\":\"test\"}',	'2014-07-29 23:38:23'),
(155,	'auth',	'login',	1,	'JDC',	'{\"service\":\"twitter\"}',	'2014-08-16 19:09:58'),
(156,	'song',	'add',	1,	'JDC',	'{\"id\":50,\"interpret\":\"2NE1\",\"song\":\"Be mine\",\"vzkaz\":\"2NE1 Be mine\"}',	'2014-08-17 10:48:38'),
(157,	'song',	'approve',	1,	'JDC',	'{\"id\":\"21\",\"name\":\"Crush\",\"interpret\":\"2NE1\"}',	'2014-08-17 11:41:32'),
(158,	'song',	'reject',	1,	'JDC',	'{\"id\":\"47\",\"reason\":\"Duplicita\",\"name\":\"hate you\",\"interpret\":\"2NE1\"}',	'2014-09-03 10:08:34'),
(159,	'song',	'reject',	1,	'JDC',	'{\"id\":\"47\",\"reason\":\"Duplicita\",\"name\":\"hate you\",\"interpret\":\"2NE1\"}',	'2014-09-03 10:13:37');

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
(1,	'test',	'testovníddd'),
(2,	'test2',	'pokus druhý'),
(3,	'page_rules',	'rules'),
(4,	'page_home',	'home'),
(5,	'songator_wip',	'0'),
(6,	'songator_status',	'enabled'),
(7,	'songator_msg',	'Přidávání songů bylo uzavřeno. Všem děkujeme za spolupráci.'),
(8,	'songlist_reguser_add',	'0'),
(9,	'ucp_allow_register',	'1'),
(10,	'ucp_twitter_login',	'1'),
(11,	'songlist_mode',	'open'),
(12,	'songlist_allowed_players',	'youtube.com;soundcloud.com;dailymotion.com');

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
  `reason_code` varchar(32) NOT NULL COMMENT 'R10_GENERAL, R20_DUPLICITY, R21_QUALITY, R22_UNACCEPTABLE, R30_ILEGAL, R31_RULES, R40_INVALID, R99_UNKNOWN',
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
(1,	'Pokus',	'Pokusník',	NULL,	'approved',	1,	NULL,	'anonymous',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-17 16:54:54',	'',	0,	''),
(2,	'dgdgf',	'cvbxcvb',	NULL,	'approved',	2,	NULL,	'me',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-17 16:58:04',	'lorem ipsum...',	0,	''),
(3,	'Do you love me',	'2NE1',	1,	'approved',	1,	NULL,	'JDC',	'',	'2NE1 <3',	1,	0,	0,	0,	'0',	1,	'2014-02-19 12:07:45',	'I love 2NE1 <3',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/92137737.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/92137737.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/92137737.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/92137737.png\",\"size\":\"extralarge\"}]'),
(5,	'stsddg',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-20 18:49:48',	'',	0,	''),
(6,	'xcvyxcvxyc',	'sdfsdf',	NULL,	'rejected',	2,	1,	'JarDacan',	'',	'Není taneční song',	0,	0,	0,	0,	'0',	1,	'2014-02-20 18:56:31',	'',	0,	''),
(7,	'xcvyxcvxyc',	'sdfsdf',	NULL,	'rejected',	2,	1,	'JarDacan',	'',	'Nehodí se na párty',	0,	0,	0,	0,	'0',	1,	'2014-02-20 18:57:22',	'',	0,	''),
(8,	'rttz',	'ttt',	NULL,	'rejected',	2,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-02-20 19:02:49',	'',	0,	''),
(9,	'zutzu',	'21',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-20 19:04:06',	'',	0,	''),
(11,	'xxb',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-20 19:07:39',	'',	0,	''),
(12,	'dfgdfg',	'dfgdf',	NULL,	'rejected',	1,	1,	'JarDacan',	'',	'Není taneční song',	0,	0,	1,	0,	'0',	1,	'2014-02-20 23:53:33',	'',	0,	''),
(13,	'Ugly',	'2NE1',	NULL,	'approved',	1,	1,	'JarDacan',	'',	'I love 2NE1',	1,	1,	0,	0,	'0',	1,	'2014-02-21 13:24:20',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91321991.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91321991.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91321991.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91321991.png\",\"size\":\"extralarge\"}]'),
(14,	'Lonely',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'jkhkjhk',	0,	1,	0,	0,	'0',	1,	'2014-02-21 13:25:27',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91321991.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91321991.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91321991.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91321991.png\",\"size\":\"extralarge\"}]'),
(15,	'Can\'t nobody',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-23 12:38:09',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/98580719.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/98580719.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/98580719.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/98580719.png\",\"size\":\"extralarge\"}]'),
(16,	'Fantastic baby',	'BIGBANG',	3,	'approved',	1,	NULL,	'JDC',	'',	'',	1,	0,	0,	0,	'0',	1,	'2014-02-23 12:40:29',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/74978658.jpg\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/74978658.jpg\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/74978658.jpg\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/74978658.jpg\",\"size\":\"extralarge\"}]'),
(17,	'Mr. Mr',	'Girls\' Generation',	5,	'approved',	1,	1,	'JarDacan',	'http://www.youtube.com/watch?v=Qq1TaTGrAIQ',	'SNSD <3',	0,	0,	0,	0,	'0',	1,	'2014-02-24 22:49:27',	'',	0,	'null'),
(18,	'Falling in love',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'https://soundcloud.com/vipbjshow/2ne1-falling-in-love',	'2NE1 4ever <3',	1,	0,	0,	0,	'0',	1,	'2014-02-25 16:56:18',	'sdbdsgf dfg dfg sdg dg dgsd g cvxyjcvh xuicvy xicv uvyxuichvxui xyýváxyýcva asudfa sudf',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91317337.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91317337.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91317337.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91317337.png\",\"size\":\"extralarge\"}]'),
(19,	'I love you',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'http://www.dailymotion.com/video/xs0yef_2ne1-i-love-you-sub-espanol-hangul-romanizacion_music',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-28 13:43:24',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/79706415.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/79706415.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/79706415.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/79706415.png\",\"size\":\"extralarge\"}]'),
(20,	'I Got a Boy',	'Girls\' Generation',	5,	'approved',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-02-28 20:24:34',	'test asasdfasdf asdf asdf asdfasdf',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/85611815.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/85611815.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/85611815.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/85611815.png\",\"size\":\"extralarge\"}]'),
(21,	'Crush',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'http://www.youtube.com/watch?v=OODTt2kahI0',	'',	1,	0,	0,	0,	'0',	1,	'2014-03-10 12:36:48',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(22,	'Come Back Home',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'http://www.youtube.com/watch?v=vLbfv-AAyvQ',	'',	0,	0,	0,	0,	'0',	1,	'2014-03-10 12:44:33',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(23,	'Gotta be you',	'2NE1',	1,	'approved',	1,	1,	'JarDacan',	'https://www.youtube.com/watch?v=pbQP9Q2tNoU',	'',	0,	0,	0,	0,	'0',	1,	'2014-03-19 14:49:09',	'2NE1 <3',	1,	'null'),
(24,	'Beautiful Hangover',	'BIGBANG',	3,	'waiting',	1,	1,	'JarDacan',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-03-19 14:53:33',	'twertwert',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/50585459.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/50585459.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/50585459.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/50585459.png\",\"size\":\"extralarge\"}]'),
(25,	'We are a bit different',	'EvoL',	8,	'waiting',	1,	NULL,	'Lolek',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-03-19 14:56:23',	'',	0,	'null'),
(26,	'High High',	'GD&TOP',	NULL,	'rejected',	1,	1,	'JDC',	'',	'Není taneční song',	0,	0,	0,	0,	'0',	1,	'2014-03-20 11:25:58',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/72210402.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/72210402.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/72210402.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/72210402.png\",\"size\":\"extralarge\"}]'),
(28,	'Happy',	'2NE1',	1,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-06 22:21:17',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(29,	'Oh my friend',	'BIGBANG',	3,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-06 22:21:47',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/81637739.jpg\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/81637739.jpg\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/81637739.jpg\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/81637739.jpg\",\"size\":\"extralarge\"}]'),
(30,	'saasfsadf',	'sfsf',	NULL,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-09 23:57:45',	'Lol tajnej vzkaz',	1,	''),
(31,	'dsgfsdf',	'ddgf',	NULL,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-09 23:59:16',	'veřejný',	0,	''),
(32,	'tst',	'test',	NULL,	'rejected',	3,	NULL,	'lolokol',	'',	'Není k dispozici v požadované kvalitě',	0,	0,	0,	0,	'0',	1,	'2014-04-11 21:10:02',	'ffgdfgv cxvb dgfdg dgf ',	0,	'null'),
(33,	'sfsfcx',	'ssdf',	NULL,	'approved',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-11 21:23:58',	'xcvxcvxcv',	1,	''),
(34,	'asdasd',	'adasd',	NULL,	'approved',	2,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 09:53:42',	'',	0,	'null'),
(35,	'aasas',	'asasd',	NULL,	'rejected',	2,	1,	'JDC',	'',	'Není k dispozici v požadované kvalitě',	0,	0,	0,	0,	'0',	1,	'2014-04-12 09:58:28',	'sadasd',	0,	''),
(36,	'sdsdsdsd',	'sdsdds',	NULL,	'approved',	4,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 10:02:40',	'',	0,	''),
(37,	'asdasd',	'2NE1',	1,	'approved',	3,	NULL,	'lolk',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 10:03:46',	'',	0,	''),
(38,	'wfefef',	'wfwfwfwf',	NULL,	'approved',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-04-12 10:05:15',	'wefwefefef',	0,	''),
(39,	'Scream',	'2NE1',	1,	'waiting',	2,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-13 02:55:20',	'tohle je tajnej vzkaz',	1,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/99287009.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/99287009.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/99287009.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/99287009.png\",\"size\":\"extralarge\"}]'),
(40,	'sdfsdfgdgf',	'ddfgdfg',	NULL,	'waiting',	1,	3,	'test',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-13 22:13:55',	'sdfgsdgf cvvcvbcvb',	1,	''),
(41,	'dgfsdfgsdfg',	'gsdgsdgf',	NULL,	'waiting',	3,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-04-13 23:17:14',	'sdfgsdgf',	0,	''),
(42,	'do you love me',	'2NE1',	1,	'rejected',	2,	1,	'JDC',	'',	'Zamítnut managementem AsianStyle.cz',	0,	0,	0,	0,	'0',	1,	'2014-06-14 11:02:57',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/92137737.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/92137737.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/92137737.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/92137737.png\",\"size\":\"extralarge\"}]'),
(43,	'lolok',	'pokus',	NULL,	'rejected',	1,	1,	'JDC',	'',	'Test',	0,	0,	0,	0,	'0',	1,	'2014-06-14 11:39:32',	'',	0,	''),
(44,	'Hands up',	'2PM',	4,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-06-14 23:42:27',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/75480240.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/75480240.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/75480240.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/75480240.png\",\"size\":\"extralarge\"}]'),
(45,	'lljjk',	'2NE1',	1,	'approved',	1,	NULL,	'test',	'',	'',	0,	0,	0,	0,	'0',	1,	'2014-06-15 23:25:15',	'',	0,	''),
(46,	'I am the best',	'2NE1',	1,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-06-22 16:10:29',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/78068228.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/78068228.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/78068228.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/78068228.png\",\"size\":\"extralarge\"}]'),
(47,	'hate you',	'2NE1',	1,	'rejected',	1,	1,	'JDC',	'',	'Duplicita',	0,	0,	0,	0,	'R20_DUPLICITY',	1,	'2014-06-22 16:15:09',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91321991.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91321991.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91321991.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91321991.png\",\"size\":\"extralarge\"}]'),
(48,	'Kill Bill',	'Brown Eyed Girls',	NULL,	'waiting',	1,	1,	'JDC',	'',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-07-18 21:21:08',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/91890905.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/91890905.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/91890905.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/91890905.png\",\"size\":\"extralarge\"}]'),
(49,	'test',	'test',	NULL,	'approved',	2,	4,	'test2',	'',	'',	0,	0,	1,	1,	'0',	1,	'2014-07-23 22:22:15',	'',	0,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/53193637.jpg\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/53193637.jpg\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/53193637.jpg\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/53193637.jpg\",\"size\":\"extralarge\"}]'),
(50,	'Be mine',	'2NE1',	1,	'waiting',	1,	1,	'JDC',	'http://www.youtube.com/watch?v=vZtd_m3VDJI',	'',	0,	0,	0,	0,	'0',	NULL,	'2014-08-17 10:48:37',	'2NE1 Be mine',	1,	'[{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/64s\\/78477882.png\",\"size\":\"small\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/126\\/78477882.png\",\"size\":\"medium\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/174s\\/78477882.png\",\"size\":\"large\"},{\"#text\":\"http:\\/\\/userserve-ak.last.fm\\/serve\\/300x300\\/78477882.png\",\"size\":\"extralarge\"}]');

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
(3,	28,	1,	'2014-06-14 09:53:36'),
(4,	29,	1,	'2014-06-14 09:56:45'),
(5,	25,	1,	'2014-06-14 10:22:51'),
(6,	22,	1,	'2014-06-14 10:25:19'),
(7,	37,	1,	'2014-06-14 14:32:59'),
(8,	22,	1,	'2014-06-15 21:18:51'),
(9,	21,	1,	'2014-06-15 22:00:58'),
(10,	18,	1,	'2014-06-15 22:01:27'),
(11,	47,	1,	'2014-07-18 20:09:56'),
(12,	49,	4,	'2014-07-23 22:22:57'),
(13,	48,	1,	'2014-07-26 16:56:40'),
(14,	21,	1,	'2014-08-17 11:40:26');

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
(1,	'JDC',	'',	'',	'admin',	'2014-02-18 12:15:07',	'',	'twitter',	'364921955',	0,	'JDC (이지민)',	'Producer, Song writer, DJ, Programmer, Author, Editor, Amatuer writer, Lyrics writer and Blogger in JDC Entertainment.',	'http://pbs.twimg.com/profile_images/2548714957/zxmzvsd9so5cjvkco9eq_normal.jpeg',	'JarDacan',	'http://www.jdc.2ne1.cz'),
(3,	'test',	'$2y$10$v9d592UJJ/uw9Ijb/Qb6xuOuKYk2AJ5.WKlffEI3kFv3YzRx7fLWW',	'test@test.localhost',	'user',	'2014-04-13 22:00:34',	'',	'songator',	'',	0,	'Testovací účet',	'',	'',	'',	''),
(4,	'test2',	'$2y$10$9BRwmWIZmGXbHYJN734bluIr/i/rT9xnqFWS1tTIXZqFzmQBZM6xW',	'test@test.localhostt',	'user',	'2014-07-23 22:18:50',	'',	'songator',	'',	0,	'test2',	'',	'',	'',	'');

DROP TABLE IF EXISTS `zanr`;
CREATE TABLE `zanr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `popis` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `zanr` (`id`, `name`, `popis`) VALUES
(1,	'K-POP',	'Korejská populární hudba'),
(2,	'J-POP',	'Japonská populární hudba'),
(3,	'J-ROCK',	'Japonský rock'),
(4,	'C-POP',	'Čínská populární hudba');

-- 2014-09-03 10:46:19
