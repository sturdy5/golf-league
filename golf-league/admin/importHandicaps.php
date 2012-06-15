<?php
$data = array();

function addHandicap($lastName, $handicap) {
    global $data;
    $data[] = array('lastName' => $lastName, 'handicap' => $handicap);
}

if ($_FILES['handicapFile']['tmp_name']) {
    $dom = DOMDocument::load($_FILES['handicapFile']['tmp_name']);
    $rows = $dom->getElementsByTagName("Row");
    $firstRow = true;
    foreach ($rows as $row) {
        // skip the first row as it is just labels
        if (!$firstRow) {
            $lastName = "";
            $handicap = "";
            
            $index = 1;
            $cells = $row->getElementsByTagName('Cell');
            foreach ($cells as $cell) {
                $ind = $cell->getAttribute("Index");
                if (null != $ind) {
                    $index = $ind;
                }
                if ($index == 1) {
                    $lastName = $cell->nodeValue;
                }
                if ($index == 2) {
                    $handicap = $cell->nodeValue;
                }
                $index++;
            }
            addHandicap($lastName, $handicap);
        }
        $firstRow = false;
    }
}
?>
<html>
<body>
<table>
<tr>
    <th>Last Name</th>
    <th>Handicap</th>
</tr>
<?php foreach ($data as $row) {?>
<tr>
    <td><?=$row['lastName']?></td>
    <td><?=$row['handicap']?></td>
</tr>
<?php }?>
</table>
</body>
</html>