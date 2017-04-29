<?php
  class Breweries{

    function getAll($mysqli){

      $query = "SELECT
          B.*,
          COALESCE(AVG(BR.rating), 0) as rating,
          COALESCE(COUNT(BR.id), 0) as total_reviews
        FROM
          brewery B
        LEFT JOIN
          brewery_reviews BR
        ON
          BR.brewery = B.id
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
      $street = $post['street'];
      $city = $post['city'];
      $state = $post['state'];
      $pincode = $post['pincode'];
      $description = $post['description'];

      $query = "INSERT INTO brewery SET name='$name', street='$street', city='$city', state='$state', pincode='$pincode', description='$description'";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }

    function update($mysqli, $post){

      $id = $post['id'];
      $name = $post['name'];
      $street = $post['street'];
      $city = $post['city'];
      $state = $post['state'];
      $pincode = $post['pincode'];
      $description = $post['description'];

      $query = "UPDATE brewery SET name='$name', street='$street', city='$city', state='$state', pincode='$pincode', description='$description' WHERE id=$id";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }

    function delete($mysqli, $id){

      $query = "DELETE FROM brewery WHERE id=$id";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }
  }
?>
