<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/views/elgview.php';
 class  ElgergasiaViewJob extends ElgergasiaViewElgView{
      
  
    public function render() {
        $state = $this->model->getState();
        $this->itemData = $state->get('itemData');
		$doc = JFactory::getDocument();
		$doc->setTitle($this->itemData->jobTitle . ' - ' . JText::_('COM_ELGERGASIA_SITE_TITLE'));
            $doc->setDescription($this->itemData->jobTitle . ' ' . JText::_('COM_ELGERGASIA_JOBS_TITLE_META_DESCRITPION_2_PART'));
		$this->state = $state;
       
      
        
        if(!$this->isUserPrivileged)
        {
                $this->setLayout('jobunprivileged');           
        }
        else
        {
                $this->setLayout('job');
        }                		
        $this->photos = $this->state->get('photos');
        if ( count( $this->photos ) > 0 ):
            $doc->setMetaData('og:image', 'media/com_elgergasia/jobphotos/' . $this->photos[0] ->jobPhoto . '_large.' . $this->photos[0]->photoExtension );
        endif;
        $doc->setMetaData( 'og:title', $this->itemData->jobTitle );
        $doc->setMetaData( 'og:description', $this->itemData->jobTitle . ' ' . JText::_('COM_ELGERGASIA_JOBS_TITLE_META_DESCRITPION_2_PART') );
        return parent::render();
    }    
 }
