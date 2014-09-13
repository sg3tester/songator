Songator 3
==========

DJ's open playlist

Songator 3 is in development

Download
--------

Comming soon...

Cloning the code
----------------

### Requirements

- PHP 5.4 and above
- MySQL 5.6
- MySQL levenstein function (SG3 includes it)
- Nette Framework 2.1
- Enabled mod rewrite
- You need a `composer` (for custom build or cloning devel. branch)

`$ curl -s http://getcomposer.org/installer | php`

[Download for Windows](https://getcomposer.org/Composer-Setup.exe)

### Installation

Coming soon!

### Cloning repository (custom build)

1. Clone this git repository `git clone https://github.com/JDCofficial/songator.git`
2. From command prompt: `composer update` in directory with sources (downloads dependencies)
3. Create new database and import SQL dump `/bin/sql/songator.sql` to your database
4. Create file `config.local.neon` in directory `/app/config` and paste this:

``` neon
parameters:
	twitter: # optionally - for login via twitter
		key: "<twitter app key>"
		secret: "<secret>"


nette:
	database:
		dsn: 'mysql:host=localhost;dbname=<your db>'
		user: <user>
		password: <pass>
		options:
			lazy: yes
```

!! DONE !!

In case of a problem, please contact jdc@2ne1.cz

You find a bug? Report it in [Issue Tracker](https://github.com/JDCofficial/songator/issues?state=open)

<p align="center">
	<img src="http://kramy.jdcent.cz/songator3-logo.png" alt="Songator 3" />
</p>
