<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>OSTC Infra Systems Database</title>
     <style type="text/css">
       h1 {margin-bottom:20px}
       input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
       .note {color: #ff0000}
       .success_msg{color:#006600}
       .failure_msg{color:#FF0000}
     </style>
    </head>
    <body>
<?php
    $serverName = "localhost";
    $username   = "user";
    $password   = "password";
    $dbname     = "database";
    $rec_id     = $_GET["id"];
    $secret     = "secret";

    $conn = mysqli_connect($serverName, $username, $password, $dbname);
    if( $conn->connect_error ) {
        echo "Connection could not be established.<br/>";
        die($conn->connect_error);
    }
    
    if($_POST["do"]=="delete")
    { 
        if($_POST['password'] === $secret)
        {
            $sql = "DELETE from Donation WHERE Id = '".$rec_id."'";
    
            if ($conn->query($sql) === TRUE)
            {
                $msg_success = "Donation entry " .$rec_id. " successfully deleted from database";
            }
            else 
            {
                $msg_failure = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else 
        {
            $msg_failure = "Invalid password!";
        }
    } 
?>
      <div class="container">
         <center><h1><u>ODB Donation Database</u></h1></center>
         <center><h3 class="success_msg"><?php echo $msg_success; ?></h3></center>
         <center><h3 class="failure_msg"><?php echo $msg_failure; ?></h3></center>
         <form id="delete_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $rec_id; ?>">
          <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
            <tr>
                <td colspan="4" style="background:#6495ED; color:black; font-size:20px" align="center">Delete System Record</td>
            </tr>
            <tr>
            <?php
            $sql    = "SELECT * FROM Donation WHERE Id = '".$rec_id."'";
            $result = $conn->query($sql);
            if ( $result->num_rows > 0 ) 
            {
               while($row = $result->fetch_assoc()) 
               {
                  echo "  <tr>";
                  echo "     <td><b>Name:</b></td>";
                  echo "     <td>".$row['Name']."</td>";
                  echo "     <td><b>Vendor:</b></td>";
                  echo "     <td>".$row['Vendor']."</td>";
                  echo "  </tr>";
                  echo "  <tr>";
                  echo "     <td><b>Email:</b></td>";
                  echo "   <td bgcolor=#00FF00><a href='mailto:".$row['Email']."'>".$row['Email']."</td>\n";
                  echo "     <td><b>Driver:</b></td>";
                  echo "     <td>".$row['Driver']."</td>";
                  echo "  </tr>";
                  echo "  <tr>";
                  echo "     <td><b>Item:</b></td>";
                  echo "     <td>".$row['Items']."</td>";
                  echo "     <td><b>Item Description:</b></td>";
                  echo "     <td>".$row['ItemDesc']."</td>";
                  echo "  </tr>";
                  echo "  <tr>";
                  echo "     <td><b>Quantity:</b></b></td>";
                  echo "     <td>".$row['Quantity']."</td>";
                  echo "     <td><b>$ Value:</b></td>";
                  echo "     <td>".$row['Value']."</td>";
                  echo "  </tr>";
                  echo "  <tr>";
                  echo "     <td><b>Weight:</b></td>";
                  echo "     <td>".$row['Weight']."</td>";
                  echo "     <td><b>Date:</b></td>";
                  echo "     <td>".$row['Date']."</td>";
                  echo "  </tr>";
                }
            }
            ?>
                <td><b>Enter Password:</b></td>
                <td><input type="password" id="password" name="password" size="20"></td>
                <td colspan="4" align="right"><input type="hidden" name="do" value="delete"><input type="submit" value="Delete Record"></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr bgcolor="#6495ED">
                <th colspan="4" align="center" border="1"><a href="index.php">Home</a></th>
            </tr>
           </table>                
        </form>
      </div>
   </body>
</html>