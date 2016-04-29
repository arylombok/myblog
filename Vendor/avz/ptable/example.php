<?php
require 'avz/src/PTable.php';

$data = [
	["Data A","Data B","Data C"],
	["Data M","Data N","Data O"],
	["Data X","Data Y","Data Z"]
];

$table = new avz\PTable\PTable;

$thead = $table->thead();
	$tr = $thead->tr();
	$tr->th(['ONE','TWO','THREE']);
	$tr->close();
$thead->close();

$tbody = $table->tbody();
	foreach ($data as $n) {
		$tr = $tbody->tr();
		$tr->td($n);
		$tr->close();
	}
$tbody->close();
$mytable = $table->render();

echo <<<HTML
<pre>
<style>
	table {font-size: 32px;max-width:100%;}
	table td,table th {padding:5px 10px;}
	table td {border:1px solid red;}
	table th {border:1px solid blue;}
</style>
HTML;

echo $mytable;