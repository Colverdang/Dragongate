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
<p>Subtotal: <span id='subtotal'>R0.00</span></p>
<p><strong>Total: <span id='total'>R0.00</span></strong></p>
<hr>
<div class='mb-3 p-2 bg-success-subtle rounded'>
<strong>Your EcoPoints:</strong> <span id='ecoPoints'>120</span>
</div>
<button id="activatePointsBtn" class='btn btn-outline-success w-100 mb-2'>Activate Points</button>
<!-- Pay Now triggers modal -->
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
            <input type="text" class="form-control" id="cardName" required>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
fetch('get_checkout_total.php')
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const total = parseFloat(data.total).toFixed(2);
            document.getElementById('subtotal').textContent = `R${total}`;
            document.getElementById('total').textContent = `R${total}`;
        }
    });

// Simulate payment processing
document.getElementById('submitPayment').addEventListener('click', () => {
    const form = document.getElementById('cardForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    // Here you would normally send card data to your payment gateway via AJAX
    document.getElementById('paymentMsg').classList.remove('d-none');
    setTimeout(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
        modal.hide();
        // Optionally redirect to success page
        // window.location.href = "order_success.php";
    }, 1500);
});

const cardNumberInput = document.getElementById('cardNumber');
const cvvInput = document.getElementById('cvv');
const expiryInput = document.getElementById('expiry');

// Allow only numbers for card number
cardNumberInput.addEventListener('input', () => {
    cardNumberInput.value = cardNumberInput.value.replace(/\D/g, '');
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
    fetch('pay.php')
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = "Home/Homepage.php";
        }
    });
}
</script>

</body>
</html>
