<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Simple Admin Panel</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body { background:#f8f9fa; }
    .sidebar { height: 100vh; position: fixed; width: 200px; background: #343a40; padding-top: 20px; }
    .sidebar a { color: #fff; padding: 12px 20px; display: block; text-decoration: none; }
    .sidebar a.active, .sidebar a:hover { background: #495057; }
    .content { margin-left: 210px; padding: 20px; }
    td img.product-thumb { width: 60px; height: auto; object-fit: cover; border-radius: 4px; }
  </style>
</head>

<body>

  <div class="sidebar">
    <a href="#" onclick="showSection('users')">Manage Users</a>
    <a href="#" onclick="showSection('categories')">Manage Categories</a>
    <a href="#" onclick="showSection('products')">Manage Products</a>
  </div>

  <div class="content">

    <!-- USERS SECTION -->
    <div id="usersSection">
      <h2>Users</h2>
      <button class="btn btn-primary mb-3" onclick="addUser()">Add User</button>
      <table class="table table-bordered table-striped">
        <thead><tr><th>Name</th><th>Email</th><th>Actions</th></tr></thead>
        <tbody id="userTable"></tbody>
      </table>
    </div>

    <!-- CATEGORIES SECTION -->
    <div id="categoriesSection" style="display:none;">
      <h2>Categories</h2>
      <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
      <table class="table table-bordered table-striped">
        <thead><tr><th>Name</th><th>Description</th><th>Actions</th></tr></thead>
        <tbody id="categoryTable"></tbody>
      </table>
    </div>

    <!-- PRODUCTS SECTION -->
    <div id="productsSection" style="display:none;">
      <h2>Products</h2>
      <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
      <table class="table table-bordered table-striped">
        <thead><tr><th>Name</th><th>Description</th><th>Price</th><th>Category</th><th>Carbon Footprint</th><th>Image</th><th>Actions</th></tr></thead>
        <tbody id="productTable"></tbody>
      </table>
    </div>

  </div>

  <!-- ADD CATEGORY MODAL -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="categoryForm">
            <div class="mb-3">
              <label class="form-label">Category Name</label>
              <input type="text" class="form-control" id="categoryName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control" id="categoryDesc" rows="3" required></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" onclick="saveCategory()">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- VIEW / EDIT PRODUCT MODAL -->
<div class="modal fade" id="viewProductModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">View / Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="viewProductForm">

          <input type="hidden" id="editProductIndex">

          <div class="row mb-3">
            <div class="col">
              <label class="form-label">Product Name</label>
              <input type="text" class="form-control pField" id="viewProductName" disabled>
            </div>
            <div class="col">
              <label class="form-label">Price (R)</label>
              <input type="number" class="form-control pField" id="viewProductPrice" disabled>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control pField" id="viewProductDesc" rows="2" disabled></textarea>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label class="form-label">Category</label>
              <select class="form-select pField" id="viewProductCategory" disabled></select>
            </div>
            <div class="col">
              <label class="form-label">Carbon Footprint (kg CO₂e)</label>
              <input type="number" class="form-control pField" id="viewProductCarbon" disabled>
            </div>
          </div>

          <div class="mb-3 text-center">
            <img id="viewProductImagePreview" src="" class="img-fluid rounded" style="max-height:150px;">
            <input type="file" class="form-control mt-2 pField" id="viewProductImage" accept="image/*" disabled>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" id="enableEditBtn" onclick="enableProductEditing()">Edit</button>
        <button class="btn btn-success" id="saveProductChangesBtn" onclick="saveProductChanges()" style="display:none;">Save Changes</button>
      </div>

    </div>
  </div>
</div>


  <!-- ADD PRODUCT MODAL -->
  <div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="productForm">
            <div class="mb-3">
              <label class="form-label">Product Name</label>
              <input type="text" class="form-control" id="productName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control" id="productDesc" rows="2" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Price (R)</label>
              <input type="number" step="0.01" class="form-control" id="productPrice" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Category</label>
              <select class="form-select" id="productCategory" required>
                <option value="">-- Select Category --</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Carbon Footprint (kg CO₂e)</label>
              <input type="number" step="0.01" class="form-control" id="productCarbon" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Image</label>
              <input type="file" class="form-control" id="productImage" accept="image/*">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" onclick="saveProduct()">Save</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let users = [];
let categories = [];
let products = [];

function showSection(section) {
  document.getElementById("usersSection").style.display = section === "users" ? "block" : "none";
  document.getElementById("categoriesSection").style.display = section === "categories" ? "block" : "none";
  document.getElementById("productsSection").style.display = section === "products" ? "block" : "none";
}

// USERS
function addUser() {
  const name = prompt("Enter user name:");
  const email = prompt("Enter user email:");
  if (name && email) { users.push({ name, email }); renderUsers(); }
}

function renderUsers() {
  document.getElementById("userTable").innerHTML = users.map((u, i) => `
    <tr>
      <td>${escapeHtml(u.name)}</td>
      <td>${escapeHtml(u.email)}</td>
      <td><button class='btn btn-danger btn-sm' onclick='deleteUser(${i})'>Delete</button></td>
    </tr>
  `).join('');
}

function deleteUser(i) { users.splice(i, 1); renderUsers(); }

// CATEGORIES
function loadCategoriesFromDB() {
  fetch('get_categories.php')
    .then(res => res.json())
    .then(data => {
      categories = data.map(c => ({ name: c.Name, desc: c.Description }));
      renderCategories();
      updateCategoryDropdown();
    })
    .catch(err => console.error("Failed to load categories:", err));
}

function renderCategories() {
  document.getElementById("categoryTable").innerHTML = categories.map((c, i) => `
    <tr>
      <td>${escapeHtml(c.name)}</td>
      <td>${escapeHtml(c.desc)}</td>
      <td><button class='btn btn-danger btn-sm' onclick='deleteCategory(${i})'>Delete</button></td>
    </tr>
  `).join('');
}

function deleteCategory(i) {
  const catName = categories[i].name;
  products = products.map(p => {
    if (p.category === catName) p.category = '';
    return p;
  });
  categories.splice(i, 1);
  renderCategories();
  renderProducts();
  updateCategoryDropdown();
}

function updateCategoryDropdown() {
  const sel = document.getElementById('productCategory');
  const current = sel.value;
  sel.innerHTML = '<option value="">-- Select Category --</option>' +
    categories.map(c => `<option value="${escapeHtmlAttr(c.name)}">${escapeHtml(c.name)}</option>`).join('');
  if (current) sel.value = current;
}

// ADD CATEGORY TO DB
function saveCategory() {
  const name = document.getElementById("categoryName").value.trim();
  const desc = document.getElementById("categoryDesc").value.trim();

  if (!name || !desc) return alert('All fields are required');

  // Correctly use URLSearchParams
  const formData = new URLSearchParams();
  formData.append('name', name);
  formData.append('description', desc);

  // Note: no console.log(formData.name) because it doesn't exist
  console.log([...formData.entries()]); // logs [['name', name], ['description', desc]]

  fetch('add_category.php', {
    method: 'POST',
    body: formData, // URLSearchParams works fine as body
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded' // important for PHP
    }
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      loadCategoriesFromDB();
      document.getElementById("categoryForm").reset();
      bootstrap.Modal.getInstance(document.getElementById('addCategoryModal')).hide();
    } else {
      alert(data.error || "Failed to add category");
    }
  })
  .catch(err => console.error("Error adding category:", err));
}

// PRODUCTS
function loadProductsFromDB() {
  fetch('get_products.php') // you’ll need to create this endpoint
    .then(res => res.json())
    .then(data => {
      products = data.map(p => ({
        name: p.Name,
        desc: p.Description,
        price: parseFloat(p.Price).toFixed(2),
        category: p.Category,
        carbon: parseFloat(p.CarbonFootprint).toFixed(2),
        imageUrl: p.Image || null,
        imageName: p.image_name || ''
      }));
      renderProducts();
    })
    .catch(err => console.error("Failed to load products:", err));
}

function renderProducts() {
  const table = document.getElementById("productTable");
  table.innerHTML = products.map((p, i) => `
    <tr onclick='openProductModal(${i})' style="cursor:pointer;">
      <td>${escapeHtml(p.name)}</td>
      <td>${escapeHtml(p.desc)}</td>
      <td>R ${Number(p.price).toFixed(2)}</td>
      <td>${escapeHtml(p.category)}</td>
      <td>${Number(p.carbon).toFixed(2)}</td>
      <td>${p.imageUrl ? `<img src="${p.imageUrl}" class="product-thumb">` : '—'}</td>
      <td><button class='btn btn-danger btn-sm' onclick='event.stopPropagation(); deleteProduct(${i})'>Delete</button></td>
    </tr>
  `).join('');
}

function openProductModal(index) {
  const p = products[index];
  document.getElementById("editProductIndex").value = index;

  document.getElementById("viewProductName").value = p.name;
  document.getElementById("viewProductDesc").value = p.desc;
  document.getElementById("viewProductPrice").value = p.price;
  document.getElementById("viewProductCategory").value = p.category;
  document.getElementById("viewProductCarbon").value = p.carbon;

  document.getElementById("viewProductImagePreview").src = p.imageUrl || '';

  disableProductFields();

  new bootstrap.Modal(document.getElementById('viewProductModal')).show();
}


function disableProductFields() {
  document.querySelectorAll('.pField').forEach(f => f.disabled = true);
  document.getElementById("enableEditBtn").style.display = 'inline-block';
  document.getElementById("saveProductChangesBtn").style.display = 'none';
}

function enableProductEditing() {
  document.querySelectorAll('.pField').forEach(f => f.disabled = false);
  document.getElementById("enableEditBtn").style.display = 'none';
  document.getElementById("saveProductChangesBtn").style.display = 'inline-block';
}


function saveProductChanges() {
  const index = document.getElementById("editProductIndex").value;
  
  const formData = new FormData();
  formData.append("name", document.getElementById("viewProductName").value);
  formData.append("description", document.getElementById("viewProductDesc").value);
  formData.append("price", document.getElementById("viewProductPrice").value);
  formData.append("category", document.getElementById("viewProductCategory").value);
  formData.append("carbon", document.getElementById("viewProductCarbon").value);

  const imageFile = document.getElementById("viewProductImage").files[0];
  if (imageFile) formData.append("image", imageFile);

  formData.append("id", products[index].id); // Ensure DB row reference

  fetch("update_product.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        loadProductsFromDB();
        disableProductFields();
      } else {
        alert(data.error || "Failed to update product");
      }
    });
}


