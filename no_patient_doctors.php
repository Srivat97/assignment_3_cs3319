<?php
// this file is embedded into the main webpage of the site. This file is used to query
// all the doctors in the database without any patients. The result of the query is displayed in a table format.

$sqli_query = "SELECT doctor.FirstName, doctor.LastName 
               FROM Doctor 
               WHERE LicenseNum NOT IN (SELECT doctor.LicenseNum 
                                        FROM Patientassignment 
                                        INNER JOIN Doctor 
                                        ON doctor.LicenseNum = patientassignment.DoctorID)
                                        ORDER BY doctor.LastName ASC";
$result = mysqli_query($connection, $sqli_query);

// generate rows of each table below
while($single_row = mysqli_fetch_array($result))
{
    echo"<tr>";
    echo"<td>" . $single_row['FirstName'] . "</td>";
    echo"<td>" . $single_row['LastName'] . "</td>";
    echo"</tr>";
}
?>