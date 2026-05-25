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

const statusSelects =
    document.querySelectorAll(".statusSelect");

statusSelects.forEach((select) => {

    select.addEventListener("change", function () {

        this.closest("form").submit();

    });

});