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

    if(isset($_POST['do']) and $_POST["do"]=="store")
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
                $sql = "SELECT Vendor FROM Vendor WHERE Vendor='$Vendor'";
                $result = $conn->query($sql);
                if ( $result->num_rows > 0 )   
                {
                    $message = "Vendor already exists";
                }
                else
                {
                    $sql = "INSERT INTO Vendor (Vendor, Contact, Email, Address, City, State, ZipCode, PhoneNumber)
                    VALUES ('$Vendor', '$Contact', '$Email', '$Address', '$City', '$State', '$ZipCode', '$PhoneNumber')";

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
            <form id="add_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <table width="1000" style="border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
                    <tr>
                        <td align="center" colspan="10" style="background:#6495ED; color:#FFFFFF; fontsize:20px"><b>Current Vendors</b></td>
                    </tr>
                    <?php
                    try
                    {
                        $sql    = "SELECT * FROM Vendor ORDER BY Vendor";
                        $result = $conn->query($sql);
                        if ( $result->num_rows > 0 ) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "            <tr>\n";
                                echo "              <td align=\"center\">".$row['Vendor']."</td>\n";
                                echo "              <td align=\"center\">".$row['Contact']."</td>\n";
                                echo "              <td align=\"center\"><a href='mailto:".$row['Email']."'>".$row['Email']."</td>\n";
                                echo "              <td align=\"center\">".$row['Address']."</td>\n";
                                echo "              <td align=\"center\">".$row['City']."</td>\n";
                                echo "              <td align=\"center\">".$row['State']."</td>\n";
                                echo "              <td align=\"center\">".$row['ZipCode']."</td>\n";
                                echo "              <td align=\"center\">".$row['PhoneNumber']."</td>\n";
                                echo "              <td align=\"center\"><a href=\"editvendor.php?id=".$row['Id']."\"><b>Edit</b></a></td>\n";
                                echo "            </tr>\n";
                            }
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
                </table>
                <table width="1000" style="border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
                    <tr>
                        <td align="center" colspan="10" style="background:#6495ED; color:#FFFFFF; fontsize:20px"><b>Add Vendor</b></td>
                    </tr>
                    <tr>
                        <td><b>Vendor Name:</b><span class="note">*</span></td>
                        <td><input type="text" id="vendor" name="Vendor" size="25" value="<?php if (isset($_POST['Vendor'])) echo $_POST['Vendor']; ?>"></td>
                        <td><b>Contact Name:</b><span class="note">*</span></td>
                        <td><input type="text" id=contact name="Contact" size="20" value="<?php if (isset($_POST['Contact'])) echo $_POST['Contact']; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p class="note"><?php if (isset($msg_vendor)) echo $msg_vendor ?></p></td>
                        <td></td>
                        <td colspan="2"><p class="note"><?php if (isset($msg_contact)) echo $msg_contact ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Email:</b><span class="note">*</span></td>
                        <td><input type="text" id="email" name="Email" size="25" value = '<?php if (isset($_POST['Email'])) echo $_POST['Email']; ?>'></td>
                        <td><b>Street Address:</b><span class="note">*</span></td>
                        <td><input type="text" id="address" name="Address" size="20" value="<?php if (isset($_POST['Address'])) echo $_POST['Address']; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p class="note"><?php if (isset($msg_email)) echo $msg_email ?></p></td>
                        <td></td>
                        <td colspan="2"><p class="note"><?php if (isset($msg_address)) echo $msg_address ?></p></td>
                    <tr>
                        <td><b>Select City:</b><span class="note">*</span></td>
                        <td><select name="City">
                            <option value="">Select City</option>
                            <option value="Cincinnati"<?php if (isset($_POST['City']) and $_POST['City'] === "Cincinnati") echo ' selected="selected"'; ?>>Cincinnati</option>
                            <option value="Blue Ash"<?php if (isset($_POST['City']) and $_POST['City'] === "Blue Ash") echo ' selected="selected"'; ?>>Blue Ash</option>
                            <option value="Covington"<?php if (isset($_POST['City']) and $_POST['City'] === "Covington") echo ' selected="selected"'; ?>>Covington</option>
                            <option value="Madeira"<?php if (isset($_POST['City']) and $_POST['City'] === "Madeira") echo ' selected="selected"'; ?>>Madeira</option>
                            <option value="Mason"<?php if (isset($_POST['City']) and $_POST['City'] === "Mason") echo ' selected="selected"'; ?>>Mason</option>
                            <option value="Newport"<?php if (isset($_POST['City']) and $_POST['City'] === "Newport") echo ' selected="selected"'; ?>>Newport</option>
                            <option value="Norwood"<?php if (isset($_POST['City']) and $_POST['City'] === "Norwood") echo ' selected="selected"'; ?>>Norwood</option>
                            <option value="Sharonville"<?php if (isset($_POST['City']) and $_POST['City'] === "Sharonville") echo ' selected="selected"'; ?>>Sharonville</option>
                            <option value="Other"<?php if (isset($_POST['City']) and $_POST['City'] === "Other") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                        <td><b>Select State:</b><span class="note">*</span></td>
                        <td><select name="State">
                            <option value="">Select State</option>
                            <option value="KY"<?php if (isset($_POST['State']) and $_POST['State'] === "KY") echo ' selected="selected"'; ?>>KY</option>
                            <option value="IN"<?php if (isset($_POST['State']) and $_POST['State'] === "IN") echo ' selected="selected"'; ?>>IN</option>
                            <option value="OH"<?php if (isset($_POST['State']) and $_POST['State'] === "OH") echo ' selected="selected"'; ?>>OH</option>
                            <option value="Other"<?php if (isset($_POST['State']) and $_POST['State'] === "Other") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p class="note"><?php if (isset($msg_city)) echo $msg_city ?></p></td>
                        <td></td>
                        <td colspan="2"><p class="note"><?php if (isset($msg_state)) echo $msg_state ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Zip Code:</b><span class="note">*</span></td>
                        <td><input type="text" name="ZipCode" size="20" value="<?php if (isset($_POST['ZipCode'])) echo $_POST['ZipCode']; ?>"></td>
                        <td><b>Phone Number:</b><span class="note">*</span></td>
                        <td><input type="text" name="PhoneNumber" size="20" value="<?php if (isset($_POST['PhoneNumber'])) echo $_POST['PhoneNumber']; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p class="note"><?php if (isset($msg_zipcode)) echo $msg_zipcode ?></p></td>
                        <td></td>
                        <td colspan="2"><p class="note"><?php if (isset($msg_phonenumber)) echo $msg_phonenumber ?></p></td>
                    </tr>
                        <td colspan="10" align="center"><input type="hidden" name="do" value="store"><input type="submit" value="Add Vendor"></td>
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
