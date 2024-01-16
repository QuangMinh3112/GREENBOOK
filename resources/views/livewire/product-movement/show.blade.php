<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-green">
        <h6 class="m-0 font-weight-bold text-white">Chi tiết đơn nhập hàng</h6>
    </div>
    <div class="card-body p-5" id="printable-card">
        <div>
            <div class="mb-3 text-center">
                <h3 class="card-title ">ĐƠN NHẬP HÀNG</h3>
                <p class="card-text">Ngày nhập:
                    {{ \Carbon\Carbon::parse($product_movement->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>
        <p class="card-text">Người tạo: {{ $product_movement->creator }}</p>
        <div class="d-flex">
            <p class="card-text">Nội dung nhập hàng: </p>
            <div>
                {{ $product_movement->description }}
            </div>
        </div>
        <p class="card-text">Ghi chú: {{ $product_movement->note }}</p>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên hàng</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá nhập</th>
                        <th scope="col">Tổng hoá đơn</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $total = 0;
                    @endphp
                    @foreach ($product_transition as $data)
                        <tr>
                            <th>{{ $i }}</th>
                            <td>{{ $data->getBookName() }}</td>
                            <td>{{ $data->quantity }} quyển</td>
                            <td>{{ $data->getBookPrice() }} VNĐ</td>
                            <td>{{ $data->total }} VNĐ</td>
                        </tr>
                        @php
                            $i++;
                            $total += $data->total;
                        @endphp
                    @endforeach
                </tbody>
                <tr>
                    <th colspan="4">Tổng tiền</th>
                    <td>{{ $total }} VNĐ</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card-footer ">
        <div class="d-flex justify-content-between">
            <button class="btn btn-secondary" onclick="window.printCard()">In đơn nhập <i
                    class="fa-solid fa-print"></i></button>
            <x-button.previous-btn></x-button.previous-btn>
        </div>
    </div>
</div>
@push('script')
    <script>
        function printCard() {
            var printContents = document.getElementById("printable-card").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
