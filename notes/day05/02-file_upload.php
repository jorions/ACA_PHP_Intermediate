<form action="<?php echo($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
    <input type="text" name="profileName" />
    <input type="file" name="avatar" />
    <input type="submit" value="Upload Picture" />
</form>

<?php

// For safety make sure the file uploaded is an image
if($_FILES['avatar']['type'] != "image/jpeg") {
    die('You can only upload jpegs');
}



// getcwd() stands for Get Current Working Directory and prints the relative filepath
// move_uploaded_file will take the temporarily stored uploaded file and moves it to the specified path

// The "tmp_name" and "name" references are pointing to the keys created by the $_FILES array
if(move_uploaded_file($_FILES['avatar']['tmp_name'], getcwd() . '/' . $_FILES['avatar']['name'])) {
    echo '<img src="'.$_FILES['avatar']['name'].'"/>';
} else {
    echo 'File has not moved';
}

// You can access files from a submitted form
echo '<pre>';
echo 'Files:';
print_r($_FILES);

echo "<br />";

echo 'POST:';
print_r($_POST);