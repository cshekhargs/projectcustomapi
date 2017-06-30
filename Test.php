<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<title> Katalyst tech test sales force</title>
</head>
<body>
<?php
//define("USERNAME", "jitendra.zaa@gmail.com");
//define("PASSWORD", "232BKHDJFUY79W3EWEHWIEHWI9EWE");
//define("SECURITY_TOKEN", "ASASALJSHWYE78YW876E8WDHDISHIDHSEWY9EWHD");

define("USERNAME", "sgangathade@katalysttech.com");
define("PASSWORD", "guruji@#1234");
define("SECURITY_TOKEN", "BzfI3y9TK8VSYFUuaEClNUpv");

require_once ('soapclient/SforcePartnerClient.php');

$mySforceConnection = new SforcePartnerClient();
$mySforceConnection->createConnection("PartnerWSDL.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

$query = "SELECT Id, FirstName, LastName, Phone from Contact";
$response = $mySforceConnection->query($query);
?>
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
								<a href="javascript:void(0);">							
								<?php
									//echo "Results of query '$query'<br/><br/>\n";
								?>
								</a>
							<table>
								<tr>
									<th>Contact ID </th>
									<th>First Name</th>
									<th> Last Name </th>
									<th>Phone </th>
								</tr>
								<?php
									foreach ($response->records as $record) {
								
										echo '<tr> 
													<td>'.$record->Id.'</td>
													<td>'.$record->fields->FirstName.'</td>
													<td>'.$record->fields->LastName.'</td>
													<td>'.$record->fields->Phone.'</td>
											 </tr>';
										 }
								?>
							</table>
						</div>
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
								<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<!-- end #footer -->
</body>
</html>

