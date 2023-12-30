<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/page.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Custom CSS for navbar -->
<style>
      .navbar {
        background:linear-gradient(45deg, blueviolet, deeppink); /* Change this color to your desired navbar color */
         padding: 10px;
      }

      .navlinks ul li a {
         color: #fff; /* Change this color to your desired text color */
      }

      
      </style>
  
</head>
<body>
<div> 
<div class="navbar">

<div class="navlinks">
    <ul>
    <li><a href="#">HOME</a></li>
            <li><a href="add.php">ADD CARD </a></li>
            <li><a href="view.php">CARD DETAILS</a></li>
            <li><a href="#">CONTACT</a></li>
            <li><a href="#">ABOUT</a></li>
    </ul>
</div>


</div>



</br></br></br></br>

<div class="container">
  
<?php

include "db-conn.php";

    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <!-- Search Form -->
    <form action="" method="GET" class="mb-3">
        <label for="search">Search by ID:</label>
        <input type="text" name="search" id="search" class="form-control" placeholder="Enter ID">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
      </form>

    <!-- Appointments Table -->
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">CARD NUMBER</th>
          <th scope="col">CARD HOLDER</th>
          <th scope="col">EXPIRATION MM</th>
          <th scope="col">EXPIRATION YY</th>
          <th scope="col">CVV</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        <?php
      // Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $search = isset($_GET["search"]) ? $_GET["search"] : '';
  $filterDate = isset($_GET["filterDate"]) ? $_GET["filterDate"] : '';

  if (!empty($filterDate)) {
    $sql = "SELECT * FROM payment WHERE date = '$filterDate'";
  } elseif (!empty($search)) {
    $sql = "SELECT * FROM payment WHERE holder LIKE '%$search%' OR id = '$search'";

  } else {
    $sql = "SELECT * FROM payment";
  }
}

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["number"] ?></td>
            <td><?php echo $row["holder"] ?></td>
            <td><?php echo $row["month"] ?></td>
            <td><?php echo $row["year"] ?></td>
            <td><?php echo $row["cvv"] ?></td>
            <td>
              <a href="update.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
              
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>

    <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>