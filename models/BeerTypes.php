<?php
  class BeerTypes{

    function getAll($mysqli){
      $query = "SELECT * FROM beer_types";
      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      $resultsArray = [];

      while($row = $result->fetch_assoc()) {
        $resultsArray[$row["id"]] = $row;
      }

      return $resultsArray;
    }
  }
?>
