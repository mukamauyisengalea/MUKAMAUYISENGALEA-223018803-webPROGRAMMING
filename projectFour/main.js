document.addEventListener('DOMContentLoaded', () => {
    const convertBtn = document.getElementById('convert-btn');
    const amountInput = document.getElementById('amount');
    const currencySelect = document.getElementById('currency');
    const rateInput = document.getElementById('rate');
    const resultText = document.getElementById('result-text');
    const resultBox = document.getElementById('result-box');

    convertBtn.addEventListener('click', () => {
        const amount = parseFloat(amountInput.value);
        const rate = parseFloat(rateInput.value);
        const currency = currencySelect.value;

        // Validation
        if (isNaN(amount) || isNaN(rate) || !currency) {
            showError("Please enter valid amount, rate and select a currency.");
            return;
        }

        if (amount < 0 || rate < 0) {
            showError("Values cannot be negative.");
            return;
        }

        // Calculation: Result = Amount * Rate
        // Logic: How many [selected currency] units you get for the given amount of FRW
        const convertedAmount = (amount * rate).toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 4
        });

        // Display Result with animation
        animateResult();
        resultText.innerHTML = `Converted to ${currency}: <span class="value-highlight">${convertedAmount} ${currency}</span>`;
    });

    function showError(message) {
        resultText.innerText = message;
        resultText.style.color = "#ef4444"; // Red for error
        setTimeout(() => {
            resultText.style.color = "#f8fafc";
        }, 3000);
    }

    function animateResult() {
        resultBox.style.transform = "scale(1.02)";
        resultBox.style.boxShadow = "0 0 20px rgba(59, 130, 246, 0.3)";
        
        setTimeout(() => {
            resultBox.style.transform = "scale(1)";
            resultBox.style.boxShadow = "none";
        }, 200);
    }
});
