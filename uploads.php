<?php
if (isset($_POST["submit"])) {
    $extensions_data = array("pdf", "docx", "jpeg", "jpg", "png");
    if (empty($_FILES["file"]["name"])) {
        echo "Error: No file uploaded.";
    } else {
        if ($_FILES["file"]["size"] <= 500000) {
            echo "File name: " . $_FILES["file"]["name"] . "<br>";
            $file_name = $_FILES["file"]["name"];
            $file_extension = explode(".", $file_name);
            $extension = end($file_extension);
            echo "File extension: " . $extension . "<br>";

            $extension_matched = false;
            for ($i = 0; $i < count($extensions_data); $i++) {
                if ($extensions_data[$i] == $extension) {
                    $extension_matched = true;
                    break;
                }
            }

            if ($extension_matched) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"],$file_name)) {
                    
                    if (file_exists($file_name)){
                        echo "File already exists";
                    } else {
                        echo "File uploaded...";
                    }
                } else {
                    echo "File doesn't uploaded";
                }
            } else {
                echo "Extension doesn't match";
            }
        } else {
            echo "File size exceeds 500KB.";
        }
    }
}
?>
