<?php
function title(){
    global $title;
 if (isset($title)) {
    echo $title ;
}else{echo 'defult ';}
}

//-------------------home redirect function

function redirecthome($errormsj,$url ,$second=3){
    $page='';
    if(isset($_SERVER['HTTP_REFERER'])){$page='prevıous page';
    
    }else{$page='homepage';}
    echo " <div class='alert alert-danger'>$errormsj</div> ";
    
     echo " <div class='alert alert-info' > you will be at $page after $second seconds</div> ";
     header("refresh:$second;url=$url");
     exit();
}

//-------------------check items functón
//-------------------check items functón
//-------------------check items functón
function checkitems ($selected,$table,$value)
  {
    global $con;
            
    $stat=$con->prepare("SELECT $selected FROM $table WHERE $selected=? ");
    $stat->execute(array($value));
   $count=$stat->rowcount();
   return $count;
  }
  //-------------------check items functón
  //-------------------check items functón
  //-------------------check items functón
  function countitems($selected,$table,$status ,$value)
  {
    global $con;
          
    $stat=$con->prepare("SELECT $selected FROM $table WHERE $status=?   ");
    $stat->execute(array($value));
   $count=$stat->rowcount();
   return $count;
    
  }
  //-------------------check items functón
  //-------------------check items functón
  //-------------------check items functón
  
  function countitems1($item,$table)
  {
    global $con;
            
    $stat=$con->prepare("SELECT count($item) FROM $table ");
    $stat->execute();
    return $stat->fetchcolumn();
   
   } 
   
   //-------------------getlatest functón
  //-------------------getlatest functón
  //-------------------getlatest functón
  
 function getlatest($select,$table,$order,$limit=5)
  
 {
      global $con;         
    $stat=$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit ");
    $stat->execute(array());
    $rows=$stat->fetchall();
   return $rows;
  }
     
     
     
     
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  