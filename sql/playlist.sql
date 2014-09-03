-- Adminer 4.0.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+02:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ipban`;
CREATE TABLE `ipban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(18) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `likelog`;
CREATE TABLE `likelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `songy_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `info` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `nesys`;
CREATE TABLE `nesys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(32) COLLATE utf8_bin NOT NULL,
  `value` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `nesys` (`id`, `option`, `value`) VALUES
(1,	'nesys_sitename',	'DJ JDC\'s playlist'),
(2,	'nesys_sitedesc',	'Asian Style party playlist'),
(3,	'nesys_webmaster',	'JDC Entertainment'),
(4,	'nesys_sitemail',	'jdc@2ne1.cz'),
(5,	'as_wip',	'0'),
(6,	'songator_active',	'1'),
(7,	'songator_zprava',	'Playlist bude otevřen 22.8.2014 0:00'),
(8,	'songator_zprava_show',	'0');

DROP TABLE IF EXISTS `podobne`;
CREATE TABLE `podobne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valid` varchar(127) NOT NULL,
  `aliases` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `asprofil` varchar(164) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `unsigned` tinyint(1) NOT NULL,
  PRIMARY KEY (`valid`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `valid` (`valid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `podobne` (`id`, `valid`, `aliases`, `asprofil`, `unsigned`) VALUES
