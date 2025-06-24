function capitalizeFirstLetter(str) {
    return str
        .toLowerCase() // Convert the whole string to lowercase to handle mixed case input
        .split(' ') // Split the string into an array of words
        .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // Capitalize the first letter of each word
        .join(' '); // Join the words back into a single string
}

function formatINR(amount) {
    return new Intl.NumberFormat("en-IN").format(amount)
}

function sliceTextWithEllipses(text, maxLength) {
    if (maxLength && text.length > maxLength) {
        return text.slice(0, maxLength).trim() + "...";
    }
    return text;
}

function getTextFromHTML(htmlString, maxLength) {
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = htmlString;
    const text = tempDiv.textContent || tempDiv.innerText || "";

    if (maxLength && text.length > maxLength) {
        return text.slice(0, maxLength).trim() + "...";
    }

    return text;
}

function validateDecimal(input) {
    // Allow empty value or decimal (e.g. 0.5, 10, 10.25)
    const value = input.value;
    if (value === '') return;

    const isValid = /^(\d+(\.\d{0,2})?)?$/.test(value);
    if (!isValid) {
        // Remove last character if it's invalid
        input.value = value.slice(0, -1);
    }
}
