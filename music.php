<?php
# Init Array
$files = array();

#URL of the jsdelivr
$cdn = $_ENV['CDN_ADDR'];

# Get Folder
if(isset($_GET['game']) && $_GET['game']='ys') {
    $folder = '/music/ys/';
}else {
    # Set Default Folder
    $folder = '/music/bh3/';
}

# Set Full Path
$path = $_SERVER['DOCUMENT_ROOT'] . '/' . $folder;
# Open Directory
if($handle = opendir($path)) {
# Loop Through Directory
    while(false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            if(substr($file, -3) == 'ogg') $files[count($files)] = $file;
        }
    }
}
# Close Handle
closedir($handle);
# Init Random
$random = rand(0, count($files)-1);
#Generate the URL
if(isset($_GET['cdn']) && $_GET['cdn']='false') {
    header("Location:".$folder.$files[$random]);
} else {
    header("Location:".$cdn.$folder.$files[$random]);
}
