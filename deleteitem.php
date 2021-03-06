<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>OSTC Infra Systems Database</title>
     <style type="text/css">
       h1 {margin-bottom:20px}
       input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
       .note {color: #ff0000}
     </style>
    </head>
    <body>
<?php
    require 'creds.php';
    $rec_id  = $_GET["id"];
    $secret  = "AYS";
    $message = NULL;

    if(isset($_POST['do']) and $_POST["do"]=="delete")
    { 
        if($_POST['password'] === $secret)
        {
            $sql = "DELETE FROM ItemType WHERE Id = '$rec_id'";
    
            if ($conn->query($sql) === TRUE)
            {
                $message = "Item '" .$_POST['Item']. "' successfully deleted from database";
            }
            else 
            {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else 
        {
            $message = "Invalid password!";
        }
    } 
?>
      <div class="container">
         <center><h1><u>ODB Donation Database</u></h1></center>
         <form id="delete_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $rec_id; ?>">
          <table width="400" style="border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
            <tr>
              <td colspan="2" style="background:#6495ED; color:#FFFFFF; font-size:20px" align="center">Delete Item</td>
            </tr>
            <?php
            $sql    = "SELECT * FROM ItemType WHERE Id = '$rec_id'";
            $result = $conn->query($sql);
            if ( $result->num_rows > 0 ) 
            {
               while($row = $result->fetch_assoc()) 
               {
                  echo "<tr>\n";
                  echo "             <td colspan=\"1\" align=\"center\"><b>Item:</b></td>\n";
                  echo "             <td colspan=\"1\" align=\"center\"><input type=\"hidden\" name=\"Item\" value=\"".$row['Item']."\">".$row['Item']."</td>\n";
                  echo "            </tr>\n";
                }
            }
            ?>
          </table>
          <table width="400" style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
            <tr>
              <td><b>Enter Password:</b></td>
              <td><input type="password" id="password" name="password" size="10"></td>
              <td colspan="4" align="right"><input type="hidden" name="do" value="delete"><input type="submit" value="Delete Record"></td>
            </tr>
            <?php
             if (!empty($message))
             {
                echo "<tr>\n";
                echo "              <td colspan=\"4\" align=\"center\"><p class=\"note\"><b>$message</b></td>\n";
                echo "            <tr>\n";
             }
           ?>
            <tr bgcolor="#6495ED">
              <th colspan="4" align="center" border="1"><a href="index.php">Home</a></th>
            </tr>
           </table>                
        </form>
      </div>
   </body>
</html>
