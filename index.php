<?php

include ("inc/db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discord Message Searcher | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<?php

$msg;

?>
    <form action="index.php" method="POST">
        <div class="form-group">
            <input type="text" class="form-control"name="searchinp" id="">
            <input type="submit" class="form-control btn btn-danger"value="Search!" name="submit">
        </div>
    </form>
</body>
</html>


<?php
$param = "%{$_POST['searchinp']}%";

if (isset($_POST['searchinp'])) {
    if (empty($_POST['searchinp'])) {
        die("Please complete the form!");
        header( "refresh:5;url=index.php" );
    } else {
        if($stmt=$con->prepare("SELECT * FROM messages WHERE id LIKE ? or author LIKE ? or message LIKE ? or time LIKE ? or messageid LIKE ? or authorid LIKE ? or channel LIKE ? or channelid LIKE ?;")) {
            $stmt->bind_param("ssssssss", $param, $param, $param, $param, $param, $param, $param, $param);
            $stmt->execute();
            $result = $stmt->get_result();
            
        }

        while($row = $result->fetch_assoc()) {
            
            echo "
            <center>
            <div class='card' style='width: 18rem; margin: 15px;'>
            <div class='card-body'>
              <h5 class='card-title'>Author:".$row['author']."</h5>
        
              <p class='card-text'>id:".$row['id']."</p>
              <p class='card-text'>message:".$row['message']."</p>
              <p class='card-text'>Timestamp:".$row['time']."</p>
              <p class='card-text'>Message ID:".$row['messageid']."</p>
              <p class='card-text'>Author's ID:".$row['authorid']."</p>
              <p class='card-text'>Channel Name:".$row['channel']."</p>
              <p class='card-text'>Channel's ID:".$row['channelid']."</p>
              
            </div>
          </div>
          </center>
            
            
            ";
            //echo $row['title'];
            //echo $row['content'];
        
        }
        
    }
}



?>