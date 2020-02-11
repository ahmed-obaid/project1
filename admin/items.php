<?php

       
session_start();
if( isset($_SESSION['username'])){
     $title='items';
   include 'init.php';
   include'include/template/header.php' ; 
  
 $do= isset($_GET['do'])? $_GET['do'] : 'manage'; 
     
          //************************************page manage
          //************************************page  manage
          //************************************page  manage
        
   if($do=='manage'){

$stmt=$con->prepare(" SELECT 
                             items.*,
                                   categories.name AS category_name,
                                   user.username
                             FROM 
                                  items 
                             INNER JOIN
                                  categories 
                             ON 
                                  categories.id = items.cat_id
                             INNER JOIN
                                   user
                             ON
                                   user.userid = items.member_id");
                                  
$stmt->execute();
$rows=$stmt->fetchall();

?>

    <h1 class='text-center'>manage items <h1> 
          <div class="container">
                    
                    <div class="table-responsive"  >
                        
                        <table class="main-table text-center table table-bordered">
                            
                            <tr>
                                <td> id </td>
                                <td> name </td>
                                <td>description  </td>
                                <td>category  </td>
                                <td>member  </td>
                                <td> price  </td>
                                <td> date</td>
                                <td> control </td>                              
                            </tr>
                              <tr>
                                  <?php 
                                     foreach ($rows as $row){
                                  echo '<tr>';
                                           echo '<td>'.$row['item_id'].'</td>';
                                           echo '<td>'.$row['name'].'</td>';
                                           echo '<td>'.$row['description'].'</td>';
                                           echo '<td>'.$row['category_name'].'</td>';
                                           echo '<td>'.$row['username'].'</td>';
                                           echo '<td>'.$row['price'].'</td>';
                                           echo '<td>'.$row['add_date'] .'</td>';
                                          
                                           echo "<td>  
                                           
                                                   <a href='items.php?do=edit&&itemid=".$row['item_id']."' class='btn btn-success'>   edit </a>
                                                   <a href='items.php?do=delete&&itemid=".$row["item_id"]."' class='confirm btn btn-danger'>delete </a> ";
                                                  if($row['approve']==0){
                                                     
                                                     echo "<a href='items.php?do=approve&&itemid=".$row['item_id']."'  class=' btn btn-info'>approve</a>";
                                           
                                            echo' </td>';
                                           
                                          
                                   echo '</tr>';
                                    }
                                    
                                     } 
                                  ?>
                                    
                                </tr>
                            </table>                      
                         </div>
                    <a class= 'btn btn-primary' href='items.php?do=add'> <i class='fa fa-plus '></i> add items </a> 

           </div> 
  
     <?php 
       //************************************page add
          //************************************page add
          //************************************page add
 }elseif($do=="add")
           {
     
     
       ?>

           
        <div class="container ">
               
               <form class="form-horizontal" action="items.php?do=insert" method="POST">
                          <h1 class='text-center'>Add items  <h1> 
                     <!-- ---------item name----------------------------->  
                    <div class="form-group">
                        <label class="col-sm-5 control-label">item name </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="itemname" class="form-control" required='required'  /> 
                        </div>    
                    </div>
                     
                      <!-- ---------description----------------------------->  
                    <div class="form-group">
                        <label class="col-sm-5 control-label">description </label>
                        <div class="col-sm-10 col-md-6" >
                            
                            <input type="text" name="desc" class="form-control" required='required'  autocomplete="new-password" />
                            
                        </div>    
                    </div>
                      
                       <!-- ---------price----------------------------->  
                    <div class="form-group">
                        <label class="col-sm-5 control-label">price  </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="price" class="form-control" required='required'  />  
                        </div>    
                    </div>
                   
                        <!-- ---------country----------------------------->  
                     <div class="form-group">
                        <label class="col-sm-5 control-label" >country </label>
                             <div class="col-sm-10 col-md-6" >
                            
                              <input    type="text" name="country"  class="form-control" required='required' placeholder='country of made'  /> 
                          
                            </div>    
                      </div>
                      
                        <!-- ---------status----------------------------->  
                      <div class="form-group">
                        <label class="col-sm-5 control-label">status </label>
                             <div class="col-sm-10 col-md-6"    >
                                 <select class='form-control'  name='status'   > 
                                      <option value='0' >  </option>
                                      <option value='1'> new </option>
                                      <option value='2'> like new </option>
                                      <option value='3'>used  </option>
                                      <option value='4'>old  </option>
                                                  
                                 </select>                      
                              </div>
                      </div>
                         <!-- ----------memberid-----------------------------> 
                      <div class="form-group">
                        <label class="col-sm-5 control-label">member name </label>
                             <div class="col-sm-10 col-md-6"    >
                                 <select class='form-control'  name='memname'> 
                                      <option value='0'>  </option>
                                      <option value='1'>
                                          <?php 
                                      $stmt=$con->prepare("SELECT * FROM user ");
                                      $stmt->execute();
                                      $rows=$stmt->fetchall();
                                      foreach ($rows as $row)
                                             {
                                             echo '<option value='.$row['userid'].' >'.$row['username'].'</option>';
                                          
                                             }
                                      
                                              ?>  
                                      </option>
                                                           
                                 </select>                      
                              </div>
                      </div> 
                          <!-- ---------catid-----------------------------> 
                       <div class="form-group">
                        <label class="col-sm-5 control-label">category </label>
                             <div class="col-sm-10 col-md-6"  required='required'  >
                                 <select class='form-control'  name='catname'> 
                                      <option value='0'>  </option>
                                      <option value='1'>  
                                         <?php 
                                      $stmt=$con->prepare("SELECT * FROM categories ");
                                      $stmt->execute();
                                      $rows=$stmt->fetchall();
                                      foreach ($rows as $row)
                                               {
                                                 echo '<option value='.$row["id"].'>' .$row['name'].'</option>';
                                          
                                          
                                          
                                                }                    
                                      
                                          ?>
                                
                                      
                                      </option>
                                      
                                                  
                                 </select>                      
                              </div>
                      </div>  
                      
                      
                      
                      
                         <!-- ---------------- submit------------------>
                    <div class="form-group">
                        
                        <div class="col-sm-offset-5 col-sm-8" >
                            <input type="submit" value="add items" class="btn btn-primary btn-lg"/>  
                        </div>    
                    </div>
                      
                      
                      
                      
                 </form>

            </div>
                     <!-- ful name-->
                   
                     <!-- username-->
                    
                
                
                
            
            
                        
            
           
           
               <?php
          //************************************page insert
          //************************************page insert
          //************************************page insert
               }elseif($do=='insert'){
                   
                        
      
        if($_SERVER['REQUEST_METHOD']=='POST')
             {
           echo"<h1 class='text-center'>insert items  <h1> ";
           echo '<div class="container">';
                $name=$_POST['itemname'];
                $desc=$_POST['desc'];
                $price=$_POST['price'];
                $country=$_POST['country'];
                $status=$_POST['status'];
                $memname=$_POST['memname'];
                $catname=$_POST['catname'];
          
               
                   $formerrors=array();
                   if(empty($name))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">item name cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($desc))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">desc cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($price))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">price cant be<strong> empty </strong></div>';  
                       
                       }
                       if( empty($country)  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">country cant be empty</div>';  
                       
                       }
                       if(empty($status)  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">status cant be begger than <strong> 24 </strong></div>';  
                       
                       }
                       if(empty($memname ))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">member name cant be empty  </div>';  
                       
                       }
                       
                       if(empty($catname))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">category cant be empty    </div>';  
                       
                       }
                       
                       
                       
                       
                         
                       foreach($formerrors as $errors)
                           {
                           echo $errors ;
                           
                           }
                    
                        if(empty($formerrors))
                           {
                          $check= checkitems('name','items', $name );
                              if($check==1){
                                         echo '<div class ="alert alert-danger"> sorry the itemname has already exist </div> ';
                                         
                                       }else{
                         
                
                $smts =$con->prepare('INSERT INTO
                                                   items(name , description, price, country_made, status,cat_id,member_id,add_date  ) 
                                                  VALUES(  :u,:p,:e,:f,:s,:c ,:m, now()     )') ;
                  $smts->execute(array(
                               'u'=>$name,
                                'p'=>$desc,
                                 'e'=>$price,
                                  'f'=>$country,
                                   's'=>$status,
                                     'c'=>$catname,
                                      'm'=>$memname       
                                           ));
                  
                  $mes= ' the insert has completed '  ;
                  $url=$_SERVER['HTTP_REFERER'];
                redirecthome( $mes,$url,5);
                
                  
                  
                     echo $smts->rowCount();
                                       }
                       }     
                        
            }else{
                  $erro= 'sorry you cant entering this page directly'  ;
                  $url= 'items.php';
                redirecthome( $erro,$url,3);
                
                
             
                
                  }
   
    echo '</div>';
    
    
          //************************************page edite
          //************************************page  edite
          //************************************page  edite
       
                   
               }elseif($do=="edit")
           {
                   
          
       $itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'])?intval($_GET['itemid']):0 ;
          $stmt= $con->prepare('SELECT * FROM items WHERE item_id= ?' );
      $stmt->execute(array($itemid));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
       
           if($count>0) {  
                     
         ?>

           
        <div class="container ">
               
               <form class="form-horizontal" action="items.php?do=update" method="POST">
                    <input type="hidden" name="itemid" class="form-control" value="<?php echo $row['item_id'] ;  ?> "   />
                          <h1 class='text-center'>edite items  <h1> 
                     <!-- ---------item name----------------------------->  
                    <div class="form-group">
                        
                        <label class="col-sm-5 control-label">item name </label>
                       
                        
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="itemname" class="form-control" value="<?php echo $row['name'] ;?> "   /> 
                        </div>    
                    </div>
                     
                      <!-- ---------description----------------------------->  
                    <div class="form-group">
                        <label class="col-sm-5 control-label">description </label>
                        <div class="col-sm-10 col-md-6" >
                            
                            <input type="text" name="desc" class="form-control" required='required' value="<?php echo $row['description'] ;?> "    />
                            
                        </div>    
                    </div>
                      
                       <!-- ---------price----------------------------->  
                    <div class="form-group">
                        <label class="col-sm-5 control-label">price  </label>
                        <div class="col-sm-10 col-md-6" >
                            <input type="text" name="price" class="form-control" value="<?php echo $row['price'];?> "   />  
                        </div>    
                    </div>
                   
                        <!-- ---------country----------------------------->  
                     <div class="form-group">
                        <label class="col-sm-5 control-label" >country </label>
                             <div class="col-sm-10 col-md-6" >
                            
                              <input    type="text" name="country"  class="form-control"   value="<?php echo $row['country_made'] ;?> "   /> 
                          
                            </div>    
                      </div>
                      
                        <!-- ---------status----------------------------->  
                      <div class="form-group">
                        <label class="col-sm-5 control-label">status </label>
                             <div class="col-sm-10 col-md-6" >
                                 <select class='form-control'  name='status'> 
                                      <option value='0'>  </option>
                                      <option value='1' <?php if($row['status']==1) {echo'selected' ;  }  ?>    > new </option>
                                      <option value='2' <?php if($row['status']==2) {echo'selected' ;  }  ?>   > like new </option>
                                      <option value='3' <?php if($row['status']==3) {echo'selected' ;  }  ?>    >used  </option>
                                      <option value='4' <?php if($row['status']==4) {echo'selected' ;  }  ?>   >old  </option>
                                                  
                                 </select>                      
                              </div>
                      </div>
                         <!-- ----------memberid-----------------------------> 
                      <div class="form-group">
                        <label class="col-sm-5 control-label"> member </label>
                             <div class="col-sm-10 col-md-6" >
                                 <select class='form-control'  name='memname'> 
                                      <option value='0'>  </option>
                                      <option value='1'>
                                          <?php 
                                      $stmtm=$con->prepare("SELECT * FROM user ");
                                      $stmtm->execute();
                                      $rowsm=$stmtm->fetchall();
                                      foreach ($rowsm as $rowm)
                                             {
                                             echo "<option   value=' $rowm[userid]'" ; 
                                                      
                                                  if($row['member_id']==$rowm['userid']) {echo'selected' ;  }
                                            
                                                  echo    ' >' .$rowm['username'].
                                                   '</option>';
                                          
                                             }
                                      
                                               ?>  
                                      </option>
                                                           
                                 </select>                      
                              </div>
                      </div> 
                          <!-- ---------catid-----------------------------> 
                       <div class="form-group">
                        <label class="col-sm-5 control-label">category </label>
                             <div class="col-sm-10 col-md-6" >
                                 <select class='form-control'  name='catname'> 
                                      <option value='0'>  </option>
                                      <option value='1'>  
                                         <?php 
                                      $stmtc=$con->prepare("SELECT * FROM categories ");
                                      $stmtc->execute();
                                      $rowsc=$stmtc->fetchall();
                                      
                                     
                                      
                                      foreach ($rowsc as $ro)
                                          
                                        
                                               {
                                                 echo "<option   value=' $ro[id]'" ; 
                                                      
                                                  if($row['cat_id']==$ro['id']) {echo'selected' ;  }
                                            
                                                  echo    ' >' .$ro['name'].
                                                   '</option>';
                                          
                                                }                    
                                      
                                          ?>
                                
                                      
                                      </option>
                                      
                                                  
                                 </select>                      
                              </div>
                      </div>  
                      
                      
                      
                      
                         <!-- ---------------- submit------------------>
                    <div class="form-group">
                        
                        <div class="col-sm-offset-5 col-sm-8" >
                            <input type="submit" value="save items" class="btn btn-primary btn-lg"/>  
                        </div>    
                    </div>
                      
                      
                      
                      
                 </form>

            </div>
                     
             
           
               <?php
               $stmt=$con->prepare("SELECT  
                           comments.* , user.username
                         FROM
                             comments
                           INNER JOIN
                                 user
                            ON
                                 user.userid=comments.user_id
                             WHERE item_id= $itemid

                                    ");
                           
                     $stmt->execute();
                     $rows=$stmt->fetchall();

 ?>

        <h1 class='text-center'> manage[ <?php echo $row['name'] ;?> ]comments  <h1> 
                <div class="container"  >
                    
                    <div class="table-responsive"  >
                        
                        <table class="main-table text-center table table-bordered">
                            
                            <tr>
                                 
                                <td> comment </td>
                                 
                               
                                <td> username </td>
                                <td> comment_date </td>
                                 <td> control </td>
                                    
                            </tr>
                              <tr>
                                  <?php 
                                     foreach ($rows as $row){
                                  echo '<tr>';
                                           
                                          echo '<td>'.$row['comment'].'</td>';
                                           
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
               
                }
          //************************************page update
          //************************************page update
          //************************************page update
               }elseif($do=='update') {
        
       echo"<h1 class='text-center'> Update item  <h1> ";
       echo '<div class="container">';
        if($_SERVER['REQUEST_METHOD']=='POST')
             {
               $itemid=$_POST['itemid'];
               $name=$_POST['itemname'];
                $desc=$_POST['desc'];
                $price=$_POST['price'];
                $country=$_POST['country'];
                $status=$_POST['status'];
                $memname=$_POST['memname'];
                $catname=$_POST['catname'];
                 
                      $formerrors=array();   
                   
                       if(empty($name))
                       {
                       
                        $formerrors[]= '<div class ="alert alert-danger">name cant be<strong> empty </strong></div>';   
                       
                       }
                       if(empty($desc))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">desc cant be<strong> empty </strong></div>';  
                       
                       }
                       if(empty($price))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">price cant be<strong> empty </strong></div>';  
                       
                       }
                       if( empty($country)  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">country cant be empty</div>';  
                       
                       }
                       if(empty($status)  )
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">status cant be begger than <strong> 24 </strong></div>';  
                       
                       }
                       if(empty($memname ))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">member name cant be empty  </div>';  
                       
                       }
                       
                       if(empty($catname))
                       {
                       
                        $formerrors[]='<div class ="alert alert-danger">category cant be empty    </div>';  
                       
                       }
                       
                       
                       
                       foreach($formerrors as $errors)
                           {
                           echo $errors;
                           
                           }
                           
                        if(empty($formerrors))
                        {
                
                $smts =$con->prepare("UPDATE items SET 
                             name= ?,
                             description=?,  
                             price=?,
                      country_made=?, 
                        
                             status=?,
                             cat_id=?,
                             member_id=? 
                        WHERE
                            item_id=?");
                
                
                  $smts->execute(array($name,$desc,$price,$country,$status,$catname,$memname,$itemid));
                     echo $smts->rowCount();
                     $mes= 'the updated has completed ';
                     
                  $url="items.php";
                redirecthome($mes,$url,3);
                          
                        }
            }else{
                
                
               
                $erro= 'sorry you cant entering this page directly'  ;
                  $url= 'dashboaard.php';
                redirecthome( $erro,$url,5);
                
                
                }
   
    echo '</div>';
    
    
          //************************************page delete
          //************************************page delete
          //************************************page delete
                
             }elseif($do=='delete'){
      $itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'])?intval($_GET['itemid']):0 ; 
      
      if($itemid!==0){
          
          $stmt= $con->prepare('SELECT * FROM items WHERE item_id=?' );
      $stmt->execute(array($itemid));
      $count=$stmt->rowcount();
       
          if( $count>0){
          
          
                   $stmt= $con->prepare('DELETE FROM items WHERE item_id= :zuser' );
                   $stmt->bindparam(":zuser",$itemid);
                   $stmt->execute();
                  
                   
                $success= ' the delete has completed'  ;
                  $url= 'items.php';
                redirecthome( $success,$url,3);
                   
                   
                       }else
                           {
                           
                           $mes='there is not id like this';
                           $url="dashboard.php";
                           redirecthome( $mes,$url,3);
                           
                           }
      
       }
          
        
                   
       
          //************************************page  approve
          //************************************page approve
          //************************************page approve
       
   
               
             
               
}elseif($do=="approve")
            {
                
                $itemid=isset($_GET['itemid'])&& is_numeric($_GET['itemid'])?intval($_GET['itemid']):0 ;
                
                if($itemid!==0)
                {
          
                      $stmt= $con->prepare('SELECT * FROM items WHERE item_id=?' );
                      $stmt->execute(array($itemid));
                      $count=$stmt->rowcount();
                         if($count>0) 
                            { 
                               $smts =$con->prepare("UPDATE items SET approve=1  WHERE item_id=$_GET[itemid]");
                               $smts->execute(array());
                      
                               $mes= ' the approvate has completed ';
                     
                               $url=$_SERVER['HTTP_REFERER'];
                               redirecthome($mes,$url,3);
                           
                            }
                }
            } 


 include $tbl.'footer.php' ; 


    
} 