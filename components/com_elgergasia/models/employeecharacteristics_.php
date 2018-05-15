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
 jimport( 'joomla.application.component.model' );
 class ElgergasiaModelEmployeeCharacteristics extends JModelBase{ 
    
    private $idUser = 0;
    private $id = 0;
//    private $table = null;
    
    public function __construct() {
        $this->id = JFactory::getApplication()->input->get('id', 0 , 'INT');
        $this->idUser = JFactory::getApplication()->input->get('iduser', 0 , 'INT');
//        JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
//        $this->table = JTable::getInstance('employeescharacteristics','Table');
        
        
        parent::__construct();
    }
     
    function getState() {
       $state = new JRegistry();
       if($this->id > 0 ) {
            $table = JTable::getInstance('candidatecharacteristic');
            $table->load($this->id);
            
            $tableTranslation = JTable::getInstance('candidatecharacteristictranslation');
            $language = JFactory::getLanguage()->getTag();
            $tableTranslation->load(array('idCandidateCharacteristic' =>$this->id, 'language'=>$language));
            $state->set('candidatecharacteristic', $table);
            $state->set('candidatecharacteristictranslation', $tableTranslation);
            $state->set('translatedLanguages', Translations::getTranslatedLanguages("#__elg_ergasia_candidate_characteristic_translation", $this->id, 'idCandidateCharacteristic'));
            
            return $state;
         }
    }
   
    function setState(JRegistry $data) {
       $this->table->bind($data->toArray());
       return $this->table->store();
    }

}
?>