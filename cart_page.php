<?php
session_start();
include 'background_db_connector.php';

$userId = $_SESSION['Id'];
$active = 1;

// 1) Check for active order session
$SQLStr = "SELECT Id FROM cart WHERE UserId = ? AND State = ?";
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
    $sql = "SELECT P.Id, C.Id AS cartitem_id, P.Name, P.Price, P.Carbon, P.Image
            FROM cartitem C
            JOIN products P ON C.productid = P.Id
            WHERE C.cartid = $OrderId AND C.active = 1";

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
<thead><tr><th>Product</th><th>Price</th><th>Carbon Footprint</th><th></th></tr></thead>
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
    $carbonTotal += $p['Carbon'] * ($p['Qty'] ?? 1);
?>
<tr>
    <td><img src='<?= $p['Image'] ?>' width='50' class='me-2'> <?= $p['Name'] ?></td>
    <td>R<?= number_format($p['Price'],2) ?></td>
    <td><?= number_format($p['Carbon'],2) ?> kg CO₂</td>
    <td><a onclick="removeFromCart(<?= $p['cartitem_id'] ?>)" class='btn btn-sm btn-danger'>&times;</a></td>
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

function removeFromCart(id) {
    fetch(`remove_from_cart.php?id=${id}`)
        .then(() => location.reload());
}
</script>

</body>
</html>
