<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Multiupload {

    public function __construct() {
//        parent::__construct();

    }
    
    function make_dir($dirs){
        $main_folder = ROOT.'uploads'.DIRECTORY_SEPARATOR;
        if(!empty($dirs)){ foreach($dirs as $val){
            $dir = $main_folder.$val; 
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
        }}
    }

    

    function allowed_type($type) {
        if ($type == "jobseeker") {
            $ar = array('jpg', 'png', 'gif', 'jpeg', 'JPG', 'tif', 'swf');
            return $ar;
        } elseif ($type == "document") {
            $type = array('doc', 'docx','pdf','txt','rtf');
            return $type;
        } elseif ($type == "video_resume") {
            $type = array('mp4', 'mpeg', 'flv', 'avi', 'mkv');
            return $type;
        } else {
            
        }
    }

    public function upload() {
        ini_set('memory_limit', '-1');

        $arg_list = func_get_args();
        $input_name = $arg_list[0];
        $type = $arg_list[1];


        if (!empty($_FILES[$input_name]['name'][0])) {
            $ci = &get_instance();


            $files = $_FILES[$input_name];
            $count = count($_FILES[$input_name]['name']);
            $uploaded = array();
            $failed = array();
            $allowed = $this->allowed_type($type);
            //  for news upload and gallery upload managing
            if (isset($arg_list[2])) {
                $type = $arg_list[2];
            }

            if ($count < 20) {
                foreach ($files['name'] as $position => $file_name) {
                    $file_tmp = $files['tmp_name'][$position];
                    $file_size = $files['size'][$position];
                    $file_error = $files['error'][$position];

                    $file_ext_ts = explode('.', $file_name); 
                    $original_name = current($file_ext_ts); 
                    $file_ext = strtolower(end($file_ext_ts));
                    
                    if (in_array($file_ext, $allowed)) {
                        if ($file_error === 0) {

                            if ($file_size <= 500022) {   //500 kb   //max size 20mb- 2097152123
                                $file_name_new = str_replace(' ', '_', $original_name).'-'.uniqid('', true) . '.' . $file_ext;
                                $file_destination = 'uploads/' . $type . '/' . $file_name_new;
                                if (move_uploaded_file($file_tmp, $file_destination)) {
                                    $uploaded[$position] = $file_destination;
                                    $unique_name[$position] = $file_name_new;

                                    $type = $arg_list[1]; // for news upload and gallery upload managing

                                    if ($type == "jobseeker") {
                                        $ci->load->library('image_lib');
                                        //resize
                                        $config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|tif|swf';
                                        $config['max_size'] = '0';
                                        $config['image_library'] = 'GD2';
                                        
//                                        for news upload and gallery upload managing
                                        if (isset($arg_list[2])) {
                                            $type = $arg_list[2];
                                        }
                                        $config['source_image'] = 'uploads/' . $type . '/' . $unique_name[$position];
                                        //$config['new_image'] = 'uploads/' . $type . '/thumbnail/' . $unique_name[$position];
                                        $config['create_thumb'] = false;
                                        $config['maintain_ratio'] = true;

                                        $config['dynamic_output'] = false;
                                        $config['master_dim'] = 'auto';
                                        $config['quality'] = '100%';
                                        
                                        $config['width'] = '300';
                                        $config['height'] = '400';

                                        $ci->image_lib->clear();
                                        $ci->image_lib->initialize($config);
                                        $ci->image_lib->resize();
                                    }
                                } else {

                                    return FALSE;
                                }
                            } else {
                                return FALSE;
                            }
                        } else {
                            return FALSE;
                        }
                    } else {
                        return FALSE;
                    }
                }
                if (isset($unique_name) && !empty($unique_name)) {
                    $image_name = implode(',', $unique_name);
                    $data["status"] = true;
                    $data["images"] = $image_name;
                    return $data;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
