<?php
/* In this file, a selected patient has their first and last name displayed. Then
   all their treatments are listed in a table.*/
require_once './config/config.php';
require_once ROOT_PATH . '/a3paranji/dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry List Patient Info</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="Listing all the patient information" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>

    <h1 id="main_title">Displaying Patient</h1>
    
    
    <h2 class="user choices headings">Patient Information Below:</h2>

    <div id="patient_information_displayed">
    <?php

    // below the user selected patient is queried  and their information is displayed
    $patient_ohip_num = $_SESSION["patient_ohip_number"];

    $sqli_query_patient = 'SELECT Patient.FirstName, Patient.LastName FROM Patient WHERE OHIPNum= "'.$patient_ohip_num.'"';
    $result = mysqli_query($connection, $sqli_query_patient);

    $single_row = mysqli_fetch_array($result);

    echo "<p class='patient info'>First Name: " . $single_row["FirstName"] . "</p>";
    echo "<p class='patient info'>Last Name: " . $single_row["LastName"] . "</p>";

    ?>
    </div><!-- end displaying patient info-->

    <div id="treatment_information_displayed">
    <h2 class="user choices headings">Treatment Information Below:</h2>

    <?php

    // below, all the treatments for the selected patient are queried and displayed

    // variable to keep track of the number of treatments is defined below
    $treatment_count = 1;
   
    $sqli_query_treatment = 'SELECT Doctor.FirstName, Doctor.LastName FROM PatientAssignment INNER JOIN Doctor ON PatientAssignment.DoctorID = Doctor.LicenseNum WHERE PatientAssignment.PatientID="'.$patient_ohip_num.'"';
    $result = mysqli_query($connection, $sqli_query_treatment);

    if ($result->num_rows != 0)
    {
        echo "<table id='patient_treatment_listing'>";
        echo "<thead id='treatment listing header'>";
        echo "<tr> <th scope='col'>Treatment</th>";
        echo "<th scope='col'>Doctor First Name</th>";
        echo "<th scope='col'>Doctor Last Name</th> <tr> </thead>";
        echo "<tbody id = 'treatment listing body'>";

        while($single_row = mysqli_fetch_array($result))
        {
            echo"<tr>";
            echo"<td>". $treatment_count . "</td>"; 
            echo"<td>" . $single_row['FirstName'] . "</td>";
            echo"<td>" . $single_row['LastName'] . "</td>";
            echo"</tr>";

            $treatment_count += 1;
        }

        echo "</tbody> </table>";

    }
    else
    {
        echo "<h4 class='no treatments'> The Patient chosen does not have any current treatments. </h4>";
    }
    
    ?>
    </div><!-- end treatment info-->
    </body>
<?php
mysqli_close($connection);
session_write_close();
?>
</html>
