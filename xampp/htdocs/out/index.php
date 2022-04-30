<?php
$dir_root=$_SERVER["DOCUMENT_ROOT"];
include $dir_root.'/config.php';
if(isset($_GET['id'])){
    $sqlcom="SELECT * FROM results WHERE id='".$_GET['id']."'";
    $sqlresult = mysqli_query($conn, $sqlcom);
    if(mysqli_num_rows($sqlresult) > 0){
        $row = mysqli_fetch_assoc($sqlresult);
        $emoofdata=trim($row['emotion']);
        $perofdata=trim($row['emopercentage']);
        $idofdata=trim($row['id']);
        $stofdata=trim($row['scanof']);
        $createtime=trim($row['created_at']);
        if($stofdata=="fer"){
            $scanofdata="FER 2013";
        } elseif($stofdata=="df"){
            $scanofdata="Deepface";
        } elseif($stofdata=="hc"){
            $scanofdata="Haarcascade";
        } elseif($scanofdata==""){
            $scanofdata="No scan found";
        }
        $meow=$row;
        if(strpos($emoofdata, ',') !== false){
            $allemo=explode(",", strtolower($emoofdata));
        } else{
            $allemo[0]=strtolower($emoofdata);
        }
        if(strpos($perofdata, ',') !== false){
            $allper=explode(",", strtolower($perofdata));   
        } else{
            $allper[0]=strtolower($perofdata);
        }
        if(count($allemo)!=count($allper)){
            die("Error: ".count($allemo)." emotions and ".count($allper)." percentages found. Not equal.");
        } else{
            $numpass=count($allemo);
        }
        $count=0;
        $tableofemo='<center><table style="width:100%"><tr><th>Sr. No.</th><th>Emoji</th><th>Emotion Name</th><th>Unicode</th><th>Per Down</th><th>Per Given</th><th>Per Up</th><th>Copy Emoji</th><th>Copy HashCode</th></tr>';
        for($i=0;$i<$numpass;$i++){
            $emocomeofdata=$allemo[$i];
            $perofdata=$allper[$i];
            if($emocomeofdata=="happy"){
                $emocomeofdatacap="ha";
            } elseif($emocomeofdata=="sad"){
                $emocomeofdatacap="sa";
            } elseif($emocomeofdata=="angry"){
                $emocomeofdatacap="an";
            } elseif($emocomeofdata=="surprise"){
                $emocomeofdatacap="su";
            } elseif($emocomeofdata=="neutral"){
                $emocomeofdatacap="nu";
            }
            $sqlcom="SELECT * FROM emojistore WHERE emotion ='$emocomeofdatacap' AND perdown < ".$perofdata." AND perup > ".$perofdata;
            $sqlresult = mysqli_query($conn, $sqlcom);
            if(mysqli_num_rows($sqlresult) > 0){
                while($row = mysqli_fetch_assoc($sqlresult)) {
                    $count++;
                    $pewuc="uc".$count;
                    $pewpd="pd".$count;
                    $pewpu="pu".$count;
                    $meow[$pewuc]=$row['unichar'];
                    $meow[$pewpd]=$row['perdown'];
                    $meow[$pewpu]=$row['perup'];
                    $tableofemo.='<tr><td>'.$count.'</td><td>'."&#x".$row["unichar"].'</td><td>'.$emoofdata.'</td><td>'.$row["unichar"].'</td><td>'.$row["perdown"].'%</td><td>'.$perofdata.'%</td><td>'.$row["perup"].'%</td><td><input type="hidden" id="emocire'.$count.'" value="'."&#x".$row["unichar"].'"><button class="btn btn-success" onclick="myFunction('."'e".$count."'".')" onmouseout="outFunc('."'e".$count."'".')">Copy Emoji</button></td><td><input type="hidden" id="emocirc'.$count.'" value="'.$row["unichar"].'"><button class="btn btn-success" onclick="myFunction('."'c".$count."'".')" onmouseout="outFunc('."'c".$count."'".')">Copy HashCode</button></div></td></tr>';
                }
                $meow["count"]=$count;
            }
        }
        if($count==0){
            $tableofemo='No emoji found';
        } else{
            $tableofemo.="</table></center>";
        }
        if(isset($_GET['json']) and $_GET['json']=="true"){
            $jsonofdata=json_encode($meow);
            echo $jsonofdata;
        } else{
            $bodyhtml='<div class="container"><h1 class="text-center">Result of ID: '.$_GET['id'].'</h1><div class="row"><div class="col-md-6"><h3>Entered Image: </h3><img src="/upload/'.$idofdata.'.png"></div><div class="col-md-6"><h3>Result Image: </h3><img src="/result/'.$idofdata.'.png"></div></div></div><center style="font-size:20px">Emotion: '.$emoofdata.'<br>Emotion Value: '.$perofdata.'%<br>Created at: '.$createtime.'<br>Scan by: '.$scanofdata.' method<br>Suggested Emoji Table: <br>'.$tableofemo.'</center>';
        }
    } else{
        echo "No Data Found for given ID: ".$_GET['id'];
    }
} else{
    echo "No ID Parameter Found";
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
    <?php
        if(isset($bodyhtml)){
            echo $bodyhtml;
        }
    ?>
    <script>
        function myFunction(v){
            if(v[0]="e"){
                var copyText = document.getElementById("emocir"+v).value;
            } else if(v[0]="c"){
                var copyText = document.getElementById("emocir"+v).value;
                copyText="&#x"+copyText
            }
            console.log(copyText);
            navigator.clipboard.writeText(copyText);
        }
        function outFunc(v){
            
        }
</script>
</body>
