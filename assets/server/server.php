<?php
$job = $_POST["job"];
try
{
    $db = new PDO("mysql:host=localhost;dbname=kanbulucu","root","root");
} 
catch(PDOException $e) 
{
    echo $e->getMessage();
}

switch($job)
{
	case "defaultCase":
		

	break;
} // switch ends here