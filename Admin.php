<?php
session_start();

if (!isset($_SESSION['Id'])) {
    echo '<script>window.location.href = "adminLogin.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DragonStone Admin</title>

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
    <a href="#" onclick="showSection('products')">Manage Products</a>
    <a href="#" onclick="showSection('challenges')">Manage Challenges</a>
      <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == 1): ?>
          <a href="#" onclick="showSection('employees')">Manage Employees</a>
      <?php endif; ?>
    <a href="#" onclick="showSection('orders')">Orders</a>
      <br>
      <br>
    <a href="#" onclick="Logout()">Logout</a>
  </div>

  <div class="content">

    <!-- USERS SECTION -->
    <div id="usersSection">
      <h2>Users</h2>
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

      <!-- Challenges SECTION -->
      <div id="challengesSection" style="display:none;">
          <h2>Challenges</h2>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addChallengesModal">Add Challenges</button>
          <table class="table table-bordered table-striped">
              <thead><tr><th>Title</th><th>Description</th><th>Points</th><th>Actions</th></tr></thead>
              <tbody id="challengesTable"></tbody>
          </table>
      </div>

      <!-- Employee SECTION -->
      <div id="employeeSection" style="display:none;">
          <h2>Employees</h2>
          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
          <table class="table table-bordered table-striped">
              <thead><tr><th>Name</th><th>Role</th><th>Code</th><th>Actions</th></tr></thead>
              <tbody id="employeeTable"></tbody>
          </table>
      </div>
      <!-- Order SECTION -->
      <div id="ordersSection" style="display:none;">
          <h2>Orders</h2>
          <table class="table table-bordered table-striped">
              <thead><tr><th>User</th><th>Amount</th></tr></thead>
              <tbody id="ordersTable"></tbody>
          </table>
      </div>



  </div>


  <!-- View User Modal -->
  <div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title">User Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                  <!-- Hidden index -->
                  <input type="hidden" id="editUserIndex">

                  <div class="row mb-3">
                      <div class="col-md-6">
                          <label class="form-label">Name</label>
                          <input type="text" id="viewUserName" class="form-control uField">
                      </div>

                      <div class="col-md-6">
                          <label class="form-label">Surname</label>
                          <input type="text" id="viewUserSurname" class="form-control uField">
                      </div>
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" id="viewUserEmail" class="form-control uField">
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Eco Points</label>
                      <input type="number" id="viewUserEcoPoints" class="form-control uField">
                  </div>
              </div>

              <div class="modal-footer">
                  <button
                          id="enableUserEditBtn"
                          class="btn btn-warning"
                          onclick="enableUserEditing()" hidden>
                      Edit
                  </button>

                  <button
                          id="saveUserChangesBtn"
                          class="btn btn-success"
                          onclick="saveUserChanges()"
                          style="display:none;">
                      Save Changes
                  </button>

                  <button class="btn btn-secondary" data-bs-dismiss="modal">
                      Close
                  </button>
              </div>

          </div>
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
              <select class="form-select pField" id="viewProductCategory" disabled>
                  <option value="0">-- Cleaning & Household Supplies --</option>
                  <option value="1">-- Kitchen & Dining --</option>
                  <option value="2">-- Home Décor & Living --</option>
                  <option value="3">-- Bathroom & Personal Care --</option>
                  <option value="4">-- Lifestyle & Wellness --</option>
                  <option value="5">-- Kids & Pets --</option>
                  <option value="6">-- Outdoor & Garden --</option>
              </select>
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
                  <option value="0">-- Cleaning & Household Supplies --</option>
                  <option value="1">-- Kitchen & Dining --</option>
                  <option value="2">-- Home Décor & Living --</option>
                  <option value="3">-- Bathroom & Personal Care --</option>
                  <option value="4">-- Lifestyle & Wellness --</option>
                  <option value="5">-- Kids & Pets --</option>
                  <option value="6">-- Outdoor & Garden --</option>
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

