<html>
  <head>
    <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Search Donation</title>
  </head>
  <body>
    <center><h1><u>ODB Donation Database</u></h1></center>
    <table style=" border:1px solid silver" cellpadding="5px" cellspacing="0px" align="center" border="1">
      <tr bgcolor="#6495ED" style="color:#FFFFFF">
        <td align="center"><b><font color="black">Vendor</font></b></td>
        <td align="center"><b><font color="black">Driver</font></b></td>
        <td align="center"><b><font color="black">Item</font></b></td>
        <td align="center"><b><font color="black">Item Description</font></b></td>
        <td align="center"><b><font color="black">Quantity</font></b></td>
        <td align="center"><b><font color="black">Quantity Type</font></b></td>
        <td align="center"><b><font color="black">Value</font></b></td>
        <td align="center"><b><font color="black">Total Value</font></b></td>
        <td align="center"><b><font color="black">Weight</font></b></td>
        <td align="center"><b><font color="black">Total Weight</font></b></td>
        <td align="center"><b><font color="black">Notes</font></b></td>
        <td align="center"><b><font color="black">Date</font></b></td>
        <td>&nbsp;</td>
<?php
 require 'creds.php';

 if (isset($_POST['search']))
 {
    $search     = $_POST["search"];
 }
 if (isset($_POST['datef']) and isset($_POST['datet']))
 {
    $holdFrom   = explode("/", $_POST["datef"]);
    $fromDate   = $holdFrom[2]. "-" .$holdFrom[0]. "-" .$holdFrom[1];
    $holdTo     = explode("/", $_POST["datet"]);
    $toDate     = $holdTo[2]. "-" .$holdTo[0]. "-" .$holdTo[1];
 }

 try
 {
   if (empty($search))
   {
     $sql = "SELECT Donation.Id As Id, Donation.Vendor AS VendorId, Vendor.Contact AS Name, Donation.Notes,
     Vendor.Email AS Email, Vendor.Vendor AS Vendor, Donation.Driver AS Driver, Donation.Items,
     Donation.ItemDesc, Donation.QuantityType, Donation.Quantity, Donation.Value, Donation.Weight, Donation.Date 
     FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
     WHERE Date > '$fromDate' AND Date < '$toDate'";

     $sqlw = "SELECT SUM(Quantity * Weight) as sum_weight FROM Donation WHERE Date > '$fromDate' AND Date < '$toDate'";
     $sqlv = "SELECT SUM(Quantity * Value) as sum_value FROM Donation WHERE Date > '$fromDate' AND Date < '$toDate'";
   }
   else
   {
     $sql = "SELECT Donation.Id As Id, Donation.Vendor AS VendorId, Vendor.Contact AS Name, Donation.Notes,
             Vendor.Email AS Email, Vendor.Vendor AS Vendor, Donation.Driver AS Driver, Donation.Items,
             Donation.ItemDesc, Donation.QuantityType, Donation.Quantity, Donation.Value, Donation.Weight, Donation.Date 
             FROM `Donation` INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
             WHERE Vendor.Vendor LIKE '%$search%' 
             OR Driver           LIKE '%$search%'
             OR Items            Like '%$search%'
             OR QuantityType     Like '%$search%'
             OR ItemDesc         LIKE '%$search%'";

     $sqlw = "SELECT SUM(Quantity * Weight) as sum_weight FROM Donation
              INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
              WHERE Vendor.Vendor  LIKE '%$search%' 
              OR Driver            LIKE '%$search%'
              OR Items             LIke '%$search%'
              OR QuantityType      Like '%$search%'
              OR ItemDesc          LIKE '%$search%'";

     $sqlv = "SELECT SUM(Quantity * Value) as sum_value FROM Donation
              INNER JOIN Vendor on Donation.Vendor = Vendor.Id 
              WHERE Vendor.Vendor LIKE '%$search%' 
              OR Driver           LIKE '%$search%'
              OR Items            LIKE '%$search%'
              OR QuantityType     Like '%$search%'
              OR ItemDesc         LIKE '%$search%'";
   }
     $result = $conn->query($sql);
     if ( $result->num_rows > 0 ) 
     {
        while( $row = $result->fetch_assoc() ) 
        { 
          echo "  <tr>\n";
          echo "   <td>".$row['Vendor']."</td>\n";
          echo "   <td>".$row['Driver']."</td>\n";
          echo "   <td>".$row['Items']."</td>\n";
          echo "   <td>".$row['ItemDesc']."</td>\n";
          echo "   <td>".$row['Quantity']."</td>\n";
          echo "   <td>".$row['QuantityType']."</td>\n";
          echo "   <td>$".number_format($row['Value'],2)."</td>\n";
          echo "   <td>$".number_format($row['Value'] * $row['Quantity'],2)."</td>\n";
          echo "   <td>".$row['Weight']." lbs</td>\n";
          echo "   <td>".$row['Weight'] * $row['Quantity']." lbs</td>\n";
          if (!empty($row['Notes']))
          {
              echo "   <TD><abbr title=\"".$row['Notes']."\"><b>Note</b></abbr></TD>\n";
          }
          else
          {
              echo "   <TD></TD>\n";
          }
          echo "   <td>".$row['Date']."</td>\n";
          echo "   <td><a href='edit.php?id=".$row['Id']."'>Edit</a> | <a href='delete.php?id=".$row['Id']."'>Delete</a></td>";
          echo "  </tr>";
        }
        $numItems = mysqli_num_rows($result);
        $result = $conn->query($sqlw);
        $totalWeight = mysqli_fetch_assoc($result);
        $result = $conn->query($sqlv);
        $totalValue = mysqli_fetch_assoc($result);
     }
     else
     {
       echo "<tr>\n";
       echo "  <td colspan='13' align='center' style='color:red'>Record not found</td>\n";
       echo "</tr>\n";
     }
 }
catch(Exception $e)
{
  echo $message = $e->getMessage();
  if ( strpos($message, 'error in your SQL syntax') !== false )
  {
    $message = "Error: Verify there are no single quotes used in any field";
  }
}
?>
      <tr>
        <td colspan="4" align="center"><b>Number of Items: <?php if(isset($numItems)) echo $numItems; ?></b></td>
        <td colspan="4" align="center"><b>Sum of Total Value: $<?php if(isset($totalValue)) echo number_format($totalValue['sum_value'],2); ?></b></td>
        <td colspan="5" align="center"><b>Sum of Total Weight: <?php if(isset($totalWeight)) echo $totalWeight['sum_weight']; ?> lbs</b></td>
      </tr>
      <tr bgcolor="#6495ED">
        <th colspan="13" align="center"><a href="index.php">Home</a></th>
      </tr>
    </table>
  </body>
</html>
