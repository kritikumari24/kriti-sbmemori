{{-- <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/super-build/ckeditor.js"></script> --}}
<script>
    let ckEditorElem = document.getElementsByClassName('ckeditor');
    if (ckEditorElem.length > 0) {
        // CKEDITOR.replace('content');
        themeCkEditor();
    }

    function themeCkEditor() {
        // Class definition
        var KTCkeditor = function() {
            // Private functions
            var demos = function() {
                ClassicEditor.create(document.querySelector('.ckeditor'), {
                        codeBlock: {
                            languages: [{
                                    language: 'css',
                                    label: 'CSS'
                                },
                                {
                                    language: 'html',
                                    label: 'HTML'
                                }
                            ]
                        },
                        htmlSupport: {
                            allow: [{
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }]
                        },
                        revisionHistory: {
                            editorContainer: document.querySelector('#editor-container'),
                            viewerContainer: document.querySelector('#revision-viewer-container'),
                            viewerEditorElement: document.querySelector('#revision-viewer-editor'),
                            viewerSidebarContainer: document.querySelector('#revision-viewer-sidebar')
                        },
                    })
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });

                // ClassicEditor.create(document.querySelector('.ckeditor'))
                //     .then(editor => {
                //         console.log(editor);
                //     })
                //     .catch(error => {
                //         console.error(error);
                //     });
            }
            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();
        // Initialization
        $(document).ready(function() {
            KTCkeditor.init();
        });
    }
</script>
