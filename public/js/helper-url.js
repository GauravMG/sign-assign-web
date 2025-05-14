function getLinkFromName(input) {
    // Convert to lowercase
    input = input.toLowerCase();

    // Replace spaces with hyphens
    input = input.replace(/\s+/g, '-');

    return input;
}
