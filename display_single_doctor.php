<?php
/* In this file, all the information regarding a single doctor is displayed.
   This file is called by the display_doctors.php, where the user chose a single doctor.*/
require_once './config/config.php';
require_once ROOT_PATH . '/a3paranji/dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Doctor Info</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="listing a single doctor" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
    <h1 id="main_title">Displaying Doctor</h1>
    
    
    <h2 class="user choices headings">Doctor Information Below:</h2>
    
    <div id="single_doctor_list">
    <?php

    // below we query the user selected doctor, then the doctor information is displayed to the user
    $chosen_doctor = $_POST["doctor_listing"];

    $sqli_query = 'SELECT * FROM Doctor INNER JOIN Hospital ON doctor.WorkingHospital = hospital.HospitalCode WHERE doctor.LicenseNum= "'.$chosen_doctor.'"';
    $result = mysqli_query($connection, $sqli_query);
    $single_row = mysqli_fetch_array($result);

    echo "<p class='indv doctor list'>License Number: " . $single_row["LicenseNum"] . "</p>";
    echo "<p class='indv doctor list'>First Name: " . $single_row["FirstName"] . "</p>";
    echo "<p class='indv doctor list'>Last Name: " . $single_row["LastName"] . "</p>";
    echo "<p class='indv doctor list'>License Date: " . $single_row["LicenseDate"] . "</p>";
    echo "<p class='indv doctor list'>Specialty: " . $single_row["Specialty"] . "</p>";
    echo "<p class='indv doctor list'>Working Hospital: " . $single_row["HospitalName"] . "</p>";
    ?>
    </div><!-- end single doctor listing-->
    </body>
<?php
mysqli_close($connection);
session_write_close();
?>
</html>    