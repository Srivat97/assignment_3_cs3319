<?php
/* This file takes a selected treatment from the user and deletes it from the database, the deleted treatment
   information is then displayed to the user.*/

// below we have the configuration startup 
require_once './config/config.php';
require_once ROOT_PATH . '/a3paranji/dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Removing Treatment</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="removing an existing treatment from the database" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
    
    <?php

    // below we get the treatment information from the user and query the patient and doctor in the database
    // the information is temporarily stored
    $remove_treatment_parameters  = explode('|',$_POST["treatment_list"]);
    $remove_treatment_patient = $remove_treatment_parameters[0];
    $remove_treatment_doctor = $remove_treatment_parameters[1];

    $sqli_query_patient = 'SELECT * FROM Patient WHERE OHIPNum= "'.$remove_treatment_patient.'"';
    $result = mysqli_query($connection, $sqli_query_patient);
    $single_row = mysqli_fetch_array($result);

    $remove_treatment_patient_ohip_number = $single_row["OHIPNum"];
    $remove_treatment_patient_first_name = $single_row["FirstName"];
    $remove_treatment_patient_last_name = $single_row["LastName"];

    $sqli_query_doctor = 'SELECT * FROM Doctor WHERE LicenseNum= "'.$remove_treatment_doctor.'"';
    $result = mysqli_query($connection, $sqli_query_doctor);
    $single_row = mysqli_fetch_array($result);

    $remove_treatment_doctor_license_number = $single_row["LicenseNum"];
    $remove_treatment_doctor_first_name = $single_row["FirstName"];
    $remove_treatment_doctor_last_name = $single_row["LastName"];

    // below we delete the treatment from the database
    $sqli_query_delete_treatment = 'DELETE FROM PatientAssignment WHERE PatientID= "'.$remove_treatment_patient.'" AND DoctorID= "'.$remove_treatment_doctor.'"';

    if(!$result = mysqli_query($connection, $sqli_query_delete_treatment))
    {
        die("Error: Deleting Treatment Failed" . mysqli_error($connection));
    }
    
    ?>
    
    <h1 id="main_title">Selected Treatment Successfully Deleted</h1>
    
    <h2 class="user choices headings">Deleted Treatment Information Below:</h2>
    <div id="treatment_added">

    <?php

    // if the deletion was successful, then we display the deleted treatment information to the user
    echo "<h4 class='patient info head'> Deleted Treatment Patient Information Below: </h4>";
    echo "<p class='patient info'>OHIP Number: " . $remove_treatment_patient_ohip_number . "</p>";
    echo "<p class='patient info'>First Name: " . $remove_treatment_patient_first_name . "</p>";
    echo "<p class='patient info'>Last Name: " . $remove_treatment_patient_last_name . "</p>";

    echo "<h4 class='doctor info head'> Deleted Treatment Doctor Information Below: </h4>";
    echo "<p class='doctor info'>License Number: " . $remove_treatment_doctor_license_number . "</p>";
    echo "<p class='doctor info'>First Name: " . $remove_treatment_doctor_first_name . "</p>";
    echo "<p class='doctor info'>Last Name: " . $remove_treatment_doctor_last_name . "</p>";

    ?>

    </div><!-- end new treatment deletion-->
    </body>
<?php
mysqli_close($connection);
session_write_close();
?>
</html>