<?php

  include 'init.php';
  include $tbl.'header.php' ;
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
                      <input class="btn btn-primary btn-block " type="submit" value="login"/>
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
                        <input class="form-control " type="password" name="password-again" autocomplete="new-password" placeholder="password again"  />
                        
                </div>
                <div class="input-container">
                        <input class="form-control " type="email" name="email" autocomplete=""  placeholder="email" required="required" />
                </div>     
                
                        <input class="btn btn-primary btn-block " type="submit" value="signup"/> 
                        
                
       </form> 


    </div>
    
    
    
    
<<?php
 include $tbl.'footer.php' ;
?> 
 