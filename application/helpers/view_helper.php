<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
///lokaantar/tinymce/file_manager/source/Kp_Oli_.jpg

function the_employer_logo($profilelogo,$displaylogo)
{ 
    
    if (!empty($displaylogo)) {
        return base_url() .  "uploads/employer/". $displaylogo;
    } else if(!empty($profilelogo)){
        return base_url() .  "uploads/employer/". $profilelogo;
    }else{
        return base_url(). "uploads/employer/comp-logo.jpg";
    }
}

function the_jobseeker_logo($logo)
{ 
    
    if (!empty($logo)) {
        return base_url() .  "uploads/jobseeker/". $logo;
    } else{
        return base_url(). "uploads/jobseeker/default-seeker.png";
    }
}

function the_testimonial_image($logo)
{ 
    
    if (!empty($logo)) {
        return base_url() .  "uploads/testimonial/". $logo;
    } else{
        return base_url(). "uploads/jobseeker/default-seeker.png";
    }
}

function the_client_logo($logo)
{

    if (!empty($logo)) {
        return base_url() .  "uploads/clients/". $logo;
    } else{
        return base_url(). "uploads/employer/comp-logo.jpg";
    }
}

function the_service_logo($logo)
{

    if (!empty($logo)) {
        return base_url() .  "uploads/service/". $logo;
    } else{
        return base_url(). "uploads/employer/comp-logo.jpg";
    }
}

function resize_image_upload($image,$type){
    ini_set('memory_limit', '-1');

        if (!empty($_FILES[$image]['name'][0])) {
            $ci = &get_instance();


            $files = $_FILES[$image];
            $count = count($_FILES[$image]['name']);
            $uploaded = array();
            $failed = array();
            $allowed = array('jpg', 'png', 'gif', 'jpeg', 'JPG', 'tif', 'swf');
            
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

                            if ($file_size <= 500022) {   //500kb   //max size 20mb -2097152123
                                $file_name_new = str_replace(' ', '_', $original_name).'-'.uniqid('', true) . '.' . $file_ext;
                                $folder_name = $type;
                                $file_destination = 'uploads/' . $type . '/' . $file_name_new;
                                if (move_uploaded_file($file_tmp, $file_destination)) {
                                    $uploaded[$position] = $file_destination;
                                    $unique_name[$position] = $file_name_new;

                                        $ci->load->library('image_lib');
                                        //resize
                                        $config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|tif|swf';
                                        $config['max_size'] = '0';
                                        $config['image_library'] = 'GD2';
                                        
                                        $config['source_image'] = 'uploads/' . $type . '/' . $unique_name[$position];
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



function device_detect()
{
    //knowing device request
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
        return TRUE;
    } else {
        return FALSE;
    }
    //knowing device request
}


function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/**
 * Generating Random Password
 */
if (!function_exists('randomPassword')) {
	    function randomPassword($length) {
        $alphabet = "abcdefghijklmnopqrstuwxyz$%*!@^&:#<>|,_=([{}])ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $token = implode($pass); //turn the array into a string

        return $token;
    }

}

if(!function_exists('bootstrap_pagination')){
    function bootstrap_pagination(){
        /* Bootstrap Pagination  */

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        /* End of Bootstrap Pagination */

        return $config;
    }
}

