<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>Update ODB Donation Record</title>
     <style type="text/css">
        h1 {margin-bottom:20px}
        input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
        .note {color: #ff0000}
     </style>
    </head>
    <body>
 <?php
    require 'creds.php';
    $rec_id   = $_GET["id"];
    $msg_type = NULL;
    
    if(isset($_POST['do']) and $_POST["do"]=="update")
    {
        if(empty($_POST["Type"]))
        {
            $msg_type = "You must supply a type name";
        }
        else 
        {
            $Type = $_POST["Type"];
        }
        
        if (empty($msg_type))
        {
            try
            {
                $sql = "UPDATE QuantityType SET Type = '$Type' WHERE Id='$rec_id'";

                if ($conn->query($sql) === TRUE)
                {
                    $message = "Type updated successfully";
                    //header('Location: index.php');
                }
                else
                {
                    $message = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            catch(Exception $e)
            {
                $message = $e->getMessage();
                if ( strpos($message, 'error in your SQL syntax') !== false )
                {
                    $message = "Error: Verify there are no single quotes used in any field";
                }
            }
        }
        else
        { 
            $message = "A field is not formatted correctly";
        }
    }
?>
       <div class="container">
          <center><h1><u>ODB Donation Database</u></h1></center>
          <center><h3><span class="note">*</span> denotes mandatory</h3></center>
      <?php
      $sql = "SELECT * FROM QuantityType WHERE Id = '$rec_id'";
      $result = $conn->query($sql);
      if ( $result->num_rows > 0 ) 
      {
        while( $row = $result->fetch_assoc() ) 
        { 
      ?>
      <form id="edit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $rec_id; ?>">
              <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
                 <tr>
                   <td colspan="2" align="center" style="background:#6495ED; color:black; fontsize:20px"><b>Update Type</b></td>
                 </tr>
                 <tr>
                   <td><b>Enter Type:</b><span class="note">*</span></td>
                   <td><input type="text" id="type" name="Type" size="10" value = '<?php echo $row['Type']; ?>'></td>
                 </tr>
                 <tr>
                    <td><p class="note"><?php echo $msg_type ?></p></td>
                 </tr>
                 <tr>
                   <td colspan="4" align="center"><input type="hidden" name="do" value="update"><input type="submit" value="Update Record"></td>
                 </tr>
                 <?php
                 if (!empty($message))
                 {
                    echo "<tr>\n";
                    echo "                    <td colspan=\"2\" align=\"center\"><p class=\"note\"><b>$message</b></td>\n";
                    echo "                  <tr>\n";
                 }
                 ?>
                 <tr bgcolor="#6495ED">
                     <th colspan="4" align="center" border="1"><a href="index.php">Home</a></th>
                 </tr>
             </table>
           </form>
      <?php
        }
      }
      ?>
  </div>
    </body>
</html>
