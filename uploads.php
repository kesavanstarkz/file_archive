<?php
if (isset($_POST["submit"])) {
    $extensions_data = array("pdf", "docx", "jpeg", "jpg", "png");
    $upload_dir = "uploads/"; // Define upload directory

    if (empty($_FILES["file"]["name"])) {
        echo "Error: No file uploaded.";
    } else {
        if ($_FILES["file"]["size"] <= 5000000) { // 5MB limit
            echo "File name: " . $_FILES["file"]["name"] . "<br>";
            $file_name = basename($_FILES["file"]["name"]);
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            echo "File extension: " . $file_extension . "<br>";

            // Check if the extension is allowed
            if (in_array($file_extension, $extensions_data)) {
                // Generate a unique file name to avoid overwriting
                $target_file = $upload_dir . uniqid() . "_" . $file_name;

                // Check if the directory exists, if not create it
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                // Check if the file already exists in the target directory
                if (file_exists($target_file)) {
                    echo "Error: File already exists.";
                } else {
                    // Move the uploaded file
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                        echo "File uploaded successfully.";
                    } else {
                        echo "Error: File couldn't be uploaded.";
                    }
                }
            } else {
                echo "Error: Extension doesn't match.";
            }
        } else {
            echo "Error: File size exceeds 5MB.";
        }
    }
}
?>
