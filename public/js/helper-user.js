function formatAddress(userAddress) {
    const {
        streetAddress = "",
        address = "",
        city = "",
        state = "",
        postal = "",
        pinCode = "",
        country = "",
    } = userAddress || {}

    // Collect non-empty parts
    const parts = [
        streetAddress?.trim(),
        address?.trim(),
        city?.trim(),
        state?.trim(),
        postal?.trim(),
        pinCode?.trim(),
        country?.trim(),
    ].filter(part => part && part.length > 0)

    // Join the address parts with commas
    return parts.join(", ")
}

function formatAddressWithName(userAddress) {
    const {
        fullName = "",
        firstName = "",
        lastName = "",
        streetAddress = "",
        address = "",
        city = "",
        state = "",
        postal = "",
        pinCode = "",
        country = "",
    } = userAddress || {}

    // Determine the name
    const name = fullName?.trim() || `${firstName?.trim()} ${lastName?.trim()}`.trim()

    // Collect non-empty address parts
    const parts = [
        name,
        streetAddress?.trim(),
        address?.trim(),
        city?.trim(),
        state?.trim(),
        postal?.trim(),
        pinCode?.trim(),
        country?.trim(),
    ].filter(part => part && part.length > 0)

    // Join the parts with commas
    return parts.join(", ")
}

function createFullName({
    firstName,
    lastName
}) {
    // Trim both parts and filter out any empty values before joining
    return [firstName.trim(), lastName.trim()].filter(Boolean).join(" ")
}
