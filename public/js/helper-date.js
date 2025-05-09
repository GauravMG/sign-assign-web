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
