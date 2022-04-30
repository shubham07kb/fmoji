<?php
$dir_root=$_SERVER["DOCUMENT_ROOT"];
include $dir_root.'/config.php';
$sqlcom="SELECT * FROM results";
$sqlresult = mysqli_query($conn, $sqlcom);
if(mysqli_num_rows($sqlresult) > 0){
    $count=0;
    $tableofemo='<center><table style="width:100%"><tr><th>Sr. No.</th><th>ID</th><th>Emotion Name</th><th>Emotion Value</th><th>Created At</th><th>Scan by:</th><th>Link</th></tr>';
    while($row = mysqli_fetch_assoc($sqlresult)){
        $count=$count+1;
        $id=$row['id'];
        $emotion=$row['emotion'];
        $emopercentage=$row['emopercentage'];
        $stof=$row['scanof'];
        $createtime=$row['created_at'];
        if($stof=="fer"){
            $scanof="FER 2013";
        } elseif($stof=="df"){
            $scanof="Deepface";
        } elseif($stof=="hc"){
            $scanof="Haarcascade";
        } elseif($scanof==""){
            $scanof="No scan found";
        }
        $tableofemo.='<tr><td>'.$count.'</td><td>'.$id.'</td><td>'.$emotion.'</td><td>'.$emopercentage.'</td><td>'.$createtime.'</td><td>'.$scanof.'</td><td><a href="/out?id='.$id.'">Web Page Result</a>  /  <a href="/out?json=true&id='.$id.'">Json Result</a></td></tr>';
    }
} else{
    $tableofemo="No results found";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Result by F-Moji</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
    <style type="text/css">
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>
    <center><h1>All Results</h1></center>
    <?php
        if(isset($tableofemo)){
            echo $tableofemo;
        }
    ?>
</body>