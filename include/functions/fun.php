<?php


 
   //-------------------get cat
  //-------------------get cat
  //-------------------get cat
  
 
    function getcat( )
  
 {
      global $con;         
    $cat=$con->prepare("SELECT * FROM categories");
    $cat->execute(array());
    $rows=$cat->fetchall();
   return $rows;
  }
  
  
   //-------------------get items
  //-------------------get items
  //-------------------get items
  
  
    function getitems($id )
  
 {
      global $con;         
    $items=$con->prepare("SELECT * FROM items WHERE cat_id=? ORDER BY item_id DESC ");
    $items->execute(array($id));
    $rows=$items->fetchall();
   return $rows;
  }
    
      
     














//------------------- old function
//------------------- old function
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
  
     
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  