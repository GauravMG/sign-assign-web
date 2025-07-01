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

function parseSize(sizeStr) {
    // Normalize smart quotes and remove extra details
    sizeStr = sizeStr
        .replace(/[”"]/g, '"')
        .replace(/[’']/g, "'")
        .split(",")[0] // only consider the first part if there is extra text
        .trim();

    const inchRegex = /(\d+)\s*["]\s*[xX]\s*(\d+)\s*["]/;
    const footRegex = /(\d+)\s*[']\s*[xX]\s*(\d+)\s*[']/;
    const genericRegex = /(\d+)\s*[xX]\s*(\d+)/;

    let match;
    if ((match = sizeStr.match(inchRegex))) {
        return {
            width: parseInt(match[1], 10),
            height: parseInt(match[2], 10),
            unit: "in"
        };
    } else if ((match = sizeStr.match(footRegex))) {
        return {
            width: parseInt(match[1], 10),
            height: parseInt(match[2], 10),
            unit: "ft"
        };
    } else if ((match = sizeStr.match(genericRegex))) {
        // If no units are provided, assume inches
        return {
            width: parseInt(match[1], 10),
            height: parseInt(match[2], 10),
            unit: "in"
        };
    } else {
        return null; // invalid or unrecognized format
    }
}  
