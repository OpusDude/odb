<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>Update ODB Donation Record</title>
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
    $rec_id         = $_GET["id"];
    
    mysqli_report(MYSQLI_REPORT_ALL);
    
    $conn = mysqli_connect($serverName, $username, $password, $dbname);
    if( $conn->connect_error ) {
        echo "Connection could not be established.<br/>";
        die($conn->connect_error);
    }

    if($_POST["do"]=="update")
    {
        if(empty($_POST["Name"]))
        {
            $msg_name = "You must supply a contact name";
        }
        else 
        {
            $Name = $_POST["Name"];
        }
        if(empty($_POST["Vendor"]))
        {
            $msg_vendor = "You must select a vendor";
        }
        elseif($_POST["Vendor"] == "Other" && empty($_POST["VendorOther"]))
        {

            $msg_vendorOther = "You must enter a vendor if you select 'Other'";
        }
        else 
        {
            if($_POST["Vendor"] == "Other")
            {
                $Vendor = $_POST["VendorOther"];
            }
            else
            {
                $Vendor = $_POST["Vendor"];
            }
        }
        if(empty($_POST["Item"]))
        {
            $msg_item = "You must select a Item";
        }
        else 
        {
            $Item = $_POST["Item"];
        }
        if(empty($_POST["ItemDesc"]))
        {
            $msg_itemdesc = "You must enter an Item description";
        }
        else 
        {
            $ItemDesc = $_POST["ItemDesc"];
        }
        if(empty($_POST["Email"]))
        {
            $msg_email = "You must supply an email";
        }
        else 
        {
            $Email = $_POST["Email"];
        }
        if(empty($_POST["Driver"]))
        {
            $msg_driver = "You must supply a driver name";
        }
        else 
        {
            $Driver = $_POST["Driver"];
        }
        if(empty($_POST["Quantity"]))
        {
            $msg_quantity = "You must enter a quantity";
        }
        elseif(ctype_digit($_POST["Quantity"])) 
        {
            $Quantity = $_POST["Quantity"];
        }
        else 
        {
            $msg_quantity = "Numbers only";
        }
        if(empty($_POST["Value"]))
        {
            $msg_value = "You must enter a value";
        }
        elseif(ctype_digit($_POST["Value"])) 
        {
            $Value = number_format($_POST["Value"]);
        }
        else 
        {
            $msg_value = "Whole numbers only";
        }
        if(empty($_POST["Weight"]))
        {
            $msg_weight = "You must enter a weight";
        }
        elseif(ctype_digit($_POST["Weight"])) 
        {
            $Weight = $_POST["Weight"];
        }
        else 
        {
            $msg_weight = "Numbers only";
        }
        
        if ($msg_name == "" && $msg_vendor == "" && $msg_value == "" && $msg_quantity == "" && $msg_weight == "" && 
            $msg_item == "" && $msg_quantity == "" && $msg_email == "" && $msg_driver == "" && $msg_itemdesc == "")
        {
            try
            {
                $sql = "UPDATE Donation SET Name = '$Name', Vendor = '$Vendor', Email = '$Email', Driver = '$Driver',
                       Items = '$Item', ItemDesc = '$ItemDesc', Quantity = '$Quantity', Value = '$Value', Weight = '$Weight'
                       WHERE Id = '$rec_id'";

                if ($conn->query($sql) === TRUE)
                {
                    $message = "Record updated successfully";
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
            $message = "A field is not formatted corretly";
        }
    }
?>
       <div class="container">
          <center><h1><u>ODB Donation Database</u></h1></center>
          <center><h3><span class="note">*</span> denotes mandatory</h3></center>
          <center><h3 class="success_msg"><?php echo $msg_success; ?></h3></center>

      <?php
      $sql = "SELECT * FROM Donation WHERE Id = '".$rec_id."'";
      $result = $conn->query($sql);
      if ( $result->num_rows > 0 ) 
      {
        while( $row = $result->fetch_assoc() ) 
        { 
      ?>

            <form id="edit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $rec_id; ?>">
                <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
                    <tr>
                        <td colspan="4" style="background:#6495ED; color:black; fontsize:20px">Add ODB Donation Record</td>
                    </tr>
                    <tr>
                        <td><b>Enter Name:</b><span class="note">*</span></td>
                        <td><input type="text" id="name" name="Name" size="25" value = '<?php echo $row['Name']; ?>'></td>
                        <td><b>Enter Email:</b><span class="note">*</span></td>
                        <td><input type="text" name="Email" size="20" value="<?php echo $row['Email']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_name ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_email ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Select Vendor:</b><span class="note">*</span></td>
                        <td><select name="Vendor">
                            <option value="">Select Vendor</option>
                            <option value="Avril's Deli Meats"<?php if ($row['Vendor'] === "Avrils Deli Meats") echo ' selected="selected"'; ?>>Avrils Deli Meats</option>
                            <option value="Brezel Pretzels"<?php if ($row['Vendor'] === "Brezel Pretzels") echo ' selected="selected"'; ?>>Brezel Pretzels</option>
                            <option value="Busken Bakery - Madison Rd"<?php if ($row['Vendor'] === "Busken Bakery - Madison Rd") echo ' selected="selected"'; ?>>Busken Bakery - Madison Rd</option>
                            <option value="Costco - Mason"<?php if ($row['Vendor'] === "Costco - Mason") echo ' selected="selected"'; ?>>Costco - Mason</option>
                            <option value="Club Chef"<?php if ($row['Vendor'] === "Club Chef") echo ' selected="selected"'; ?>>Club Chef</option>
                            <option value="Edible Arrangements - Glenway Ave"<?php if ($row['Vendor'] === "Edible Arrangements - Glenway Ave") echo ' selected="selected"'; ?>>Edible Arrangements - Glenway Ave</option>
                            <option value="Edible Arrangements - Hosbrook"<?php if ($row['Vendor'] === "Edible Arrangements - Hosbrook") echo ' selected="selected"'; ?>>Edible Arrangements - Hosbrook</option>
                            <option value="Gigis Cupcakes"<?php if ($row['Vendor'] === "Gigis Cupcakes") echo ' selected="selected"'; ?>>Gigis Cupcakes</option>
                            <option value="Krogers - Blue Ash"<?php if ($row['Vendor'] === "Krogers - Blue Ash") echo ' selected="selected"'; ?>>Krogers - Blue Ash</option>
                            <option value="Krogers - Madeira"<?php if ($row['Vendor'] === "Krogers - Madeira") echo ' selected="selected"'; ?>>Krogers - Madeira</option>
                            <option value="Krogers - Sharonville"<?php if ($row['Vendor'] === "Krogers - Sharonville") echo ' selected="selected"'; ?>>Krogers - Sharonville</option>
                            <option value="Mason Food Pantry"<?php if ($row['Vendor'] === "Mason Food Pantry") echo ' selected="selected"'; ?>>Mason Food Pantry</option>
                            <option value="Sixteen Bricks"<?php if ($row['Vendor'] === "Sixteen Bricks") echo ' selected="selected"'; ?>>Sixteen Bricks</option>
                            <option value="Other"<?php if ($row['Vendor'] !== "Avrils Deli Meats" &&
                                                           $row['Vendor'] !== "Brezel Pretzels" &&
                                                           $row['Vendor'] !== "Busken Bakery - Madison Rd" &&
                                                           $row['Vendor'] !== "Costco - Mason" &&
                                                           $row['Vendor'] !== "Club Chef" &&
                                                           $row['Vendor'] !== "Edible Arrangements - Glenway Ave" &&
                                                           $row['Vendor'] !== "Edible Arrangements - Hosbrook" &&
                                                           $row['Vendor'] !== "Gigis Cupcakes" &&
                                                           $row['Vendor'] !== "Krogers - Blue Ash" &&
                                                           $row['Vendor'] !== "Krogers - Madeira" &&
                                                           $row['Vendor'] !== "Krogers - Sharonville" &&
                                                           $row['Vendor'] !== "Mason Food Pantry" &&
                                                           $row['Vendor'] !== "Sixteen Bricks") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                        <td><b>Enter Vendor:</b></td>
                        <td><input type="text" name="VendorOther" size="20" value="<?php if ($row['Vendor'] !== "Avrils Deli Meats" &&
                                                                                             $row['Vendor'] !== "Brezel Pretzels" &&
                                                                                             $row['Vendor'] !== "Busken Bakery - Madison Rd" &&
                                                                                             $row['Vendor'] !== "Costco - Mason" &&
                                                                                             $row['Vendor'] !== "Club Chef" &&
                                                                                             $row['Vendor'] !== "Edible Arrangements - Glenway Ave" &&
                                                                                             $row['Vendor'] !== "Edible Arrangements - Hosbrook" &&
                                                                                             $row['Vendor'] !== "Gigis Cupcakes" &&
                                                                                             $row['Vendor'] !== "Krogers - Blue Ash" &&
                                                                                             $row['Vendor'] !== "Krogers - Madeira" &&
                                                                                             $row['Vendor'] !== "Krogers - Sharonville" &&
                                                                                             $row['Vendor'] !== "Mason Food Pantry" &&
                                                                                             $row['Vendor'] !== "Sixteen Bricks") echo $row['Vendor']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_vendor ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_vendorOther ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Select Item:</b><span class="note">*</span></td>
                        <td><select name="Item">
                            <option value="">Select Item</option>
                            <option value="Baked Goods"<?php if ($row['Items'] === "Baked Goods") echo ' selected="selected"'; ?>>Baked Goods</option>
                            <option value="Bread"<?php if ($row['Items'] === "Bread") echo ' selected="selected"'; ?>>Bread</option>
                            <option value="Canned Goods"<?php if ($row['Items'] === "Canned Goods") echo ' selected="selected"'; ?>>Canned Goods</option>
                            <option value="Coffee"<?php if ($row['Items'] === "Coffee") echo ' selected="selected"'; ?>>Coffee</option>
                            <option value="Dairy"<?php if ($row['Items'] === "Dairy") echo ' selected="selected"'; ?>>Dairy</option>
                            <option value="Fruit"<?php if ($row['Items'] === "Fruit") echo ' selected="selected"'; ?>>Fruit</option>
                            <option value="Paper Products"<?php if ($row['Items'] === "Paper Products") echo ' selected="selected"'; ?>>Paper Products</option>
                            <option value="Produce"<?php if ($row['Items'] === "Produce") echo ' selected="selected"'; ?>>Produce</option>
                            <option value="Meat"<?php if ($row['Items'] === "Meat") echo ' selected="selected"'; ?>>Meat</option>
                            <option value="Staples"<?php if ($row['Items'] === "Staples") echo ' selected="selected"'; ?>>Staples</option>
                            <option value="Other"<?php if ($row['Items'] === "Other") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                        <td><b>Item Description:</b><span class="note">*</span></td>
                        <td><input type="text" name="ItemDesc" size="20" value="<?php echo $row['ItemDesc']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_item ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_itemdesc ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Enter Driver Name:</b><span class="note">*</span></td>
                        <td><input type="text" name="Driver" size="20" value="<?php echo $row['Driver']; ?>"></td>
                        <td><b>Enter Quantity:</b><span class="note">*</span></td>
                        <td><input type="text" name="Quantity" size="20" value="<?php echo $row['Quantity']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_driver ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_quantity ?></p></td>
                    <tr>
                        <td><b>Enter Dollar Value:</b><span class="note">*</span></td>
                        <td><input type="text" name="Value" size="20" value="<?php echo $row['Value']; ?>"></td>
                        <td><b>Enter Weight (lbs):</b><span class="note">*</span></td>
                        <td><input type="text" name="Weight" size="20" value="<?php echo $row['Weight']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_value ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_weight ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="note"><b><?php echo $message ?></b></p></td>
                        <td colspan="4" align="right"><input type="hidden" name="do" value="update"><input type="submit" value="Update Record"></td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
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