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
<div>
    <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&controller=candidatephotosdelete&id=' . $this->state->get('id') . '&idUser=' . $this->state->get('idUser') . '&Itemid=' . $this->state->get('Itemid') . '&lang=' . $this->state->get('lang') )?>" >
        <?php echo JHtml::_('form.token'); ?>
        <button class="btn btn-primary"><?php echo JText::_("JYES") ?></button>
    </form>
    <form method="post"  action="<?php echo JRoute::_('index.php?option=com_elgergasia&view=candidate&id=' . $this->state->get('idUser') . '&Itemid=' . $this->state->get('Itemid') . '&lang=' . $this->state->get('lang') ) ?>" >
        <button class="btn"><?php echo JText::_('JNO') ?></button>
    </form>
</div>