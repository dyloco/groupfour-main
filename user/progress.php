<?php
include('/xampp/htdocs/groupfour-main/checkStatus.php');
$db = new SQLite3('/xampp/Data/ActemiumDB.db');
$stmt = $db->prepare('SELECT Role FROM User WHERE UserName = :username ');
$stmt->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
$result = $stmt->execute();
$rows_array = [];
while ($row=$result->fetchArray())
{
    $rows_array[]=$row;
}
if($rows_array[0][0] == "Admin")
{
    include('/xampp/htdocs/groupfour-main/admin/AdminNavBar.php');
}
else if($rows_array[0][0] == "Manager"){
    include('/xampp/htdocs/groupfour-main/manager/ManagerNavBar.php');
}
else{
    include('/xampp/htdocs/groupfour-main/user/UserNavBar.php');
}



if (isset($_POST['submit'])) {
  header("Location: userCreateObj.php");
}
?>












<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/groupfour-main/site.css" />
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
























<main class="form-signin col-md-2 center">
  <link rel="stylesheet" href="/groupfour-main/site.css" />
  <link rel="stylesheet" href="/groupfour-main/buttonstyle.css" />
  <h1 class="h3 mb-3 fw-normal" style="text-align: center">ACTEMIUM</h1>
  <div style="text-align: center">
      <h1>Objectives</h1>
  </div>
  <hr style="border:3px solid #f1f1f1">
  <table style="width: 100%; text-align: center;border: solid 2px black">
    <?php
    $userID = $_SESSION['userID'];
    $db = new SQLite3('/xampp/Data/ActemiumDB.db');
    $stmt = $db->prepare("SELECT objID,objName,Status FROM Objectives WHERE userID = $userID  ");
    $result = $stmt->execute();
    $rows_array = [];
    $count = 0;
    while ($row=$result->fetchArray())
    {
      $count += 1;
      $rows_array[]=$row;
    }
    ?> 
    <?php if($count != 0){ ?>
    <tr class="tableHead">
      <th>Objective ID</th>
      <th>Objective Name</th>
      <th>Status</th>
    </tr>

    <?php $_SESSION['reviewID'] =  $rows_array[0][0]; ?>
    <?php for($x = 0  ; $x < $count; $x+=1){?>
    <tr>
      <td><?php echo $rows_array[$x][0]?></a></td>
      <?php if($rows_array[$x][2] != "Complete"){?>
      <td><a href="objectives.php?objID=<?php echo $rows_array[$x][0]?>"><strong><?php echo $rows_array[$x][1]?></strong></a></td>
      <?php }else{ ?>
        <td><strong><?php echo $rows_array[$x][1]?></strong></td>
        <?php }?>
      <td><?php echo $rows_array[$x][2]?></td>
    </tr>
    <?php } ?>
  <?php } 
    else { ?>
    <h1 style = "text-align: center">You have no Objectives set.</h1>
  <?php } ?>
  </table>
    <form  method="post">
      <div>
        <button class="w-20 btn btn-lg btn-primary" style="float:left;margin-top:20px" type="submit" name="submit" value="User Login">Create an Objective</button>
      </div>
    </form>
</main>






<?php require("/xampp/htdocs/groupfour-main/Footer.php");?>