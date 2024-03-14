<?php 

    if ($_POST['dato'] == 'insert_file') {

        $reference = uniqid();
        $title = $_POST['title'];

        if (!empty($_FILES['imagen']['tmp_name'])) {

            $files = $_FILES['imagen'];
            $numFiles = count($files['tmp_name']);

            echo $numFiles;

            // sql query
            $sql = "INSERT INTO uploadImages (ref, titulo, archivo) 
            VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            
            for ($i = 0; $i < $numFiles;  $i++) {

                $imageContent = file_get_contents($files['tmp_name'][$i]);
                $imageBase64 = base64_encode($imageContent);
            }

            $stmt->bind_param("sss", $reference, $title, $imageBase64);

            // exe query
            if ($stmt->execute()) {
                echo "Archivo " . ($i + 1) . " subido correctamente. <br>";
            } else {

                echo "Error al subir el archivo " . ($i + 1) . ": " 
                . $stmt->error . "<br>"; 
            }

        } else {
            echo "No se han seleccionado archivos para subir.";
        }

    }

?>