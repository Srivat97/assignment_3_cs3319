<?php
/*  This file contains the webpage which confirms whether the user wants to delete a doctor who has patients. 
    The user can decide to fully delete the doctor or not to and go back to the main page.*/
require_once './config/config.php';

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry Confirm Doctor Deletion</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="user confirmation to delete an existing doctor" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
   
    <h1 id="main_title">Continue Doctor Deletion?</h1>
    
    <div id="doctor_deletion">
    <h2 class="user choices headings">Delete Doctor Confirmation</h2>

    <form action="delete_doctor.php" method="post">        
            <fieldset>
            <legend>Confirm</legend>
            <h4 class="form headings">The doctor you have chosen to delete has patients, deleting the doctor will also remove those patient treatments (CONFIRM DELETION BELOW):</h4>
            <label for="cd">Confirm Doctor Deletion:</label>     
            <input id = "cd" type="submit" name="delete doctor confirmation" value="Continue Deleting Doctor" />
        </fieldset>
    </form>
    </div><!-- end doctor deletion confirmation-->

    <div id="stop_doctor_deletion">
    <h2 class="user choices headings">Stop Doctor Deletion</h2>

    <form action="index.php" method="post">        
            <fieldset>
            <legend>Return</legend>
            <h4 class="form headings">Stop continuing with the doctor deletion below:</h4>
            <label for="cd">Stop Doctor Deletion:</label>     
            <input id = "cd" type="submit" name="stop doctor delete" value="Go Back" />
        </fieldset>
    </form>
    </div><!-- end stop doctor deletion-->
    </body>
<?php
session_write_close();
?>
</html>
