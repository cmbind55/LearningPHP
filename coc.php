<html>
	<head>
		<title>PHP Test</title>
	</head>
<body>
<?php echo '<p>Hello World</p>'; ?> 

<?php 
function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
?>
<!--
https://api.clashofclans.com/v1/clans?name=awesome%20yankees
curl -X GET --header "Accept: application/json" 
--header "authorization: Bearer <API token>" 
"https://api.clashofclans.com/v1/clans?name=awesome%20yankees"
-->

<?php
	$result = CallAPI("POST", "https://api.clashofclans.com/v1/clans", "name=awesome%20yankees");
	echo $result;
?>

</body>
</html>
