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

  
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#doggos">
      <img src="https://i.postimg.cc/8PjFKtY9/doggo.png" class="fas fa-bed mr-2"></i>
    </a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#doggos">Dogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </nav>


  <section id="doggos" class="pt-2 mt-2">
    <div class="container mt-5">
      <div class="container">
        <h1 class="text-center pt-5" style="font-size:50px">Dog Sizes</h1>
      </div>
      <?php while ($size = mysqli_fetch_assoc($sizeResult)) { ?>
      <div class="container">
        <div class="row my-5">
          <h2 class="display-3 text-center" style=" font-size: 35px;">
            <?php echo $size['sizeName']; ?>
          </h2>
        </div>
        <div class="row" id="dogs">
          <?php
          $dogQuery = "SELECT breedName, description, image, backgroundColor FROM dogBreeds WHERE sizeID = {$size['sizeID']} LIMIT 4";
          $dogResult = mysqli_query($conn, $dogQuery);

          while ($dog = mysqli_fetch_assoc($dogResult)) {
          ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-green" style="background-color: <?php echo $dog['backgroundColor']; ?>;">
              <img class="card-img" src="<?php echo $dog['image']; ?>" alt="<?php echo $dog['breedName']; ?>">
              <div class="card-body">
                <h3 class="card-title">
                  <?php echo $dog['breedName']; ?>
                </h3>
                <p class=" desc">
                  <?php echo $dog['description']; ?>
                </p>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>

  <section id="contact" class="py-5">
    <div class="container">
      <h1 class="display-3 p-5" style="font-size: 50px; text-align: center;"><strong>Contact Us</strong></h1>
      <div class="row">
        <div class="col-md-6 mb-3">
          <h5><strong>Get in Touch</strong></h5>
          <p>Thank you for visiting my portfolio! If you have any questions about my projects, are interested in collaborating, or simply want to connect, feel free to reach out. I'd love to hear from you!</p>
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

  <footer class="text-center bg-dark py-3">
    <p>All rights reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    html{
      scroll-behavior: smooth;
    }
    body {
      padding-top: 0px; 
    }

    .navbar {
      padding: 10px 20px;
      background-color: #fff;
      top: 0;
      position: fixed;
      width: 100%;
      z-index: 1;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar img {
      height: 40px;
    }

    .card {
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      height: 100%;
      width: 100%;
      max-width: 450px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); 
    }

    .card-img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      border-radius: 20px 20px 0 0;
    }

    .card-title, .desc {
      color: #fafafa;
    }

    .form-control {
      border-radius: 25px;
      border: 1px solid #ccc;
      padding: 12px 20px;
    }

    .form-control:focus {
      border-color: #0081C8;
    }
  </style>

</body>

</html>
