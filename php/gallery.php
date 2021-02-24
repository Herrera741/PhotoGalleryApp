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

    if(isset($_POST['submit']) && $successExt) {
        $outputstring = $photoTitle."\t".$photoDate."\t"
                       .$photographer."\t".$location; 
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
    }
    else {
        echo("File extension is not allowed.");
    }
?>