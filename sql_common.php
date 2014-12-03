<?php
// Quickly see all the contents of a database

//define('QA_BASE_DIR', dirname(dirname(__FILE__)).'/');
require 'qa-config.php';
	define('QA_MYSQL_HOSTNAME', '127.0.0.1'); // try '127.0.0.1' or 'localhost' if MySQL on same server
	define('QA_MYSQL_USERNAME', 'emiles1q_hack');
	define('QA_MYSQL_PASSWORD', 'pass1');
	define('QA_MYSQL_DATABASE', 'emiles1q_question2answer_schema');
// emilesonneveld.be first need to give permission to the working IP-adderess
$servername = "QA_MYSQL_HOSTNAME";
$dbname = "QA_MYSQL_DATABASE";
$username = "QA_MYSQL_USERNAME";
$password = "QA_MYSQL_PASSWORD";

$servername = "127.0.0.1";
$dbname = "emiles1q_question2answer_schema";
$username = "emiles1q_hack";
$password = "pass1";

try
{
	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	echo "Connected successfully to: $servername as: $username (password stays secret)<br/>";
}
catch(PDOException $e)
{

	echo "<b>Connection failed! Give it a try with a local server.</b><br/>";
	die( $e->getMessage() );
}




//echo "<link rel='stylesheet' type='text/css' href='style.css'  media='screen'></style>";
echo "
<style>
table
{
	border-style: solid;
    border-color: #66c285;
}

table td
{
    padding-left: 5px;
	padding-right: 5px;
    padding-bottom: 3px;
}

table tr:nth-child(odd)
{
	background-color:#eee;
}

table tr:first-child
{
	background-color: #006600;
	color: #fff;
}
</style>
";




function emile_print_table($table_name, $bool_allow_input = false){
	global $connection;

	echo "<h3>".$table_name."</h3> <br/>\n";

	if ($bool_allow_input)
	{
		// form must encapsulate entire table to be correct :(
		echo "<form action='sql_add_to_table.php'>";
	}
	echo "<table cellspacing='0'>";


	echo "<tr>";
	$q = $connection->query("DESCRIBE ". $table_name );
	$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
	foreach($table_fields as $value){
		echo "<td>$value</td>";
	}
	echo "</tr>";


	$result_item = $connection->query("select * from ".$table_name);
	while ($row2 = $result_item->fetch(PDO::FETCH_NUM)) {
		echo "<tr>";
		foreach($row2 as $value){
			echo "<td>$value</td>";
		}
		echo "</tr>\n";
	}

	if($bool_allow_input)
	{
		echo "<tr>";
		foreach($table_fields as $value){
			echo "<td><input type='text' name='$value'/></td>";
		}
		echo "</tr>";
		echo "</table>";
		echo "<input type='submit' value='Submit'/></form> <br/>\n";
	}
	else
	{
		echo "</table>";
		echo "<br/>\n";
	}
}

?>