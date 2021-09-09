<?php

/**
 * A simple function that uses mtime to delete files older than a given age (in seconds)
 * Very handy to rotate backup or log files, for example...
 * 
 * $dir String whhere the files are
 * $max_age Int in seconds
 * return String[] the list of deleted files
 * 
 * Code by hithub.com/tdebatty
 * https://gist.githubusercontent.com/tdebatty/9412259/raw/1b8a308cffddc93d57ee5fdb32e94f8b0dd826a6/delete_older_than.php
 */

function delete_older_than($dir, $max_age) {
  $list = array();
  
  $limit = time() - $max_age;
  
  $dir = realpath($dir);
  
  if (!is_dir($dir)) {
    return;
  }
  
  $dh = opendir($dir);
  if ($dh === false) {
    return;
  }
  
  while (($file = readdir($dh)) !== false) {
    $file = $dir . '/' . $file;
    if (!is_file($file)) {
      continue;
    }
    
    if (filemtime($file) < $limit) {
      $list[] = $file;
      unlink($file);
    }
    
  }
  closedir($dh);
  return $list;

}


// An example of how to use:
$dir = "/my/backups";
$to = "my@email.com";

// Delete backups older than 7 days
$deleted = delete_older_than($dir, 3600*24*7);

$txt = "Deleted " . count($deleted) . " old backup(s):\n" .
    implode("\n", $deleted);

mail($to, "Backups cleanup", $txt);
