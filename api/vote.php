<?php

session_start();
include('connect.php');

$votes=$_POST['cvotes'];
$total_votes = $votes +1;
$cid = $_POST['cid'];
$uid =$_SESSION['userdata']['id'];

$update_votes=mysqli_query($connect,"UPDATE user SET votes='$total_votes' WHERE id='$cid' ");

$update_user_status = mysqli_query($connect,"UPDATE user SET status=1 WHERE id='$uid' ");

if($update_user_status and $update_votes){
    $candidates = mysqli_query($connect,"SELECT *FROM user WHERE role=2");
    $candidatesdata =mysqli_fetch_all($candidates,MYSQLI_ASSOC);

    $_SESSION['userdata']['status']=1;
    $_SESSION['candidatesdata']=$candidatesdata;

    echo "
    <script>
    
          alert('voted successfully');
          window.location='../routes/dashboard.php';
    </script> 
    ";
}
else{
    echo "
    <script>
    
          alert('Something went wrong!!');
          window.location='../routes/dashboard.php';
    </script> 
    ";
}

?>