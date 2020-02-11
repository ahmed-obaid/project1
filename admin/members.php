<?php

      
session_start();
if( isset($_SESSION['username'])){
     $title='members';
   include 'init.php';
   include'include/template/header.php' ; 
  
 $do= isset($_GET['do'])? $_GET['do'] : 'manage'; 
     
          //************************************page manage
          //************************************page  manage
          //************************************page  manage
        
   if($do=='manage'){ 
     $query='';
      if(isset($_GET["page"])&&($_GET["page"]=="activ") )
          {
          
          $query='AND recstatus=0';
          
          }


$stmt=$con->prepare("SELECT * FROM user WHERE groupid =0  $query ");
$stmt->execute();
$rows=$stmt->fetchall();

?>

        <h1 class='text-center'>manage members  <h1> 
                <div class="container"  >
                    
                    <div class="table-responsive"  >
                        
                        <table class="main-table text-center table table-bordered">
                            
                            <tr>
                                <td> #id </td>
                                <td> username </td>
                                <td>email  </td>
                                <td> full name </td>
                                <td> registerd </td>
                                <td> date </td>
                                <td>control  </td>
                                    
                            </tr>
                              <tr>
                                  <?php 
                                     foreach ($rows as $row){
                                  echo '<tr>';
                                          echo '<td>'.$row['userid'].'</td>';
                                          echo '<td>'.$row['username'].'</td>';
                                          echo '<td>'.$row['email'].'</td>';
                                          echo '<td>'.$row['fulname'].'</td>';
                                           echo '<td>' .'</td>';
                                           echo '<td>'. $row['date'].'</td>';
                                           echo "<td>  
                                           
                                                   <a href='members.php?do=edit&&userid=".$row['userid']."' class='btn btn-success'>   edit </a>
                                                   <a href='members.php?do=delete&&userid=".$row["userid"]."' class='confirm btn btn-danger'    >delete </a> ";
                                                 if($row['recstatus']==0){
                                                     
                                                     echo "<a href='members.php?do=pending&&userid=".$row['userid']."'  class=' btn btn-info'>activate</a>";
                                                     
                                                     
                                                 }
                                           
                                            echo' </td>';
                                           
                                          
                                   echo '</tr>';
                                    }
                                  ?>
                                    
                                </tr>
                            </table>                      
                         </div>
                           <a class= 'btn btn-primary' href='members.php?do=add'> <i class='fa fa-plus '></i>add member </a> 
                       </div>   
                
                
                
                
                
       
          
        
   <?php }elseif($do=='add')
       //************************************page add
          //************************************page add
         //************************************page add
               {?>

           
            <div class="container ">
                <h1 class='text-center'>Add member  <h1> 
                        <form class="form-horizontal" action="members.php?do=insert" method="POST">
                            
                    <!-- username-->
                    <div class="form-group">
                        <label class="col-sm-5  control-label">username </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="username" class="form-control" required='required'  /> 
                        </div>    
                    </div>
                     <!-- username-->
                      <!-- password -->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">password </label>
                        <div class="col-sm-10 col-md-6" >
                            
                            <input class="form-control password" type="password" name="password"   required='required'  autocomplete="new-password" />
                            <i class="show-pass fa fa-eye fa-2x"></i>
                        </div>    
                    </div>
                     <!-- password e-->
                      <!-- email-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">email </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="email" name="email" class="form-control" required='required'   />  
                        </div>    
                    </div>
                     <!-- email-->
                      <!-- ful name-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">ful name </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="fulname" class="form-control" required='required'  />  
                        </div>    
                    </div>
                     <!-- ful name-->
                      <!--  submit-->
                    <div class="form-group">
                        
                        <div class="col-sm-offset-5 col-sm-8" >
                            <input type="submit" value="add member" class="btn btn-primary btn-lg"/>  
                        </div>    
                    </div>
                     <!-- username-->
                    
                </form>
                
                
                
            </div>
            
                        
            
           
           
               <?php
               //************************************page insert
          //************************************page insert
          //************************************page insert
               } elseif($do=='insert'){
                   
                        
      
        if($_SERVER['REQUEST_METHOD']=='POST')
             {
                echo"<h1 class='text-center'>insert member  <h1> ";
               echo '<div class="container">';
                $name=$_POST['username'];
                $pass=$_POST['password'];
                $email=$_POST['email'];
                $fulname=$_POST['fulname'];
                $hashpass= sha1($pass);
               
                   $formerrors=array();
                   if(empty($name))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">username cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($pass))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">password cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($email))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">email cant be<strong> empty </strong></div>';  
                       
                       }
                       if(strlen($_POST['username'])<4  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">username cant be less than<strong> 4 </strong></div>';  
                       
                       }
                       if(strlen($_POST['username'])>24  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">username cant be begger than <strong> 24 </strong></div>';  
                       
                       }
                        if(empty($fulname))
                       {
                       
                        $formerrors[]='<div class="alert alert-danger">fulname cant be<strong> empty </strong></div>';  
                       
                       }
                       foreach($formerrors as $errors)
                           {
                           echo $errors ;
                           
                           }
                    
                        if(empty($formerrors))
                           {
                          $check= checkitems('username','user', $name );
                              if($check==1){
                                        

                                            $mes= ' sorry the username has already exist  '  ;
                                            $url=$_SERVER['HTTP_REFERER'];
                                            redirecthome( $mes,$url,3);

                                         
                                       }else{
                         
                
                $smts =$con->prepare('INSERT INTO
                                                   user(username , password, email, fulname,recstatus ,date) 
                                                  VALUES(  :u,:p,:e,:f,0, now()   )') ;
                  $smts->execute(array(
                               'u'=>$name,
                                'p'=>$hashpass,
                                 'e'=>$email,
                                  'f'=>$fulname
                      
                                                 ));
                  
                  $mes= ' the insert has completed '  ;
                  $url=$_SERVER['HTTP_REFERER'];
                redirecthome( $mes,$url,5);
                
                  
                  
                     echo $smts->rowCount();
                                       }
                       }     
                        
            }else{
                  $erro= 'sorry you cant entering this page directly'  ;
                  $url= 'index.php';
                redirecthome( $erro,$url,5);
                
                
             
                
                  }
   
    echo '</div>';
    
    
          //************************************page DELETE
          //************************************page  DELETE
          //************************************page  DELETE
       
                   
               }elseif($do=='delete'){
      $userid=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0 ; 
      
      if($userid!==0){
          
          $stmt= $con->prepare('SELECT * FROM user WHERE userid= ?' );
      $stmt->execute(array($userid));
      $count=$stmt->rowcount();
       
          if( $count>0){
          
          
                   $stmt= $con->prepare('DELETE FROM user WHERE userid= :zuser' );
                   $stmt->bindparam(":zuser",$userid);
                   $stmt->execute();
                    $success= 'the user has deleted';
                   $url="members.php";
                   redirecthome( $success,$url,3);
                   
                   
                       }
      
       }
          
        
                   
       
          //************************************page edit
          //************************************page edit
          //************************************page edit
       
  }elseif($do=='edit'){
      
      $userid=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0 ;
      $stmt= $con->prepare('SELECT * FROM user WHERE userid= ?' );
      $stmt->execute(array($userid));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
       
      if($count>0) { ?>
        
        
           
            <div class="container ">
                <h1 class='text-center'>Edit member  <h1> 
                        <form class="form-horizontal" action="members.php?do=update" method="POST">
                            <input type="hidden" name="userid" class="form-control" value="<?php echo $userid; ?>"/>
                    <!-- username-->
                    <div class="form-group" >
                        <label class="col-sm-5  control-label">username </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="username" class="form-control"  required="required" value="<?php echo $row['username']; ?>" /> 
                        </div>    
                    </div>
                     <!-- username-->
                      <!-- password -->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">password </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="hidden" name="oldpassword"  value="<?php echo $row['password']; ?>" />
                            <input type="password" name="newpassword" class="form-control" autocomplete="new-password" />  
                        </div>    
                    </div>
                     <!-- password e-->
                      <!-- email-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">email </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="email" name="email" class="form-control" required="required" value="<?php echo $row['email'];?>" />  
                        </div>    
                    </div>
                     <!-- email-->
                      <!-- ful name-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">full name </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="fulname" class="form-control" required="required" value="<?php echo $row['fulname'];?>"/>  
                        </div>    
                    </div>
                     <!-- ful name-->
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
       $url= 'index.php';
     redirecthome( $erro,$url,5);
     
               }
   
      
      
      
      
      
      
      
      
      
      
       
    
          //************************************page update
          //************************************page  update
          //************************************page  update
   
   }elseif($do=='update') {
       
       echo"<h1 class='text-center'>Update member  <h1> ";
       echo '<div class="container">';
        if($_SERVER['REQUEST_METHOD']=='POST')
             {
                $id     =$_POST['userid'];
                $uname   =$_POST['username'];
                $email  =$_POST['email'];
                $fulname=$_POST['fulname'];
                 
                 $pass=empty($_POST['newpassword'])? $_POST['oldpassword'] : sha1($_POST['newpassword']);
                   $errors=array();
                   
                         if(empty($uname))
                       {
                       
                       $errors[]='<div class ="alert alert-danger">username cant be<strong> empty </strong></div>';  
                       
                       }
                       if(strlen($_POST['username'])<4 )
                       {
                          
                       $errors[]='<div class ="alert alert-danger">username cant be less than<strong> 4 </strong></div>';  
                       
                       }
                       
                       if(empty($uname)) {
                      
                           echo 'ooooooooooooooooooooo';
                       $errors[]='<div class ="alert alert-danger">username cant be<strong> empty </strong></div>';  
                        
                       }
                       if(strlen($_POST['username'])>24  )
                       {
                       
                        $errors[]='<div class ="alert alert-danger">username cant be begger than <strong> 24 </strong></div>';  
                       
                       }
                        if(strlen($_POST['fulname'])<5)
                       {
                       
                       $errors[]='<div class="alert alert-danger">fulname cant be less than<strong> 5</strong></div>';  
                       
                       }
                   
                      
                             
                              
                       foreach($errors as $error)
                          {
                           echo $error;
                           
                             
                             $url=$_SERVER['HTTP_REFERER'];
                              header("refresh:5;url=$url");
                           
                           
                           }
                           
                           
                        if(empty($errors))
                        {
                           
                            $stm= $con->prepare('SELECT * FROM user WHERE username=? AND userid!=?' );
                            $stm->execute(array($uname,$id));
                           
                            $count=$stm->rowCount();
                            if($count==1)

                            {
                                
                                 $mes= '<div class="alert alert-danger"> name already exist</div>';  
                                
                                   
                     
                                $url= $_SERVER['HTTP_REFERER'];
                                redirecthome($mes,$url,3);
                                
                                
                                
                            }else{
                            
                            
                            
                
                $smts =$con->prepare('UPDATE user SET username= ? , email=? , fulname=?,password=? WHERE userid=?');
                  $smts->execute(array($uname,$email,$fulname,$pass,$id));
                     echo $smts->rowCount();
                     $mes= ' the updated has completed ';
                     
                     $url= "members.php";
                     redirecthome($mes,$url,3);
                          
                        }
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
    
            }elseif($do=="pending")
            {
                
                $userid=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0 ;
                
                if($userid!==0)
                {
          
                      $stmt= $con->prepare('SELECT * FROM user WHERE userid=?' );
                      $stmt->execute(array($userid));
                      $count=$stmt->rowcount();
                         if($count>0) 
                            { 
                               $smts =$con->prepare("UPDATE user SET recstatus=1  WHERE userid=$_GET[userid]");
                               $smts->execute(array());
                      
                               $mes= ' the activate has completed ';
                     
                               $url=$_SERVER['HTTP_REFERER'];
                               redirecthome($mes,$url,3);
                           
                            }
                }
            } 
   include $tbl.'footer.php' ;
    
 }else{
      header('location:index.php');
      exit();
 }
 
 
 ?>
 