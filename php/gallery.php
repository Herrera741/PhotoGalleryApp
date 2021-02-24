<?php
    // $file = $_FILES['file-name']['name'];
    // $checkExt = preg_replace('/\.[^.\\/:*?"<>|\r\n]+$/','', $file);

    $allowedFiles = array("jpg", "png");
    $successExt = False;

    // Short variable names.
    $photoTitle = $_POST['photo-title'];
    $photoDate = $_POST['photo-date'];
    $photographer = $_POST['photographer'];
    $location = $_POST['location'];

    // Get the extension for the filename.
    $ext = pathinfo($_FILES['file-name']['name'], PATHINFO_EXTENSION);

    // Loop through $allowedFiles array to check if extension matches.
    for($i = 0; $i < count($allowedFiles); $i++) {
        if($ext == $allowedFiles[$i]) {
            $successExt = True;
            break;
        }
    }

    // Check mm/dd/yyyy format. $checkDate = 1(true) 0(false)
    $checkDate = preg_match("/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/", $photoDate);

    if(isset($_POST['submit']) && $successExt && $checkDate) {
        $outputstring = $photoTitle."\t".$photoDate."\t"
                       .$photographer."\t".$location."\n"; 
        @$fp = fopen("/home/davide/Desktop/PhotoGalleryApp-master/upload.txt", 'ab');
        if(!$fp) {
            echo("Photo Gallery could not be uploaded");
            exit;
        }
        flock($fp, LOCK_EX);
        fwrite($fp, $outputstring, strlen($outputstring));
        flock($fp, LOCK_UN);
        fclose($fp);
        echo("File has been open and written.");
        echo(ini_set('display_errors', 1));
        error_reporting(E_ALL);
    }
    else {
        echo("Error in uploading.");
        echo(ini_set('display_errors', 1));
        error_reporting(E_ALL);
    }
?>