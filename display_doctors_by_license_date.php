<?php
/* In this file, all the doctors who were licensed after the user provided date are listed in a table format*/
require_once './config/config.php';
require_once ROOT_PATH . './dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Doctor Licensed After Specified Date</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="listing doctors licensed after a specific date" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
    <h1 id="main_title">Displaying Doctor Licensed After Specified Date</h1>
    
    <div id="listing after specified licensed date">
    
    <table id="doctor_listing_after_license_date">
        <thead id="doctor listing license date header">
            <tr>
                 <th scope="col">Doctor First Name</th>
                 <th scope="col">Doctor Last Name</th>
                 <th scope="col">Doctor Specialty</th>  
                 <th scope="col">Doctor License Date</th>         
            </tr>
        </thead>
        <tbody id="doctor listing license date body">

    <?php

    // below we do the query to get all the doctors, and then we present the data as rows in a table
    $chosen_date = $_POST["licensedate"];

    $sqli_query = 'SELECT * FROM Doctor WHERE LicenseDate > "'.$chosen_date.'" ORDER BY LastName';
    $result = mysqli_query($connection, $sqli_query);
    
    while($single_row = mysqli_fetch_array($result))
    {
        echo"<tr>";
        echo"<td>" . $single_row['FirstName'] . "</td>";
        echo"<td>" . $single_row['LastName'] . "</td>";
        echo"<td>" . $single_row['Specialty'] . "</td>";
        echo"<td>" . $single_row['LicenseDate'] . "</td>";
        echo"</tr>";
    }
    ?>
        </tbody>
    </table>    
    </div><!-- end listing doctors after a specified licensed date-->
    </body>
<?php
mysqli_close($connection);
session_write_close();
?>
</html>    