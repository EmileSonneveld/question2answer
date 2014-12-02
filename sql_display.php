<?php

require("sql_common.php");

// http://jsfiddle.net/yna2rctu/



$result = $connection->query("show tables");
while ($table_name = $result->fetch(PDO::FETCH_NUM)) {
	emile_print_table($table_name[0], true);
}


?>