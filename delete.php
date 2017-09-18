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
    $rec_id     = $_GET["id"];
    $secret     = "AYS";

    if($_POST["do"]=="delete")
    { 
        if($_POST['password'] === $secret)
        {
            $sql = "DELETE from Donation WHERE Id = '".$rec_id."'";
    
            if ($conn->query($sql) === TRUE)
            {
                $message = "Donation entry " .$rec_id. " successfully deleted from database";
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
          <table width="500" style="border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
            <tr>
              <td align="center" colspan="4" style="background:#6495ED; color:#FFFFFF; font-size:20px" align="center">Delete Donation Record</td>
            </tr>
            <tr>
            <?php
            $sql    = "SELECT Vendor.Vendor AS Vendor, Donation.Items, Donation.ItemDesc,
                       Donation.QuantityType, Donation.Quantity, Donation.Value, Donation.Weight, Donation.Date 
                       FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
                       WHERE Donation.Id = '".$rec_id."'";

            $result = $conn->query($sql);
            if ( $result->num_rows > 0 ) 
            {
               while($row = $result->fetch_assoc()) 
               {
                  echo "  <tr>";
                  echo "     <td><b>Vendor:</b></td>";
                  echo "     <td colspan=\"3\" align=\"center\">".$row['Vendor']."</td>";
                  echo "  </tr>";
                  echo "  <tr>";
                  echo "     <td><b>Item:</b></td>";
                  echo "     <td align=\"center\">".$row['Items']."</td>";
                  echo "     <td><b>Item Description:</b></td>";
                  echo "     <td align=\"center\">".$row['ItemDesc']."</td>";
                  echo "  </tr>";
                  echo "  <tr>";
                  echo "     <td><b>Quantity:</b></b></td>";
                  echo "     <td align=\"center\">".$row['Quantity']."</td>";
                  echo "     <td><b>$ Value:</b></td>";
                  echo "     <td align=\"center\">".$row['Value']."</td>";
                  echo "  </tr>";
                  echo "  <tr>";
                  echo "     <td><b>Weight:</b></td>";
                  echo "     <td align=\"center\">".$row['Weight']."</td>";
                  echo "     <td><b>Date:</b></td>";
                  echo "     <td align=\"center\">".$row['Date']."</td>";
                  echo "  </tr>";
                }
            }
            ?>
          </table>
          <table width="500" style="border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
            <tr>
              <td><b>Enter Password:</b></td>
              <td><input type="password" id="password" name="password" size="20"></td>
              <td colspan="4" align="right"><input type="hidden" name="do" value="delete"><input type="submit" value="Delete Record"></td>
            </tr>
            <tr>
              <td colspan="10" align="center"><p class="note"><b><?php if (isset($message)) echo $message ?></b></p></td>
            </tr>
            <tr bgcolor="#6495ED">
              <th colspan="4" align="center" border="1"><a href="index.php">Home</a></th>
            </tr>
           </table>                
        </form>
      </div>
   </body>
</html>
