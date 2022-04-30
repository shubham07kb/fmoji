<?php
$dir_root=$_SERVER["DOCUMENT_ROOT"];
include $dir_root.'/config.php';
if(isset($_POST['submit'])){
    $p=0;
    $t=0;
    if(isset($_POST['numval'])){
        $xval=(int)trim($_POST['numval']);
        for ($x = 0; $x < $xval; $x++){
            $emojiuni=trim($_POST['unival'.strval($x)]);
            $emotion=trim($_POST['emo'.strval($x)]);
            $downval=(int)trim($_POST['downval'.strval($x)]);
            $upval=(int)trim($_POST['upval'.strval($x)]);
            if($emotion=="ha" or $emotion=="sa" or $emotion=="su" or $emotion=="an" or $emotion=="nu"){
                $sql = "INSERT INTO emojistore (unichar, emotion, perdown, perup) VALUES ('".$emojiuni."','".$emotion."','".$downval."','".$upval."')";
                if (mysqli_query($conn, $sql)) {
                    if($p==0){
                        $p=0;
                        $t=1;
                        $m = "Emoji added successfully";
                        $pq=$x+1;
                    }
                } else {
                    $p=1;
                    $m = "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else "Wrong emotion type";
        }
    }
    echo $m;
    if($t=1){
        echo "Number of recored entered".$x;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>     
    <a href="/show">Show Emoji Database</a>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input id=numval type="number" name="numval" onkeyup="jsrun()" required>
        <div id="insideform"></div>
        <input type="submit" name="submit" value="submit">
    </form>
    &#128512;
    <script>
        function jsrun(){
            let text = '';
            let valn = document.getElementById("numval").value;
            for (let i = 0; i < valn; i++) {
                let j = i+1;
                let tex = j + '   <input type="text" name="unival' + i + '" placeholder="Enter Unicode of Emoji" id="emoth' + i + '" onkeyup="showemrun('+"'"+i+"'"+')" required><select name="emo' + i + '" placeholder="Enter Emotion" required><option value="ha">Happy</option><option value="sa">Sad</option><option value="su">Surprise</option><option value="an">Angry</option><option value="nu">Neutral</option></select><input type="number" name="downval' + i + '" placeholder="Down Value" min="0" max="100" required><input type="number" name="upval' + i + '" placeholder="Up Value" min="0" max="100" required><i id="showemot' + i + '"></i>' + "<br>";
                text += tex;
            }
            console.log(text);
            document.getElementById("insideform").innerHTML = text; 
        } 
        function showemrun(in1){
            let in2 = document.getElementById("emoth"+in1).value;
            if(in2.length==5){
                let in3="&#x"+in2;
                document.getElementById("showemot"+in1).innerHTML = in3; 
            } else{
                document.getElementById("showemot"+in1).innerHTML = ""; 
            }
        }
    </script>
</body>
</html>