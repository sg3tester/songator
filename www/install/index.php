<?php

if (!is_dir(__DIR__ . "/../../install"))
		die("Installer is not available! Please install it into <b>/install</b> directory or remove <b>/www/install</b>");

require __DIR__ . "/../../install/bootstrap.php";