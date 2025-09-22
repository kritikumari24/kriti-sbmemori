<!--begin::Card body-->
<div class="card-body">

    {{-- <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <!--begin::Label-->
            <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.name_title', 1) }}</label>
            <!--end::Label-->
            <!--begin::Input-->
            {!! Form::text('name', null, ['placeholder' => __('placeholder.name'), 'class' => 'form-control form-control-solid']) !!}
            <!--end::Input-->
            @if ($errors->has('name'))
                <span style="color:red">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group--> --}}

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.title_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! html()->text('title', null)->attributes([
                    'placeholder' => trans_choice('content.title_title', 1),
                    'class' => 'form-control form-control-lg form-control-solid',
                ]) !!}
        </div>
        <!--end::Col-->

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! html()->text('name', null)->attributes([
                    'placeholder' => trans_choice('content.name_title', 1),
                    'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                ]) !!}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">
            <span class="required">{{ trans_choice('content.quantity_title', 1) }}</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                title="Quantity should be atleast 1."></i>
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! html()->number('quantity', null)->attributes([
                    'placeholder' => trans_choice('content.quantity_title', 1),
                    'class' => 'form-control form-control-lg form-control-solid',
                ]) !!}
        </div>
        <!--end::Col-->

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">
            <span class="required">{{ trans_choice('content.price_title', 1) }}</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                title="Price should be atleast 1."></i>
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! html()->number('price', null)->attributes([
                    'placeholder' => trans_choice('content.price_title', 1),
                    'class' => 'form-control form-control-lg form-control-solid',
                ]) !!}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">

        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">
            <span class="">{{ trans_choice('content.products.upload_product_images', 1) }}</span>
            <i class=" fas
                fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                title="Upload Product Image"></i>
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            <input type="file" name="product_images[]" id="product_image"
                class="form-control form-control-lg form-control-solid" placeholder={{ __('placeholder.upload_image') }}
                multiple="true" accept="image/*">
        </div>
        <!--end::Col-->
        <div class="col-lg-6 productImgPreview"></div>

        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            {{-- <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                <span class="">{{ trans_choice('content.products.upload_product_images', 1) }}</span>
                <i class=" fas
                fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                    title="Upload Product Image"></i>
            </label>
            <!--end::Label--> --}}

            <!--begin::Select-->
            {{-- <input type="file" name="product_images[]" id="product_image" class="form-control form-control-solid"
                placeholder={{ __('placeholder.upload_image') }} multiple="true" accept="image/*"> --}}
            <!--end::Select-->
            {{-- <div class="form-group row">
                <div class="col-lg-12 productImgPreview"></div>
            </div> --}}
            <div>
                @if (!empty($product->product_images))
                    @foreach ($product->product_images as $product_image)
                        @php
                            $image_id = $product_image->id;
                        @endphp
                        <div class="image-input image-input-outline product_div">
                            <span
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow dlete_product_img"
                                data-id="{{ $image_id }}" data-bs-toggle="tooltip" title="Delete Product Image"
                                style="transform: translate(70px,25px);">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <div class="image-input-wrapper w-80px h-80px m-2"
                                style="background-image: url({{ $product_image->name }})"></div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ProductRequest', 'form') !!}

    <script>
        $('#product_image').on('change', function() {
            multipleImagesPreview(this, 'div.productImgPreview');
        });

        $(document).on('click', '.dlete_product_img', function() {
            var id = $(this).data('id');
            var elem = $(this).parents('.product_div');
            var url = `{{ url('/') }}/admin/products/delete-images/` + id;
            deleteImage(url, elem);
        });
    </script>
@endpush
