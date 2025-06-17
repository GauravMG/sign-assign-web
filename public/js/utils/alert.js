function showAlert({
    type = 'info',
    title = '',
    text = '',
    confirmText = 'OK',
    cancelText = 'Cancel',
    showCancel = false,
    onConfirm = null,
    onCancel = null,
    timer = null
}) {
    const options = {
        icon: type,
        title: title,
        text: text,
        showCancelButton: showCancel,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        timer: timer,
        reverseButtons: true,
        allowOutsideClick: !showCancel
    };

    Swal.fire(options).then((result) => {
        if (result.isConfirmed && typeof onConfirm === 'function') {
            onConfirm();
        } else if (result.dismiss === Swal.DismissReason.cancel && typeof onCancel === 'function') {
            onCancel();
        }
    });
}
