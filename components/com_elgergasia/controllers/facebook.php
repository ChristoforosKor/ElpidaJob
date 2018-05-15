<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );


class ElgergasiaControllerFacebook extends JControllerBase{
   	
	public function execute() 
	{            
		$code = $this->input->getString('code', '');
		if($code !== '')
		{
			$url = 'https://graph.facebook.com/oauth/access_token?client_id=1419126221692492&redirect_uri=' . urlencode('https://elpidajob.gr/index.php?option=com_elgergasia&controller=facebook') . '&client_secret=3fe8a189d2f0c9dc20453e88b4f90386&code=' . $code;
			 $curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER=> 1,
			CURLOPT_CONNECTTIMEOUT=>120,
			CURLOPT_AUTOREFERER=>true,
       // CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17',
			CURLOPT_URL=>$url
			));
			curl_exec($curl);
			curl_close($curl);
			exit();
		}
		else 
		{
			$access_token = $this->input->getString('access_token', '');
			$expires = $this->input->getInt('expires', 0);
			if($access_token !== '' && $expires > 0)
			{
				$appTokenUrl = 'https://graph.facebook.com//oauth/access_token?client_id=1419126221692492&client_secret=3fe8a189d2f0c9dc20453e88b4f90386&grant_type=client_credentials';
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_RETURNTRANSFER=> 1,
					CURLOPT_CONNECTTIMEOUT=>120,
					CURLOPT_AUTOREFERER=>true,
					CURLOPT_URL=>$appTokenUrl
				));
				echo curl_exec($curl);
				curl_close($curl);
				exit();
				// curl_setopt_array($curl, array(
					// CURLOPT_RETURNTRANSFER=> 1,
					// CURLOPT_CONNECTTIMEOUT=>120,
					// CURLOPT_AUTOREFERER=>true,
					// CURLOPT_URL=>'graph.facebook.com/debug_token?input_token=' . $access_token . 
     // &access_token={app-token-or-admin-token}
				// ));
				
			}
		}
		//echo $code;
		//$access_token = $this->input->getSting('access_token');
		//$expires = $this->input->getInt('expires');
		//echo $access_token, ' - ', $expires; 
	}
    
    
}
?>
