<?php
session_start();
include('includes/config.php');

function sanitize_input($conn, $input) {
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($input)));
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_response']) && isset($_POST['survey_response'])) {
        $user_id = $_SESSION['userId']; // Replace with actual user ID retrieval logic
        
        foreach ($_POST['survey_response'] as $question_id => $response) {
            if (is_array($response)) {
                foreach ($response as $selected_option) {
                    $sanitized_response = sanitize_input($conn, $selected_option);
                    
                    // Insert the response into the survey_response table
                    $stmt = $conn->prepare("INSERT INTO survey_response (user_id, response_text) VALUES (?, ?)");
                    $stmt->bind_param("is", $user_id, $sanitized_response);
                    
                    if ($stmt->execute()) {
                        // Get the last inserted response_id
                        $response_id = $stmt->insert_id;
                        
                        // Insert the response_id and question_id into the survey table
                        $stmt_survey = $conn->prepare("INSERT INTO survey (response_id, question_id) VALUES (?, ?)");
                        $stmt_survey->bind_param("ii", $response_id, $question_id);
                        if (!$stmt_survey->execute()) {
                            echo "Error: " . $stmt_survey->error;
                        }
                        $stmt_survey->close();
                    } else {
                        echo "Error: " . $stmt->error;
                    }
        
                    $stmt->close();
                }
            } else {
                $sanitized_response = sanitize_input($conn, $response);
                
                // Insert the response into the survey_response table
                $stmt = $conn->prepare("INSERT INTO survey_response (user_id, response_text) VALUES (?, ?)");
                $stmt->bind_param("is", $user_id, $sanitized_response);
                
                if ($stmt->execute()) {
                    // Get the last inserted response_id
                    $response_id = $stmt->insert_id;
                    
                    // Insert the response_id and question_id into the survey table
                    $stmt_survey = $conn->prepare("INSERT INTO survey (response_id, question_id) VALUES (?, ?)");
                    $stmt_survey->bind_param("ii", $response_id, $question_id);
                    if (!$stmt_survey->execute()) {
                        echo "Error: " . $stmt_survey->error;
                    }
                    $stmt_survey->close();
                } else {
                    echo "Error: " . $stmt->error;
                }
    
                $stmt->close();
            }
        }
        echo "Responses saved successfully!";
        header('Location: home.php'); // Redirect to the home page
        exit(); // Ensure no further code is executed after redirection
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" conntent="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link rel="stylesheet" href="Homea.css">
    <style>
        /* Additional CSS for survey form styling */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background: url('images/background-form.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: white;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .question {
            margin-bottom: 20px;
        }
        .question h3 {
            margin-bottom: 10px;
            color: #555;
        }
        .rating label {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 12px;
            background: #e7e7e7;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .rating label:hover {
            background: #d4d4d4;
        }
        .rating input[type="checkbox"] {
            display: none;
        }
        .rating input[type="checkbox"]:checked + label {
            background: #007BFF;
            color: #fff;
        }
        .submit-button {
            text-align: center;
            margin-top: 20px;
        }
        .submit-button input[type="submit"] {
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .submit-button input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Survey</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="surveyForm">
        <div>
            <?php 
            $queryQ = mysqli_query($conn, "SELECT question_id, question_text FROM survey_question"); 
            if ($queryQ && $queryQ->num_rows > 0): 
                while ($row = mysqli_fetch_array($queryQ)): ?>
                    <div class="question">
                        <h3><?php echo htmlspecialchars($row['question_text']); ?></h3>
                        <div class="rating">
                            <input type="checkbox" id="q<?php echo $row['question_id']; ?>_1" name="survey_response[<?php echo $row['question_id']; ?>][]" value="1" onchange="toggleCheckbox(this)">
                            <label for="q<?php echo $row['question_id']; ?>_1">1 - Bad</label>

                            <input type="checkbox" id="q<?php echo $row['question_id']; ?>_2" name="survey_response[<?php echo $row['question_id']; ?>][]" value="2" onchange="toggleCheckbox(this)">
                            <label for="q<?php echo $row['question_id']; ?>_2">2</label>

                            <input type="checkbox" id="q<?php echo $row['question_id']; ?>_3" name="survey_response[<?php echo $row['question_id']; ?>][]" value="3" onchange="toggleCheckbox(this)">
                            <label for="q<?php echo $row['question_id']; ?>_3">3</label>

                            <input type="checkbox" id="q<?php echo $row['question_id']; ?>_4" name="survey_response[<?php echo $row['question_id']; ?>][]" value="4" onchange="toggleCheckbox(this)">
                            <label for="q<?php echo $row['question_id']; ?>_4">4</label>

                            <input type="checkbox" id="q<?php echo $row['question_id']; ?>_5" name="survey_response[<?php echo $row['question_id']; ?>][]" value="5" onchange="toggleCheckbox(this)">
                            <label for="q<?php echo $row['question_id']; ?>_5">5 - Good</label>
                        </div>
                    </div>
                <?php endwhile; ?>
                <div class="submit-button">
                    <input type="submit" name="submit_response" value="Submit">
                </div>
            <?php else: ?>
                <p>No questions found.</p>
            <?php endif; ?>  
        </div>
    </form>

    <script>
        // JavaScript for responsiveness and interaction
        window.addEventListener('load', function() {
            adjustFormLayout();
        });

        function adjustFormLayout() {
            var questions = document.querySelectorAll('.question');
            questions.forEach(function(question) {
                var ratingDiv = question.querySelector('.rating');
                if (ratingDiv) {
                    var checkboxes = ratingDiv.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            if (checkbox.checked) {
                                checkboxes.forEach(function(otherCheckbox) {
                                    if (otherCheckbox !== checkbox) {
                                        otherCheckbox.checked = false;
                                        otherCheckbox.nextElementSibling.style.background = '#e7e7e7';
                                        otherCheckbox.nextElementSibling.style.color = '#333';
                                    } else {
                                        checkbox.nextElementSibling.style.background = '#007BFF';
                                        checkbox.nextElementSibling.style.color = '#fff';
                                    }
                                });
                            }
                        });
                    });
                }
            });
        }

        function toggleCheckbox(checkbox) {
            var checkboxes = document.querySelectorAll('input[name="'+ checkbox.name +'"]');
            checkboxes.forEach(function(item) {
                if (item !== checkbox) item.checked = false;
            });
        }
    </script>
</body>
</html>
