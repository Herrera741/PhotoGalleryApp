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
        $allowedFiles = array("jpg", "png", "jpeg", "gif");
        $successExt = False;

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

            @$fp = fopen("/home/davide/Desktop/PhotoGalleryApp-master/upload.txt", 'rb');
            if (!$fp) {
                echo "<p><strong>No orders pending.<br />
                      Please try again later.</strong></p>";
                exit;
            }
        
            while (!feof($fp)) {
                $order = fgets($fp);
                echo htmlspecialchars($order)."<br />";
            }
        
            flock($fp, LOCK_UN); // release read lock
            fclose($fp);

            echo(ini_set('display_errors', 1));
            error_reporting(E_ALL);
        }
        else {
            echo("Error in uploading");
            echo(ini_set('display_errors', 1));
            error_reporting(E_ALL);
        }
    ?>
    <div class="back-field">
        <button type="button" id="back-btn" onclick="history.go(-1);">Upload Photo</button>
    </div>
</body>
</html>