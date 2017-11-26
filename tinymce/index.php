<!DOCTYPE html>
<html>
    <head>
        <title>Integrating Responsive File Manager with Tinymce</title>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea", theme: "modern", width: 680, height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                ],
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                image_caption: true,
                image_advtab: true,
                external_filemanager_path: "file_manager/filemanager/",
                filemanager_title: "Responsive Filemanager",
                external_plugins: {"filemanager": "file_manager/filemanager/plugin.min.js"}
            });
        </script>
    </head>
    <body>
        <form>
            <textarea></textarea>
        </form>
    </body>
</html>