<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>OSTC Infra Systems Database</title>
     <style type="text/css">
       h1 {margin-bottom:20px}
       input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
       .note {color: #ff0000}
       .success_msg{color:#006600}
       .failure_msg{color:#FF0000}
     </style>
    </head>
    <body>
<?php
    $serverName = "(local)";
    $connectionOptions = array("Database"=>"xxxxx");
    $name=$_GET["name"];
    $secret="xxxxxxxxxx";

    /* Connect using Windows Authentication. */

    $conn = sqlsrv_connect( $serverName, $connectionOptions);
    if( $conn === false ) {
        echo "Connection could not be established.<br/>";
        die( FormatErrors( sqlsrv_errors() ) );
    }
    
    if($_POST["do"]=="delete")
    { 
        if($_POST['password'] === $secret)
        {
            $tsql = "DELETE from Systems WHERE Name = '" . $name . "'";
    
            $result = sqlsrv_query( $conn,$tsql );
            
            if ($result)
            {
                $msg_success = "System " .$name. " successfully deleted from database";
            }
            else 
            {
                echo "Query failed.<br />";  
                die( FormatErrors( sqlsrv_errors() ) );
            }
        }
        else 
        {
            $msg_failure = "Invalid password!";
        }
    } 
?>
      <div class="container">
         <center><h1><u>OSTC Infra Systems Database</u></h1></center>
         <center><h3 class="success_msg"><?php echo $msg_success; ?></h3></center>
         <center><h3 class="failure_msg"><?php echo $msg_failure; ?></h3></center>
         <form id="delete_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?name=<?php echo $name; ?>">
          <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="1">
            <tr>
                <td colspan="4" style="background:#6495ED; color:black; font-size:20px" align="center">Delete System Record</td>
            </tr>
            <tr>
                <td><b>System to Delete: <?php echo $name; ?></b></td>
                <td><b>Enter Password:</b></td>
                <td><input type="password" id="password" name="password" size="20"></td>
                <td colspan="4" align="right"><input type="hidden" name="do" value="delete"><input type="submit" value="Delete Record"></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr bgcolor="#6495ED">
                <th colspan="4" align="center" border="1"><a href="index.php">Home</a></th>
            </tr>
           </table>                
        </form>
      </div>
   </body>
</html>
