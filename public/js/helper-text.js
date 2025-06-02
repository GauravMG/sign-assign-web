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

function getTextFromHTML(htmlString, maxLength) {
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = htmlString;
    const text = tempDiv.textContent || tempDiv.innerText || "";

    if (maxLength && text.length > maxLength) {
        return text.slice(0, maxLength).trim() + "...";
    }

    return text;
}
