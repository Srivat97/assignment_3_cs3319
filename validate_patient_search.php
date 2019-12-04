<?php
// thid file is used to check whether the user inputted ohip number exists within the databsae.
require_once './config/config.php';
require_once ROOT_PATH . './dbconnection.php';

session_start();

$sqli_query = "SELECT OHIPNum FROM Patient";
$result = mysqli_query($connection, $sqli_query);
mysqli_close($connection);

$patient_ohip = $_POST["patient_ohip_num"];
$_SESSION["patient_ohip_number"] = $patient_ohip;

// if the patient ohip number exists, then go diplay the information 
while($single_row = mysqli_fetch_array($result))
{
    if($patient_ohip == $single_row['OHIPNum'])
    {
        header('Location: ./display_patient_information.php');
        exit();
    }
}

// if the patient ohip nunber doesnt exist, then go back and let the user know
$_SESSION["patient_OHIP_error"] = true;
header('Location: ./index.php');
exit();

?>