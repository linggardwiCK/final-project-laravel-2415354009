const searchInput =
    document.getElementById("searchInput");

if (searchInput) {

    searchInput.addEventListener("keyup", function () {

        const value =
            this.value.toLowerCase();

        const rows =
            document.querySelectorAll("tbody tr");

        rows.forEach((row) => {

            row.style.display =
                row.innerText.toLowerCase()
                .includes(value)
                    ? ""
                    : "none";

        });

    });

}

const editButtons =
    document.querySelectorAll(".editBtn");

editButtons.forEach((button) => {

    button.addEventListener("click", function () {

        document.getElementById("editName")
            .value = this.dataset.name;

        document.getElementById("editPrice")
            .value = this.dataset.price;

        document.getElementById("editDescription")
            .value = this.dataset.description;

        document.getElementById("editForm")
            .action = `/services/${this.dataset.id}`;

    });

});

const deleteForms =
    document.querySelectorAll(".deleteForm");

deleteForms.forEach((form) => {

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        Swal.fire({
            title: "Delete service?",
            text: "Data cannot be restored",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes Delete"
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});