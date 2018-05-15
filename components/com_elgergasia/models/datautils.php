<?php
/**
 * @copyright (c) 2013, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
 defined( '_JEXEC' ) or die( 'Restricted access' );


 /**
  * Class f that holds static functions used by e-logism's components.
  * @package e-logism.joomla;
  * @author Christoforos J. Korifidis
  * 
  */


class DataUtils {
   
  
    
    public static function getNullFilter()
    {
        $o = new stdClass();
        $o->id = 0;
        $o->idUser = 0;
        $o->payment ='';
        $o->dateTo = '';
        $o->dateFrom ='';
        $o->isSubmited = 0;
        $o->limitstart= 1;
        $o->limit = 10000;
        $o->filter_order = 'id';
        $o->filter_order_Dir = 'asc';
        return $o;
    }
         
    public static function getFiltersData()
    {
        $inp = JFactory::getApplication()->input;
        $filters = DataUtils::getNullFilter();
        
        if($filters->isSubmited == 0)
        {
            $m1 = CommonUtils::getMonths1stDate();
            $mL = CommonUtils::getMonthsLasttDate();
            $filters->dateFrom = date('Y-m-d', $m1);
            $filters->dateTo = date('Y-m-d', $mL);  
            
        }
        else 
        {
            $filters->dateFrom = $inp->getString('implementationDateFrom','');
            $filters->dateTo = $inp->getString('implementationDateTo','');
            if($filters->dateTo != '') $filters->dateTo .= " 23:59:59";
            if($filters->dateFrom != '') $filters->dateFrom .= " 00:00:00";
        }
       
        $filters->id = trim($inp->getInt('id', ''));
        $filters->idUser = $inp->getInt('idUser', '');
        return $filters;
    }
    
    public static function getNullCandidateCharacteristic()
    {
        $o = new stdClass();
         $o->id = null;
        $o->idUser = null;
        $o->idGender = null;
        $o->dateOfBirth = null;
        $o->idNationality = null;
        $o->idMilitaryStatus = null;
        $o->idMaritalStatus = null;
        $o->childrenNum = 0;
        $o->idReligion = null;
        $o->idPapers = null;
        $o->smoking = false;
        $o->idPetFriend = null;
        $o->idDriverLicene = null;
        return $o;
    }
    
    
    public static function getNullCandidateCharacteristicTranslation()
    {
        $o = new stdClass();
        $o->idCandidateCharacteristic = null;
        $o->language = JFactory::getLanguage()->getTag();
        $o->aboutMe = '';
        $o->isDefault = 0;
        $o->isAutoTranslated = 0;
        return $o;
    }
    
    
    /**
     * 
     * Returns the Itemid for a specific language if given an arbitrary Itemid. If no translation found for the given Itemid it returns the orignal Itemid.
     * 
     * @param int $Itemid Original itemid 
     * @param String $language the language to search.
     */
    public static function getLanguageItemid($db,$Itemid, $language)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery();
        $query->clear();
        $query->select('id')
                ->from('#__menu')
                ->where('id in 
                (select id from #__associations where context=\'com_menus.item\' and ' . $db->quoteName('key') 
                . ' in (select ' . $db->quoteName('key') . ' from #__associations where id = ' . $Itemid . ') 
                ) and language = ' . $db->quote($language));
        $res = $db->loadResult();
        $query->clear();
        return ($res == null ? $Itemid : $res);
    }
}
