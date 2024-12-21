<?php
include("connect.php");

$islands = []; 


$query = "
    SELECT 
        islandsofpersonality.islandOfPersonalityID, 
        islandsofpersonality.name AS personalityName, 
        islandsofpersonality.shortDescription, 
        islandsofpersonality.longDescription, 
        islandsofpersonality.color AS personalityColor, 
        islandsofpersonality.image AS personalityImage, 
        islandsofpersonality.status, 
        islandcontents.islandContentID, 
        islandcontents.image AS contentImage, 
        islandcontents.content, 
        islandcontents.color AS contentColor
    FROM 
        islandsofpersonality
    INNER JOIN 
        islandcontents
    ON 
        islandsofpersonality.islandOfPersonalityID = islandcontents.islandOfPersonalityID
    ORDER BY islandsofpersonality.islandOfPersonalityID
";

$result = $conn->query($query);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $islands[$row['islandOfPersonalityID']]['personality'] = array(
            'name' => htmlspecialchars($row['personalityName']), 
            'image' => htmlspecialchars($row['personalityImage']),
            'shortDescription' => htmlspecialchars($row['shortDescription'])
        );
        $islands[$row['islandOfPersonalityID']]['contents'][] = array(
            'contentImage' => htmlspecialchars($row['contentImage']),
            'content' => htmlspecialchars($row['content'])
        );
    }
} else {
    echo "No results found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Personalities</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">

</head>
<body>

<nav class="navbar navbar-light fixed-top">
  <div class="container">
    <span class="navbar-brand mx-auto">My Personalities</span>
  </div>
</nav>

<div class="container" style="margin-top: 100px;">
  <h1 class="text-center">Explore My Personalities</h1>

  <?php $set = 0; ?>
  <?php foreach ($islands as $islandID => $islandData): ?>
    <?php if ($set >= 4) break; ?>
    
    
    <div class="row justify-content-center mb-4">
      <div class="col-md-8">
        
        <h3 class="text-center"><?php echo $islandData['personality']['name']; ?></h3>
        <p class="text-center"><?php echo $islandData['personality']['shortDescription']; ?></p>
        <img src="<?php echo $islandData['personality']['image']; ?>" alt="<?php echo $islandData['personality']['name']; ?>" class="img-fluid rounded pt-5">
      </div>
    </div>

    
    <div class="row justify-content-center">
      <?php foreach ($islandData['contents'] as $index => $content): ?>
        <?php if ($index >= 3) break; ?>
        <div class="col-md-4">
          <div class="content-card">
            <img src="<?php echo $content['contentImage']; ?>" alt="<?php echo $content['content']; ?>" class="card-img-top">
            <div class="card-body">
              <p><?php echo $content['content']; ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <?php $set++; ?>
  <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    body, h1, h2, h3, h4, h5, h6 {
      font-family: "Karma", sans-serif;
    }

    .content-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      height: 400px;
      margin-bottom: 20px;
    }

    .card-img-top, .content-card img {
      height: 300px;
      width: 100%;
      object-fit: cover;
    }

    .content-card p {
      font-size: 14px;
      color: #555;
      text-align: center;
      padding-top: 20px;
    }

    h3 {
      font-size: 40px;
      padding-top: 50px;
    }

    .navbar {
      background-color: #0f3d56;
      color: white;
    }

    .navbar-brand {
      font-weight: bold;
    }
  </style>
</body>
</html>
