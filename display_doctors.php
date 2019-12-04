<?php
/* In this file, all the doctors in the database are displayed in an order specified by the user, which can be the following:
    last name ascending or descending
    first name ascending or descending
    
    there are radio buttons attached to let the user choose an individual doctor*/
require_once './config/config.php';
require_once ROOT_PATH . '/a3paranji/dbconnection.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry List Doctors</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="listing all doctors in the database" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>

    <h1 id="main_title">List of Doctors</h1>  
    <div id='listing_all_doctors'>
    <h2 class="user choices headings">Pick A doctor:</h2>
        <form action="display_single_doctor.php" method="post">
            <fieldset>
            <legend>Doctors</legend>

                    <?php

                    // below we take the user choices from the main page, and perform the query onto the database
                    // the results are displayed after
                    $ascending_type = $_POST["doctor_ordering_reference"];
                    $order_method = $_POST["doctor_ordering_type"];

                    $sqli_query = 'SELECT * FROM Doctor ORDER BY '.$ascending_type . ' ' . $order_method.'';
                    $result = mysqli_query($connection, $sqli_query);
                    while($single_row = mysqli_fetch_array($result))
                    {
                        echo "<label>";
                        echo "<input class='dl' type='radio' name='doctor listing' value=";
                        echo $single_row["LicenseNum"];
                        echo " /> " .$single_row["FirstName"]. ", " .$single_row["LastName"]. "---" .$single_row["LicenseNum"];
                        echo "</label> <br/> <br/>";
                    }
                    ?>    
                <input type="submit" name="Display Doctor Info" value="Display Doctor Info" />
             </fieldset>
        </form> 
    </div> <!-- end all doctors listing-->   
    </body> 
<?php
mysqli_close($connection); // need to close database connection
session_write_close(); 
?>
</html>     