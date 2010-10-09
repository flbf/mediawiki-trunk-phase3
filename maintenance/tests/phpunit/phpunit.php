#!/usr/bin/env php
<?php
/**
 * Bootstrapping for MediaWiki PHPUnit tests
 * 
 * @file
 */

/* Configuration */

// Evaluate the include path relative to this file
$IP = dirname( dirname( dirname( dirname( __FILE__ ) ) ) );

// Set a flag which can be used to detect when other scripts have been entered through this entry point or not
define( 'MW_PHPUNIT_TEST', true );

// Start up MediaWiki in command-line mode
require_once( "$IP/maintenance/commandLine.inc" );

// Assume UTC for testing purposes
$wgLocaltimezone = 'UTC';

// To prevent tests from failing with SQLite, we need to turn database caching off
$wgCaches[CACHE_DB] = false;

$targetFile = wfIsWindows() ? 'phpunit.php' : 'phpunit';
$pathSeparator = wfIsWindows() ? ';' : ':';

$folders = explode( $pathSeparator, getenv('PATH') );

require 'PHPUnit/TextUI/Command.php';
define('PHPUnit_MAIN_METHOD', 'PHPUnit_TextUI_Command::main');
PHPUnit_TextUI_Command::main();
