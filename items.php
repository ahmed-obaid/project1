<?php
session_start();
  $title='show items';
  
  include 'init.php';
  include $tbl.'header.php';     
  ?>
  
 
 <?php
   $itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'])?intval($_GET['itemid']):0 ;
      if($itemid!=0){
          $stmt= $con->prepare('SELECT   
                                           items.*,
                                           categories.name as categoryname,
                                           user.username
                                        FROM
                                             items
                                         INNER JOIN
                                              categories
                                         ON
                                              categories.id=items.cat_id
                                         INNER JOIN
                                              user
                                         ON
                                              user.userid=items.member_id 
                                         
                                        WHERE 
                                        
                                                item_id= ?
                                      
                                          
                  
                                           ');
      $stmt->execute(array($itemid));
     
      $count=$stmt->rowCount();
      if($count>0){
           $row=$stmt->fetch();
           ?>
              <h1 class="text-center">  <?php echo $row['name'];?> </h1>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-responsive img-thumbnail center-block" src="photo1.webp" alt=""/>
                            </div>
                             <div class="col-md-9 item-info">
                                 <h2 class><?php echo $row['name'];?> </h2>
                                    <p class><?php echo $row['description'];?> </p>
                                    <ul class="list-unstyled">
                                        <li> <span> added date </span> :<?php echo $row['add_date'];?>    <li/>
                                        <li> <span> price      </span> :$<?php echo $row['price'];?>      <li/>
                                        <li> <span> made in    </span> :<?php echo $row['country_made'];?><li/>
                                        <li> <span> added by   </span> :<?php echo'<a href="profile.php"> '.$row['username'] .'</a> ' ;?> <li/>   
                                        <li> <span> caregory   </span> :<?php echo '<a href="categories.php?pageid='.$row['cat_id'] .'">'.$row['categoryname'].'</a>';?><li/>
                                    <ul>
                              </div>
                            
                          </div>
                          <hr custom-hr>
                          <div class="row">
                              <?php
                              if(isset($_SESSION['user'])){
                              
                              ?>
                              <div class="col-md-offset-3">
                                   <div class="add-comment"> 
                                       <h3>  add a comment </h3>
                                      

                                       <form action=' <?php echo $_SERVER['PHP_SELF'].'?itemid='.$row['item_id']  ;?>'  method="POST">

                                            <textarea name="comment"  >  </textarea>


                                            <input name="send" class="btn btn-primary" type="submit" value="add comment"/> 

                                        </form>
                                       <?php
                                         if( isset($_POST['send'])){ 
                                             
                                           $comment=filter_var($_POST['comment'],FILTER_SANITIZE_STRING );
                                           $userid= $_SESSION['memberid'];
                                           $item_id=$row['item_id'] ;
                                           
                                           
                                           if(strlen(($_POST['comment']))<4)
                                                   {  echo '<div class="alert alert-cucsess">comment can\'t be empty </div>';
                                
                                               
                                               }else{
                                               
                                               $call=$con->prepare("INSERT INTO 
                                                           comments(comment, status, comment_date ,item_id ,user_id ) 
                                                       
                                                           VALUES(:com,0,NOW(),:itemid, :userid)");
                                               
                                               $call->execute(array(
                                                   'com'   => $comment,
                                                  
                                                   'itemid'=> $row['item_id'] ,
                                                   'userid'=>$_SESSION['memberid']
                                   
                                  
                                               ));
                                               
                                             if($call){
                                                 
                                                 
                                                 echo '<div class="alert alert-cucsess">comment was added </div>';
                                             }
                                        
                                           
                                             
                                            }
                                         }
                                       
                                       ?>

                                   </div>
                              </div>
                            </div> 
                              <?php
                              }else{
                                  
                                echo'It must to be <a href="login.php">login</a> to add comment';
                              }
                              
                               $stmt= $con->prepare('SELECT   
                                           comments.*,
                                           user.username  
                                            
                                       FROM
                                             comments
                                       INNER JOIN
                                              user
                                        ON
                                              user.userid=comments.user_id
                                          
                                        WHERE 
                                        
                                                item_id= ?
                                        AND
                                                 status=1 ');
                                      
                                                                   
                               $stmt->execute(array($itemid));

                               $count=$stmt->rowCount();
                               if($count>0){
                                               $rowcomments=$stmt->fetchall();
                                               foreach ($rowcomments as $rowcomment)
                                                  {
                                                 echo '<div class="comment-box">';
                                                   echo '<div class="row">';
                                                         
                                                            echo '<div class="col-sm-2 text-center"> <img class="img-responsive img-thumbnail center-block img-circle" src="photo1.webp" alt=""/>
                                                                

                                                                '.$rowcomment['username']. '</div>'; 
                                              
                                                            echo '<div class="col-sm-10"> <p class="lead">'.$rowcomment['comment']. ' </p>     </div>';
                                                   
                                                         echo '</div>';
                                                      echo '</div>';
                                                     echo '<hr class="custom-hr">';
                                                    }
                              
                                            }
                                                  
                              ?>
                              
                        
                          
                          
                          <hr custom-hr>
                         

                    </div>

        <?php
      }else{
           
         echo '<h1 class =" alert alert-danger text-center "> wrong entry </h1>'; 
          
        }
    
      }else{
         echo '<div class =" alert alert-danger text-center "> sorry must be there id </div>';
      }


?>



 <?php
 
 include $tbl.'footer.php' ;
 
 
?> 
 