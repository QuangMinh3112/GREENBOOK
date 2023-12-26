<ul>
    @foreach ($children as $child)
        <div class="d-flex bordered ">
            <i class="fa-solid fa-arrow-turn-up fa-flip-horizontal fa-xl my-2 px-1 py-3"></i>
            <li class="d-flex justify-content-between w-100 p-2 shadow-sm my-2 rounded border">
                <div class="mx-3 ">{{ $child->name }}</div>
                <div class="d-flex">
                    <!-- Nút View -->
                    <a wire:navigate href="{{ route($show, $child->id) }}" class="mx-2 text-secondary"><i
                            class="fa-solid fa-eye"></i></a>
                    {{-- Sửa --}}
                    <a wire:navigate href="{{ route($edit, $child->id) }}" class="mx-2 text-success"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    {{-- Xoá --}}
                    <a href="" class="mx-2 text-danger" wire:click.prevent="delete({{ $child->id }})"><i
                            class="fa-solid fa-trash"></i></a>
                </div>
            </li>

        </div>
        @if (count($child->children))
            @include('Admin.partials.category-tree', [
                'children' => $child->children,
                'edit' => $edit,
                'show' => $show,
            ])
        @endif
    @endforeach
</ul>
