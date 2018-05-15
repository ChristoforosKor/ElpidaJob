<?php
/**
 * @copyright (c) 2013, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
 defined( '_JEXEC' ) or die( 'Restricted access' );


 /**
  * Class f that holds static functions used by e-logism's components.
  * @package e-logism.joomla;
  * @author Christoforos J. Korifidis
  * 
  */


class NullsFactory {
   
  
    
    public static function getNullCandidateBasic()
    {
        $o = new stdClass();
        $o->id = null;
        $o->idUser = null;
        $o->country = '';
        $o->city = '';
        $o->address= '';
        $o->postalCode = '';
        $o->phone = '';
        $o->mobile = '';
        $o->fax= '';
        $o->candidateState = '';
        return $o;
    }
         
    public static function getNullCandidateCharacteristics() 
    {
        $o = new stdClass();
        $o->id = null;
        $o->idUser = null;
        $o->gender = '';
        $o->dateOfBirth = '';
        $o->nationality = '';
        $o->militaryStatus = '';
        $o->maritalStatus = '';
        $o->childrenNum = '';
        $o->religion = '';
        $o->paper = '';
        $o->smoking = '';
        $o->rank = '';
        $o->aboutMe = '';
         $o->driverLicence = '';
        return $o;
    }
    
    public static function getNullCandidatePreferences()
    {
        $o = new stdClass();
        $o->id = null;
        $o->idUser = null;
        $o->comments = null;
        return $o;
    }
    
    public static function getNullEmployer()
    {
        $o = new stdClass();
        $o->id = null;
        $o->idUser = null;
        $o->country = '';
        $o->city = '';
        $o->address = '';
        $o->postalCode = '';
        $o->phone = '';
        $o->mobile = '';
        $o->fax = '';
        $o->taxNumber = '';
        $o->taxOffice = '';
        $o->industry = '';
        $o->profession = '';
        $o->website = '';
        $o->information = '';
        $o->email = '';
        $o->discreteTitle = '';
        $o->name = '';
        return $o;
    }
}
      



?>
