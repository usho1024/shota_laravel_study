<div class="modal fade" id="restoreModal{{ $model->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $model->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                この投稿（ID: {{ $model->id }}）を再表示しますか？
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                <form action="{{ route("$table_name.display", $model->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-primary">はい</button>
                </form>
            </div>
        </div>
    </div>
</div>