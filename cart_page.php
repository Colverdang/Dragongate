<?php
session_start();
include 'background_db_connector.php';

$userId = $_SESSION['Id'];
$active = 1;

// 1) Check for active order session
$SQLStr = "SELECT Id FROM OrderSession WHERE User_Id = ? AND ACTIVE = ?";
$StmtObj = $DbConnectionObj->prepare($SQLStr);
$StmtObj->bind_param('ii', $userId, $active);
$StmtObj->execute();
$StmtObj->bind_result($OrderId);
$StmtObj->fetch();
$StmtObj->close();

// If no active order session → cart is empty
if (empty($OrderId)) {
    $products = [];
    $total = 0;
    $carbonTotal = 0;
} else {

    // 2) Load cart items
    $sql = "SELECT P.Id, P.Name, P.Price, P.CarbonFootprint, P.Image
            FROM OrderLineItem C
            JOIN Product P ON C.Product = P.Id
            WHERE C.Session = $OrderId";

    $result = $DbConnectionObj->query($sql);

    $products = [];
    $total = 0;
    $carbonTotal = 0;

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='bg-light'>

<div class='container py-5'>
<h2>Your Cart</h2>

<table class='table table-bordered bg-white'>
<thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th><th></th></tr></thead>
<tbody>
<?php if (empty($products)): ?>
<tr>
    <td colspan="5" class="text-center py-4">
        <strong>Your cart is empty.</strong>
    </td>
</tr>
<?php else: ?>
<?php foreach ($products as $p):
    $line = $p['Price'] * ($p['Qty'] ?? 1);
    $total += $line;
    $carbonTotal += $p['CarbonFootprint'] * ($p['Qty'] ?? 1);
?>
<tr>
    <td><img src='<?= $p['Image'] ?>' width='50' class='me-2'> <?= $p['Name'] ?></td>
    <td>R<?= number_format($p['Price'],2) ?></td>
    <td>
        <input type='number' min='1' value='<?= ($p['Qty'] ?? 1) ?>' class='form-control form-control-sm qty-input' data-id='<?= $p['Id'] ?>'>
    </td>
    <td>R<?= number_format($line,2) ?></td>
    <td><a href='remove_from_cart.php?id=<?= $p['Id'] ?>' class='btn btn-sm btn-danger'>&times;</a></td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</tbody>

</table>

<div class='p-3 bg-success text-white rounded mb-3'>
<strong>Total Carbon Footprint:</strong> <?= number_format($carbonTotal,2) ?> kg CO₂
</div>

<div class='text-end'>
<a href='checkout.php' class='btn btn-primary btn-lg'>Proceed to Checkout</a>
</div>
</div>

<script>
document.querySelectorAll('.qty-input').forEach(input=>{
    input.addEventListener('change',()=>{
        fetch('update_cart_qty.php',{
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:`id=${input.dataset.id}&qty=${input.value}`
        }).then(()=>location.reload());
    });
});
</script>

</body>
</html>
