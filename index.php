<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $file = $_FILES["file"];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Check if file is a valid JPEG or PNG image
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($file['type'], $allowedTypes)) {
        die("Invalid file type. Only JPEG and PNG images are allowed.");
    }

    // Generate a unique filename to prevent overwriting
    $targetDir = 'uploads/';
    $targetFile = $targetDir . uniqid() . '_' . basename($file['name']);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <h1>File Upload</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="file">Upload Image (JPEG or PNG only):</label>
        <input type="file" id="file" name="file" accept=".jpeg, .jpg, .png" required><br>
        
        <button type="submit">Upload</button>
    </form>
</body>
</html>

