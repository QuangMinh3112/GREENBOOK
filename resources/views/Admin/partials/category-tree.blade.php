<ul>
    @foreach ($children as $child)
        <div class="d-flex bordered ">
            <i class="fa-solid fa-arrow-turn-up fa-flip-horizontal fa-xl my-3 px-1 py-3"></i>
            <li class="d-flex justify-content-between w-100 p-2 shadow-sm my-2 rounded border">
                <div class="mx-3 ">{{ $child->name }}</div>
                <div class="d-flex">
                    <!-- Nút View -->
                    <x-button.view-btn :route="$show" :id="$child->id" />
                    {{-- Sửa --}}
                    <x-button.edit-btn :route="$edit" :id="$child->id" />
                    {{-- Xoá --}}
                    <x-button.force-del-btn :route="$delete" :id="$child->id" />
                </div>
            </li>

        </div>
        @if (count($child->children))
            @include('Admin.partials.category-tree', ['children' => $child->children, 'show' => $show, 'edit' => $edit, 'delete', $delete])
        @endif
    @endforeach
</ul>
