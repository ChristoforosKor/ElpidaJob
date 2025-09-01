<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
//use Joomla\CMS\Factory;
//$filters = $app -> input -> get('filter', [], 'array');
// 
//if ( isset($filters['specialNeeds'])) {
//    $selected = $filters['specialNeeds'];
//}
//else {
//    $selected = '';
//}

?>
<div class = "filters_list_block">
    <div class = "filters_list_block_title"><?php echo $module -> title; ?></div>
    <?php  foreach($data as $item):

        ?>
        <div class = "filters_list_block_checkboxes form-group">
            <input  type = "checkbox" id = "specialNeeds_<?php echo $item -> idSpecialNeed; ?>" name = "filter[specialNeeds][]" value="<?php echo $item -> idSpecialNeed; ?>">
            <label for = "specialNeeds_<?php echo $item -> idSpecialNeed; ?>"><?php echo $item -> specialneed; ?></label>
        </div>
    <?php    endforeach; unset($item); ?>
    
</div>

