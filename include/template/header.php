 

<!DOCTYPE html> 
<html>
 <head>
  <meta charset="utf-8"/> 
 <title> <?php title()?>  </title>
  
    <link rel="stylesheet" href="layout/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="layout/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="layout/css/backend.css"/>  
</head>
   <body>
   <div class="upper-nav">
       <div class="container">
           <a href="login.php"><span class="pull-right" > login/signup </span> </a>
       
       </div>
   </div>
      
    <nav class="navbar navbar-inverse">
    <div class='container'>
        <div class='navbar-header'>
          <button class="navbar-toggle collapse" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
            
            <a class="navbar-brand" href="index.php"> home </a>
        </div>
        
   <div class="collapse navbar-collapse" id="app-nav">
    <ul class="nav navbar-nav pull-right">
      <?php
      
       foreach (getcat() as $cat)
           
          { 
            echo'  <li> 
                     
                     <a href="categories.php?pageid='.$cat['id'].'&pagename='. str_replace('','-',$cat['name']).'">'.$cat['name'].'</a>
                   </li>
               ';
           
           
          }
      
      
      
        ?>
      
    </ul> 
       
     </div>
    </div>
</nav>   
      
 
       



 
