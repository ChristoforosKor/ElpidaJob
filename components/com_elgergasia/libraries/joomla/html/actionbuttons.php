<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism library.
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr 
----------------------------------**/
    defined('_JEXEC') or die('Restricted access');
?>
<?php if(array_key_exists($htmlIndex, $this->buttonsTexts)): ?>
    <button class="btn btn-primary no-print"  
            type="<?php echo $this->buttonsTypes[$htmlIndex] ?>" 
            onclick="<?php echo $this->buttonsActions[$htmlIndex]; ?>" >
            <?php echo $this->buttonsTexts[$htmlIndex] ; ?>
    </button>
<?php endif; ?>
<?php if(array_key_exists($htmlIndex, $this->linksUrls)): ?>
    <a class="btn pull-right no-print" href ="<?php echo $this->linksUrls[$htmlIndex] ?>" ><?php echo $this->linksTexts[$htmlIndex]; ?></a>
<?php endif; ?>