<!--  //Add Challenge-->
  <div class="modal fade" id="addChallengesModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title">Add Challenge</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                  <form id="challengeForm">

                      <div class="mb-3">
                          <label class="form-label">Title</label>
                          <input
                                  type="text"
                                  class="form-control"
                                  id="challengeTitle"
                                  placeholder="Enter challenge title"
                                  required
                          >
                      </div>

                      <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea
                                  class="form-control"
                                  id="challengeDesc"
                                  rows="3"
                                  placeholder="Describe the challenge"
                                  required
                          ></textarea>
                      </div>

                      <div class="mb-3">
                          <label class="form-label">Points</label>
                          <input
                                  type="number"
                                  class="form-control"
                                  id="challengePoints"
                                  min="1"
                                  placeholder="Points awarded"
                                  required
                          >
                      </div>

                  </form>
              </div>

              <div class="modal-footer">
                  <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-dismiss="modal">
                      Cancel
                  </button>

                  <button
                          type="button"
                          class="btn btn-primary"
                          onclick="saveChallenge()">
                      Save Challenge
                  </button>
              </div>

          </div>
      </div>
  </div>

<!--  //VIEW CHALLENG MODAL-->
  <div class="modal fade" id="viewChallengeModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title">View Challenge</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">

                  <!-- Hidden index for JS -->
                  <input type="hidden" id="editChallengeIndex">

                  <div class="mb-3">
                      <label class="form-label">Title</label>
                      <input
                              type="text"
                              class="form-control cField"
                              id="viewChallengeTitle"
                      >
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Description</label>
                      <textarea
                              class="form-control cField"
                              id="viewChallengeDesc"
                              rows="3"
                      ></textarea>
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Points</label>
                      <input
                              type="number"
                              class="form-control cField"
                              id="viewChallengePoints"
                              min="0"
                      >
                  </div>

              </div>

              <div class="modal-footer">
                  <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-dismiss="modal">
                      Close
                  </button>

                  <button
                          type="button"
                          class="btn btn-warning"
                          id="enableChallengeEditBtn"
                          onclick="enableChallengeEditing()">
                      Edit
                  </button>

                  <button
                          type="button"
                          class="btn btn-success"
                          id="saveChallengeChangesBtn"
                          onclick="saveChallengeChanges()">
                      Save Changes
                  </button>
              </div>

          </div>
      </div>
  </div>

  <div class="modal fade" id="addEmployeeModal" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title">Add Employee</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                  <form id="employeeForm">

                      <div class="mb-3">
                          <label class="form-label">Name</label>
                          <input type="text" id="employeeName" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label class="form-label">Surname</label>
                          <input type="text" id="employeeSurname" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" id="employeeEmail" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label class="form-label">Role</label>
                          <select id="employeeRole" class="form-select" required>
                              <option value="">Select role</option>
                              <option value="1">Admin</option>
                              <option value="2">Manager</option>
                              <option value="3">Staff</option>
                          </select>
                      </div>

                      <div class="mb-3">
                          <label class="form-label">Code</label>
                          <input type="number" id="employeeCode" class="form-control" required>
                      </div>

                  </form>
              </div>

              <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button class="btn btn-primary" onclick="saveEmployee()">Save Employee</button>
              </div>

          </div>
      </div>
  </div>
  <div class="modal fade" id="viewEmployeeModal" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title">Employee Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">

                  <input type="hidden" id="editEmployeeIndex">

                  <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" id="viewEmployeeName" class="form-control eField">
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Surname</label>
                      <input type="text" id="viewEmployeeSurname" class="form-control eField">
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" id="viewEmployeeEmail" class="form-control eField">
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Role</label>
                      <select id="viewEmployeeRole" class="form-select eField">
                          <option value="0">Admin</option>
                          <option value="1">Manager</option>
                      </select>
                  </div>

                  <div class="mb-3">
                      <label class="form-label">Code</label>
                      <input type="number" id="viewEmployeeCode" class="form-control" disabled>
                  </div>

              </div>

              <div class="modal-footer">
                  <button id="enableEmployeeEditBtn"
                          class="btn btn-warning"
                          onclick="enableEmployeeEditing()">
                      Edit
                  </button>

                  <button id="saveEmployeeChangesBtn"
                          class="btn btn-success"
                          style="display:none"
                          onclick="saveEmployeeChanges()">
                      Save Changes
                  </button>

                  <button class="btn btn-secondary" data-bs-dismiss="modal">
                      Close
                  </button>
              </div>

          </div>
      </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let users = [];
