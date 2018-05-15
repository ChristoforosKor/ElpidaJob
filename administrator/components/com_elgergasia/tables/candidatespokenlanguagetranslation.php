<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

/**
 * JTable class for employee's experience data
 *
 * @author e-logism
 */

class JTableCandidateSpokenLanguageTranslation extends JTable {
    var $idSpokenLanguage = null;
    var $spokenLanguage = null;
    var $language = null;
    var $isDefault = null;
    var $isAutoTranslated = null;
       
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidate_spokenlanguage_translation', array('idSpokenLanguage', 'language'), $db );
    } 
}

?>
