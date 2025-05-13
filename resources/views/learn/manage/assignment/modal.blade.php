<div class="modal fade" id="submitModal{{ $assignment->assid }}" tabindex="-1" aria-labelledby="submitModalLabel{{ $assignment->assid }}" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('learn.ass.submit') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="assid" value="{{ $assignment->assid }}">
          
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="submitModalLabel{{ $assignment->assid }}">提交作業：{{ $assignment->title }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="file" class="form-label">選擇檔案</label>
                      <input type="file" name="file" class="form-control" required>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                  <button type="submit" class="btn btn-success">送出</button>
              </div>
          </div>
      </form>
    </div>
  </div>