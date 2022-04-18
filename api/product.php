<?php
include_once('../helper/import.php');

try {
    if (requestMethod() == "POST") {
        /// CREATE PRODUCT
        $entityBody = file_get_contents('php://input');
        $data = json_decode($entityBody, true);
        $headerToken = headerToken();
        if ($entityBody != '') {
            if (!empty($headerToken)) {
                $dToken = validateToken($headerToken);
                if ($dToken != NULL) {
                    $bodyRequest = new stdClass();
                    $bodyRequest->id = uniqid();
                    $bodyRequest->warungId = $data['warungId'] ?? "";
                    $bodyRequest->name = $data['name'] ?? "";
                    $bodyRequest->description = $data['description'] ?? "";
                    $bodyRequest->category = $data['category'] ?? "";
                    $bodyRequest->price = $data['price'] ?? 0;
                    $bodyRequest->imageId = $data['imageId'] ?? "";

                    if(!empty($bodyRequest->warungId)) {
                        $isSuccess = createProduct($bodyRequest);
                        if ($isSuccess) {
                            response(200, "Berhasil menambahkan produk", $bodyRequest);
                        }
                    } else {
                        response(400, "Id warung tidak boleh kosong");
                    }
                }
            }
        } else {
            response(400);
        }
    } else if (requestMethod() == "GET") {
        /// GET ALL PRODUCT
        $result = getAllProduct();
        if ($result->success == true) {
            response(200, "record found", $result->data);
        }
    } else {
        response(500, "Method not allowed");
    }
} catch (Exception $e) {
    response(500, $e->getMessage());
}
?>