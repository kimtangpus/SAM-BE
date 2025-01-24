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
    <a class="navbar-brand" href="#home">
      <img src="https://i.postimg.cc/8PjFKtY9/doggo.png" class="fas fa-bed mr-2"></i>
    </a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#doggos">Dogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <section id="home">
    <div class="text">
      <h1>Welcome to Woofopedia</h1>
      <p>Discover the world of dogs</p>
      <a href="#doggos" class="btn btn-lg btn-light">Explore</a>
    </div>
  </section>


  <section id="doggos" class="pt-2 mt-2">
    <div class="container mt-5">
      <div class="container">
        <h1 class="text-center pt-5" style="font-size:50px; color: #00A3E0;">Dog Sizes</h1>
      </div>
      <?php while ($size = mysqli_fetch_assoc($sizeResult)) { ?>
      <div class="container">
        <div class="row my-5">
          <h2 class="display-3 text-center w-100" style="font-size: 35px; color: #D50032;">
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
                <p class="desc">
                  <?php echo $dog['description']; ?>
                </p>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                  data-target="#dogModal<?php echo str_replace(' ', '', $dog['breedName']); ?>">
                  View More
                </button>
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="dogModal<?php echo str_replace(' ', '', $dog['breedName']); ?>" tabindex="-1"
            aria-labelledby="dogModalLabel<?php echo str_replace(' ', '', $dog['breedName']); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dogModalLabel<?php echo str_replace(' ', '', $dog['breedName']); ?>">
                    <?php echo $dog['breedName']; ?>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img class="img-fluid" src="<?php echo $dog['image']; ?>" alt="<?php echo $dog['breedName']; ?>">
                  <p class="mt-2">
                    <?php echo $dog['description']; ?>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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
      <h1 class="display-3 p-5" style="font-size: 50px; text-align: center; color: #0081C8;">
        <strong>Contact Woofopedia</strong>
      </h1>
      <div class="row">
        <div class="col-md-6 mb-3">
          <h5 style="color: #EE334E;"><strong>Get in Touch</strong></h5>
          <p>
            Thank you for visiting Woofopedia! If you have any questions about dog breeds, need assistance with dog care
            information, or want to collaborate on a project, feel free to reach out. We'd love to hear from you and are
            always excited to help with anything dog-related!
          </p>
          <p style="color: #00A651;"><strong>Email:</strong> woofopedia@example.com</p>
          <p style="color: #00A651;"><strong>Phone:</strong> +63 915 491 1117</p>
          <p style="color: #00A651;"><strong>Address:</strong> Tanauan City, Batangas</p>
        </div>
        <div class="col-md-6">
          <form>
            <div class="m-3">
              <label for="name" class="form-label" style="color: #000000;">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
            </div>
            <div class="m-3">
              <label for="email" class="form-label" style="color: #000000;">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="m-3">
              <label for="message" class="form-label" style="color: #000000;">Message</label>
              <textarea class="form-control" id="message" rows="5" placeholder="Your message" required></textarea>
            </div>
            <div class="m-3">
              <button type="submit" class="btn">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center py-3" style="background-color: #000000;">
    <p style="color: #F4C300;">All rights reserved.</p>
  </footer>

  <!-- Ensure proper order of scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    html {
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
      z-index: 1000;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar img {
      height: 40px;
    }

    .nav-link {
      color: #3E3E3E;
      font-size: 20px;
      transition: color 0.3s ease, background-color 0.3s ease;
    }

    .nav-link:hover {
      color: #ffffff;
      background-color: #00A3E0;
      border-radius: 5px;
    }

    #home{
      background: url('https://i.postimg.cc/yxLbQgKK/dogs.png'); 
      background-repeat: no-repeat;
      background-position: center; 
      background-size: 1000px 600px;
      background-color: #F4C300;
      height: 100vh; 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      color: white; 
      text-align: center;">
    }
    .text h1{
      font-size: 80px;
    }
    .text p{
      font-size: 40px;
    }

    .card {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
      height: 100%;
    }

    .card-body {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-img {
      border-radius: 20px 20px 0 0;
      height: 200px;
      object-fit: cover;
    }

    .card:hover {
      transform: scale(1.05);
    }


    .desc {
      color: #3E3E3E;
      font-size: 16px;
    }

    .btn {
      background-color: #00A3E0;
      border-radius: 20px;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #D50032;
      /* Red */
    }

    .modal-content {
      border-radius: 20px;
    }

    #contact .btn {

      color: #000000;
      background-color: #F4C300;
    }

    #contact .btn:hover {
      background-color: #D50032;
      /* Red */
    }

    .form-control {
      border-radius: 20px;
    }

    footer {
      background-color: #1C1C1E;
      color: #F6EB61;
      /* Yellow text for footer */
    }
  </style>
</body>

</html>