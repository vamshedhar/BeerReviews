SELECT
  B.*,
  COALESCE(AVG(BR.rating), 0) as rating,
  COALESCE(COUNT(BR.id), 0) as total_reviews
FROM
  beers B
LEFT JOIN
  beer_reviews BR
ON
  BR.beer = B.id
GROUP BY
  B.id


SELECT
    BR.id,
    BR.beer,
    BR.review,
    BR.rating,
    U.first_name,
    U.last_nam
FROM
    beer_reviews BR
LEFT JOIN
    user U
ON
    BR.user = user.username
WHERE
    BR.beer = 1;
