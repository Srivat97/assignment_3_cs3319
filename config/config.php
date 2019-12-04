<?php

/* This file contains the important constants for resources
   used often. Additionally this file contains database information.*/

   $config = array(
       "db" => array(
           "db1" => array(
               "dbname" => "ssrini3assign2db",
               "username" => "root",
               "password" => "cs3319",
               "host" => "localhost"

                        )
                    )
           );


/* constant defenitions */

define("CONFIG_PATH", realpath(dirname(__FILE__)));
define("IMAGE_PATH", realpath(dirname(__FILE__) . '/../images'));
define("CSS_PATH", realpath(dirname(__FILE__) . '/../css'));
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);


/* error reporting*/
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);






?>