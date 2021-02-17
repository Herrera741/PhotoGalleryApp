<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Album Gallery</title>
</head>
<body>
    <h1>Photo Album Uploader Gallery</h1>
    <h2>Upload Results</h2>
    <?php
        $target_dir = "uploads/";
        // create short variable names
        $photoTitle = $_POST['photoTitle'];
        $photoDate = $_POST['photoDate'];
        $photographer = $_POST['photographer'];
        $location = $_POST['location'];


        echo '<p>Photo uploaded successfully.</p>';
        echo htmlspecialchars($photoTitle).'<br/>';
        echo htmlspecialchars($photoDate).'<br/>';
        echo htmlspecialchars($photographer).'<br/>';
        echo htmlspecialchars($location).'<br/>';
    ?>
</body>
</html>