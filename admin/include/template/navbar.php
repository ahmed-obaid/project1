 
 <nav class="navbar navbar-inverse">
    <div class='container'>
        <div class='navbar-header'>
          <button class="navbar-toggle collapse" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
            
            <a class="navbar-brand" href="dashboard.php"><?php echo lang('home-admin'); ?></a>
        </div>
        
   <div class="collapse navbar-collapse" id="app-nav">
    <ul class="nav navbar-nav">
      <li ><a href="categories.php"><?php echo lang('categ'); ?></a></li>
      <li ><a href='items.php'><?php echo lang('items'); ?></a></li>
      <li ><a href="members.php"><?php echo lang('members'); ?></a></li>
      <li ><a href="#"><?php echo lang('statistics'); ?></a></li>
        <li ><a href="comments.php"><?php echo lang('comments'); ?></a></li>
      <li ><a href="#"><?php echo lang('logs'); ?></a></li>
    </ul> 
       <ul class="nav navbar-nav navbar-right">
           <li class='dropdown'>
               <a href='#' id='navbarDropdown' class='nav-link dropdown-toggle' data-toggle='dropdown'role='button' aria-haspopup='true' aria-expanded='false'><?php echo lang('member'); ?></a>
                   <div class='dropdown-menu'>
                       <li><a href='members.php?do=edit&userid=<?php echo $_SESSION['id'] ?>'> <?php echo lang('edit'); ?></a> </li>
                        <li><a href='#'> <?php echo lang('sett'); ?></a> </li>
                         <li><a href='logout.php'> <?php echo lang('out'); ?>t</a> </li>
                   </div>
               
           </li>
       </ul>
     </div>
    </div>
</nav>   
      

 