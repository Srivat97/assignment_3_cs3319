<?php
// this file is embedded into the main webpage of the site. Thsi file is used to query
// all the treatments in the database and display them in a drop down menu. For each treatment,
// the patient ohip number, first and last name are displayed. Additionally, the corresponding doctor license number
// first and last name is also displayed.

$sqli_query = "SELECT Patient.FirstName AS PFirstName, Patient.LastName AS PLastName,
               Doctor.FirstName AS DFirstName, Doctor.LastName AS DLastName, Doctor.LicenseNum, Patient.OHIPNum FROM PatientAssignment
               INNER JOIN Patient 
               ON PatientAssignment.PatientID = Patient.OHIPNum
               INNER JOIN Doctor
               ON PatientAssignment.DoctorID = Doctor.LicenseNum";
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

