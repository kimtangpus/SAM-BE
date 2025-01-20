<?php
require_once 'connect.php';

$sizeQuery = "SELECT * FROM dogSize";
$sizeResult = mysqli_query($conn, $sizeQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Woofopedia</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" href="https://i.postimg.cc/FHxQjQZ4/doggo.png">
</head>

<body class="bg-white">

  <nav class="navbar navbar-expand-lg fixed">
    <a class="navbar-brand text-danger" href="#doggos"><img src="https://i.postimg.cc/8PjFKtY9/doggo.png" class="fas fa-bed mr-2"></i></a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end text-right" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-blue" href="#doggos">Dogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-yellow" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <section id="doggos">
    <div class="container mt-5">
    <div class="container">
        <h1 class="text-center pt-5 text-black">Dog Sizes</h1>
      </div>
      <?php while ($size = mysqli_fetch_assoc($sizeResult)) { ?>
        <div class="container">
          <div class="row my-5">
            <h2 class="display-3 text-center" style="color: #4A5043; font-size: 40px;"><?php echo $size['sizeName']; ?></h2>
          </div>
          <div class="row" id="dogs">
  <?php
  $dogQuery = "SELECT * FROM dogBreeds WHERE sizeID = {$size['sizeID']} LIMIT 4";
  $dogResult = mysqli_query($conn, $dogQuery);

  while ($dog = mysqli_fetch_assoc($dogResult)) {
  ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4"> <!-- Responsive column setup -->
      <div class="card border-green">
        <img class="card-img" src="<?php echo $dog['image']; ?>" alt="<?php echo $dog['breedName']; ?>">
        <div class="card-body">
          <h3 class="card-title"><?php echo $dog['breedName']; ?></h3>
          <p class="text-muted"><?php echo $dog['description']; ?></p>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

        </div>
      <?php } ?>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <h1 class="display-3 p-5 text-red" style="font-size: 50px; text-align: center;">Contact Us</h1>
      <div class="row">
        <div class="col-md-6 mb-3">
          <h5><strong>Get in Touch</strong></h5>
          <p>Thank you for visiting my portfolio! If you have any questions about my projects, are interested in collaborating, or simply want to connect, feel free to reach out.
            I'd love to hear from you!</p>
          <p><strong>Email:</strong> kimtangpus@gmail.com</p>
          <p><strong>Phone:</strong> +63615491117</p>
          <p><strong>Address:</strong> Tanauan City, Batangas</p>
        </div>
        <div class="col-md-6">
          <form>
            <div class="m-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
            </div>
            <div class="m-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="m-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="5" placeholder="Your message" required></textarea>
            </div>
            <div class="m-3">
              <button type="submit" class="btn text-black" style="background-color: black">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center text-white bg-dark py-4">
    <h5>Find Us On</h5>
    <div class="mb-3">
      <a href="#" class="text-white mx-2"><i class="fab fa-facebook"></i></a>
      <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
      <a href="#" class="text-white mx-2"><i class="fab fa-linkedin"></i></a>
    </div>
    <p>Powered by Bootstrap</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<style>
  html {
    scroll-behavior: smooth;
  }

  body {
    font-family: "Raleway", Arial, Helvetica, sans-serif;
  }

  .navbar {
  padding: 10px 20px; 
  background-color: #fff;
  top: 0;
  position: fixed;
  width: 100%;
  z-index: 1;
  font-size: 20px;
}

.navbar img {
  height: 40px; 
}

@media (max-width: 576px) {
  .navbar {
    font-size: 16px; 
  }
}

.card {
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  height: 100%; 
  width: 100%;  
  max-width: 250px; 
}

.card-img {
  width: auto;
  height: 350px; 
  object-fit: cover;
  border-radius: 20px 20px 0 0;
}

@media (max-width: 768px) {
  .card {
    max-width: 200px; 
  }
}

@media (max-width: 576px) {
  .card {
    max-width: 100%; 
  }
}

@media (max-width: 768px) {
  .card-img {
    height: 250px; 
  }
}

@media (max-width: 576px) {
  .card-img {
    height: 200px;
  }
}


</style>

</html>
