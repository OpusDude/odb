<html>
    <head>
     <meta name="description" content="Php Code for View, Search, Edit and Delete Record" />
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
     <title>Update OSTC Infra Record</title>
     <style type="text/css">
        h1 {margin-bottom:20px}
        input, label {margin-top:7px; margin-bottom:7px; color:black; font-size: 14px; padding-right: 7px}
        .note {color: #ff0000}
        .success_msg{color:#006600}
     </style>
    </head>
    <body>
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

    if($_POST["do"]=="update")
    {
        if(empty($_POST["Name"]))
        {
            $msg_name = "You must supply a FQDN system name";
        }
        else 
        {
            $newName = trim(strtoupper($_POST["Name"]));
        }
        if(empty($_POST["OS"]))
        {
            $msg_os = "You must select an OS";
        }
        else 
        {
            $os = strtoupper($_POST["OS"]);
        }
        if(empty($_POST["Type"]))
        {
            $msg_type = "You must select a Type";
        }
        else 
        {
            $type = strtoupper($_POST["Type"]);
        }
        if(empty($_POST["Rack"]))
        {
            $msg_rack = "You must select a Rack";
        }
        else 
        {
            $rack = strtoupper($_POST["Rack"]);
        }
        if(empty($_POST["Physical_Name"]))
        {
            $msg_physical = "You must enter the name in the rack";
        }
        else 
        {
            $physical = strtoupper($_POST["Physical_Name"]);
        }
        if(empty($_POST["Serial_Number"]))
        {
            $serial = "N/A";
        }
        else 
        {
             $serial = strtoupper($_POST["Serial_Number"]);
        }
        if(empty($_POST["Model"]))
        {
            $model = "N/A";
        }
        else 
        {
            $model = strtoupper($_POST["Model"]);
        }
        if(empty($_POST["Support"]))
        {
            $msg_support = "You must select 'Yes' or 'No'";
        }
        else 
        {
            $support = strtoupper($_POST["Support"]);
        }
        if(empty($_POST["Asset_Tag"]))
        {
            $asset = "N/A";
        }
        else 
        {
            $asset = strtoupper($_POST["Asset_Tag"]);
        }
        if(empty($_POST["Memory_GB"]))
        {
            $memory = "0";
        }
        elseif(ctype_digit($_POST["Memory_GB"]))
        {
            $memory = $_POST["Memory_GB"];
        } 
        else 
        {
            $msg_memory = "Numbers only";
        }
        if(empty($_POST["CPU"]))
        {
            $cpu = "0";
        }
        elseif(ctype_digit($_POST["CPU"]))
        {
            $cpu = $_POST["CPU"];
        } 
        else 
        {
            $msg_cpu = "Numbers only";
        }
        $myDate = date("Y-m-d");
        
        $sup = $_POST['Support'];
        switch($sup)
        {
            case "Yes":
            $supYes="checked";
            $supNo="";
            break;

            case "No":
            $supYes="";
            $supNo="checked";
            break;

            default: // By default No is selected
            $supYes="";
            $supNo="checked";
            break;
        };
        
        if ($msg_name == "" && $msg_os == "" && $msg_rack == "" && $msg_physical == "" && $msg_type == "" && $msg_success == "" &&
            $msg_support == "" && $msg_memory == "" && $msg_cpu == "")
        {
            $tsql = "UPDATE Systems set Name = '$newName', OS = '$os', Type = '$type', Rack = '$rack', Physical_Name = '$physical',
                     Serial_Number = '$serial', Model = '$model', Support = '$support', Asset_Tag = '$asset', Memory_GB = '$memory', CPU = '$cpu'
                     WHERE Name = '$name'";
            
            $result = sqlsrv_query( $conn,$tsql );
            
            if ($result)
            {
                $msg_success = "System successfully updated in database";
            }
            else 
            {
                echo "Query failed.<br />";  
                die( FormatErrors( sqlsrv_errors() ) );
            }
        }
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
       <div class="container">
          <center><h1><u>OSTC Infra Systems Database</u></h1></center>
          <center><h3><span class="note">*</span> denotes mandatory</h3></center>
          <center><h3 class="success_msg"><?php echo $msg_success; ?></h3></center>
<?php
$tsql = "SELECT * FROM Systems WHERE Name = '".$name."'";
$result = sqlsrv_query( $conn,$tsql );

if ($result)
{
    while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) ) 
    {
?>          
            <form id="edit_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?name=<?php echo $row['Name']; ?>">
                <table style=" border:1px solid silver" cellpadding="5" cellspacing="0" align="center" border="0">
                    <tr>
                        <td colspan="4" style="background:#6495ED; color:black; fontsize:20px">Update OSTC System Record</td>
                    </tr>
                    <tr>
                    <tr>
                        <td><b>Enter Systems FQDN:</b><span class="note">*</span></td>
                        <td><input type="text" id="name" name="Name" size="20" value = '<?php echo $row['Name']; ?>'></td>
                        <td><b>Select System OS:</b><span class="note">*</span></td>
                        <td><select name="OS">
                            <option value="">Select OS</option>
                            <option value="AIX 5.3"<?php if (trim($row['OS']) === "AIX 5.3") echo ' selected="selected"'; ?>>AIX 5.3</option>
                            <option value="AIX 6.1"<?php if (trim($row['OS']) === "AIX 6.1") echo ' selected="selected"'; ?>>AIX 6.1</option>
                            <option value="AIX 7.1"<?php if (trim($row['OS']) === "AIX 7.1") echo ' selected="selected"'; ?>>AIX 7.1</option>
                            <option value="IBM LINUX"<?php if (trim($row['OS']) === "IBM LINUX") echo ' selected="selected"'; ?>>IBM LINUX</option>
                            <option value="CENTOS 5 X64"<?php if (trim($row['OS']) === "CENTOS 5 X64") echo ' selected="selected"'; ?>>CENTOS 5 X64</option>
                            <option value="CENTOS 5 X86"<?php if (trim($row['OS']) === "CENTOS 5 X86") echo ' selected="selected"'; ?>>CENTOS 5 X86</option>
                            <option value="CENTOS 6 X64"<?php if (trim($row['OS']) === "CENTOS 6 X64") echo ' selected="selected"'; ?>>CENTOS 6 X64</option>
                            <option value="CENTOS 6 X86"<?php if (trim($row['OS']) === "CENTOS 6 X86") echo ' selected="selected"'; ?>>CENTOS 6 X86</option>
                            <option value="CENTOS 7 X64"<?php if (trim($row['OS']) === "CENTOS 7 X64") echo ' selected="selected"'; ?>>CENTOS 7 X64</option>
                            <option value="DEBIAN 5 X64"<?php if (trim($row['OS']) === "DEBIAN 5 X64") echo ' selected="selected"'; ?>>DEBIAN 5 X64</option>
                            <option value="DEBIAN 5 X86"<?php if (trim($row['OS']) === "DEBIAN 5 X86") echo ' selected="selected"'; ?>>DEBIAN 5 X86</option>
                            <option value="DEBIAN 6 X64"<?php if (trim($row['OS']) === "DEBIAN 6 X64") echo ' selected="selected"'; ?>>DEBIAN 6 X64</option>
                            <option value="DEBIAN 6 X86"<?php if (trim($row['OS']) === "DEBIAN 6 X86") echo ' selected="selected"'; ?>>DEBIAN 6 X86</option>
                            <option value="DEBIAN 7 X64"<?php if (trim($row['OS']) === "DEBIAN 7 X64") echo ' selected="selected"'; ?>>DEBIAN 7 X64</option>
                            <option value="DEBIAN 7 X86"<?php if (trim($row['OS']) === "DEBIAN 7 X86") echo ' selected="selected"'; ?>>DEBIAN 7 X86</option>
                            <option value="HPUX 11IV2 IA64"<?php if (trim($row['OS']) === "HPUX 1IV2 IA64") echo ' selected="selected"'; ?>>HPUX 11IV2 IA64</option>
                            <option value="HPUX 11IV2 PARISC"<?php if (trim($row['OS']) === "HPUX 11IV2 PARISC") echo ' selected="selected"'; ?>>HPUX 11IV2 PARISC</option>
                            <option value="HPUX 11IV3 IA64"<?php if (trim($row['OS']) === "HPUX 11IV3 IA64") echo ' selected="selected"'; ?>>HPUX 11IV3 IA64</option>
                            <option value="HPUX 11IV3 PARISC"<?php if (trim($row['OS']) === "HPUX 11IV3 PARISC") echo ' selected="selected"'; ?>>HPUX 11IV3 PARISC</option>
                            <option value="MAC 10.11 X64"<?php if (trim($row['OS']) === "MAC 10.11 X64") echo ' selected="selected"'; ?>>MAC 10.11 X64</option>
                            <option value="OARCLE 5 X64"<?php if (trim($row['OS']) === "OARCLE 5 X64") echo ' selected="selected"'; ?>>OARCLE 5 X64</option>
                            <option value="OARCLE 5 X86"<?php if (trim($row['OS']) === "OARCLE 5 X86") echo ' selected="selected"'; ?>>OARCLE 5 X86</option>
                            <option value="OARCLE 6 X64"<?php if (trim($row['OS']) === "OARCLE 6 X64") echo ' selected="selected"'; ?>>OARCLE 6 X64</option>
                            <option value="OARCLE 6 X86"<?php if (trim($row['OS']) === "OARCLE 6 X86") echo ' selected="selected"'; ?>>OARCLE 6 X86</option>
                            <option value="OARCLE 7 X64"<?php if (trim($row['OS']) === "OARCLE 7 X64") echo ' selected="selected"'; ?>>OARCLE 7 X64</option>
                            <option value="RHEL 4.0 X64"<?php if (trim($row['OS']) === "RHEL 4.0 X64") echo ' selected="selected"'; ?>>RHEL 4.0 X64</option>
                            <option value="RHEL 4.0 X86"<?php if (trim($row['OS']) === "RHEL 4.0 X86") echo ' selected="selected"'; ?>>RHEL 4.0 X86</option>
                            <option value="RHEL 5.0 X64"<?php if (trim($row['OS']) === "RHEL 5.0 X64") echo ' selected="selected"'; ?>>RHEL 5.0 X64</option>
                            <option value="RHEL 5.0 X86"<?php if (trim($row['OS']) === "RHEL 5.0 X86") echo ' selected="selected"'; ?>>RHEL 5.0 X86</option>
                            <option value="RHEL 6.0 X64"<?php if (trim($row['OS']) === "RHEL 6.0 X64") echo ' selected="selected"'; ?>>RHEL 6.0 X64</option>
                            <option value="RHEL 6.0 X86"<?php if (trim($row['OS']) === "RHEL 6.0 X86") echo ' selected="selected"'; ?>>RHEL 6.0 X86</option>
                            <option value="RHEL 7.0 X64"<?php if (trim($row['OS']) === "RHEL 7.0 X64") echo ' selected="selected"'; ?>>RHEL 7.0 X64</option>
                            <option value="RHEL 7.1 X64 PPC"<?php if (trim($row['OS']) === "RHEL 7.1 X64 PPC") echo ' selected="selected"'; ?>>RHEL 7.1 X64 PPC</option>
                            <option value="SLES 10 X64"<?php if (trim($row['OS']) === "SLES 10 X64") echo ' selected="selected"'; ?>>SLES 10 X64</option>
                            <option value="SLES 10 X86"<?php if (trim($row['OS']) === "SLES 10 X86") echo ' selected="selected"'; ?>>SLES 10 X86</option>
                            <option value="SLES 11 X64"<?php if (trim($row['OS']) === "SLES 11 X64") echo ' selected="selected"'; ?>>SLES 11 X64</option>
                            <option value="SLES 11 X86"<?php if (trim($row['OS']) === "SLES 11 X86") echo ' selected="selected"'; ?>>SLES 11 X86</option>
                            <option value="SLES 12 X64"<?php if (trim($row['OS']) === "SLES 12 X64") echo ' selected="selected"'; ?>>SLES 12 X64</option>
                            <option value="SLES 12 X86"<?php if (trim($row['OS']) === "SLES 12 X86") echo ' selected="selected"'; ?>>SLES 12 X86</option>
                            <option value="SLES 9 X86"<?php if (trim($row['OS']) === "SLES 9 X86") echo ' selected="selected"'; ?>>SLES 9 X86</option>
                            <option value="SOLARIS 10 SPARC"<?php if (trim($row['OS']) === "SOLARIS 10 SPARC") echo ' selected="selected"'; ?>>SOLARIS 10 SPARC</option>
                            <option value="SOLARIS 10 SPARC FULLROOT ZONE"<?php if (trim($row['OS']) === "SOLARIS 10 SPARC FULLROOT ZONE") echo ' selected="selected"'; ?>>SOLARIS 10 SPARC FRZ</option>
                            <option value="SOLARIS 10 SPARC SPARSE ZONE"<?php if (trim($row['OS']) === "SOLARIS 10 SPARC SPARSE ZONE") echo ' selected="selected"'; ?>>SOLARIS 10 SPARC SZ</option>
                            <option value="SOLARIS 10 X86"<?php if (trim($row['OS']) === "SOLARIS 10 X86") echo ' selected="selected"'; ?>>SOLARIS 10 X86</option>
                            <option value="SOLARIS 10 X86 FULLROOT ZONE"<?php if (trim($row['OS']) === "SOLARIS 10 X86 FULLROOT ZONE") echo ' selected="selected"'; ?>>SOLARIS 10 X86 FRZ</option>
                            <option value="SOLARIS 10 X86 SPARSE ZONE"<?php if (trim($row['OS']) === "SOLARIS 10 X86 SPARSE ZONE") echo ' selected="selected"'; ?>>SOLARIS 10 X86 SZ</option>
                            <option value="SOLARIS 11 SPARC"<?php if (trim($row['OS']) === "SOLARIS 11 SPARC") echo ' selected="selected"'; ?>>SOLARIS 11 SPARC</option>
                            <option value="SOLARIS 11 SPARC FULLROOT ZONE"<?php if (trim($row['OS']) === "SOLARIS 11 SPARC FULLROOT ZONE") echo ' selected="selected"'; ?>>SOLARIS 11 SPARC FSZ</option>
                            <option value="SOLARIS 11 X86"<?php if (trim($row['OS']) === "SOLARIS 11 X86") echo ' selected="selected"'; ?>>SOLARIS 11 X86</option>
                            <option value="SOLARIS 11 X86 FULLROOT ZONE"<?php if (trim($row['OS']) === "SOLARIS 11 X86 FULLROOT ZONE") echo ' selected="selected"'; ?>>SOLARIS 11 X86 FSZ</option>
                            <option value="SOLARIS 8 SPARC"<?php if (trim($row['OS']) === "SOLARIS 8 SPARC") echo ' selected="selected"'; ?>>SOLARIS 8 SPARC</option>
                            <option value="SOLARIS 9 SPARC"<?php if (trim($row['OS']) === "SOLARIS 9 SPAR") echo ' selected="selected"'; ?>>SOLARIS 9 SPARC</option>
                            <option value="UBUNTU 10 X64"<?php if (trim($row['OS']) === "UBUNTU 10 X64") echo ' selected="selected"'; ?>>UBUNTU 10 X64</option>
                            <option value="UBUNTU 10 X86"<?php if (trim($row['OS']) === "UBUNTU 10 X86") echo ' selected="selected"'; ?>>UBUNTU 10 X86</option>
                            <option value="UBUNTU 12 X64"<?php if (trim($row['OS']) === "UBUNTU 12 X64") echo ' selected="selected"'; ?>>UBUNTU 12 X64</option>
                            <option value="UBUNTU 12 X86"<?php if (trim($row['OS']) === "UBUNTU 12 X86") echo ' selected="selected"'; ?>>UBUNTU 12 X86</option>
                            <option value="UBUNTU 14 X64"<?php if (trim($row['OS']) === "UBUNTU 14 X64") echo ' selected="selected"'; ?>>UBUNTU 14 X64</option>
                            <option value="UBUNTU 14 X86"<?php if (trim($row['OS']) === "UBUNTU 14 X86") echo ' selected="selected"'; ?>>UBUNTU 14 X64</option>
                            <option value="UBUNTU 16 X64"<?php if (trim($row['OS']) === "UBUNTU 16 X64") echo ' selected="selected"'; ?>>UBUNTU 16 X64</option>
                            <option value="UBUNTU 16 X86"<?php if (trim($row['OS']) === "UBUNTU 16 X86") echo ' selected="selected"'; ?>>UBUNTU 16 X86</option>
                            <option value="WINDOWS 2008 R2"<?php if (trim($row['OS']) === "WINDOWS 2008 R2") echo ' selected="selected"'; ?>>WINDOWS 2008 R2</option>
                            <option value="WINDOWS 2012"<?php if (trim($row['OS']) === "WINDOWS 2012") echo ' selected="selected"'; ?>>WINDOWS 2012</option>
                            <option value="WINDOWS 2012 R2"<?php if (trim($row['OS']) === "WINDOWS 2012 R2") echo ' selected="selected"'; ?>>WINDOWS 2012 R2</option>
                            <option value="WINDOWS 2016"<?php if (trim($row['OS']) === "WINDOWS 2016") echo ' selected="selected"'; ?>>WINDOWS 2016</option>                            
                        </select></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_name ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_os ?></p></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Select System Type:</b><span class="note">*</span></td>
                        <td><select name="Type">
                            <option value="">Select Type</option>
                            <option value="BUILD"<?php if (trim($row['Type']) === "BUILD") echo ' selected="selected"'; ?>>Build System</option>
                            <option value="DEV"<?php if (trim($row['Type']) === "DEV") echo ' selected="selected"'; ?>>Dev System</option>
                            <option value="INFRA"<?php if (trim($row['Type']) === "INFRA") echo ' selected="selected"'; ?>>Infra System</option>
                            <option value="TEST"<?php if (trim($row['Type']) === "TEST") echo ' selected="selected"'; ?>>Test System</option>
                            <option value="OTHER"<?php if (trim($row['Type']) === "OTHER") echo ' selected="selected"'; ?>>Other</option>
                        </select></td>
                        <td><b>Select Rack:</b><span class="note">*</span></td>
                        <td><select name="Rack">
                            <option value="">Select Rack</option>
                            <option value="43F17-KVM01"<?php if (trim($row['Rack']) === "43F17-KVM01") echo ' selected="selected"'; ?>>43F17-KVM01</option>
                            <option value="43F18-KVM01"<?php if (trim($row['Rack']) === "43F18-KVM01") echo ' selected="selected"'; ?>>43F18-KVM01</option>
                            <option value="43F19-KVM01"<?php if (trim($row['Rack']) === "43F19-KVM01") echo ' selected="selected"'; ?>>43F19-KVM01</option>
                            <option value="43F20-KVM01"<?php if (trim($row['Rack']) === "43F20-KVM01") echo ' selected="selected"'; ?>>43F20-KVM01</option>
                            <option value="43F21-KVM01"<?php if (trim($row['Rack']) === "43F21-KVM01") echo ' selected="selected"'; ?>>43F21-KVM01</option>
                            <option value="IBM-POWER8-KVM"<?php if (trim($row['Rack']) === "IBM_POWER8-KVM") echo ' selected="selected"'; ?>>IBM-POWER8-KVM</option>
                            <option value="NEBULA"<?php if (trim($row['Rack']) === "NEBULA") echo ' selected="selected"'; ?>>NEBULA</option>
                            <option value="OS-MGMTSVR-01"<?php if (trim($row['Rack']) === "OS-MGMTSVR-01") echo ' selected="selected"'; ?>>OS-MGMTSVR-01</option>
                            <option value="OS-MGMTSVR-02"<?php if (trim($row['Rack']) === "OS-MGMTSVR-02") echo ' selected="selected"'; ?>>OS-MGMTSVR-02</option>
                            <option value="OS-MGMTSVR-03"<?php if (trim($row['Rack']) === "OS-MGMTSVR-03") echo ' selected="selected"'; ?>>OS-MGMTSVR-03</option>
                            <option value="OS-MGMTSVR-04"<?php if (trim($row['Rack']) === "OS-MGMTSVR-04") echo ' selected="selected"'; ?>>OS-MGMTSVR-04</option>
                            <option value="OS-MGMTSVR-05"<?php if (trim($row['Rack']) === "OS-MGMTSVR-05") echo ' selected="selected"'; ?>>OS-MGMTSVR-05</option>
                            <option value="OS-MGMTSVR-06"<?php if (trim($row['Rack']) === "OS-MGMTSVR-06") echo ' selected="selected"'; ?>>OS-MGMTSVR-06</option>
                            <option value="OS-MGMTSVR-07"<?php if (trim($row['Rack']) === "OS-MGMTSVR-07") echo ' selected="selected"'; ?>>OS-MGMTSVR-07</option>
                            <option value="OS-MGMTSVR-08"<?php if (trim($row['Rack']) === "OS-MGMTSVR-08") echo ' selected="selected"'; ?>>OS-MGMTSVR-08</option>
                            <option value="OS-MGMTSVR-09"<?php if (trim($row['Rack']) === "OS-MGMTSVR-09") echo ' selected="selected"'; ?>>OS-MGMTSVR-09</option>
                            <option value="OS-MGMTSVR-10"<?php if (trim($row['Rack']) === "OS-MGMTSVR-10") echo ' selected="selected"'; ?>>OS-MGMTSVR-10</option>
                            <option value="OS-MGMTSVR-11"<?php if (trim($row['Rack']) === "OS-MGMTSVR-11") echo ' selected="selected"'; ?>>OS-MGMTSVR-11</option>
                            <option value="OS-MGMTSVR-12"<?php if (trim($row['Rack']) === "OS-MGMTSVR-12") echo ' selected="selected"'; ?>>OS-MGMTSVR-12</option>
                            <option value="OS-MGMTSVR-13"<?php if (trim($row['Rack']) === "OS-MGMTSVR-13") echo ' selected="selected"'; ?>>OS-MGMTSVR-13</option>
                            <option value="OS-MGMTSVR-14"<?php if (trim($row['Rack']) === "OS-MGMTSVR-14") echo ' selected="selected"'; ?>>OS-MGMTSVR-14</option>
                            <option value="OS-MGMTSVR-15"<?php if (trim($row['Rack']) === "OS-MGMTSVR-15") echo ' selected="selected"'; ?>>OS-MGMTSVR-15</option>
                            <option value="OS-MGMTSVR-16"<?php if (trim($row['Rack']) === "OS-MGMTSVR-16") echo ' selected="selected"'; ?>>OS-MGMTSVR-16</option>
                            <option value="OS-MGMTSVR-17"<?php if (trim($row['Rack']) === "OS-MGMTSVR-17") echo ' selected="selected"'; ?>>OS-MGMTSVR-17</option>
                            <option value="OS-MGMTSVR-18"<?php if (trim($row['Rack']) === "OS-MGMTSVR-18") echo ' selected="selected"'; ?>>OS-MGMTSVR-18</option>
                            <option value="OS-MGMTSVR-19"<?php if (trim($row['Rack']) === "OS-MGMTSVR-19") echo ' selected="selected"'; ?>>OS-MGMTSVR-19</option>
                            <option value="OS-MGMTSVR-20"<?php if (trim($row['Rack']) === "OS-MGMTSVR-20") echo ' selected="selected"'; ?>>OS-MGMTSVR-20</option>
                            <option value="WSLABS 41/3755"<?php if (trim($row['Rack']) === "WSLABS 41/3755") echo ' selected="selected"'; ?>>WSLABS 41/3755</option>
                        </select></td>
                    </tr>
                     <tr>
                        <td><p class="note"><?php echo $msg_type ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_rack ?></p></td>
                        <td></td>
                    </tr>
<?php
$sup = strtoupper($row['Support']);
switch(trim($sup))
{
    case "YES":
    $supYes="checked";
    $supNo="";
    break;

    case "NO":
    $supYes="";
    $supNo="checked";
    break;

    default: // By default No is selected
    $supYes="";
    $supNo="checked";
    break;
};
?>    
                    <tr>
                        <td><b>Support:</b><span class="note">*</span></td>
                        <td><input type="radio" name="Support" value="Yes" <?php echo $supYes; ?>>Yes<input type="radio" name="Support" value="No" <?php echo $supNo; ?>>No</td>
                        <td><b>Enter Name in Rack:</b><span class="note">*</span></td>
                        <td><input type="text" name="Physical_Name" size="20" value="<?php echo $row['Physical_Name']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_support ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_physical ?></p></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Enter Asset Tag:</b></td>
                        <td><input type="text" name="Asset_Tag" size="20" value="<?php echo $row['Asset_Tag']; ?>"></td>
                        <td><b>Enter Serial #:</b></td>
                        <td><input type="text" name="Serial_Number" size="20" value="<?php echo $row['Serial_Number']; ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Enter Memory(GB):</b></td>
                        <td><input type="text" name="Memory_GB" size="20" value="<?php echo $row['Memory_GB']; ?>"></td>
                        <td><b>Enter CPUs:</b></td>
                        <td><input type="text" name="CPU" size="20" value="<?php echo $row['CPU']; ?>"></td>
                    </tr>
                    <tr>
                        <td><p class="note"><?php echo $msg_memory ?></p></td>
                        <td></td>
                        <td><p class="note"><?php echo $msg_cpu ?></p></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Enter Model:</b></td>
                        <td><input type="text" name="Model" size="20" value="<?php echo $row['Model']; ?>"></td>
                        <td colspan="4" align="right"><input type="hidden" name="do" value="update"><input type="submit" value="Update Record"></td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr bgcolor="#6495ED">
                        <th colspan="4" align="center" border="1"><a href="index.php">Home</a></th>
                    </tr>
                </table>                
            </form>
<?php
    }
}
else 
{
    echo "Query failed.<br />";  
    die( FormatErrors( sqlsrv_errors() ) );
}
?>
        </div>
    </body>
</html>
