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


class ElgergasiaControllerDeleteEmployer extends JControllerBase{
    
    public function execute() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $input = $this->getInput();
        $request = Helper::getBasicState($input);
        $state = new JRegistry($request);
        require_once JPATH_COMPONENT . '/models/deleteemployer.php';
        $model = new ElgergasiaModelDeleteEmployer();
        $model->setState($state);
        $errors = $state->get('errors');
        $app = JFactory::getApplication();
        if( $errors == null) {
            $app->enqueueMessage(JText::_('COM_ELGERGASIA_VIEW_DELETE_SUCCESS'));
        }
        else {
            Helper::queueErrors($errors);
        }
        $app->redirect(JRoute::_('index.php?option=com_elgergasia&view=employerssearch&Itemid=' .  $request['Itemid'] . '&lang=' . $request['lang'] , false));
    }
    
}
?>
