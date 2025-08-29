document.addEventListener("DOMContentLoaded", function () {
  loadWarehouses();
  loadCurrencies();
  loadMaterials();

  document.getElementById("warehouse").addEventListener("change", function () {
    const warehouseId = this.value;
    if (warehouseId) {
      loadBranches(warehouseId);
    } else {
      disableBranchSelect();
    }
  });

  document
    .getElementById("productForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      if (validateForm()) {
        submitForm();
      }
    });
});

function loadWarehouses() {
  fetch("app/controllers/ProductController.php?action=getWarehouses")
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("warehouse");
      data.forEach((warehouse) => {
        const option = document.createElement("option");
        option.value = warehouse.id;
        option.textContent = warehouse.name;
        select.appendChild(option);
      });
    })
    .catch((error) => console.error("Error loading warehouses:", error));
}

function loadCurrencies() {
  fetch("app/controllers/ProductController.php?action=getCurrencies")
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("currency");
      data.forEach((currency) => {
        const option = document.createElement("option");
        option.value = currency.id;
        option.textContent = currency.name;
        select.appendChild(option);
      });
    })
    .catch((error) => console.error("Error loading currencies:", error));
}

function loadMaterials() {
  fetch("app/controllers/ProductController.php?action=getMaterials")
    .then((response) => response.json())
    .then((data) => {
      const container = document.getElementById("materialsContainer");
      data.forEach((material) => {
        const div = document.createElement("div");
        div.className = "checkbox-group";

        const input = document.createElement("input");
        input.type = "checkbox";
        input.name = "materials";
        input.value = material.id;
        input.id = "material_" + material.id;

        const label = document.createElement("label");
        label.htmlFor = "material_" + material.id;
        label.textContent = material.name;

        div.appendChild(input);
        div.appendChild(label);
        container.appendChild(div);
      });
    })
    .catch((error) => console.error("Error loading materials:", error));
}

function loadBranches(warehouseId) {
  fetch(
    `app/controllers/ProductController.php?action=getBranches&warehouseId=${warehouseId}`
  )
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("branch");
      select.innerHTML = '<option value=""></option>';

      data.forEach((branch) => {
        const option = document.createElement("option");
        option.value = branch.id;
        option.textContent = branch.name;
        select.appendChild(option);
      });

      select.disabled = false;
    })
    .catch((error) => console.error("Error loading branches:", error));
}

function disableBranchSelect() {
  const select = document.getElementById("branch");
  select.innerHTML = '<option value=""></option>';
  select.disabled = true;
}

function validateForm() {
  let isValid = true;

  const productCode = document.getElementById("productCode").value.trim();
  if (!productCode) {
    showError(
      "productCodeError",
      "El código del producto no puede estar en blanco."
    );
    isValid = false;
  } else if (!/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{5,15}$/.test(productCode)) {
    showError(
      "productCodeError",
      "El código debe contener letras y números, entre 5 y 15 caracteres."
    );
    isValid = false;
  } else {
    hideError("productCodeError");
  }

  const productName = document.getElementById("productName").value.trim();
  if (!productName) {
    showError(
      "productNameError",
      "El nombre del producto no puede estar en blanco."
    );
    isValid = false;
  } else if (productName.length < 2 || productName.length > 50) {
    showError(
      "productNameError",
      "El nombre del producto debe tener entre 2 y 50 caracteres."
    );
    isValid = false;
  } else {
    hideError("productNameError");
  }

  const warehouse = document.getElementById("warehouse").value;
  if (!warehouse) {
    showError("warehouseError", "Debe seleccionar una bodega.");
    isValid = false;
  } else {
    hideError("warehouseError");
  }

  const branch = document.getElementById("branch").value;
  if (!branch) {
    showError(
      "branchError",
      "Debe seleccionar una sucursal para la bodega seleccionada."
    );
    isValid = false;
  } else {
    hideError("branchError");
  }

  const currency = document.getElementById("currency").value;
  if (!currency) {
    showError("currencyError", "Debe seleccionar una moneda para el producto.");
    isValid = false;
  } else {
    hideError("currencyError");
  }

  const price = document.getElementById("price").value.trim();
  if (!price) {
    showError("priceError", "El precio del producto no puede estar en blanco.");
    isValid = false;
  } else if (!/^\d+(\.\d{1,2})?$/.test(price) || parseFloat(price) <= 0) {
    showError(
      "priceError",
      "El precio del producto debe ser un número positivo con hasta dos decimales."
    );
    isValid = false;
  } else {
    hideError("priceError");
  }

  const materials = document.querySelectorAll(
    'input[name="materials"]:checked'
  );
  if (materials.length < 2) {
    showError(
      "materialsError",
      "Debe seleccionar al menos dos materiales para el producto."
    );
    isValid = false;
  } else {
    hideError("materialsError");
  }

  const description = document.getElementById("description").value.trim();
  if (!description) {
    showError(
      "descriptionError",
      "La descripción del producto no puede estar en blanco."
    );
    isValid = false;
  } else if (description.length < 10 || description.length > 1000) {
    showError(
      "descriptionError",
      "La descripción del producto debe tener entre 10 y 1000 caracteres."
    );
    isValid = false;
  } else {
    hideError("descriptionError");
  }

  return isValid;
}

function showError(elementId, message) {
  const errorElement = document.getElementById(elementId);
  errorElement.textContent = message;
  errorElement.style.display = "block";
}

function hideError(elementId) {
  const errorElement = document.getElementById(elementId);
  errorElement.textContent = "";
  errorElement.style.display = "none";
}

function submitForm() {
  const formData = new FormData();
  formData.append(
    "productCode",
    document.getElementById("productCode").value.trim()
  );
  formData.append(
    "productName",
    document.getElementById("productName").value.trim()
  );
  formData.append("warehouse", document.getElementById("warehouse").value);
  formData.append("branch", document.getElementById("branch").value);
  formData.append("currency", document.getElementById("currency").value);
  formData.append("price", document.getElementById("price").value.trim());

  const materials = [];
  document
    .querySelectorAll('input[name="materials"]:checked')
    .forEach((checkbox) => {
      materials.push(checkbox.value);
    });
  formData.append("materials", JSON.stringify(materials));

  formData.append(
    "description",
    document.getElementById("description").value.trim()
  );

  fetch("app/controllers/ProductController.php?action=saveProduct", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Producto guardado exitosamente.");
        document.getElementById("productForm").reset();
        disableBranchSelect();
      } else {
        alert("Error: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Error al guardar el producto.");
    });
}
