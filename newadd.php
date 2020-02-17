<?php
 session_start();
  $title='Add ads';
  
  include 'init.php';
  include $tbl.'header.php' ;
  if(isset($_SESSION['user'])){
      
      
     
       
      if($_SERVER['REQUEST_METHOD']=='POST'){
          
                $name   =filter_var($_POST['itemname'],FILTER_SANITIZE_STRING );
                $desc   =filter_var($_POST['desc'],FILTER_SANITIZE_STRING );
                $price  =filter_var ($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
                $country=filter_var ($_POST['country'],FILTER_SANITIZE_STRING);
                $status =filter_var ($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
               
                $category= filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
                      
           //   -- ---------item form----------------------------- 
                
                 $formerrors=array();
                   if(empty($country))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">country cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($category))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">category cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($status))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">status cant be<strong> empty </strong></div>';  
                       
                       }
                       
                       if(strlen($_POST['desc'])<10)
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">description cant be less than 10 characters</div>';  
                       
                       }
                       if(empty($price))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger"> price cant be<strong> empty </strong></div>';  
                       
                       }
                       if(strlen($_POST['itemname'])<4  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">itemname cant be less than<strong> 4 </strong></div>';  
                       
                       }
                       if(strlen($_POST['itemname'])>24  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger"> itemname cant be begger than <strong> 24 </strong></div>';  
                       
                       }
               if(empty($formerrors)){
                   
                    $smts =$con->prepare('INSERT INTO
                                                   items(name , description, price,country_made ,status,cat_id,member_id,add_date) 
                                                  VALUES(  :u,:d,:p,:c,:s,:cid,:mid , now()   )') ;
                  $smts->execute(array(
                               'u'=>$name,
                                'd'=>$desc,
                                 'p'=>$price,
                                  'c'=>$country,
                                     's'=>$status,
                                    'cid'=>$category,
                                      'mid'=>$_SESSION['memberid']
                                       
                      
                                                 ));
                  if($smts){
                  
                  echo' insert item has completed '  ;
                   
                        }
               }
          
          
          
      }
            
  ?>
  
<h1 class="text-center"> create new item</h1>
<div class="creat-ad block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"> create new item</div>
            <div class="panel-body">
                   <div class="row">
                       <div class="col-md-8">
                                       <!-- ---------item form-----------------------------> 
                                        <!-- ---------item form-----------------------------> 
                                        

                           <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                      
                                 <!-- ---------item name----------------------------->  
                                <div class="form-group">
                                    <label class="col-sm-2 control-label ">item name </label>
                                    <div class="col-sm-6 col-md-4" >
                                        <input type="text" name="itemname" class="form-control live-name" required='required' /> 
                                    </div>    
                                </div>

                                  <!-- ---------description----------------------------->  
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">description </label>
                                    <div class="col-sm-6 col-md-4" >

                                        <input type="text" name="desc" class="form-control live-desc"required='required' />                                   
                            
 

                                    </div>    
                                </div>

                                   <!-- ---------price----------------------------->  
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">price  </label>
                                    <div class="col-sm-6 col-md-4" >
                                        <input type="text" name="price" class="form-control live-price" required='required'   />  
                                    </div>    
                                </div>
                                   <!-- ---------CATEGORY----------------------------->
                               <div class="form-group">
                                  <label class="col-sm-2 control-label">category </label>
                                       <div class="col-sm-6 col-md-4"    >
                                           <select class='form-control' name='category'> 
                                                
                                                
                                                   <?php 
                                                $categs=$con->prepare("SELECT * FROM categories ");
                                                $categs->execute();
                                                $rowcategs=$categs->fetchall();
                                                foreach ($rowcategs as $rowcateg)
                                                         {
                                                           echo '<option value='.$rowcateg['id'].'>' .$rowcateg['name'].'</option>';



                                                          }                    

                                                    ?>


                                                 


                                           </select>                      
                                        </div>
                                </div>  


                                   

                                    <!-- ---------country----------------------------->  
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" >country </label>
                                         <div class="col-sm-6 col-md-4" >

                                          <input type="text" name="country"  class="form-control"required='required' /> 

                                        </div>    
                                  </div>

                                    <!-- ---------status----------------------------->  
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">status </label>
                                         <div class="col-sm-6 col-md-4">
                                             <select class='form-control'  name='status'> 
                                                  
                                                  <option value='1'> new </option>
                                                  <option value='2'> like new </option>
                                                  <option value='3'>used  </option>
                                                  <option value='4'>old  </option>

                                             </select>                      
                                          </div>
                                       </div>
                                    <div class="form-group">
                                         <div class="col-sm-offset-2 col-sm-8">
                                           <input type="submit" name="submit"class="btn btn-primary" value="create" />
                                         </div>
                                    </div>
                                 </form>
                                        
                                        
                                        
                                        
                              </div>
                                 <div class="col-md-4">

                                            <div class="thumbnail item-box live-preview" > 
                                                <span class="price-tag">  price  </span> 
                                                 <img class="img-responsive" src="photo1.webp" alt="" /> 
                                                    <div class="caption">   
                                                             <h3> name </h3> 
                                                              <p>  desc  </p> 

                                                     </div> 
                                             </div>  

                           
                           
                           
                                  </div>
                                        <?php
                                        
                                        if(!empty($formerrors)){
                                            
                                            foreach ($formerrors as $error){
                                                
                                                echo '<div vlass=" alter alter-danger">'.$error .'</div>  ';
                                            }
                                        }
                                        ?>
                       
                                        
                              </div> 
            
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
 
