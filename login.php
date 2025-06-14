<!DOCTYPE html>
<html lang="en">
   <?php 
        session_start();
        require_once("function.php");
        require_once("database.php");

        $db = new DBConnection();
        $user = $db->getUser();
        $found = false;  // initialize flag

        if(isset($_POST["submit"])){
            foreach ($user as $row) {
                if($row["name"] == $_POST["username"] && $row["password"] == $_POST["password"]){
                    $_SESSION["username"] = $_POST["username"];
                    
                    home();
                    $found = true;
                    break;
                }
            }
            if(!$found){
                quit();
            }
        }
        if(isset($_SESSION["username"])){
            home();
        }
   ?>
<body>

<form action="" method="post">
   <input type="text" name="username" placeholder="Username" required/>
   <input type="password" name="password" placeholder="Password" required/>
   <input type="submit" name="submit" value="Log In"/>
</form>
</body>
</html>