(43,	'100%',	'100%,100',	'517-100',	0),
(77,	'1TYM',	'1TYM,One Time,One TYM,1TIM,1 TYM,OneTYM,OneTime',	'567-1tym',	0),
(67,	'24K',	'24K,24k,24',	'560-24k',	0),
(5,	'2NE1',	'2ne1,2NE1,21',	'278-2ne1',	0),
(32,	'2PM',	'2PM,2pm',	'371-2pm',	0),
(23,	'4Minute',	'4Minute,4minute,4 Minute,4 minute',	'431-4minute',	0),
(27,	'A Pink',	'A Pink,APink,Apink,A pink',	'590-a-pink',	0),
(79,	'Acid Black Cherry',	'Acid Black Cherry,ABC',	'',	0),
(29,	'After School',	'After School,AfterSchool,Afterschool,After school,AS',	'396-after-school',	0),
(21,	'B.A.P',	'B.A.P,B.A.P.,BAP',	'391-bap',	0),
(65,	'Baek Ji Young',	'Baek Ji Young,Baek Jiyoung',	'',	0),
(26,	'Bangtan Boys',	'Bangtan Boys,BTS,BangtanBoys',	'659-bangtan-boys',	0),
(3,	'BEAST',	'BEAST,B2ST,Beast',	'305-beast',	0),
(59,	'Big Star',	'Big Star,BIGSTAR,Bigstar,Big star,BigStar',	'528-big-star',	0),
(2,	'BIGBANG',	'Big Bang,BigBang,BIGBANG',	'245-bigbang',	0),
(30,	'Block B',	'Block B,BlockB,BLOCK B',	'446-block-b',	0),
(9,	'BoA',	'Boa,BoA,BoAh,Boah',	'357-boa',	0),
(80,	'Boyfriend',	'Boyfriend',	'367-boyfriend',	0),
(15,	'Brown Eyed Girls',	'Brown Eyed Girls,BrownEyedGirls,BEG,Brown Eyed Girlz,BrownEyedGirlz',	'657-brown-eyed-girls',	0),
(49,	'BTOB',	'BTOB,BtoB,Btob',	'388-btob',	0),
(84,	'Candy Mafia',	'',	'688-candy-mafia',	0),
(95,	'CL',	'CL,CL of 2NE1,C.L,C.L.,Lee Chae Rin,Lee ChaeRin,Lee Chae Lin,Lee ChaeLin',	'',	0),
(68,	'CNBLUE',	'CNBLUE,C.N.Blue,C.N.BLUE,C.N. Blue,C.N. BLUE,CN Blue,CNBlue,CN BLUE,CNB',	'337-cnblue',	0),
(11,	'CO-ED SCHOOL',	'CO-ED SCHOOL,CO-EDSCHOOL,COED SCHOOL,COEDSCHOOL',	'',	0),
(36,	'D-UNIT',	'D-Unit,D Unit,DUnit,D-Unite,D Unite,DUnite',	'663-d-unit',	0),
(33,	'Dal★shabet',	'Dal★shabet,Dal Shabet,DalShabet,Dalshabet,Dal shabet',	'725-dal-shabet',	0),
(78,	'DBSK',	'DBSK,TVXQ,Tohoshinki,Dong Bang Shin Ki,TWXQ,Dong Bang Shin Gi,DB5K',	'280-dbsk',	0),
(35,	'Elva Hsiao',	'Elva Hsiao,ElvaHsiao,Elva,elvashiao',	'556-elva-hsiao',	0),
(74,	'Eunhyuk & Donghae',	'Eunhyuk & Donghae,EunHae,EunHyuk & DongHae,Eunhyuk&Donghae,EunHyuk&DongHae,Eun Hyuk & Dong Hae,Eunhyuk and Donghae,Eun Hyuk and Dong Hae',	'',	0),
(86,	'Evo Nine',	'Evo9,Evo 9',	'676-evo-nine',	0),
(51,	'EvoL',	'EvoL,EVOL,Evol,Evl,Evil',	'575-evol',	0),
(71,	'EXID',	'EXID,Exid,Exit',	'574-exid',	0),
(24,	'EXO',	'Exo,Exo-k,Exo-m',	'421-exo-k',	0),
(19,	'f(x)',	'f(x),F(x),F(X),fx',	'362-fx',	0),
(28,	'F.Cuz',	'F.Cuz,F.CUZ,F.cuz,FCUZ,Fcuz',	'282-fcuz',	0),
(6,	'FTIsland',	'FTisland,FT Island,FTI,FTIsland,F.T Island,F.T.Island',	'331-ftisland',	0),
(85,	'G-20',	'G20,G-Twenty,G Twenty',	'',	0),
(8,	'G-Dragon',	'G-Dragon,GDragon,GD',	'245-bigbang',	0),
(46,	'G.NA',	'G.NA,G.na,G.Na,Gna,Gina',	'591-gna',	0),
(7,	'GD&TOP',	'GD&TOP,GD & TOP,GTOP,GD and TOP',	'245-bigbang',	0),
(58,	'Girl\'s Day',	'Girl\'s Day,Girl\'sDay,Girl\'s day,Girl\'sday,Girls\' Day,Girls\'Day,Girls\'day',	'',	0),
(1,	'Girls\' Generation',	'Girls\' Generation,SNSD,Girls Generation,Girls´Generation,Girls´ Generation,Girls\'Generation,SNSD TTS,TTS,Tae Ti Seo',	'290-girls-generation',	0),
(45,	'HIT-5',	'HIT-5,HIT5,HIT 5,hit5',	'272-hit-5',	0),
(60,	'Hyuna',	'Hyuna,Hyun A,HyunA,Hyun Ah,Hyunah,HyunAh',	'363-hyuna',	0),
(55,	'INFINITE',	'INFINITE,Infinite',	'385-infinite',	0),
(93,	'Jolin Tsai',	'Jolin',	'',	0),
(73,	'Juni.J',	'JuniJ,Juni J,junij,Jucy,Jucy from EvoL,Juni.J (Jucy from EvoL)',	'',	0),
(81,	'JYJ',	'JYJ,Jaejoong Yoochun Junsu,Jaejoong Yuchun Junsu',	'353-jyj',	0),
(41,	'Kahi',	'Kahi,Gahee,Gahi,Kahee',	'',	0),
(48,	'KARA',	'KARA,Kara',	'345-kara',	0),
(10,	'Ladies\' Code',	'LADIES\' CODE,LADIES\'CODE,Ladies code,LadiesCode',	'800-ladies-code',	0),
(54,	'LEDApple',	'LEDApple,Led Apple,LED Apple,Ledapple,LEDapple',	'243-ledapple',	0),
(44,	'Lee Hyori',	'Lee Hyori,Lee Hyo Lee,Lee Hyoli,Lee Hyolee,Lee Hyo Ri',	'',	0),
(96,	'MBLAQ',	'MBLAQ,M-BLAQ,MBLACK',	'498-mblaq',	0),
(18,	'Miss A',	'Miss A,MissA,MissA,missa,miss a',	'381-miss-a',	0),
(40,	'MR.MR',	'MR.MR,MRMR,MR MR,mrmr,mr.mr',	'634-mrmr',	0),
(62,	'MYNAME',	'MYNAME,Myname,My Name,MyName,My name',	'',	0),
(70,	'N-TRAIN',	'N-TRAIN,N-train,N-Train,Ntrain,NTRAIN',	'728-n-train',	0),
(69,	'Nine Muses',	'Nine Muses,9muses,NineMuses,9 Muses,9 muses',	'254-nine-muses',	0),
(72,	'NS Yoon-G',	'NS Yoon-G,NS Yoon Gi,NS Yoon Ji,NS Yoonji',	'',	0),
(17,	'NU\'EST',	'nu\'est,nuest,NUEST,NU\'est,nu´est,NU´EST',	'252-nuest',	0),
(12,	'Park Jung Min',	'PJM,Park Jung Min,ParkJungMin,PJM (from SS501)',	'',	0),
(61,	'PSY',	'PSY,Psy,P.S.Y,P.S.Y.',	'409-psy',	0),
(66,	'Rain',	'Rain,Bi,Bi Rain,Rain Bi',	'608-rain',	0),
(52,	'RaNia',	'RaNia,Rania,RANIA',	'261-rania',	0),
(37,	'S.O.S',	'S.O.S,SOS,S O S,sos,s.o.s',	'',	0),
(76,	'S4',	'S4,SFour,S 4,S Four',	'700-s4',	0),
(57,	'SE7EN',	'SE7EN,Se7en,Seven',	'328-se7en',	0),
(13,	'Secret',	'Secret,SECRET',	'248-secret',	0),
(20,	'Seungri',	'Seungri,Seung Ri',	'',	0),
(31,	'SHINee',	'SHINee,SHINEE',	'277-shinee',	0),
(34,	'Show Luo',	'Show Luo,ShowLuo,showluo,Show Lo',	'656-show-luo',	0),
(14,	'Sistar',	'Sistar,SISTAR',	'246-sistar',	0),
(63,	'SPICA',	'SPICA,Spica,SPCIA',	'577-spica',	0),
(50,	'SS501',	'SS501,SS 501,SS-501,ss501,501,SS',	'329-ss501',	0),
(42,	'Sunny Hill',	'Sunny Hill,SunnyHill,Sunnyhill',	'257-sunny-hill',	0),
(22,	'Super Junior',	'Super Junior,SuperJunior,Suju,SuJu',	'361-super-junior',	0),
(53,	'Super Junior M',	'Super Junior M,Super Junior-M,Suju-M,SuJu-M,SuperJuniorM',	'',	0),
(39,	'T-ara',	'T-ara,T-ARA,T-Ara',	'354-t-ara',	0),
(38,	'Taeyang',	'Taeyang,Tae Yang,Taeang',	'',	0),
(75,	'TASTY',	'TASTY,Tasty',	'356-tasty',	0),
(25,	'Teen Top',	'Teen Top,TEEN TOP,TeenTop',	'471-teen-top',	0),
(94,	'TOP',	'TOP,T.O.P,Choi Seung Hyun,Choi SeungHyun,TOP of BigBang,T.O.P.',	'',	0),
(64,	'Trouble Maker',	'Trouble Maker,Troublemaker,Trouble maker,TroubleMaker',	'',	0),
(4,	'U-KISS',	'UKISS,U-KISS,U KISS,U-Kiss,U-kiss',	'348-u-kiss',	0),
(87,	'Vanness Wu',	'',	'721-vanness-wu',	0),
(47,	'VIXX',	'VIXX,VI-XX,VI XX,vixx,vi-xx,vi xx',	'372-vixx',	0),
(83,	'Wang LeeHom',	'Wang Lee Hom,LeeHom Wang,Lee Hom Wang',	'244-wang-leehom',	0),
(88,	'Willber Pan',	'Will Pan',	'',	0),
(16,	'Wonder Girls',	'Wonder Girls,WonderGirls,WonderGirlz,Wonder Girlz,Wonder Grils',	'487-wonder-girls',	0),
(82,	'XIA',	'Xiah,Junsu,Xiah Junsu',	'',	0),
(56,	'ZE:A',	'ZE:A,Ze:a,ZEA,Children of Empire,zea,ze:a',	'303-zea',	0),
(97,	'Ailee',	'',	'',	0),
(98,	'Alphabat',	'Alfabat,Alpha bat,Alfa bat',	'',	0),
(99,	'Koda Kumi',	'Coda Cumi,Coda Kumi,Kumi Koda',	'',	0),
(100,	'Topp Dogg',	'',	'',	0),
(102,	'Shinhwa',	'Sinwa,Shinwa',	'',	0),
(103,	'B1A4',	'b1a4, B.1.A.4',	'',	0);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) COLLATE utf8_bin NOT NULL,
  `parent` varchar(64) COLLATE utf8_bin NOT NULL,
  `nazev` varchar(80) COLLATE utf8_bin NOT NULL,
  `popis` varchar(255) COLLATE utf8_bin NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`,`level`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `role` (`role`),
  KEY `level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `roles` (`id`, `role`, `parent`, `nazev`, `popis`, `level`) VALUES
