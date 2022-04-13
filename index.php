<?php
    require("vendor/autoload.php");
    use Zxing\QrReader;

    $msg = "";
    if(isset($_POST['upload'])){
        $file_name = $_FILES["qrCode"]["name"];
        $file_type = $_FILES["qrCode"]["type"];
        $file_tmp_name = $_FILES["qrCode"]["tmp_name"];
        $file_size = $_FILES["qrCode"]["size"];

        $file_type = explode("/", $file_type);

        if($file_type[0] !== "image"){
            $msg = "File type is invalid: " . $file_type[1];
        } else if($file_size > 5242880){
            $msg = "File size is too big. Maximum size is 5 MB.";
        } else{
            $new_file_name = md5(rand() . time()) . $file_name;
            move_uploaded_file($file_tmp_name, "uploads/" . $new_file_name);

            $qrcode = new QrReader('uploads/' . $new_file_name);
            $msg = "QR code result: " . $qrcode->text(); //return decoded text from QR Code
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>QR Code Scanner</title>
  </head>
  <body class="bg-light">
      <div class="container py-5">
          <div class="row">
              <div class="col-lg-5 mx-auto">
                  <div class="card card-body p-5 rounded border bg-white">
                      <h1 class="mb-4 text-center">QR Code Scanner</h1>
                      <?php echo $msg; ?>
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="qrCode" class="form-label">Upload File input</label>
                            <input type="file" class="form-control" accept="image/*" name="qrCode" id="qrCode">
                        </div>
                        <button type="submit" name="upload" class="btn btn-primary">
                            Scan
                        </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>