<?php
use nickschlobohm\Flatfoot;

$torrentsArray = Flatfoot\Functions::scan('./torrents', 'torrent');
?>
<?= Flatfoot\Template::nav() ?>
<?php if (!count($torrentsArray)) { ?>
    <p class="text-center alert alert-info">No torrents found. Add some to the <code>torrents</code> directory for them
        to show up here.</p>
<?php } else { ?>
    <?= Flatfoot\Template::renderTorrentTable($torrentsArray) ?>
<?php } ?>