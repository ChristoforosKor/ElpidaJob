<?php
namespace  ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;


class PersonnelModel extends ItemModel {

    public function getItem($pk = null) {
        $db = $this -> getDbo();
        $input = Factory::getApplication() -> input;
        $id = $input -> get("id", 0);
        $langTag = Factory::getLanguage()->getTag();
        $quotedLangTag =  $db -> quote($langTag);
//        echo "edw0";exit;
        $query = $db->getQuery(true);
        $query  ->  select("cd.id,  cd.name, cd.sortname1 as lastname, cd.sortname2, cd.misc, cd.address, cd.suburb, cd.state, cd.country, cd.image, GROUP_CONCAt( cst.speciality) as speciality, GROUP_CONCAT( ht.hour ) as hour"
                . ", GROUP_CONCAT(snt.specialNeed) as specialNeed, cd.published as idState"
                . ", group_concat(ifNull(cs.idSpeciality,'')) as idSpeciality, group_concat(ifNull(ch.idHour,'')) as idHour, group_concat(ifNull(sn.idSpecialNeed,'')) as idSpecialNeed "
                . ", cd.published, cb.idGender, cd.postcode, cd.telephone, cd.email_to, cd.mobile, cd.fax"
                . ", cb.idNationality, cb.dateOfBirth, st_x(cb.pt) as lng, st_y(cb.pt) as lat, ifNull(cb.suggestUp,0) as likes"
                . ", cb.lastOfficeVisit, cb.idInsurance, cb.idRecommentation, ins.insurance "
                . ", group_concat( distinct ep.paperFile) as documents, group_concat(ifNull(ep.id,'')) as idDocuments"
                . ", GROUP_CONCAT(xeect.idContactTeam) as team, GROUP_CONCAT(cd.name) as teamnames ")
                // . ", group_concat(ifNull(ep.paperFile,'')) as documents, group_concat(ifNull(ep.id,'')) as idDocuments")
                -> from ("#__contact_details cd")  
                -> innerJoin (" #__elg_ergasia_candidate_basic cb on cd.id = cb.idContact")
                -> leftJoin("#__elg_ergasia_candidate_basic_translation cbt on cb.id = cbt.idCandidateBasic and cbt.language=" . $quotedLangTag)
                -> leftJoin ("#__elg_ergasia_candidate_preferencesspecialities cs on cd.id = cs.idContact")
                -> leftJoin ("#__elg_ergasia_speciality_translation cst on cst.idSpeciality = cs.idSpeciality and cst.language = " . $quotedLangTag )
                -> leftJoin ("#__elg_ergasia_candidates_hours ch on ch.idContact = cd.id") 
                -> leftJoin ("#__elg_ergasia_hour_translation ht on ht.idHour = ch.idHour and ht.language =  " . $quotedLangTag )
                -> leftJoin("#__elg_ergasia_candidate_specialneeds sn on cd.id = sn.idContact")
                -> leftJoin("#__elg_ergasia_specialneeds_translation snt on sn.idSpecialNeed = snt.idSpecialNeed")
                -> leftJoin ("#__elg_ergasia_employer_paper  ep on ep.idContact = cd.id " )
                ->leftJoin ('#__elg_ergasia_candidate_team xeect on xeect.idContact = cd.id ')
                ->leftJoin('#__elg_insurance ins on ins.id = cb.idInsurance')
//                -> leftJoin ('#__contact_details xcd on xcd.user_id  = xeect.idUser')
//                -> leftJoin ("#__elg_ergasia_candidate_education ce on ce.idContact = cd.id") 
//                -> leftJoin ("#__elg_ergasia_candidate_education_translation cet on cet.idCandidateEducation = ce.id and cet.language =  " . $quotedLangTag )
//                -> leftJoin ("#__elg_ergasia_candidate_characteristic cc on cc.idUser = cd.id")
//                -> leftJoin ("#__elg_ergasia_candidate_characteristic_translation cct on cct.idCandidateCharacteristic = cc.id and cct.language =  " . $quotedLangTag )
                -> where ($this->getWhere($id))
                -> group("cd.id, cd.name, cd.misc, cd.address, cd.suburb, cd.state, cd.country,cd.image, cd.published, cb.idGender, cd.postcode, cd.telephone"
                        . ", cd.email_to, cd.mobile, cd.fax, cb.idNationality, cb.dateOfBirth, cd.email_to, cb.suggestUp, xeect.idContactTeam, cd.name, cb.lastOfficeVisit, cb.idInsurance, cb.idRecommentation");
//         echo $query -> dump();
        $item = $db -> setQuery($query) -> loadAssoc();
        if ( $item == null ) {
            return $this -> getNullObject();
        }
        return $item ;
    }
    
