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
    use Joomla\CMS\Factory;
    use Joomla\CMS\Language\LanguageHelper;

    $app = Factory::getApplication();
    $input = $app -> input;
    $user = Factory::getUser();
    $levels = $user->getAuthorisedViewLevels();
    $menu = $app->getMenu();
    $langs = LanguageHelper::getLanguages();
    
   
    $curLang = $input -> getString("lang", "el");
    
    $homes = array();
    
    foreach ($menu->getMenu() as $item)
    {
        if ($item->home)
        {
                $homes[$item->language] = $item;
        }
    }
   
    foreach ($langs as $i => $language) {
        if (!LanguageHelper::exists($language->lang_code))
        {
           unset($langs[$i]);
        }
        elseif (!isset($homes[$language->lang_code]))
        {
            unset($langs[$i]);
        }
        elseif (isset($language->access) && $language->access && !in_array($language->access, $levels))
        {
            unset($langs[$i]);
        }
        
    }
   
?>


<ul class="nav nav-tabs translateBar">
   <?php 
    
    foreach($langs as $value): 
        $liClass = ($value->sef == $curLang ? "active" : "");
        // $textClass = (in_array($value->lang_code, $this->translatedLanguages) ? "" : "text-warning" );
        $textClass = (in_array($value->lang_code, $this->translatedLanguages) ? "" : "" );
        ?>
    <li class="<?php echo $liClass;?>" id="trans_<?php echo $value->sef; ?>" > <a  class="<?php echo $textClass ?>" onclick="checkUnsubmitData('<?php echo  $value->sef ;?>', '<?php echo $value->lang_code  ?>')"  ><?php echo $value->title_native; ?> </a></li>
    <?php 
        endforeach;
        unset($value);
        $view = $input -> getCmd('view');
        $model =  $input-> getCmd('model', $view);
        $layout = $input -> getCmd("layout", 'default');        
   ?>
</ul>
<script type="text/javascript">
    var curLang = '<?php echo $curLang; ?>';
    var trasnlateableContainer = 'translateableContent';
    var idV= <?php echo $input -> getInt('jid', 0); ?>, idUserV = <?php echo $input -> getInt("idUser", 0) ?>, langV, langCodeV;
   
    function checkUnsubmitData(lang, langCode) {
        langV = lang;
        langCodeV =langCode;
        if(isUnsubmitedDataExists('')) {
            var langNative = jQuery('.translateBar li.active').text();
            var modal = jQuery('#myModal');
            modal.find('#dirtyLanguage').text(langNative);
            modal.modal('show');
        }
        else {
            getLangDataTranslation();
        }
    }
    
    function getLangDataTranslation() {
        jQuery('.translateableContent .content').css('visibility', 'hidden');
        jQuery.ajax({
            url: '/?option=com_elgjobs&view=<?php echo $view; ?>&model=<?php echo $model; ?>&layout=<?php echo $layout . '_translation'; ?>&format=part&data[language]=' + langCodeV + '&data[idUser]=' + idUserV + '&data[id]=' +idV,
            success : showLangData
        });        
    }
    
    function showLangData(data) {
       jQuery('.translateBar .active').removeClass('active');
       jQuery('#trans_' + langV).addClass('active');
       var tbc = jQuery('.translateableContent');
       tbc.html(data);   
       tbc.children('.content').css('visibility', 'visible');
       tbc.parents('form').find('input[name=language]').val(langCodeV);
    }
    
    function isUnsubmitedDataExists(container) {
        var res = false;
        jQuery('.' + trasnlateableContainer).find('input[type=text], textarea').each(function(index, item){
            if(item.defaultValue != item.value) {
                res =  true;
                return;
            }
        });
        return res;

    }
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA'); ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"aria-label="Close"></button>
      </div>
      <div class="modal-body text-left">
          <p><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA_CLAUSE_1') . ' "<em id="dirtyLanguage"></em>".'; ?></p>
          <p><em><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA_CLAUSE_2') ?></em></p>
          <p><b><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA_CLAUSE_3'); ?></b></p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal" ><?php echo JText::_('JNO') ?></button> -->
        <button type="button" class="button button_filled bg_blue" style="min-width:120px" data-bs-dismiss="modal" ><?php echo JText::_('JNO') ?></button>
        <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal" onclick="getLangDataTranslation()"><?php echo JText::_('JYES') ?></button> -->
        <button type="button" class="btn button" data-bs-dismiss="modal" onclick="getLangDataTranslation()"><?php echo JText::_('JYES') ?></button>
       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->