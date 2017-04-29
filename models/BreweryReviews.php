<?php
  class BreweryReviews{

    function getAll($mysqli, $brewery_id){
      $query = "SELECT
          BR.id,
          BR.brewery,
          BR.review,
          BR.rating,
          BR.date,
          U.first_name,
          U.last_name
      FROM
          brewery_reviews BR
      LEFT JOIN
          user U
      ON
          BR.user = U.username
      WHERE
          BR.brewery = $brewery_id
      ORDER BY
        BR.date DESC";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      $resultsArray = [];

      while($row = $result->fetch_assoc()) {
        $resultsArray[$row["id"]] = $row;
      }

      return $resultsArray;
    }

    function addReview($mysqli, $brewery_id, $review, $rating){

      $review = $mysqli->real_escape_string($review);
      $rating = $mysqli->real_escape_string($rating);

      $query = "INSERT INTO brewery_reviews SET brewery=$brewery_id, review='$review', rating=$rating, user='vamshedhar'";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      return $result;
    }
  }
?>
