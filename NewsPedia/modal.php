<script>
        // Get the modal
        var modal = document.getElementById("surveyModal");

        // Get the button that opens the modal
        var btn = document.getElementById("surveyButton");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Get the button that says No
        var noBtn = document.getElementById("noButton");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on No button or the close button, close the modal
        noBtn.onclick = function() {
            modal.style.display = "none";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Check if user is logged in when clicking Yes button
        function handleSurveyClick() {
            // Check if user is logged in (you can adjust this condition as per your session variable structure)
            <?php if(isset($_SESSION['userId'])) { ?>
                // Redirect to survey.php if logged in
                window.location.href = "survey.php";
            <?php } else { ?>
                // Display message and redirect to login page if not logged in
                alert("You need to be logged in to participate in our survey.");
                window.location.href = "admin/"; // Adjust this URL to your login page
            <?php } ?>
        }
    </script>

<style>
        /* Additional CSS for survey modal styling */
        
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-content button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .modal-content button:hover {
            background-color: #0056b3;
        }
        /* .nav-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        } */
        .nav-button:hover {
            background-color: #0056b3;
        }
    </style>