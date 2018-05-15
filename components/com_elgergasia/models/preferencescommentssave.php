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
 
 class ElgergasiaModelPreferencesCommentsSave extends JModelDatabase{ 
    
   function setState(JRegistry $state) {
        JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
                                        
        $table = JTable::getInstance('candidatespreferencescomments','Table');
        $table->bind($state->toArray());
        return $table->store();
    }       
}
?>