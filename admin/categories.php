<?php

 
      
session_start();
if( isset($_SESSION['username'])){
     $title='categories';
   include 'init.php';
   include'include/template/header.php' ; 
  
 $do= isset($_GET['do'])? $_GET['do'] : 'manage'; 
     
          //************************************page manage
          //************************************page  manage
          //************************************page  manage
        
   if($do=='manage'){ 
     
      
           


$stmt=$con->prepare("SELECT * FROM categories ");
$stmt->execute();
$rows=$stmt->fetchall();

?>

        <h1 class='text-center'>manage categories <h1> 
                <div class="container"  >
                    
                    <div class="table-responsive"  >
                        
                        <table class="main-table text-center table table-bordered">
                            
                            <tr>
                                <td> id </td>
                                <td> name </td>
                                <td>description  </td>
                                <td>ordering   </td>
                                <td> visibilty</td>
                                <td> allow comment</td>
                                <td>allow ads  </td>
                                
                                <td>control  </td>
                                    
                            </tr>
                              <tr>
                                  <?php 
                                     foreach ($rows as $row){
                                  echo '<tr>';
                                          echo '<td>'.$row['id'].'</td>';
                                          echo '<td>'.$row['name'].'</td>';
                                          echo '<td>'.$row['description'].'</td>';
                                          echo '<td>'.$row['ordering'].'</td>';
                                           echo '<td>'.$row['visibilty'] .'</td>';
                                           echo '<td>'. $row['allow_comment'].'</td>';
                                           echo '<td>'. $row['allow_ads'].'</td>';
                                           //echo '<td>'. $row['date'].'</td>';
                                           echo "<td>  
                                           
                                                   <a href='categories.php?do=edit&&categid=".$row['id']."' class='btn btn-success'>   edit </a>
                                                   <a href='categories.php?do=delete&&categid=".$row["id"]."' class='confirm btn btn-danger'>delete </a> ";
                                                  
                                           
                                            echo' </td>';
                                           
                                          
                                   echo '</tr>';
                                    }
                                  ?>
                                    
                                </tr>
                            </table>                      
                         </div>
                           <a class= 'btn btn-primary' href='categories.php?do=add'> <i class='fa fa-plus '></i>add category </a> 

  </div> 
  
     <?php 
     
          //************************************page add
          //************************************page add
          //************************************page add
 }elseif($do=="add")
           {
     
     
       ?>

           
            <div class="container ">
               
                        <form class="form-horizontal" action="categories.php?do=insert" method="POST">
                             <h1 class='text-center'>Add category  <h1> 
                    <!-- username-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">category name </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="categname" class="form-control" required='required'  /> 
                        </div>    
                    </div>
                     <!-- username-->
                      <!-- password -->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">descriotion </label>
                        <div class="col-sm-10 col-md-6" >
                            
                            <input type="text" name="desc" class="form-control" required='required'  autocomplete="new-password" />
                            
                        </div>    
                    </div>
                     <!-- password e-->
                      <!-- email-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label"> ordering</label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="order" class="form-control" required='required'   />  
                        </div>    
                    </div>
                     <!-- email-->
                      <!-- ful name-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">visiblity </label>
                        <div class="col-sm-10 col-md-6" >
                            <div>
                              <input id= "vis-yes" type="radio" name="visib"   value="0" checked /> 
                              <label for="vis-yes"  > yes</label>
                            </div>
                            
                            <div>
                              <input id= "vis-no"   type="radio" name="visib"   value="1"  /> 
                              <label for="vis-no"  > no</label>
                            </div>
                            
                            
                            
                        </div>    
                    </div>
                     <!-- ful name-->
                      <!--  submit-->
                    <div class="form-group">
                        
                        <div class="col-sm-offset-5 col-sm-8" >
                            <input type="submit" value="add category" class="btn btn-primary btn-lg"/>  
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
                $name=$_POST['categname'];
                $desc=$_POST['desc'];
                $order=$_POST['order'];
                $visib=$_POST['visib'];
                 
               
                   $formerrors=array();
                   if(empty($name))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">username cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($desc))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">password cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($order))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">email cant be<strong> empty </strong></div>';  
                       
                       }
                        
                         
                       foreach($formerrors as $errors)
                           {
                           echo $errors ;
                           
                           }
                    
                        if(empty($formerrors))
                           {
                          $check= checkitems('name','categories', $name );
                              if($check==1){
                                         echo 'sorry the category has already exist ';
                                         
                                       }else{
                         
                
                $smts =$con->prepare('INSERT INTO
                                                   categories(name,description,ordering,visibilty ) 
                                                  VALUES(:u,:p,:e,:f)') ;
                  $smts->execute(array(
                               'u'=>$name,
                                'p'=>$desc,
                                 'e'=>$order,
                                  'f'=>$visib
                      
                                                 ));
                  
                  $mes= ' the insert has completed'  ;
                  $url= "categories.php";
                redirecthome( $mes,$url,3);
                
                  
                  
                     echo $smts->rowCount();
                                       }
                       }     
                        
            }else{
                  $erro= 'sorry you cant entering this page directly'  ;
                  $url= 'dashboard.php';
                redirecthome( $erro,$url,5);
                
                
             
                
                  }
   
    echo '</div>';
    
    
          //************************************page edite
          //************************************page edite
          //************************************page edite
       
                   
               }elseif($do=='edit'){
                   
                   $categid=isset($_GET['categid'])&& is_numeric($_GET['categid'])?intval($_GET['categid']):0 ;
    
          $stmt= $con->prepare('SELECT * FROM categories WHERE id= ?' );
      $stmt->execute(array($categid));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
       
      if($count>0) { ?>
        
        
           
            <div class="container ">
                <h1 class='text-center'>Edit categories  <h1> 
                        <form class="form-horizontal" action="categories.php?do=update" method="POST">
                            <input type="hidden" name="categid" class="form-control" value="<?php echo $categid; ?>"/>
                    <!-- username-->
                    <div class="form-group" >
                        <label class="col-sm-5  control-label">category name </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="categname" class="form-control"    value="<?php echo $row['name']; ?>" /> 
                        </div>    
                    </div>
                     <!-- username-->
                      <!-- password -->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">description </label>
                        <div class="col-sm-10 col-md-6" >
                             
                            <input type="text" name="desc" class="form-control"    value="<?php echo $row['description']; ?>" />  
                        </div>    
                    </div>
                     <!-- password e-->
                      <!-- email-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">ordering </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="order" class="form-control"   value="<?php echo $row['ordering'];?>" />  
                        </div>    
                    </div>
                     <!-- email-->
                      <!-- ful name-->
                    <div class="form-group">
                        <label class="col-sm-5 control-label">visibilty </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="visib" class="form-control"   value="<?php echo $row['visibilty'];?>"/>  
                        </div>    
                    </div>
                     <!-- ful name-->
                      <div class="form-group">
                        <label class="col-sm-5 control-label">allow comments </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="comment" class="form-control"   value="<?php echo $row['allow_comment'];?>"/>  
                        </div>    
                    </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">allow ads </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="ads" class="form-control"   value="<?php echo $row['allow_ads'];?>"/>  
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
       $url= 'index.php';
     redirecthome( $erro,$url,5);
     
        }
   
   
                   
                                  
     
          //************************************page update
          //************************************page  update
          //************************************page  update
   
      }elseif($do=='update') {
       
       echo"<h1 class='text-center'>Update categories  <h1> ";
       echo '<div class="container">';
        if($_SERVER['REQUEST_METHOD']=='POST')
             {
                $id   =$_POST['categid'];
                $name =$_POST['categname'];
                $desc =$_POST['desc'];
                $order=$_POST['order'];
                $visib=$_POST['visib'];
              $comment=$_POST['comment'];
                  $ads=$_POST['ads'];
                  
                          $farray=array();
                    
                    if(empty($name))
                       {
                       
                        $farray[]='<div class ="alert alert-danger">name cant be<strong> empty </strong></div>';  
                       
                       }
  
                     if(empty($farray))
                             {
                            $stm= $con->prepare('SELECT * FROM categories WHERE name=? AND id !=?' );
                            $stm->execute(array($name,$id));
                           
                            $count=$stm->rowCount();
                            if($count==1)

                            {
                                
                                 $mes= '<div class="alert alert-danger"> category name already exist</div>';  
                                
                                   
                     
                                $url= $_SERVER['HTTP_REFERER'];
                                redirecthome($mes,$url,3);
                            }else {   
                
                $smts =$con->prepare('UPDATE categories SET name= ? , description=? , ordering=?,visibilty=?, allow_comment=? ,allow_ads=? WHERE id=?');
                $smts->execute(array($name,$desc,$order,$visib,$comment,$ads,$id));
            
                     $mes= ' the updated has completed ';
                     
                  $url="categories.php";
                redirecthome($mes,$url,2);
                          
                                   }
                              
                             
                              }
                                      
                              
            }else{
                
                
               
                $erro= 'sorry you cant entering this page directly'  ;
                  $url= 'dashboard.php';
                redirecthome( $erro,$url,5);
                
                
                }
   
    echo '</div>';
    
    
          //************************************page delete
          //************************************page  delete
          //************************************page  delete
    
             
     
     
     
                     
   }elseif($do=='delete'){
      $categid=isset($_GET['categid'])&& is_numeric($_GET['categid'])?intval($_GET['categid']):0 ; 
      
      if($categid!==0){
          
      $stmt= $con->prepare('SELECT * FROM categories WHERE id= ?' );
      $stmt->execute(array($categid));
      $count=$stmt->rowcount();
       
          if( $count>0){
          
          
                   $stmt= $con->prepare('DELETE FROM categories WHERE id= :zuser' );
                   $stmt->bindparam(":zuser",$categid);
                   $stmt->execute();
                   echo 'the category has deleted';
                   
                $erro= ' deleting has completed'  ;
                  $url= 'categories.php';
                redirecthome( $erro,$url,3);
                   
                       }
                       
      
       }
          
         
      }
      
      include $tbl.'footer.php';

}