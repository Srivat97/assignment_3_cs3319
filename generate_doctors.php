<?php
// this file is embedded into the main webpage of the site. Thsi file is used to query
// all the doctors in the database and display them in a drop down menu, the doctor license number, first and last name are displayed.
$sqli_query = "SELECT LicenseNum, FirstName, LastName FROM Doctor ORDER BY LastName ASC";
$result = mysqli_query($connection, $sqli_query);

echo"<select id=dd name='doctor list'>";
while($single_row = mysqli_fetch_array($result))
{
    echo"<option value='" . $single_row['LicenseNum'] . "'>" . $single_row['LicenseNum'] .", " .  $single_row['FirstName'] .
                        " " .   $single_row['LastName'] . "</option>";
}
echo"</select>";
?>
