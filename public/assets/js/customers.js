const searchInput = document.getElementById("searchInput");

if (searchInput) {
    searchInput.addEventListener("keyup", function () {
        const value = this.value.toLowerCase();

        const rows = document.querySelectorAll("tbody tr");

        rows.forEach((row) => {
            row.style.display = row.innerText.toLowerCase().includes(value)
                ? ""
                : "none";
        });
    });
}
const editButtons = document.querySelectorAll(".editBtn");

editButtons.forEach((button) => {
    button.addEventListener("click", function () {
        const id = this.dataset.id;

        const name = this.dataset.name;

        const email = this.dataset.email;

        const phone = this.dataset.phone;

        const address = this.dataset.address;

        document.getElementById("editName").value = name;

        document.getElementById("editEmail").value = email;

        document.getElementById("editPhone").value = phone;

        document.getElementById("editAddress").value = address;

        document.getElementById("editForm").action = `/customers/${id}`;
    });
});
const deleteForms = document.querySelectorAll(".deleteForm");

deleteForms.forEach((form) => {
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Delete customer?",
            text: "Data cannot be restored",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
