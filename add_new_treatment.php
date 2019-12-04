<?php
/* In this file a new treatment is added to the database*/
// below we have the cofiguration startup
require_once './config/config.php';
require_once ROOT_PATH . '/a3paranji/dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Adding New Treatment</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="Adding a new treatment to the database" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
    <?php

    // below we grab the user information from ne treatment form and do an insertion into the database
    $new_treatment_patient  = $_POST["patient_list"];
    $new_treatment_doctor = $_POST["doctor_list"];
  
    $sqli_add_new_treatment = 'INSERT INTO PatientAssignment (PatientID, DoctorID) VALUES ("'.$new_treatment_patient.'", "'.$new_treatment_doctor.'")';

    if(!$result = mysqli_query($connection, $sqli_add_new_treatment))
    {
        die("Error: Adding New Treatement Failed" . mysqli_error($connection));
    }
    
    ?>
    
    <h1 id="main_title">New Treatment Successfully Added</h1>
    
    <h2 class="user choices headings">New Treatment Information Below:</h2>

    <div id="treatment_added">
    <?php

    // below we let the user know the new treatement information, which was added to the database
    $sqli_query_patient = 'SELECT * FROM Patient WHERE OHIPNum= "'.$new_treatment_patient.'"';
    $sqli_query_doctor = 'SELECT * FROM Doctor WHERE LicenseNum= "'.$new_treatment_doctor.'"';
    
    $result = mysqli_query($connection, $sqli_query_patient);
    $single_row = mysqli_fetch_array($result);

    echo "<h4 class='patient info head'> New Treatment Patient Information Below: </h4>";
    echo "<p class='patient info'>OHIP Number: " . $single_row["OHIPNum"] . "</p>";
    echo "<p class='patient info'>First Name: " . $single_row["FirstName"] . "</p>";
    echo "<p class='patient info'>Last Name: " . $single_row["LastName"] . "</p>";

    $result = mysqli_query($connection, $sqli_query_doctor);
    $single_row = mysqli_fetch_array($result);

    echo "<h4 class='doctor info head'> New Treatment Doctor Information Below: </h4>";
    echo "<p class='doctor info'>License Number: " . $single_row["LicenseNum"] . "</p>";
    echo "<p class='doctor info'>First Name: " . $single_row["FirstName"] . "</p>";
    echo "<p class='doctor info'>Last Name: " . $single_row["LastName"] . "</p>";

    ?>

    </div><!-- end new treatment addition-->
    </body>
<?php
mysqli_close($connection);
session_write_close();
?>
</html>