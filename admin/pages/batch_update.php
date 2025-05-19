<?php 
include(__DIR__ . '/../controller/batch_update.php'); 
include(__DIR__ . '/../config/session_check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promote/Demote Students</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 20px;
            color: rgb(255, 255, 255);
        }

        .container {
            max-width: 800px;
            padding: 30px;
            border-radius: 10px;
            margin: auto;
            width: 50%;
            padding: 10px;
        }
        h2{
            margin-bottom: 20px;
            color:rgb(213, 238, 23);
            text-align: center;
        }
        h1,h3{
            margin-bottom: 20px;
            color:rgb(213, 238, 23);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: rgb(255, 255, 255);
        }

        input[type=text],
        input[type=number] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button[type=submit] {
            background-color: #238636;
            color: white;
            margin-right: 20px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
        }
        button[type=submit]:hover {
            background-color: #45a049;
        }
        #message {
            top: 0;
            right: 0;
            font-size: 1.2em;
            color: green;
            display: none;
            position: absolute;
        }

        .error-message {
            color: red;
        }
        .status {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Promote / Demote Students</h2>
        <?php if (!empty($message)): ?>
            <p id="message" class="status"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Promote / Demote by Roll Number -->
        <form action="" method="POST">
            <h3>By Roll Number</h3>
            <label for="roll">Enter Roll Number:</label>
            <input type="text" name="roll" id="roll" required>
            <button type="submit" name="promote_roll">Promote</button>
            <button type="submit" name="demote_roll">Demote</button>
        </form>
        
        <!-- Promote / Demote by Batch -->
        <form action="" method="POST">
            <h3>By Batch</h3>
            <label for="batch">Enter Batch Number:</label>
            <input type="number" name="batch" id="batch" required>
            <button type="submit" name="promote_batch">Promote</button>
            <button type="submit" name="demote_batch">Demote</button>
        </form>
    </div>
     <script>
        // Show message on page load
        const messageDiv = document.getElementById('message');
        if (messageDiv.innerHTML.trim() !== '') {
            messageDiv.style.display = 'block';
            
            // Assuming `message` is a variable that contains the message you want to alert
            const message = messageDiv.innerHTML.trim();  // Get the content of the div
            alert(`${message}`);  // Alert the content of the div
            
            // Fade out after 5 seconds
            setTimeout(function () {
                messageDiv.style.transition = 'opacity 1s';
                messageDiv.style.opacity = '0';
                
                setTimeout(function () {
                    messageDiv.style.display = 'none'; // Wait for the transition to complete and hide the element
                }, 1000); // Wait for the transition to complete
             }, 5000); // Wait for 5 seconds before starting fade out
        }
    </script>
</body>
</html>