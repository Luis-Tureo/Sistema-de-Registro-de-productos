<?php
class ProductModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->connect();
    }

    public function getWarehouses()
    {
        $query = "SELECT id, name FROM warehouses ORDER BY name";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCurrencies()
    {
        $query = "SELECT id, name FROM currencies ORDER BY name";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMaterials()
    {
        $query = "SELECT id, name FROM materials ORDER BY name";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBranches($warehouseId)
    {
        $query = "SELECT id, name FROM branches WHERE warehouse_id = :warehouse_id ORDER BY name";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':warehouse_id', $warehouseId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function productCodeExists($productCode)
    {
        $query = "SELECT COUNT(*) as count FROM products WHERE product_code = :product_code";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_code', $productCode);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function saveProduct($data)
    {
        try {
            $this->db->beginTransaction();

            // Insertar producto
            $query = "INSERT INTO products (product_code, product_name, warehouse_id, branch_id, currency_id, price, description) 
                      VALUES (:product_code, :product_name, :warehouse_id, :branch_id, :currency_id, :price, :description)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':product_code', $data['product_code']);
            $stmt->bindParam(':product_name', $data['product_name']);
            $stmt->bindParam(':warehouse_id', $data['warehouse_id'], PDO::PARAM_INT);
            $stmt->bindParam(':branch_id', $data['branch_id'], PDO::PARAM_INT);
            $stmt->bindParam(':currency_id', $data['currency_id'], PDO::PARAM_INT);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':description', $data['description']);

            $stmt->execute();
            $productId = $this->db->lastInsertId();

            // Insertar materiales del producto
            if (!empty($data['materials'])) {
                foreach ($data['materials'] as $materialId) {
                    $query = "INSERT INTO product_materials (product_id, material_id) VALUES (:product_id, :material_id)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
                    $stmt->bindParam(':material_id', $materialId, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Error saving product: " . $e->getMessage());
            return false;
        }
    }
}
