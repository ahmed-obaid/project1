<?php
 session_start();
  if(isset($_SESSION['user'])){
      header('location:index.php');
      
  }
  
   $title='login';
  

  include 'init.php';
  include $tbl.'header.php' ;
  
  if($_SERVER['REQUEST_METHOD']=='POST'){
      
                        //==========================check the form

                               $formerrors= array();
                         //============check the username=================
                           if(isset($_POST['username']))
                             { 
                               $filteruser= filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                              
                             if(strlen( $filteruser)<5)
                                  { 
                                 $formerrors[]= 'username must be more than 5 characters';

                                  }
                             }
                            //============check the password=================
                                  if(empty($_POST['password'])){
                                      echo 'sorry passwor is empty';
                                  }
                                  if(isset($_POST['password'])&&isset($_POST['password2']) ){
                                      $pass1=$_POST['password'];
                                       $pass2=$_POST['password2'];    
                             if($pass1 !== $pass2 )
                                  { 
                                $formerrors[]= 'sorry password is not matched';

                                  }

                                  }

                                   //============check the email=================
                                   if(isset($_POST['email']))
                                      { 
                                        $filteremail= filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
                                                 
                                         if(filter_var($filteremail,FILTER_VALIDATE_EMAIL )!=true)
                                              { 
                                             $formerrors[]= 'this email is not valid';

                                              }
                                       } 
                                      



                             //============check the form=================

      
      
      
      if(empty($formerrors))
      
      
      
      {
      
      if(isset($_POST['login']))
  {
    $username = $_POST['username'];  
    $password = $_POST['password']; 
    $hashedpass = sha1($password); 
      
     $stmt= $con->prepare('SELECT userid,username,password ,avatar FROM user WHERE username=? AND password=? ');
     $stmt->execute(array($username, $hashedpass));
      $fet=$stmt->fetch();
      $count=$stmt->rowCount();
       
      
       
      if($count>0){
       $_SESSION['user']= $username ; 
       $_SESSION['memberid']= $fet['userid'] ;
        $_SESSION['avatarmember']= $fet['avatar'] ;
       header('location:index.php');
       exit();
      
          
      }
      
   }else{
            $username = $_POST['username'];
            $email = $_POST['email']; 
            $password = $_POST['password'];
           
            $hashedpass = sha1($password); 

     $stmt= $con->prepare('SELECT username FROM user WHERE username=?  ');
     $stmt->execute(array($username));
    
      $count=$stmt->rowCount();
      
      if($count>0){
          
        $userexist='username already exist';
       
          
      }else{
             
     $stmt= $con->prepare('INSERT INTO  
                                    user(username,password,email,recstatus,date ) 
                                    VALUES( :zuser,:zpass,:zemail,0,now() )
                             ');
     $stmt->execute(array(
                     'zuser'=>$username,
                     'zpass'=> $hashedpass,
                     'zemail'=>$email,
                      
                     
         
                    ));
    
                $insert_u=$stmt->rowCount();
                
                    $suc_ins='good,you have registed in our website';
          
          
          
          
            }
       
 
         }
  
      }else{
          
         $errors=$formerrors;  
          
      }
  
  }
   
  
 ?>
    <div class="container login-page">
        <h1 class="text-center">
            <span data-class="login" class='selected' >login </span>|<span data-class="signup"> signup</span>
        </h1>
            <form class="login" action= "<?php echo $_SERVER['PHP_SELF'] ; ?>" method="POST" >
                <div class="input-container">
                       <input class="form-control " type="text" name="username" autocomplete="off" placeholder="username" required="required"   />
                </div>
                 <div class="input-container">
                       <input class="form-control " type="password" name="password" autocomplete="new-password" placeholder="password" required="required"  />
                 </div>
                <div class="input-container">
                      <input class="btn btn-primary btn-block " name="login" type="submit" value="login"/>
                </div>
                
                
            </form> 
        
        
        <form class="signup" action= "<?php echo $_SERVER['PHP_SELF'] ; ?>" method="POST"required="required"  >
                <div class="input-container">
                      <input class="form-control " type="text" name="username" autocomplete="off"  placeholder="username"required="required"  />
                </div> 
                <div class="input-container">
                        <input class="form-control " type="password" name="password" autocomplete="new-password" placeholder="password" required="required"  />
                </div>
                        
                        
                <div class="input-container">     
                        <input class="form-control " type="password" name="password2" autocomplete="new-password" placeholder="password again" required="required" />
                        
                </div>
            
                  
               
            
                <div class="input-container">
                    
                        <input class="form-control " type="email" name="email" autocomplete=""  placeholder="email" required="required" />
                </div>     
                
                        <input class="btn btn-success btn-block " name="signup" type="submit" value="signup"/> 
                        
                
       </form> 
        <div class="errorsform text-center">
             
                    <?php
                    if(!empty($formerrors)){
                     foreach ( $errors as $error){
                         echo' <div class="errorform">'.$error. '</div>'  ;
                         
                         
                     }   
                    }
                    
                    if(isset($userexist)){ echo ' <div class="errorform">'. $userexist . '</div>'; }
                    
                    if(isset( $suc_ins)){ echo ' <div class="errorform">'.  $suc_ins . '</div>'; }
                    
                    ?>
              
         </div>

             
     </div>

    
    
    
    
    
<?php
 include $tbl.'footer.php' ;
?> 
 