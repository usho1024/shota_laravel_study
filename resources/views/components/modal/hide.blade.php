<div class="modal fade" id="deleteModal{{ $model->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $model->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                この{{ $table_text }}（ID: {{ $model->id }}）を非表示にしますか？<br>
                ※他のユーザーからは見えなくなります。
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                <form action="{{ route("$table_name.hide", $model->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-primary">はい</button>
                </form>
            </div>
        </div>
    </div>
</div>