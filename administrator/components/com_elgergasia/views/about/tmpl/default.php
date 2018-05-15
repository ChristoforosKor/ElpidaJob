<?php defined('_JEXEC') or die('Restricted access');
/**
 * @author e-logism
 * @copyright (c) e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 1.2.1 2012-02-22
**/
?>

<div>
    <a href="http://<?php echo $this->authorUrl ?>" target="_blank" title="<?php echo JText::_("COM_ELGERGASIA_DEVELOPMENT_ALT_LINK") ?>" ><img src="<?php echo $this->logoImage ?>" alt="<?php echo JText::_("COM_ELGERGASIA_DEVELOPMENT_ALT_LINK") ?>" /></a><br/>
    <h3><a href="http://www.e-logism.gr" title="<?php echo JText::_("COM_ELGERGASIA_DEVELOPMENT_ALT_LINK") ?>" target="_blank"  >e-logism</a> <?php echo JText::_('COM_ELGERGASIA_EXTNAME');?></h3>
    <hr align="left" width="30%"><br/>
    <p>
        <?php echo JText::_("COM_ELGERGASIA_EXTENSION") ?>: <?php echo JText::_("COM_ELGERGASIA_EXTNAME"); ?><br />
    </p>
    <p>
        <?php echo JText::_("COM_ELGERGASIA_VERSION") ?>: <?php echo $this->version . " (" . $this->creationDate . ")" ?><br/>
        <?php echo $this->copyright ?><br/><br/>
    </p>
    <p>
        <?php echo JText::_("COM_ELGERGASIA_DESCRIPTION_LABEL") ?>: <?php echo $this->description ?><br/>
    </p>
    <p>
        <?php echo JText::_("COM_ELGERGASIA_DEVELOPMENT_BY") ?>: <a href="http://www.e-logism.gr" title="<?php echo JText::_("DEVELOPMENT_ALT_LINK") ?>"  target="_blank" style="font-weight:bold" ><?php echo $this->author ?></a><br/>
    </p>
    <p>
        <?php echo JText::_("COM_ELGERGASIA_EMAIL_ADDRESS") ?>: <a href="mailto:<?php echo $this->authorEmail ?>" ><?php echo $this->authorEmail ?></a><br/>
    </p>
</div>
