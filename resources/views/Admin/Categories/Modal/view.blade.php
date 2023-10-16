<!-- Bảng View -->
<div class="modal fade shadow" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input disabled type="email" id="name" class="form-control bg-light">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input disabled type="email" id="slug" class="form-control bg-light">
                    </div>
                    <label class="form-label">Mô tả</label>
                    <div class="form-floating">
                        <textarea disabled class="form-control bg-light" id="description" style="height: 100px"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
