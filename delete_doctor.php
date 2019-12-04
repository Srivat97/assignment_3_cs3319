<?php
/* In this file a user selected doctor is deleted from the database*/
require_once './config/config.php';
require_once ROOT_PATH . '/dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Delete Doctor</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="Deleting a doctor from the database" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
    <?php

    // below we grab the deleted doctor parameters, sessnions are used to transfer data between two different webpages
    $deleted_doctor_license_number = $_SESSION["deletion_doctor"];
  
    $sqli_query_find_doctor = 'SELECT * FROM Doctor WHERE LicenseNum= "'.$deleted_doctor_license_number.'"';
    $result = mysqli_query($connection, $sqli_query_find_doctor);
    $deleted_doctor = mysqli_fetch_array($result);

    $deleted_doctor_first_name = $deleted_doctor["FirstName"];
    $deleted_doctor_last_name = $deleted_doctor["LastName"];
    $deleted_doctor_license_date = $deleted_doctor["LicenseDate"];
    $deleted_doctor_specialty = $deleted_doctor["Specialty"];
    $deleted_doctor_working_hospital = $deleted_doctor["WorkingHospital"];

    // below we delete the doctor
    $sqli_query = 'DELETE FROM Doctor WHERE LicenseNum= "'.$deleted_doctor_license_number.'"';
    
    if(!$result = mysqli_query($connection, $sqli_query))
    {
        die("Error: Doctor Deletion Failed" . mysqli_error($connection));
    }
    
    ?>
    
    <h1 id="main_title">Doctor Successfully Deleted</h1>
    

    <h2 class="user choices headings">Deleted Doctor Information Listed Below:</h2>
    <div id="single_doctor_list">

    <?php

    // below we display the deleted doctor information to the user
    echo "<p class='indv doctor list'>License Number: " . $deleted_doctor_license_number . "</p>";
    echo "<p class='indv doctor list'>First Name: " . $deleted_doctor_first_name . "</p>";
    echo "<p class='indv doctor list'>Last Name: " . $deleted_doctor_last_name . "</p>";
    echo "<p class='indv doctor list'>License Date: " . $deleted_doctor_license_date . "</p>";
    echo "<p class='indv doctor list'>Specialty: " . $deleted_doctor_specialty . "</p>";
    echo "<p class='indv doctor list'>Working Hospital Code: " .  $deleted_doctor_working_hospital . "</p>";

    ?>

    </div><!-- end doctor deletion-->
    </body>
<?php
mysqli_close($connection);
session_write_close();
?>
</html>