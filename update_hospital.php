<?php
/* This file was used to update a hospital name based on the user input*/
require_once './config/config.php';
require_once ROOT_PATH . './dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Update Hospital Name</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="Updating the hospital name" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
    <?php

    // grab the new hospital name from the user
    $new_hospital_name  = $_POST["new_hospital_name"];
    $hospital_to_update = $_POST["hospital_code"];
  
    // perform the hospital update below
    $sqli_update_hospital_query = 'UPDATE Hospital SET HospitalName="'.$new_hospital_name.'" WHERE HospitalCode= "'.$hospital_to_update.'"';

    if(!$result = mysqli_query($connection, $sqli_update_hospital_query))
    {
        die("Error: Update Hospital Failed" . mysqli_error($connection));
    }
    
    ?>
    
    <h1 id="main_title">Hospital Name Successfully Updated</h1>
    
    <h2 class="user choices headings">Updated Hospital Information Listed Below:</h2>

    <div id="hospital_name_updated">
    <?php

    // if the hospital name upadte was successfull, the display the new hospital information to the user (updated values)
    $sqli_query = 'SELECT * FROM Hospital WHERE HospitalCode= "'.$hospital_to_update.'"';
    $result = mysqli_query($connection, $sqli_query);

    $single_row = mysqli_fetch_array($result);

    echo "<p class='hospital info'>Hospital Code: " . $single_row["HospitalCode"] . "</p>";
    echo "<p class='hospital info'>New Hospital Name: " . $single_row["HospitalName"] . "</p>";
    echo "<p class='hospital info'>City: " . $single_row["City"]. "</p>";
    echo "<p class='ihospital info'>Province: " . $single_row["Province"] . "</p>";
    echo "<p class='hospital info'>Bed Count: " . $single_row["BedCount"] . "</p>";
    echo "<p class='hospital info'>Head Doctor License Number: " .  $single_row["StartDate"] . "</p>";
    echo "<p class='hospital info'>Head Doctor Start Date: " .  $single_row["HeadDoctor"] . "</p>";

    ?>

    </div><!-- end hospital update-->
    </body>
<?php
session_write_close();
mysqli_close($connection);
?>
</html>