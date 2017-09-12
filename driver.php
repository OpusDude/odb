<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>Add ODB Vendor</title>
     <style type="text/css">
        h1 {margin-bottom:20px}
        input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
        .note {color: #ff0000}
        .success_msg{color:#006600}
     </style>
    </head>
    <body>
 <?php
    require 'creds.php';

    if($_POST["do"]=="store")
    {
        if(empty($_POST["Driver"]))
        {
            $msg_driver = "You must supply a driver name";
        }
        else 
        {
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
                $sql = "INSERT INTO Driver (Driver, Email, Vendor, PhoneNumber)
                VALUES ('$Driver', '$Email', '$Vendor', '$PhoneNumber')";

		echo $sql;

                if ($conn->query($sql) === TRUE)
                {
                    $message = "New Driver created successfully";
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
          <center><h3 class="success_msg"><?php echo $msg_success; ?></h3></center>
            <form id="add_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
                    <tr>
                        <td colspan="4" style="background:#6495ED; color:black; fontsize:20px">Add ODB Driver</td>
                    </tr>
                    <tr>
                        <td><b>Driver Name:</b><span class="note">*</span></td>
                        <td><input type="text" id="driver" name="Driver" size="25" value="<?php echo $_POST['Driver']; ?>"></td>
                        <td><b>Driver Email:</b><span class="note">*</span></td>
                        <td><input type="text" id=email name="Email" size="20" value="<?php echo $_POST['Email']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_driver ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_email ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Select Vendor:</b><span class="note">*</span></td>
                        <td><select name="Vendor">
                            <option value="">Select Vendor</option>
                        <?php
                        $sql = "SELECT * FROM Vendor ORDER BY Vendor";
                        $result = $conn->query($sql);
                        if ( $result->num_rows > 0 ) 
                        {
                            while( $row = $result->fetch_assoc() ) 
                            {
                                echo "   <option value=".$row['Id'];
                                if ($_POST['Vendor'] === $row['Id']) echo ' selected="selected"';
                                echo ">".$row['Vendor']." - ".$row['City']."</option>\n";
                            }
                        }
                        ?>
                        </select></td>
                        <td><b>Phone Number:</b><span class="note">*</span></td>
                        <td><input type="text" name="PhoneNumber" size="20" value="<?php echo $_POST['PhoneNumber']; ?>"></td>
                    <tr>
                        <td><p class="note"><?php echo $msg_vendor ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_phonenumber ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="note"><b><?php echo $message ?></b></p></td>
                        <td></td>
                        <td colspan="4" align="right"><input type="hidden" name="do" value="store"><input type="submit" value="Add Driver"></td>
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
