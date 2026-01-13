<?php
session_start();
require('background_db_connector.php'); // DB connection

$userId = $_SESSION['Id'];

// Fetch EcoPoints from database
$query = "SELECT EcoPoints FROM user WHERE id = $userId";
$result = mysqli_query($DbConnectionObj, $query);
$row = mysqli_fetch_assoc($result);
$ecoPoints = $row['EcoPoints'] ?? 0;
?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Checkout - DragonStone</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='bg-light'>

<div class='container py-5'>
<h2 class='mb-4'>Checkout</h2>

<div class='row justify-content-center'>
<div class='col-md-6'>
<div class='card p-4'>
<h5 class='mb-3'>Order Summary</h5>
    <p>Subtotal: <span id="subtotal">R0.00</span></p>
    <p>Discount: <span id="discount">0%</span></p>
    <p><strong>Total: <span id="total">R0.00</span></strong></p>
<hr>
<div class='mb-3 p-2 bg-success-subtle rounded'>
<strong>Your EcoPoints:</strong> <span id='ecoPoints'><?=$ecoPoints?></span>
</div>
    <button id="activatePointsBtn" class="btn btn-outline-success w-100 mb-2"
        <?= ($ecoPoints >= 500) ? '' : 'disabled' ?>
    >
        <?= ($ecoPoints >= 500) ? 'Activate Points' : 'Need 500 EcoPoints to Activate' ?>
    </button>
<button id="payNowBtn" class='btn btn-primary w-100' data-bs-toggle="modal" data-bs-target="#paymentModal">Pay Now</button>
</div>
</div>
</div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Enter Card Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="cardForm">
          <div class="mb-3">
            <label for="cardName" class="form-label">Name on Card</label>
            <input type="text" class="form-control" id="cardName" required pattern="[A-Za-z\s]+" placeholder="John Doe">>
          </div>
          <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" maxlength="16" required pattern="\d{16}" placeholder="1234567812345678">
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="expiry" class="form-label">Expiry (MM/YY)</label>
              <input type="text" class="form-control" id="expiry" required placeholder="MM/YY" maxlength="5" pattern="\d{2}/\d{2}">
            </div>
            <div class="col-md-6 mb-3">
              <label for="cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cvv" required maxlength="3" pattern="\d{3}" placeholder="123">
            </div>
          </div>
        </form>
        <div id="paymentMsg" class="text-success d-none">Payment processed successfully!</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="submitPayment" class="btn btn-primary" onclick="Pay()">Pay Now</button>
      </div>
    </div>
  </div>
</div>
<script>
    const ecoPoints = <?= (int)$ecoPoints ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let originalTotal = 0;
    let discountApplied = false;

    fetch('get_checkout_total.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                originalTotal = parseFloat(data.total);
                updateTotals(originalTotal, 0);
            }
        });

    function updateTotals(total, discountPercent) {
        const discountAmount = total * (discountPercent / 100);
        const finalTotal = total - discountAmount;

        document.getElementById('subtotal').textContent = `${total.toFixed(2)}`;
        document.getElementById('discount').textContent = `${discountPercent}%`;
        document.getElementById('total').textContent = `${finalTotal.toFixed(2)}`;
    }

    const activateBtn = document.getElementById('activatePointsBtn');

    if (activateBtn) {
        activateBtn.addEventListener('click', () => {
            if (discountApplied) return;

            const discountPercent = Math.floor(ecoPoints / 500);

            if (discountPercent > 0) {
                updateTotals(originalTotal, discountPercent);
                discountApplied = true;
                activateBtn.disabled = true;
                activateBtn.textContent = `Discount Applied (${discountPercent}%)`;
            }
        });
    }


const cardNumberInput = document.getElementById('cardNumber');
const cvvInput = document.getElementById('cvv');
const expiryInput = document.getElementById('expiry');
const cardNameInput = document.getElementById('cardName');

cardNumberInput.addEventListener('input', () => {
    cardNumberInput.value = cardNumberInput.value.replace(/\D/g, '');
});

cardNameInput.addEventListener('input', () => {
    cardNameInput.value = cardNameInput.value.replace(/[^a-zA-Z\s]/g, '');
});


// Allow only 3 digits for CVV
cvvInput.addEventListener('input', () => {
    cvvInput.value = cvvInput.value.replace(/\D/g, '').slice(0,3);
});

// Allow only digits and auto-insert slash for expiry MM/YY
expiryInput.addEventListener('input', () => {
    let val = expiryInput.value.replace(/\D/g,'').slice(0,4);
    if(val.length >= 3){
        val = val.slice(0,2) + '/' + val.slice(2);
    }
    expiryInput.value = val;
});


function Pay() {
    const form = document.getElementById('cardForm');

    //
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const price = document.getElementById('total').textContent;

    fetch('pay.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            discountApplied: discountApplied,
            price: price
        })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = "Home/Homepage.php";
            } else {
                alert(data.message || 'Payment failed');
            }
        });
}



</script>

</body>
</html>
