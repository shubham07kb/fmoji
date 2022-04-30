<?php
$dir_root=$_SERVER["DOCUMENT_ROOT"];
include $dir_root.'/config.php';
$sql = "SELECT * FROM emojistore";
$p="";
$t=0;
$result = mysqli_query($conn, $sql);
while($row = $result->fetch_assoc()) {
    $t=$t+1;
    if($row["emotion"]=="nu"){
        $emot="neutral";
    } elseif($row["emotion"]=="sa"){
        $emot="sad";
    } elseif($row["emotion"]=="ha"){
        $emot="happy";
    } elseif($row["emotion"]=="su"){
        $emot="surprise";
    } elseif($row["emotion"]=="an"){
        $emot="anger";
    }
    $p.="<tr><td>" . $t . "</td><td>" . $row["unichar"]. "</td><td>" . "&#x" .$row["unichar"]. "</td><td>" . $emot . "</td><td>" . $row["perdown"] . "</td><td>" . $row["perup"] . "</td></tr>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <a href="/enter">Enter More Emoji</a>
    <table>
        <tr>
            <th>Sr. No.</th>
            <th>Unicode</th>
            <th>Emoji</th>
            <th>Type</th>
            <th>Per Down</th>
            <th>Per Up</th>
        </tr>
        <?php
            echo $p;
        ?>
    </table>
</body>
</html>