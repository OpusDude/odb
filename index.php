<html>
 <head> 
    <meta name="description" content="Php Code for View, Search, Add, Edit and Delete Record" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <title>Search ODB Donation Records</title> 
 </head> 
 <script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
 <body> 
    <center><h1><u>ODB Donation Database</u></h1></center> 
    <table style=" border:1px solid silver" cellpadding="10px" cellspacing="0px" align="center"> 
      <form name="search" method="post" action="search.php"> 
        <tr> 
          <td colspan="4" style="background:#6495ED; color:#FFFFFF; font-size:20px">Search by subject:</td>
        </tr> 
        <tr> 
          <td>Enter search criteria</td> 
          <td><input type="text" name="search" size="40" /></td> 
          <td><input type="submit" value="Search" /></td> 
        </tr> 
      </form>
      <tr> 
        <td colspan="4" style="background:#6495ED; color:#FFFFFF; font-size:20px">Search by date:</td>
      </tr> 
      <tr>
        <form name="searchDate" action="search.php" method="POST">
        <td><label for="fromDate">From Date:</label></td>
        <td><input type="text" name="datef" id="datef" alt="date" class="IP_calendar" title="d/m/Y"></td>
      </tr>
      <tr>
        <td><label for="toDate">To Date:</label></td>
        <td><input type="text" name="datet" id="datet" alt="date" class="IP_calendar" title="d/m/Y"></td>
        <td><input type="submit" value="Search" /></td>
       </form>
      </tr>
      <form name="add" method="post" action="add.php"> 
        <tr> 
          <td colspan="4" style="background:#6495ED; color:#FFFFFF; font-size:20px">Add Record:</td>
        </tr> 
        <tr>
          <td>Select Vendor</td> 
          <td><select name="Vendor">
            <option value="">Select Vendor</option>
            <?php
             require 'creds.php';

             $sql = "SELECT * FROM Vendor ORDER BY Vendor";
             $result = $conn->query($sql);

             if ( $result->num_rows > 0 ) 
             {
                while( $row = $result->fetch_assoc() ) 
                {
                  echo "   <option value=".$row['Id'];
                  if ($_POST['Vendor'] === $row['Id']) echo ' selected="selected"';
                  echo ">".$row['Vendor']." - ".$row['City']."</option>\n";
                }
             }
            ?>
            </select></td>
          <td><input type="submit" value="Add" /></td> 
        </tr> 
      </form>
      <tr bgcolor="#6495ED" align=center> 
        <td colspan="1" align=center><b><a href="vendor.php">Add Vendor</a></b></td> 
        <td colspan="1" align=center><b><a href="driver.php">Add Driver</a></b></td> 
        <td colspan="1" align=center><b><a href="list.php">List Records</a></b></td> 
      </tr> 
    </table> 
 </body> 
</html>
