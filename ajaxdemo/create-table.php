<?php
$number = htmlspecialchars($_GET["number"]);
if(is_numeric($number) && $number > 0){
    echo "<table>";
    for($i=0; $i<11; $i++){
        echo "<tr>";
            echo "<td>$number x $i</td>";
            echo "<td>=</td>";
            echo "<td>" . $number * $i . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>