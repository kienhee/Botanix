var editor_config = {
    path_absolute: "/",
    relative_urls: false,
    selector: "textarea#content-product",
    plugins:
        "fullscreen preview anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
    toolbar:
        "fullscreen preview undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
    file_picker_callback: function (callback, value, meta) {
        var x =
            window.innerWidth ||
            document.documentElement.clientWidth ||
            document.getElementsByTagName("body")[0].clientWidth;
        var y =
            window.innerHeight ||
            document.documentElement.clientHeight ||
            document.getElementsByTagName("body")[0].clientHeight;

        var cmsURL =
            editor_config.path_absolute +
            "laravel-filemanager?editor=" +
            meta.fieldname;
        if (meta.filetype == "image") {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: "Filemanager",
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                callback(message.content);
            },
        });
    },
};

tinymce.init(editor_config);
