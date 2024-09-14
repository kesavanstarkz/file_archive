<?php
session_start();
if (!isset($_SESSION["msg"])) {
    $_SESSION["msg"] = "";
}

if (isset($_POST["submit"])) {
    $extensions_data = array("pdf", "docx", "jpeg", "jpg", "png");
    $upload_dir = "uploads/";

    if (empty($_FILES["file"]["name"])) {
        $_SESSION["msg"] = "Error: No file uploaded.";
        header("Location: script.php");
        exit();
    }

    $file_size = $_FILES["file"]["size"];
    $file_name = basename($_FILES["file"]["name"]);
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $target_file = $upload_dir . $file_name;

    if ($file_size > 5000000) { 
        $_SESSION["msg"] = "Error: File size exceeds 5MB.";
        header("Location: script.php");
        exit();
    }

    if (!in_array($file_extension, $extensions_data)) {
        $_SESSION["msg"] = "Error: Extension '$file_extension' is not allowed.";
        header("Location: script.php");
        exit();
    }

    $file_name = preg_replace("/[^a-zA-Z0-9._-]/", "", $file_name);
    $target_file = $upload_dir . $file_name;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if (file_exists($target_file)) {
        $_SESSION["msg"] = "Error: File already exists.";
        header("Location: script.php");
        exit();
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $_SESSION["msg"] = "File uploaded successfully.";
    } else {
        $_SESSION["msg"] = "Error: File couldn't be uploaded.";
    }

    header("Location: script.php");
    exit();
} else {
    $_SESSION["msg"] = "Error: No file uploaded.";
    header("Location: script.php");
    exit();
}
?>
