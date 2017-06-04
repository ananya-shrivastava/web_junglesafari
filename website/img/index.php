<?php
  if(isset($_POST['submit'])){
    $name       = $_FILES['file']['name'];  
    $temp_name  = $_FILES['file']['tmp_name'];  
    if(isset($name)){
        if(!empty($name)){      
            $location = 'uploads/';     
 //$location = '../uploads/';    			
            if(move_uploaded_file($temp_name, $location.$name)){
                echo 'File uploaded successfully';
            }
        }       
    }  else {
        echo 'You should select a file to upload !!';
    }
}

if(isset($_POST['Show'])){
$dir = "uploads/";

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		if(strlen($file)>0){
		echo "filename:" . $file . "<br>";}
			}
    closedir($dh);
		}
	}
}


 
include_once 'dbconfig.php';
if(isset($_POST['Insert']))
{
 $Name = $_POST['Name'];
 $Branch = $_POST['Branch'];
  
        $sql_query = "INSERT INTO `testing`( `Name`, `Branch`) VALUES ('$Name','$Branch')";
 mysql_query($sql_query);
     
}
 
 
 include_once 'dbconfig.php';
if(isset($_POST['Edit']))
{
 $ID = $_POST['Name'];  
  
        $sql_query = "Delete from `testing` where ID='$Name'";
 mysql_query($sql_query);
     
}
 

?>
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="file"><br><br>
<input type="submit" value="submit" name="submit"><br><br>
<input type="submit" value="Show" name="Show"><br><br><br><br>
<h2>Insert / Delete / Update / Select (Operations)</h2><br/>
<input type="text" name="Name" id="Name" placeholder="Name" ><br/>
<input type="text" name="Branch" id="Branch" placeholder="Branch" ><br/>
<input type="submit" value="Insert" name="Insert"><br/>
 <br/>
 <br/>
 <table style="border: 1px solid #fff;">
 <tr><th>ID </th><th>Name</th><th>Branch</th></tr>
    
<?php
include_once 'dbconfig.php';
 $sql_query="SELECT * FROM testing";
 $result_set=mysql_query($sql_query);
 while($row=mysql_fetch_row($result_set))
 {
  ?>
        <tr>
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[2]; ?></td>
		  <td><input type="submit" value="Edit" name="Edit" id="<?php echo $row[0]; ?>" >  </td>
     </tr>
        <?php
 }
 ?>
  
 </table>
</form>