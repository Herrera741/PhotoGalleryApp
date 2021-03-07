<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Album Gallery</title>
    <link rel="stylesheet" href="/css/server-style.css">
</head>

<body>
    <?php
        $mainArray = array();
        // $filePath = "/home/davide/Desktop/PhotoGalleryApp-php-w-frontend/upload.txt";
        $filePath = "D:/Projects Workspace/Class Projects/CPSC 431/Assignment-1/PhotoGalleryApp/upload.txt";
        $uploadsPath = "D:/Projects Workspace/Class Projects/CPSC 431/Assignment-1/PhotoGalleryApp/uploads/";

        // Short variable names.
        $photoTitle = $_POST['photoTitle'];
        $photoDate = $_POST['photoDate'];
        $photographer = $_POST['photographer'];
        $location = $_POST['location'];
        $fileName = $_FILES['uploadFile']['name'];
        
        // Validation from submitting upload.
        if(isset($_POST['submit'])) {

            // add image to image directory
            $img = $_FILES['uploadFile']['name'];
            $img_loc = $_FILES['uploadFile']['tmp_name'];
            move_uploaded_file($img_loc, $uploadsPath.$img);



            $outputstring = $photoTitle."\t".$photoDate."\t"
                        .$photographer."\t".$location."\t".$fileName."\n"; 

            // Writing and reading upload.txt file (hardcoded for now).
            @$fp = fopen($filePath, 'ab');
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
            $uploads = file($filePath);
            $numberOfUploads = count($uploads);
            if($numberOfUploads == 0) { echo("No pending uploads\n"); }

            for($i = 0; $i < $numberOfUploads; $i++) {
                $explodeUploads = explode("\t", $uploads[$i]);
                array_push($mainArray, $explodeUploads);
            }
        }
        else {
            echo("Error in uploading");
            echo(ini_set('display_errors', 1));
            error_reporting(E_ALL);
        }
    ?>
    <div id="overlay"></div>
    <h1>View All Photos</h1>
    <div id="header-container">
        <div id="sort-upload-container">
            <div id="form-container">
                <h2>Sort By:</h2>
                <form method="post" action="#" id="form">
                    <div id="dropdown" name="form-sort">
                        <select name="state" onchange="this.form.submit();">
                            <option value="0">Name</option>
                            <option value="1">Date</option>
                            <option value="2">Photographer</option>
                            <option value="3">Location</option>
                        </select>
                    </div>
                </form>
            </div>
            <div id="back-field">
                <button type="button" id="back-btn" onclick="history.go(-1);">Upload Photo</button>
            </div>
        </div>
    </div>
    <div id="body-content">    
    <?php
        // Sorting function that takes the array and array position to sort.
        function sorting($arrayName, $key) {
            foreach($arrayName as $k => $v) { $b[] = strtolower($v[$key]); }
            asort($b);
            foreach($b as $k => $v) { $c[] = $arrayName[$k]; }
            return $c;
        }

        $formSort = $_POST['form-sort'];
        switch($formSort) {
            case "0": sorting($mainArray, 0);
            case "1": sorting($mainArray, 1);
            case "2": sorting($mainArray, 2);
            case "3": sorting($mainArray, 3);
        }

        function display($arrayName) {
            foreach ($arrayName as &$record) {
                echo "<div class='image-record'>
                        <img src='../uploads/$record[4]'><br>
                        <p>$record[0]<br>$record[1]<br>$record[3]<br>$record[2]</p>
                    </div>";
            }
        } 

        display($mainArray);
    ?>
    </div>
</body>
</html>