   _   _ _____ ____
  | \ | | ____/ ___| _   _ ___
  |  \| |  _| \___ \| | | / __|
  | |\  | |___ ___) | |_| \__ \
  |_| \_|_____|____/ \__, |___/
                     |___/
  New      Evolution     System
  by JDC Entertainment

Copy this folder content to your project.
Optimalised for skeleton Barney.

= INSTALATION =

RECOMENDED: To easier development and work is recommended base a project on Barney (Nesys) or Sandbox(Nette) skeleton.

1.) Copy this folder content to library folder in your project (In skeleton Barney to /libs)

2.) Move config.neon from /!config/config.neon to your configuration folder (In skeleton Barnay to /app/config)

3.) To your config.neon add, if you don't have:

nesys:
		appName: 'Application name'
		appDesc: 'Application based on Nesys'
		appAuthors: ['You','Your alterego']
		appEmail: ['you@example.com']
		appVersion: '1.0'
		modules:

4.) To your bootstrap add Nesys loader:

//Load Nesys CMS Framework
$configurator->onCompile[] = function ($configurator, $compiler) {
    $compiler->addExtension('nesys', new \Nesys\NesysConf);
};

5.) Setup your database connection in config.neon

6.) Import nesysdb.sql from !config/nesysdb.sql to your database

7.) Import Adminex control panel (or other administration control)

8.) Done. Base of your project is READY! 