(1,	'guest',	'',	'Návštěvník',	'Nepřihlášení anonymní uživatelé',	1),
(2,	'user',	'guest',	'Uživatel',	'Přihlášený a registrovaný uživatel',	100),
(3,	'bj',	'user',	'Black Jack',	'Člen 2NE1 fanklubu Black Jack',	200),
(4,	'author',	'bj',	'Redaktor',	'Redaktoři 2NE1.cz',	300),
(5,	'editor',	'author',	'Šéfredaktor',	'Šéfredaktoři 2ne1.cz',	400),
(6,	'admin',	'',	'Manažer',	'Manažer stránek 2ne1.cz (root)',	10000);

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL,
  `args` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `songy`;
CREATE TABLE `songy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interpret` varchar(128) NOT NULL,
  `song` varchar(128) NOT NULL,
  `zanr` varchar(64) NOT NULL,
  `zadatel` varchar(128) NOT NULL,
  `vzkaz` text NOT NULL,
  `status` varchar(32) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yt` varchar(300) NOT NULL,
  `instro` tinyint(1) NOT NULL,
  `pecka` tinyint(1) NOT NULL,
  `note` text NOT NULL,
  `revidedby` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `interpret` (`interpret`,`song`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `static`;
CREATE TABLE `static` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` longtext COLLATE utf8_bin NOT NULL,
  `additional` text COLLATE utf8_bin NOT NULL,
  `shortcut` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shortcut` (`shortcut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `static` (`id`, `nazev`, `content`, `additional`, `shortcut`) VALUES
