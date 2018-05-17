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
    if ( in_array( 12, JFactory::getUser() -> getAuthorisedGroups() ) ):
        $fullname = $this->candidate->name;
    else:
        $cut = strpos( $this->candidate->name, " ");
        if($cut === false) :
            $cut = strlen( $this->candidate->name );
        endif;
        if ( $cut < strlen( $this->candidate->name ) + 2) :
            $fullname =  substr($this->candidate->name,  0, $cut  + 2);
        else:
            $fullanme =  substr($this->candidate->name,  0, $cut );
        endif;
    endif;
    
?>
<h2><?php echo JText::_('COM_ELGERGASIA_PERSONNEL'). ': (' . $this->candidate->id . ') ' . $fullname  ?>   </h2>