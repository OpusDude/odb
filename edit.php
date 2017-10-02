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
    require 'creds.php';
    $rec_id = $_GET["id"]; 
    $Notes = NULL;

    if ( isset($_POST['Notes']) )
    { 
        $Notes = $_POST["Notes"];
    }
    if(isset($_POST['do']) and $_POST["do"]=="update")
    {
        if(empty($_POST["Vendor"]))
        {
            $msg_vendor = "Vendor not set";
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
        elseif(ctype_digit($_POST["Weight"])) 
        {
            $msg_weight = NULL;
            $Weight = $_POST["Weight"];
        }
        else 
        {
            $msg_weight = "Numbers only";
        }
        
        if ($msg_vendor == "" && $msg_value == "" && $msg_quantity == "" && $msg_weight == "" && 
            $msg_item == "" && $msg_quantity == "" && $msg_driver == "" && $msg_itemdesc == "")
        {
            try
            {
                $NewDate = date_create()->format('Y-m-d H:i:s');
                $sql = "UPDATE Donation SET Driver = '$Driver', Items = '$Item', ItemDesc = '$ItemDesc', Quantity = '$Quantity',
                        QuantityType = '$QuantityType', Value = '$Value', Weight = '$Weight', Notes = '$Notes', Date = '$NewDate'
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
            $message = "A field is not formatted correctly";
        }
    }
?>
       <div class="container">
          <center><h1><u>ODB Donation Database</u></h1></center>
          <center><h3><span class="note">*</span> denotes mandatory</h3></center>
      <?php
      $sql = "SELECT Donation.Id As Id, Donation.Vendor AS VendorId, Vendor.Contact AS Name,
              Vendor.Email AS Email, Vendor.Vendor AS Vendor, Donation.Driver AS Driver,
              Donation.Items, Donation.ItemDesc, Donation.QuantityType, Donation.Quantity,
              Donation.Value, Donation.Weight, Donation.Date, Donation.Notes
              FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
              WHERE Donation.Id = '".$rec_id."'";
      
      $result = $conn->query($sql);
      if ( $result->num_rows > 0 ) 
      {
        while( $row = $result->fetch_assoc() ) 
        { 
      ?>
      <form id="add_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $rec_id; ?>">
      <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
          <tr>
              <td align="center" colspan="4" style="background:#6495ED; color:#FFFFFF; fontsize:20px">Update Donation Record</td>
          </tr>
          <tr>
            <td><b>Vendor:</b></td>
            <?php
             $sql = "SELECT Vendor, City FROM Vendor Where Id = $row[VendorId]";
             $result1 = $conn->query($sql);
             if ( $result1->num_rows > 0 ) 
             {
                 while( $row1 = $result1->fetch_assoc() ) 
                 {
                     echo "<td><b>".$row1['Vendor']." - ".$row1['City']."</b></td>\n";
                 }
             }
            ?>
          </tr>
          <tr>
            <td><input type="hidden" name="Vendor" value="<?php echo $row['VendorId']; ?>" /></td>
          </tr>
          <tr>
            <td><b>Select Item:</b><span class="note">*</span></td>
            <td><select name="Item">
                 <option value="">Select Item</option>
            <?php
             $sql = "SELECT Item FROM ItemType ORDER BY Item";
             $result2 = $conn->query($sql);
             if ( $result2->num_rows > 0 ) 
             {
                 echo $row['Items']; 
                 while( $row2 = $result2->fetch_assoc() ) 
                 {
                     echo "    <option value=\"".$row2['Item']."\"";
                     if (isset($row['Items']) and ($row2['Item'] === $row['Items'])) echo ' selected="selected"';
                     echo ">".$row2['Item']."</option>\n";
                 }
             }
            ?>
            </select></td>
            <td><b>Item Description:</b><span class="note">*</span></td>
            <td><input type="text" name="ItemDesc" size="20" value="<?php if(isset($row['ItemDesc'])) echo $row['ItemDesc']; ?>"></td>
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
              $result3 = $conn->query($sql);
              if ( $result3->num_rows > 0 ) 
              {
                  while( $row3 = $result3->fetch_assoc() ) 
                  {
                      echo "    <option value=\"".$row3['Driver']."\"";
                      if (isset($row['Driver']) and $row3['Driver'] === $row['Driver']) echo ' selected="selected"';
                      echo ">".$row3['Driver']."</option>\n";
                  }
              }
            ?>
            </select></td>
            <td><b>Quantity:</b><span class="note">*</span></td>
            <td><select name="QuantityType">
                <option value="">Select type</option>
             <?php
               $sql = "SELECT Type FROM QuantityType ORDER BY Type";
               $result4 = $conn->query($sql);
               if ( $result4->num_rows > 0 ) 
               {
                   while( $row4 = $result4->fetch_assoc() ) 
                   {
                       echo "    <option value=\"".$row4['Type']."\"";
                       if (isset($row['QuantityType']) and ($row['QuantityType'] === $row4['Type'])) echo ' selected="selected"';
                       echo ">".$row4['Type']."</option>\n";
                   }
               }
            ?>
            </select>
            <input type="text" name="Quantity" size="8" value="<?php if(isset($row['Quantity'])) echo $row['Quantity']; ?>"></td>
          </tr>
          <tr>
            <td><p class="note"><?php if (isset($msg_driver)) echo $msg_driver ?></p></td>
            <td></td>
            <td><p class="note"><?php if (isset($msg_quantity)) echo $msg_quantity ?></p></td>
          <tr>
            <td><b>Dollar Value:</b><span class="note">*</span></td>
            <td><input type="text" name="Value" size="8" value="<?php if (isset($row['Value'])) echo $row['Value']; ?>"></td>
            <td><b>Weight (lbs):</b><span class="note">*</span></td>
            <td><input type="text" name="Weight" size="8" value="<?php if (isset($row['Weight'])) echo $row['Weight']; ?>"></td>
          </tr>
          <tr>
            <td><p class="note"><?php if (isset($msg_value)) echo $msg_value ?></p></td>
            <td></td>
            <td><p class="note"><?php if (isset($msg_weight)) echo $msg_weight ?></p></td>
          </tr>
          <tr>
            <td><b>Notes:</b></td>
            <td colspan="4" align="left"><input type="text" name="Notes" size="60" value="<?php if (isset($row['Notes'])) echo $row['Notes']; ?>"></td>
          </tr>
          <tr>
            <td colspan="4" align="center"><input type="hidden" name="do" value="update"><input type="submit" value="Update Record"></td>
          </tr>
          <tr>
            <td colspan="4" align="center"><p class="note"><b><?php if (isset($message)) echo $message ?></b></p></td>
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
