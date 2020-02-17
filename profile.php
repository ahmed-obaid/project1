<?php
 session_start();
  $title='profile';
  
  include 'init.php';
  include $tbl.'header.php' ;
  if(isset($_SESSION['user'])){
      $getuser=$con->prepare('SELECT * FROM user WHERE username=?' );
       $getuser->execute(array($sessionuser));
       $info=$getuser->fetch();
        
       
  ?>
  
<h1 class="text-center"> my profile</h1>
<div class="information block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"> information</div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li><i class="fa fa-unlock-alt fa-fw"></i> <span>name </span>:<?php  echo $info['username'] ; ?> </li>
                      <li> <i class="fa fa-envelope-o fa-fw"></i><span>  email</span>:<?php  echo $info['email'] ; ?></li>
                      <li> <i class="fa fa-user fa-fw"></i> <span> fullname</span>:<?php  echo $info['fulname'] ; ?></li>                

                       <li><i class="fa fa-calendar fa-fw"></i> <span> register date </span>:<?php  echo $info['date']; ?></li>

                       <li><i class="fa fa-tags fa-fw"></i> <span> favorite category </span>:<?php echo $info['date']; ?></li>
                      
                </ul>
                <a class="btn btn-default " href="#"> edit your profile</a>
            </div> 
            
        </div>
    </div>
</div>
<div class="information block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"> my Ads</div>
            <div class="panel-body">
                <?php
                $where="WHERE member_id=$info[userid]";
                     getitems('items',$where,'item_id');   
  if(!empty( getitems('items',$where,'item_id')) )
       {
           foreach ( getitems('items',$where,'item_id') as $item){              
         echo '<div class="col-sm-6 col-md-3">';
            echo '<div class="thumbnail item-box">';
                if($item['approve']==0){ echo '<span class ="not-approve">not approved </span>';} 
                   echo '<span class="price-tag"> ' .$item['price'].  '</span>';
                  echo '<img class="img-responsive" src="photo1.webp" alt="" />';
                      echo '<div class="caption>" ';
                           echo'<h3><a href="items.php?itemid='.  $item['item_id'].'">'   .$item['name'].'</a></h3>';
                            echo'<p>' .$item['description'].'</p>';
                            echo'<div class="date">' .$item['add_date'].'</div>';
                                    
                       echo '</div>';
                           
 
             echo '</div>';
  echo '</div>';
            }
       }else{
           
           echo'sorry there is no ads to show ' .'  <a href="newadd.php"> add newAds</a>' ;
       }
                ?>
                
                
            </div> 
            
        </div>
    </div>
</div>
  
  <div class="information block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"> latest comment</div>
            <div class="panel-body">
                
                <?php
                     
                $stmt=$con->prepare("SELECT  
                           comments.*  
                         FROM
                             comments
                          WHERE
                                
                             
                                  user_id=" .$info['userid'] );

                            $stmt->execute();
                            $cooments=$stmt->fetchall();
                            
                            if(!empty($cooments))
                            {
                                    foreach ($cooments as $comment)
                                    {
                                       echo$comment['comment'];

                                    }
                            }else{
                                
                                echo 'there is\'not comments for this user';
                                
                            }         
                            
                       ?>  
                
                </div> 
            
             </div>
         </div>
     </div>
  
 
  

 <?php
 }else{
     
     header('location:login.php');
 }
 include $tbl.'footer.php' ;
 
 
?> 
 