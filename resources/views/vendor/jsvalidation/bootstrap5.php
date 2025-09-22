<script>
    jQuery(document).ready(function() {

        $("<?= $validator['selector']; ?>").each(function() {
            $(this).validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',

                // errorPlacement: function(error, element) {
                //     if (element.parent('.input-group').length ||
                //         element.prop('type') === 'checkbox' || element.prop('type') === 'radio' || element.prop('type') === 'file') {
                //         error.insertAfter(element.parent());
                //         // else just place the validation message immediately after the input
                //     } else {
                //         error.insertAfter(element);
                //     }
                // },
                errorPlacement: function(error, element) {
                    if (element.attr("type") == "radio") {
                        error.insertAfter(element.parents('div').find('.radio-list'));
                    } else if (element.attr("data-control") == 'select2') {
                        error.insertAfter(element.next('span'));
                    } else if (element.hasClass('div_card_img')) {
                        // console.log('sawed');
                        // console.log(error.insertAfter(element.parents('div').next('span')));
                        error.insertAfter(element.parents('div').next('span'));
                    } else if (element.hasClass('ckeditor')) {
                        // console.log('1238e12iberia78r3i9');
                        error.insertAfter(element.parents('div').next('span'));
                    } else {
                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    }
                },
                highlight: function(element) {
                    $(element).removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group
                },

                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])) : ?>

                    ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>


                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },

                success: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group
                },

                focusInvalid: true,
                <?php if (config('jsvalidation.focus_on_error')) : ?>
                    invalidHandler: function(form, validator) {

                        if (!validator.numberOfInvalids())
                            return;

                        $('html, body').animate({
                            scrollTop: $(validator.errorList[0].element).offset().top
                        }, <?= config('jsvalidation.duration_animate') ?>);

                    },
                <?php endif; ?>

                rules: <?= json_encode($validator['rules']); ?>
            });
        });
    });
</script>
