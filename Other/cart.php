<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="shop.css?v=<?php echo time(); ?>">
</head>
<body>

<header>
    <h1>Your Cart</h1>
    <a href="shop.php">Back to Menu</a>
</header>

<main>
    <div id="cart-items"></div>
    <button onclick="checkout()">Proceed to Checkout</button>
</main>

<script>
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartContainer = document.getElementById("cart-items");

    cart.forEach(item => {
        cartContainer.innerHTML += `<p>${item.name} - RS.${item.price} x ${item.quantity}</p>`;
    });

    function checkout() {
        localStorage.removeItem("cart");
        alert("Order placed successfully!");
        window.location.href = "shop.php";
    }
</script>

</body>
</html>
