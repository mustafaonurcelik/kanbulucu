<?php
	
// FUNCTIONS
function idToName($db, $table, $id)
{
    return $db->query("SELECT name FROM $table WHERE id='$id'")->fetch()['name'];
}
// FUNCTIONS / end

function kangruplari($db)
{
    foreach($db->query("SELECT * FROM kangruplari") as $grup):
        echo "<option value='$grup[slug]'>$grup[name]</option>";
    endforeach;
}


?>