<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>Add ODB Vendor</title>
     <style type="text/css">
        h1 {margin-bottom:20px}
        input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
        .note {color: #ff0000}
     </style>
    </head>
    <body>
 <?php
    require 'creds.php';
    $rec_name = $_GET["name"];
    $message = NULL;

    if(isset($_POST['do']) and $_POST["do"]=="update")
    {
        if(empty($_POST["Driver"]))
        {
            $msg_driver = "You must supply a driver name";
        }
        else 
        {
            $msg_driver = NULL;
            $Driver = $_POST["Driver"];
        }
        if(empty($_POST["Email"]))
        {
            $msg_email = "You must supply an email address";
        }
        else 
        {
            $Email = $_POST["Email"];
        }
        if(empty($_POST["PhoneNumber"]))
        {
            $msg_phonenumber = "You must enter a phone number";
        }
        else
        {
            $PhoneNumber = $_POST["PhoneNumber"];
        }
        
        if ($msg_driver == "" && $msg_email == "" && $msg_phonenumber == "")
        {
            try
            {
                $sql = "UPDATE Driver SET Driver = '$Driver',
                        Email = '$Email', PhoneNumber = '$PhoneNumber'
                        WHERE Driver = '$rec_name'";

                if ($conn->query($sql) === TRUE)
                {
                    $message = "Driver updated successfully";
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
          <form id="edit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?name=<?php echo $rec_name; ?>">
            <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
              <tr>
                <td colspan="6" align="center" style="background:#6495ED; color:#FFFFFF; fontsize:20px"><b>Update Driver</b></td>
              </tr>
        <?php
        try
        {
            $sql    = "SELECT Driver, Email, PhoneNumber
                       FROM Driver WHERE Driver = '$rec_name'";
            $result = $conn->query($sql);
            if ( $result->num_rows > 0 ) 
            {
                $row = $result->fetch_assoc();
        ?>            
              <tr>
                <td><b>Driver Name:</b><span class="note">*</span></td>
                <td><input type="text" id="driver" name="Driver" size="20" value="<?php echo $row['Driver']; ?>"></td>
                <td><b>Driver Email:</b><span class="note">*</span></td>
                <td><input type="text" id=email name="Email" size="20" value="<?php echo $row['Email']; ?>"></td>
              </tr>
              <tr>
                <td><p class="note"><?php if(isset($msg_driver)) echo $msg_driver ?></p></td>
                <td></td>
                <td><p class="note"><?php if(isset($msg_email)) echo $msg_email ?></p></td>
              </tr>
              <tr>
                <td><b>Phone Number:</b><span class="note">*</span></td>
                <td><input type="text" name="PhoneNumber" size="20" value="<?php echo $row['PhoneNumber']; ?>"></td>
              <tr>
                <td><p class="note"><?php if(isset($msg_phonenumber)) echo $msg_phonenumber ?></p></td>
              </tr>
              <tr>
                <td colspan="6" align="center"><input type="hidden" name="do" value="update"><input type="submit" value="Update Record"></td>
              </tr>
        <?php
            }
            else 
            {
                if ($message === NULL)
                {
                    $message = "Driver '" .$rec_name. "' not found in Database";
                }
            }
        ?>
              <tr>
                <td colspan="6" align="center"><p class="note"><b><?php if(isset($message)) echo $message ?></b></td>
              <tr>
              <tr bgcolor="#6495ED">
                <th colspan="6" align="center" border="1"><a href="index.php">Home</a></th>
              </tr>
            </table>
           </form>
        <?php
        }
        catch(Exception $e)
        {
            if ( strpos($message, 'error in your SQL syntax') !== false )
            {
                $message = "Error: Verify there are no single quotes used in any field";
            }
        }
        ?>
        </div>
    </body>
</html>
