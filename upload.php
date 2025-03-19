<?php
include("conn/dbase.php");

// Check submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["c_file"]) && $_FILES["c_file"]["error"] == 0) {
        $targetDir = "uploads/";

        // Generate a unique filename
        $fileExt = strtolower(pathinfo($_FILES["c_file"]["name"], PATHINFO_EXTENSION));
        $uniqueFilename = uniqid() . "." . $fileExt;

        // Set the target path including the unique filename
        $targetPath = $targetDir . $uniqueFilename;

        // Move the uploaded file
        if (move_uploaded_file($_FILES["c_file"]["tmp_name"], $targetPath)) {
            // Insert the data into the database
            $c_sec = $_POST["c_sec"];
            $c_num = $_POST["c_num"];
            $c_head = $_POST["c_head"];
            $c_date = $_POST["c_date"];
            $confirm = 0; // Default value

            $sql = "INSERT INTO c_tbl (c_sec, c_num, c_head, c_date, c_file, confirm) 
                    VALUES (:c_sec, :c_num, :c_head, :c_date, :c_file, :confirm)";
            
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(":c_sec", $c_sec);
            $stmt->bindParam(":c_num", $c_num);
            $stmt->bindParam(":c_head", $c_head);
            $stmt->bindParam(":c_date", $c_date);
            $stmt->bindParam(":c_file", $uniqueFilename);
            $stmt->bindParam(":confirm", $confirm);

            // Execute the query
            if ($stmt->execute()) {
                // Data inserted successfully
                $response = array("status" => "success", "message" => "Data inserted successfully.");
            } else {
                // Error inserting data
                $response = array("status" => "error", "message" => "Error inserting data.");
            }
        } else {
            // Error uploading file
            $response = array("status" => "error", "message" => "Error uploading file.");
        }
    } else {
        // No file uploaded or an error occurred during upload
        $response = array("status" => "error", "message" => "No file uploaded or an error occurred during upload.");
    }

    // Return JSON response
    echo json_encode($response);
}
?>

