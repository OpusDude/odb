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
                $sql = "SELECT Driver FROM Driver WHERE Driver='$Driver'";
                $result = $conn->query($sql);
                if ( $result->num_rows > 0 )   
                {
                    $message = "Driver already exists";
                }
                else
                {
                    $sql = "INSERT INTO Driver (Driver, Email, PhoneNumber)
                    VALUES ('$Driver', '$Email', '$PhoneNumber')";

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
                <table width="800" style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
                    <tr>
                        <td colspan="6" style="background:#6495ED; color:#FFFFFF; font-size:20px" align="center">Current Drivers</td>
                    </tr>
                    <?php
                    try
                    {
                        $sql    = "SELECT Driver, Email, PhoneNumber, Id
                                   FROM Driver ORDER BY Driver";

                        $result = $conn->query($sql);
                        if ( $result->num_rows > 0 ) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                echo "            <tr>\n";
                                echo "              <td align=\"center\">".$row['Driver']."</td>\n";
                                echo "              <td align=\"center\"><a href='mailto:".$row['Email']."'>".$row['Email']."</td>\n";
                                echo "              <td align=\"center\">".$row['PhoneNumber']."</td>\n";
                                echo "              <td align=\"center\"><a href=\"editdriver.php?name=".$row['Driver']."\"><b>Edit</b></a></td>\n";
                                echo "              <td align=\"center\"><a href=\"deletedriver.php?name=".$row['Driver']."\"><b>Delete</b></a></td>\n";
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
                <table width="800" style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
                    <tr> 
                      <td align="center" colspan="6" style="background:#6495ED; color:#FFFFFF; font-size:20px">Add Driver</td>
                    </tr>
                    <tr>
                        <td><b>Driver Name:</b><span class="note">*</span></td>
                        <td><input type="text" id="driver" name="Driver" size="20" value="<?php if(isset($_POST['Driver'])) echo $_POST['Driver']; ?>"></td>
                        <td><b>Driver Email:</b><span class="note">*</span></td>
                        <td><input type="text" id=email name="Email" size="20" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p class="note"><?php if(isset($msg_driver)) echo $msg_driver ?></p></td>
                        <td></td>
                        <td colspan="2"><p class="note"><?php if(isset($msg_email)) echo $msg_email ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Phone Number:</b><span class="note">*</span></td>
                        <td><input type="text" name="PhoneNumber" size="20" value="<?php if(isset($_POST['PhoneNumber'])) echo $_POST['PhoneNumber']; ?>"></td>
                    <tr>
                        <td colspan="2"><p class="note"><?php if(isset($msg_phonenumber)) echo $msg_phonenumber ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center"><input type="hidden" name="do" value="store"><input type="submit" value="Add Driver"></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center"><p class="note"><b><?php if(isset($message)) echo $message ?></b></p></td>
                    </tr>
                    <tr bgcolor="#6495ED">
                        <th colspan="6" align="center" border="1"><a href="index.php">Home</a></th>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
