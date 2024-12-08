<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Employee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f9f9f9, #e9ecef);
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start; /* Shift content to the top */
      padding-top: 30px; /* Adjust padding from the top */
    }

    .topnav {
      width: 100%;
      overflow: hidden;
      background-color: #e9e9e9;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .topnav a {
      float: left;
      display: block;
      color: black;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
      font-weight: 600;
    }

    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }

    .topnav a.active {
      background-color: #2196F3;
      color: white;
    }

    .topnav .search-container {
      float: right;
    }

    .topnav input[type=text] {
      padding: 6px;
      margin-top: 8px;
      font-size: 17px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .topnav .search-container button {
      float: right;
      padding: 6px 10px;
      margin-top: 8px;
      margin-right: 16px;
      background: #2196F3;
      color: white;
      font-size: 17px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .topnav .search-container button:hover {
      background: #1976D2;
    }

    @media screen and (max-width: 600px) {
      .topnav .search-container {
        float: none;
      }
      .topnav a, .topnav input[type=text], .topnav .search-container button {
        float: none;
        display: block;
        text-align: left;
        width: 100%;
        margin: 0;
        padding: 14px;
      }
      .topnav input[type=text] {
        border: 1px solid #ccc;  
      }
    }

    .content {
      margin-top: 20px; /* Reduced margin to align closer to the navbar */
      padding: 16px;
      background: #fff;
      width: 80%;
      max-width: 600px;
      border-radius: 12px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .content h2 {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }

    .content p {
      font-size: 16px;
      color: #555;
      margin-bottom: 20px;
    }

    .content .result {
      font-size: 14px;
      color: #333; /* Neutral color for the results */
      font-weight: normal; /* Removed emphasis styling */
      margin-top: 10px;
      text-align: left; /* Align results to the left */
    }
  </style>
</head>
<body>

<?php 
    include 'db_connect.php'; // Add db connection
?> 
<div class="topnav">
  <a class="active" href="#home">Search</a>
  <a href="/php/login.php">Login</a>
  <div class="search-container">
    <form action="/php/index.php" method="post">
      <input type="text" placeholder="Search for employee details" name="id">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<div class="content">
  <h2>Search Employee Details</h2>
  <p>Search for employee details using their IDs.</p>

  <div class="result">
    <?php
      if(isset($_POST['id'])) {
          $id1 = $_POST['id']; 
          $searchvalue = array(' ', '\'', '"', '/**/');
          $replacevalue = array('\\', '\\', '\\', '\\');
          $id = str_replace($searchvalue, $replacevalue, $id1);
          $sql = "SELECT * FROM employee_details WHERE employee_id = $id"; 
          $result = $conn->query($sql); 
          if ($result->num_rows > 0) { 
              while($row = $result->fetch_assoc()) { 
                  echo "<br>Employee ID: " . $row["employee_id"] . " - Name: " . $row["name"] . " - Position: " . $row["position"] . " - Hire Date: " . $row["hire_date"] . "<br>"; 
              } 
          } else {
              echo "No results found.";
          } 
      } 
      $conn->close();
    ?>
  </div>
</div>

</body>
</html>
