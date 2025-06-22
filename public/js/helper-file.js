function getFileIcon(ext) {
    switch (ext) {
        case 'psd': return 'fas fa-file-image';
        case 'ai': return 'fas fa-file-code';
        case 'cdr': return 'fas fa-file';
        case 'pdf': return 'fas fa-file-pdf';
        case 'eps': return 'fas fa-file-export';
        case 'zip': case 'rar': return 'fas fa-file-archive';
        default: return 'fas fa-file';
    }
}