let categories = [];
let products = [];
let challenges = [];
let orders = [];
let employees = [];

function showSection(section) {
  document.getElementById("usersSection").style.display = section === "users" ? "block" : "none";
  document.getElementById("categoriesSection").style.display = section === "categories" ? "block" : "none";
  document.getElementById("productsSection").style.display = section === "products" ? "block" : "none";
  document.getElementById("challengesSection").style.display = section === "challenges" ? "block" : "none";
  document.getElementById("employeeSection").style.display = section === "employees" ? "block" : "none";
  document.getElementById("ordersSection").style.display = section === "orders" ? "block" : "none";
}

// USERS
function loadUsersFromDB() {
    fetch('get_users.php')
        .then(res => res.json())
        .then(data => {
            users = data.map(u => ({
                id: u.Id,
                name: u.Name,
                surname: u.Surname,
                email: u.Email,
                ecoPoints: parseInt(u.EcoPoints)
            }));
            renderUsers();
        })
        .catch(err => console.error("Failed to load users:", err));
}

function renderUsers() {
    const table = document.getElementById("userTable");
    table.innerHTML = users.map((u, i) => `
        <tr onclick="openUserModal(${i})" style="cursor:pointer;">
            <td>${escapeHtml(u.name)} ${escapeHtml(u.surname)}</td>
            <td>${escapeHtml(u.email)}</td>
            <td>
                <button class="btn btn-danger btn-sm"
                    onclick="event.stopPropagation(); deleteUser(${i})">
                    Delete
                </button>
            </td>
        </tr>
    `).join('');
}

function openUserModal(index) {
    const u = users[index];

    document.getElementById("editUserIndex").value = index;
    document.getElementById("viewUserName").value = u.name;
    document.getElementById("viewUserSurname").value = u.surname;
    document.getElementById("viewUserEmail").value = u.email;
    document.getElementById("viewUserEcoPoints").value = u.ecoPoints;

    disableUserFields();
    new bootstrap.Modal(document.getElementById('viewUserModal')).show();
}

function disableUserFields() {
    document.querySelectorAll('.uField').forEach(f => f.disabled = true);
    document.getElementById("enableUserEditBtn").style.display = 'inline-block';
    document.getElementById("saveUserChangesBtn").style.display = 'none';
}

function enableUserEditing() {
    document.querySelectorAll('.uField').forEach(f => f.disabled = false);
    document.getElementById("enableUserEditBtn").style.display = 'none';
    document.getElementById("saveUserChangesBtn").style.display = 'inline-block';
}

function saveUserChanges() {
    const index = document.getElementById("editUserIndex").value;

    const formData = new FormData();
    formData.append("id", users[index].id);
    formData.append("name", document.getElementById("viewUserName").value);
    formData.append("surname", document.getElementById("viewUserSurname").value);
    formData.append("email", document.getElementById("viewUserEmail").value);
    formData.append("ecoPoints", document.getElementById("viewUserEcoPoints").value);

    fetch("update_user.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadUsersFromDB();
                disableUserFields();
            } else {
                alert(data.error || "Failed to update user");
            }
        })
        .catch(err => console.error(err));
}

