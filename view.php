<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>OSTC Infra Systems Database</title>
    </head>
    <body>
        <center><h1><u>OSTC Infra Systems Database</u></h1></center>
          <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
            <tr>
                <td colspan="4" style="background:#6495ED; color:black; font-size:20px" align="center">View System Record</td>
            </tr>
<?php
    $serverName = "(local)";
    $connectionOptions = array("Database"=>"xxxxxx");
    $name=$_GET["name"];

    /* Connect using Windows Authentication. */

    $conn = sqlsrv_connect( $serverName, $connectionOptions);
    if( $conn === false ) {
        echo "Connection could not be established.<br/>";
        die( FormatErrors( sqlsrv_errors() ) );
    }

    $tsql = "SELECT * FROM Systems WHERE Name = '" . $name . "'";
    $result = sqlsrv_query( $conn,$tsql );
    if ( $result ) 
    {
        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
        {
            echo "  <tr>";
            echo "     <td><b>System Name:</b></td>";
            echo "     <td>".$row['Name']."</td>";
            echo "     <td><b>OS:</b></td>";
            echo "     <td>".$row['OS']."</td>";
            echo "  </tr>";
            echo "  <tr>";
            echo "     <td><b>Type:</b></td>";
            echo "     <td>".$row['Type']."</td>";
            echo "     <td><b>Rack:</b></td>";
            echo "     <td>".$row['Rack']."</td>";
            echo "  </tr>";
            echo "  <tr>";
            echo "     <td><b>Physical Name:</b></td>";
            echo "     <td>".$row['Physical_Name']."</td>";
            echo "     <td><b>Serial #:</b></td>";
            echo "     <td>".$row['Serial_Number']."</td>";
            echo "  </tr>";
            echo "  <tr>";
            echo "     <td><b>Model:</b></b></td>";
            echo "     <td>".$row['Model']."</td>";
            echo "     <td><b>Support:</b></td>";
            echo "     <td>".$row['Support']."</td>";
            echo "  </tr>";
            echo "  <tr>";
            echo "     <td><b>Asset Tag:</b></td>";
            echo "     <td>".$row['Asset_Tag']."</td>";
            echo "     <td><b>Amount of Memory(GB):</b></td>";
            echo "     <td>".$row['Memory_GB']."</td>";
            echo "  </tr>";
            echo "  <tr>";
            echo "     <td><b>Uptime:</b></td>";
            echo "     <td>".$row['Uptime']."</td>";
            echo "     <td><b>Number of CPUs:</b></td>";
            echo "     <td>".$row['CPU']."</td>";
            echo "  </tr>";
        }
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
             <tr>
                <td colspan="4">&nbsp;</td>  
             </tr>
             <tr>
               <td colspan="2">&nbsp;</td>
               <td colspan="1" align="center"><a href="edit.php?name=<?php echo $name; ?>"><b>Edit</b></a></td>
               <td colspan="1" align="center"><a href="delete.php?name=<?php echo $name; ?>"><b>Delete</b></a></td>
             </tr>
             <tr bgcolor="#6495ED">
               <th colspan="4" align="center"><a href="index.php">Home</a></th>
             </tr>
           </table>
    </body>
</html>
