<!DOCTYPE html>
 <head> 
    <meta name="description" content="Php Code for View, Search, Add, Edit and Delete Record" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <title>Search ODB Donation Records</title> 
    <link rel="stylesheet" type="text/css" href="tcal.css" />
    <script type="text/javascript" src="tcal.js"></script>
     <script type='text/javascript'>
     function validate() 
     {
       if(document.forms["add"]['Vendor'].value == "")
       {
          alert("You need to select a Vendor");
          return false;
       }
       return true;
     }
    </script>
 </head> 
  <body> 
    <center><h1><u>ODB Donation Database</u></h1></center> 
     <form name="search" method="post" action="search.php"> 
      <table width="600" style="border:1px solid silver" cellpadding="10px" cellspacing="0px" align="center"> 
        <tr> 
         <td align="center" colspan="3" style="background:#6495ED; color:#FFFFFF; font-size:20px">Search by subject</td>
        </tr> 
        <tr>
         <td>Enter search criteria:</td> 
         <td><input type="text" name="search" size="24"></td> 
         <td colspan="1" align="right"><input type="submit" value="Search"></td> 
        </tr> 
      </table>
     </form>
     <form name="searchDate" action="search.php" method="POST">
      <table width="600" style="border:1px solid silver" cellpadding="10px" cellspacing="0px" align="center"> 
       <tr> 
        <td align="center" colspan="3" style="background:#6495ED; color:#FFFFFF; font-size:20px">Search by date</td>
       </tr> 
       <tr>
        <td><label for="fromDate">From Date:</label></td>
        <td align="center"><input type="text" name="datef" id="datef" alt="date" class="tcal" title="mm/dd/yyyy"></td>
       </tr>
       <tr>
        <td><label for="toDate">To Date:</label></td>
        <td align="center"><input type="text" name="datet" id="datet" alt="date" class="tcal" title="mm/dd/yyyy"></td>
        <td colspan="1" align="right"><input type="submit" value="Search" /></td>
       </tr>
      </table>
     </form>
     <form name="add" method="post" action="/add.php" onsubmit="return validate()">
      <table width="600" style="border:1px solid silver" cellpadding="10px" cellspacing="0px" align="center"> 
       <tr> 
         <td align="center" colspan="4" style="background:#6495ED; color:#FFFFFF; font-size:20px">Add Record</td>
       </tr> 
       <tr>
         <td>Select Vendor:</td> 
         <td align="center"><select name="Vendor">
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
                  if ( isset($_GET['Vendor']) and $_POST['Vendor'] === $row['Id']) echo ' selected="selected"';
                  echo ">".$row['Vendor']." - ".$row['City']."</option>\n";
                }
             }
           ?>
           </select></td>
         <td colspan="2" align="right"><input type="submit" value="Add"></td> 
       </tr> 
      <tr bgcolor="#6495ED" align=center> 
       <td colspan="1" align=center><b><a href="vendors.php">Vendors</a></b></td> 
       <td colspan="1" align=center><b><a href="drivers.php">Drivers</a></b></td> 
       <td colspan="2" align=center><b><a href="items.php">Items</a></b></td> 
      </tr> 
      <tr bgcolor="#6495ED" align=center> 
       <td colspan="1" align=center><b><a href="quantitytypes.php">Quantity Types</a></b></td> 
       <td colspan="1"></td>
       <td colspan="1" align=center><b><a href="list.php">List Records</a></b></td> 
      </tr> 
     </table> 
    </form>
 </body> 
</html>
