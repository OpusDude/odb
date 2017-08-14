<html>
  <head>
    <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Search System Name</title>
  </head>
  <body>
    <center><h1><u>OSTC Infra Systems Database</u></h1></center>

<?php
  $serverName = "(local)";
  $connectionOptions = array("Database"=>"xxxxxx");
  
  /* Connect using Windows Authentication. */

  $conn = sqlsrv_connect( $serverName, $connectionOptions);
  if( $conn === false ) {
    echo "Connection could not be established.<br/>";
    die( FormatErrors( sqlsrv_errors() ) );
  }
?>

    <form name="search" method="post" action="search.php">
      <table style=" border:1px solid silver" cellpadding="5px" cellspacing="0px" align="center" border="1">
        <tr>
          <td colspan="3" style="background:#6495ED; color:black; fontsize:20px"><b>Search</b></td>
        </tr>
        <tr>
          <td><font color="black">Enter System Name</font></td>
          <td><input type="text" name="search" size="40" /></td>
          <td><input type="submit" value="Search" /></td>
        </tr>
        <tr bgcolor="#6495ED" style="color:#FFFFFF">
          <td><b><font color="black">System Name</font></b></td>
          <td><b><font color="black">OS</font></b></td>
          <td>&nbsp;</td>

<?php
  $search=$_POST["search"];
  $flag=0;
  $tsql = "SELECT Name, OS FROM Systems WHERE Name LIKE '%" . $search . "%'";
  $result = sqlsrv_query( $conn,$tsql );
  while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
  {
    $flag=1;
    echo "<tr>";
    echo "  <td><a href='view.php?name=".$row['Name']."'>".$row['Name']."</a></td>";
    echo "  <td>".$row['OS']."</td>";
    echo "  <td><a href='edit.php?name=".$row['Name']."'>Edit</a> | <a href='delete.php?name=".$row['Name']."'>Delete</a></td>";
    echo "</tr>";
  }
  if($flag==0)
  {
    echo "<tr>";
    echo "  <td colspan='3' align='center' style='color:red'>Record not found</td>";
    echo "</tr>";
  }
?>

        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr bgcolor="#6495ED">
          <th colspan="3" align="center"><a href="index.php">Home</a></th>
        </tr>
      </table>
    </form>
  </body>
</html>
