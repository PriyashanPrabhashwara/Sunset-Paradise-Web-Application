document.addEventListener("DOMContentLoaded", function () {
    let profileBtn = document.getElementById("profileBtn");

    if (profileBtn) {
        profileBtn.addEventListener("click", function () {
            fetch("fetch_user.php")
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: "Manage Profile",
                            html: `
                                <div style="text-align:left;">
                                    <label><b>Full Name</b></label>
                                    <div class="swal-input-container">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="fullName" class="swal-input" value="${data.fullName}" placeholder="Full Name">
                                    </div>

                                    <label><b>Email</b></label>
                                    <div class="swal-input-container">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="email" class="swal-input" value="${data.email}" placeholder="Email">
                                    </div>

                                    <label><b>Password</b></label>
                                    <div class="swal-input-container">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="password" class="swal-input" value="${data.password}" placeholder="Password">
                                    </div>

                                    <label><b>Phone Number</b></label>
                                    <div class="swal-input-container">
                                        <i class="fas fa-phone"></i>
                                        <input type="text" id="phone" class="swal-input" value="${data.phone}" placeholder="Phone Number">
                                    </div>
                                </div>
                            `,
                            showCancelButton: true,
                            confirmButtonText: "Update",
                            confirmButtonColor: "#6c5ce7",
                            cancelButtonColor: "#95a5a6",
                            preConfirm: () => {
                                let fullName = document.getElementById("fullName").value.trim();
                                let email = document.getElementById("email").value.trim();
                                let password = document.getElementById("password").value.trim();
                                let phone = document.getElementById("phone").value.trim();

                                if (!fullName || !email || !password || !phone) {
                                    Swal.showValidationMessage("All fields are required!");
                                    return false;
                                }
                                return { fullName, email, password, phone };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                updateProfile(result.value);
                            }
                        });
                    } else {
                        Swal.fire("Error", "Unable to load profile data.", "error");
                    }
                });
        });
    }
});

function updateProfile(data) {
    fetch("update_profile.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            Swal.fire("Success", "Profile updated successfully!", "success").then(() => {
                location.reload(); // Reload to reflect changes
            });
        } else {
            Swal.fire("Error", result.message, "error");
        }
    });
}
