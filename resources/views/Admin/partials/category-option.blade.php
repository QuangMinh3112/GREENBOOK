@php
    function printCategory($category, $prefix = '')
    {
        echo '<option value="' . $category->id . '" >' . $prefix . $category->name . '</option>';
        if ($category->children) {
            foreach ($category->children as $child) {
                printCategory($child, $prefix . '---');
            }
        }
    }
@endphp

<option value="">Chọn danh mục</option>
@foreach ($categories as $category)
    @php
        printCategory($category, ' ');
    @endphp
@endforeach
