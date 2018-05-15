<?php
/**
 * General utitlies .<br/>
 * @author e-logism
 * @copyright (c) e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 1.2.1 2012-02-24
 */
class Utils {

    /**
     * this function removes elements from an array
     * @param array $original the original array from which we are going to remove the rows.
     * @param array $excludeValues the array that contains the values we want to remove
     * @param boolean $reindex wether the new array will be reindexed. Default is true.
     * @return array without the excluded elements
     */

    public static function removeFromArray($original,$excludedValues,$reindex=true){
        if(is_array($original) && is_array($excludedValues)){
            $original = array_diff($original, $excludedValues);
            if($reindex) $original = array_values($original);
        }
        return $original;
    }

    /*
     * This function escapes text from special regular exrpessions symbols
     * @param String text the text to be escaped
     */
    public static function escapeRegChars($text){
        return str_replace(array("\\","[","]","(",")",".","{","}","+","*","?","|"),array("\\\\","\[","\]","\(","\)","\.","\{","\}","\+","\*","\?","\|"),$text);
    }

     /*
     * This function unescapes text from special regular exrpessions symbols
     * @param String text the text to be escaped
     */
    public static function unEscapeRegChars($text){
        return str_replace(array("\\\\","\[","\]","\(","\)","\.","\{","\}","\+","\*","\?","\|"),array("\\","[","]","(",")",".","{","}","+","*","?","|"),$text);
    }
}
?>