function deleteUser(index) {
    if (!confirm("Delete this user?")) return;

    const formData = new FormData();
    formData.append("id", users[index].id);

    fetch("delete_user.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadUsersFromDB();
            } else {
                alert(data.error || "Failed to delete user");
            }
        })
        .catch(err => console.error(err));
}


//Challenges

function loadChallengesFromDB() {
    fetch('get_challenges.php')
        .then(res => res.json())
        .then(data => {
            challenges = data.map(c => ({
                id: c.Id,
                title: c.Title,
                desc: c.Description,
                points: parseInt(c.Points)
            }));
            renderChallenges();
        })
        .catch(err => console.error("Failed to load challenges:", err));
}

function renderChallenges() {
    const table = document.getElementById("challengesTable");
    table.innerHTML = challenges.map((c, i) => `
    <tr onclick="openChallengeModal(${i})" style="cursor:pointer;">
      <td>${escapeHtml(c.title)}</td>
      <td>${escapeHtml(c.desc)}</td>
      <td>${c.points}</td>
      <td>
        <button class="btn btn-danger btn-sm"
          onclick="event.stopPropagation(); deleteChallenge(${i})">
          Delete
        </button>
      </td>
    </tr>
  `).join('');
}

function openChallengeModal(index) {
    const c = challenges[index];

    document.getElementById("editChallengeIndex").value = index;
    document.getElementById("viewChallengeTitle").value = c.title;
    document.getElementById("viewChallengeDesc").value = c.desc;
    document.getElementById("viewChallengePoints").value = c.points;

    disableChallengeFields();
    new bootstrap.Modal(document.getElementById('viewChallengeModal')).show();
}

function disableChallengeFields() {
    document.querySelectorAll('.cField').forEach(f => f.disabled = true);
    document.getElementById("enableChallengeEditBtn").style.display = 'inline-block';
    document.getElementById("saveChallengeChangesBtn").style.display = 'none';
}

function enableChallengeEditing() {
    document.querySelectorAll('.cField').forEach(f => f.disabled = false);
    document.getElementById("enableChallengeEditBtn").style.display = 'none';
    document.getElementById("saveChallengeChangesBtn").style.display = 'inline-block';
}
function saveChallengeChanges() {
    const index = document.getElementById("editChallengeIndex").value;

    const formData = new FormData();
    formData.append("id", challenges[index].id);
    formData.append("title", document.getElementById("viewChallengeTitle").value);
    formData.append("description", document.getElementById("viewChallengeDesc").value);
    formData.append("points", document.getElementById("viewChallengePoints").value);

    fetch("update_challenge.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadChallengesFromDB();
                disableChallengeFields();
            } else {
                alert(data.error || "Failed to update challenge");
            }
        });
}
function saveChallenge() {
    const title = document.getElementById("challengeTitle").value.trim();
    const desc = document.getElementById("challengeDesc").value.trim();
    const points = document.getElementById("challengePoints").value;

    if (!title || !desc || !points) {
        return alert("All fields are required");
    }

    const formData = new FormData();
    formData.append("title", title);
    formData.append("description", desc);
    formData.append("points", points);

    fetch("add_challenge.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadChallengesFromDB();
                document.getElementById("challengeForm").reset();
                bootstrap.Modal.getInstance(
                    document.getElementById("addChallengesModal")
                ).hide();
            } else {
                alert(data.error || "Failed to add challenge");
            }
        })
        .catch(err => console.error("Error adding challenge:", err));
}

function deleteChallenge(index) {
    if (!confirm("Delete this challenge?")) return;

    const formData = new FormData();
    formData.append("id", challenges[index].id);

    fetch("delete_challenge.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadChallengesFromDB();
            } else {
                alert(data.error || "Failed to delete challenge");
            }
        })
        .catch(err => console.error(err));
}





