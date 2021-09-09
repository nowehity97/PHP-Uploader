<!--- DO NOT TOUCH IF YOU DOO'T HAVE EXPERIENCE WITH PHP --->
<html style="height:100%">
  <?php

    require_once __DIR__ . '/protected/main.php';
    error_reporting(0);
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "on" ? "https" : "http" . "://";
    $fileurl = $protocol . domain . images . "/$hash.$type";

    function human_filesize($bytes, $decimals) {
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    $files = scandir(images . '/');

    if (isset($_GET["f"])) {

      $string = $_GET["f"];
      $type = strrchr($string, '.');
      $type = str_replace(".","",$type);

      foreach ($files as $file) {
        if ($file == $_GET["f"]) {

          $filesize = human_filesize(filesize(images . "/" . $_GET["f"]), 2);
          ?>

<head>
    <link rel="stylesheet" href="https://cdn.clynt.de/sharx/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.0.2/dist/css/bootstrap-night.min.css" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
              <title><?php echo $_GET["f"]; ?></title>
              <meta name='og:site_name' content='<?php echo toptitle; ?>'>
              <?php if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg"): ?>
                <meta name='twitter:card' content='photo'>
                <meta name='twitter:title' content='<?php echo $_GET["f"]; ?> (<?php echo $filesize; ?>)'>
                <meta name='twitter:image' content='<?php echo $protocol .  domain . "/" . images. "/" . $_GET["f"]; ?>'>
              <?php elseif ($type == "mp4" || $type == "webm"): ?>
                <meta name='twitter:card' content='player'>
                <meta name='twitter:title' content='<?php echo $_GET["f"]; ?> (<?php echo $filesize; ?>)'>
                <meta name='twitter:player' content='<?php echo $protocol .  domain . "/" . images. "/" . $_GET["f"]; ?>'>
                <meta name='twitter:player:width' content='1280'>
                <meta name='twitter:player:height' content='720'>
              <?php else: ?>
                <meta name='twitter:card' content='suummary_large_image'>
                <meta name='twitter:title' content='<?php echo title; ?> (<?php echo $filesize; ?>)'>
              <?php endif; ?>
              <meta name='theme-color' content='<?php echo color; ?>'.
            </head>
            <body>
            <div class="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
        <nav class="uk-navbar-container uk-margin" uk-navbar="mode: click">
            <div class="uk-navbar-left">
                <a href="/" class="uk-navbar-item uk-logo">
                <?php echo name ?></a>
                <ul class="uk-navbar-nav">
                    <li><a href="index.php">Home</a></li>
                </ul>
            </div>
        </nav>
              <div class="content"><br><br><br><br>
		
                <center>
                <div class="d-flex justify-content-center align-items-center">
        <div class="card text-center">
<h1 class="subtitle"><?php echo $_GET["f"]; ?></h1>
                  <?php if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg"): ?>
                    <img src='<?php echo $protocol . domain . "/" . images. "/" . $_GET["f"]; ?>'></img>
                    <a class="btn btn-primary" href="<?php echo $protocol . domain . "/" . images. "/" . $_GET["f"]; ?>"download>Download</a>
                  <?php elseif ($type == "mp4" || $type == "webm"): ?>
                    <video controls>
                      <source src='<?php echo $protocol . domain . "/" . images. "/" . $_GET["f"]; ?>'>
                    </video>
                    <a class="btn btn-primary" href="<?php echo $protocol . domain . "/" . images. "/" . $_GET["f"]; ?>"download>Download</a>
                  <?php elseif ($type == "mp3" || $type == "ogg"): ?>
                    <audio controls>
                      <source src='<?php echo $protocol . domain . "/" . images. "/" . $_GET["f"]; ?>'>
                    </audio>
                    <a class="btn btn-primary" href="<?php echo $protocol . domain . "/" . images. "/" . $_GET["f"]; ?>"download>Download</a>
                  <?php else: ?>
                    <a class="btn btn-primary" href="<?php echo $protocol . domain . "/" . images. "/" . $_GET["f"]; ?>"download>Download</a>
                  <?php endif; ?>                  
                </center>
              </div>
                  </body>
          <?php
        }
      }
    } else { ?>

<!------ Here you can paste your website ----->
<!------ If you nee any CSS examples check cdn.psyro.e ---->
<DOCTYPE html>
<meta charset="utf-8">
<head>
  <title> Yeah uploader shit  </title>
</head>

<body>
<h1>Example Header</h1>
</body>

    <!--- Do not touch this okay? --->
    <?php }
  ?>
</html>