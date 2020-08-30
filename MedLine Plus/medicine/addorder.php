<!DOCTYPE html>
<html>
  <head>
    <?php require("../partials/meta.php");?>
  </head>
  <?php
  require("../auth/db.php");
//  require("./auth/authlogout.php");
  if(isset($_POST['submit']))
  {
    extract($_POST);
    $currentDir = getcwd();
    chdir('../Images/products/');
          $check=1;
          while($check==1)
          {
            $id=rand(1,9999);
            $id="CPP".$id;
            $que="SELECT * from `orders` where ID='$id'";
            $result=mysqli_query($con,$que);
            if(mysqli_num_rows($result)==0)
            {
              $check=0;
            }
            else {
              $check=1;
            }
          }
    //      $didUpload=move_uploaded_file($_FILES["myfile"]["tmp_name"], $uploadPath.$id.'.'.$fileExtension);
    //      if ($didUpload) {
              $err=0;
              $featured=0;
              $barcode=$salt*$barcode;
              $query = "INSERT INTO `orders` values('$id','$name','$brand','$salt','$disease','$barcode','$category')";
              if(mysqli_query($con,$query))
              {
                $err=0;
              }
              else {
                $err=1;
              }
                //echo "DONE";

        //    }


        chdir('../../medicine/');
    $name=$_POST['name'];

  }
  ?>
  <body>
    <?php
    require("./partials/navbarhome.php");
    ?>
    <div class="mywrapper">
      <?php
      require("./partials/sidebar.php");
      ?>
      <div class="main-panel">
        <div class="container">
          <h3 style="padding-bottom:20px; padding-top:40px">Add Order</h3>
          <button class="mybtn btn-blue" onclick="location.href='./vieworder.php'">Manage Orders</button>
          <?php
          if(isset($err))
          {
            if($err==0)
            {
              echo "Updated Successfully";
            }
            else {
              echo "Could not be updated";
            }
            unset($err);
          }
          ?>
          <form class="myloginform1" method="post" action="" enctype="multipart/form-data" style=" position:relative;display:flex; flex-wrap: wrap; justify-content:center; text-align:center;">
            <div class="myformgroup1" style="flex:0 0 45%; margin-right:10px;">
              <input class="myformcontrol1" type="text" name="name" placeholder="Name" required/>
            </div>
            <div class="myformgroup1" style="flex:0 0 45%; margin-right:10px;">
              <select class="myformcontrol1" name="brand">
                <?php
                $query="SELECT * from `medbrands` ORDER BY Name";
                $result = mysqli_query($con,$query) or die(mysql_error());
                $rows = mysqli_num_rows($result);
                while($record=mysqli_fetch_assoc($result))
                {
                  echo "<option value='$record[ID]'>
                  $record[Name]
                  </option>";
                }
                ?>
              </select>
            </div>
            <div class="myformgroup1" style="flex:0 0 45%; margin-right:10px;">
              <input class="myformcontrol1" type="text" name="salt" placeholder="price" required/>
            </div>
            <div class="myformgroup1" style="flex:0 0 45%; margin-right:10px;">
              <input class="myformcontrol1" type="text" name="disease" placeholder="Disease" required/>
            </div>
            <div class="myformgroup1" style="flex:0 0 45%; margin-right:10px;">
              <input class="myformcontrol1" type="text" name="barcode" placeholder="Qty" required/>
            </div>
            <div class="myformgroup1" style="flex:0 0 45%; margin-right:10px;">
              <select class="myformcontrol1" name="category">
                <?php
                $query="SELECT * from `medicinecategory` ORDER BY Category";
                $result = mysqli_query($con,$query) or die(mysql_error());
                $rows = mysqli_num_rows($result);
                while($record=mysqli_fetch_assoc($result))
                {
                  echo "<option value='$record[ID]'>
                  $record[Category]
                  </option>";
                }
                ?>
              </select>
            </div>


            <div class="myformgroup1" style="flex:0 0 100%; margin-right:10px; text-align:center;">
              <button style="" type="submit" name="submit" class="btn">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
