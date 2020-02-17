<?php
 
 session_start();
  $title='homepage';
  
  include 'init.php';
  include $tbl.'header.php' ;
  
 $stmt= $con->prepare('SELECT * FROM  items  WHERE approve=1');         
                                           
      $stmt->execute(array());
     
      $count=$stmt->rowCount();
   
       $rows=$stmt->fetchall();
       foreach ($rows as $row)
             {  
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
 
 include $tbl.'footer.php' ;
 
 
?> 
 