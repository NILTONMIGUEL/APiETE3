// --- MODAL & FORMULÁRIO ---
function openModal(isEdit = false) {
    document.getElementById('productModal').classList.add('active');
    document.getElementById('modalTitle').innerText = isEdit ? 'Editar Produto' : 'Adicionar Novo Produto';
    if (!isEdit) {
        document.getElementById('productForm').reset();
        document.getElementById('productId').value = '';
    }
}

function closeModal() {
    document.getElementById('productModal').classList.remove('active');
}

