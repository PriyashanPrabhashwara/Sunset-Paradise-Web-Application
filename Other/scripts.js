document.addEventListener("DOMContentLoaded", function () {
    const cartIcon = document.querySelector(".cart-icon");
    const cartSidebar = document.querySelector(".cart-sidebar");
    const closeCartBtn = document.getElementById("close-cart");
    const cartItemsContainer = document.querySelector(".cart-items");
    const cartTotal = document.getElementById("cart-total");
    const cartCount = document.getElementById("cart-count");

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

 

    cartIcon.addEventListener("click", function () {
        cartSidebar.classList.add("show");
    });

    closeCartBtn.addEventListener("click", function () {
        cartSidebar.classList.remove("show");
    });

    cartItemsContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-item")) {
            const index = event.target.getAttribute("data-index");
            cart.splice(index, 1);
            updateCartUI();
        }
    });

    cartItemsContainer.addEventListener("input", function (event) {
        if (event.target.classList.contains("cart-item-quantity")) {
            const index = event.target.getAttribute("data-index");
            const newQuantity = parseInt(event.target.value);

            if (newQuantity > 0) {
                cart[index].quantity = newQuantity;
                updateCartUI();
            }
        }
    });

    function isUserLoggedIn() {
        return document.body.dataset.userEmail !== undefined;
    }


    function fetchCartFromDatabase() {
        fetch("fetch_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email: document.body.dataset.userEmail })
        })
        .then(response => response.json())
        .then(data => {
            if (data.cart) {
                cart = data.cart;
                updateCartUI();
            }
        });
    }
    if (isUserLoggedIn()) {
        fetchCartFromDatabase();
    }
    updateCartUI();
});
$(document).on("click", ".add-to-cart", function() {
    var food_id = $(this).data("id");
    var food_name = $(this).data("name");
    var food_price = $(this).data("price");
    var food_image = $(this).data("image");
    var quantity = $(this).siblings(".food-quantity").val();

    $.ajax({
        url: "add_to_cart.php",
        type: "POST",
        data: {
            food_id: food_id,
            name: food_name,
            price: food_price,
            image: food_image,
            quantity: quantity
        },
        success: function(response) {
            alert(response);
            fetchCart(); // Reload the cart
        }
    });
});

function updateCartTotal() {
    let total = 0;
    $(".cart-item").each(function() {
        let priceText = $(this).find("div").text();
        let priceMatch = priceText.match(/Rs (\d+\.\d+) x (\d+)/);
        if (priceMatch) {
            let price = parseFloat(priceMatch[1]);
            let quantity = parseInt(priceMatch[2]);
            total += price * quantity;
        }
    });
    $("#cart-total").text(total.toFixed(2)); // Update total
}

$(document).ready(function() {
    fetchCart();
});

function fetchCart() {
    $.ajax({
        url: "fetch_cart.php",
        type: "GET",
        success: function(response) {
            $(".cart-items").html(response);
            updateCartTotal(); // Ensure total is updated
        }
    });
}

$(document).on("click", ".remove-item", function() {
    var food_id = $(this).data("id");

    $.ajax({
        url: "remove_from_cart.php",
        type: "POST",
        data: { food_id: food_id },
        success: function(response) {
            alert(response);
            fetchCart(); // Refresh cart after removing item
        }
    });
});
