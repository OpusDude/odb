<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>ODB Donation Database</title>
    </head>
    <body>
        <center><h1><u>ODB Donation Database</u></h1></center>
          <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
            <tr>
                <td colspan="4" style="background:#6495ED; color:black; font-size:20px" align="center">View System Record</td>
            </tr>
<?php
    require 'creds.php';

    try
    {
        $sql    = "SELECT * FROM Donation WHERE Id = '".$rec_id."'";
        $result = $conn->query($sql);
        if ( $result->num_rows > 0 ) 
        {
            while($row = $result->fetch_assoc()) 
            {
                echo "  <tr>";
                echo "     <td><b>Name:</b></td>";
                echo "     <td>".$row['Name']."</td>";
                echo "     <td><b>Vendor:</b></td>";
                echo "     <td>".$row['Vendor']."</td>";
                echo "  </tr>";
                echo "  <tr>";
                echo "     <td><b>Email:</b></td>";
                if ($row['Email'] == 'Unknown')
                {
                    echo "   <td bgcolor=#FF0000>".$row['Email']."</td>\n";
                }
                else
                {
                    echo "   <td bgcolor=#00FF00><a href='mailto:".$row['Email']."'>".$row['Email']."</td>\n";
                }
                echo "     <td><b>Driver:</b></td>";
                echo "     <td>".$row['Driver']."</td>";
                echo "  </tr>";
                echo "  <tr>";
                echo "     <td><b>Item:</b></td>";
                echo "     <td>".$row['Items']."</td>";
                echo "     <td><b>Item Description:</b></td>";
                echo "     <td>".$row['ItemDesc']."</td>";
                echo "  </tr>";
                echo "  <tr>";
                echo "     <td><b>Quantity:</b></b></td>";
                echo "     <td>".$row['Quantity']."</td>";
                echo "     <td><b>$ Value:</b></td>";
                echo "     <td>".$row['Value']."</td>";
                echo "  </tr>";
                echo "  <tr>";
                echo "     <td><b>Weight:</b></td>";
                echo "     <td>".$row['Weight']."</td>";
                echo "     <td><b>Date:</b></td>";
                echo "     <td>".$row['Date']."</td>";
                echo "  </tr>";
            }
        }
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;  
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
                <td colspan="4">&nbsp;</td>  
             </tr>
             <tr>
               <td colspan="2">&nbsp;</td>
               <td colspan="1" align="center"><a href="edit.php?id=<?php echo $rec_id; ?>"><b>Edit</b></a></td>
               <td colspan="1" align="center"><a href="delete.php?id=<?php echo $rec_id; ?>"><b>Delete</b></a></td>
             </tr>
             <tr bgcolor="#6495ED">
               <th colspan="4" align="center"><a href="index.php">Home</a></th>
             </tr>
           </table>
    </body>
</html>
