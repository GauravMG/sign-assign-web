function formatDate(dateStr) {
    const date = new Date(dateStr)

    const options = {
        weekday: 'short', // 'Mon', 'Tue', etc.
        month: 'short',   // 'Jan', 'Feb', etc.
        day: '2-digit',   // 01, 02, etc.
        year: 'numeric',  // 2024
        hour: '2-digit',  // 01, 02, etc.
        minute: '2-digit', // 00, 01, etc.
        hour12: true      // AM/PM format
    }

    return date.toLocaleString('en-US', options)
}

function formatDateWithoutTime(dateStr) {
    const date = new Date(dateStr)

    const options = {
        weekday: 'short', // 'Mon', 'Tue', etc.
        month: 'short',   // 'Jan', 'Feb', etc.
        day: '2-digit',   // 01, 02, etc.
        year: 'numeric'  // 2024
    }

    return date.toLocaleString('en-US', options)
}

function getDateFromDate(dateStr) {
    const date = new Date(dateStr)

    const options = {
        day: '2-digit',   // 01, 02, etc.
    }

    return date.toLocaleString('en-US', options)
}