<?php
// this file is embedded into the main webpage of the site. This file is used to query
// all the hospitals in the database and display their information into a table format.

$sqli_query = "SELECT Hospital.HospitalName, Doctor.FirstName, Doctor.LastName, Hospital.StartDate
               FROM Hospital
               INNER JOIN Doctor
               ON Hospital.HeadDoctor = Doctor.LicenseNum
               ORDER BY Doctor.LastName ASC";
$result = mysqli_query($connection, $sqli_query);

// generate rows in each table below
while($single_row = mysqli_fetch_array($result))
{
    echo"<tr>";
    echo"<td>" . $single_row['HospitalName'] . "</td>";
    echo"<td>" . $single_row['FirstName'] . "</td>";
    echo"<td>" . $single_row['LastName'] . "</td>";
    echo"<td>" . $single_row['StartDate'] . "</td>";
    echo"</tr>";
}
?>

