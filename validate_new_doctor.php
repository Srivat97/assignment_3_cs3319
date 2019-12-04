<?php
/* this file was used to verify whether the new doctor license number already exists within the database.
    If the licens number exists, then go back to the main page and let the user know. Otherwise continue to add the new doctor.*/
require_once './config/config.php';
require_once ROOT_PATH . '/a3paranji/dbconnection.php';

session_start();

// query all doctor license numbers
$sqli_query = "SELECT LicenseNum FROM Doctor";
$result = mysqli_query($connection, $sqli_query);
mysqli_close($connection);

$new_license_num = $_POST["doctor_license_number"];

// if license number already exists, go back
while($single_row = mysqli_fetch_array($result))
{
    if($new_license_num == $single_row['LicenseNum'])
    {
        $_SESSION['doctor_ID_repeat_error'] = true;
        header('Location: ./index.php');
        exit();
    }
}

// store user inputs in sessions, so data can be transferred to next web page
$_SESSION["new_doctor_first_name"] = $_POST["doctor_first_name"];
$_SESSION["new_doctor_last_name"] = $_POST["doctor_last_name"];
$_SESSION["new_doctor_license_number"] = $_POST["doctor_license_number"];
$_SESSION["new_doctor_specialty"] = $_POST["doctor_specialty"];
$_SESSION["new_doctor_hospital_code"] = $_POST["hospital_list"];
$_SESSION["new_doctor_license_date"] = $_POST["newlicensedate"];

// add new doctor if the license number doesnt exist
header('Location: ./add_doctor.php');
exit();

?>