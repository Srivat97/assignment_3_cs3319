<?php
/* This file contains the main webpage of the site. Thos webpage is loaded up first and lists
   all possible options the user has to interact with the database. All the other webpages are loaded
   in based on the option the user submits and the input values.*/

// below we have the configuration setup 
require_once './config/config.php';
require_once ROOT_PATH . './dbconnection.php';

session_start(); // session helps share variables between multiple pages
?>
<!DOCTYPE html>
<html>
    <head>
    <title>CS3319 Medical Registry</title>
    <link href="css/main_page.css" type="text/css" rel="stylesheet" />
    <meta name="description"
        content="A full fledged medical registry containing doctors, patients and hospitals" />
    <meta name="robots"
        content="noindex" />
    <meta http-equiv="author"
        content="Srivatsan Srinivasan" />
    <meta http-equiv="content-type"
        content="text/html; charset=UTF-8" />                
    </head>    

    <body>
        
        <h1 id="main_title">Welcome to Western's Medical Registry System</h1>  
    
        <div id="doctors_list_alpha">
            <h2 class="user choices headings">General Doctor Listing</h2>
            <form action="display_doctors.php" method="post">
                <fieldset>
                <legend>Listing Parameters</legend>
                <h4 class="form headings">Please select how to order the doctor listing by:</h4>
                    <label for="fn">
                    <input id="fn" type="radio" name="doctor ordering reference" value="FirstName" />
                    First Name
                    </label>
                    <br/> 
                    <br/>  
                    <label for="ln">
                    <input id="ln" type="radio" name="doctor ordering reference" value="LastName" checked="checked" />
                    Last Name
                    </label>
                <h4 class="form headings">Please select the ordering type:</h4>
                    <label for="as">
                    <input id="as" type="radio" name="doctor ordering type" value="ASC" checked="checked" />
                    Ascending
                    </label>
                    <br/> 
                    <br/>  
                    <label for="ds">
                    <input id="ds" type="radio" name="doctor ordering type" value="DESC" />
                    Descending
                    </label>
                    <br />
                    <br />
                <input type="submit" name="List Doctors" value="List Doctors" />
                </fieldset>
            </form>    
        </div><!-- end alphabetical doctors listing-->


        <div id="doctors_list_by_license">
            <h2 class="user choices headings">Doctor Listing by License Date</h2>
            <form action="display_doctors_by_license_date.php" method="post">
                <fieldset>
                <legend>License Date</legend> 
                <h4 class="form headings">Please select a date to list doctors licensed before then:</h4>  
                <label for="ld">License Date:</label>
                <input id = "ld" type="date" name="licensedate" 
                    value="2019-01-01"
                    min="1900-01-01" />
                <input id="license date spacing" type="submit" name="List Doctors before date" value="List Doctors" />   
                </fieldset>
            </form>
        </div><!-- end doctor listing by license date-->

        <div id="add_new_doctor">
            <h2 class="user choices headings">Add new Doctor</h2>
            <form action="validate_new_doctor.php" method="post">
                <fieldset>
                <legend>Doctor Information</legend>
                <h4 class="form headings">Please fill in the doctor information below:</h4>
                <p class="requirement"> Required fields are followed by (<strong><span class="user notify"> *
                    </span></strong>)</p>
                <label for="dfn">First Name: 
                    <strong><span class="user notify"> * </span></strong>
                </label>
                <input id="dfn" type="text" name="doctor first name" maxlength="20" required="required" />
                <br />
                <br />
                <label for="dln">Last Name:
                    <strong><span class="user notify"> * </span></strong>
                </label>
                <input id="dln" type="text" name="doctor last name" maxlength="20" required="required" />
                <br />
                <br />
                <label for="dsp">Specialty:
                    <strong><span class="user notify"> * </span></strong>
                </label>
                <input id="dsp" type="text" name="doctor specialty" maxlength="30" required="required" />
                <br />
                <br />
                <label for="nld">License Date:
                    <strong><span class="user notify"> * </span></strong>
                </label>
                <input id = "nld" type="date" name="newlicensedate" 
                    value="2019-01-01"
                    min="1900-01-01" />
                <br />
                <br />
                <label for="dlin">License Number:
                    <strong><span class="user notify"> * </span></strong>
                </label>
                <input id="dlin" type="text" name="doctor license number" maxlength="4" required="required" />
                    <?php
                    // below we check whether the new doctor has a license number similiar to a doctor already in the database
                    // throw an error to let the user know, if there was an error
                        if(isset($_SESSION['doctor_ID_repeat_error']))
                        {
                            if($_SESSION['doctor_ID_repeat_error'])
                            {   
                                echo "<div class='error'>";
                                echo "<label for= 'dlin'><span class= 'error_message'> Doctor License Number Already Exists</span>";
                                echo "</label>";
                                echo "</div>";
                                $_SESSION['doctor_ID_repeat_error'] = false;
                            }
                        }
                    ?>
                <br />
                <br />
                <label for="hp">Select Hospital:
                    <strong><span class="user notify"> * </span></strong>
                </label>   
                <?php
                require ROOT_PATH . './generate_hospitals.php'
                ?>
                 <label for="hp">
                    <i class="list format">(hospital code, hospital name)</i>
                </label>   
                <br />
                <br />
                <input type="submit" name="add doctor" value="Add Doctor" />
                </fieldset>    
            </form>
        </div><!-- end adding new doctor--> 
       
        <div id="delete_doctor">
            <h2 class="user choices headings">Delete An Existing Doctor</h2>
            <form action="delete_doctor_intermediate.php" method="post">        
                <fieldset>
                <legend>Delete Doctor</legend>
                <h4 class="form headings">Please select a doctor below:</h4>
                <label for="dd">Select Doctor:</label>
                <?php
                require ROOT_PATH . './generate_doctors.php'
                ?>    
                <label for="hp">
                    <i class="list format">(Doctor License Number, Doctor name)</i>
                </label>   
                <br />
                <br />
                <input type="submit" name="delete doctor" value="Delete Doctor" />
                </fieldset>
            </form>
        </div><!-- end deleting a new doctor--> 

        <div id="update_hospital_name">
            <h2 class="user choices headings">Update Hospital Name</h2>
            <form action="update_hospital.php" method="post">
                <fieldset>
                <legend>Updated Hospital Information</legend>
                <h4 class="form headings">Please fill in the updated hospital information below:</h4>
                <p class="requirement"> Required fields are followed by (<strong><span class="user notify"> *
                    </span></strong>)</p>
                <label for="shc">Select Hospital Code of the Hospital to Rename: 
                </label>
                <?php
                    require ROOT_PATH . './generate_hospital_code.php'
                ?>
                <br />
                <br />
                <label for="nhn">Enter New Hospital Name: 
                    <strong><span class="user notify"> * </span></strong>
                </label>
                <input id="nhn" type="text" name="new hospital name" maxlength="20" required="required" />
                <br />
                <br />
                <input type="submit" name="update hospital name" value="Update Hospital Name" />
                </fieldset>
            </form>    
        </div><!-- end updating an existing hospital name--> 
    
        <div id="display_all_hospital_info">
            <h2 class="user choices headings">Hospital Information Listing</h2>
            <table id="hospital_listing">
                <thead id="hospital_listing_header">
                    <tr>
                        <th scope="col">Hospital Name</th>
                        <th scope="col">Head Doctor First Name</th>
                        <th scope="col">Head Doctor Last Name</th>       
                        <th scope="col">Head Doctor Start Date</th>
                    </tr>
                </thead>
                <tbody id="hospital_listing_body">
                <?php
                require ROOT_PATH . './list_hospital_information.php'
                ?>
                </tbody>
            </table>    
        </div><!-- end listing all hospital info--> 
    
        <div id="display_patient_info">
            <h2 class="user choices headings">Display Patient Information</h2>
            <form action="validate_patient_search.php" method="post">
                <fieldset>
                <legend>Patient Information</legend>
                <h4 class="form headings">Please fill in the patient information below:</h4>
                <p class="requirement"> Required fields are followed by (<strong><span class="user notify"> *
                    </span></strong>)</p>
                <label for="pohip">Enter Patient OHIP Number: 
                    <strong><span class="user notify"> * </span></strong>
                </label>
                <input id="pohip" type="text" name="patient ohip num" maxlength="9" required="required" />
                <?php
                // below we check whether the patient ohip number to search is present within the database
                // throw an error to let the user know if the ohip number wasn't found
                    if(isset($_SESSION['patient_OHIP_error']))
                    { 
                      if($_SESSION['patient_OHIP_error'])
                        {   
                            echo "<div class='error'>";
                            echo "<label for= 'pohip'><span class= 'error_message'> Patient with the given OHIP number does not exist</span>";
                            echo "</label>";
                            echo "</div>";
                            $_SESSION['patient_OHIP_error'] = false;
                        }
                    }
                ?>
                <br />
                <br />
                <input type="submit" name="patient information" value="Display Patient" />
                </fieldset>
            </form>
        </div><!-- end listing all patient info-->     
    
        <div id="treatment_assignment">
            <h2 class="user choices headings">Add Patient Treatments</h2>
            <form action="add_new_treatment.php" method="post">
                <fieldset>
                <legend>Add Treatment</legend>
                <h4 class="form headings">Please select a patient and a doctor below to add a new treatment:</h4>
                <label for="pp">Select Patient:</label>
                <?php
                require ROOT_PATH . './generate_patients.php'
                ?>    
                <label for="pp">
                    <i class="list format">(Patient OHIP, Patient name)</i>
                </label>
                <label for="dd">Select Doctor:</label>
                <?php
                require ROOT_PATH . './generate_doctors.php'
                ?>    
                <label for="dd">
                    <i class="list format">(Doctor License Number, Doctor name)</i>
                </label>   
                <br />
                <br />
                <input type="submit" name="add new treatment" value="Add New Treatment" />
                </fieldset>
            </form>       
        </div><!-- end adding new treatment info--> 

        <div id="treatment_deletion">
            <h2 class="user choices headings">Remove Patient Treatments</h2>
            <form action="remove_treatment.php" method="post">
                <fieldset>
                <legend>Remove Treatment</legend>
                <h4 class="form headings">Please select a treatment to remove:</h4>
                <label for="tt">Select Treatment:</label>
                <?php
                require ROOT_PATH . './generate_treatments.php'
                ?>    
                <label for="tt">
                    <i class="list format">(Patient OHIP, Patient name -- Doctor License, Doctor Name)</i>   
                <br />
                <br />
                <input type="submit" name="delete treatment" value="Delete Treatment" />
                </fieldset>
            </form>       
        </div><!-- end deleting treatments info--> 

        <div id="no_patient_doctor">
            <h2 class="user choices headings">Doctors Without Patients</h2>
            <table id="doctor_listing">
                <thead id="doctor_listing_header">
                    <tr>
                        <th scope="col">Doctor First Name</th>
                        <th scope="col">Doctor Last Name</th>       
                    </tr>
                </thead>
                <tbody id="doctor_listing_body">
                <?php
                require ROOT_PATH . './no_patient_doctors.php'
                ?>
                </tbody>
            </table>    
        </div><!-- end listing all doctors with no patient info--> 
    </body>    
<?php
mysqli_close($connection); // close the connection to the database
session_write_close(); 
?>
</html>