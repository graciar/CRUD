<?php
require_once("header.php");
require_once("database.php");
require_once("function.php");
$db = new DBConnection();
$errors = [];


if(isset($_POST["submit"])){
    $name=$_POST["name"];
    if (empty($_POST["name"])) {
        array_push($errors, "is required");
    }

    $stock =$_POST["stock"];
    if ($stock <= 0) {
        $errors[] = "Quantity must be greater than 0";
    }


    if (count($errors) == 0) {
        $db->addProduct($name, $stock);
        header("Location: home.php");
    }
}
?>

<div class="container mt-4">
    <form class="form" action="" method="post">
        <div class="row mt-3">
            <div class="col-4">
                <label for="code">Product Name</label>
                <input class="form-control" type="text" name="name"
                    value="" placeholder="product name"/>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
            <label for="code">Stock</label>
                <input class="form-control" type="number" name="stock"
                    value="" placeholder="stock"/>
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