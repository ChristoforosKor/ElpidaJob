<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/views/elgviewform.php';
 //require_once JPATH_COMPONENT_SITE .'/libraries/tbs/tbs_class.php';
 class  ElgergasiaViewCandidates extends ElgergasiaViewElgViewForm{
      
    public function render() {
       
       // $this->state = $this->model->getState();
        $searches = array(
            'houshold'=>array(
                JText::_('COM_ELGERGASIA_URL_JOB_1')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_1_LINK'),
                JText::_('COM_ELGERGASIA_URL_JOB_2')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_2_LINK'),
                JText::_('COM_ELGERGASIA_URL_JOB_3')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_3_LINK'),
				''=>''
             //   JText::_('COM_ELGERGASIA_URL_JOB_4')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_4_LINK')
            ),
            'tourism'=>array(
                JText::_('COM_ELGERGASIA_URL_JOB_5')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_5_LINK'),
                JText::_('COM_ELGERGASIA_URL_JOB_6')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_6_LINK'),
                JText::_('COM_ELGERGASIA_URL_CANDIDATE_7')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_7_LINK'),
                JText::_('COM_ELGERGASIA_URL_JOB_8')=>JText::_('COM_ELGERGASIA_URL_CANDIDATE_8_LINK')
            )
        );
        
        
        $this->data = $this->state->get('data');
        $filters = $this->state->get('filters');
        $this->filter_order = $filters->filter_order;
        $this->filter_order_Dir = $filters->filter_order_Dir;
        $this->canSeeContactInfo = Utils::canSeeContactInfo();
        $doc = JFactory::getDocument();
	$title = '' ; //$doc->getTitle();
        $par1 = '';
        $desc = '';
        $this->filters = $filters;
        if($this->isUserPrivileged)
        {
            if(stripos($this->getLayout() , 'search' ) > 0)
            {
                $this->setLayout('candidatessearch');
            }
            else
            {
                $this->setLayout('candidates');
            }         
        }
        else
        {
            $this->setLayout('candidatesunpriviliged');
        }
        // else
        // {
            // $this->setLayout('candidates');
          
        // }
		
        $specSearch = $this->state->get('specialitySearch');
        $slug = '';
        if($specSearch->speciality != '')
        {
                $title =   $specSearch->speciality;
                $par1 = str_replace('#1', '<strong>' . $specSearch->speciality . '</strong>', JText::_('COM_ELGERGASIA_YOU_SEARCHED'));
                $desc = JText::_('COM_ELGERGASIA_FOR'). ' '  . $specSearch->speciality ;
                $slug = $specSearch->slug;
        }

       
        if($this->state->get('sectionSearch') != '')
        {
                $title = $title . ' ' . JText::_('COM_ELGERGASIA_AT') .  ' <strong>' . $this->state->get('sectionSearch') . '</strong>';
                $par1 .= JText::_('COM_ELGERGASIA_ΑΤ_PLACE') . ' ' . $this->state->get('sectionSearch');
                $desc .= JText::_('COM_ELGERGASIA_AT') . ' ' . $this->state->get('sectionSearch');
                
        }
        
        if($title !== '')
        {
            $title .= '. ';
        }
        
        $doc->setTitle($title . $doc->getTitle() );
        if($desc !== '')
        {
            $doc->setDescription(str_replace('#1', $desc, JText::_('COM_ELGERGASIA_CANDIDATES_META_DESCRIPTION')));
        }
        $this->par1 = $par1;
        $par2 = str_replace('#1', '<strong>' . $specSearch->industry . '</strong>', JText::_('COM_ELGERGASIA_POPULAR_SEARCHES'));
        if($specSearch->idIndustry == 12)
        {
            $sV = $searches['tourism'];
            $this -> par3 = "Το γραφείο εργασίας \"Ελπίδα\" εγγυάται ότι οι εργαζόμενοι που προτείνει είναι οι κατάλληλοι και από τους ικανότερους στην αγορά εργασίας.<br />
Για καμαριέρες, καθαρίστριες, ρεσεψιονίστ, ,barista  και γενικά  όλες τις ειδικότητες μιας ξενοδοχειακής μονάδας, το προσωπικό που θα προτείνουμε είναι έμπειρο με συστατικές και πιστοποιήσεις.<br />
Αλλά και για τους χώρους εστίασης. Θέλετε μάγειρα, ψήστη, σερβιτόρο; Συνεργαζόμαστε με προσωπικό καταρτισμένο και με τα απαραίτητα πτυχία.<br />
Γνωρίζουμε το προσωπικό της τουριστική αγοράς εργασίας καλύτερα.<br />
Περιηγηθείτε στο site μας και επικοινωνήστε μαζί μας. Ξέρουμε να καλύψουμε τις επαγγελματικές σας ανάγκες.";
        }
        else
        {
            $sV = $searches['houshold'];
            $this -> par3 = "Το γραφείο εργασίας \"Ελπίδα\" εγγυάται ότι οι εργαζόμενοι που προτείνει είναι οι κατάλληλοι και από τους ικανότερους στην αγορά εργασίας.<br />
Για καθαρίστριες και γενικά  όλες τις ειδικότητες μιας οικιακής βοηθού είτε εσωτερική είτε εξωτερική, το προσωπικό που θα σας επιλέξουμε είναι έμπειρο στου δουλειά του με συστατικές επιστολές και αποδείξεις.<br />
Θέλετε γηροκόμο για τον παππού ή την γιαγιά; Υποστήριξη ατόμων ΑΜΕΑ ή ατόμων που χρειάζονται ιατρική βοήθεια και πρέπει να παίρνουν τα φάρμακά τους ή ακολουθούν συγκεκριμένη ιατρική αγωγή; Συνεργαζόμαστε με προσωπικό καταρτισμένο και με απαραίτητες πιστοποιήσεις γνώσεων.<br />
Ξέρουμε την αγορά εργασίας οικιακού προσωπικού καλύτερα και φροντίδας ηλικιωμένων. Μια επίσκεψη από το γραφείο ή μια περιήγηση στον ιστότοπό μας θα σας πείσει.";
        }
        //$cnt = 0;
        $keys = array_keys($sV);
        for($i=0; $i<4; $i++)
        {
            $par2 = str_replace('#' . ($i + 2), '<a href="' . $sV[$keys[$i]] . '" ><strong>' . $keys[$i] . '</strong></a>', $par2);
        }
        $this->par2 = $par2;
        JHtml::_('behavior.framework');
        if($slug !== '')
        {
           $doc->addHeadLink( 'http://elpidajob.gr' . JRoute::_('index.php?Itemid=' . $this->state->get('Itemid') . '&idSpeciality=' . $filters->idSpecialization . '&slug=' . $slug, false), 'canonical', 'rel'); 
        }
        else
        {
            $doc->addHeadLink( 'http://elpidajob.gr' . JRoute::_('index.php?Itemid=' . $this->state->get('Itemid'), false), 'canonical', 'rel'); 
        }
         JHTML::stylesheet('media/com_elgergasia/css/site.stylesheet.css'); 
        return parent::render();
    }   
    protected function setFormController() {}
}