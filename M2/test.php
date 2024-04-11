<?php
require(__DIR__ . "/partials/nav.php");
?>
<h2>Cars</h2>
<style>
    
</style>
<table>
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
    </tr>

<?php
$db = getDB();
$stmt = $db->prepare("SELECT make, model, year from Cars");

try{
    $r = $stmt->execute();
    if($r){
        $cars = $stmt->fetchALL(PDO::FETCH_ASSOC);
        //echo var_dump($cars);
        foreach($cars as $car){
            echo '<tr>';
            //echo var_export($car);
            echo '<td>' . $car['make'] . '</td>';
            echo '<td>' . $car['model'] . '</td>';
            echo '</tr>';
        }
    }
    
} catch (Exception $e){
    echo var_dump($e);
}

?>
</table>