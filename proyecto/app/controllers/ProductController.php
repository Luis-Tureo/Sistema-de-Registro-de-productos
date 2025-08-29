<?php
require_once '../models/Database.php';
require_once '../models/ProductModel.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

$db = new Database();
$productModel = new ProductModel($db);

switch ($action) {
    case 'getWarehouses':
        echo json_encode($productModel->getWarehouses());
        break;

    case 'getCurrencies':
        echo json_encode($productModel->getCurrencies());
        break;

    case 'getMaterials':
        echo json_encode($productModel->getMaterials());
        break;

    case 'getBranches':
        $warehouseId = $_GET['warehouseId'] ?? 0;
        echo json_encode($productModel->getBranches($warehouseId));
        break;

    case 'saveProduct':
        $response = ['success' => false, 'message' => ''];

        // Validar código único
        $productCode = $_POST['productCode'] ?? '';
        if ($productModel->productCodeExists($productCode)) {
            $response['message'] = 'El código del producto ya está registrado.';
            echo json_encode($response);
            exit;
        }

        // Preparar datos
        $data = [
            'product_code' => $productCode,
            'product_name' => $_POST['productName'] ?? '',
            'warehouse_id' => $_POST['warehouse'] ?? 0,
            'branch_id' => $_POST['branch'] ?? 0,
            'currency_id' => $_POST['currency'] ?? 0,
            'price' => $_POST['price'] ?? 0,
            'materials' => json_decode($_POST['materials'] ?? '[]', true),
            'description' => $_POST['description'] ?? ''
        ];

        // Guardar producto
        if ($productModel->saveProduct($data)) {
            $response['success'] = true;
            $response['message'] = 'Producto guardado exitosamente.';
        } else {
            $response['message'] = 'Error al guardar el producto.';
        }

        echo json_encode($response);
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
