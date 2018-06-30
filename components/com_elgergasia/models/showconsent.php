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
 
 
 class ElgergasiaModelShowConsent extends JModelDatabase{ 
  
    function getState() {
        $state = parent::getState();
        $id = $state->get('id', 0);
        $db = $this->getDb();
        $query = $db->getQuery(true);
        $query -> select("aid, candidate_name, cadidate_code,  ck_consent,  ck_consent_photo, candidate_signature")
                -> from("#__chronoforms_data_gdpr")
                -> where("cadidate_code = " . $db -> quote($id) );
        $db->setQuery($query);   
        $data = $db->loadAssoc();
        $state->set('itemData', $data);
        return $state;
    }
    
}