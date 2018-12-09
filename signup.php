<?php
require "header.php";
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Signup</h1>
            <?php
                if(isset($_GET['error'])) {
                    if($_GET['error'] == "emptyfields") {
                        echo '<p class="signuperror">Fill in all fields!</p>';
                    }
                    else if($_GET['error'] == "invaliduname") {
                        echo '<p class="signuperror">Username exists</p>';
                    }
                }
                else if(isset($_GET['signup'])) {
                    if($_GET['signup']  == "success") {
                    echo '<p class="signupsuccess">Signup successful!</p>';
                    }
                }
            ?>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="uname" placeholder="Username">
                <input type="text" name="email" placeholder="E-mail">
                <input type="text" name="firstname" placeholder="First name">
                <input type="text" name="surname" placeholder="Surname">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat password">
                <button type="submit" name="signup-submit">Signup</button>
            </form>
        </section>
    </div>
</main>

<?php
require "footer.php";
?>
