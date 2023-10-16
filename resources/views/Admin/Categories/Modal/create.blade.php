  <!-- Modal -->
  <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-dark text-white">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm mới danh mục</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="{{ route('admin.category.create') }}">
                  @csrf
                  <div class="modal-body">
                      <div class="mb-3">
                          <label class="form-label">Tên danh mục</label>
                          <input type="text" class="form-control" name="name">
                      </div>
                      <div class="mb-3">
                          <label class="form-label">Mô tả</label>
                          <textarea class="form-control" name="description"></textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                      <button type="submit" class="btn btn-success">Thêm mới</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
