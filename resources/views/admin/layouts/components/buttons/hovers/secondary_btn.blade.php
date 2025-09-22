@php
$type = isset($type) ? $type : 'button';
$id = isset($id) ? $id : '';
$size = isset($size) ? $size : 'btn-sm';
$class = isset($class) ? $class : 'btn-primary';
$attr = isset($attr) ? $attr : '';
$title = isset($title) ? $title : 'Save';
$color = 'secondary';
@endphp
<button type="{{ $type }}"
    class="btn btn-text-{{ $color }} btn-hover-light-{{ $color }} font-weight-bold me-2 {{ $size }} {{ $class }}"
    id="{{ $id }}" {{ $attr }}>{{ $title }}</button>
