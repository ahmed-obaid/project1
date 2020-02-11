<?php include 'init.php';
  include $tbl.'header.php' ;?>
<div class="container">
    <h1 class="text-center"><?php echo   $_GET['pagename'];  ?>  </h1>  
 <div class="row">   
     <?php
      $catid= $_GET['pageid'];
       getitems($catid);   
       
           foreach (getitems($catid) as $row){              
         echo '<div class="col-sm-6 col-md-3">';
            echo '<div class="thumbnail item-box"'; 
                   echo '<span class="price-tag"> ' .$row['price'].  '</span>';
                  echo '<img class="img-responsive" src="photo1.webp" alt="" />';
                      echo '<div class="caption>" ';
                           echo'<h3>' .$row['name'].'</h3>';
                            echo'<p>' .$row['description'].'</p>';
                                    
                       echo '</div>';
 
 
             echo '</div>';
  echo '</div>';
            }
     
    ?>
   </div>
</div>
 
<?php include $tbl.'footer.php' ;?>
