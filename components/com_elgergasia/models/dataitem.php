<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

 
----------------------------------**/

 defined( '_JEXEC' ) or die( 'Restricted access' );
 
/**
 * Parent class for all class that returns data from the database.
 * This class is representig one qquery results from the database.
 */
abstract class ElgergasiaModelDataItem extends JModelDatabase  { 
   
   
    
        /**
         * returns data from the database on form of an object or a list objects.
         * Always return an object even if there are no results. When there are not results
         * 
         */
        public abstract function getData();
        
   
       
        
        
        
   
}
?>