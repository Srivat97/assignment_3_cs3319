<?php
// this file is embedded into the main webpage of the site. Thsi file is used to query
// all the patients in the database and display them in a drop down menu, the patient ohip number, first name and last name are displayed.
$sqli_query = "SELECT * FROM Patient ORDER BY LastName ASC";
$result = mysqli_query($connection, $sqli_query);

echo"<select id=pp name='patient list'>";
while($single_row = mysqli_fetch_array($result))
{
    echo"<option value='" . $single_row['OHIPNum'] . "'>" . $single_row['OHIPNum'] .", " .  $single_row['FirstName'] .
                        " " .   $single_row['LastName'] . "</option>";
}
echo"</select>";
?>