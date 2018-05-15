<script type="text/javascript">
	location.href = 'https://www.facebook.com/dialog/oauth?client_id=1419126221692492&redirect_uri=https://elpidajob.gr/components/com_elgergasia/facebook/facebook.php'
</script>

<?php
/**	
    $url = 'https://www.facebook.com/dialog/oauth?client_id=1419126221692492&redirect_uri=' . urlencode('https://elpidajob.gr/components/com_elgergasia/facebook/facebook.php');
	$postData='client_id=1419126221692492&redirect_uri=' . url_encode('https://elpidajob.gr/components/com_elgergasia/facebook/facebook.php');
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER=> 1,
        CURLOPT_CONNECTTIMEOUT=>120,
        CURLOPT_AUTOREFERER=>true,
        CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17',
        CURLOPT_URL=>$url
    ));
  
	$resp = curl_exec($curl);
   
    if($resp === false)
    {
        echo 'Error: "', curl_error($curl), '" - Code: ', curl_errno($curl), '<br />';
    }
    else
    {
        echo $resp;
    }
    //echo print_r(curl_getinfo($curl));
    curl_close($curl);
	
	
}  

**/
?>