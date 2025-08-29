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
        <h1>Formulario de Producto</h1>
        <form id="productForm">
            <table style="width:100%">
                <tr>
                    <th>
                        <div class="form-group">
                            <label for="productCode">Código</label>
                            <input type="text" id="productCode" name="productCode">
                            <span class="error-message" id="productCodeError"></span>
                        </div>
                    </th>
                    <th>
                        <div class="form-group">
                            <label for="productName">Nombre</label>
                            <input type="text" id="productName" name="productName">
                            <span class="error-message" id="productNameError"></span>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="warehouse">Bodega</label>
                            <select id="warehouse" name="warehouse">
                                <option value=""></option>
                            </select>
                            <span class="error-message" id="warehouseError"></span>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="branch">Sucursal</label>
                            <select id="branch" name="branch" disabled>
                                <option value=""></option>
                            </select>
                            <span class="error-message" id="branchError"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="currency">Moneda</label>
                            <select id="currency" name="currency">
                                <option value=""></option>
                            </select>
                            <span class="error-message" id="currencyError"></span>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="text" id="price" name="price">
                            <span class="error-message" id="priceError"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <div class="form-group">
                            <label>Material del Producto</label>
                            <div id="materialsContainer" class="checkbox-container"></div>
                            <span class="error-message" id="materialsError"></span>
                        </div>
                    </th>

                </tr>
                <tr>
                    <th colspan="2">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" rows="4"></textarea>
                            <span class="error-message" id="descriptionError"></span>
                        </div>
                    </th>
                </tr>
                
            </table>
            <div style="text-align: center;">
                <button type="submit" id="submitBtn">Guardar Producto</button>
            </div>
        </form>
    </div>
    <script src="http://localhost/proyecto/public/js/script.js"></script>
</body>

</html>