(1,	'Kontakt',	'<p>Nev&iacute;te si s něč&iacute;m rady? M&aacute;te nějak&yacute; dotaz? Nebojte se mě kontaktovat.</p>\n<p><strong>E-Mail:</strong> <a href=\"mailto:jdc@2ne1.cz\">jdc@2ne1.cz</a><br /><strong>Facebook:</strong> <a href=\"https://www.facebook.com/officialJDC\" target=\"_blank\">JDCofficial</a><br /><strong>Twitter:</strong> <a href=\"http://www.twitter.com/JarDacan\" target=\"_blank\">@JarDacan</a></p>\n<p><a href=\"http://www.2ne1.cz\" target=\"_blank\">www.2ne1.cz</a><br /><a href=\"http://jdc.2ne1.cz\" target=\"_blank\">jdc.2ne1.cz</a><br /><a href=\"http://www.asianstyle.cz/profil/jdc\" target=\"_blank\">www.asianstyle.cz/profil/jdc</a></p>\n<h2>Spr&aacute;vci syst&eacute;mu</h2>\n<p>JDC - hlavn&iacute; administr&aacute;tor, DJ<br />Tokki - Songmaster</p>\n<h2>Sponzoři a special thanks</h2>\n<p>Tokki, Licee - Pomoc při tvorbě playlistu</p>\n<p style=\"text-align: center;\"><a href=\"https://www.facebook.com/officialJDC\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/facebook-icon.png\" alt=\"\" /></a> <a href=\"http://www.twitter.com/JarDacan\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/twitter-icon.png\" alt=\"\" /></a> <a href=\"https://plus.google.com/u/0/+JaroslavJDCVojt&iacute;&scaron;ek\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/google-plus-icon.png\" alt=\"\" /></a> <a href=\"http://www.youtube.com/user/cunoryp\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/youtube-icon.png\" alt=\"\" /></a></p>',	'',	'kontakt'),
(2,	'Homepage',	'<h2>Chcete sly&scaron;et svou obl&iacute;benou p&iacute;sničku na př&iacute;&scaron;t&iacute; Asian Style party?</h2>\n<h3><strong>Bl&iacute;ž&iacute; se letn&iacute; party, kter&aacute; zakonč&iacute; CZHW v&iacute;kend v Praze!<br /></strong></h3>\n<p>Nen&iacute; to moc dlouho, kdy se konala <a href=\"https://www.facebook.com/events/634964606589028/\" target=\"_blank\"><strong>Asian Style party</strong></a> v Brně. A opět jsem zp&aacute;tky. Tentokr&aacute;te to rozjedeme společně s <a href=\"https://www.facebook.com/pages/KPOP-PARTY-DJ-ONDRO/1442707805959552?fref=ts\" target=\"_blank\"><strong>DJ Ondro</strong></a> v pražsk&eacute;m klubu <a href=\"https://www.facebook.com/yesclubprague\"><strong>Yes CLUB Prague</strong></a> a ohromn&yacute;m třeskem zakonč&iacute;me <strong>CZHW v&iacute;kend</strong> v neděli <strong>10. srpna 2014</strong>. Rozhodně přijďte, přece si nenech&aacute;te uj&iacute;t v&scaron;echnu tu par&aacute;du. :)</p>\n<p>Svou &uacute;čast pros&iacute;m potvrďte v <a href=\"https://www.facebook.com/events/323775771105316/?fref=ts\" target=\"_blank\">ud&aacute;losti na Facebooku</a>.</p>\n<p>DJ JDC se v r&aacute;mci zpětn&eacute; vazby a zlep&scaron;ov&aacute;n&iacute; opět rozhodl d&aacute;t prostor zase V&Aacute;M! Prostřednictv&iacute;m tohoto mal&eacute;ho port&aacute;lu můžete d&aacute;t DJovi tipy na songy, kter&eacute; byste r&aacute;di na AS p&aacute;rty sly&scaron;eli a zatančili si na ně. Stač&iacute; k tomu jedin&eacute; - <strong><a href=\"song/add\">Poslat v&aacute;&scaron; tip přes n&aacute;&scaron; formul&aacute;ř!</a></strong></p>\n<p>Pro v&iacute;ce informac&iacute; ohledně DJova playlistu sledujte <a href=\"https://www.facebook.com/officialJDC\" target=\"_blank\">JDC\'s ofici&aacute;ln&iacute; Facebook</a> (dejte mu lajk, uděl&aacute;te mu t&iacute;m radost a zachr&aacute;n&iacute;te život dvaceti kočičk&aacute;m a třem tis&iacute;cům stromů :P) a pro v&scaron;eobecn&eacute; informace ohledně p&aacute;rty sledujte server <a href=\"http://www.asianstyle.cz\" target=\"_blank\">AsianStyle.cz</a></p>\n<p><span style=\"color: #0000ff;\"><strong>POZOR!</strong> Byla aktualizov&aacute;na <a href=\"../../../song/add\" target=\"_blank\"><span style=\"color: #0000ff;\"><strong>pravidla přid&aacute;v&aacute;n&iacute; songů</strong></span></a>. Bliž&scaron;&iacute; informace o změn&aacute;ch se dočtete na <a href=\"http://cwjp.2ne1.cz/zmena-podminek-as-party-songatoru/\" target=\"_blank\"><span style=\"color: #0000ff;\"><strong>blogu CWJP</strong></span></a>.</span></p>\n<h3>Kalend&aacute;ř akc&iacute;</h3>\n<ul>\n<li><a href=\"http://www.asianstyle.cz/ostatni/4881-prijdte-na-prvni-asianstyle-party\" target=\"_blank\">AsianStyle party (20.4.2013)</a> <span style=\"background-color: #ff0000; color: #ffffff;\">PAST EVENT</span></li>\n<li><a href=\"http://www.asianstyle.cz/ostatni/7590-asianstyle-party-2\" target=\"_blank\">AsianStyle party 2 - CZHW v&iacute;kend (11.8.2013)</a> <span style=\"background-color: #ff0000; color: #ffffff;\">PAST EVENT</span></li>\n<li><a href=\"http://www.asianstyle.cz/ostatni/10184-asianstyle-vikend\" target=\"_blank\">Narozeninov&aacute; AsianStyle p&aacute;rty (AS p&aacute;rty3) (7.12.2013)</a> <span style=\"background-color: #ff0000; color: #ffffff;\"><span style=\"background-color: #ff0000; color: #ffffff;\">PAST EVENT</span></span></li>\n<li><a href=\"http://www.asianstyle.cz/ostatni/12496-zveme-vas-na-asianstyle-panda-party\" target=\"_blank\">AsianStyle Panda p&aacute;rty (AS p&aacute;rty 4) (12.4.2014)</a> <span style=\"background-color: #ff0000; color: #ffffff;\"><span style=\"background-color: #ff0000; color: #ffffff;\">PAST EVENT</span></span></li>\n<li><a href=\"http://www.asianstyle.cz/ostatni/13541-prvni-asianstyle-party-v-brne\" target=\"_blank\">AsianStyle party Brno (AS p&aacute;rty 5) (28.6.2014)</a>&nbsp;<span style=\"background-color: #ff0000; color: #ffffff;\"><span style=\"background-color: #ff0000; color: #ffffff;\"><span style=\"background-color: #ff0000; color: #ffffff;\">PAST EVENT</span></span></span></li>\n<li><a href=\"http://www.asianstyle.cz/ostatni/14327-asianstyle-party-tradicne-zakonci-hallyu-wave-weekend-2014\" target=\"_blank\"><strong>AsianStyle YES! party (AS p&aacute;rty 6) (10.8.2014)</strong></a> <span style=\"color: #ffffff;\"><strong><span style=\"background-color: #008000;\">COMMING SOON</span></strong></span></li>\n</ul>\n<p>Na&scaron;li jste chybu nebo m&aacute;te n&aacute;pad, č&iacute;m tento mal&yacute; port&aacute;l vylep&scaron;it? Sdělte n&aacute;m to v na&scaron;em <strong><a href=\"https://github.com/JDCofficial/songator/issues?state=open\" target=\"_blank\">Issue Trackeru</a></strong> na <a href=\"https://github.com/JDCofficial/songator\" target=\"_blank\"><strong>Githubu</strong></a>.</p>\n<p>T&eacute;že můžete přispět na DJovu vlastn&iacute; techniku, neboť hraje jen pro V&aacute;s a je odk&aacute;z&aacute;n na to si techniku půjčovat a ne vždy je k dispozici. S vlastn&iacute; technikou je hran&iacute; přeci jen o něco snaž&scaron;&iacute; a d&iacute;ky tomu bude moci DJ hr&aacute;t i mimo nočn&iacute; kluby, ale i jin&eacute; AS akce. Rovněž sv&yacute;m př&iacute;spěvkem můžete podpořit i v&yacute;voj tohoto port&aacute;lu. Za va&scaron;e př&iacute;spěvky bude DJ vděčn&yacute; a slibuje, že je nepoužije na nic jin&eacute;ho, než na rozvoj a hran&iacute; na AS p&aacute;rty a podobn&yacute;ch akc&iacute;. Opravdu za ty prachy nepůjde s kolegy na pivo ;) Nav&iacute;c, kdo přispěje, <strong>dostane men&scaron;&iacute; odměnu, kterou si bude moci vybrat</strong> (Affiliate, VIP kartička a přednostn&iacute; song na př&iacute;n&iacute;, atp). <strong><a href=\"http://cwjp.2ne1.cz/podporte-dj-as-party/\" target=\"_blank\">V&iacute;ce informac&iacute; zde</a></strong></p>\n<div style=\"text-align: center; width: 100%;\"><form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_top\"><input name=\"cmd\" type=\"hidden\" value=\"_s-xclick\" /> <input name=\"hosted_button_id\" type=\"hidden\" value=\"CVLF3YMBGXCFA\" /> <input alt=\"PayPal - The safer, easier way to pay online!\" name=\"submit\" src=\"https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif\" type=\"image\" />\n<p>&nbsp;</p>\n</form></div>\n<div id=\"mcePasteBin\" style=\"position: absolute; top: 228px; left: 0; background: red; width: 1px; height: 1px; overflow: hidden;\" contenteditable=\"false\">\n<div contenteditable=\"true\">\n<ul>\n<li><a href=\"http://www.asianstyle.cz/ostatni/13541-prvni-asianstyle-party-v-brne\" target=\"_blank\"><strong>AsianStyle party Brno (AS p&aacute;rty 5) (28.6.2014)</strong></a>&nbsp;<span style=\"background-color: #ff0000; color: #ffffff;\"><span style=\"background-color: #ff0000; color: #ffffff;\">PAST EVENT</span></span></li>\n</ul>\n</div>\n</div>\n<div id=\"tc_2014aug04_000000\" style=\"width: 439px; height: 126px; margin: 0 auto;\"><a title=\"Free online countdown, countup, timer, counter and stopwatch\" href=\"http://www.tickcounter.com/\">countdown</a></div>\n<script type=\"text/javascript\">// <![CDATA[\n(function(){var s = document.createElement(\'script\');s.src = \'//tickcounter.com/widget/countdown/2014aug04/Europe+Prague/000000/Uz%25C3%25A1v%25C4%259Brka%2520Songatoru.js\';s.async = \"async\";s.type = \'text/javascript\';document.body.appendChild(s);}());\n// ]]></script>',	'',	'homepage'),
(3,	'Podmínky pro přidání songu',	'<p>Zde můžete přidat do n&aacute;vrhu playlistu song, na kter&yacute; byste si r&aacute;di zatančili kter&yacute; byste r&aacute;di sly&scaron;eli na AsianStyle party. DJovi můžete je&scaron;tě pomoci t&iacute;m, že u va&scaron;eho tipu na sonng uvdete odkaz k poslechnut&iacute;, např&iacute;klad odkaz na Youtube. Song mus&iacute; splňovat n&aacute;sleduj&iacute;c&iacute; podm&iacute;nky:</p>\n<ul>\n<li>Song mus&iacute; b&yacute;t ž&aacute;nru asijsk&eacute; hudby (<strong>K-POP, J-POP, C-POP, Thai Pop</strong> a jin&aacute; asijsk&aacute; hudba)</li>\n<li>Na song <strong>se mus&iacute; d&aacute;t tancovat</strong>, nesm&iacute; b&yacute;t utahan&yacute;, nudn&yacute;, aby n&aacute;m neut&iacute;kali lidi z parketu</li>\n<li>Pomalej&scaron;&iacute; songy jsou dovoleny, ale mus&iacute; b&yacute;t alespoň trochu tanečn&iacute; a nesm&iacute; b&yacute;t utahan&yacute; a nudn&yacute;. Pomalej&scaron;&iacute; songy <strong>nebudou br&aacute;ny přednostně</strong></li>\n<li>Pokud song bude nevhodn&yacute;, DJ m&aacute; pr&aacute;vo jej <strong>z playlistu vyřadit</strong></li>\n<li>N&aacute;zvy songů a jm&eacute;na interpretů pi&scaron;te pros&iacute;m v <strong>ROMANIZOVAN&Eacute;M</strong> přepise, př&iacute;padně jejich <strong>ANGLICK&Yacute;M</strong> n&aacute;zvem</li>\n<li>Do odkazu k poslechu<strong> ned&aacute;vejte odkaz ke stažen&iacute;</strong>. Song s pochybn&yacute;m odkazem bude smaz&aacute;n <strong><span style=\"background-color: #ffffff; color: #ff0000;\">A UŽIVATEL, KTER&Yacute; JEJ PŘIDAL, ZABANOV&Aacute;N!</span></strong></li>\n<li>NEPŘI&Aacute;VEJTE songy kter&eacute; nejsou př&iacute;li&scaron; zn&aacute;m&eacute;, nemaj&iacute; \"&scaron;ť&aacute;vu\" a energii. Nudn&eacute; a nez&aacute;živn&eacute; songy budou <strong>zam&iacute;t&aacute;ny</strong> <strong>bez možnosti schv&aacute;len&iacute; přehlasov&aacute;n&iacute;m</strong>.</li>\n<li>Někter&eacute; zam&iacute;tnut&eacute; songy můžete nechat schv&aacute;lit hlasov&aacute;n&iacute;m. Pokud byl song zam&iacute;tnut, můžete mu d&aacute;t \"srd&iacute;čko\" a t&iacute;mto ovlivnit jeho osud. Toto <strong>neplat&iacute;</strong> ov&scaron;em pro <strong>songy </strong>zam&iacute;tnut&eacute;<strong> kvůli kvalitě</strong>, opravdu <strong>nez&aacute;živn&eacute; a nudn&eacute;</strong> <strong>songy</strong> nepatř&iacute;c&iacute; na party, př&iacute;li&scaron; <strong>nezn&aacute;m&eacute; songy</strong> a<strong> neasijsk&eacute; songy</strong>.</li>\n<li>Pokud přid&aacute;te song do playlistu, nem&aacute;te pr&aacute;vo požadovat jeho schv&aacute;len&iacute;, a to ani v př&iacute;padě jeho zam&iacute;tnut&iacute;.</li>\n<li>DJ, ani jeho asistenti nejsou povinni schv&aacute;lit songy ihned. Takt&eacute;ž nemus&iacute; nutně schv&aacute;lit v&scaron;echny requesty do nadch&aacute;zej&iacute;c&iacute;ho eventu.</li>\n<li>DJ nemůže na 100% zaručit, že zahraje v&scaron;echny songy v playlistu. Noc je dlouh&aacute;, ale bohužel času nen&iacute; zase tolik, aby se to za jednu noc v&scaron;echno dalo stihnout zahr&aacute;t. Pokud chcete sly&scaron;et va&scaron;&iacute; obl&iacute;benou p&iacute;seň, nechte si ji zahr&aacute;t jako<strong> p&iacute;seň na př&aacute;n&iacute;</strong> u DJe př&iacute;mo na p&aacute;rty.</li>\n<li>Jen osoby se <strong>statutem VIP</strong> si mohou nechat na party zahr&aacute;t song přednostně bez ohledu na frontu wishlistu.</li>\n<li>VIP statut na party nelze požadovat. DJ s&aacute;m rozhodne, komu statut uděl&iacute;.</li>\n<li>DJ hraje podle atmosf&eacute;ry a nen&iacute; povinnen zahr&aacute;t v&scaron;e na př&aacute;n&iacute; ve wishlistu. Pokud se song na př&aacute;n&iacute; v onen okamžik nehod&iacute;, nebude zahr&aacute;n, př&iacute;padně bude zahr&aacute;n později, pokud se pro něj naskytne prostor.</li>\n<li><span style=\"color: #ff0000;\">Před přid&aacute;n&iacute;m songu <strong>zkontrolujte, zda se už song nenach&aacute;z&iacute; v na&scaron;em <a href=\"../../../song/list\">seznamu</a>. DUPLICITY BUDOU MAZ&Aacute;NY! <span style=\"text-decoration: underline;\">Za spamov&aacute;n&iacute; duplicitami v&aacute;m může b&yacute;t znemožněno přid&aacute;v&aacute;n&iacute; songů!</span><br /></strong></span></li>\n<li><span style=\"color: #ff0000;\"><strong>Takt&eacute;ž je zak&aacute;z&aacute;no přid&aacute;vat fake z&aacute;znamy. Spamov&aacute;n&iacute; songatoru je br&aacute;no jako v&aacute;žn&yacute; přestupek a bude odměňov&aacute;no banem. Za v&aacute;žn&eacute; po&scaron;kozen&iacute; port&aacute;lu můžete dostat pokutu.</strong></span></li>\n<li>Přid&aacute;n&iacute;m songu se z&aacute;znam automaticky st&aacute;v&aacute; souč&aacute;st&iacute; DJova playlistu a majektem<strong> JDC Entertainment</strong>. Tak&eacute; t&iacute;mto<strong> souhlas&iacute;te</strong> s jeho zařazen&iacute;m do DJova playlistu a zahr&aacute;n&iacute;m na AsianStyle party</li>\n</ul>\n<p>Tyto podm&iacute;nky byly publikov&aacute;ny dne 14.6.2014.</p>',	'',	'add'),
(4,	'About DJ',	'<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://scontent-b-cdg.xx.fbcdn.net/hphotos-prn2/t1/1538837_565227476894285_1133088857_n.jpg\" alt=\"\" width=\"450\" /></p>\n<p>Kdo je vlastně ten DJ JDC? Mysl&iacute;m, že odpově na tuto ot&aacute;zku neuhodnete, jelikož je to člověk, jako každ&yacute; jin&yacute;. A nebo ne? Každop&aacute;dně ať už je co je, hudbu prostě miluje, a už je jak&eacute;hokoli druhu. Nejraději m&aacute; ov&scaron;em tu asijskou a proto se ve sv&eacute;m voln&eacute;m čase věnuje hran&iacute; asijsk&eacute; hudby na AsianStyle p&aacute;rty. Pokud se někdy přijdete pod&iacute;vat, ať už ze zvědavosti, nebo si jen tak zatancovat, zajist&eacute; usy&scaron;&iacute;te K-POP, C-POP, J-POP, Thai-Pop a dal&scaron;&iacute; asijsk&eacute; ž&aacute;nry a styly.</p>\n<p style=\"text-align: center;\"><a href=\"https://www.facebook.com/officialJDC\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/facebook-icon.png\" alt=\"\" /></a> <a href=\"http://www.twitter.com/JarDacan\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/twitter-icon.png\" alt=\"\" /></a> <a href=\"https://plus.google.com/u/0/+JaroslavJDCVojt&iacute;&scaron;ek\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/google-plus-icon.png\" alt=\"\" /></a> <a href=\"http://www.youtube.com/user/cunoryp\" target=\"_blank\"><img src=\"http://icons.iconarchive.com/icons/danleech/simple/64/youtube-icon.png\" alt=\"\" /></a></p>\n<p>&nbsp;</p>\n<div id=\"mcePasteBin\" style=\"position: absolute; top: 119px; left: 0; background: red; width: 1px; height: 1px; overflow: hidden;\" contenteditable=\"false\">\n<div contenteditable=\"true\">X</div>\n</div>',	'',	'dj'),
(5,	'About AsianStyle party',	'<p>sdfad</p>',	'',	'asparty');