// ADD PRODUCT TO DB
function saveProduct() {
  const name = document.getElementById("productName").value.trim();
  const desc = document.getElementById("productDesc").value.trim();
  const priceRaw = document.getElementById("productPrice").value;
  const category = document.getElementById("productCategory").value;
  const carbonRaw = document.getElementById("productCarbon").value;
  const imageInput = document.getElementById("productImage");

  if (!name || !desc || !priceRaw || !category || !carbonRaw) return alert('All fields are required');

  const price = parseFloat(priceRaw).toFixed(2);
  const carbon = parseFloat(carbonRaw).toFixed(2);

  const formData = new FormData();
  formData.append('name', name);
  formData.append('description', desc);
  formData.append('price', price);
  formData.append('category', category);
  formData.append('carbon', carbon);
  if(imageInput.files[0]) formData.append('image', imageInput.files[0]);

  fetch('add_product.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if(data.success){
      loadProductsFromDB();
      document.getElementById("productForm").reset();
      bootstrap.Modal.getInstance(document.getElementById('addProductModal')).hide();
    } else {
      alert(data.error || "Failed to add product");
    }
  })
  .catch(err => console.error("Error adding product:", err));
}

// Utilities
function escapeHtml(str) {
  if (!str) return '';
  return String(str).replace(/[&<>\"']/g, s => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"}[s]));
}
function escapeHtmlAttr(str) { return escapeHtml(str).replace(/"/g, '&quot;'); }

// Initialize
window.addEventListener('DOMContentLoaded', () => {
  loadCategoriesFromDB(); // fetch categories from DB
  loadProductsFromDB();   // fetch products from DB
  renderUsers();           // render users if any
  showSection('users');
});
</script>


</body>
</html>
