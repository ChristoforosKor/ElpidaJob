<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism jon agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

 
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/views/elgviewform.php';
 class  ElgergasiaViewJobsPosts extends ElgergasiaViewElgViewForm{
    
     public function __construct(JModel $model, SplPriorityQueue $paths = null){
        parent::__construct($model, $paths);
        $filters = $this->state->get('filters');
        $this->data = $this->state->get('data',array());
        $this->filter_order = $filters->filter_order;
        $this->filter_order_Dir = $filters->filter_order_Dir;
       
        if($this->isUserPrivileged) {
            $this->canSeeContactInfo = true; 
            $this->fieldsetClass = "c2";
            $this->formFile = 'jobsformelms.php';
        }
        else {
            $this->canSeeContactInfo = false; 
            $this->fieldsetClass = "c3";
            $this->formFile = 'jobsformelmsguest.php';
        }
		$this->introText =  
		str_replace('#6', '<a href="' . JText::_('COM_ELGERGASIA_URL_JOB_6_LINK') . '"><em>' . JText::_('COM_ELGERGASIA_URL_JOB_6') . '</em></a>',
		str_replace('#5', '<a href="' . JText::_('COM_ELGERGASIA_URL_JOB_5_LINK') . '"><em>' . JText::_('COM_ELGERGASIA_URL_JOB_5') . '</em></a>',
		str_replace('#4', '<a href="' . JText::_('COM_ELGERGASIA_URL_JOB_4_LINK') . '"><em>' . JText::_('COM_ELGERGASIA_URL_JOB_4') . '</em></a>', 
		str_replace('#3', '<a href="' . JText::_('COM_ELGERGASIA_URL_JOB_3_LINK') . '"><em>' . JText::_('COM_ELGERGASIA_URL_JOB_3') . '</em></a>', 
		str_replace('#2', '<a href="' . JText::_('COM_ELGERGASIA_URL_JOB_2_LINK') . '"><em>' . JText::_('COM_ELGERGASIA_URL_JOB_2') . '</em></a>',
		str_replace('#1','<a href="' . JText::_('COM_ELGERGASIA_URL_JOB_1_LINK') . '"><em>' . JText::_('COM_ELGERGASIA_URL_JOB_1') . '</em></a>', JText::_('COM_ELGERGASIA_INTRO_JOBS')))))));
		JHtml::_('behavior.framework');
		
		$doc = JFactory::getDocument();
		$title = $doc->getTitle();
		if($this->state->get('specialitySearch') != '')
		{
			$title = $this->state->get('specialitySearch') .'. ' . $title;
		}
		//$doc->setTitle(JText::_('COM_ELGERGASIA_SITE_TITLE') .' - ' . $title);
                $doc->setTitle(JText::_($title));
		$q = JURI::getInstance()->getQuery(true);
		$elgergasia_sefhelper = array('option', 'model', 'view', 'controller', 'Itemid', 'layout', 'filter_order', 'filter_order_Dir', 'format'); 
		//echo JRoute::_('index.php?Itemid=' . $this->state->get('Itemid')) . ' - ' . urldecode(JURI::getInstance()->getPath());
		$doc->setDescription( JText::_('COM_ELGERGASIA_SEARCH') . ' ' . $this->state->get('specialitySearch') . ' ' . JText::_('COM_ELGERGASIA_AT_JOBS_OF_AGENCY'));
                
                if(urldecode(JURI::getInstance()->getPath()) === JRoute::_('index.php?Itemid=' . $this->state->get('Itemid')))
		{
			foreach($q as $qk=>$qv)
			{
				if(!in_array($qk,$elgergasia_sefhelper))
				{
					$doc->addHeadLink( 'http://elpidajob.gr' . JRoute::_('index.php?Itemid=' . $this->state->get('Itemid'), false), 'canonical', 'rel');
					break;
				}
			}
			unset($qk);
			unset($qv);
		}
		else
		{
			$doc->addHeadLink( 'http://elpidajob.gr' . JRoute::_('index.php?Itemid=' . $this->state->get('Itemid'), false), 'canonical', 'rel');
		}
		$this->setLayout('jobs');
     }
     
    protected function setFormController() {
//        $this->formController = $this->state->get('view');
//        $this->formAction->setVar('controller', $this->formController);
        
         $this->formAction->setVar('option', 'com_elgergasia');
        $this->formAction->setVar('controller', 'jobs');
        $this->formAction->setVar('view', 'jobs');
        $this->formAction->setVar('model', 'jobs');
        $this->formAction->setVar('layout', 'jobs');
        $app	= JFactory::getApplication();
        $menu 	= $app->getMenu();
        $active = $menu->getActive();
        $lang = JFactory::getLanguage()->getTag();
        $associations= MenusHelper::getAssociations($active->id);
        if(isset($associations[$lang]))
        {
            $Itemid = $associations[$lang];
        }
        else 
        {
            $Itemid = $active->id;
        }
        $this->formAction->setVar('Itemid', $Itemid);
	
		
    }
 }
?>
