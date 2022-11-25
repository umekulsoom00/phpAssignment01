<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<style>
h1{
    padding-top: 86px;
    margin-top: 20px;
    font-size: 70px;
    text-align: center;
    color: aliceblue;
    color: #e7dc00;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

}
h2{
    padding-top: 86px;
    margin-top: 20px;
    font-size: 40px;
    text-align: center;
    color: aliceblue;
    color: #e7dc00;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

body{
    background-color: #5b1455;

}
.fill{
    text-align: center;
}

.line{
    width: 367px;
    height: 38px;

}
.btn1{
    width: 367px;
    height: 56px;
    background-color: #340138;
    color: #e7dc00;

}

.fill{

    padding-top: 27px;
}

.tab{
    margin-top: 50px;
color: white;
margin-left: 240px;
padding-left: 45px;
border: 2px solid #e7dc00;
}
p{
    color: white;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
font-size:18px;
text-align:center;
padding-left:122px;
}
.head{
   
    border: 2px solid #e7dc00;
    padding-left: 120px;

}
.record{
    border: 2px solid #e7dc00;
    padding-left: 40px;
   align-self: center;
   text-align: center;
}
.img{
    color: white;

}
    </style>


<body>
    


<h1>Registration form</h1>

<form class="fill" method="POST" enctype=multipart/form-data>
  
    <input class="line" type="text" required  name="clientName" placeholder="Enter your name">
<br><br>
<input class="line" type="text" name="clientEmail"placeholder="Enter your email"required>
<br><br>
<input type="text" class="line" name="clientCity" placeholder="Enter your city" required>
<br><br>

<input class="line" type="text" name="clientPhone" placeholder="phone number" required>
<br><br>


<P>Select image <input class="img" type="file" name="clientImage" id="fileToUpload"></p>
  
 


<button type="submit" class="btn1" name="btnSave">save</button>
</form>





<?php
    $connection = mysqli_connect("localhost","root","","umekulsoomdb");


   $queryShow= mysqli_query($connection,'SELECT * FROM clients');

?>
<h2>Data</h2>
<table class="tab" >
    <tr class="head">
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>city</th>
        <th>phone</th>
        <th>images</th>


    </tr>
<?php
while($r=mysqli_fetch_array($queryShow))

{
?>

<tr class="record" >
    <td class="record" ><?php echo $r["id"] ?></td>
    <td class="record"><?php echo $r["pname"]?></td>
    <td class="record"><?php echo $r["email"]?></td>
    <td class="record"><?php echo $r["city"]?></td>
    <td class="record"><?php echo $r["phone"]?></td>

    <td class="record"><img src="<?php echo $r["pimage"]?> " alt=""> </td>

    
    
</tr>
<?php
}


?>


</table>


<?php
ob_start();

if(isset($_POST['btnSave']))
{

    $clientName = $_POST['clientName'];
    $clientEmail = $_POST['clientEmail'];
    $clientCity = $_POST['clientCity'];
    $clientPhone = $_POST['clientPhone'];
    $filename = $_FILES["clientImage"]['name'];
    $tmpname = $_FILES["clientImage"]['tmp_name'];
    $location="images/";
    $saveimg = $location.$filename;

    if(move_uploaded_file($tmpname,$saveimg))
    {

        $queryInsert= 'INSERT INTO clients(pname,email,city,phone,pimage) VALUES("'.$clientName.'" , "'.$clientEmail.'", "'.$clientCity.'", "'.$clientPhone.'", "'.$saveimg.'")';
        $insertQuery= mysqli_query($connection,$queryInsert);
        
        
        
        
      

        if (isset($_POST['submit'])) 
        {
        //do somthing
        header("Location: $current_url");
        }
        
     //   if($insertQuery){
            
       //     echo "done";
         //   header("Location: $current_url");
           // header("Location:registration.php");
        //}
    }



}
ob_end_flush();

?>
</body>
</html>

