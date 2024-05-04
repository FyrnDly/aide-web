// Modal get data edit schedule
const editModal = document.getElementById('editModal')
if (editModal) {
    editModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const time = button.getAttribute('data-bs-time')
        const duration = button.getAttribute('data-bs-duration')
        
        // Update the modal's content.
        const modalTitle = editModal.querySelector('.modal-title')
        const modalInputTime = editModal.querySelector('.modal-body input#floatingTime')
        const modalInputDuration = editModal.querySelector('.modal-body input#floatingDuration')

        modalTitle.textContent = `Ubah Waktu Operasi ${time}`
        modalInputTime.value = time
        modalInputDuration.value = duration
    })
}

// Modal get data delete schedule
const deleteModal = document.getElementById('deleteModal')
if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const time = button.getAttribute('data-bs-time')

        // Update the modal's content.
        const modalTitle = deleteModal.querySelector('.modal-title')
        const modalBody = deleteModal.querySelector('.modal-body span')

        modalTitle.textContent = `Hapus Waktu Operasi ${time}`
        modalBody.textContent =
            `Apakah anda yakin ingin menghapus jam operasi ${time}? <br>Jam pengoperasian robot dapat ditambahkan
        kembali`
    })
}