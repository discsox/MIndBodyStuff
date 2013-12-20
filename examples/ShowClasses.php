<?php
require '../vendor/autoload.php';
include ('../_includes/config.php');

$service = MindbodyAPI\MindbodyClient::service("ClassService");
$credentials = $service::credentials( // Put your source credentials here.
	$SourceName,
	$Key,
	array(
		$SiteID // API Sandbox -99
	)
);

$request = $service::request("GetClasses", $credentials);
$response = $service->GetClasses($request);
if(!isset($response->Status) || $response->Status != "Success")
	die("Oh foo. It didn't work.");
?>
<?php 
    echo $response->ResultCount;
//	echo $response->ClassDescriptions->ClassDescription [0] ->Description;
//	var_dump($response->ClassDescriptions->ClassDescription); 
?>
<html>
	<head>
		<title>List of Classes</title>
	</head>
	<body>
		<h1>Today's Classes</h1>
		<ul>
			<?php foreach($response->Classes->Class as $class): ?>
			<li>
				<p>
					<?php echo $class->ClassDescription->Name; ?> (<?php echo $class->Location->Name; ?>)
				</p>
				<p>
					<?php echo $class->ClassDescription->Description; ?>
				</p>
			</li>
			<?php endforeach; ?>
		</ul>
	</body>
</html>
