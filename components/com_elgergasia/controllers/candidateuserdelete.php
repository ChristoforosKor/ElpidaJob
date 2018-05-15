<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );


class ElgergasiaControllerCandidateUserDelete extends JControllerBase{
    
    public function execute() {
        
        require_once JPATH_COMPONENT . '/models/candidateuser.php';
        $model = new ElgergasiaModelCandidateUser();
        $input = $this->getInput();
        $res = $model->deleteRow();
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=employees&Itemid=' .  $input->get('Itemid', 0, 'INT') . '&lang=' . $this->lang , false);
        if($res) {
           $msg = Jtext::_('COM_ELGERGASIA_VIEW_DELETE_SUCCESS') ;
        }
        else {
            $msg = '';
        }
        JFactory::getApplication()->redirect($redUrl, $msg);
    }
    
}
?>
