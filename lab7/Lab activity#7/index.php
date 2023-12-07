<?php
require_once("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $course_id = $_POST["id"];
    $course_name = $_POST["coursename"];
    $year_section = $_POST["yrsec"];
    $action_taken = $_POST["acttaken"];
    $photo = $_FILES["photo"];

    saveDataToDatabase($name, $course_id, $course_name, $year_section, $action_taken, $photo);
}

function calculatePercentage($course) {
    $totalStudents = count(fetchDataFromDatabase());
    $studentsInCourse = 0;
    $data = fetchDataFromDatabase();
    foreach ($data as $row) {
        if ($row['year_section'] === $course && $row['action_taken'] === 'Enrolled') {
            $studentsInCourse++;
        }
    }
    return ($studentsInCourse / $totalStudents) * 100;
}

$data = fetchDataFromDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Activity 7</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #0c0c0c, #222);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 5%;
        }

        .text-success {
            text-align: center;
        }

        .table {
            color: white;
        }

        .form-control {
            background: transparent;
            color: white;
            border: none;
            border-bottom: 2px solid #4287f5;
            border-radius: 0;
            padding: 15px 0;
            font-size: 18px;
        }

        .circular-image {
            width: 100px;
            height: 100px;
            border-radius: 100%;
            object-fit: cover;
            cursor: pointer;
        }

        .form-control::placeholder {
            color: #4287f5;
        }

        .btn-success {
            background: #02b875;
            border: none;
            border-radius: 5px;
            padding: 10px 20px; 
            font-size: 18px;
            cursor: pointer;
        }

        .btn-success:hover {
            background: #02855b;
        }

        .btn-danger {
            background: #b80202;
            border: none;
            border-radius: 5px;
            padding: 10px 20px; 
            font-size: 18px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background: #870202;
        }

        .form-group {
            text-align: center;
        }

        .navbar-nav li.nav-item:hover {
            background-color: #0c0c0c;
        }

        .navbar-nav li.nav-item:hover > .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu a:hover {
            background-color: #4287f5;
        }
        
        .navbar {
            background-color: #0c0c0c;
        }

        .navbar-brand, .nav-link {
            color: #4287f5;
        }

        .navbar-toggler {
            border-color: #4287f5;
        }

        .navbar-nav li.nav-item:hover .dropdown-menu {
            display: block;
        }

        .nav-item:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
        
        .sidebar {
            width: 15%;
            min-height: 100vh;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <h4>Enrollment Progress</h4>
            <div class="progress mt-4 mb-4">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo calculatePercentage('BSIT'); ?>%" aria-valuenow="<?php echo calculatePercentage('BSIT'); ?>" aria-valuemin="0" aria-valuemax="100">BSIT</div>
            </div>
            <div class="progress mb-4">
                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo calculatePercentage('BSGE'); ?>%" aria-valuenow="<?php echo calculatePercentage('BSGE'); ?>" aria-valuemin="0" aria-valuemax="100">BSGE</div>
            </div>
            <div class="progress mb-4">
                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo calculatePercentage('BSFT'); ?>%" aria-valuenow="<?php echo calculatePercentage('BSFT'); ?>" aria-valuemin="0" aria-valuemax="100">BSFT</div>
            </div>
        </div>
        <div style="width: 85%;">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0c0c0c;">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="history.php">History of BASC</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Courses
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="bsittable.php">BSIT</a>
                                <a class="dropdown-item" href="bsfttable.php">BSFT</a>
                                <a class="dropdown-item" href="bsgetable.php">BSGE</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <h1 class="text-center display-4 text-success">Laboratory Activity 7</h1>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-9">
                        <h2 class="text-center text-primary">Students</h2>
                        <div class="d-flex flex-wrap justify-content-center">
                            <?php
                            foreach ($data as $row) {
                                echo "<div class='m-3 text-center'>";
                                echo "<form action='view.php' method='post'>";
                                echo "<input type='hidden' name='id' value='{$row['id']}'>";
                                echo "<button type='submit' style='border:none; background:none; padding:0;'><img src='{$row['photo']}' class='circular-image' alt='Student Photo'></button>";
                                echo "</form>";
                                echo "<p>{$row['name']}</p>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="text-center text-warning">Add Students</h2>
                        <div class="table-responsive">
                            <form action="index.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="id">Course ID:</label>
                                    <input type="text" class="form-control" id="id" name="id" required>
                                </div>
                                <div class="form-group">
                                    <label for="coursename">Course Name:</label>
                                    <br>
                                    <br>
                                    <h4 class="text-center text-primary">BSIT SUBJECTS</h4>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="networkingII" name="coursename[]" value="Networking II">
                                        <label class="form-check-label" for="networkingII">Networking II</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="systemsIntegration" name="coursename[]" value="Systems Integration and Architecture">
                                        <label class="form-check-label" for="systemsIntegration">Systems Integration and Architecture</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="informationManagementI" name="coursename[]" value="Information Management I">
                                        <label class="form-check-label" for="informationManagementI">Information Management I</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="multimediaPublishing" name="coursename[]" value="Multimedia Publishing">
                                        <label class="form-check-label" for="multimediaPublishing">Multimedia Publishing</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="quantitativeMethods" name="coursename[]" value="Quantitative Methods">
                                        <label class="form-check-label" for="quantitativeMethods">Quantitative Methods</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="webSystemsTechnologies2" name="coursename[]" value="Web Systems and Technologies 2">
                                        <label class="form-check-label" for="webSystemsTechnologies2">Web Systems and Technologies 2</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="interactiveProgramming2" name="coursename[]" value="Interactive Programming and Technologies 2">
                                        <label class="form-check-label" for="interactiveProgramming2">Interactive Programming and Technologies 2</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="individualSports" name="coursename[]" value="Individual Sports">
                                        <label class="form-check-label" for="individualSports">Individual Sports</label>
                                    </div>
                                    <br>
                                    <h4 class="text-center text-primary">BSGE SUBJECTS</h4>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="theoryOfErrors" name="coursename[]" value="Theory of Errors and Adjustments">
                                        <label class="form-check-label" for="theoryOfErrors">Theory of Errors and Adjustments</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="satelliteGeodesy" name="coursename[]" value="Satellite Geodesy">
                                        <label class="form-check-label" for="satelliteGeodesy">Satellite Geodesy</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="geodeticSurveying" name="coursename[]" value="Geodetic Surveying">
                                        <label class="form-check-label" for="geodeticSurveying">Geodetic Surveying</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="landUsePlanning" name="coursename[]" value="Land Use Planning and Development">
                                        <label class="form-check-label" for="landUsePlanning">Land Use Planning and Development</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="engineeringMechanics" name="coursename[]" value="Enginering Mechanics 2 (Dynamics)">
                                        <label class="form-check-label" for="engineeringMechanics">Enginering Mechanics 2 (Dynamics)</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="engineeringEconomy" name="coursename[]" value="Engineering Economy">
                                        <label class="form-check-label" for="engineeringEconomy">Engineering Economy</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="principleOfGeography" name="coursename[]" value="Principle of Geography">
                                        <label class="form-check-label" for="principleOfGeography">Principle of Geography</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="artAppreciation" name="coursename[]" value="Art Appreciation">
                                        <label class="form-check-label" for="artAppreciation">Art Appreciation</label>
                                    </div>
                                    <br>
                                    <h4 class="text-center text-primary">BSFT SUBJECTS</h4>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="computerConcepts" name="coursename[]" value="Introduction to Computer Concepts and Application">
                                        <label class="form-check-label" for="computerConcepts">Introduction to Computer Concepts and Application</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="technicalWriting" name="coursename[]" value="Technical Writing">
                                        <label class="form-check-label" for="technicalWriting">Technical Writing</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="foodProcessing" name="coursename[]" value="Food Processing I">
                                        <label class="form-check-label" for="foodProcessing">Food Processing I</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="foodChemistry" name="coursename[]" value="Food Chemistry II">
                                        <label class="form-check-label" for="foodChemistry">Food Chemistry II</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="physicalEducation" name="coursename[]" value="Physical Education">
                                        <label class="form-check-label" for="physicalEducation">Physical Education</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="basicNutrition" name="coursename[]" value="Basic Nutrition">
                                        <label class="form-check-label" for="basicNutrition">Basic Nutrition</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="dairyScience" name="coursename[]" value="Dairy Science and Technology">
                                        <label class="form-check-label" for="dairyScience">Dairy Science and Technology</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="physicalChemistry" name="coursename[]" value="Physical Chemistry">
                                        <label class="form-check-label" for="physicalChemistry">Physical Chemistry</label>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label for="yrsec">Course:</label>
                                    <select class="form-control" id="yrsec" name="yrsec" required>
                                        <option value="BSIT">BSIT</option>
                                        <option value="BSGE">BSGE</option>
                                        <option value="BSFT">BSFT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="acttaken">Action Taken:</label>
                                    <select class="form-control" id="acttaken" name="acttaken" required>
                                        <option value="Enrolled">Enrolled</option>
                                        <option value="Dropped">Dropped</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo:</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Set Class
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="fas fa-times"></i> Clear Form
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
