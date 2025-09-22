<!--begin::Input group-->
<div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Input-->
        {{-- {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control form-control-solid']) !!} --}}
        {!! html()->text('name', null)->attributes([
                'placeholder' => 'Name',
                'class' => 'form-control form-control-solid',
            ]) !!}
        <!--end::Input-->
        @if ($errors->has('name'))
            <span style="color:red">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
{{-- <div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <!--end::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.permission_title', 2) }}</label><br>
        <!--end::Label-->
        <!--end::Input-->
        @foreach ($permissions as $key => $value)
            {{ Form::checkbox('permissions[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name', 'id' => 'permission' . $key]) }}
            {!! html()->checkbox('permissions[]', $value->id, in_array($value->id, $rolePermissions) ? true : false)->attributes([
                    'class' => 'name',
                    'id' => 'permission' . $key,
                ]) !!}

            <label class="fs-5 fw-bold mb-2" for="permission{{ $key }}">{{ $value->name }}</label><br>
        @endforeach
        <!--end::Input-->
    </div>
    <!--end::Col-->
</div> --}}
<!--end::Input group-->

<!--begin::Input group-->
<div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-10 fv-row">
        <!--end::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.permission_title', 2) }}</label><br>
        <!--end::Label-->

        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="all_permission" value="1">
            <label class="custom-control-label" name="all_permission" style="font-weight: 600">
                All
            </label>
        </div>
        @if ($errors->has('permissions'))
            <span style="color:red">At Least one permission should be required</span>
        @endif
        <table class="table table-striped">
            <tbody style="display:flex; flex-wrap:wrap;">
                @foreach ($permissions as $key => $value)
                    <tr style="width: 30%">
                        <td>
                            {{-- {!! html()->checkbox('permissions[]', $value->id, in_array($value->id, $rolePermissions) ? true : false)->attributes([
                                    'class' => 'name permission',
                                    'id' => 'permission' . $key,
                                    'type' => 'checkbox',
                                ]) !!} --}}

                            {!! html()->checkbox('permissions[]{{ $value->name }}', in_array($value->id, $rolePermissions) ? 'checked' : '', $value->id)->attributes([
                                    'class' => 'permission',
                                    'id' => 'permission_' . $key,
                                    'type' => 'checkbox',
                                ]) !!}

                        </td>
                        <td style="font-weight: 600"> <label for="{{ 'permission_' . $key }}">
                                {{ $value->name }}</label></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Separator-->
<div class="separator mb-8"></div>
<!--end::Separator-->
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            if ($('input[type="checkbox"].permission:checked').length == $(
                    'input[type="checkbox"].permission')
                .length) {
                $('input[name="all_permission"]').prop('checked', true);
            } else {
                $('input[name="all_permission"]').prop('checked', false);
            }

            $('[name="all_permission"]').on('click', function() {
                if ($(this).is(':checked')) {
                    $.each($('.permission'), function(index, value) {
                        $(value).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function(index, value) {
                        $(value).prop('checked', false);
                    });
                }
            });

            $('input[type="checkbox"].permission').on('click', function() {
                $.each($('.permission'), function(index, value) {
                    if ($('input[type="checkbox"].permission:checked').length == $(
                            'input[type="checkbox"].permission')
                        .length) {
                        $('input[name="all_permission"]').prop('checked', true);
                    } else {
                        $('input[name="all_permission"]').prop('checked', false);
                    }
                });
            });
        });
    </script>
@endpush
