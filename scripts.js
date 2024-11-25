// Example: Validate transaction amount before submitting the form
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const amountInput = document.querySelector('input[name="amount"]');

    form.addEventListener("submit", (event) => {
        if (amountInput.value <= 0) {
            event.preventDefault();
            alert("Transaction amount must be greater than 0.");
        }
    });
});
