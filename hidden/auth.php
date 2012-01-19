<?

    require_once('google-api-php-client-read-only/src/apiClient.php');
    require_once('google-api-php-client-read-only/src/contrib/apiCalendarService.php');

    $apiClient = new apiClient();
    $apiClient->setUseObjects(true);
    $service = new apiCalendarService($apiClient);

    if (isset($_SESSION['oauth_access_token']))
    {
	$apiClient->setAccessToken($_SESSION['oauth_access_token']);
    }
    else
    {
	$token = $apiClient->authenticate();
	$_SESSION['oauth_access_token'] = $token;
    }

?>
