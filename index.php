<?php
  require "header.php";
  require "includes/dbh.inc.php"
?>

<main>
    </nav>
        <div class="header-login">
    <div class="wrapper-main container h-100 d-flex justify-content-center">
        <section>
              <?php
              if (isset($_SESSION['userId'])) {
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $uid = $_SESSION['userId'];
                
                $sql = "SELECT photo_filename, gender FROM t155233_users WHERE id=$uid";
                $result = $conn->query($sql);

                $checkMissingData = false;
                
                if ($result->num_rows > 0) {
                    /* output data of each row
                    Checks if there exists a record of a photo in db, if not
                    pulls out form to upload one.
                    */
                    while($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["photo_filename"]. "<br>";
                        if(empty($row["photo_filename"])) {
                            echo '<form action="includes/upload.inc.php" method="post" 
                            enctype="multipart/form-data">
                            Select photo upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="upload_image">
                            </form>';
                        }
                        if(empty($row["gender"])) {
                            echo '<form action="includes/setGender.inc.php" method="post">
                            <input type="radio" name="gender" value="male"> Male<br>
                            <input type="radio" name="gender" value="female"> Female<br>
                            <input type="submit" value="Set gender" name="set_gender">
                            </form>';
                        }
                        $checkMissingData = true;
                    }
                /* if all is set, meaning gender and photo isn't missing.
                Start new query.
                We can ask for opinions about other's photos. */    
                } if($checkMissingData) { 
                    
                    $sql = "SELECT gender FROM t155233_users WHERE id=$uid;";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $gender = $row["gender"];
                        }
                    }

                    echo "user with id: " .$uid . " is " . $gender . "<br>";
                    
                    $sql = "SELECT id, gender, photo_filename
                            FROM t155233_users
                            WHERE id NOT IN (SELECT rated
                            FROM t155233_rated WHERE uid = $uid) AND id <> $uid AND gender != '$gender';";
                            
                     $result = mysqli_query($conn, $sql);                        
                
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        $unratedUsers = array();
                        while($row = mysqli_fetch_assoc($result)) {
                             
                            echo "id that isn't rated: " . $row["id"]. " photo's filename " . $row['photo_filename'] . "<br>";
                            
                            array_push($unratedUsers, $row['photo_filename']);
                        }
                        echo print_r($unratedUsers);
                        if (!empty($unratedUsers)) {
                            error_reporting(0);
                            
                            $user_picture = array_pop($unratedUsers);

                            echo '<div id="picture_and_buttons" class="row" style="display: flex">
                                    <div>
                                    <img src="../uploads/' . $user_picture . '" alt="' . $user_picture . '"/>
                                    </div>
                                    <form id="likeButtons" action="includes/rate.inc.php" method="post" class="my-auto" style="padding: 4px;">
                                        <button type="submit" name="like-submit" value="' . $user_picture .'"style="display: block" >Like</button>
                                        <button type="submit" name="dislike-submit" value="' . $user_picture .'"style="display: block" >Next</button>
                                    </form>
                                </div>';
                        }
                    } else {
                        echo "0 results";
                    }


                }
                mysqli_close($conn);
            } else {
             echo 'Login to get a piece of the action. Show your red nose and show some Christmas spirit!';        
            }            
            ?>            
        </section>
    </div>
</main>

<?php
  require "footer.php";
?>
