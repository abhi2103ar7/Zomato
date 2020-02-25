<?php
    echo "<h1>hello world</h1>";    //printing hello world and adding h1 tag
    $age=20; //creating variable in php (u never specify the data type in php)
    echo  "<h1>hi my age is ".$age."</h1>"; //print the variable value and we are string concatiton using . sign to add
    if($age>18){
        echo "welcome"."<br>";
    } else{
        echo "bye"."<br>";
    }
    for($i=1;$i<=10;$i++){
        echo $i."<br>";
    }
?>