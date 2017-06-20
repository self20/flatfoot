<?php
use nickschlobohm\Flatfoot;

?>
<?= Flatfoot\Template::nav() ?>
<?php
$torrentsArray = Flatfoot\Functions::scan('./torrents', 'torrent');
if (count($torrentsArray) == 0) {
    die('No torrents found. Add some to <code>./torrents/</code> for them to show up here.');
}

echo Flatfoot\Template::renderTorrentTable($torrentsArray)
?>