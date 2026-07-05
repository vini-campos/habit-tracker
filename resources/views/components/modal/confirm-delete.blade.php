<div id="delete-modal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
    <div class="bg-white border-2 border-black habit-shadow-lg p-6 w-full max-w-sm font-mono">

        <h2 class="text-lg font-bold mb-1">Confirmar exclusão</h2>
        <div class="border-t-2 border-black my-3"></div>

        <p class="text-sm text-gray-600 mb-1">Tem certeza que deseja deletar o hábito</p>
        <div class="relative inline-block w-full px-3 py-1 mb-6">
            <div class="absolute inset-0 bg-habit-orange -skew-x-16"></div>
            <p id="modal-habit-name" class="relative font-bold text-center font-mono text-white"></p>
        </div>
        <div class="flex justify-end gap-3">
            <button
                onclick="closeDeleteModal()"
                class="px-4 py-2 border-2 border-black habit-shadow-lg-btn bg-white font-mono font-bold hover:bg-gray-100 cursor-pointer">
                Cancelar
            </button>

            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="px-4 py-2 border-2 border-black habit-shadow-lg-btn bg-red-500 text-white font-mono font-bold hover:bg-red-600 cursor-pointer">
                    Sim, deletar
                </button>
            </form>
        </div>
    </div>
</div>