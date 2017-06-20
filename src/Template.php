<?php

namespace nickschlobohm\Flatfoot;

class Template
{
    public static function include ($sPath)
    {
        $sTemplateFile = '../templates' . $sPath . '.php';
        if (file_exists($sTemplateFile)) {
            include $sTemplateFile;
            return true;
        }

        return false;
    }

    public static function header()
    {
        return '<!DOCTYPE html>
<html>
<head>
<title>flatfoot</title>
<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/font-awesome.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
<div class="page-header">
    <h1>flatfoot</h1>
</div>';
    }

    public static function footer()
    {
        return '<div class="text-center">
	<p class="text-muted">
		flatfoot &mdash; ' . Config::VERSION . '
		<br> by <a href="http://github.com/nickschlobohm">Nick Schlobohm</a>
	</p>
</div>
</div>
</body>
</html>';
    }

    public static function nav($bIsTorrent = false)
    {
        $sResponse = '<div class="form-group"><ul class="nav nav-pills">';
        foreach (['Home' => '/index', 'Search' => '/search'] as $item => $value) {
            $sClass = '';
            if (Config::$sRequestPath == $value) {
                $sClass = 'active';
            }
            $sResponse .= '<li class="' . $sClass . '"><a href="' . $value . '">' . $item . '</a></li>';
        }
        if ($bIsTorrent) {
            $sResponse .= '<li class="active"><a>Torrent</a></li>';
        }
        $sResponse .= '</ul></div>';

        return $sResponse;
    }

    public static function renderTorrentTable($aTorrentsArray)
    {
        $sResponse = '<div class="form-group">
    <table class="table table-bordered">
        <tr>
            <th>Torrent name</th>
            <th>Torrent size</th>
            <th>Download</th>
            <th>Magnet link</th>
        </tr>';

        foreach ($aTorrentsArray as $item) {
            $sResponse .= Functions::displayTorrent($item);
        }
        $sResponse .= '
    </table>
</div>';

        return $sResponse;
    }
}