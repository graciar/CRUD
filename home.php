<?php
session_start();
require_once("header.php");
require_once("function.php");

if(!$_SESSION["username"]){
    quit();
}
// print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-3">
        <table class="table table-sm table-bordered">
        <tr>
            <th>Product</th>
            <th>Stock</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php   
        require("database.php");
        $db = new DBConnection();
        $product = $db->getAllProduct();
        foreach ($product as $row) {
        ?>
        <tr>
            <td><?= $row["name"]; ?></td>
            <td><?= $row["stock"]; ?></td>
            <td>
                <a class="btn btn-warning" href="transactionForm.php?id=<?= $row['id']; ?>">Update</a>
            </td>
            <td>
                <a class="btn btn-danger" href="deleteProduct.php?id=<?= $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
        </table>
    </div>

    <br>
    <a href="logout.php" style="text-decoration: underline; color: black;" class="container px-4">Log Out</a>

</body>
</html>