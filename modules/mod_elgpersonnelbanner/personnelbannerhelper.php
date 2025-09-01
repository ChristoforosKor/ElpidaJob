<?php

use Joomla\CMS\Factory;
/**
 * @todo Να πάρω των κώδικα για τα χαρακηριστικά από εδώ όταν θα φτιάξω τις λεπτομέρειες της αγγελίας.
 */
class PersonnelBannerHelper {

    public static function getData() {
        $input = Factory::getApplication() -> input;
        $id = $input -> getInt('id', 0);
        $langTag = Factory::getLanguage()->getTag();

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select(" cd.id, cd.modified, cd.name, cd.sortname1 as lastname")
                ->from("#__contact_details cd")
                ->where("cd.published = 1 and cd.id = " . $id);

        $item = $db -> setQuery($query) -> loadObject();
        $timeZone = new DateTimeZone("Europe/Athens");
        $d2 = new DateTime();
        $d2 -> setTimezone($timeZone);

        /**
         * @todo Τα λεκτικά από μετάφραση
         * 
         * */
        if ( $item == null) {
            $ret =  new stdClass();
            $ret -> id = 0;
            $ret -> name = '';
            $ret -> timeText = '';
            $ret -> lastname = '';
            $ret -> specs = [];
            return $ret;
        }
        
        
           
            $d = new DateTime($item->modified);
            $d->setTimezone($timeZone);
            $interval = $d->diff($d2);
            $timeText = '';
            /**
             * @todo Να ελέγξω αν το λεκτικό του χρόνο περιλμαβάνει και το αριθμητικό του χρόνου στη λίστα των αγγελίων.
             */
            if ($interval->m > 1) {
                $timeText = $interval->m . " μήνες ";
            } elseif ($interval->m > 0) {
                $timeText = "1  μήνα ";
            } elseif ($interval->d > 1) {
                $timeText = $interval->d . " ημέρες ";
            } elseif ($interval->d > 0) {
                $timeText = "μία ημέρα ";
            } elseif ($interval->h > 1) {
                $timeText = $interval -> h ." ώρες ";
            } else {
                $timeText = "την τελευταία ώρα";
            }
            $item -> timeText = $timeText;
           
            return $item ;
             
      
     
    }

    
    
}