// PRODUCTS
function loadProductsFromDB() {
  fetch('get_products.php') // you’ll need to create this endpoint
    .then(res => res.json())
    .then(data => {
      products = data.map(p => ({
        id: p.Id,
        name: p.Name,
        desc: p.Description,
        price: parseFloat(p.Price).toFixed(2),
        category: p.Category,
        carbon: parseFloat(p.CarbonFootprint).toFixed(2),
        imageUrl: p.Image || null,
        imageName: p.image_name || ''
      }));
        console.log(products)
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

function setSelectByText(selectId, text) {
    const select = document.getElementById(selectId);
    const options = Array.from(select.options);

    const match = options.find(
        opt => opt.textContent.replace(/--/g, '').trim() === text.trim()
    );

    if (match) {
        select.value = match.value;
    }
}

function openProductModal(index) {
    const p = products[index];
    document.getElementById("editProductIndex").value = index;

    document.getElementById("viewProductName").value = p.name;
    document.getElementById("viewProductDesc").value = p.desc;
    document.getElementById("viewProductPrice").value = p.price;
    document.getElementById("viewProductCarbon").value = p.carbon;

    // Select dropdown by visible text
    setSelectByText("viewProductCategory", p.category);

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
    console.log('Name:', formData.get('name'));
    console.log('Description:', formData.get('description'));
    console.log('Price:', formData.get('price'));
    console.log('Category:', formData.get('category'));
    console.log('Carbon:', formData.get('carbon'));


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

function deleteProduct(index = null) {
    // If index not passed (e.g. delete from modal), use hidden field
    if (index === null) {
        index = document.getElementById("editProductIndex").value;
    }

    index = parseInt(index, 10);

    if (isNaN(index) || !products[index] || !products[index].id) {
        alert("Invalid product selected");
        return;
    }

    if (!confirm("Are you sure you want to delete this product?")) return;

    const formData = new FormData();
    formData.append("id", products[index].id);

    fetch("delete_product.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadProductsFromDB();
                bootstrap.Modal.getInstance(
                    document.getElementById('viewProductModal')
                )?.hide();
            } else {
                alert(data.error || "Failed to delete product");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Server error while deleting product");
        });
}



//ORDERS

function loadOrdersFromDB() {
    fetch('get_orders.php')
        .then(res => res.json())
        .then(data => {
            orders = data.map(c => ({
                id: c.id,
                user: c.user,
                amount: c.amount
            }));
            renderOrders();
        })
        .catch(err => console.error("Failed to load challenges:", err));
}

function renderOrders() {
    const table = document.getElementById("ordersTable");
    table.innerHTML = orders.map((c, i) => `
    <tr>
      <td>${escapeHtml(c.user)}</td>
      <td>${escapeHtml(c.amount)}</td>
    </tr>
  `).join('');
}


//EMPLOYEES

function loadEmployeesFromDB() {
    fetch('get_employees.php')
        .then(res => res.json())
        .then(data => {
            employees = data.map(e => ({
                id: e.Id,
                name: e.Name,
                surname: e.Surname,
                email: e.Email,
                role: e.Role,
                code: e.Code
            }));
            console.log(employees);
            renderEmployees();
        })
        .catch(err => console.error("Failed to load employees:", err));
}
function renderEmployees() {
    const table = document.getElementById("employeeTable");
    table.innerHTML = employees.map((e, i) => `
    <tr onclick="openEmployeeModal(${i})" style="cursor:pointer;">
      <td>${escapeHtml(e.name)} ${escapeHtml(e.surname)}</td>
      <td>${Number(e.role) === 0 ? 'Admin' : 'Manager'}</td>
      <td>${escapeHtml(e.code)}</td>
      <td>
        <button class="btn btn-danger btn-sm"
          onclick="event.stopPropagation(); deleteEmployee(${i})">
          Delete
        </button>
      </td>
    </tr>
  `).join('');
}

function openEmployeeModal(index) {
    const e = employees[index];
    document.getElementById("editEmployeeIndex").value = index;

    document.getElementById("viewEmployeeName").value = e.name;
    document.getElementById("viewEmployeeSurname").value = e.surname;
    document.getElementById("viewEmployeeEmail").value = e.email;
    document.getElementById("viewEmployeeRole").value = e.role;
    document.getElementById("viewEmployeeCode").value = e.code;

    disableEmployeeFields();

    new bootstrap.Modal(
        document.getElementById('viewEmployeeModal')
    ).show();
}

function disableEmployeeFields() {
    document.querySelectorAll('.eField').forEach(f => f.disabled = true);
    document.getElementById("enableEmployeeEditBtn").style.display = 'inline-block';
    document.getElementById("saveEmployeeChangesBtn").style.display = 'none';
}

function enableEmployeeEditing() {
    document.querySelectorAll('.eField').forEach(f => f.disabled = false);
    document.getElementById("enableEmployeeEditBtn").style.display = 'none';
    document.getElementById("saveEmployeeChangesBtn").style.display = 'inline-block';
}

function saveEmployeeChanges() {
    const index = document.getElementById("editEmployeeIndex").value;

    const formData = new FormData();
    formData.append("id", employees[index].id);
    formData.append("name", document.getElementById("viewEmployeeName").value);
    formData.append("surname", document.getElementById("viewEmployeeSurname").value);
    formData.append("email", document.getElementById("viewEmployeeEmail").value);
    formData.append("role", document.getElementById("viewEmployeeRole").value);
    formData.append("code", document.getElementById("viewEmployeeCode").value);

    fetch("update_employee.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadEmployeesFromDB();
                disableEmployeeFields();
            } else {
                alert(data.error || "Failed to update employee");
            }
        });
}

function saveEmployee() {
    const name = document.getElementById("employeeName").value.trim();
    const surname = document.getElementById("employeeSurname").value.trim();
    const email = document.getElementById("employeeEmail").value.trim();
    const role = document.getElementById("employeeRole").value;
    const code = document.getElementById("employeeCode").value;

    if (!name || !surname || !email || !role || !code)
        return alert("All fields are required");

    const formData = new FormData();
    formData.append("name", name);
    formData.append("surname", surname);
    formData.append("email", email);
    formData.append("role", role);
    formData.append("code", code);

    fetch("add_employee.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadEmployeesFromDB();
                document.getElementById("employeeForm").reset();
                bootstrap.Modal
                    .getInstance(document.getElementById('addEmployeeModal'))
                    .hide();
            } else {
                alert(data.error || "Failed to add employee");
            }
        })
        .catch(err => console.error("Error adding employee:", err));
}

