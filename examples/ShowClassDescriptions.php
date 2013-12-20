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

$request = $service::request("GetClassDescriptions", $credentials);
$response = $service->GetClassDescriptions($request);
if(!isset($response->Status) || $response->Status != "Success")
	die("Oh foo. It didn't work.");
?>
<?php 
//    echo $response->ResultCount;
//	echo $response->ClassDescriptions->ClassDescription [0] ->Description;
//	var_dump($response->ClassDescriptions->ClassDescription); 
?>
<html>
	<head>
		<title>List of Classes</title>
	</head>
	<body>
		<h1>Class Descriptions</h1>
		<ul>
			<?php foreach($response->ClassDescriptions->ClassDescription as $description): ?>
			<li>
				<p>
					<strong> <?php echo $description->Name; ?></strong> <br> (<?php echo $description->Description; ?>)
				</p>
				<p>
					ID: <?php echo $description->ID; ?>
				</p>
			</li>
			<?php endforeach; ?>
		</ul>
	</body>
</html>
