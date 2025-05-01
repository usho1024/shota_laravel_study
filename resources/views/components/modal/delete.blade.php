<div class="modal fade" id="deleteModal{{ $model->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $model->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                この{{ $table_text }}（ID: {{ $model->id }}）を本当に削除しますか？
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                <form action="{{ route("$table_name.destroy", $model->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">はい</button>
                </form>
            </div>
        </div>
    </div>
</div>