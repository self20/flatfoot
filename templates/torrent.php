<?php
use nickschlobohm\Flatfoot;

if (!isset($_GET['id'])) {
    die('A torrent ID must be specified.');
}

echo Flatfoot\Template::nav(true);

$id = $_GET['id'];

$found = false;
$torrent = null;
$file = null;

foreach (Flatfoot\Functions::scan('./torrents', 'torrent') as $f) {
    $file = $f;
    $torrent = new Flatfoot\TorrentRW($f);
    if ($torrent->hash_info() == $id) {
        $found = true;
        break;
    }
}

if (!$found || !$torrent) {
    echo 'That torrent ID was invalid. No file was found in <code>./torrents/</code> - try again!';
} else {
    $announce = $torrent->announce();
    $comment = $torrent->comment();
    $content = $torrent->content();
    $magnet_html = $torrent->magnet(true);
    $name = $torrent->name();
    $size = $torrent->size();

    ?>
    <h2>
        <?= $name ?>
    </h2>
    <p>
        <a href="<?= $file ?>" class="btn btn-default">
            <i class="fa fa-download"></i>
            <span>Download .torrent</span>
        </a>
        <a href="<?= $magnet_html ?>" class="btn btn-default">
            <i class="fa fa-magnet fa-rotate-180"></i>
            <span>Download magnet</span>
        </a>
    </p>
    <table class="table table-bordered">
        <tr>
            <td>Torrent name:</td>
            <td><?= $name ?></td>
        </tr>
        <tr>
            <td>Announce URL:</td>
            <td><?= $announce ?></td>
        </tr>
        <tr>
            <td>Comment:</td>
            <td><?= $comment ?></td>
        </tr>
        <tr>
            <td>Size:</td>
            <td><?= Flatfoot\Functions::human_filesize($size) ?></td>
        </tr>
        <tr>
            <td>Files:</td>
            <td>
                <div>
                    <div class="form-group">
                        <a href="#fileList" class="btn btn-primary btn-sm" role="button" data-toggle="collapse">Toggle
                            show/hide</a>
                    </div>
                    <div id="fileList" class="collapse">
                        <ul class="list-unstyled">
                            <?php foreach ($content as $fileName => $value) { ?>
                                <li>
                                    <span><?= $fileName ?></span>
                                    <span>[<?= Flatfoot\Functions::human_filesize($value) ?>]</span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
    </table>
<?php } ?>