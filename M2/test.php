<?php
require(__DIR__ . "/partials/nav.php");


?>

<?php if (isset($_GET['carid'])) : ?>
    <h1>
        <?php 
        $db = getDB();
        $stmt = $db->prepare("SELECT id, make, model, year from Cars where id=:carid");
        
        try{
            $r = $stmt->execute([":carid" => $_GET["carid"]]);
            if($r){
                $cars = $stmt->fetchALL(PDO::FETCH_ASSOC);
                //echo var_dump($cars);
                foreach($cars as $car){
                    $make=$car['make'];
                    echo "<h4>$make</h4>";
                }
            }
        }catch(Exception $e){

        }
        ?>
    </h1>
<?php else : ?>
<?php //endif; ?>
<h2>Cars2</h2>
<style>
    
</style>

<form>
    <div>
        <label for="make">Make</label>
        <input type="text" name="make" required />
    </div>
    <div>
        <label for="model">Mdoel</label>
        <input type="text" name="model" required />
    </div>
    <div>
        <label for="year">Year</label>
        <input type="text" name="year" required />
    </div>
    <input type="submit" value="Add Car" />
</form>

<table>
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
    </tr>

<?php
$db = getDB();
$stmt = $db->prepare("SELECT id, make, model, year from Cars");

try{
    $r = $stmt->execute();
    if($r){
        $cars = $stmt->fetchALL(PDO::FETCH_ASSOC);
        //echo var_dump($cars);
        foreach($cars as $car){
            echo '<tr>';
            //echo var_export($car);
            echo '<td><a href="test.php?carid='.$car['id'].'">' . $car['make'] . '</a></td>';
            echo '<td>' . $car['model'] . '</td>';
            
            echo '<td>' . $car['year'] . '</td>';
            echo '</tr>';
        }
    }
    
} catch (Exception $e){
    echo var_dump($e);
}


if(isset($_GET['make']) && isset($_GET['model']) && isset($_GET['year'])){
    $make= $_GET['make'];
    $model= $_GET['model'];
    $year= $_GET['year'];

    $db = getDB();
    $stmt = $db->prepare("INSERT INTO Cars (make, model, year) values (:make,:model,:year)");
    try {
        $stmt->execute([":make" => $make, ":model" => $model, ":year" => $year]);
        echo "Successfully registered!";
        
    } catch (Exception $e) {
        echo "There was a problem registering";
       echo  "<pre>" . var_export($e, true) . "</pre>";
    }
}

?>
</table>

<?php endif; ?>