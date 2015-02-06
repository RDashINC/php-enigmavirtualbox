<?php
	/**
	 * php-enigmavirtualbox (gen)
	 *
	 * Port of node-enigmavirtualbox with simlliar usage.
	 *
	 * @author RainbowDashDC
	 * @link http://github.com/RDashINC/php-enigmavirtualbox
	 * @license MIT
	 *
	 **/

	/* Help */
	if($argv[1]=='--help' OR (is_null($argv[1]))) {
		echo "USAGE: project.evb input.exe output.exe [files]";
		exit(0);
	}

	/* Defaults */
	$COMPRESS=false; // does nothing... yet

	/** First too command line arguments **/
	$project = $argv[1];
	$exe_in = $argv[2];
	$exe_out = $argv[3];
	array_shift($argv);
	array_shift($argv);
	array_shift($argv);
	array_shift($argv);

	if(is_null($exe_in)) {
		die('No Input EXE');
	} elseif (is_null($exe_out)) {
		die('No Ouput EXE');
	} elseif (is_null($project)) {
		die('Unknown error.');
	}

	if(!file_exists($exe_in)) {
		die('Input EXE doesn\'t exist!');
	}

	if($exe_in == $exe_out) {
		die('Input can\'t equal output EXE!');
	}

    $xml = "" .
    "<?xml encoding=\"utf-8\"?>\n" .
    "<>\n" .
    "    <InputFile>" . $exe_in . "</InputFile>\n" .
    "    <OutputFile>" . $exe_out . "</OutputFile>\n" .
    "    <Files>\n" .
    "        <Enabled>true</Enabled>\n" .
    "        <DeleteExtractedOnExit>true</DeleteExtractedOnExit>\n" .
    "        <CompressFiles>false</CompressFiles>\n" .
    "        <Files>\n" .
    "            <File>\n" .
    "                <Type>3</Type>\n" .
    "                <Name>%DEFAULT FOLDER%</Name>\n" .
    "                <Files>\n";
foreach($argv as $k => $v) {
	if(file_exists($v)) {
		$pi = pathinfo($v);
		$name = $pi['basename'];
		$file = $v;
	    $xml = $xml. "" .
	    "                    <File>\n" .
	    "                        <Type>2</Type>\n" .
	    "                        <Name>" . $name . "</Name>\n" .
	    "                        <File>" . $file . "</File>\n" .
	    "                        <ActiveX>false</ActiveX>\n" .
	    "                        <ActiveXInstall>false</ActiveXInstall>\n" .
	    "                        <Action>0</Action>\n" .
	    "                        <OverwriteDateTime>false</OverwriteDateTime>\n" .
	    "                        <OverwriteAttributes>false</OverwriteAttributes>\n" .
	    "                        <PassCommandLine>false</PassCommandLine>\n" .
	    "                    </File>\n";
	} else {
		die("File not found! '".$v."'");
	}
}
$xml = $xml .
    "                </Files>\n" .
    "            </File>\n" .
    "        </Files>\n" .
    "    </Files>\n" .
    "    <Registries>\n" .
    "        <Enabled>false</Enabled>\n" .
    "        <Registries>\n" .
    "            <Registry>\n" .
    "                <Type>1</Type>\n" .
    "                <Virtual>true</Virtual>\n" .
    "                <Name>Classes</Name>\n" .
    "                <ValueType>0</ValueType>\n" .
    "                <Value/>\n" .
    "                <Registries/>\n" .
    "            </Registry>\n" .
    "            <Registry>\n" .
    "                <Type>1</Type>\n" .
    "                <Virtual>true</Virtual>\n" .
    "                <Name>User</Name>\n" .
    "                <ValueType>0</ValueType>\n" .
    "                <Value/>\n" .
    "                <Registries/>\n" .
    "            </Registry>\n" .
    "            <Registry>\n" .
    "                <Type>1</Type>\n" .
    "                <Virtual>true</Virtual>\n" .
    "                <Name>Machine</Name>\n" .
    "                <ValueType>0</ValueType>\n" .
    "                <Value/>\n" .
    "                <Registries/>\n" .
    "            </Registry>\n" .
    "            <Registry>\n" .
    "                <Type>1</Type>\n" .
    "                <Virtual>true</Virtual>\n" .
    "                <Name>Users</Name>\n" .
    "                <ValueType>0</ValueType>\n" .
    "                <Value/>\n" .
    "                <Registries/>\n" .
    "            </Registry>\n" .
    "            <Registry>\n" .
    "                <Type>1</Type>\n" .
    "                <Virtual>true</Virtual>\n" .
    "                <Name>Config</Name>\n" .
    "                <ValueType>0</ValueType>\n" .
    "                <Value/>\n" .
    "                <Registries/>\n" .
    "            </Registry>\n" .
    "        </Registries>\n" .
    "    </Registries>\n" .
    "    <Packaging>\n" .
    "        <Enabled>false</Enabled>\n" .
    "    </Packaging>\n" .
    "    <Options>\n" .
    "        <ShareVirtualSystem>true</ShareVirtualSystem>\n" .
    "        <MapExecutableWithTemporaryFile>false</MapExecutableWithTemporaryFile>\n" .
    "        <AllowRunningOfVirtualExeFiles>true</AllowRunningOfVirtualExeFiles>\n" .
    "    </Options>\n" .
    "</>\n";

    /* Write to project file */
    if($project !== 'stdout') {
    	file_put_contents($project, $xml);
    } else {
    	echo $xml;
    }