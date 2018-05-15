<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr 
----------------------------------**/

 defined( '_JEXEC' ) or die( 'Restricted access' );
 
 
 class ElgergasiaModelEmployers extends JModelDatabase{ 
    function getState() {
        $lang = JFactory::getLanguage()->getTag();
        $state = parent::getState();
        $db = $this->getDb();
        
        $filters = $state->get('filters');
        $profession = ($filters->profession != "" ? '%' . $db->escape( $filters->profession) . '%' : "") ;
        $nameSearch = ($filters->nameSearch != "" ? '%' . $db->escape( $filters->nameSearch) . '%' : "");
        $website = ($filters->website != "" ? '%' . $db->escape( $filters->website) . '%' : "");
        $email = ($filters->email != "" ? '%' . $db->escape( $filters->email) . '%' : "");
        $city = ($filters->city != "" ? '%' . $db->escape( $filters->city) . '%' : "");
        $address = ($filters->address != "" ? '%' . $db->escape( $filters->address) . '%' : "");
        $postalCode = ($filters->postalCode != "" ? '%' . $db->escape( $filters->postalCode) . '%' : "");
        $taxOffice = ($filters->taxOffice != "" ? '%' . $db->escape( $filters->taxOffice) . '%' : "");
        $taxNumber = ($filters->taxNumber != "" ? '%' . $db->escape( $filters->taxNumber) . '%' : "");
        $phone = ($filters->phone != "" ? '%' . $db->escape( $filters->phone) . '%' : "");
        $employerGroup = JComponentHelper::getParams('com_elgergasia')->get('employersRestrGroup', 13);
         
        
	$idSearch = ($filters->idSearch ==0 ? '' : $filters->idSearch );
        $key = $state->get('layout');
        $form = JForm::getInstance($key, JPATH_COMPONENT_SITE . '/models/forms/' . $key . '.xml');
        $form->setValue('idSearch', null, $idSearch);
        $form->setValue('taxNumber', null, $filters->taxNumber);
        $form->setValue('nameSearch', null, $filters->nameSearch);
        $form->setValue('idIndustry', null, $filters->idIndustry);
        $form->setValue('idCountry', null, $filters->idCountry);
        $form->setValue('city', null, $filters->city);
        $state->set('form', $form);
        if($filters->filter_order == 'citation') {
            $filters->filter_order = ' country, city';
        }
        elseif ($filters->filter_order == 'telephones') {
            $filters->filter_order = ' phone, mobile, fax';
        }
        $query = $db->getQuery(true);
        $query->select(" distinct u.id, ifNull(et.discreteTitle, etd.discreteTitle) as employerName, cr.country, trim(ifNull(et.city,etd.city)) as city,   u.email, trim(ifNull(eb.phone, '')) as phone,
trim(ifNull(eb.mobile, '')) as mobile, trim(ifNull(eb.fax, '')) as fax, i.industry, lu.datemodified ")
                ->from ("#__users u ")
              //  ->join('inner', '#__user_usergroup_map um on u.id = um.user_id and group_id = '. $employerGroup)
                ->innerJoin('#__elg_ergasia_employer eb on u.id = eb.idUser')
                ->join ('left',  '#__elg_ergasia_lastupdates lu on u.id = lu.idUser')
                ->leftJoin("#__elg_ergasia_employer_translation et on eb.id = et.idEmployer and et.language= '" . $lang . "' " )
                ->leftJoin("#__elg_ergasia_employer_translation etd on eb.id = etd.idEmployer and etd.isDefault = 1")
                ->join ('left', "#__elg_country_translation cr on cr.idCountry = eb.idCountry and cr.language = '" . $lang . "'")               
                ->join('left', "#__elg_ergasia_industry_translation i on eb.idIndustry = i.idIndustry and i.language = '" . $lang . "'")
                ->order($filters->filter_order . ' ' . $filters->filter_order_Dir);
              	
        $whereCl = '';
        $andV = '';
       
        if($idSearch > 0 ) {
            $whereCl .= $andV . " eb.idUser = " . $db->quote($filters->idSearch, false);
            $andV = " and ";
        }
        if($filters->nameSearch!= "") {
            $whereCl .= $andV . " u.name like " . $db->quote('%' . $filters->nameSearch . '%', false);
             $andV = " and ";
        }
        if($filters->idIndustry != "0" && $filters->idIndustry != "" ){
            $whereCl .= $andV . " i.idIndustry =" . $filters->idIndustry;
            $andV = " and ";
        }
        if($filters->profession != "" ){
            $whereCl .= $andV . " ifNull(et.profession, etd.profession) like " . $db->quote( '%' . $profession . '%', false );
            $andV = " and ";
        }
        if($filters->website != "" ){
            $whereCl .= $andV . " eb.website like " . $db->quote('%' . $website . '%', false);
            $andV = " and ";
        }
        if($filters->email != "" ){
            $whereCl .= $andV . " u.email like " .  $db->quote('%' . $email . '%', false) ;
            $andV = " and ";
        }
        if($filters->city != "" ){
            $whereCl .= $andV . " ifNull(et.city, etd.city) like " . $db->quote('%' . $city . '%', false) ;
            $andV = " and ";
        }
        if($filters->idCountry != "0"  && $filters->idCountry != "" ){
            $whereCl .= $andV . " cr.idCountry =" . $filters->idCountry;
            $andV = " and ";
        }
        if($filters->address!= "" ){
            $whereCl .= $andV . " ifNull(et.address, etd.address) like " . $db->quote('%' . $address . '%', false) ;
            $andV = " and ";
        }
        if($filters->postalCode != "" ){
            $whereCl .= $andV . " eb.postalCode like " . $db->quote('%' . $postalCode . '%', false);
            $andV = " and ";
        }
        if($filters->taxOffice != "" ){
            $whereCl .= $andV . " ifNull(et.taxOffice, etd.taxOffice) like " . $db->quote('%' . $taxOffice . '%', false) ;
            $andV = " and ";
        }
        if($filters->taxNumber != "" ){
            $whereCl .= $andV . " eb.taxNumber like " . $db->quote('%' . $taxNumber . '%', false) ;
            $andV = " and ";
        }
        if($filters->phone != "" ){
            $whereCl .= $andV . " (eb.phone like " . $db->quote('%' . $phone . '%', false) . " or
                                    eb.mobile like " . $db->quote('%' . $phone . '%', false) . " or
                                    eb.fax like " . $db->quote('%' . $phone . '%', false) . " ) ";
            $andV = " and ";
        }  
        if($filters->datemodified != "" ){
            $whereCl .= $andV . " lu.datemodified > '" . $db->quote($filters->datemodified) ;
            $andV = " and ";
        }
        if($whereCl != '') {
           $query->where($whereCl);
        }
       // echo $query->dump();
        $db->setQuery($query, $filters->limitstart, $filters->limit);
        $state->set('data', $db->loadObjectList());
        $query->clear('order');
        $query->clear('select');
        $query->select('count(distinct u.id)');
        $db->setQuery($query);
       // 
        $totalRecords =  $db->loadResult();
        $pagination = CommonUtils::getPagination($totalRecords, $filters->limitstart, $filters->limit);
        $state->set('pagination', $pagination);
        return $state;
    }
    
}
?>