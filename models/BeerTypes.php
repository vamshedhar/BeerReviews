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

    function add($mysqli, $post){

      $name = $post['name'];
      $description = $post['description'];

      $query = "INSERT INTO beer_types SET name='$name', description='$description'";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }

    function update($mysqli, $post){

      $id = $post['id'];
      $name = $post['name'];
      $description = $post['description'];

      $query = "UPDATE beer_types SET name='$name', description='$description' WHERE id=$id";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }

    function delete($mysqli, $id){

      $query = "DELETE FROM beer_types WHERE id=$id";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }
  }
?>
