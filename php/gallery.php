<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Album Gallery</title>
</head>
<body>
    <?php
        // Allowed file extensions for PHP checking (not needed for assignment but still use for now).
        // Automatically set extension boolean to false until extension is valid.
        $allowedFiles = array("jpg", "png", "jpeg", "gif");
        $successExt = False;
        $mainArray = array();

        // Short variable names.
        $photoTitle = $_POST['photo-title'];
        $photoDate = $_POST['photo-date'];
        $photographer = $_POST['photographer'];
        $location = $_POST['location'];
        $fileName = $_FILES['file-name']['name'];

        // Get the extension for the filename.
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        // Loop through $allowedFiles array to check if extension matches.
        for($i = 0; $i < count($allowedFiles); $i++) {
            if($ext == $allowedFiles[$i]) {
                $successExt = True;
                break;
            }
        }

        // Check mm/dd/yyyy format. $checkDate = 1(true) 0(false).
        $checkDate = preg_match("/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/", $photoDate);
        
        // Validation from submitting upload.
        if(isset($_POST['submit']) && $successExt && $checkDate) {
            $outputstring = $photoTitle."\t".$photoDate."\t"
                        .$photographer."\t".$location."\t".$fileName."\n"; 

            // Writing and reading upload.txt file (hardcoded for now).
            @$fp = fopen("/home/davide/Desktop/PhotoGalleryApp-master/upload.txt", 'ab');
            if(!$fp) {
                echo("Photo Gallery could not be uploaded");
                exit;
            }
            flock($fp, LOCK_EX);
            fwrite($fp, $outputstring, strlen($outputstring));
            flock($fp, LOCK_UN);
            fclose($fp);

            // Send upload.txt to smaller array for splitting.
            // Spliting uploaded.txt by columns. 0: name, 1: date, 2: photographer, 3: location, 4: file.
            $uploads = file("/home/davide/Desktop/PhotoGalleryApp-master/upload.txt");
            $numberOfUploads = count($uploads);
            if($numberOfUploads == 0) {
                echo("No pending uploads\n");
            }

            for($i = 0; $i < $numberOfUploads; $i++) {
                $explodeUploads = explode("\t", $uploads[$i]);
                array_push($mainArray, $explodeUploads[$i]);
            }
            echo(count($mainArray));
        }
        else {
            echo("Error in uploading");
            echo(ini_set('display_errors', 1));
            error_reporting(E_ALL);
        }
    ?>
    <p>
    Sort By:
    <div class="dropdown-menu">
        <select id="dropdown" name="form-sort">
            <option value="0">Name</option>
            <option value="1">Date</option>
            <option value="2">Photographer</option>
            <option value="3">Location</option>
        </select>
    </div>
    <div class="back-field">
        <button type="button" id="back-btn" onclick="history.go(-1);">Upload Photo</button>
    </div>
    </p>
    <?php
        function compare($x, $y) {
            if ($x == $y) { return 0; }
            return ($x < $y) ? -1 : 1;
        }
        $formSort = $_POST['form-sort'];
        switch($formSort) {
            case "0": usort($explodeUploads[0], 'compare');
            case "1": usort($explodeUploads[1], 'compare');
            case "2": usort($explodeUploads[2], 'compare');
            case "3": usort($explodeUploads[3], 'compare');
        }
        echo($formSort);
    ?>
</body>
</html>