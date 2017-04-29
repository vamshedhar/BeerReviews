<?php
  class Beers{

    function getAll($mysqli, $type){

      $filterString = "";
      if(isset($type)){
        $filterString = " WHERE B.type_id=$type ";
      }

      $query = "SELECT
        B.*,
        COALESCE(AVG(BR.rating), 0) as rating,
        COALESCE(COUNT(BR.id), 0) as total_reviews
      FROM
        beers B
      LEFT JOIN
        beer_reviews BR
      ON
        BR.beer = B.id
      ".$filterString."
      GROUP BY
        B.id";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      $resultsArray = [];

      while($row = $result->fetch_assoc()) {
        $resultsArray[$row["id"]] = $row;
      }

      return $resultsArray;
    }

    function add($mysqli, $post){

      $name = $post['name'];
      $brewery = $post['brewery'];
      $type = $post['type'];
      $color = $post['color'];
      $smell = $post['smell'];
      $taste = $post['taste'];
      $description = $post['description'];

      $query = "INSERT INTO beers SET name='$name', brewery='$brewery', type_id='$type', color='$color', smell='$smell', taste='$taste', description='$description'";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }

    function update($mysqli, $post){

      $id = $post['id'];
      $name = $post['name'];
      $brewery = $post['brewery'];
      $type = $post['type'];
      $color = $post['color'];
      $smell = $post['smell'];
      $taste = $post['taste'];
      $description = $post['description'];

      $query = "UPDATE beers SET name='$name', brewery='$brewery', type_id='$type', color='$color', smell='$smell', taste='$taste', description='$description' WHERE id=$id";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }

    function delete($mysqli, $id){

      $query = "DELETE FROM beers WHERE id=$id";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }
  }
?>
