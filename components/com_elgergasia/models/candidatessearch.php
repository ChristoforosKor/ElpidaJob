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
 require JPATH_COMPONENT_SITE . '/models/candidates.php';
 
 class ElgergasiaModelCandidatesSearch extends ElgergasiaModelCandidates 
 { 
    
    // function getState() {
		// $form = JForm::getInstance('candidatessearch', JPATH_COMPONENT . '/models/forms/candidatessearch.xml');
		// $state = parent::getState();
		// $form->bind($state->toArray());
        // $state->set('form', $form);
		// return $state;
    // }    
}