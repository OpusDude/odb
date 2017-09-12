<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>Add ODB Donation Record</title>
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
    if ( isset($_POST['Vendor']) )
    { 
        $vendor = $_POST["Vendor"];
    }
    elseif (!empty($_GET['Vendor']))
    {
        $vendor = $_GET["Vendor"];
    }
    
    $conn = mysqli_connect($serverName, $username, $password, $dbname);
    if( $conn->connect_error ) {
        echo "Connection could not be established.<br/>";
        die($conn->connect_error);
    }

    if($_POST["do"]=="store")
    {
        if(empty($_POST["Vendor"]))
        {
            $msg_item = "You must pass in a vendor";
        }
        else 
        {
            $msg_vendor = NULL;
            $Vendor = $_POST["Vendor"];
        }
        if(empty($_POST["Item"]))
        {
            $msg_item = "You must select a Item";
        }
        else 
        {
            $msg_item = NULL;
            $Item = $_POST["Item"];
        }
        if(empty($_POST["ItemDesc"]))
        {
            $msg_itemdesc = "You must enter an Item description";
        }
        else 
        {
            $msg_itemdesc = NULL;
            $ItemDesc = $_POST["ItemDesc"];
        }
        if(empty($_POST["Driver"]))
        {
            $msg_driver = "You must select a driver";
        }
        else
        {
            $msg_driver = NULL;
            $Driver = $_POST["Driver"];
        }
        if(empty($_POST["QuantityType"]))
        {
            $msg_quantitytype = "You must select a quantity type";
        }
        else
        {
            $msg_quantitytype = NULL;
            $QuantityType = $_POST["QuantityType"];
        }
        if(empty($_POST["Quantity"]))
        {
            $msg_quantity = "You must enter a quantity";
        }
        elseif(ctype_digit($_POST["Quantity"])) 
        {
            $msg_quantity = NULL;
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
            $msg_value = NULL;
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
            $msg_weight = NULL;
            $Weight = $_POST["Weight"];
        }
        else 
        {
            $msg_weight = "Numbers only";
        }
         
        if ($msg_value == NULL &&  $msg_weight == NULL && $msg_item == NULL && $msg_itemdesc == NULL &&
            $msg_quantity == NULL && $msg_quantitytype == NULL && $msg_driver == NULL && $msg_vendor == NULL)
        {
            try
            {
                $sql = "INSERT INTO Donation (Vendor, Driver, Items, ItemDesc, Quantity, QuantityType, Value, Weight)
                VALUES ('$Vendor', '$Driver', '$Item', '$ItemDesc', '$Quantity', '$QuantityType', '$Value', '$Weight')";

                if ($conn->query($sql) === TRUE)
                {
                    $message = "New record created successfully";
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
            <form id="add_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
                    <tr>
                        <td colspan="4" style="background:#6495ED; color:black; fontsize:20px">Add ODB Donation Record</td>
                    </tr>
                    <tr>
                        <td><b>Vendor:</b></td>
                        <td><b>
                        <?php
                        $sql = "SELECT * FROM Vendor Where Id='$vendor'";
                        $result = $conn->query($sql);
                        if ( $result->num_rows > 0 ) 
                        {
                            while( $row = $result->fetch_assoc() ) 
                            {
                                echo $row['Vendor']." - ".$row['City'];
                            }
                        }
                        ?> 
                        </b></td>
                        <td><input type="hidden" name="Vendor" value="<?php echo $vendor; ?>" /></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Select Item:</b><span class="note">*</span></td>
                        <td><select name="Item">
                            <option value="">Select Item</option>
                            <option value="Baked Goods"<?php if ($_POST['Item'] === "Baked Goods") echo ' selected="selected"'; ?>>Baked Goods</option>
                            <option value="Bread"<?php if ($_POST['Item'] === "Bread") echo ' selected="selected"'; ?>>Bread</option>
                            <option value="Canned Goods"<?php if ($_POST['Item'] === "Canned Goods") echo ' selected="selected"'; ?>>Canned Goods</option>
                            <option value="Coffee"<?php if ($_POST['Item'] === "Coffee") echo ' selected="selected"'; ?>>Coffee</option>
                            <option value="Dairy"<?php if ($_POST['Item'] === "Dairy") echo ' selected="selected"'; ?>>Dairy</option>
                            <option value="Fruit"<?php if ($_POST['Item'] === "Fruit") echo ' selected="selected"'; ?>>Fruit</option>
                            <option value="Paper Products"<?php if ($_POST['Item'] === "Paper Products") echo ' selected="selected"'; ?>>Paper Products</option>
                            <option value="Produce"<?php if ($_POST['Item'] === "Produce") echo ' selected="selected"'; ?>>Produce</option>
                            <option value="Meat"<?php if ($_POST['Item'] === "Meat") echo ' selected="selected"'; ?>>Meat</option>
                            <option value="Staples"<?php if ($_POST['Item'] === "Staples") echo ' selected="selected"'; ?>>Staples</option>
                            <option value="Other"<?php if ($_POST['Item'] === "Other") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                        <td><b>Item Description:</b><span class="note">*</span></td>
                        <td><input type="text" name="ItemDesc" size="20" value="<?php echo $_POST['ItemDesc']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_item ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_itemdesc ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Driver Name:</b><span class="note">*</span></td>
                        <td><select name="Driver">
                            <option value="">Select Driver</option>
                        <?php
                        $sql = "SELECT * FROM Driver Where Vendor=\"$vendor\" ORDER BY Driver";
                        $result = $conn->query($sql);
                        if ( $result->num_rows > 0 ) 
                        {
                            while( $row = $result->fetch_assoc() ) 
                            {
                                echo "    <option value=".$row['Id'];
                                if ($_POST['Driver'] === $row['Id']) echo ' selected="selected"';
                                echo ">".$row['Driver']."</option>\n";
                            }
                        }
                        ?>
                        </select></td>
                        <td><b>Quantity:</b><span class="note">*</span></td>
                        <td><select name="QuantityType">
                            <option value="">Select type</option>
                            <option value="Bags"<?php if ($_POST['QuantityType'] === "Bags") echo ' selected="selected"'; ?>>Bags</option>
                            <option value="Bins"<?php if ($_POST['QuantityType'] === "Bins") echo ' selected="selected"'; ?>>Bins</option>
                            <option value="Boxes"<?php if ($_POST['QuantityType'] === "Boxes") echo ' selected="selected"'; ?>>Boxes</option>
                            <option value="Crates"<?php if ($_POST['QuantityType'] === "Crates") echo ' selected="selected"'; ?>>Crates</option>
                            <option value="Carts"<?php if ($_POST['QuantityType'] === "Carts") echo ' selected="selected"'; ?>>Carts</option>
                            <option value="Other"<?php if ($_POST['QuantityType'] === "Other") echo ' selected="selected"'; ?>>Other</option>
                        </select>
                        <input type="text" name="Quantity" size="8" value="<?php echo $_POST['Quantity']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_driver ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_quantity ?></p></td>
                    <tr>
                        <td><b>Dollar Value:</b><span class="note">*</span></td>
                        <td><input type="text" name="Value" size="8" value="<?php echo $_POST['Value']; ?>"></td>
                        <td><b>Weight (lbs):</b><span class="note">*</span></td>
                        <td><input type="text" name="Weight" size="8" value="<?php echo $_POST['Weight']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_value ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_weight ?></p></td>
                    </tr>
                    <tr>
                        <td><p class="note"><b><?php echo $message ?></b></p></td>
                        <td></td>
                        <td colspan="4" align="right"><input type="hidden" name="do" value="store"><input type="submit" value="Add Record"></td>
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