function deleteEmployee(index) {
    const e = employees[index];
    if (!confirm(`Are you sure you want to delete ${e.name} ${e.surname}?`)) {
        return;
    }

    const formData = new FormData();
    formData.append("id", e.id);

    fetch("delete_employee.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                renderEmployees();
                disableEmployeeFields();
            } else {
                alert(data.error || "Failed to delete employee");
            }
        })
        .catch(err => console.error("Error deleting employee:", err));
}


function Logout() {
    fetch('logout.php',{
        method: 'POST',

    })
        .then((response) => response.json())
        .then((result) => {
            if(result.success){
                console.log("worked nigga");
                console.log(result.status);
                window.location.reload();
            }

        })
        .catch((error) => {

            console.log("error: " + error)
        })
}


// Utilities
function escapeHtml(str) {
  if (!str) return '';
  return String(str).replace(/[&<>\"']/g, s => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"}[s]));
}
function escapeHtmlAttr(str) { return escapeHtml(str).replace(/"/g, '&quot;'); }

// Initialize
window.addEventListener('DOMContentLoaded', () => {
  loadProductsFromDB();
  loadChallengesFromDB();
    loadOrdersFromDB();
    loadEmployeesFromDB();
    loadUsersFromDB();
  renderUsers();
  showSection('users');
});
</script>


</body>
</html>
