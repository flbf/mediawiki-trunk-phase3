<?
# DO NOT EDIT THIS FILE!
# To customize your installation, edit "LocalSettings.php".
# Note that since all these string interpolations are expanded
# before LocalSettings is included, if you localize something
# like $wgScriptPath, you must also localize everything that
# depends on it.

$wgServer           = "http://" . getenv( "SERVER_NAME" );
$wgScriptPath	    = "/wiki";
$wgScript           = "{$wgScriptPath}/wiki.phtml";
$wgRedirectScript   = "{$wgScriptPath}/redirect.phtml";
$wgStyleSheetPath   = "{$wgScriptPath}/style";
$wgStyleSheetDirectory = "{$IP}/style";
$wgArticlePath      = "{$wgScript}?title=$1";
$wgUploadPath       = "{$wgScriptPath}/upload";
$wgUploadDirectory	= "{$IP}/upload";
$wgLogo				= "{$wgUploadPath}/wiki.png";
$wgMathPath         = "{$wgUploadPath}/math";
$wgMathDirectory    = "{$wgUploadDirectory}/math";
$wgTmpDirectory     = "{$wgUploadDirectory}/tmp";
$wgEmergencyContact = "wikiadmin@" . getenv( "SERVER_NAME" );

# MySQL settings
#
$wgDBserver         = "localhost";
$wgDBname           = "wikidb";
$wgDBintlname       = "intl";
$wgDBconnection     = "";
$wgDBuser           = "wikiuser";
$wgDBpassword       = "userpass";
$wgDBsqluser		= "sqluser";
$wgDBsqlpassword	= "sqlpass";
$wgDBminWordLen     = 4;
$wgDBtransactions	= false; # Set to true if using InnoDB tables
$wgDBmysql4			= false; # Set to true to use enhanced fulltext search

# Language settings
#
$wgLanguageCode     = "en";
$wgInterwikiMagic	= true; # Treat language links as magic connectors, not inline links
$wgUseNewInterlanguage = false;
$wgInputEncoding	= "ISO-8859-1";
$wgOutputEncoding	= "ISO-8859-1";
$wgEditEncoding		= "";
$wgDocType          = "-//W3C//DTD HTML 4.01 Transitional//EN";
$wgAmericanDates = false; 	# Enable for English module to print dates
							# as eg 'May 12' instead of '12 May'
$wgLocalInterwiki   = "w";
$wgShowIPinHeader	= true; # For non-logged in users

# Miscellaneous configuration settings
#
$wgReadOnlyFile		= "{$wgUploadDirectory}/lock_yBgMBwiR";
$wgDebugLogFile     = "{$wgUploadDirectory}/log_dlJbnMZb";
$wgDebugComments	= false;
$wgReadOnly			= false;
$wgSqlLogFile		= "{$wgUploadDirectory}/sqllog_mFhyRe6";
$wgLogQueries		= false;

# Client-side caching:
$wgCachePages       = true; # Allow client-side caching of pages

# Set this to current time to invalidate all prior cached pages.
# Affects both client- and server-side caching.
$wgCacheEpoch = "20030516000000";

# Server-side caching:
#  This will cache static pages for non-logged-in users
#  to reduce database traffic on public sites.
#  Must set $wgShowIPinHeader = false
$wgUseFileCache = false;
$wgFileCacheDirectory = "{$wgUploadDirectory}/cache";

$wgCookieExpiration = 2592000;

$wgAllowExternalImages = true;
$wgMiserMode = false; # Disable database-intensive features
$wgUseTeX = false;
$wgProfiling = false; # Enable for more detailed by-function times in debug log

# We can serve pages compressed in order to save bandwidth,
# but this will increase CPU usage.
# Requires zlib support enabled in PHP.
$wgUseGzip = false;
$wgCompressByDefault = true;

# Which namespaces should support subpages?
# See Language.php for a list of namespaces.
#
$wgNamespacesWithSubpages = array( -1 => 0, 0 => 0, 1 => 1,
  2 => 1, 3 => 1, 4 => 0, 5 => 1, 6 => 0, 7 => 1 );

?>
