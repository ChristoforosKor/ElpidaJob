<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr 
----------------------------------**/
    defined('_JEXEC') or die('Restricted access');
?>
<form method="post" action="<?php echo JUri::base()?>/index.php?option=<?php echo $this->state->get('option') ?>&id=<?php echo $this->state->get('id')?>&idUser=<?php echo $this->state->get('idUser') ?>&Itemid=<?php echo $this->state->get('Itemid') ?>" >
        <button class="btn btn-danger">
           <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
       </button>
       <input type="hidden" name="view" value="employer" />
       <input type="hidden" name="layout" value="deleteconfirm" />
       
</form>

