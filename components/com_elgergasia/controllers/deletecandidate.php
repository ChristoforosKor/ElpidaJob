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


class ElgergasiaControllerDeleteCandidate extends JControllerBase{
    
    public function execute() 
    {
        $app = JFactory::getApplication();
        $input = $this->getInput();
        try {
            $id = $input->getInt('id');
            $db = JFactory::getDbo();
            $db->setQuery("delete from #__users where id = $id")->execute();
            $db->setQuery("delete from #__user_usergroup_map where user_id = $id")->exeute();
            $app->enqueueMessage(JText::_('COM_ELGERGASIA_VIEW_DELETE_SUCCESS'));
        }
        catch(Exception $e)
        {
            $app->enqueueMessage($e->getMessage());
        }
        $app->redirect(JRoute::_('index.php?option=com_elgergasia&Itemid=196' , false));
    }
    
}
