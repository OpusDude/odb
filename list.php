<html>
 <head> 
    <meta name="description" content="Php Code for View, Search, Add, Edit and Delete Record" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <title>Search ODB Donation Records</title> 
 </head> 
 <?php
        require 'creds.php';

        if ( isset($_POST['itemType']) )
        {
            $varType = $_POST['itemType']; 
            if ( $varType == 'ALL' )
            {
                $sql1 = "SELECT * FROM Donation";
                $sql2 = "SELECT SUM(Quantity * Weight) as sum_weight FROM Donation";
                $sql3 = "SELECT SUM(Quantity * Value) as sum_value FROM Donation";
            }
            else
            {
                $sql1 = "SELECT * FROM Donation WHERE Items = '$varType'";
                $sql2 = "SELECT SUM(Quantity * Weight) as sum_weight FROM Donation WHERE Items = '$varType'";
                $sql3 = "SELECT SUM(Quantity * Value) as sum_value FROM Donation WHERE Items = '$varType'";
            }
        }
        elseif (!empty($_GET['itemType']))
        {
            $varType = $_GET['itemType'];
            if ( $varType == 'ALL' )
            {
                $sql1 = "SELECT * FROM Donation";
                $sql2 = "SELECT SUM(Quantity * Weight) as sum_weight FROM Donation";
                $sql3 = "SELECT SUM(Quantity * Value) as sum_value FROM Donation";
            }
            else
            {
                $sql1 = "SELECT * FROM Donation WHERE Items = '$varType'";
                $sql2 = "SELECT SUM(Quantity * Weight) as sum_weight FROM Donation WHERE Items = '$varType'";
                $sql3 = "SELECT SUM(Quantity * Value) as sum_value FROM Donation WHERE Items = '$varType'";
            }
        }
        else
        {
            $varType = 'ALL';
            $sql1 = "SELECT * FROM Donation";
            $sql2 = "SELECT SUM(Quantity * Weight) as sum_weight FROM Donation";
            $sql3 = "SELECT SUM(QUantity * Value) as sum_value FROM Donation";
        }
        $result = $conn->query($sql1);
        $numItems = mysqli_num_rows($result);
        $result = $conn->query($sql2);
        $totalWeight = mysqli_fetch_assoc($result);
        $result = $conn->query($sql3);
        $totalValue = mysqli_fetch_assoc($result);
    ?>
 <body> 
    <center><h1><u>ODB Donation Database</u></h1></center> 
    <form name="RecordType" method="post" action="">
    <table border="2" cellpadding="12" cellspacing="0px" align="center">
    <p style="font-size:10px">
    <TR>
    <td><select name="itemType">
        <option value="ALL" <?php echo ($varType == 'ALL' ? 'selected="selected"' : '') ?>>All Items</option>
        <?php
          $sql = "SELECT * FROM ItemType ORDER BY Item";
          $result = $conn->query($sql);
          if ( $result->num_rows > 0 ) 
          {
              while( $row = $result->fetch_assoc() ) 
              {
                  echo "    <option value=\"".$row['Item']."\"";
                  if (isset($varType) and ($varType === $row['Item'])) echo ' selected="selected"';
                  echo ">".$row['Item']."</option>\n";
              }
          }
        ?>
    </select>
        <input type="submit" name="Submit" value="Select" /></TD>
        <TD colspan="3" align="center"><b>Number of Items: <?php echo $numItems; ?></b></TD>
        <TD colspan="4" align="center"><b>Total Value: $<?php echo number_format($totalValue['sum_value'],2); ?></b></TD>
        <TD colspan="4" align="center"><b>Total Weight: <?php echo $totalWeight['sum_weight']; ?> lbs</b></TD>
    </TR>
    <TR>
        <TH bgcolor=#6495ED><a href="list.php?sort=Vendor&itemType=<?php echo $varType ?>" style="color:black">Vendor</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Driver&itemType=<?php echo $varType ?>" style="color:black">Driver</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Items&itemType=<?php echo $varType ?>" style="color:black">Item</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=ItemDesc&itemType=<?php echo $varType ?>" style="color:black">Item Description</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Quantity&itemType=<?php echo $varType ?>" style="color:black">Quantity</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=QuantityType&itemType=<?php echo $varType ?>" style="color:black">QuantityType</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Value&itemType=<?php echo $varType ?>" style="color:black">Value</a></TH>
        <TH bgcolor=#6495ED><a style="color:black"> Total Value</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Weight&itemType=<?php echo $varType ?>" style="color:black">Weight</a></TH>
        <TH bgcolor=#6495ED><a style="color:black">Total Weight</a></TH>
        <TH bgcolor=#6495ED><a style="color:black">Notes</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Date&itemType=<?php echo $varType ?>" style="color:black">Date</a></TH>
    </TR>

    <?php
    if (empty($varType) || $varType == 'ALL')
    {
    $sql = "SELECT Donation.Id As RecordId, Donation.Vendor AS VendorId, Vendor.Contact AS Name, Donation.Notes,
            Vendor.Email AS Email, Vendor.Vendor AS Vendor, Donation.Driver AS Driver, Donation.Items,
            Donation.ItemDesc, Donation.QuantityType, Donation.Quantity, Donation.Value, Donation.Weight, Donation.Date 
            FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id";
    }
    else
    {
    $sql = "SELECT Donation.Id As RecordId, Donation.Vendor AS VendorId, Vendor.Contact AS Name, Donation.Notes,
            Vendor.Email AS Email, Vendor.Vendor AS Vendor, Donation.Driver AS Driver, Donation.Items,
            Donation.ItemDesc, Donation.QuantityType, Donation.Quantity, Donation.Value, Donation.Weight, Donation.Date 
            FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
            WHERE Items = '$varType'";
    }
    if (!empty($_GET['sort']))
    {
    if ($_GET['sort'] == 'RecordId')
    {
        $sql .= " ORDER BY RecordId";
    }
    if ($_GET['sort'] == 'Name')
    {
        $sql .= " ORDER BY Name";
    }
    elseif ($_GET['sort'] == 'Vendor')
    {
        $sql .= " ORDER BY Vendor";
    }
    elseif ($_GET['sort'] == 'Email')
    {
        $sql .= " ORDER BY Email";
    }
    elseif ($_GET['sort'] == 'Driver')
    {
        $sql .= " ORDER BY Driver";
    }
    elseif ($_GET['sort'] == 'Items')
    {
        $sql .= " ORDER BY Items";
    }
    elseif ($_GET['sort'] == 'ItemDesc')
    {
        $sql .= " ORDER BY ItemDesc";
    }
    elseif ($_GET['sort'] == 'QuantityType')
    {
        $sql .= " ORDER BY QuantityType";
    }
    elseif ($_GET['sort'] == 'Quantity')
    {
        $sql .= " ORDER BY Quantity";
    }
    elseif ($_GET['sort'] == 'Value')
    {
        $sql .= " ORDER BY Value";
    }
    elseif ($_GET['sort'] == 'Weight')
    {
        $sql .= " ORDER BY Weight";
    }
    elseif ($_GET['sort'] == 'Date')
    {
        $sql .= " ORDER BY Date";
    }
    }
    else
    {
        $sql .= " ORDER BY Date DESC";
    }

    $result = $conn->query($sql);
    if ( $result->num_rows > 0 ) 
    {
        while( $row = $result->fetch_assoc() ) 
        {
            echo "  <TR>\n";
            echo "   <TD><a href='edit.php?id=".$row['RecordId']."'>" .$row['Vendor']. "</a></TD>\n";
            echo "   <TD><a href='editdriver.php?name=".$row['Driver']."'>" .$row['Driver']. "</a></TD>\n";
            echo "   <TD>".$row['Items']."</TD>\n";
            echo "   <TD>".$row['ItemDesc']."</TD>\n";
            echo "   <TD>".$row['Quantity']."</TD>\n";
            echo "   <TD>".$row['QuantityType']."</TD>\n";
            echo "   <TD>$".number_format($row['Value'],2)."</TD>\n";
            echo "   <TD>$".number_format($row['Value'] * $row['Quantity'],2)."</TD>\n";
            echo "   <TD>".$row['Weight']." lbs</TD>\n";
            echo "   <TD>".$row['Weight'] * $row['Quantity']." lbs</TD>\n";
            if (!empty($row['Notes']))
            {
                echo "   <TD><abbr title=\"".$row['Notes']."\"><b>Note</b></abbr></TD>\n";
            }
            else
            {
                echo "   <TD></TD>\n";
            }
            echo "   <TD>".$row['Date']."</TD>\n";
            //echo "   <TD>".$row['Date']->format('Y-m-d H:i:s')."</TD>\n";
        }
    }
    echo " </p>\n";
    echo " <tr bgcolor='#6495ED'>\n";
    echo "  <th colspan='13' align='center' border='1'><a href='index.php'>Home</a></th>\n";
    echo " </tr>\n";

    echo "</table>\n";
    ?>
    </form> 
 </body> 
</html>