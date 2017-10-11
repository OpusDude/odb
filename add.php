<!DOCTYPE html>
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
    require 'creds.php';
    $Notes = NULL;

    if ( isset($_POST['Vendor']) )
    { 
        $vendor = $_POST["Vendor"];
    }
    elseif (!empty($_GET['Vendor']))
    {
        $vendor = $_GET["Vendor"];
    }
    if ( isset($_POST['Notes']) )
    { 
        $Notes = $_POST["Notes"];
    }
    if(isset($_POST['do']) and $_POST["do"]=="store")
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
        elseif(is_numeric($_POST["Value"])) 
        {
            $msg_value = NULL;
            $Value = number_format($_POST["Value"], 2, '.', '');
        }
        else
        {
            $msg_value = "Decimal numbers only";
        }
        if(empty($_POST["Weight"]))
        {
            $msg_weight = "You must enter a weight";
        }
        elseif(is_numeric($_POST["Weight"])) 
        {
            $msg_weight = NULL;
            $Weight = number_format($_POST["Weight"], 2, '.', '');
        }
        else 
        {
            $msg_weight = "Decimal Numbers only";
        }
         
        if ($msg_value == NULL &&  $msg_weight == NULL && $msg_item == NULL && $msg_itemdesc == NULL &&
            $msg_quantity == NULL && $msg_quantitytype == NULL && $msg_driver == NULL && $msg_vendor == NULL)
        {
            try
            {
                $sql = "INSERT INTO Donation (Vendor, Driver, Items, ItemDesc, Quantity, QuantityType, Value, Weight, Notes)
                VALUES ('$Vendor', '$Driver', '$Item', '$ItemDesc', '$Quantity', '$QuantityType', '$Value', '$Weight', '$Notes')";

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
                      <?php
                       $sql = "SELECT Item FROM ItemType ORDER BY Item";
                       $result = $conn->query($sql);
                       if ( $result->num_rows > 0 ) 
                       {
                           while( $row = $result->fetch_assoc() ) 
                           {
                               echo "    <option value=\"".$row['Item']."\"";
                               if (isset($_POST['Item']) and ($_POST['Item'] === $row['Item'])) echo ' selected="selected"';
                               echo ">".$row['Item']."</option>\n";
                           }
                       }
                      ?>
                      </select></td>
                      <td><b>Item Description:</b><span class="note">*</span></td>
                      <td><input type="text" name="ItemDesc" size="20" value="<?php if(isset($_POST['ItemDesc'])) echo $_POST['ItemDesc']; ?>"></td>
                    </tr>
                    <tr>
                      <td><p class="note"><?php if(isset($msg_item)) echo $msg_item ?></p></td>
                      <td></td>
                      <td><p class="note"><?php if(isset($msg_itemdesc)) echo $msg_itemdesc ?></p></td>
                    </tr>
                    <tr>
                      <td><b>Driver Name:</b><span class="note">*</span></td>
                      <td><select name="Driver">
                          <option value="">Select Driver</option>
                      <?php
                        $sql = "SELECT Driver FROM Driver ORDER BY Driver";
                        $result = $conn->query($sql);
                        if ( $result->num_rows > 0 ) 
                        {
                            while( $row = $result->fetch_assoc() ) 
                            {
                                echo "    <option value=\"".$row['Driver']."\"";
                                if (isset($_POST['Driver']) and $_POST['Driver'] === $row['Driver']) echo ' selected="selected"';
                                echo ">".$row['Driver']."</option>\n";
                            }
                        }
                      ?>
                      </select></td>
                      <td><b>Quantity:</b><span class="note">*</span></td>
                      <td><select name="QuantityType">
                          <option value="">Select type</option>
                       <?php
                         $sql = "SELECT Type FROM QuantityType ORDER BY Type";
                         $result = $conn->query($sql);
                         if ( $result->num_rows > 0 ) 
                         {
                             while( $row = $result->fetch_assoc() ) 
                             {
                                 echo "    <option value=\"".$row['Type']."\"";
                                 if (isset($_POST['QuantityType']) and ($_POST['QuantityType'] === $row['Type'])) echo ' selected="selected"';
                                 echo ">".$row['Type']."</option>\n";
                             }
                         }
                      ?>
                      </select>
                      <input type="text" name="Quantity" size="8" value="<?php if(isset($_POST['Quantity'])) echo $_POST['Quantity']; ?>"></td>
                    </tr>
                    <tr>
                      <td><p class="note"><?php if (isset($msg_driver)) echo $msg_driver ?></p></td>
                      <td></td>
                      <td><p class="note"><?php if (isset($msg_quantity)) echo $msg_quantity ?></p></td>
                    <tr>
                      <td><b>Dollar Value:</b><span class="note">*</span></td>
                      <td><input type="text" name="Value" size="8" value="<?php if (isset($_POST['Value'])) echo $_POST['Value']; ?>"></td>
                      <td><b>Weight (lbs):</b><span class="note">*</span></td>
                      <td><input type="text" name="Weight" size="8" value="<?php if (isset($_POST['Weight'])) echo $_POST['Weight']; ?>"></td>
                    </tr>
                    <tr>
                      <td><p class="note"><?php if (isset($msg_value)) echo $msg_value ?></p></td>
                      <td></td>
                      <td><p class="note"><?php if (isset($msg_weight)) echo $msg_weight ?></p></td>
                    </tr>
                    <tr>
                      <td><b>Notes:</b></td>
                      <td colspan="4" align="left"><input type="text" name="Notes" size="60" value="<?php if (isset($_POST['Notes'])) echo $_POST['Notes']; ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="4" align="center"><input type="hidden" name="do" value="store"><input type="submit" value="Add Record"></td>
                    </tr>
                    <tr>
                      <td colspan="4" align="center" ><p class="note"><b><?php if (isset($message)) echo $message ?></b></p></td>
                    </tr>
                    <tr bgcolor="#6495ED">
                      <th colspan="4" align="center" border="1"><a href="index.php">Home</a></th>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>