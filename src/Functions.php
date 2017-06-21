<?php

namespace nickschlobohm\Flatfoot;

class Functions
{
    /**
     * Scans a directory for specified filetypes and then returns the result as an array.
     *
     * @param string $dir
     *            The directory to scan.
     * @param string $filetype
     *            The file extension to look for.
     * @return array The scanned directory.
     * @since 2015-05-24
     */
    public static function scan($dir, $filetype)
    {
        return $i = glob($dir . "/*." . $filetype);
    }

    /**
     * Returns a file's size in a human-readable format, as opposed to it just being in bytes.
     *
     * @param mixed $size
     *            The number of bytes.
     * @param int $decimal
     *            Number of decimal places: default 2.
     * @return string The human filesize.
     * @since 2015-05-26
     */
    public static function human_filesize($size, $decimal = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($size) - 1) / 3);
        $type = @$sz[$factor];
        if ($type != "B") {
            $type = $type . "iB";
        }

        return sprintf("%.{$decimal}f ", $size / pow(1024, $factor)) . $type;
    }

    /**
     * Displays a torrent's basic info in table format.
     *
     * USED BY index.php AND search.php
     *
     * @param TorrentRW $t
     *            The torrent to display.
     * @since 2015-05-25
     *
     * @return string
     */
    public static function displayTorrent($t)
    {
        $torrent = new TorrentRW($t);

        return '<tr>
                    <td><a href="/torrent?id=' . $torrent->hash_info() . '">' . $torrent->name() . '</a></td>
                    <td>' . Functions::human_filesize($torrent->size()) . '</td>
                    <td><a href="' . $t . '"><span class="fa fa-fw fa-save"></span></a></td>
                    <td><a href="' . $torrent->magnet(true) . '"><span class="fa fa-magnet"></span></a></td>
                </tr>';
    }
}