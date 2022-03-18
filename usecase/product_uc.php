<?php
include_once('../helper/import.php');

function createProduct($body) {
    try {
        $conn = callDb();
        $currentDate = currentTime();
        $sql = "INSERT INTO product (
            `product_id`,
            `warung_id`,
            `name`,
            `description`,
            `category`,
            `price`,
            `image_Id`,
            `rating`,
            `discount_percentage`,
            `discount_amount`,
            `like`,
            `view`,
            `created_at`,
            `updated_at`
            ) VALUES (
                '$body->id',
                $body->warungId,
                '$body->name',
                '$body->description',
                '$body->category',
                $body->price,
                '$body->imageId',
                0,
                0,
                0,
                0,
                0,
                '$currentDate',
                '$currentDate'
            )";
        $conn->query($sql);
        return true;
    } catch (Exception $e) {
        $error = $e->getMessage();
        response(500, "create product exception -> $error");
        return false;
    }
}
?>