<?php
use nickschlobohm\Flatfoot;

echo Flatfoot\Template::nav();

if (!isset($_GET['query'])) {
?>
<div class="form-group">
    <div class="row">
        <div class="col-lg-12">
            <form action="/search" method="get">
                <div class="input-group">
                    <input name="query" type="text" class="form-control"
                           placeholder="Search query..."> <span class="input-group-btn">
						<button class="btn btn-default" type="submit">Find</button>
					</span>
                </div>
            </form>
        </div>
    </div>
    <?php
    } else {

        $query = $_GET['query'] ?? null;
        $torrentsArray = [];

        foreach (Flatfoot\Functions::scan('./torrents', 'torrent') as $f) {
            $file = $f;
            $torrent = new Flatfoot\TorrentRW($f);
            if (preg_match('/' . $query . '/i', $torrent->name())) {
                array_push($torrentsArray, $f);
            }
        }
        ?>
        <?php if (!empty ($torrentsArray)) {
            echo Flatfoot\Template::renderTorrentTable($torrentsArray);
        } else {
            ?>
            <p class="text-center alert alert-info">No results found.</p>
            <?php
        }
    }
    ?>
</div>
