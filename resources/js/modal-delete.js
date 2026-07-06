window.openDeleteModal = function(route, name) {
    document.getElementById('delete-form').action = route;
    document.getElementById('modal-habit-name').textContent = name;
    document.getElementById('delete-modal').classList.remove('hidden');
}

window.closeDeleteModal = function() {
    document.getElementById('delete-modal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('delete-modal');
    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === this) window.closeDeleteModal();
        });
    }
});