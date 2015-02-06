<?php
	/**
	 * php-enigmavirtualbox (wrapper?)
	 *
	 * Port of node-enigmavirtualbox with simlliar usage.
	 *
	 * @author RainbowDashDC
	 * @link http://github.com/RDashINC/php-enigmavirtualbox
	 * @license MIT
	 *
	 **/

	if(!file_exists('.\evb\enigmavbconsole.exe')) {
		echo '++ downloading evb'."\n";
		mkdir('.\evb');
		file_put_contents(".\\evb\\enigmavbconsole.exe", fopen("http://download1517.mediafire.com/99qbj9cbc9bg/psryrnroa7g2ngg/enigmavbconsole.exe", 'r'));
		echo '++ done';
		echo "\n";
	}

	if(!isset($argv[1])) {
		echo(
		    "ERROR: missing command (and options)\n" .
		    "USAGE: enigmavirtualbox <command> [<arg> ...]\n" .
		    "USAGE: enigmavirtualbox gen config.evb app.exe app.exe file.x ...\n" .
		    "USAGE: enigmavirtualbox cli config.evb"
		);
		die();
	}

	if($argv[1]==='cli') {
		array_shift($argv);
		require('evb-cli.php');
		exit();
	} elseif($argv[1]==='gen') {
		array_shift($argv);
		require('evb-gen.php');
		exit();
	} else {
		die('ERROR: Not recognized.');
	}