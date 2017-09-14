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
    $rec_id   = $_GET["id"];

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
        if(empty($_POST["Vendor"]))
        {
            $msg_vendor = "You must select a vendor";
        }
        else 
        {
            $Vendor = $_POST["Vendor"];
        }
        if(empty($_POST["PhoneNumber"]))
        {
            $msg_phonenumber = "You must enter a phone number";
        }
        else
        {
            $PhoneNumber = $_POST["PhoneNumber"];
        }
        
        if ($msg_vendor == "" && $msg_email == "" && $msg_vendor == "" && $msg_phonenumber == "")
        {
            try
            {
                $sql = "UPDATE Driver SET Driver = '$Driver', Email = '$Email', 
                Vendor = '$Vendor', PhoneNumber = '$PhoneNumber'
                WHERE Id = '$rec_id'";

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
        <?php
        try
        {
            $sql    = "SELECT Driver.Driver, Driver.Email, Driver.PhoneNumber,
                       Vendor.Vendor AS Vendor, Vendor.City AS City, Driver.Vendor AS VendorId
                       FROM Driver INNER JOIN Vendor ON Driver.Vendor = Vendor.Id
                       WHERE Driver.Id = '$rec_id'";
            $result = $conn->query($sql);
            if ( $result->num_rows > 0 ) 
            {
                $row = $result->fetch_assoc();
        ?>            
          <form id="edit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $rec_id; ?>">
            <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
              <tr>
                <td colspan="6" align="center" style="background:#6495ED; color:#FFFFFF; fontsize:20px"><b>Update Driver</b></td>
              </tr>
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
                <td><b>Select Vendor:</b><span class="note">*</span></td>
                <td><select name="Vendor">
                    <option value="">Select Vendor</option>
                <?php
                $sql1 = "SELECT * FROM Vendor ORDER BY Vendor";
                $result1 = $conn->query($sql1);
                if ( $result1->num_rows > 0 ) 
                {
                    while( $row1 = $result1->fetch_assoc() ) 
                    {
                        echo "   <option value=\"".$row1['Id']."\"";
                        if ($row['VendorId'] === $row1['Id']) echo ' selected="selected"';
                        echo ">".$row1['Vendor']." - ".$row1['City']."</option>\n";
                    }
                }
                ?>
                </select></td>
                <td><b>Phone Number:</b><span class="note">*</span></td>
                <td><input type="text" name="PhoneNumber" size="20" value="<?php echo $row['PhoneNumber']; ?>"></td>
              <tr>
                <td><p class="note"><?php if(isset($msg_vendor)) echo $msg_vendor ?></p></td>
                <td></td>
                <td><p class="note"><?php if(isset($msg_phonenumber)) echo $msg_phonenumber ?></p></td>
              </tr>
              <tr>
                <td colspan="6" align="center"><input type="hidden" name="do" value="update"><input type="submit" value="Update Record"></td>
              </tr>
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
            else 
            {
                $message = "Query returned zero results";  
            }
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
