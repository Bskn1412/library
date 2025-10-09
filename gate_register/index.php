<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gate Register</title>
  <link rel="stylesheet" href="main.css" />
</head>
<body>
  <!-- Navigation -->
  <nav id="menu">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="studentstatus.php">Student Status</a></li>
      <li><a href="facultystatus.php">Faculty Status</a></li>
      <li><a href="datepick.php">Day Wise Details</a></li>
      <li><a href="bdetails.php">Branch Wise Details</a></li>
      <li><a href="status.php">Statistics</a></li>
    </ul>
  </nav>

  <!-- Header -->
  <header id="head">
    <h1>Automatic Library Visitors Counter</h1>
  </header>

  <!-- Hero Section -->
   <div class="hero-image">
    <img src="images/gate.png" alt="Gate Image" />
  </div>

 <div class="hero">
  <div class="team-slider">
    <div class="slide developed active">
      <h2>Developed By</h2>
      <p>P. Pavan Kumar</p>
      <p>A. Asif</p>
      <p>K. Balaji</p>
      <p>P. Mounika</p>
      <p>V. L. Prathyusha</p>
    </div>

    <div class="slide upgraded">
      <h2>Upgraded By</h2>
      <p class="pp">B. Syam</p>
      <p class="pp">A. Yaswanth Kiran</p>
      <p class="pp">B. Sai Karthik Nehru</p>
    </div>
  </div>

</div>


  <footer>
    <p>© 2025 Automatic Library Visitors Counter</p>
  </footer>

  <script>
  const slides = document.querySelectorAll('.team-slider .slide');
  let current = 0;

  setInterval(() => {
    const currentSlide = slides[current];
    const nextSlide = slides[(current + 1) % slides.length];

    currentSlide.classList.remove('active');
    currentSlide.classList.add('exit');

    nextSlide.classList.add('active');

    setTimeout(() => {
      currentSlide.classList.remove('exit');
      nextSlide.classList.remove('exit');
      current = (current + 1) % slides.length;
    }, 1000); // match the CSS transition duration
  }, 4000); // change every 4 seconds
</script>


</body>
</html>