    private function getWhere($id) {
        $user = Factory::getApplication()->getIdentity();
        $whereClauses = [];
        if ($user != null && !in_array(12, $user->getAuthorisedGroups())) {
            $whereClauses = ['cd.published = 1 '];
        } 
        $whereClauses[] = " cd.id = " .$id;
        
        return implode(" and ", $whereClauses);
    }
    
    
    private function getNullObject() {
       
        $item = [];
        $item['id'] = 0;
        $item['misc'] = '';
        $item['address'] = '';
        $item['suburb'] = '';
        $item['state'] = '';
        $item['country'] = '';
        $item['image'] = '';
        $item['speciality'] = '';
        $item['hour'] = '';
        $item['specialNeed'] = '';
        $item['idSpeciality'] = ''; 
        $item['idHour'] = '';
        $item['idSpecialNeed'] = '';
        $item['published'] = 1;
        $item['idGender'] = 1;
        $item['postcode'] = '';
        $item['telephone'] = '';
        $item['email_to'] = '';
        $item['mobile'] = '';
        $item['fax'] = '';
        $item['idNationality'] = 0;
        $item['dateOfBirth'] = '';
        $item['lng'] = 0;
        $item['lat'] = 0;
        $item['comments'] = [];
        $item['specialities'] = [];
        $item['specialNeeds'] = [];
        $item['candidateHours'] = [];
        $item['documents'] = '';
        return $item;
    }

   
    
    
    public function getForm($data = [], $loadData = true): Form {

        $form = Form::getInstance('personnel', JPATH_COMPONENT_ADMINISTRATOR . '/forms/personnel.xml');
        
        if ( $loadData ) {
            $form -> bind($data);
        }
        // if ( $form->getValue('idJobState') == ''):
        //     $form->setValue('idJobState', null, 2);
        // endif;
        $form->setValue("idUser", null, Factory::getUser() -> id);
        return $form;
    }
    
    
    public function getComments($idContact) {
        $query = $this ->getDbo() -> getQuery(true);
        $query -> select ("distinct c.FieldValue as comment, co.FieldValue as commentor, fs.DateSubmitted")
                -> from ('#__rsform_submissions fs')
                -> innerJoin ('#__rsform_submission_values f on fs.SubmissionId = f.SubmissionId')
                -> innerJoin ("#__rsform_submission_values s on f.SubmissionId = s.SubmissionId and s.FieldName='state' and s.FieldValue = 1 and f.FormId = 3")
                -> innerJoin ("#__rsform_submission_values ic on f.SubmissionId = ic.SubmissionId and ic.FieldName='idContact' and ic.FieldValue = " . $idContact )
                -> innerJoin ("#__rsform_submission_values c on f.SubmissionId = c.SubmissionId and c.FieldName = 'comment' ")
                -> innerJoin ("#__rsform_submission_values co on f.SubmissionId = co.SubmissionId and co.FieldName ='commentor'");
//        echo $query -> dump();
        return $this ->getDbo() -> setQuery($query) -> loadObjectList();
    }
    
    public function deleteFile($data) {
         
        $db = $this->getDbo();
        $query = $db -> getQuery(true);
        $query ->select ('paperFile') ->from('#__elg_ergasia_employer_paper')->where('id =' . $data->id);
        $db->setQuery($query);
        $fileInDB = $db->loadResult();  
        $dbExists  = $fileInDB === null ? false: true; // in case the record is deleted from the db but the file still exists.
        if ($fileInDB !== $data->file && $dbExists) {
            throw new \Exception('Wrong data submitted');
        }
        $query->clear();
        $query->delete("#__elg_ergasia_employer_paper")->where('id=' . $data->id);
        $db->setQuery($query);
        $db->execute();
        $filePaths = explode('/images/', $fileInDB);
        $file = JPATH_SITE . '/images/' . $filePaths[1];
        $fileExists = file_exists($file);
        if ($fileExists)
        {
            unlink($file);
        }
        if (!$dbExists && !$fileExists) 
        {
            throw new \Exception('File not found');
        }
        
    }
}