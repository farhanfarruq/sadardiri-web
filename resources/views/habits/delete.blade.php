<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteHabitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark-2 border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title text-light">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-light">Apakah Anda yakin ingin menghapus kebiasaan "<span id="habitName"></span>"? Data yang sudah dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Inisialisasi modal hapus
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteHabitModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var habitId = button.getAttribute('data-habit-id');
            var habitName = button.getAttribute('data-habit-name');
            var formAction = "{{ route('habits.destroy', ':id') }}".replace(':id', habitId);
            
            document.getElementById('habitName').textContent = habitName;
            document.getElementById('deleteForm').action = formAction;
        });
    });
</script>