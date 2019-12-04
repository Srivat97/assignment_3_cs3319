<?php
// this file is embedded into the main webpage of the site. Thsi file is used to query
// all the hospitals in the database and display them in a drop down menu, the hospital code and name are displayed.
$sqli_query = "SELECT * FROM Hospital";
$result = mysqli_query($connection, $sqli_query);

echo"<select id=hp name='hospital_list'>";
while($single_row = mysqli_fetch_array($result))
{
    echo"<option value='" . $single_row['HospitalCode'] . "'>" . $single_row['HospitalCode'] .", " .  $single_row['HospitalName'] . "</option>";
}
echo"</select>";
?>