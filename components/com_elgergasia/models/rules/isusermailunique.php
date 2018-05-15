<?php


defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.form.formrule');

class JFormRuleIsUserMailUnique extends JFormRule {
        
    public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null) {
        $idUser = $input->get('idUser',0);
        if ($idUser > 0 ) {
            $user = JFactory::getUser($idUser);
            $oldEmail  = $user->email;
        }
        else {
            $oldEmail = '';
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('email from #__users')
                ->where('trim(email) = ' . $db->q(trim($value)) . ' and trim(email) != ' . $db->q($oldEmail));
        $db->setQuery($query);
        $res = $db->loadObject();
        if(isset($res)) {
           return false;
        }
        else {
            return true;
        }
    }

}
