<?php
if(isset($_POST["Update"])){
  $new_first=$_POST["first_name"];
  $new_last=$_POST["last_name"];
  $new_email=$_POST["email"];
  $roll_number=$_POST["roll_number"];
  $file=fopen("B200845CS_final.csv","r");
   $flag=false;
  while(($data=fgetcsv($file))!==false){
            if($data[2]==$roll_number){
              $flag=true;
            }

  }
  fclose($file);
  if($flag==false){
    echo "Student Record Not Found";
  }
  else{
  $file=fopen("B200845CS_final.csv","r");
  $a=array();
  while(($data=fgetcsv($file))!==false){
            array_push($a,$data);
            }
  fclose($file);
  $len=count($a);
  for($b=0;$b<$len;$b++){
    if($a[$b][2]==$roll_number){
      if(!empty($_POST["first_name"])){
      $a[$b][0]=$new_first;
      }
      if(!empty($_POST["last_name"])){
      $a[$b][1]=$new_last;
      }
      if(!empty($_POST["email"])){
      $a[$b][3]=$new_email;
      }
    }
  }
  $file=fopen("B200845CS_final.csv","w");
  for($b=0;$b<$len;$b++){
    fputcsv($file, $a[$b]);
  }
  fclose($file);
  }
}
 ?>
 <?php
 if(isset($_POST["Delete"])){
  /* $new_first=$_POST["first_name"];
   $new_last=$_POST["last_name"];
   $new_email=$_POST["email"]; */
   $roll_number=$_POST["roll_number"];
   $file=fopen("B200845CS_final.csv","r");
   $a=array();
   $flag=false;
   while(($data=fgetcsv($file))!==false){
              if($data[2]==$roll_number){
                $flag=true;
                continue;
              }
             array_push($a,$data);
             }
   fclose($file);
   $len=count($a);
   /*
   for($b=0;$b<$len;$b++){
     if($a[$b][2]==$roll_number){
       $a[$b][0]=$new_first;
       $a[$b][1]=$new_last;
       $a[$b][3]=$new_email;
     }
   } */
   if($flag==false){
     echo "No Record Found!";
   }
   else{
   $file=fopen("B200845CS_final.csv","w");
   for($b=0;$b<$len;$b++){
     fputcsv($file, $a[$b]);
   }
   fclose($file);
   }
 }
  ?>



<?php
    $first_name="";
    $last_name="";
    $roll_number="";
    $email="";
    if(empty($_POST["roll_number"]) && (!isset($_POST["Display"])) && isset($_POST["Insert"])){
      echo "Please Enter the Details!";
    }
  if(isset($_POST["Insert"]) && (!empty($_POST["roll_number"]))){
    $roll=$_POST["roll_number"];
    $file=fopen("B200845CS_final.csv","r");
    $flag=false;
    while(($data=fgetcsv($file))!==false){
              if($data[2]==$roll){
                $flag=true;
              }

    }
    if($flag==true){
      echo "Student Record Already Exist!";
    }
    else{
    fclose($file);
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $roll_number=$_POST["roll_number"];
    $email=$_POST["email"];

  $file_open = fopen("B200845CS_final.csv", "a");
  $form_data = array($first_name,$last_name,$roll_number,$email);

  fputcsv($file_open, $form_data);
  $form_data="";
  $first_name="";
  $last_name="";
  $roll_number="";
  $email="";
}
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>exercise 1</title>
    <style media="screen">
    label{
        width: 100px;
        display: inline-block;
        text-align: justify;
          }
        body{
          text-align: center;
        }
      input{
        margin-bottom: 8px;
      }
      h3{
        margin-bottom: 7px;
      }

    </style>
  </head>
  <body>
    <!-- <h1>Enter Student Details</h1> -->
    <h3 align="center">Enter Student Details</h3>
    <form class="" action="B200845CS_final.php" method="post">
      <label for="first_name">First Name:</label>
      <input id="first_name" type="text" name="first_name" value=""><br>
      <label for="last_name">Last Name:</label>
      <input id="last_name" type="text" name="last_name" value=""><br>
      <label for="roll_number">Roll Number:</label>
      <input id="roll_number" type="text" name="roll_number" value=""><br>
      <label for="email">Email:</label>
      <input id="email" type="email" name=email value=""><br>
      <input type="submit" name="Insert" value="Insert">
      <input type="submit" name="Delete" value="Delete">
      <input type="submit" name="Search" value="Search">
      <input type="submit" name="Update" value="Update">
      <input type="submit" name="Display" value="Display">
      <?php
      echo "<br>";
      if(isset($_POST["Display"])){
        $file=fopen("B200845CS_final.csv","r");
        $a = 1;
        echo "<br><br>";
        echo "<table style="."margin-left:auto;margin-right:auto;"." border=".$a.">
          <tr>
            <td margin-left:100px margin-right:auto><strong>First Name</strong></td>
            <td><strong>Last Name</strong></td>
            <td><strong>Roll Number</strong></td>
            <td><strong>Email</strong></td>
          </tr>";
        while(($data=fgetcsv($file))!==false){
                  echo "<tr>";
                  foreach ($data as $i) {
                     echo "<td>$i</td>";
                  }
                  echo "</tr>";
        }
        echo "</table>";
        fclose($file);
      }
       ?>
       <?php
      if(isset($_POST["Search"])){
        $roll=$_POST["roll_number"];
        $file=fopen("B200845CS_final.csv","r");
        $flag=false;
        while(($data=fgetcsv($file))!==false){
                  if($data[2]==$roll){
                    $flag=true;
                    $b = 1;
                    echo "<table style="."margin-left:auto;margin-right:auto;"." border=".$b.">
                      <tr>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Roll Number</td>
                        <td>Email</td>
                      </tr>
                      <tr>
                        <td>".$data[0]."</td>
                        <td>".$data[1]."</td>
                        <td>".$data[2]."</td>
                        <td>".$data[3]."</td>
                      </tr>";
                    // echo $data[0]." ".$data[1]." ".$data[2]." ".$data[3];
                    echo "<br>";
                  }

        }
        if($flag==false){
          echo "Student details not found";
        }
        fclose($file);
      }
        ?>

    </form>
  </body>
</html>
