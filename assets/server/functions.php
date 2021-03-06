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


function iller($db)
{
    foreach($db->query("SELECT * FROM iller") as $il):
        echo "<option value='$il[id]'>$il[baslik]</option>";
    endforeach;
}


function ilceler($db, $il_id = "")
{
	if ($il_id):
		foreach($db->query("SELECT * FROM ilceler WHERE il_id='$il_id'") as $ilce):
	        echo "<option value='$ilce[id]'>$ilce[baslik]</option>";
	    endforeach;	
	else:
		foreach($db->query("SELECT * FROM ilceler") as $ilce):
	        echo "<option value='$ilce[id]'>$ilce[baslik]</option>";
	    endforeach;
	endif;
}

function slugToName($db, $slug)
{
    $q = $db->query("SELECT name FROM kangruplari WHERE slug='$slug'")->fetch();
    echo $q[name];
}

function exchangeValues($db, $tableName, $id, $alinacakKolon)
{
    // gelen deger mutlaka ID olmak zorunda..
    $q = $db->query("SElECT $alinacakKolon FROM $tableName WHERE id='$id'")->fetch();
    echo $q[$alinacakKolon];
}


?>