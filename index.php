<?php
 //Connect to the database
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "image";
  $con = mysqli_connect($servername,$username,$password,$database);
    if (!$con) {
        echo "not Connected";
    }

    if (isset($_POST['upload'])) {
       $file = $_FILES['image']['name'];
      
         $sql = "INSERT INTO `upload` (`image`) VALUES ('$file')";
         $result = mysqli_query($con, $sql);

       
       if ($result) {
          move_uploaded_file($_FILES['image']['tmp_name'], $file);
       }

    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload in Php</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>

   <div class="container">
      <div class="col-md-12">
         <div class="rows">
            <div class="col-md-6">
               <h3 class="text-center my-4">Upload Image</h3>
               <form class="my-5" method="post" enctype="multipart/form-data">
                  <input type="file" name="image" class="form-control">
                  <input type="submit" name="upload" value="Upload" class="btn btn-primary my-4">
               </form>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">Display Image</h3>

                <?php
                   $sql = "SELECT * FROM upload";
                    $res = mysqli_query($con, $sql);
                    $output ="";

                    
                    if (mysqli_num_rows($res) < 1) {
                      $output .= "<h3 class='text-center'>No Image Uploaded</h3>";
                    }

                  
                        while ($row = mysqli_fetch_assoc($res)) {
                           if (strlen($row['image']) > 0) {
                              $output .= '<img src="'.$row['image'].'" alt="image" class="m-3" style="width:190px; height: 140px;">';
                           }
                        }
                        echo  $output;
                ?>
                
            </div>
         </div>    
      </div>
   </div>

   
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>