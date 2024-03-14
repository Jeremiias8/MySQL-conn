<?php

use LDAP\Result;

    $servername = "db5015258607.hosting-data.io";
    $dbname = "dbs12574836";
    $username = "dbu1132650";
    $password = "BjAS4pC4mDb34WJpboep6PNUwvBa8ldX";
    $port = 3306;

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username,
        $password);

        // err
        $conn->setAttribute(PDO:ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "It has been connected succesfully";

    } catch (PDOException $e) {

        echo "Connection has failed: " . $e->getMessage();
    }

    $sql = "SELECT * FROM smth";
    foreach ($conn->query($sql) as $row) {
        echo $row['image'] . "<br>";
    }

    // insert
    $sqlInsert = "INSERT INTO images (image)";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload files in PHP</title>
</head>
<body>
    <div class="form__container">

        <h1>Sacar imágenes desde BBDD</h1>

        <form 
            method="POST"
            action="code.php"
            enctype="multipart/form-data"
        >

            <input type="hidden" name="dato" value="inserta_archivo">

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" 
                placeholder="Let a title"
            >

            <div>
                <h3>Drag & Drop or click to select</h3>

                <input type="file" name="imagen[]" id="imagen" 
                    multiple style="display: none;"
                >

                <button type="submit">Send</button>
            </div>
        </form>

    </div>

    <div class="php__container">
        <?php 
        
            // get images from bbdd
            $sql = "SELECT title, file FROM uploadImages";
            $result = $conn->query($sql);

            if ($result->$num_rows > 0) {

                while ($file = $result->fetch_assoc()) {

                    $title = $fila['title'];
                    $imageBase64 = $fila['file'];
        ?>
            <div>
                <div>
                    <div>

                        <img src="data:image/jpeg;base64, <?php echo
                            $imageBase64?>" alt="<?php echo $title ?>"/>

                    </div>
                </div>
        <?php
            
            }
                } else {
                    echo "No se han encontrado imágenes en la bbdd.";
                }   
            
            ?>
            </div>
        ?>
    </div>
</body>
</html>