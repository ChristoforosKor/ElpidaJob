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
        
 class  views extends JModelDatabase{ 
     
     /**
      * 
      * @param type $idUser candiadates id
      * @return array of objects if finds data else en empty array;
      */
     static function getPreferencesHours($idUser, $db, $query) {
       if($idUser > 0) {
            $query->clear();
            $query  ->select('ch.idUser, h.hour')
                    ->from('#__elg_ergasia_candidates_hours ch')
                    ->join('INNER', "#__elg_ergasia_hour_translation h on ch.idHour = h.idHour and language = '" . JFactory::getLanguage()->getTag() . "'")
                    ->where('idUser = ' . $idUser);
            $db->setquery($query);
            return  $db->loadObjectList();
        }
        return array();
     }
     
}