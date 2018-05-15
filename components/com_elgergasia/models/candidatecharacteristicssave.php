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
 include JPATH_COMPONENT_SITE . '/libraries/joomla/models/translations.php';
 class ElgergasiaModelCandidateCharacteristicsSave extends JModelBase{ 
     
    function setState(JRegistry $data) {
        $table = JTable::getInstance('candidatecharacteristic');
        $data2Store = $data->toArray();
        $table->bind($data2Store);
        $table->store();
        Translations::saveTranslation('candidatecharacteristictranslation', '#__elg_ergasia_candidate_characteristic_translation', $table->id, 'idCandidateCharacteristic', $data2Store);
    }

}