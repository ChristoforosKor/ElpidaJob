<?php

use Joomla\CMS\Factory;

class JobListHelper {

    public static function getData() {
        $linkToPage =  Factory::getApplication() -> getMenu() -> getItem(467)  -> route;
        
        $langTag = JFactory::getLanguage()-> getTag();
        $input = Factory::getApplication() -> input;
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select(" j.id, j.daysOff, j.submitDate, ht.`hour`, j.jobSalary, j.idSpeciality, snt.specialNeed, jt.jobTitle as title, jt.jobDescription as description, g.city, g.lat, g.lng,j.areasize")
                ->from("#__elg_ergasia_job j")
                ->innerJoin("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language =  " . $db->quote($langTag))
                ->innerJoin("#__elg_geo g on g.id = j.idGeo")
                ->leftJoin("#__elg_ergasia_hour_translation ht on j.idHour = ht.idHour and ht.LANGUAGE = " . $db->quote($langTag))
                ->leftJoin("#__elg_ergasia_specialneeds_translation snt on snt.idSpecialNeed = j.idSpecialNeed and snt.language = " . $db->quote($langTag))
                ->where("j.idJobState = 2 ")
                -> order("submitDate desc");

        $data = $db->setQuery($query, 0, 5)->loadObjectList();

        $timeZone = new DateTimeZone("Europe/Athens");
        $d2 = new DateTime();
        $d2->setTimezone($timeZone);

        /**
         * @todo Τα λεκτικά από μετάφραση
         * 
         * */
        $ret = array_map(function ($item) use ($timeZone, $d2, $linkToPage) {
            $d = new DateTime($item->submitDate);
            $d->setTimezone($timeZone);
            $interval = $d->diff($d2);
            $timeText = '';
            
            if ($interval->m > 1) {
                $timeText =  $interval -> m . " μήνες ";
                
            } elseif ($interval->m > 0) {
                $timeText = "1 μήνας ";
            } elseif ($interval->d > 1) {
                $timeText = $interval -> d . " ημέρες ";
            } elseif ($interval->d > 0) {
                $timeText = "1 ημέρα ";
            } elseif ($interval -> h > 1) {
                $timeText = $interval -> h . " ώρες ";
            } else {
                $timeText = " τελευταία ώρα";
            }
            $item -> timeText = $timeText;
            $item -> specs = [];
            if ( $item -> hour != '') {
                $item -> specs ['fullparttime'] = $item -> hour;
            }
            
            if ( $item -> city != '' ) {
                $item -> specs ['location'] = $item -> city;
            }
            
            if ( $item -> areasize != '') {
                $item -> specs['housesize'] = $item -> areasize . "τμ";
            }
            
            if ( $item -> jobSalary != '' ) {
                $item -> specs ['salary'] = $item -> jobSalary . "€";
            } 
            
            if ( $item -> daysOff != '') {
                $item -> specs['daysOff'] = $item -> daysOff . " ρεπό/μήνα";
            }
            
            if ( $item -> specialNeed != '') {
                $item -> specs['disability'] = $item -> specialNeed ;
            }
            $item -> linkToPage = $linkToPage;
            return $item ;
            
//            <div class="swiper-slide aggelies_slide"><a href="#"><div class="aggelies_slide_top"><h3>Ζητείται Γηροκόμος</h3><p>ΚΩΔ. ΑΓΓΕΛΙΑΣ: 5167149</p></div><p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><div class="specs"><p>Πλήρης απασχόληση</p><p>Μαρούσι</p><p>78τμ</p><p>700€ - 800€</p><p>4 ρεπό/μήνα</p><p>Υπάρχουν κινητικά προβλήματα</p></div><div class="date_added"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 488.152 488.152"><path d="M177.854,269.311c0-6.115-4.96-11.069-11.08-11.069h-38.665c-6.113,0-11.074,4.954-11.074,11.069v38.66    c0,6.123,4.961,11.079,11.074,11.079h38.665c6.12,0,11.08-4.956,11.08-11.079V269.311L177.854,269.311z"></path><path d="M274.483,269.311c0-6.115-4.961-11.069-11.069-11.069h-38.67c-6.113,0-11.074,4.954-11.074,11.069v38.66    c0,6.123,4.961,11.079,11.074,11.079h38.67c6.108,0,11.069-4.956,11.069-11.079V269.311z"></path><path d="M371.117,269.311c0-6.115-4.961-11.069-11.074-11.069h-38.665c-6.12,0-11.08,4.954-11.08,11.069v38.66    c0,6.123,4.96,11.079,11.08,11.079h38.665c6.113,0,11.074-4.956,11.074-11.079V269.311z"></path><path d="M177.854,365.95c0-6.125-4.96-11.075-11.08-11.075h-38.665c-6.113,0-11.074,4.95-11.074,11.075v38.653    c0,6.119,4.961,11.074,11.074,11.074h38.665c6.12,0,11.08-4.956,11.08-11.074V365.95L177.854,365.95z"></path><path d="M274.483,365.95c0-6.125-4.961-11.075-11.069-11.075h-38.67c-6.113,0-11.074,4.95-11.074,11.075v38.653    c0,6.119,4.961,11.074,11.074,11.074h38.67c6.108,0,11.069-4.956,11.069-11.074V365.95z"></path><path d="M371.117,365.95c0-6.125-4.961-11.075-11.069-11.075h-38.67c-6.12,0-11.08,4.95-11.08,11.075v38.653    c0,6.119,4.96,11.074,11.08,11.074h38.67c6.108,0,11.069-4.956,11.069-11.074V365.95L371.117,365.95z"></path><path d="M440.254,54.354v59.05c0,26.69-21.652,48.198-48.338,48.198h-30.493c-26.688,0-48.627-21.508-48.627-48.198V54.142    h-137.44v59.262c0,26.69-21.938,48.198-48.622,48.198H96.235c-26.685,0-48.336-21.508-48.336-48.198v-59.05    C24.576,55.057,5.411,74.356,5.411,98.077v346.061c0,24.167,19.588,44.015,43.755,44.015h389.82    c24.131,0,43.755-19.889,43.755-44.015V98.077C482.741,74.356,463.577,55.057,440.254,54.354z M426.091,422.588    c0,10.444-8.468,18.917-18.916,18.917H80.144c-10.448,0-18.916-8.473-18.916-18.917V243.835c0-10.448,8.467-18.921,18.916-18.921    h327.03c10.448,0,18.916,8.473,18.916,18.921L426.091,422.588L426.091,422.588z"></path><path d="M96.128,129.945h30.162c9.155,0,16.578-7.412,16.578-16.567V16.573C142.868,7.417,135.445,0,126.29,0H96.128    C86.972,0,79.55,7.417,79.55,16.573v96.805C79.55,122.533,86.972,129.945,96.128,129.945z"></path><path d="M361.035,129.945h30.162c9.149,0,16.572-7.412,16.572-16.567V16.573C407.77,7.417,400.347,0,391.197,0h-30.162    c-9.154,0-16.577,7.417-16.577,16.573v96.805C344.458,122.533,351.881,129.945,361.035,129.945z"></path></svg> <span>πριν από 1 ώρα</span></div></a></div>
        }, $data);
        return $ret;
    }

}
