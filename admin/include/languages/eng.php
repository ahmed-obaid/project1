<?php

 function lang($h){
     
    static $lang= array (
         
        'home-admin'=>'home',
        'categ'      =>'categories',
        'items'      =>'items',
        'members'    =>'members',
        'statistics' =>'statistics',
        'comments'   =>'comments',
        'logs'       =>'logs',
        
         'member'    =>'ahmed',
        'edit'       =>'edit profile',
        'sett'       =>'settings',
        'out'        =>'logou'
   );
   return $lang[$h];
 }