<?php

require_once( dirname( __FILE__ ) . '/commandLine.inc' );

function purgeStaleMemcachedText() {
	global $wgMemc;
	$db = wfGetDB( DB_MASTER );
	$maxTextId = $db->selectField( 'text', 'max(old_id)' );
	$latestReplicatedTextId = $db->selectField( array( 'revision','recentchanges'), 'rev_text_id', 
		array( 'rev_id = rc_this_oldid', "rc_timestamp < '20101225183000'"),  'purgeStaleMemcachedText', 
		array( 'ORDER BY' => 'rc_timestamp DESC' ) );
	$latestReplicatedTextId -= 100; # A bit of paranoia

	echo "Going to purge text entries from $latestReplicatedTextId to $maxTextId\n";

	for ( $i = $latestReplicatedTextId; $i < $maxTextId; $i++ ) {
		$key = wfMemcKey( 'revisiontext', 'textid', $i++ );
		$wgMemc->delete( $key );
	}
}

purgeStaleMemcachedText();

