<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>compress image</title>
</head>
<body>
  <?php
  if (isset($_POST['submit'])) {
    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $directory_name = 'upload/';
    $file_name = $directory_name.$image_name;
    move_uploaded_file($tmp_name, $file_name);

    $compress_file = "compress_".$image_name;
    $compressed_img = $directory_name.$compress_file;
    $compress_image = compressImage($file_name, $compressed_img);
    unlink($file_name);
  }

  function compressImage($source_image, $compress_image){
    $image_info = getimagesize($source_image);
    if ($image_info['mime']=='image/jpeg') {
      $source_image=imagecreatefromjpeg($source_image);
      // $exif = exif_read_data('upload/ori-adek-e-emak.JPG');
      // echo "<pre>";
      // var_dump($exif);die();
      // if ($source_image && $exif && isset($exif['Orientation']))
      // {
      //     $ort = $exif['Orientation'];

      //     if ($ort == 6 || $ort == 5)
      //         $source_image = imagerotate($source_image, 270, null);
      //     if ($ort == 3 || $ort == 4)
      //         $source_image = imagerotate($source_image, 180, null);
      //     if ($ort == 8 || $ort == 7)
      //         $source_image = imagerotate($source_image, 90, null);
      //     if ($ort == 5 || $ort == 4 || $ort == 7) 
      //         imageflip($source_image, IMG_FLIP_HORIZONTAL);
      // }
      imagejpeg($source_image, $compress_image,35);
    }
    elseif($image_info['mime']=='image/png'){
      $source_image=imagecreatefrompng($source_image);
      imagepng($source_image, $compress_image,9);
    }
    // return $compress_image;
  }
  ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" name="submit" value="upload">
  </form>
</body>
</html>