<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/views/elgview.php';
 class  ElgergasiaViewCandidate extends ElgergasiaViewElgView{
     
    public function render() {
        $this->candidate = CommonUtils::getUserTitleData($this->state->get('id',0));
        $this->basicData =  $this->state->get('basic');
        $this->characteristicData = $this->state->get('characteristics');
        $this->experienceData = $this->state->get('experience');
        $this->photosData = $this->state->get('photos');
        $this->specialitiesData= $this->state->get('specialities');
        $this->educationData = $this->state->get('education');
        $this->languageData = $this->state->get('languages');
        $this->hoursData = $this->state->get('hours');
        $this->relationData = $this->state->get('relations');
        $this->countiesPrefrencesData = $this->state->get('counties');
        $this->preferencesData = $this->state->get('preferences');
        $this->prefSpecialities = $this->state->get('specialityprefs');
		
        $this->medicalData = $this->state->get('medicalData', array());
        $this->legalData = $this->state->get('legalData', array());
        $this->paperData = $this->state->get('paperData', array());
		$this->prefTeam = $this->state->get('prefTeam', array());
        $this->state->set('idUser', $this->state->get('id'));
        $this->photoUrlPart = 'media/com_elgergasia/' .CommonUtils::getComponentParams()->get('candidatesPhotosFolder','candidatephotos');
        $d1 = $this->state->get('id', 0);
		
        if(!$this->isUserPrivileged  && $this->user->id != $this->state->get('id', 0))
        {
            $this->setLayout('candidateunprivileged');
        }
        else 
        {
            $this->setLayout('candidate');
        }
		
		$spec = $this->prefSpecialities;
		$specNo = count($this->prefSpecialities);
		$title = JText::_('COM_ELGERGASIA_PERSONNEL') . ' ' . $d1;
		$desc = JText::_('COM_ELGERGASIA_EMPLOYEE_META_DESCRIPTION');
		$cnt = 0;
		$descSpec = '';
                $fbTitle = '';
		foreach($spec as $item)
		{
			if($cnt < 2)
			{
                            $fbTitle .= ', ' . $item->speciality;
                            $title .= ' | ' . $item->speciality ;
                            $descSpec .=  $item->speciality . ' ';
			}
			$cnt ++;
		}
		unset($item);
		
		$title .=  ' | ' . JText::_('COM_ELGERGASIA_SITE_TITLE');
		$doc = JFactory::getDocument();
		$doc->setTitle($title);
                $doc->setDescription(str_replace('#', $descSpec, str_replace('##',  $this->candidate->name . ' ' . $this->candidate->id, $desc)));
                
                if ( count ($this->photosData) > 0 ):
                    $doc->setMetaData('og:image', JUri::base() . $this->photoUrlPart .  '/' . $this->photosData[0] ->photo . '_large.' . $this->photosData[0]->photoExtension );
                endif;
                $doc->setMetaData('og:title', $this->candidate->name . ' ' .  $fbTitle);
                $doc->setMetaData('og:description', $doc->getDescription() . '. ' . JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_NATIONALITY_LABEL') . ': ' .$this->characteristicData->nationality );
		return parent::render();
    }     
 }
