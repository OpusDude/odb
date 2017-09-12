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
                $sql2 = "SELECT SUM(Weight) as sum_weight FROM Donation";
                $sql3 = "SELECT SUM(Value) as sum_value FROM Donation";
            }
            else
            {
                $sql1 = "SELECT * FROM Donation WHERE Items = '$varType'";
                $sql2 = "SELECT SUM(Weight) as sum_weight FROM Donation WHERE Items = '$varType'";
                $sql3 = "SELECT SUM(Value) as sum_value FROM Donation WHERE Items = '$varType'";
            }
        }
        elseif (!empty($_GET['itemType']))
        {
            $varType = $_GET['itemType'];
            if ( $varType == 'ALL' )
            {
                $sql1 = "SELECT * FROM Donation";
                $sql2 = "SELECT SUM(Weight) as sum_weight FROM Donation";
                $sql3 = "SELECT SUM(Value) as sum_value FROM Donation";
            }
            else
            {
                $sql1 = "SELECT * FROM Donation WHERE Items = '$varType'";
                $sql2 = "SELECT SUM(Weight) as sum_weight FROM Donation WHERE Items = '$varType'";
                $sql3 = "SELECT SUM(Value) as sum_value FROM Donation WHERE Items = '$varType'";
            }
        }
        else
        {
            $varType = 'ALL';
            $sql1 = "SELECT * FROM Donation";
            $sql2 = "SELECT SUM(Weight) as sum_weight FROM Donation";
            $sql3 = "SELECT SUM(Value) as sum_value FROM Donation";
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
    <TD><select name="itemType">
        <option value="ALL" <?php echo ($varType == 'ALL' ? 'selected="selected"' : '') ?>>All Items</option>
        <option value="Baked Goods" <?php echo ($varType == 'Baked Goods' ? 'selected="selected"' : '') ?>>Baked Goods</option>
        <option value="Bread" <?php echo ($varType == 'Bread' ? 'selected="selected"' : '') ?>>Bread</option>
        <option value="Canned Goods" <?php echo ($varType == 'Canned Goods' ? 'selected="selected"' : '') ?>>Canned Goods</option>
        <option value="Coffee" <?php echo ($varType == 'Coffee' ? 'selected="selected"' : '') ?>>Coffee</option>
        <option value="Dairy" <?php echo ($varType == 'Dairy' ? 'selected="selected"' : '') ?>>Dairy</option>
        <option value="Fruit" <?php echo ($varType == 'Fruit' ? 'selected="selected"' : '') ?>>Fruit</option>
        <option value="Paper Products" <?php echo ($varType == 'Paper Products' ? 'selected="selected"' : '') ?>>Paper Products</option>
        <option value="Meat" <?php echo ($varType == 'Meat' ? 'selected="selected"' : '') ?>>Meat</option>
        <option value="Staples" <?php echo ($varType == 'Staples' ? 'selected="selected"' : '') ?>>Staples</option>
        <option value="Other" <?php echo ($varType == 'Other' ? 'selected="selected"' : '') ?>>Other</option>
    </select>
        <input type="submit" name="Submit" value="Select" /></TD>
        <TD colspan="2" align="center"><b>Number of Items: <?php echo $numItems; ?></b></TD>
        <TD colspan="4" align="center"><b>Total Weight (lbs): <?php echo $totalWeight['sum_weight']; ?></b></TD>
        <TD colspan="4" align="center"><b>Total Value: $<?php echo round($totalValue['sum_value'],2); ?></b></TD>
    </TR>
    <TR>
        <TH bgcolor=#6495ED><a href="list.php?sort=Name&itemType=<?php echo $varType ?>" style="color:black">Vendor Contact</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Vendor&itemType=<?php echo $varType ?>" style="color:black">Vendor</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Email&itemType=<?php echo $varType ?>" style="color:black">Email</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Driver&itemType=<?php echo $varType ?>" style="color:black">Driver</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Items&itemType=<?php echo $varType ?>" style="color:black">Item</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=ItemDesc&itemType=<?php echo $varType ?>" style="color:black">Item Description</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=QuantityType&itemType=<?php echo $varType ?>" style="color:black">QuantityType</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Quantity&itemType=<?php echo $varType ?>" style="color:black">Quantity</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Value&itemType=<?php echo $varType ?>" style="color:black">Value</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Weight&itemType=<?php echo $varType ?>" style="color:black">Weight</a></TH>
        <TH bgcolor=#6495ED><a href="list.php?sort=Date&itemType=<?php echo $varType ?>" style="color:black">Date</a></TH>
    </TR>

    <?php
    if (empty($varType) || $varType == 'ALL')
    {
    $sql = "SELECT Donation.Id, Donation.Vendor AS VendorId, Vendor.Contact AS Name, Vendor.Email AS Email,
            Vendor.Vendor AS Vendor, Donation.Driver AS DriverId, Driver.Driver AS Driver, Donation.Items, 
            Donation.ItemDesc, Donation.QuantityType, Donation.Quantity, Donation.Value, Donation.Weight, Donation.Date 
            FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
            INNER JOIN Driver on Donation.Driver = Driver.Id";
    }
    else
    {
    $sql = "SELECT * FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id WHERE Items = '$varType'";
    }
    if (!empty($_GET['sort']))
    {
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
            echo "   <TD><a href='view.php?id=".$row['VendorId']."'>" .$row['Name']. "</a></TD>\n";
            echo "   <TD>".$row['Vendor']."</TD>\n";
            echo "   <TD bgcolor=#00FF00><a href='mailto:".$row['Email']."'>".$row['Email']."</TD>\n";
            echo "   <TD>".$row['Driver']."</TD>\n";
            echo "   <TD>".$row['Items']."</TD>\n";
            echo "   <TD>".$row['ItemDesc']."</TD>\n";
            echo "   <TD>".$row['QuantityType']."</TD>\n";
            echo "   <TD>".$row['Quantity']."</TD>\n";
            echo "   <TD>".$row['Value']."</TD>\n";
            echo "   <TD>".$row['Weight']."</TD>\n";
            echo "   <TD>".$row['Date']."</TD>\n";
            //echo "   <TD>".$row['Date']->format('Y-m-d H:i:s')."</TD>\n";
        }
    }
    echo " </p>\n";
    echo " <tr bgcolor='#6495ED'>\n";
    echo "  <th colspan='11' align='center' border='1'><a href='index.php'>Home</a></th>\n";
    echo " </tr>\n";

    echo "</table>\n";
    ?>
    </form> 
 </body> 
</html>