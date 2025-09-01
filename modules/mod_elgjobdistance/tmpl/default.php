<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<div class = "filters_list_block" id="filterDistance">
    <div class = "filters_list_block_title"><?php echo $module -> title; ?></div>
    <?php foreach($data as $item): 

        ?>
        <div class ="filters_list_block_checkboxes form-group">
            <input  type="radio" id="distanceFilter_<?php echo $item -> idDistance; ?>" value = "<?php echo $item -> idDistance; ?>" name = "filter[distanceFilter]">
            <label for="distanceFilter_<?php echo $item -> idDistance; ?>"><?php echo $item -> distance; ?></label>
        </div>
    <?php    endforeach; unset($item); ?>
    
</div>

