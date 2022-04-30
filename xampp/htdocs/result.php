<?php
$dir_root=$_SERVER["DOCUMENT_ROOT"];
include $dir_root.'/config.php';
if(isset($_GET['type'])){
    if($_GET['type']=="fer" or $_GET['type']=="df" or $_GET['type']=="hc"){  
        $typesec=trim($_GET['type']);
    } else{
        $typesec="fer";
    }
} else{
    $typesec="fer";
}
if(isset($_POST['image'])){
$img = $_POST['image'];
$folderPath = "upload/";
$image_parts = explode(";base64,", $img);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
herefun:
$upname = uniqid();
$sqlcom="SELECT * FROM results WHERE id='$upname'";
$sqlresult = mysqli_query($conn, $sqlcom);
if(mysqli_num_rows($sqlresult) > 0){
    goto herefun;
}
$fileName = $upname . '.png';
$file = $folderPath . $fileName;
echo $file."<br>";
file_put_contents($file, $image_base64);
print_r($fileName);
$urlstr="http://localhost/upload/".$fileName;
$result=file_get_contents("http://127.0.0.1:5000/fmoji".$typesec."?url=".$urlstr."&imgname=".$fileName."&upname=".$upname);
echo "<br>".$result;
$content = file_get_contents("http://127.0.0.1:5000/downloadimg?imgname=".$fileName);
$contentdel = file_get_contents("http://127.0.0.1:5000/del?imgname=".$fileName);
$fp = fopen("result/".$fileName, "w");
fwrite($fp, $content);
fclose($fp);
$resultsep=explode("/",$result);
$emotion=trim($resultsep[1]);
$percenofemo=trim($resultsep[2]);
$sqlcom="INSERT INTO results (id,emotion,emopercentage,scanof) VALUES ('$upname','$emotion','$percenofemo','hc')";
$sqlresult = mysqli_query($conn, $sqlcom);
if(isset($_GET['json']) and $_GET['json']=="true"){
    header("Location: out?json=true&id=".$upname);
} else{
    header("Location: out?id=".$upname);
}
} else{
    echo "no image";
}
?> 



