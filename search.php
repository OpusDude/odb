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
        <td align="center"><b><font color="black">Name</font></b></td>
        <td align="center"><b><font color="black">Vendor</font></b></td>
        <td align="center"><b><font color="black">Email</font></b></td>
        <td align="center"><b><font color="black">Driver</font></b></td>
        <td align="center"><b><font color="black">Item</font></b></td>
        <td align="center"><b><font color="black">Item Description</font></b></td>
        <td align="center"><b><font color="black">Quantity</font></b></td>
        <td align="center"><b><font color="black">$ Value</font></b></td>
        <td align="center"><b><font color="black">Weight (lbs)</font></b></td>
        <td align="center"><b><font color="black">Date</font></b></td>
        <td>&nbsp;</td>
<?php
 require 'creds.php';

 $search     = $_POST["search"];
 $holdFrom   = explode("/", $_POST["datef"]);
 $fromDate   = $holdFrom[2]. "-" .$holdFrom[1]. "-" .$holdFrom[0];
 $holdTo     = explode("/", $_POST["datet"]);
 $toDate     = $holdTo[2]. "-" .$holdTo[1]. "-" .$holdTo[0];

 try
 {
   if (empty($search))
   {
     $sql  = "SELECT * FROM Donation WHERE Date > '$fromDate' AND Date < '$toDate'";
     $sqlw = "SELECT SUM(Weight) as sum_weight FROM Donation WHERE Date > '$fromDate' AND Date < '$toDate'";
     $sqlv = "SELECT SUM(Value) as sum_value FROM Donation WHERE Date > '$fromDate' AND Date < '$toDate'";
   }
   else
   {
     $sql  = "SELECT * FROM Donation WHERE Name   LIKE '%$search%' 
                                      OR Vendor   LIKE '%$search%'
                                      OR Email    LiKE '%$search%'
                                      OR Driver   LIKE '%$search%'
                                      OR Items    Like '%$search%'
                                      OR ItemDesc LIKE '%$search%'";

     $sqlw = "SELECT SUM(Weight) as sum_weight FROM Donation WHERE Name   LIKE '%$search%' 
                                                              OR Vendor   LIKE '%$search%'
                                                              OR Email    LiKE '%$search%'
                                                              OR Driver   LIKE '%$search%'
                                                              OR Items    Like '%$search%'
                                                              OR ItemDesc LIKE '%$search%'";

     $sqlv = "SELECT SUM(Value) as sum_value FROM Donation WHERE Name   LIKE '%$search%' 
                                                            OR Vendor   LIKE '%$search%'
                                                            OR Email    LiKE '%$search%'
                                                            OR Driver   LIKE '%$search%'
                                                            OR Items    Like '%$search%'
                                                            OR ItemDesc LIKE '%$search%'";
   }
     $result = $conn->query($sql);
     if ( $result->num_rows > 0 ) 
     {
        while( $row = $result->fetch_assoc() ) 
        { 
          echo "  <tr>\n";
          echo "   <td><a href='view.php?id=".$row['Id']."'>" .$row['Name']. "</a></td>\n";
          echo "   <td>".$row['Vendor']."</td>\n";
          if ($row['Email'] == 'Unknown')
          {
              echo "   <td bgcolor=#FF0000>".$row['Email']."</td>\n";
          }
          else
          {
              echo "   <td bgcolor=#00FF00><a href='mailto:".$row['Email']."'>".$row['Email']."</td>\n";
          }
          echo "   <td>".$row['Driver']."</td>\n";
          echo "   <td>".$row['Items']."</td>\n";
          echo "   <td>".$row['ItemDesc']."</td>\n";
          echo "   <td>".$row['Quantity']."</td>\n";
          echo "   <td>".$row['Value']."</td>\n";
          echo "   <td>".$row['Weight']."</td>\n";
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
       echo "<tr>";
       echo "  <td colspan='11' align='center' style='color:red'>Record not found</td>";
       echo "</tr>";
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
        <td colspan="3" align="center"><b>Number of Items: <?php echo $numItems; ?></b></td>
        <td colspan="4" align="center"><b>Total Weight (lbs): <?php echo $totalWeight['sum_weight']; ?></b></td>
        <td colspan="4" align="center"><b>Total Value: $<?php echo round($totalValue['sum_value'],2); ?></b></td>
      </tr>
      <tr bgcolor="#6495ED">
        <th colspan="11" align="center"><a href="index.php">Home</a></th>
      </tr>
    </table>
  </body>
</html>
