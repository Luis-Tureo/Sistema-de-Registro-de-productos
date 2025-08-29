<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro de Productos</title>
    <link rel="stylesheet" href="http://localhost/proyecto/public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Registro de Productos</h1>
        <form id="productForm">
            <div class="form-group">
                <label for="productCode">Código del Producto*</label>
                <input type="text" id="productCode" name="productCode">
                <span class="error-message" id="productCodeError"></span>
            </div>

            <div class="form-group">
                <label for="productName">Nombre del Producto*</label>
                <input type="text" id="productName" name="productName">
                <span class="error-message" id="productNameError"></span>
            </div>

            <div class="form-group">
                <label for="warehouse">Bodega*</label>
                <select id="warehouse" name="warehouse">
                    <option value="">Seleccione una bodega</option>
                </select>
                <span class="error-message" id="warehouseError"></span>
            </div>

            <div class="form-group">
                <label for="branch">Sucursal*</label>
                <select id="branch" name="branch" disabled>
                    <option value="">Seleccione una sucursal</option>
                </select>
                <span class="error-message" id="branchError"></span>
            </div>

            <div class="form-group">
                <label for="currency">Moneda*</label>
                <select id="currency" name="currency">
                    <option value="">Seleccione una moneda</option>
                </select>
                <span class="error-message" id="currencyError"></span>
            </div>

            <div class="form-group">
                <label for="price">Precio*</label>
                <input type="text" id="price" name="price">
                <span class="error-message" id="priceError"></span>
            </div>

            <div class="form-group">
                <label>Material del Producto* (Seleccione al menos 2)</label>
                <div id="materialsContainer"></div>
                <span class="error-message" id="materialsError"></span>
            </div>

            <div class="form-group">
                <label for="description">Descripción del Producto*</label>
                <textarea id="description" name="description" rows="4"></textarea>
                <span class="error-message" id="descriptionError"></span>
            </div>

            <button type="submit" id="submitBtn">Guardar Producto</button>
        </form>
    </div>

    <script src="http://localhost/proyecto/public/js/script.js"></script>
</body>

</html>