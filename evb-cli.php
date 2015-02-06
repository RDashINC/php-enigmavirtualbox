<?php
	/**
	 * php-enigmavirtualbox (cli)
	 *
	 * Port of node-enigmavirtualbox with simlliar usage.
	 *
	 * @author RainbowDashDC
	 * @link http://github.com/RDashINC/php-enigmavirtualbox
	 * @license MIT
	 *
	 **/

	if(!isset($argv[1])) {
		die('No Project file specified');
	}

	// This should do it.
	system('evb\\enigmavbconsole.exe '.$argv[1]);
