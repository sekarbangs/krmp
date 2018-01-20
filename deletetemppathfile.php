<?php
$folderName = $_SERVER['DOCUMENT_ROOT'].'/temp_path/';
if (file_exists($folderName)) {
    foreach (new DirectoryIterator($folderName) as $fileInfo) {
        if ($fileInfo->isDot()) {
        	continue;
        }
        if (time() - $fileInfo->getCTime() >= 5*60) {
            unlink($fileInfo->getRealPath());
        }
    }
}
?>