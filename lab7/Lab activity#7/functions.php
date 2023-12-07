<?php
require_once("dbconnection.php");

function saveDataToDatabase($name, $course_id, $course_name, $year_section, $action_taken, $photo) {
    global $conn;

    $targetDir = "uploads/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $tmpFilePath = $photo["tmp_name"];
    $targetFilePath = $targetDir . basename($photo["name"]);

    $check = getimagesize($tmpFilePath);

    if ($check !== false) {
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // Convert the array of course names to a comma-separated string
            $course_name_str = implode(", ", $course_name);

            $sql = "INSERT INTO student_entries (name, course_id, course_name, year_section, action_taken, photo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $name, $course_id, $course_name_str, $year_section, $action_taken, $targetFilePath);
            $stmt->execute();
        } else {
            echo "Failed to move the uploaded file to $targetFilePath.";
        }
    } else {
        echo "File is not an image or doesn't exist.";
    }
}

function fetchDataFromDatabase() {
    global $conn;

    $sql = "SELECT * FROM student_entries";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

function getEntryFromDatabase($entryId) {
    global $conn;

    $entryId = mysqli_real_escape_string($conn, $entryId);

    $sql = "SELECT * FROM student_entries WHERE id = $entryId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function updateDataInDatabase($id, $name, $course_id, $course_name, $year_section, $action_taken) {
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $course_id = mysqli_real_escape_string($conn, $course_id);
    $course_name = mysqli_real_escape_string($conn, $course_name);
    $year_section = mysqli_real_escape_string($conn, $year_section);
    $action_taken = mysqli_real_escape_string($conn, $action_taken);

    $sql = "UPDATE student_entries SET name = ?, course_id = ?, course_name = ?, year_section = ?, action_taken = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $course_id, $course_name, $year_section, $action_taken, $id);
    $stmt->execute();
}

function deleteEntry($entryId) {
    global $conn;

    $entryId = mysqli_real_escape_string($conn, $entryId);

    $sql = "DELETE FROM student_entries WHERE id = $entryId";
    $result = $conn->query($sql);

    if ($result) {
        return true; 
    } else {
        return false;
    }
}
?>



