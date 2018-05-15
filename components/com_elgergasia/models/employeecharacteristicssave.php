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
 //jimport( 'joomla.application.component.model' );
 include JPATH_COMPONENT_SITE . '/libraries/joomla/models/translations.php';
 class ElgergasiaModelEmployeeCharacteristicsSave extends JModelBase{ 
    
    private $idUser = 0;
    private $id = 0;
    private $table = null;
    
    public function __construct() {
        $this->id = JFactory::getApplication()->input->get('id', NULL , 'INT');
        $this->idUser = JFactory::getApplication()->input->get('iduser', 0 , 'INT');
        JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
        $this->table = JTable::getInstance('candidatecharacteristic');
        
        
        parent::__construct();
    }
     
//    function getState() {
//       if($this->id > 0 ) {
//            $this->table->load($this->id);
//            return $this->table;
//         }
//    }
   
    function setState(JRegistry $data) {
       // if($data->id == 0) $data->set('id', null);
        $data2Store = $data->toArray();
        $this->table->bind($data2Store);
        $this->table->store();
       
        Translations::saveTranslation('candidatecharacteristictranslation', '#__elg_ergasia_candidate_characteristic_translation', $this->table->id, 'idCandidateCharacteristic', $data2Store);
    }

}
?>