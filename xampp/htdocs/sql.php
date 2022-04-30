<?php
$dir_root=$_SERVER["DOCUMENT_ROOT"];
include $dir_root.'/config.php';
//make table of result
$sqlcom="CREATE TABLE results(
    id VARCHAR(255) NOT NULL UNIQUE,
    emotion VARCHAR(255) NOT NULL,
    emopercentage VARCHAR(255) NOT NULL,
    scanof VARCHAR(25) NOT NULL,
    created_at VARCHAR(100) NOT NULL DEFAULT CURRENT_TIMESTAMP
);";
$sqlresult = mysqli_query($conn, $sqlcom);
//make table of emoji databse
$sqlcom="CREATE TABLE emojistore (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    unichar varchar(50) NOT NULL,
    emotion varchar(50) NOT NULL,
    perdown int(11) NOT NULL,
    perup int(11) NOT NULL
  )";
$sqlresult = mysqli_query($conn, $sqlcom);
//insert previous results
$sqlcom="INSERT INTO emojistore (unichar, emotion, perdown, perup) VALUES
('1F600', 'ha', 20, 65),
('1F604', 'ha', 25, 55),
('1f621', 'an', 20, 100),
('1F606', 'ha', 30, 60),
('1f61e', 'sa', 25, 97),
('1F611', 'nu', 30, 60),
('1F62E', 'su', 25, 65),
('1f62f', 'su', 22, 98),
('1F632', 'su', 30, 55),
('1F97A', 'sa', 28, 61),
('1F627', 'su', 30, 50),
('1f610', 'nu', 21, 95),
('1f601', 'ha', 25, 95),
('1F620', 'an', 25, 65),
('1F92C', 'an', 29, 61),
('1F624', 'an', 22, 58),
('1F626', 'su', 30, 65),
('1F633', 'su', 27, 55),
('1F641', 'sa', 25, 60),
('1F61F', 'sa', 27, 58),
('1F614', 'sa', 29, 65),
('1F642', 'nu', 25, 55),
('1FAE5', 'nu', 20, 50),
('1FAE4', 'nu', 30, 60),
('1F468', 'nu', 35, 55),
('1f92e', 'di', 25, 65),
('1F602', 'la', 21, 95),
('1F605', 'la', 30, 65),
('1F923', 'la', 35, 60),
('1F972', 'cr', 35, 55),
('1F979', 'cr', 30, 60),
('1F62D', 'cr', 25, 90),
('1F62B', 'cr', 30, 70),
('1F629', 'cr', 25, 60),
('1F616', 'cr', 30, 65),
('1F922', 'di', 35, 55),
('1f639', 'la', 30, 60);";
$sqlresult = mysqli_query($conn, $sqlcom);
?>