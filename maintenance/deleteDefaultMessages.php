<?php
/**
 * Deletes all pages in the MediaWiki namespace which were last edited by
 * "MediaWiki default".
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @ingroup Maintenance
 */

require_once( dirname( __FILE__ ) . '/Maintenance.php' );

class DeleteDefaultMessages extends Maintenance {
	public function __construct() {
		parent::__construct();
		$this->mDescription = "Deletes all pages in the MediaWiki namespace" .
								" which were last edited by \"MediaWiki default\"";
	}

	public function execute() {

		$user = 'MediaWiki default';
		$reason = 'No longer required';

		$this->output( "Checking existence of old default messages..." );
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select( array( 'page', 'revision' ),
			array( 'page_namespace', 'page_title' ),
			array(
				'page_namespace' => NS_MEDIAWIKI,
				'page_latest=rev_id',
				'rev_user_text' => 'MediaWiki default',
			)
		);

		if( $dbr->numRows( $res ) == 0 ) {
			# No more messages left
			$this->output( "done.\n" );
			return;
		}

		# Deletions will be made by $user temporarly added to the bot group
		# in order to hide it in RecentChanges.
		global $wgUser;
		$wgUser = User::newFromName( $user );
		$wgUser->addGroup( 'bot' );

		# Handle deletion
		$this->output( "\n...deleting old default messages (this may take a long time!)...", 'msg' );
		$dbw = wfGetDB( DB_MASTER );

		foreach ( $res as $row ) {
			if ( function_exists( 'wfWaitForSlaves' ) ) {
				wfWaitForSlaves();
			}
			$dbw->ping();
			$title = Title::makeTitle( $row->page_namespace, $row->page_title );
			$article = new Article( $title );
			$dbw->begin();
			$article->doDeleteArticle( $reason );
			$dbw->commit();
		}

		$this->output( 'done!', 'msg' );
	}
}

$maintClass = "DeleteDefaultMessages";
require_once( RUN_MAINTENANCE_IF_MAIN );
