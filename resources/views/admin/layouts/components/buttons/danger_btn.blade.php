@php
$type = isset($type) ? $type : 'button';
$id = isset($id) ? $id : '';
$size = isset($size) ? $size : 'btn-sm';
$class = isset($class) ? $class : '';
$attr = isset($attr) ? $attr : '';
$title = isset($title) ? $title : 'Save';
$color = 'danger';
@endphp
<button type="{{ $type }}" class="btn btn-{{ $color }} me-2 {{ $size }} {{ $class }}"
    id="{{ $id }}" {{ $attr }}>{{ $title }}</button>
