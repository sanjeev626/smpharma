
INTEGRATING IMAGE UPLOAD WITH TINYMCE & RESPONSIVE FILE MANAGER
=====================================================================

1. Copy tinymce folder on the project.

2. Add javascript of index.php file on your desired project.

3. Edit the responsive filemanager config.php file. 
   [LOCATION: tinymce/file_manager/filemanager/config/config.php]

4. Add the following configuration changes to the config.php on line 69 as shown
   'upload_dir' => '/tinymce/file_manager/source/' [NOTE: path from base_url to base of upload folder]