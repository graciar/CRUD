<?php
require_once("header.php");
require_once("database.php");
require_once("function.php");
$db = new DBConnection();
$errors = [];


if(!isset($_GET["id"])){
    home();
}
$result = $db->getProductById($_GET["id"]);
$product = $result->fetch();
$name = $product["name"];
$stock = $product["stock"];



if(isset($_POST["submit"])){
    if (empty($_POST["qty"])) {
        array_push($errors, "is required");
    }

    $qty =$_POST["qty"];
    if ($qty <= 0) {
        $errors[] = "Quantity must be greater than 0";
    }

    if ($_POST["type"] == "stock out" && $qty > $stock) {
        $errors[] = "Cannot stock out more than available quantity.";
    }

    if (count($errors) == 0) {
        if($_POST["type"] == "stock in"){
            $stock += $_POST["qty"];
            $db->transaction($_GET["id"], $_POST["type"], $_POST["qty"]);
            $db->updateQty($_GET["id"], $stock);
        }else{
            $stock -= $_POST["qty"];
            $db->transaction($_GET["id"], $_POST["type"],  $_POST["qty"]);
            $db->updateQty($_GET["id"], $stock);
        }
        header("Location: home.php");
    }
}

?>
<div class="container mt-4">
    <form class="form" action="" method="post">
        <div class="row mt-3">
            <div class="col-4">
                <label for="name">Product Name</label>
                
                <h3><?php echo($name . "(" . $stock . ")") ?></h3>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
            <label>
                <input type="radio" name="type" value="stock in" class="form-check-input" required>
                Stock <strong>IN</strong>
            </label>
            <br>
            <label>
                <input type="radio" name="type" value="stock out" class="form-check-input">
                Stock <strong>OUT</strong>
            </label>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
            <label for="code">Quantity</label>
                <input class="form-control" type="number" name="qty"
                    value="" placeholder="qty"/>
            </div>
        </div>
        <input class="mt-3 btn btn-primary" type="submit" name="submit" value="Save Record"/>
        <a class="mt-3 btn btn-warning" href="home.php">Cancel</a>
    </form>
    <div class="mt-4">
        <ul class="error">
            <?php
            foreach ($errors as $err) {
                echo("<li>{$err}</li>");
            }
            ?>
        </ul>
    </div>
</div>