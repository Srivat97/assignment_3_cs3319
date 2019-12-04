<?php
/* This file verifies whether the user selected doctor for deletion
    has any patients, based on the result, different webpages are opened*/
require_once './config/config.php';
require_once ROOT_PATH . '/a3paranji/dbconnection.php';

session_start();

$sqli_query = "SELECT DoctorID FROM PatientAssignment";
$result = mysqli_query($connection, $sqli_query);
mysqli_close($connection);

$doctor_deletion_license_num = $_POST["doctor_list"];

$_SESSION["deletion_doctor"] = $doctor_deletion_license_num;

// if doctor has a patient, re-confirm deletion
while($single_row = mysqli_fetch_array($result))
{
    if($doctor_deletion_license_num == $single_row['DoctorID'])
    {
        header('Location: ./doctor_delete_confirmation.php');
        exit();
    }
}

// if doctor has no patients, continue deletion
header('Location: ./delete_doctor.php');
exit();

?>
