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
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Athiti:wght@200;300;400;500;600;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand" href="#home">
      <img src="https://i.postimg.cc/8PjFKtY9/doggo.png" class="fas fa-bed mr-2"></i>
    </a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span style="color: #FFFFFF;"><i class="fa-solid fa-bars"></i></span>
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

  <section class="home" id="home">
    <div class="container-fluid">
      <div class="row align-items-center px-5">

        <div class="col-md-6 pb-5">
          <h1 class="display-4"><span style=" color: #0078D0;">Welcome to Woofopedia</span></h1>
          <p class="lead"><span style=" color: #00A651;">Discover and learn about your favorite dog breeds</span></p>
          <a href="#doggos" class="btn btn-lg btn-light ">Explore</a>
        </div>

        <div class="col-md-6">
          <img src="https://i.postimg.cc/FHFQcVwG/dogs.jpg" class="img-fluid img-border rounded-5" alt="Dogs" />
        </div>
      </div>
    </div>
  </section>




  <section id="doggos" class="py-2 mt-2">
    <div class="container mt-5">
      <div class="container">
        <h1 class="text-center pt-5" style="font-size:50px; color: #0078D0;">Dog Sizes</h1>
      </div>
      <?php while ($size = mysqli_fetch_assoc($sizeResult)) { ?>
      <div class="container">
        <div class="row my-5">
          <h2 class="display-3 text-center w-100" style="font-size: 35px; color: #F0282D;">
            <?php echo $size['sizeName']; ?>
          </h2>
        </div>
        <div class="row" id="dogs">
          <?php
          $dogQuery = "SELECT breedName, description, image, backgroundColor, shortDescription FROM dogBreeds WHERE sizeID = {$size['sizeID']} LIMIT 4";
          $dogResult = mysqli_query($conn, $dogQuery);

          while ($dog = mysqli_fetch_assoc($dogResult)) {
          ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-green" style="background-color: <?php echo $dog['backgroundColor']; ?>;">
              <img class="card-img" src="<?php echo $dog['image']; ?>" alt="<?php echo $dog['breedName']; ?>">
              <div class="card-body">
                <h3 class="card-title pb-2">
                  <?php echo $dog['breedName']; ?>
                </h3>
                <p class="desc pb-3">
                  <?php echo $dog['description']; ?>
                </p>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                  data-target="#dogModal<?php echo str_replace(' ', '', $dog['breedName']); ?>">
                  View More
                </button>
              </div>
            </div>
          </div>

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
                  <div class="modal-body">


                    <p><strong>Quick Info:</strong>
                      <?php echo $dog['shortDescription']; ?>
                    </p>
                  </div>
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

  <section id="contact" class="py-2 mt-2">
    <div class="container">
      <h1 class="display-3 p-5" style="font-size: 50px; text-align: center; color: #0078D0;">
        <strong>Contact Woofopedia</strong>
      </h1>
      <div class="row">
        <div class="col-md-6 mb-3">
          <h5 style="color: #F0282D;"><strong>Get in Touch</strong></h5>
          <p>
            Thank you for visiting Woofopedia! If you have any questions about dog breeds, need assistance with dog care
            information, or want to collaborate on a project, feel free to reach out. We'd love to hear from you and are
            always excited to help with anything dog-related!
          </p>
          <p style="color: #00A651;"><strong>Email:</strong> woofopedia@gmail.com</p>
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
    <p style="color: #FFB114;">All rights reserved.</p>
  </footer>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    html {
      scroll-behavior: smooth;
      font-family: 'Roboto', sans-serif;
    }

    body {
      padding-top: 0px;
    }

    .navbar {
      padding: 10px 20px;
      background-color: #000000;
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
      color: #FFB114;
      font-size: 20px;
      transition: color 0.3s ease, background-color 0.3s ease;
    }

    .nav-link:hover {
      background-color: #F0282D;
      border-radius: 5px;
    }


    .home {
      padding: 100px 0;
      background-color: #FFFFFF;
    }

    .home h1 {
      font-size: 3rem;
      font-weight: bold;
      color: #333;
    }

    .home p {
      font-size: 1.2rem;
      color: #666;
    }

    .home img {
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .img-border {
      border: 5px solid #0078D0;
    }

    .text h1 {
      font-size: 80px;
    }

    .text p {
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

    .card-title {
      color: #FFFFFF;
      font-size: 24px;
      font-weight: bold;
    }


    .desc {
      color: #FFFFFF;
      font-size: 16px;
    }

    .btn {
      background-color: #FFB114;
      color: #000000;
      border-radius: 20px;
      border: none;
      transition: background-color 0.3s ease;
    }

    section {
    background-color: #ffffff; 
    border: 1px solid #ccc;
    padding: 20px;  
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
    border-radius: 10px;  

    }

    .btn:hover {
      background-color: #F0282D;

    }

    .modal-content {
      border-radius: 20px;
      background-color: #0078D0;
      color: #FFFFFF;
    }


    .modal-header {
      border-bottom: none;
      background-color: #0078D0;
      color: #FFFFFF;
    }

    .modal-title {
      color: #FFFFFF;
    }


    .modal-footer {
      background-color: #0078D0;
      border-top: none;
    }


    .close {
      color: #FFFFFF;
      opacity: 1;
    }


    .btn-secondary {
      background-color: #FFB114;
      color: #000000;
      border-radius: 20px;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #F0282D;
      color: #FFFFFF;
    }

    .modal-body {
      color: #FFFFFF;
    }


    #contact .btn:hover {
      background-color: #F0282D;

    }

    .form-control {
      border-radius: 20px;
    }

    footer {
      background-color: #000000;
      color: #FFB114;

    }
  </style>
</body>

</html>