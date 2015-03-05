<?php
$target_dir = "";
$target_file = "";
$uploadOk = 0;
$imageFileType = NULL;
$msg = "";

if (isset($_POST["xAccion"])) {
    if ($_POST["xAccion"] == "upload") {
        $target_dir = "../img/productos/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $msg.= "File is an image - " . $check["mime"] . ".\n";
            $uploadOk = 1;
        } else {
            $msg.= "File is not an image.\n";
            $uploadOk = 0;
        }

// Check if file already exists
        if (file_exists($target_file)) {
            $msg.= "Sorry, file already exists.\n";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $msg.= "Sorry, your file is too large.\n";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $msg.= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg.= "Sorry, your file was not uploaded.\n";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $msg.= "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.\n";
            } else {
                $msg.= "Sorry, there was an error uploading your file.\n";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <title>Subir imagen producto</title>
        <script>
            function subir()
            {
                if ($("#fileToUpload").val() != "")
                {
                    $("#xAccion").val("upload");
                    $("#frmUpload").submit();
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row" >
                <div class="col-sm-4">&nbsp;</div>
                <div class="col-sm-4">
                    <h3>Subir imagen del producto</h3>
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" id="frmUpload" name="frmUpload">
                        <div class="form-group">
                            <label for="fileToUpload">Seleccione imagen para subir:</label><input type="hidden" class="form-control" name="xAccion" id="xAccion" value="0" />
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" placeholder="Seleccione una imagen">
                        </div>
                        <button type="button" class="btn btn-default" id="btnGrabar" name="btnGrabar" onclick="subir();">Subir</button>
                    </form>
                    <br/>
                    <br/>
                    <div class="<?php echo($uploadOk != 0 ? "alert alert-success" : "alert alert-danger"); ?>" style="<?php echo($msg == "" ? "display:none;" : "display:block;"); ?>"><?php echo($msg); ?></div>
                </div>
                <div class="col-sm-4">&nbsp;</div>
            </div>
        </div>
    </body>
</html>
