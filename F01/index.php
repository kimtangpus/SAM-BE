<?php
require_once 'connect.php';

$sizeQuery = "SELECT * FROM dogSize";
$sizeResult = mysqli_query($conn, $sizeQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Template</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Raleway", Arial, Helvetica, sans-serif;
    }
  </style>
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand text-danger" href="#"><i class="fas fa-bed mr-2"></i>Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#rooms">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-5">
    <?php while ($size = mysqli_fetch_assoc($sizeResult)) { ?>
      <div class="container">
        <h1 class="text-center">Dog Sizes</h1>
        <div class="row my-5">
          <h2 class="display-3 pt-5 text-center" style="color: #4A5043; font-size: 40px;"><?php echo $size['sizeName']; ?></h2>
        </div>
        <div class="row" id="dogs">
          <?php
          $dogQuery = "SELECT * FROM dogBreeds WHERE sizeID = {$size['sizeID']} LIMIT 4";
          $dogResult = mysqli_query($conn, $dogQuery);

          while ($dog = mysqli_fetch_assoc($dogResult)) {
          ?>
            <div class="col-md-3 mb-4">
              <div class="card">
                <img class="card-img-top" src="<?php echo $dog['image']; ?>" alt="<?php echo $dog['breedName']; ?>" style="height: 200px; object-fit: cover;">
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

  <div class="container">
    <h1 class="display-3 pb-5" style="font-size: 50px; text-align: center;">Contact Us</h1>
    <div class="row">
      <div class="col-md-6 mb-3">
        <h5><strong>Get in Touch</strong></h5>
        <p>Thank you for visiting my portfolio! If you have any questions about my
          projects, are interested in collaborating, or simply want to connect, feel free to reach out.
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
            <textarea class="form-control" id="message" rows="5" placeholder="Your message"
              required></textarea>
          </div>
          <div class="m-3">
            <button type="submit" class="btn">Send
              Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Footer -->
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

</html>