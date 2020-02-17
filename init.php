<?php
 ini_set('display_errors','on');
 error_reporting(E_ALL);
 $sessionuser='fffff';
 if(isset($_SESSION['user']))
     {
        $sessionuser=$_SESSION['user'];
     
     }
 include 'admin/connect.php';
 $tbl='include/template/';
  $css='layout/css/';
   $js='layout/js/';
   $lang='include/languages/';
   $fun= 'include/functions/';
    include $lang.'eng.php';
   
    
  
  
  
    include $fun.'fun.php';
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  