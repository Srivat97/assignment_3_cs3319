<?php
// this file is embedded into the main webpage of the site. Thsi file is used to query
// all the treatments in the database and display them in a drop down menu. For each treatment,
// the patient ohip number, first and last name are displayed. Additionally, the corresponding doctor license number
// first and last name is also displayed.

$sqli_query = "SELECT patient.FirstName AS PFirstName, patient.LastName AS PLastName,
               doctor.FirstName AS DFirstName, doctor.LastName AS DLastName, doctor.LicenseNum, patient.OHIPNum FROM PatientAssignment
               INNER JOIN Patient 
               ON patientassignment.PatientID = patient.OHIPNum
               INNER JOIN Doctor
               ON patientassignment.DoctorID = doctor.LicenseNum";
$result = mysqli_query($connection, $sqli_query);

echo"<select id=tt name='treatment list'>";
while($single_row = mysqli_fetch_array($result))
{
    echo"<option value='" . $single_row['OHIPNum'] . '|' . $single_row['LicenseNum'] . "' >" . $single_row['OHIPNum'] .", " . $single_row['PFirstName'] .
                        " " . $single_row['PLastName'] . "<span class= '" . connector . "'> (TREATED BY) </span>" . $single_row['LicenseNum'] . ", " . $single_row['DFirstName'] . 
                        " " . $single_row['DLastName'] . "</option>";
}
echo"</select>";
?>

