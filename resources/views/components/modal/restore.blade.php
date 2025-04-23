<div class="modal fade" id="restoreModal{{ $model->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $model->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                この投稿（ID: {{ $model->id }}）を復元しますか？
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                <form action="{{ route("$table_name.restore", $model->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">はい</button>
                </form>
            </div>
        </div>
    </div>
</div>