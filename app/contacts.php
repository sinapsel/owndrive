<center><form action="contacts.php" method="post">
    Query:  <input type="text" name="query" />
    <input type="submit" name="submit" value="Execute" />
</form>
<br>table name = contactsbook<br></center>
<div id="listingcontainer">
<div id="listing">

<?php
$mysql = new mysqli("localhost", "id1661435_usver", "112233qqwwee", "id1661435_maindb");
if(!$mysql->error){
	$mysql->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	
	
	function displayTable($query){
		$table = '';
		$sql = $GLOBALS['mysql']->query($query);
		$table .= '<table border="1">';
		$table .= '<tr>';
		while($field = $sql->fetch_field()){
			$table .= '<th>'.$field->name.'</th>';
		}
		$table .= '</tr>';
		while($row = $sql->fetch_assoc()){
			$table .= '<tr>';
			foreach($row as $key => $item){
				$table .= '<td style="padding-right:50px;">'.($item).'</td>';
			}
			$table .= '</tr>';
		}
		$table .= '</table>';
		return "<center>".$table."</center>";
	}
	
	if(isset($_GET['query']))
		$query = "".$_GET['query'];
	elseif(isset($_POST['query']))
		$query = "".$_POST['query'];
	else $query = "SELECT * FROM contactsbook WHERE 1";
	echo displayTable($query);

}
?>
</div></div>
