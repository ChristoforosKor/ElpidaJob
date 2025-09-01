<?php


namespace  ELG\Component\ElgJobs\Site\Model\Helpers;
use Joomla\CMS\MVC\Model\StatefulModelInterface;
/**
 * Description of ModelHelper
 *
 * @author christoforos
 */
class ModelHelper {
    public function populateStateByArray(array $data, StatefulModelInterface $model ) {
        foreach($data as $key => $item) {
            $model ->setState($key, $item);
        }
    }
}
