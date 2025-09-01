<?php

use Joomla\CMS\Factory;
/**
 * @todo Να πάρω των κώδικα για τα χαρακηριστικά από εδώ όταν θα φτιάξω τις λεπτομέρειες της αγγελίας.
 */
class JobBannerHelper {

    public static function getData() {
        $input = Factory::getApplication() -> input;
        $id = $input -> getInt('id', 0);
        $db = Factory::getDbo();
        $langTag = $db -> quote ( Factory::getLanguage()->getTag() );

        
        $query = $db->getQuery(true);

        $query->select(" j.id, j.daysOff, j.submitDate, ht.`hour`, j.jobSalary, jt.jobTitle as title"
                . ", jt.jobDescription as description, g.city, g.lat, g.lng"
                . ",j.areasize, snt.specialNeed")
                ->from("#__elg_ergasia_job j")
                ->innerJoin("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language =  " . $langTag )
                ->leftJoin("#__elg_ergasia_hour_translation ht on j.idHour = ht.idHour and ht.LANGUAGE = " . $langTag )
                ->leftJoin("#__elg_ergasia_specialneeds_translation snt on snt.idSpecialNeed = j.idSpecialNeed and snt.language = " . $langTag )
                ->leftJoin("#__elg_geo g on g.id = j.idGeo")
                ->where("j.id = " . $id);

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
            $ret -> title = '';
            $ret -> timeText = '';
            $ret -> specs = [];
            return $ret;
        }
        
        
           
            $d = new DateTime($item->submitDate);
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
