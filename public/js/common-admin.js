const loader = {
    show: function () {
        document.getElementById('global-loader').style.display = 'flex';
    },
    hide: function () {
        document.getElementById('global-loader').style.display = 'none';
    }
};

$(document).ready(function () {
    const roleId = parseInt(userData.roleId)

    // First hide all sidebar items
    const allItems = document.querySelectorAll('.sidebar-nav-item');
    allItems.forEach(item => item.style.display = 'none');

    // Then show relevant items based on role
    if (roleId === 1) {
        document.querySelectorAll('.sidebar-nav-item-superadmin').forEach(item => item.style.display = 'block');
    }
    if (roleId === 3) {
        document.querySelectorAll('.sidebar-nav-item-brokeradmin').forEach(item => item.style.display = 'block');
    }
    if (roleId === 4) {
        document.querySelectorAll('.sidebar-nav-item-brokerstaff').forEach(item => item.style.display = 'block');
    }
    if (roleId === 5) {
        document.querySelectorAll('.sidebar-nav-item-staff').forEach(item => item.style.display = 'block');
    }
})
