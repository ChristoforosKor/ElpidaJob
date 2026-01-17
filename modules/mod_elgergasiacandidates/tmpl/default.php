<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$db = JFactory::getDbo();
$query = $db->getQuery(true);
$db->setQuery($query);
// require_once JPATH_SITE . '/components/com_elgergasia/models/datautils.php';
require_once JPATH_SITE . '/components/com_elgergasia/router.php';
?>
<p><a href="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $Itemid . '&idSpeciality='. $idSpeciality . '&slug=' . $data->slug); ?>" ><span class="jobs-num"><?php echo $data->cnt; ?></span> <span class="job-title"><?php echo $data->speciality ?></span></a></p>
