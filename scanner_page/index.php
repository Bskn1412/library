<?php
// Start PHP session if needed
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Portal</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="index.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("attendanceForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent default form submission

                let formData = new FormData(this);

                fetch("process.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        let messageBox = document.getElementById("messageBox");
                        messageBox.innerHTML = data.message;
                        messageBox.style.color = (data.status === "success") ? "green" : "red";
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>

</head>

<body>

      <header>
    <div class="logo">Library</div>
    <ul class="menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="info.html">Info</a></li>
    </ul>
  </header>
  <div class="slider">
     <div class="list">
       <div class="item active">
          <img src="marvel-1.webp" alt="Image 1">
          <div class="content">
            <p>Game</p>
            <h2>Future Revolution</h2>
            <p>Marvel Future Revolution is an action role-playing game developed by Netmarble Monster and published by Netmarble.</p>
          </div>
       </div>
       <div class="item">
          <img src="marvel-2.webp" alt="Image 1">
          <div class="content">
            <p>Game</p>
            <h2>Heros Omega</h2>
            <p>Marvel Heroes Omega is not a movie but a video game developed by Gazillion Entertainment and Secret Identity Studios.</p>
          </div>
       </div>       
       <div class="item">
          <img src="marvel-3.jpg" alt="Image 1">
          <div class="content">
            <p>Character</p>
            <h2>Bloodpool</h2>
            <p>Brother Blood filled the pool with the blood of human sacrifices and regularly bathed in it in order to replenish his strength and vitality. Blood's son, the first Brother Blood born in the 20th Century, succeeded to the rank of cult leader by fighting .</p>
          </div>
       </div>       
       <div class="item">
          <img src="marvel-4.jpg" alt="Image 1">
          <div class="content">
            <p>Character</p>
            <h2>Iron Man</h2>
            <p>In the Marvel Cinematic Universe (MCU), Iron Man's origin story is adapted into a film. The movie, directed by Jon Favreau, stars Robert Downey Jr. as Tony Stark. In the film, Stark is kidnapped by a terrorist organization in Afghanistan and builds a high-tech suit of armor to escape.</p>
          </div>
       </div>
     </div>

     <div class="arrows">
        <button id="prev"><</button>
        <button id="next">></button>
     </div>

     <div class="thumbnail">

           <div class="scan">
            <div id="messageBox"></div>
             <form id="attendanceForm" action="process.php" method="POST">
                  <input type="text" name="number" id="number" placeholder="Enter your Roll Number" required>
                  <button type="submit">Submit</button>
             </form>
           </div>

           
           <div class="item active">
            <img src="marvel-1.webp" alt="">
            <div class="content">
               Game
            </div>
           </div>
           <div class="item">
            <img src="marvel-2.webp" alt="">
            <div class="content">
               Game
            </div>
           </div>
           <div class="item">
            <img src="marvel-3.jpg" alt="">
            <div class="content">
               Deadpool
            </div>
           </div>
           <div class="item">
            <img src="marvel-4.jpg" alt="">
            <div class="content">
               Iron Man
            </div>
           </div>
     </div>
  </div>

    <script src="index.js"></script>

</body>

</html>