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
 require_once JPATH_COMPONENT_SITE . '/models/payments.php';
 
 class ElgergasiaModelEmployer extends JModelDatabase{ 

 
   
    
    public function __construct($state = null, $db = null) {
        parent::__construct($state, $db);
    }   
    
    function getState() {
        $state = parent::getState();
       
        $idUser = $state->get('id');
        $db = $this->getDb();
        $query = $db->getQuery(true);
        $currentLanguage = JFactory::getLanguage()->getTag();
        $query->select(" e.id , idUser, cn.country, ifNull(et.city, etd.city) as city, ifNull(et.address, etd.address) as address, postalCode, phone, mobile, fax
            , taxNumber, ifNull(et.taxOffice, etd.taxOffice) as taxOffice ,i.industry, ifNull(et.profession, etd.profession) as profession, e.website
            , ifNull(et.information, etd.information) as information,u.email, ifNull(et.discreteTitle, etd.discreteTitle) as discreteTitle, u.name  ")
              ->from("#__users u")
              ->join("left", "#__elg_ergasia_employer e  on e.idUser = u.id")
              ->leftJoin("#__elg_ergasia_employer_translation et  on e.id = et.idEmployer and et.language = '" . $currentLanguage . "'")
              ->leftJoin("#__elg_ergasia_employer_translation etd  on e.id = etd.idEmployer and etd.isDefault = 1")
              ->join("left", "#__elg_country_translation cn on e.idCountry = cn.idCountry and cn.language = '" . $currentLanguage . "'")
              ->join("left", "#__elg_ergasia_industry_translation i on e.idIndustry = i.idIndustry and i.language = '" . $currentLanguage . "'")
              ->where("u.id = " . $idUser);
        $db->setQuery($query);  
        $data = $db->loadObject();
        if ($data == null) {
            $data = NullsFactory::getNullEmployer();
        }
       
        $mPayments = new ElgergasiaModelPayments();
        $paymentsState = $mPayments->getState();
        $data->payments = $paymentsState->get('data');
        $state->set('data', $data);
        return $state;
    }
    

    private function getNullObject() {
        $nullObject = '{ "id": "0" , "idUser": "0", "country" : "", "city" : "", "address" : "", "postalCode": ""
        , "phone": "", "mobile": "", "fax": ""
        , "taxNumber" : "", "taxOffice" : "", "industry": "","profession" :"", "website": "", "information": "", "email": ""  }';
        return json_decode($nullObject);
    }
   
    
 
    public function setState(JRegistry $state) {
     
        if(  !is_numeric($state->get('id')) ) {
            $state->set('id',0);
        }
      
        parent::setState($state);
    }
    
   
}
?>