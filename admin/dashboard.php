
 
 <?php
session_start();
   $title='dashboard';
   
 if(isset($_SESSION['username'])){
     
     include 'init.php';
      include'include/template/header.php' ;
   ?>
 
<div class="container home-state text-center">
    <h1> dashboard</h1>
    <div class="row">
            <div class="col-md-3">
              <div class="stat st-members">
                 total members
                 <span><a href="members.php"> <?php  echo countitems("userid","user","groupid","(1,0)");  ?></a> </span>
              </div>
             </div>
             <div class="col-md-3">
              <div class="stat st-pending">
                 pending members
                 <span><a href="members.php?do=manage&&page=activ"> <?php  echo countitems("userid","user","recstatus","0");  ?></a></span>
                </div>
             </div>
             <div class="col-md-3">
              <div class="stat st-items">
                 total items
                 <span> <a href="items.php"> <?php  echo countitems1("item_id" ,"items" );  ?></a>  </span>
                </div>
             </div>
             <div class="col-md-3">
              <div class="stat st-comments">
                 total comments
                 <span> <a href="comments.php" > <?php  echo countitems1("c_id","comments");?>  </a>  </span>
                </div>
             </div>

             
             
        </div>
    
    
</div>

<div class="container latest home-state">
   
    <div class="row">
            <div class="col-md-6">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <i class fa fa-users></i>
                       
                           
                          latest registerd users 
          
                  </div>
                  
                  <div  class="panel-body">
                      
                    <ul class= 'list-unstyle latest-users'>
                       <?php
                                        
                      
                                 $latest=getlatest( "*","user","userid",5);

                      foreach($latest as $user)
   
                             { 
                                 echo" 
                                         

                                          <li > 

                                          $user[username] 

                                          <a href='members.php?do=edit&&userid=".$user['userid']."'  > <span class='btn btn-info latestu pull-right' > <i class='fa fa-edit' >  </i>edit </span></a>
                                       ";

                                        if($user['recstatus']==0){

                                          echo "<a class='pull-right'href='members.php?do=pending&&userid=".$user['userid']."' ><span class='btn special latestu ' >activate </span></a>";


                                           echo"



                                           </li>  


                                          
                                          ";

                                        }
                          
                                      }
                           
                                  ?>
                      
                                 </ul>  
                      
                      
                  </div>
                
              </div>
          </div>
        
          <div class="col-md-6">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      
                           
                          latest items 
                          
                          
                     
                  </div> 
                      
                  <div class="panel-body">
                      
                       <ul class= 'list-unstyle latest-users'> 
                           
                        <?php
              
                                 $latestitem=getlatest( "*","items","item_id",5);
                                 if(!empty( $latestitem))
                                 {
                                     

                                 foreach($latestitem as $item)
   
                                    { 
                                  
                                     
                                     echo" 
                                       

                                          <li > 

                                          $item[name] 

                                          <a href='items.php?do=edit&&itemid=".$item['item_id']."'  > <span class='btn btn-info latestu pull-right' > <i class='fa fa-edit' >  </i>edit </span></a>
                                       ";

                                        if($item['approve']==0){

                                          echo "<a class='pull-right'href='items.php?do=approve&&itemid=".$item['item_id']."' ><span class='btn special latestu ' >approve </span></a>";


                                           echo"



                                           </li>  


                                          
                                          ";

                                        }
                          
                                      }
                                     }else{  echo '<div class="alert alert-info"> there is no nothing about items </div>  ' ;}
                                 ?>
                      
                            </ul> 
                      
                      
                      
                      
                      
                      
                      
                   
                  </div>
                
              </div>
          </div>
       </div>
 </div>

 

      
      
   <?php 
   include $tbl.'footer.php' ;
    
 }else{
      header('location:index.php');
      exit();
 }
 
 
 ?>
 
    