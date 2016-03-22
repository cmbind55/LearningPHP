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
            if ($data){
                $url = sprintf("%s?%s", $url, http_build_query($data));
                echo ("default.  data:" . $data . " url:" . $url . "<br>");
            }
    }

    // Authentication:
    $authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImE2M2E2ODljLWI3ZGQtNDY1Yi04NzJiLTQ1OWYyOWIwOTY5NiIsImlhdCI6MTQ1ODQ0NTU0Mywic3ViIjoiZGV2ZWxvcGVyL2IyYjA0YTIwLTk1ODItMzVmMS0yYjRkLWRjZTMzM2JkMjJmMiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjEwNC4xMzEuMTY1LjE2MiJdLCJ0eXBlIjoiY2xpZW50In1dfQ.P0UhwAuGUJyi5L_-Xkbqb-vEFDcCJnp-wBZyPV2OWgZX9or5rXhXP1a0kQCfjvSdBzkXrPiL1LHB_SkAs326RA";
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, 
        array('Accept: application/json',
        $authorization ));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

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
	$result = CallAPI("GET", 
        "https://api.clashofclans.com/v1/clans",
        array('name' => 'awesome%20yankees', 'limit' => '18'));
	echo $result;
?>

</body>
</html>