DROP TABLE IF EXISTS `toolsmenu`;
CREATE TABLE `toolsmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(64) COLLATE utf8_bin NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `target` varchar(255) COLLATE utf8_bin NOT NULL,
  `caption` varchar(255) COLLATE utf8_bin NOT NULL,
  `perms` varchar(80) COLLATE utf8_bin NOT NULL,
  `additional` text COLLATE utf8_bin NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `toolsmenu` (`id`, `menu`, `name`, `target`, `caption`, `perms`, `additional`, `level`) VALUES
(26,	'adminex-content',	'static-content',	'content:default',	'Statický obsah',	'system:view',	'{\"icon\":\"icon-hdd\"}',	100),
(27,	'adminex-content',	'asparty-hup',	'hup:default',	'Hlavní uzávěr songátoru',	'system:view',	'{\"icon\":\"icon-music\"}',	6),
(28,	'adminex-content',	'asparty-log',	'hup:log',	'Logy lajků',	'system:view',	'{\"icon\":\"icon-file\"}',	3);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(64) CHARACTER SET utf8 NOT NULL,
  `pass` text COLLATE utf8_bin NOT NULL,
  `mail` varchar(48) CHARACTER SET utf8 NOT NULL,
  `role` varchar(16) COLLATE utf8_bin NOT NULL,
  `banned` tinyint(1) NOT NULL,
  `pohlavi` varchar(1) COLLATE utf8_bin NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(16) COLLATE utf8_bin NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texture` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT 'default',
  `funkce` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `user`, `pass`, `mail`, `role`, `banned`, `pohlavi`, `last_activity`, `last_ip`, `registered`, `texture`, `funkce`) VALUES
