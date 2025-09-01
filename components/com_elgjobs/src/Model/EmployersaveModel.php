<?php

namespace ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die('Restricted access');

/* ------------------------------------------------------------------------
  # com_elgergasia - e-logism job agency application
  # ------------------------------------------------------------------------
  # author    e-logism
  # copyright Copyright (c) 2010-2050 e-logism.com. All Rights Reserved.
  # @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
  # Websites: http://www.e-logism.gr


  ----------------------------------* */

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\Component\Contact\Administrator\Table\ContactTable;

class EmployersaveModel extends AdminModel {

    private $isNew = true;

    public function save($values) {

            $table = $this->getTable();
            $table->bind($values);
            $res = $table->store();
            if (!$res) {
                $errors = $table->getErrors();

                throw new \Exception("Error on saving employer:\n" . implode("\n", $errors));
            }

        return true;
    }

    
    protected function saveEmployer($values, $table) {
        if ($values['id'] > 0) {
            $table->load($values['id']);
        } else {
            $table->default_con = 0;
            $table->ordering = 0;
            $table->params = '{"show_contact_category":"","show_contact_list":"","show_tags":"","show_info":"","show_name":"","show_position":"","show_email":"","add_mailto_link":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_image":"","show_misc":"","allow_vcard":"","show_articles":"","articles_display_num":"","show_profile":"","contact_layout":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","validate_session":"","custom_reply":"","redirect":""}';
        }
        $table->bind($values);
        $table->sortname1 = $values['lastname'];

        if ($values['accept_photo']) {
            $table->sortname2 = $values['accept_photo'];
        }

        $date = Factory::getDate()->toSql();

        $table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
        $table->alias = $table->generateAlias();

        if (empty($table->id)) {
            // Set the values
            $table->created = $date;
            // Set ordering to the last item if not set
            if (empty($table->ordering)) {
                $db = $this->getDbo();
                $query = $db->getQuery(true)
                        ->select('MAX(ordering)')
                        ->from($db->quoteName('#__contact_details'));
                $db->setQuery($query);
                $max = $db->loadResult();

                $table->ordering = $max + 1;
                $table->params = '{"show_contact_category":"","show_contact_list":"","show_tags":"","show_info":"","show_name":"","show_position":"","show_email":"","add_mailto_link":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_image":"","show_misc":"","allow_vcard":"","show_articles":"","articles_display_num":"","show_profile":"","contact_layout":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","validate_session":"","custom_reply":"","redirect":""}';
                $table->metadesc = '';
                $table->metadata = '';
                $table->featured = 0;
//                $table->published = 1;
                $table->catid = 45;
            } else {
                $this->isNew = false;
                $table->modified = $date;
                $table->modified_by = Factory::getUser()->id;
            }

            // Increment the content version number.
            $table->version++;
        }
        if (!$table->store()) {
            return $table->getErrors();
        }
        return $table->id;
    }

    public function setState_(JRegistry $state) {
        $toUpper = array(
            'suburb' => array('upper'),
            'address' => array('upper'),
            'postcode' => array('upper', 'nowhitespace'),
            'webpage' => array('lower', 'nowhitespace'),
            'email_to' => array('lower'),
            'telephone' => array('upper', 'nowhitespace'),
            'mobile' => array('upper', 'nowhitespace'),
            'fax' => array('upper', 'nowhitespace'),
            'sortname1' => array('upper', 'nowhitespace'), // taxnumber 
            'sortname2' => array('upper'), //taxoffice 
            'con_position' => array('upper'),
            'di' => array('upper'),
            'name' => array('upper')
        );
        $data = CommonUtils::normData($state->get('formData'), $toUpper);
        $validData = $this->form->validate($data);
        if ($validData === false) {
            $state->set('errors', $this->form->getErrors());
        } else {
            $user = JFactory::getUser($data->idUser);
            $user->email = $data->email;
            $user->name = $data->name;
            if (!$user->save(true)) {
                $state->set('errors', array(new UnexpectedValueException($user->getError(), 602)));
            } else {
                $this->table->bind($data);
                $this->table->store();
                $this->state->set('newId', $this->table->id);
                $data2Store = (array) $data;
                $input = JFactory::getApplication()->input;
                $language = $input->get->post->getString('language');
                $data2Store['language'] = $language;
                //$state->set('idUser', $this->table->idUser);
                Translations::saveTranslation('employertranslation', '#__elg_ergasia_employer_translation', $this->table->id, 'idEmployer', $data2Store);
            }
        }
        parent::setState($state);
    }

    public function getTable($name = 'Employer', $prefix = '', $options = []) {
        return parent::getTable($name, $prefix, $options);
    }

    public function getForm($data = [], $loadData = true) {

        $form = Form::getInstance('employer', JPATH_COMPONENT_ADMINISTRATOR . '/forms/employer.xml', ['control' => 'employerForm']);
        if ($loadData) {
            $form->bind($data);
        }
        return $form;
    }

    /*
      public function getContactTable($name = 'contact', $prefix = '', $options = []) {
      return new ContactTable( $this -> getDbo() );
      }
     */
}
