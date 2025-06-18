function formatDate(dateStr) {
    // Parse as ISO string but treat it as local, not UTC
    const [datePart, timePart] = dateStr.split('T');
    const [year, month, day] = datePart.split('-');
    const [hour, minute, second] = timePart.split(/[:.Z]/);

    const localDate = new Date(
        Number(year),
        Number(month) - 1,
        Number(day),
        Number(hour),
        Number(minute),
        Number(second)
    );

    const options = {
        weekday: 'short', // 'Mon', 'Tue', etc.
        month: 'short',   // 'Jan', 'Feb', etc.
        day: '2-digit',   // '01', '02', etc.
        year: 'numeric',  // '2024'
        hour: '2-digit',  // '01', '02', etc.
        minute: '2-digit', // '00', '01', etc.
        hour12: true,      // AM/PM format
    };

    return localDate.toLocaleString('en-US', options);
}

function formatDateWithoutTime(dateStr) {
    // Parse as ISO string but treat it as local, not UTC
    const [datePart, timePart] = dateStr.split('T');
    const [year, month, day] = datePart.split('-');
    const [hour, minute, second] = timePart.split(/[:.Z]/);

    const localDate = new Date(
        Number(year),
        Number(month) - 1,
        Number(day),
        Number(hour),
        Number(minute),
        Number(second)
    );

    const options = {
        weekday: 'short', // 'Mon', 'Tue', etc.
        month: 'short',   // 'Jan', 'Feb', etc.
        day: '2-digit',   // '01', '02', etc.
        year: 'numeric',  // '2024'
    };

    return localDate.toLocaleString('en-US', options);
}

function getDateFromDate(dateStr) {
    const date = new Date(dateStr);
    return String(date.getUTCDate()).padStart(2, '0');
}

function getDateTimeDifference(startStr, endStr) {
    const start = new Date(startStr);
    const end = new Date(endStr);

    let diffMs = end - start; // Difference in milliseconds
    if (diffMs < 0) diffMs = 0; // Ensure non-negative

    const totalMinutes = Math.floor(diffMs / 60000);
    const days = Math.floor(totalMinutes / (24 * 60));
    const hours = Math.floor((totalMinutes % (24 * 60)) / 60);
    const minutes = totalMinutes % 60;

    return `${days}d ${hours}h ${minutes}m`;
}
