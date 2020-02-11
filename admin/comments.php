<?php

 

      
session_start();
if( isset($_SESSION['username'])){
     $title='coments';
   include 'init.php';
   include'include/template/header.php' ; 
  
 $do= isset($_GET['do'])? $_GET['do'] : 'manage'; 
     
          //************************************page manage
          //************************************page  manage
          //************************************page  manage
        
   if($do=='manage'){ 
      


$stmt=$con->prepare("SELECT  
                           comments.* ,items.name,user.username
                         FROM
                             comments
                          INNER JOIN
                              items
                           ON
                                items.item_id=comments.item_id
                           INNER JOIN
                                 user
                            ON
                                 user.userid=comments.user_id");
                           
$stmt->execute();
$rows=$stmt->fetchall();

?>

        <h1 class='text-center'> manage comments  <h1> 
                <div class="container"  >
                    
                    <div class="table-responsive"  >
                        
                        <table class="main-table text-center table table-bordered">
                            
                            <tr>
                                <td> c_id </td>
                                <td> comment </td>
                                 
                                <td> itemname </td>
                                <td> username </td>
                                <td> comment_date </td>
                                 <td> control </td>
                                    
                            </tr>
                              <tr>
                                  <?php 
                                     foreach ($rows as $row){
                                  echo '<tr>';
                                          echo '<td>'.$row['c_id'].'</td>';
                                          echo '<td>'.$row['comment'].'</td>';
                                          echo '<td>'.$row['name'].'</td>';
                                          echo '<td>'.$row['username'].'</td>';
                                          echo '<td>'.$row['comment_date'].'</td>';
                                            
                                           
                                           echo "<td>  
                                           
                                                   <a href='comments.php?do=edit&&c_id=".$row['c_id']."' class='btn btn-success'>   edit </a>
                                                   <a href='comments.php?do=delete&&c_id=".$row["c_id"]."' class='confirm btn btn-danger'> delete </a> ";
                                                 if($row['status']==0){
                                                     
                                                     echo "<a href='comments.php?do=approve&&c_id=".$row['c_id']."'  class=' btn btn-info'> approve </a>";
                                                     
                                                     
                                                 }
                                           
                                            echo' </td>';
                                           
                                          
                                   echo '</tr>';
                                    }
                                  ?>
                                    
                                </tr>
                            </table>                      
                         </div>
                            
                       </div>   
                
                
                
                
                
       
          
          
        
          <?php  
          
        
          //************************************page delete
          //************************************page delete
          //************************************page delete
               }elseif($do=='delete'){
      $comid=isset($_GET['c_id'])&& is_numeric($_GET['c_id'])?intval($_GET['c_id']):0 ; 
      
      if($comid!==0)
       {
          
          $stmt= $con->prepare('SELECT * FROM comments WHERE c_id= ?' );
          $stmt->execute(array($comid));
          $count=$stmt->rowcount();
       
          if( $count>0){
          
          
                   $stmt= $con->prepare('DELETE FROM comments WHERE c_id= :zuser' );
                   $stmt->bindparam(":zuser",$comid);
                   $stmt->execute();
                    $success= 'the comment has deleted';
                   $url="comments.php";
                   redirecthome( $success,$url,3);
                   
                   
                       }
      
        }
          
        
                   
       
          //************************************page edit
          //************************************page edit
          //************************************page edit
       
  }elseif($do=='edit'){
      
       $comid=isset($_GET['c_id'])&& is_numeric($_GET['c_id'])?intval($_GET['c_id']):0 ;
          $stmt= $con->prepare('SELECT * FROM comments WHERE c_id= ?' );
      $stmt->execute(array($comid));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
       
      if($count>0) { ?>
        
        
           
            <div class="container ">
                <h1 class='text-center'> Edit comment  <h1> 
                  <form class="form-horizontal" action="comments.php?do=update" method="POST">
                            <input type="hidden" name="comid" class="form-control" value="<?php echo $comid; ?>"/>
                    <!--================ name==================-->
                    <div class="form-group" >
                        <label class="col-sm-5  control-label">comment </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="comment" class="form-control"  required="required" value="<?php echo $row['comment']; ?>" /> 
                        </div>    
                    </div>
                     
                      
                     
                     
                      <!--  submit-->
                    <div class="form-group">
                        
                        <div class="col-sm-offset-5 col-sm-8" >
                            <input type="submit" value="save" class="btn btn-primary btn-lg"/>  
                        </div>    
                    </div>
                     <!-- username-->
                    
                </form>
                
                
                
            </div>
            
   <?php    
   }else{
       
      $erro='  there isnot id like this ';
       $url= 'dashboard.php';
     redirecthome( $erro,$url,3);
     
        }
       
    
          //************************************page update
          //************************************page  update
          //************************************page  update
   
   }elseif($do=='update') {
       
       echo"<h1 class='text-center'>Update member  <h1> ";
       echo '<div class="container">';
        if($_SERVER['REQUEST_METHOD']=='POST')
             {
                    $id =$_POST['comid'];
                $comment=$_POST['comment'];
                
                   if(empty($comment))       
                   {
                       echo '<div class="alert alert-danger ">comment cant be empty  </div>';  
                       
                       
                   }else{
                
                $smts =$con->prepare('UPDATE comments SET comment= ?   WHERE c_id=?');
                  $smts->execute(array($comment,$id));
                      
                     $mes= 'the updated has completed ';
                     
                  $url= "comments.php";
                redirecthome($mes,$url,3);
                        }     
            }else{
                
                
               
                $erro= 'sorry you cant entering this page directly'  ;
                  $url= 'login.php';
                redirecthome( $erro,$url,5);
                
                
                }
   
    echo '</div>';
    
    
          //************************************page activate
          //************************************page  activate
          //************************************page  activate
    
            }elseif($do=="approve")
            {
                
               $comid=isset($_GET['c_id'])&& is_numeric($_GET['c_id'])?intval($_GET['c_id']):0 ;
                
              if($comid!==0)
                {
          
                      $stmt= $con->prepare('SELECT * FROM comments WHERE c_id=?' );
                      $stmt->execute(array($comid));
                      $count=$stmt->rowcount();
                         if($count>0) 
                            { 
                               $smts =$con->prepare("UPDATE comments SET status=1  WHERE c_id=$comid");
                               $smts->execute(array());
                      
                               $mes= ' the approving has completed ';
                     
                               $url="comments.php";
                               redirecthome($mes,$url,3);
                           
                            }
                }
            } 
   include $tbl.'footer.php' ;
    
 }else{
      header('location:login.php');
      exit();
 }
 
 
 ?>
 