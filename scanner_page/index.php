<?php
// Start PHP session if needed
session_start();
$data = [
  [ "img" => "3.jpg",  "quote" => "Books are a uniquely portable magic. – Stephen King" ],
  [ "img" => "5.jpg",  "quote" => "Reading is essential for those who seek to rise above the ordinary. – Jim Rohn" ],
  [ "img" => "6.jpg",  "quote" => "A room without books is like a body without a soul. – Cicero" ],
  [ "img" => "7.jpg",  "quote" => "The library is inhabited by spirits that come out of the pages at night. – Isabel Allende" ],
  [ "img" => "8.jpg",  "quote" => "Libraries were full of ideas – perhaps the most dangerous and powerful of all weapons. – Sarah J. Maas" ],
  [ "img" => "9.jpg",  "quote" => "When in doubt go to the library. – J.K. Rowling" ],
  [ "img" => "10.jpg", "quote" => "So many books, so little time. – Frank Zappa" ],
  [ "img" => "11.jpg", "quote" => "The more that you read, the more things you will know. – Dr. Seuss" ],
  [ "img" => "12.jpg", "quote" => "Libraries store the energy that fuels the imagination. – Sidney Sheldon" ],
  [ "img" => "13.jpg", "quote" => "You can never get a cup of tea large enough or a book long enough to suit me. – C.S. Lewis" ],
  [ "img" => "14.jpg", "quote" => "A library is a hospital for the mind. – Anonymous" ],
  [ "img" => "15.jpg", "quote" => "Libraries will get you through times of no money better than money will get you through times of no libraries. – Anne Herbert" ],
  [ "img" => "16.jpg", "quote" => "The only true equalisers in the world are books; the only treasure-house open to all comers is a library. – John Lubbock" ],
  [ "img" => "17.jpg", "quote" => "Books are mirrors: you only see in them what you already have inside you. – Carlos Ruiz Zafón" ],
  [ "img" => "18.jpg", "quote" => "In the nonstop tsunami of global information, librarians provide us with floaties and teach us to swim. – Linton Weeks" ],
  [ "img" => "19.jpg", "quote" => "Libraries are the wardrobes of literature. – George Dyer" ],
  [ "img" => "21.jpg", "quote" => "Reading is to the mind what exercise is to the body. – Joseph Addison" ],
  [ "img" => "22.jpg", "quote" => "Books wash away from the soul the dust of everyday life. – Unknown" ],
  [ "img" => "23.jpg", "quote" => "The library is not just a place, it’s a gateway to infinite worlds. – Anonymous" ],
  [ "img" => "24.jpg", "quote" => "A great library contains the diary of the human race. – George Mercer Dawson" ],
  [ "img" => "25.jpg", "quote" => "Libraries change lives. They are places of learning, growth, and transformation. – Anonymous" ],
  [ "img" => "26.jpg", "quote" => "With freedom, books, flowers, and the moon, who could not be happy? – Oscar Wilde" ]
]

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Portal</title>
    <link rel="stylesheet" href="index.css">
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
                        messageBox.style.display = "flex";
                        messageBox.style.animation = "show2 ease-in-out 1s";
                        messageBox.style.color = (data.status === "success") ? "rgb(255, 183, 0)" :"aqua" ;
                        interval = setTimeout(() => {
                            messageBox.innerHTML = "";
                            messageBox.style.display = "none";
                            messageBox.style.animation = "none";
                        }, 2000); // Clear message after 2 seconds
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


   <!-- Message Box for displaying messages -->
   <div class="status">
     <div id="messageBox"> heloo</div>
   </div>

  <div class="slider">
     <div class="list">
       <div class="item active">
          <img src="./assets/fwdphotos/2.jpg" alt="Image 1">
          <div class="content">
            <p>Quote</p>
            <p>A library is not a luxury but one of the necessities of life. – Henry Ward Beecher</p>
          </div>
       </div>
       <?php 
         foreach ($data as $item) {
           echo '<div class="item">
                   <img src="./assets/fwdphotos/' . $item["img"] . '" alt="Image 1">
                   <div class="content">
                     <p>Quote</p>
                     <p>' . $item["quote"] . '</p>
                   </div>
                 </div>';
         }
       
       ?>
       </div>
     </div>

     <div class="arrows">
        <button id="prev"><</button>
        <button id="next">></button>
     </div>

     <div class="thumbnail">

           <div class="scan">
             <form id="attendanceForm" action="process.php" method="POST">
                  <input type="text" name="number" id="number" placeholder="Enter your Roll Number" required autocomplete="off">
                  <button type="submit">Submit</button>
             </form>
           </div>

           <div class="stat"> 
               <div class="sd1">
                  <img src="" >
               </div>
               <div class="sd2">
                  <img src="">
               </div>
               <div class="sd3">
                  <img src="">
               </div>
           </div>

     </div>
  </div>

    <script src="index.js"></script>

</body>

</html>