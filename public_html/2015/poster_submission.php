<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    header("Location: http://geomundus.org/submissions.html?option='Sorry, file already exists.'");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    header("Location: http://geomundus.org/submissions.html?option='Sorry, your file is too large.'");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "pdf" && $imageFileType != "zip" ) {
    echo "Sorry, only PDF and ZIP files are allowed.";
    header("Location: http://geomundus.org/submissions.html?option='Sorry, only PDF, DOC and ZIP files are allowed.'");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    //header("Location: http://geomundus.org/submissions.html?option='Sorry, your file was not uploaded. Please, contact with us.'");

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        // send an email
        // goto to success page
        $name = $_POST["InputName"];
        $email = $_POST["InputEmail"];

        $to      = 'agilescura@gmail.com';
		$to1      = 'galvaobrasil@gmail.com';
		$to2      = 'calia@uji.es';
        $subject = 'Poster Submission';
        $message = 'Someone upload a Poster Submission. Check in the ftp.';
        $headers = 'From: webmaster@example.com' . "\r\n" .
          'Reply-To: webmaster@example.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $message, $headers);
		  mail($to1, $subject, $message, $headers);
		  mail($to2, $subject, $message, $headers);
          header("Location: http://geomundus.org/submissions.html?option='The file has been uploaded.'");
		  echo "<script>alert('File successfully uploaded.');</script>";
    } else {
        echo "Sorry, there was an error uploading your file.";
        header("Location: http://geomundus.org/submissions.html?option='Sorry, there was an error uploading your file.. Please, contact with us.'");
    }
}
?>
