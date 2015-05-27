<?php
if (! defined ( 'indirect' )) {
	die ( 'Direct access prohibited.' );
}
/**
 * Scans a directory for specified filetypes and then returns the result as an array.
 *
 * @param string $dir
 *        	The directory to scan.
 * @param string $filetype
 *        	The file extension to look for.
 * @return array The scanned directory.
 * @since 2015-05-24
 */
function scan($dir, $filetype) {
	return $i = glob ( $dir . "/*." . $filetype );
}

/**
 * Displays a torrent's basic info in table format.
 *
 * USED BY index.php AND search.php
 *
 * @param torrent $t
 *        	The torrent to display.
 * @since 2015-05-25
 */
function displayTorrent($t) {
	$torrent = new Torrent ( $t );
	
	$size = $torrent->size () / 1024;
	$type = "KiB";
	
	if ($size / 1024 / 1024 < 1) {
		$size = round ( $size / 1024, 2 );
		$type = "MiB";
	} else {
		$size = round ( $size / 1024 / 1024, 2 );
		$type = "GiB";
	}
	
	echo ('<tr>');
	
	// torrent name:
	echo ('<td><a href="torrent.php?id=' . $torrent->hash_info () . '">' . $torrent->name () . '</a></td>');
	
	// torrent size:
	echo ('<td>' . $size . ' ' . $type . '</td>');
	
	// .torrent:
	echo ('<td><a href="' . $t . '">.torrent</a></td>');
	
	// magnet link:
	echo ('<td>&nbsp;<a href="' . $torrent->magnet ( true ) . '"><i class="fa fa-magnet"></i></a></td>');
	
	echo ('</tr>');
}
