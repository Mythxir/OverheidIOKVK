<?php
include "src/QueryController.php";
include "src/KVKIDController.php";
include "src/SuggetsController.php";
$controller = new \NMinten\OverheidAPI\QueryController();
$controller2 = new \NMinten\OverheidAPI\KVKIDController();
$controller3 = new \NMinten\OverheidAPI\SuggetsController();
$controller->set_api_key("174146f00f414a6b83ed9e750d66203070c0b80355dc34f0235e24d44db2b22e");
$controller2->set_api_key("174146f00f414a6b83ed9e750d66203070c0b80355dc34f0235e24d44db2b22e");
$controller3->set_api_key("174146f00f414a6b83ed9e750d66203070c0b80355dc34f0235e24d44db2b22e");
$controller3->set_query_string("hey");
$controller3->set_query(4, "handelsnaam");
echo "<pre>";
echo print_r($controller3->connect());
echo "</pre>";






if (isset($_GET['ID'])) {
    $controller2->set_id($_GET['ID']);
    $result = $controller2->connect();
//    echo "<pre>";
//    echo print_r($result);
//    echo "</pre>";
}
else {
//    $controller->add_query_item("plaats", "Eindhoven");
//    $controller->add_query_item("huisnummer", "20");
    $result = $controller->connect();

//echo "<pre>";
//echo print_r($result);
//echo "</pre>";
    foreach ($result->_embedded->bedrijf as $item) {
        ?>
            <a href="https://overheidkvk.tapreck.com/?ID=<?php echo $item->slug;?>"><?php echo $item->slug;?></a><br/>
        <?php
//        echo "<pre>";
//        echo print_r($item);
//        echo "</pre>";

    }
}

