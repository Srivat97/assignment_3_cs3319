<?php
/* In this file a new doctor is added to the database (based on the user inputs)*/
// project config startup
require_once './config/config.php';
require_once ROOT_PATH . '/dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Add Doctor</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="Adding a new doctor to the database" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
    <?php

    // perform the insert into the databse
    // input values are taken from the session variable, which transfer variables from one webpage to another
    $new_doctor_first_name = $_SESSION["new_doctor_first_name"];
    $new_doctor_last_name = $_SESSION["new_doctor_last_name"];
    $new_doctor_license_number = $_SESSION["new_doctor_license_number"];
    $new_doctor_specialty = $_SESSION["new_doctor_specialty"];
    $new_doctor_hospital_code= $_SESSION["new_doctor_hospital_code"];
    $new_doctor_license_date = $_SESSION["new_doctor_license_date"];


    $sqli_query = 'INSERT INTO Doctor (LicenseNum, FirstName, LastName, LicenseDate, Specialty, WorkingHospital)'.
                    ' VALUES ("'.$new_doctor_license_number.'", "'.$new_doctor_first_name.'", "'.$new_doctor_last_name.'", "'.$new_doctor_license_date.'", "'.$new_doctor_specialty.'", "'.$new_doctor_hospital_code.'")';
    
    if(!$result = mysqli_query($connection, $sqli_query))
    {
        die("Error: Doctor Insertion Failed" . mysqli_error($connection));
    }
    
    ?>
    
    <h1 id="main_title">Doctor Successfully Added</h1>
    
    
    <h2 class="user choices headings">Newly Added Doctor Information Listed Below:</h2>

    <div id="single_doctor_list">
    <?php

    // display the insert informationn to the user
    $sqli_query_two = 'SELECT * FROM Doctor WHERE LicenseNum= "'.$new_doctor_license_number.'"';
    $result = mysqli_query($connection, $sqli_query_two);
    $single_row = mysqli_fetch_array($result);

    echo "<p class='indv doctor list'>License Number: " . $single_row["LicenseNum"] . "</p>";
    echo "<p class='indv doctor list'>First Name: " . $single_row["FirstName"] . "</p>";
    echo "<p class='indv doctor list'>Last Name: " . $single_row["LastName"] . "</p>";
    echo "<p class='indv doctor list'>License Date: " . $single_row["LicenseDate"] . "</p>";
    echo "<p class='indv doctor list'>Specialty: " . $single_row["Specialty"] . "</p>";
    echo "<p class='indv doctor list'>Working Hospital Code: " . $single_row["WorkingHospital"] . "</p>";

    ?>

    </div><!-- end doctor addition-->
    </body>
<?php
mysqli_close($connection);
session_write_close();
?>
</html>    