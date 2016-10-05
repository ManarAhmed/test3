<?php
$filename = $_GET['filename'];         //File Name
require_once './db/connection.php';
$query = "select r.id,m.name as manufacturer, d.name as distributor, r.manu_part_num, r.dist_part_num,"
        . " r.package, r.required_quantity, r.responsable_user, r.project, r.priority, r.due_date "
        . "from required r, manufacturer m, distributor d "
        . "where d.id = r.distributor and m.id = r.manufacturer and d.name = '" . $_GET['filename'] . "'";
$result = mysqli_query($link, $query);
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
mysqli_close($link);

//header info for browser
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");

/* * *****Start of Formatting for Excel****** */
//define separator
$sep = "\t"; //tabbed character
foreach ($data[0] as $key => $val) {
    echo $key . "\t";
}
print("\n");      //end of printing column names 
 
//start to get data
foreach ($data as $k => $v) {
    $schema_insert = "";
    foreach ($v as $x => $y) {
        if (!isset($y))
            $schema_insert .= "NULL" . $sep;
        elseif ($y != "")
            $schema_insert .= "$y" . $sep;
        else
            $schema_insert .= "" . $sep;
    }

    $schema_insert = str_replace($sep . "$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}
?>