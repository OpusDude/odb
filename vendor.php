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
    $serverName = "localhost";
    $username   = "root";
    $password   = "sbAXBP9*qdyE";
    $dbname     = "ODB_DB";
    $name       = $_GET["Name"];
    
    mysqli_report(MYSQLI_REPORT_ALL);
    
    $conn = mysqli_connect($serverName, $username, $password, $dbname);
    if( $conn->connect_error ) {
        echo "Connection could not be established.<br/>";
        die($conn->connect_error);
    }

    if($_POST["do"]=="store")
    {
        if(empty($_POST["Vendor"]))
        {
            $msg_vendor = "You must supply a vendor name";
        }
        else 
        {
            $Vendor = $_POST["Vendor"];
        }
        if(empty($_POST["Contact"]))
        {
            $msg_contact = "You must supply a contact name";
        }
        else 
        {
            $Contact = $_POST["Contact"];
        }
        if(empty($_POST["Email"]))
        {
            $msg_email = "You must supply an email address";
        }
        else 
        {
            $Email = $_POST["Email"];
        }
        if(empty($_POST["Address"]))
        {
            $msg_address = "You must supply an address";
        }
        else 
        {
            $Address = $_POST["Address"];
        }
        if(empty($_POST["City"]))
        {
            $msg_city = "You must supply a city";
        }
        else
        {
            $City = $_POST["City"];
        }
        if(empty($_POST["State"]))
        {
            $msg_state = "You must supply a state";
        }
        else
        {
            $State = $_POST["State"];
        }
        if(empty($_POST["ZipCode"]))
        {
            $msg_zipcode = "You must enter a zip code";
        }
        else
        {
            $ZipCode = $_POST["ZipCode"];
        }
        if(empty($_POST["PhoneNumber"]))
        {
            $msg_phonenumber = "You must enter a phone number";
        }
        else
        {
            $PhoneNumber = $_POST["PhoneNumber"];
        }
        
        if ($msg_vendor == "" && $msg_contact == "" && $msg_email == "" && $msg_address == "" && 
            $msg_city == "" && $msg_state == "" && $msg_zipcode == "" && $msg_phonenumber == "")
        {
            try
            {
                $sql = "INSERT INTO Vendor (Vendor, Contact, Email, Address, City, State, ZipCode, PhoneNumber)
                VALUES ('$Vendor', '$Contact', '$Email', '$Address', '$City', '$State', '$ZipCode', '$PhoneNumber')";

		echo $sql;

                if ($conn->query($sql) === TRUE)
                {
                    $message = "New Vendor created successfully";
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
                        <td colspan="4" style="background:#6495ED; color:black; fontsize:20px">Add ODB Vendor</td>
                    </tr>
                    <tr>
                        <td><b>Vendor Name:</b><span class="note">*</span></td>
                        <td><input type="text" id="vendor" name="Vendor" size="25" value="<?php echo $_POST['Vendor']; ?>"></td>
                        <td><b>Contact Name:</b><span class="note">*</span></td>
                        <td><input type="text" id=contact name="Contact" size="20" value="<?php echo $_POST['Contact']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_vendor ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_contact ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Email:</b><span class="note">*</span></td>
                        <td><input type="text" id="email" name="Email" size="25" value = '<?php echo $_POST['Email']; ?>'></td>
                        <td><b>Street Address:</b><span class="note">*</span></td>
                        <td><input type="text" id="address" name="Address" size="20" value="<?php echo $_POST['Address']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_email ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_address ?></p></td>
                    <tr>
                        <td><b>Select City:</b><span class="note">*</span></td>
                        <td><select name="City">
                            <option value="">Select City</option>
                            <option value="Cincinnati"<?php if ($_POST['City'] === "Cincinnati") echo ' selected="selected"'; ?>>Cincinnati</option>
                            <option value="Blue Ash"<?php if ($_POST['City'] === "Blue Ash") echo ' selected="selected"'; ?>>Blue Ash</option>
                            <option value="Madeira"<?php if ($_POST['City'] === "Madeira") echo ' selected="selected"'; ?>>Madeira</option>
                            <option value="Mason"<?php if ($_POST['City'] === "Mason") echo ' selected="selected"'; ?>>Mason</option>
                            <option value="Norwood"<?php if ($_POST['City'] === "Norwood") echo ' selected="selected"'; ?>>Norwood</option>
                            <option value="Sharonville"<?php if ($_POST['City'] === "Sharonville") echo ' selected="selected"'; ?>>Sharonville</option>
                            <option value="Other"<?php if ($_POST['City'] === "Other") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                        <td><b>Select State:</b><span class="note">*</span></td>
                        <td><select name="State">
                            <option value="">Select State</option>
                            <option value="KY"<?php if ($_POST['State'] === "KY") echo ' selected="selected"'; ?>>KY</option>
                            <option value="IN"<?php if ($_POST['State'] === "IN") echo ' selected="selected"'; ?>>IN</option>
                            <option value="OH"<?php if ($_POST['State'] === "OH") echo ' selected="selected"'; ?>>OH</option>
                            <option value="Other"<?php if ($_POST['Vendor'] === "Other") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_city ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_state ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Zip Code:</b><span class="note">*</span></td>
                        <td><input type="text" name="ZipCode" size="20" value="<?php echo $_POST['ZipCode']; ?>"></td>
                        <td><b>Phone Number:</b><span class="note">*</span></td>
                        <td><input type="text" name="PhoneNumber" size="20" value="<?php echo $_POST['PhoneNumber']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_zipcode ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_phonenumber ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="note"><b><?php echo $message ?></b></p></td>
                        <td></td>
                        <td colspan="4" align="right"><input type="hidden" name="do" value="store"><input type="submit" value="Add Vendor"></td>
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
