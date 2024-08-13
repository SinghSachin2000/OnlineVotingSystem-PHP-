<?php
session_start();
if(!isset($_SESSION['userdata'])){
  header("location:../");
}

$userdata = $_SESSION['userdata'];
$candidatesdata=$_SESSION['candidatesdata'];

if($_SESSION['userdata']['status']==0){
  $status = '<b style="color:red">Not Voted</b>';
}
else{
    $status = '<b style="color:green">Voted</b>';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
      body {
        background-color: black;
        color: aliceblue;
        font-size: larger;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
      }

      .topsec {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: #333;
        color: aliceblue;
      }

      .topsec h1 {
        margin: 0;
      }

      .dashboard {
        display: flex;
        flex-direction: row;
        padding: 10px;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
      }

      .profile, .candidates {
        box-sizing: border-box;
      }

      .profile {
        background-color: aliceblue;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 20px;
        border-radius: 30px;
        color: black;
        width: 100%;
        max-width: 500px;
        padding: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      }
      .imagvoter{
      border-radius: 50%;
    }

      .candidates {
        width: 100%;
        max-width: 800px;
        margin: 20px;
      }

      .candiinf {
        padding: 10px;
        background-color: lightcoral;
        border-radius: 30px;
        margin: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .candiimg {
        border-radius: 50%;
      }

      .candidata {
        padding: 10px;
      }

      .backbtn, .logoutbtn, #votebtn, #voted {
        background-color: royalblue;
        color: white;
        border: none;
        padding: 5px;
        border-radius: 10px;
        cursor: pointer;
        padding-left: 20px;
        padding-right: 20px;
        font-size:20px ;
        margin: 5px;
      }

      .logoutbtn {
        background-color: crimson;
      }

      #voted {
        background-color: chartreuse;
        color: darkslategray;
        cursor: not-allowed;
      }

      @media (max-width: 768px) {
        .dashboard {
          flex-direction: column;
        }

        .profile, .candidates {
          width: 90%;
        }

        .topsec {
          flex-direction: column;
          align-items: center;
        }

        .topsec h1 {
          margin: 10px 0;
        }
      }
    </style>
</head>
<body>
    <div class="topsec">
        <a href="../"><button class="backbtn">Back</button></a>
        <h1>Online Voting System</h1>
        <a href="logout.php"><button class="logoutbtn">Log Out</button></a>
    </div>
    <hr>

    <div class="dashboard"> 
      <div class="profile">
        <img src="../uploads/<?php echo $userdata['photo'] ?>" height="200px" width="200px" class="imagvoter" alt="Profile Image">
        <div class="datainf">
          <div class="datainf">
            <b>Name :</b><span><?php echo $userdata['name'] ?></span>
          </div>
          <div class="datainf">
            <b>Mobile :</b><span><?php echo $userdata['mobile'] ?></span>
          </div>
          <div class="datainf">
            <b>Address :</b><span><?php echo $userdata['address'] ?></span>
          </div>
          <div class="datainf">
            <b>Status :</b><span><?php echo $status ?></span>
          </div>
        </div>
      </div>

      <div class="candidates">
        <?php 
            if ($_SESSION['candidatesdata']) {
              for ($i = 0; $i < count($candidatesdata); $i++) {
                ?>
               <div class="candiinf">
                <img src="../uploads/<?php echo $candidatesdata[$i]['photo'] ?>" height="100px" width="100px" class="candiimg" alt="Candidate Image">
                <div class="candidata"><b>Candidate Name :</b><span><?php echo $candidatesdata[$i]['name'] ?></span></div>
                <div class="candidata"><b>Votes :</b><span><?php echo $candidatesdata[$i]['votes'] ?></span></div>
                <form action="../api/vote.php" method="post" class="candidata">
                  <input type="hidden" name="cvotes" value="<?php echo $candidatesdata[$i]['votes'] ?>">
                  <input type="hidden" name="cid" value="<?php echo $candidatesdata[$i]['id'] ?>">
                  <?php
                    if ($_SESSION['userdata']['status'] == 0) {
                      ?>
                      <input type="submit" name="votebtn" value="Vote" id="votebtn">
                      <?php
                    } else {
                      ?>
                      <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                      <?php  
                    }
                  ?>
                </form>
               </div>
               <?php
              }
            }
        ?>
      </div>
    </div>
</body>
</html>
