<?php
session_start();

$message = isset($_SESSION["msg"]) ? htmlspecialchars($_SESSION["msg"]) : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>File Archive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="text-center container-md m-5">
    <h1 class="text-success">FILE ARCHIVE</h1>
    <h3>Import file which has proper extension</h3>
    <center>
        <form action="uploads.php" method="post" enctype="multipart/form-data" class="mb-3 w-50">
            <div class="p-2">File should be less than 5MB and should have proper extensions such as [.pdf, .png, .jpeg]</div>
            <div class="d-flex gap-2">
                <input class="form-control" type="file" name="file" id="DefaultFile" />
                <input class="btn btn-success" type="submit" name="submit" value="Upload">
            </div>
        </form>
    </center>
    
    <?php
    if (!empty($message)) {
      if ($message=="File uploaded successfully."){
        echo '<div class="text-success">' . $message . '</div>';
        unset($_SESSION["msg"]);
      } else {
        echo '<div class="text-danger">' . $message . '</div>';
        unset($_SESSION["msg"]);
      }
        
    }
    ?>
</body>
</html>
