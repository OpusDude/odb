<html>
 <head> 
    <meta name="description" content="Php Code for View, Search, Add, Edit and Delete Record" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <title>Search ODB Donation Records</title> 
 </head> 
 <?php
        $serverName = "localhost";
        $username   = "xxxx";
        $password   = "xxxxxxxxxxx";
        $dbname     = "xxxxxx";


        $conn = mysqli_connect($serverName, $username, $password, $dbname);
        if( $conn->connect_error ) {
            echo "Connection could not be established.<br/>";
            die($conn->connect_error);
        }

        if ( isset($_POST['osType']) )
        {
            $varType = $_POST['osType'];
        }
        elseif (!empty($_GET['osType']))
        {
            $varType = $_GET['osType'];
        }
        else
        {
            $varType = 'ALL';
        }
    ?>
 <body> 
    <center><h1><u>ODB Donation Database</u></h1></center> 
    <form name="search" method="post" action="search.php"> 
        <table style=" border:1px solid silver" cellpadding="10px" cellspacing="0px" align="center"> 
        <tr> 
            <td colspan="3" style="background:#6495ED; color:#FFFFFF; font-size:20px">Search</td>
        </tr> 
        <tr> 
            <td>Enter System Name</td> 
            <td><input type="text" name="search" size="40" /></td> 
            <td><input type="submit" value="Search" /></td> 
        </tr> 
        <tr> 
            <td colspan="3">&nbsp;</td>
        </tr> 
        <tr bgcolor="#6495ED"> 
            <th></th> 
            <th><a href="add.php">Add Record</a></th> 
            <th></th> 
        </tr> 
        </table> 
    </form>
   
    <form name="SystemType" method="post" action="">
    <table border="2" cellpadding="12" cellspacing="0px" align="center">
    <p style="font-size:10px">
    <TR>
    <TD><select name="osType">
        <option value="ALL" <?php echo ($varType == 'ALL' ? 'selected="selected"' : '') ?>>All Systems</option>
        <option value="BUILD" <?php echo ($varType == 'BUILD' ? 'selected="selected"' : '') ?>>Build Systems</option>
        <option value="DEV" <?php echo ($varType == 'DEV' ? 'selected="selected"' : '') ?>>Dev Systems</option>
        <option value="INFRA" <?php echo ($varType == 'INFRA' ? 'selected="selected"' : '') ?>>Infra Systems</option>
        <option value="TEST" <?php echo ($varType == 'TEST' ? 'selected="selected"' : '') ?>>Test Systems</option>
    </select>
        <input type="submit" name="Submit" value="Select" /></TD>
        <TD colspan="2" align="center"><b>Number of Systems: <?php echo $numSystems; ?></b></TD>
        <TD colspan="3" align="center"><b># Unavailable: <?php echo $numUnknown; ?></b></TD>
        <TD colspan="2" align="center"><b>% Available: <?php echo round(100 - ($numUnknown/$numSystems * 100),2); ?></b></TD>
    </TR>
    <TR>
        <TH bgcolor=#6495ED><a href="index.php?sort=Name&osType=<?php echo $varType ?>" style="color:black">Name</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Vendor&osType=<?php echo $varType ?>" style="color:black">Vendor</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Email&osType=<?php echo $varType ?>" style="color:black">Email</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Driver&osType=<?php echo $varType ?>" style="color:black">Driver</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Items&osType=<?php echo $varType ?>" style="color:black">Items</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Quantity&osType=<?php echo $varType ?>" style="color:black">Quantity</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Value&osType=<?php echo $varType ?>" style="color:black">Value</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Weight&osType=<?php echo $varType ?>" style="color:black">Weight</a></TH>
        <TH bgcolor=#6495ED><a href="index.php?sort=Date&osType=<?php echo $varType ?>" style="color:black">Date</a></TH>
    </TR>

    <?php
    if (empty($varType) || $varType == 'ALL')
    {
    $sql = "SELECT * FROM Donation";
    }
    else
    {
    $sql = "SELECT * FROM Donation WHERE Type = '$varType'";
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
        $sql .= " ORDER BY Date";
    }

    $result = $conn->query($sql);
    if ( $result->num_rows > 0 ) 
    {
        while( $row = $result->fetch_assoc() ) 
        {
            echo "  <TR>\n";
            echo "   <TD><a href='view.php?name=".$row['Name']."'>" .$row['Name']. "</a></TD>\n";
            echo "   <TD>".$row['Vendor']."</TD>\n";
            if ($row['Email'] == 'Unknown')
            {
                echo "   <TD bgcolor=#FF0000>".$row['Email']."</TD>\n";
            }
            else
            {
                echo "   <TD bgcolor=#00FF00>".$row['Email']."</TD>\n";
            }
            echo "   <TD>".$row['Driver']."</TD>\n";
            echo "   <TD>".$row['Items']."</TD>\n";
            echo "   <TD>".$row['Quantity']."</TD>\n";
            echo "   <TD>".$row['Value']."</TD>\n";
            echo "   <TD>".$row['Weight']."</TD>\n";
            echo "   <TD>".$row['Date']."</TD>\n";
            //echo "   <TD>".$row['Date']->format('Y-m-d H:i:s')."</TD>\n";
        }
    echo " </p>\n";
    echo "</table>\n";
    }
    else
    {
        echo "Query failed.<br />";  
        die( FormatErrors( sqlsrv_errors() ) );
    }

    function FormatErrors( $errors )
    {
        /* Display errors. */
        echo "Error information: <br/>";
        foreach ( $errors as $error )
        {
            echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
            echo "Code: ".$error['code']."<br/>";
            echo "Message: ".$error['message']."<br/>";
        }
    }
    ?>
    </form> 
 </body> 
</html>
