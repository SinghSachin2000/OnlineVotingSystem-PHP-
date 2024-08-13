<?php
session_start();

include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role= $_POST['role'];

$check = mysqli_query($connect,"SELECT * FROM user WHERE mobile ='$mobile' AND password='$password' And role='$role' ");
if(mysqli_num_rows($check)>0){
 $userdata =mysqli_fetch_array($check);
 $candidates = mysqli_query($connect,"SELECT *FROM user WHERE role=2");
 $candidatesdata =mysqli_fetch_all($candidates,MYSQLI_ASSOC);

 $_SESSION['userdata']=$userdata;
 $_SESSION['candidatesdata']=$candidatesdata;

 echo "
 <script>
       window.location='../routes/dashboard.php'
 </script> 
 ";
}
else{
    echo "
    <script>
    
          alert('Invalid credential or User not found');
          window.location='../index.html'
    </script> 
    ";
}

?>