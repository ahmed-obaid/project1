 <?php
   
 session_start();
  if(isset($_SESSION['username'])){
      header('location:dashboard.php');
      
  }
 
   $title='login';
  
  include 'init.php';
  include $tbl.'header.php' ;
  
 
 
  if($_SERVER['REQUEST_METHOD']=='POST'){
      
    $username = $_POST['user'];  
    $password = $_POST['pass']; 
    $hashedpass = sha1($password); 
    
     $stmt= $con->prepare('SELECT userid,username,password FROM user WHERE username=? AND password=? AND groupid=1');
     $stmt->execute(array($username,$hashedpass));
    
      $count=$stmt->rowCount();
     
      
      if($count==1){
        $row=$stmt->fetch();
       $_SESSION['username']= $username ;
        $_SESSION['id']= $row['userid'];
       header('location:dashboard.php');
       exit();
      
          
      }else{
          
          echo '<div class="alert alert-danger"> you are not an admin </div>';
      }
 
  }
  
  
 ?>
 

<form class="login" action= "<?php echo $_SERVER['PHP_SELF'] ; ?>" method="POST" >
    <h4 class="text-center">admin login </h4>
    <input class="form-control input-lg" type="text" name="user" placeholder="username"   />  
    <input class="form-control input-lg" type="password" name="pass" placeholder="password"   />
    <input class="btn btn-primary btn-block" type="submit" value="login"/>  
</form>
 


<?php
 include $tbl.'footer.php' ;
?> 
 
 
 
 
