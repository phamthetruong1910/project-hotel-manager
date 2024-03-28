<?php
include('includes/config.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['searchName'];
    $ranking = $_POST['ranking'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $district = $_POST['district'];
    $sql = "SELECT *, hotels.id as hotel_id, hotels.name as hotel_name FROM hotels ";

    $sql .= "INNER JOIN roomtype ON roomtype.hotelId = hotels.id";

    $sql .= " WHERE hotels.status = 'ENABLE'";

    if (isset($_POST['conveniences'])) {
        $convenient = $_POST['conveniences'];
        if (is_array($convenient) && count($convenient) > 0) {
            foreach ($convenient as $value) {
                $sql .= "AND hotels.convenient LIKE '%" . $value . "%' ";
            }
        }
    }

    if (!empty($ranking) || $ranking === '0') {
        $sql .= "AND hotels.ranking = ".$ranking." ";
    }

    if (!empty($district)) {
        $sql .= "AND hotels.district LIKE '%".$district."%' ";
    }

    if (!empty($type)) {
        $sql .= "AND hotels.type LIKE '%".$type."%' ";
    }

    if (!empty($name)) {
        $name = "%$name%";
        $sql .= "AND (hotels.name COLLATE utf8mb4_unicode_ci LIKE '%". $name ."%') ";
    }

    $sql .= " GROUP BY hotels.id";

    if ($price === 'max') {
        $sql .= " ORDER BY roomtype.price desc";
    } else {
        $sql .= " ORDER BY roomtype.price asc";
    }

//    $sql .= ", createdAt desc";
    $query = $dbh->prepare($sql);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $hotels = [];

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $hotel = [
                'id' => htmlentities($result['hotel_id']),
                'name' => htmlentities($result['hotel_name']),
                'type' => htmlentities($result['type']),
                'location' => htmlentities($result['location']),
                'convenient' => [],
                'ranking' => htmlentities($result['ranking']),
                'price' => htmlentities($result['price'])
            ];
            $sqlImages = "SELECT * from images where code = 'HOTEL' AND objectId=:objectId limit 1";
            $queryImages = $dbh->prepare($sqlImages);
            $queryImages->bindParam(':objectId', $result['hotel_id'], PDO::PARAM_STR);
            $queryImages->execute();
            $imagesTitle = $queryImages->fetch(PDO::FETCH_ASSOC);
            if ($imagesTitle) {
                $hotel['image'] = 'admins/images/products/' . $imagesTitle['name'];
            }
            $Convenient = $result['convenient'];
            if (isset($Convenient)) {
                $resultsConvenient = explode(' - ', $Convenient);
                $n = 4;
                $numResults = count($resultsConvenient);
                for ($i = 0; $i < $numResults; $i += $n) {
                    $convenientGroup = [];
                    for ($j = $i; $j < min($i + $n, $numResults); $j++) {
                        $convenientGroup[] = $resultsConvenient[$j];
                    }
                    $hotel['convenient'][] = $convenientGroup;
                }
            }

            $hotels[] = $hotel;

        }
    }
    echo json_encode(['hotels' => $hotels]);

}
