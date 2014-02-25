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

You need a `composer`

`$ curl -s http://getcomposer.org/installer | php`

[Download for Windows](https://getcomposer.org/Composer-Setup.exe)

### Cloning

1. Clone this git repository `git clone https://github.com/JDCofficial/songator.git`
2. Remove `composer.lock` file
3. From command promt: `composer update` in directory with sources (downloads dependencies)
4. Download latest [SQL database dump](http://repo.2ne1.cz/songator/songator.sql)
5. Create new database and import SQL file
6. Create file `config.local.neon` in dorecotry `app/config` and paste this:

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

[![Build Status](https://travis-ci.org/JDCofficial/songator.png?branch=master)](https://travis-ci.org/JDCofficial/songator)
