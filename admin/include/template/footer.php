
 <script type="text/javascript" src="layout/js/jquery-3.4.1.min.js"> </script>
<script src="layout/js/bootstrap.min.js"> </script>

 
  <script  type="text/javascript">
  $(document).ready(function(){


 
    
  $('[placeholder]').focus(function(){
      
      
      $(this).attr('data-text',$(this).attr('placeholder'));
      $(this).attr('placeholder','');
      
  }).blur(function(){
      
      
      $(this).attr('placeholder',$(this).attr('data-text'));
      
  }); 
  
    ////////////////////adding *
 $('input').each(function()
  {
    if($(this).attr('required')==='required')
       {
        $(this).after('<span class="asterisk">*</span>');   
        
       }
  });
   
   //********************convert text field to text field****************
   var pass='.password';
    
     $('.show-pass').hover(function(){
         
         $(pass).attr('type','text'); 
         
     
     },function(){
         $(pass).attr('type','password');
                 }
             
            );
    
     
   //********************confirmation for delete****************
    
    $('.confirm').click(function(){
        return confirm("are you sure?");
        
        
        
    });
    
     
      
    
    $('input').each(function()
  {
    if($(this).attr('name')==='price')
       {
        $(this).after('<span class="asterisk">*</span>');   
        
       }
  }); 
    
     
    
    
 
 


 });

     
  
  </script>
 
 
<!-- <script type="text/javascript" src="layout/js/backend.js"> </script>-->
 

  </body>
  
</html>