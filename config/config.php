<?php

  include "cfg.db.php";
  include "cfg.user.php";   
  include "cfg.guess.php";   
  include "cfg.ext.php";   

  // Page access configuration
  $page_ext   = ".php";

  // Enable quick adding of unstructured addresses
  $quickadd = true;

  // Don't display groups
  $nogroups = false;

  // Disable all "edit/create" actions
  $read_only  = false;

  // Enable group administration pages
  $public_group_edit = true;

  // Disable the AJAX-Mode with "false"
  $use_ajax = true;

  //
  // Select the columns displayed in "index.php":
  $disp_cols
    = array( "select"
           // , "last_first"
           , "lastname"
           , "firstname"
           // , "address"
           , "email"
           , "telephone"
           // , "home"
           // , "mobile"
           // , "work"
           // , "fax"
           , "edit"
           , "details"
           );

  // View e-mail addresses as images
  $mail_as_image = false;

  // Change the location of the images (e.g. a CDN Source)
  $url_images = "";

  // Disable HTTP-Compression with 0
  $compression_level = 2;
  
?>