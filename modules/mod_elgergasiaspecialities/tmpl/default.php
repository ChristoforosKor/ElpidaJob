<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_SITE . '/components/com_elgergasia/router.php';
?>
<p>abc
<?php foreach($data as $item) : ?>
    <a href="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $Itemid . '&idSpeciality=' . $item[0] . '&slug=' . $item[2], false);?>" ><?php echo $item[1], ' (', $item[3], ')'; ?></a><br />
<?php endforeach;
unset($item); ?>
</p>