(11,	'JDC',	'02a00ce246a62a2049a0f6d8261fddeb',	'jdc@2ne1.cz',	'admin',	0,	'M',	'2014-08-03 18:03:45',	'::1',	'2013-05-01 00:00:00',	'pinktiger',	'Správce Nesys'),
(12,	'Syrinox',	'52629b45e68f0d0bf871a0b904c5e1dc',	'syrinox@gmail.com',	'admin',	0,	'F',	'2013-11-16 01:17:03',	'90.178.252.135',	'2013-09-22 15:27:53',	'default',	''),
(13,	'test',	'cc03e747a6afbbcbf8be7668acfebee5',	'test@tst.cz',	'editor',	0,	'H',	'2013-11-10 13:28:07',	'88.102.19.211',	'2013-11-10 13:25:55',	'default',	''),
(14,	'Munseunghui',	'5c41bc050ea9887bfe7a9bfb0301750b',	'neumannova.sabina@gmail.com',	'user',	0,	'F',	'2013-11-20 01:05:02',	'89.24.239.88',	'2013-11-10 18:36:02',	'default',	''),
(15,	'Mei',	'81a57538bea3f6e953f6a459eb767357',	'marty.two@seznam.cz',	'user',	0,	'F',	'2013-11-19 20:01:48',	'81.201.48.28',	'2013-11-10 18:54:48',	'default',	''),
(16,	'kyas',	'43718f163dfd66b0b4682ca7b92fae1e',	'wert.y@centrum.cz',	'user',	0,	'F',	'2013-11-10 19:52:27',	'46.13.162.231',	'2013-11-10 19:35:31',	'default',	''),
(17,	'asteam',	'40f37dec9fcb16138912647b47c673b4',	'asteam@asianstyle.cz',	'author',	1,	'H',	'2013-11-17 13:38:42',	'86.49.113.129',	'2013-11-16 12:08:04',	'default',	''),
(18,	'Ssantokki',	'd8cc53c0e2f47162b51789831d875c00',	'Juukya@gmail.com',	'admin',	0,	'H',	'2014-07-26 00:09:00',	'212.79.110.105',	'2014-03-18 00:24:16',	'default',	''),
(19,	'Tokki',	'a3086afe0958541aeb2f33fca74b0d3c',	'sung.tiana@gmail.com',	'admin',	0,	'F',	'2014-07-22 00:17:47',	'83.208.173.251',	'2014-03-29 15:47:49',	'default',	''),
(20,	'anya',	'72c9318be6ca423692f4f531a8a37bff',	'anez.stefanova@gmail.com',	'admin',	0,	'F',	'2014-07-26 22:41:26',	'178.72.253.224',	'2014-06-15 19:57:20',	'default',	'');

DROP TABLE IF EXISTS `users_tickets`;
CREATE TABLE `users_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ticket` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- 2014-09-03 14:02:34
