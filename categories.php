<?php
session_start();
include 'init.php';
  include $tbl.'header.php' ;?>
<div class="container">
    <h1 class="text-center"> show category </h1>  
 <div class="row">   
     <?php
     
      $catid= $_GET['pageid'];
      getitems('items',"WHERE cat_id=$catid AND approve=1",'item_id');   
       
           foreach (getitems('items',"WHERE cat_id=$catid AND approve=1",'item_id') as $row){              
         echo '<div class="col-sm-6 col-md-3">';
         
            echo '<div class="thumbnail item-box"'; 
                   echo '<span class="price-tag"> ' .$row['price'].  '</span>';
                        echo '<img class="img-responsive" src="photo1.webp" alt="" />';
                             echo '<div class="caption>" ';
                                   echo'<h3><a href="items.php?itemid='.$row['item_id'] .'">' .$row['name'].' </a></h3>';
                                    echo'<p>' .$row['description'].'</p>';
                                     echo '<div class="date"> ' .$row['add_date'].  '</div>';
                                    
                             echo '</div>';
             echo '</div>';
  echo '</div>';
            }
     
    ?>
   </div>
</div>
 
<?php include $tbl.'footer.php' ;?>
