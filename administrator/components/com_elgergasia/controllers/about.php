<?php
/**
 * @author e-logism
 * @copyright (c) e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 1.2.1 2012-09-12
**/

defined('_JEXEC') or die('Restricted access');

class elgergasiaControllerAbout extends JController {

    function __construct($config = array()) {
        parent::__construct($config);
    }

    function display($cachable = false) {
        JRequest::setVar('view', 'about');
        parent::display($cachable);
    }

}
