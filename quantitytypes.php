<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>ODB Donation Database</title>
     <style type="text/css">
        h1 {margin-bottom:20px}
        input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
        .note {color: #ff0000}
        .message {color:#006600}
     </style>
    </head>
    <body>
        <center><h1><u>ODB Donation Database</u></h1></center>
        <center><h3><span class="note">*</span> denotes mandatory</h3></center>
         <form name="quantitytypes" method="post" action="/quantitytypes.php"> 
          <table width="350" style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
            <tr>
                <td colspan="4" style="background:#6495ED; color:#FFFFFF; font-size:20px" align="center">Current Types</td>
            </tr>
<?php
    require 'creds.php';
    $newtype = NULL;
    $message = NULL;

    if(isset($_POST['do']) and $_POST['do']=="store") 
    {
        try
        {
            if (!empty($_POST['Type']))
            { 
                $newtype = $_POST['Type'];
                $sql = "SELECT Type FROM QuantityType WHERE Type='$newtype'";
                $result = $conn->query($sql);
                if ( $result->num_rows > 0 )   
                {
                    $message = "Type already exists";
                }
                else
                {
                    $sql = "INSERT INTO QuantityType (Type) VALUES ('$newtype')";

                    if ($conn->query($sql) === TRUE)
                    {
                        $message = "New type added successfully";
                        //header('Location: index.php');
                    }
                    else
                    {
                        $message = "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
            else
            {
                $message = "You must enter a Type!";
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

    try
    {
        $sql    = "SELECT * FROM QuantityType ORDER BY TYPE";
        $result = $conn->query($sql);
        if ( $result->num_rows > 0 ) 
        {
            while($row = $result->fetch_assoc()) 
            {
                echo "            <tr>\n";
                echo "              <td width=\"200\" colspan=\"2\" align=\"center\">".$row['Type']."</td>\n";
                echo "              <td colspan=\"1\" align=\"center\"><a href=\"editquantitytype.php?id=".$row['Id']."\"><b>Edit</b></a></td>\n";
                echo "              <td colspan=\"1\" align=\"center\"><a href=\"deletequantitytype.php?id=".$row['Id']."\"><b>Delete</b></a></td>\n";
                echo "            </tr>\n";
            }
        }
        else 
        {
            $message = "Query returned zero results";  
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
         </table>
          <table width="350" style="border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
           <tr> 
             <td align="center" colspan="4" style="background:#6495ED; color:#FFFFFF; font-size:20px">Add Type</td>
           </tr> 
           <tr>
             <td><b>Enter New Type:</b><span class="note">*</span></td>
             <td><input type="text" name="Type" size="10" value="<?php if(isset($_POST['Type'])) echo $_POST['Type']; ?>"></td>
             <td colspan="2" align="center"><input type="hidden" name="do" value="store"><input type="submit" value="Add"></td> 
           </tr>
           <?php
             if (!empty($message))
             {
                echo "<tr>\n";
                echo "             <td colspan=\"4\" align=\"center\"><p class=\"note\"><b>$message</b></td>\n";
                echo "           <tr>\n";
             }
           ?>
           <tr bgcolor="#6495ED">
             <th colspan="4" align="center"><a href="index.php">Home</a></th>
           </tr>
        </table>
       </form>
    </body>
</html>