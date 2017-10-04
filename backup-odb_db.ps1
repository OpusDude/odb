Import-Module C:\Users\Administrator\Documents\WindowsPowerShell\Modules\SCP-Sessions\SCP-Sessions.psd1
Import-Module C:\Users\Administrator\Documents\WindowsPowerShell\Modules\SSH-Sessions\SSH-Sessions.psd1

# If the passwords change, do the following to reset them.
#
# 1. Logged in as administrator, create a credential object with:  

#    $credential = Get-Credential

# 2. Write this as a secure string to a file:

#    $credential.Password | ConvertFrom-SecureString | Set-Content $env:userprofile\odbuser.txt

# Note to change the txt file for each set of credentials

# Email settings are outside the try loop so email still goes out if something fails
$mailTo = "someone@live.com"
$mailServer = "smtp.gmail.com"
$mailPort = "587"
$emailUser = "info@ourdailybread.us"
$emailPassword = Get-Content $env:USERPROFILE\info.txt | ConvertTo-SecureString

try
{
     # Credentials
     $loginUser = "odbuser"
     $loginSecure = Get-Content $env:USERPROFILE\odbuser.txt | ConvertTo-SecureString
     $loginCreds = New-Object System.Management.Automation.PSCredential($loginUser, $loginSecure)
     $loginPassword = $loginCreds.GetNetworkCredential().Password
     $mysqlUser = "root"
     $mysqlSecure = Get-Content $env:USERPROFILE\root.txt | ConvertTo-SecureString
     $mysqlCreds = New-Object System.Management.Automation.PSCredential($mysqlUser, $mysqlSecure)
     $mysqlPassword = $mysqlCreds.GetNetworkCredential().Password

     # File to save to
     $myfile = "ODB_DB-$(get-date -f MM-dd-yyyy).sql"

     # Computer to connect to
     $computer = "192.168.200.39"


     $SshResults = New-SshSession -ComputerName $computer -Username $loginUser -Password $loginPassword
     if ($SshResults -like '*Exception*')
     {
         throw "SSH connection failed with $computer"
     }
     Invoke-SshCommand -ComputerName $computer  -Command "mysqldump --user=$mysqlUser --password=$mysqlPassword ODB_DB > /tmp/$myfile"

     $ScpResults = New-ScpSession -ComputerName $computer -Username $loginUser -Password $loginPassword
     if ($ScpResults -like '*Exception*')
     {
         throw "SCP connection failed with $computer"
     }
     Receive-ScpFile -ComputerName $computer -RemoteFile "/tmp/$myfile" -LocalFile "c:\ODB_DB_Backup\$myfile" 

     Invoke-SshCommand -ComputerName $computer  -Command "rm -rf /tmp/$myfile"
     Remove-SshSession -ComputerName $computer
     Remove-ScpSession -ComputerName $computer

     # Number of days to keep backups
     $limit = (Get-Date).AddDays(-30)
     $odbPath = "C:\ODB_DB_Backup"

     # Delete files older than the $limit
     Get-ChildItem -Path $odbPath -Recurse -File | Where-Object CreationTime -lt $limit | Remove-Item -Force
}
catch [Exception]
{
    $_.Exception.Message
    $creds = New-Object System.Management.Automation.PSCredential($emailUser, $emailPassword)
    Send-MailMessage -To $mailTo -From "info@ourdailybread.us" -Subject "ODB_DB MySQL Backups failed" -Body "Someone should look into it" -BodyAsHtml -SmtpServer $mailServer -UseSsl -Credential $creds -Port $mailPort
}