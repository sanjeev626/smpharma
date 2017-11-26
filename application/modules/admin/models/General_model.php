<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin General_model Model
 * @package Model
 * @subpackage Model
 * Date created:January 23, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class General_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    function update($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function delete($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function getAll($table, $where = NULL, $orderBy = NULL, $select = NULL, $group_by = NULL,$limit = NULL) {
        if ($select)
            $this->db->select($select);
        if ($where)
            $this->db->where($where);
        if ($orderBy)
            $this->db->order_by($orderBy);
        if ($group_by)
            $this->db->group_by($group_by);
        if($limit)
            $this->db->limit($limit);

        $query = $this->db->get($table); 
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

     function getAllResult($table, $where = NULL, $orderBy = NULL, $select = NULL, $group_by = NULL) {
        if ($select)
            $this->db->select($select);
        if ($where)
            $this->db->where($where);
        if ($orderBy)
            $this->db->order_by($orderBy);
        if ($group_by)
            $this->db->group_by($group_by);
        $query = $this->db->get($table); 
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result_array();
        }
    }

    function getResultById($table, $where, $select = '*',$limit ='') {
        $this->db->select($select);
        if ($where)
            $this->db->where($where);

        if($limit){
            $this->db->limit($limit);
        }

        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    function getById($table, $fieldId, $id, $select = '*') {
        $this->db->select($select);
        $this->db->where($fieldId . " = '" . $id . "'");
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    function getFieldById($table, $fieldId, $id, $field) {
        $this->db->select($field);
        $this->db->where($fieldId . " = '" . $id . "'");
        $query = $this->db->get($table);

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $ras = $query->row();
            return $ras->$field;
        }
    }

    function getFieldValue($table, $field, $cfield, $cvalue) {
        $this->db->select($field);
        $this->db->where($cfield . " = '" . $cvalue . "'");
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $ras = $query->row();
            return $ras->$field;
        }
    }

    function getAllById($table, $fieldId, $id,$order) {
        $this->db->select();
        $this->db->where($fieldId . " = '" . $id . "'");
        $this->db->order_by($order,'DESC'); 
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }


    function get_with_limit($table, $limit, $start, $search = NULL, $orderBy = NULL) {
        if ($search)
            $this->db->where($search);
        if ($orderBy)
            $this->db->order_by($orderBy, 'ASC');
        $query = $this->db->get($table, $limit, $start);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function countTotal($table, $where = NULL) {
        if ($where)
            $this->db->where($where);
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function countCheck($table, $where = NULL) {
        if ($where)
            $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function upload_file($folder, $file = '') {
        if ($file == '')
            $file = time();
        $config['upload_path'] = $this->config->item('uploads') . $folder;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "10716";
        $config['max_width'] = "5000";
        $config['max_height'] = "5000";
        $config['file_name'] = $file;
        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            $thumb = '';
        } else {
            $finfo = $this->upload->data();
            $thumb = $finfo['raw_name'] . $finfo['file_ext'];
        }
        return $thumb;
    }

    public function multiple_upload($file_array_name,$upload_path)
    {
        $this->load->library('upload');
        $number_of_files_uploaded = count($_FILES[$file_array_name]['name']);
        $number_of_files_uploaded;
        // Faking upload calls to $_FILE
        for ($i = 0; $i < $number_of_files_uploaded; $i++) :
          
        if(!empty($_FILES[$file_array_name]['name'][$i]))
        {
          $_FILES['userfile']['name']     = $_FILES[$file_array_name]['name'][$i];
          $_FILES['userfile']['type']     = $_FILES[$file_array_name]['type'][$i];
          $_FILES['userfile']['tmp_name'] = $_FILES[$file_array_name]['tmp_name'][$i];
          $_FILES['userfile']['error']    = $_FILES[$file_array_name]['error'][$i];
          $_FILES['userfile']['size']     = $_FILES[$file_array_name]['size'][$i];
          
          $filename = rand(1111,9999).$this->getimagecode($_FILES[$file_array_name]['name'][$i]);            

          $config['file_name'] = $filename;
          $config['upload_path'] = $upload_path;
          $config['log_threshold'] = 1;
          $config['allowed_types'] = 'jpg|png|jpeg|gif';
          $config['max_size'] = '100000'; // 0 = no file size limit
          $config['overwrite'] = false;           

          $imagename[] = $filename;

          $this->upload->initialize($config);
          $this->upload->do_upload();
        }
        else
            $imagename[] = '';
        endfor;
        
        return $imagename;
    }

    function del_img($table, $where, $folder, $feild = 'image') {
        $this->db->where($where);
        $query = $this->db->get($table)->row();
        $img = $query->$feild;
        if ($img != '') {
            $path = $this->config->item('uploads') . $folder . '/' . $img;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        return true;
    }

    function unlink_img($folder, $name) {
        if ($name != '') {
            $path = $this->config->item('uploads') . $folder . '/' . $name;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
    
    function get_all_modules(){
        $this->db->where('publish','1');
        $this->db->order_by('ordering','ASC');
        return $this->db->get('lkt_module')->result();
    }
    
    function get_children_module($id)
    {
        $this->db->where('parent_id',$id);
        return $this->db->get('lkt_module')->result();
    }
    
    function get_controller_name_of_user($modules_ids)
    {
        $this->db->select("controller");
        $this->db->where_in('id',$modules_ids);
        $query = $this->db->get("lkt_module");
        return $query->result();
    }

    function geturlcode($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

    function getimagecode($text)
    {
      $imagename = explode('.',$text);
      $ext = $imagename[count($imagename)-1];

      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }
      else{
        $text = str_replace('-'.$ext,'.'.$ext,$text);
      }

      return $text;
    }

    function getOrdering($tablename)
    {
        $this->db->select($tablename);
        $query = $this->db->get("lkt_module");
        return $query->result();        
    }
}

/* End of file General_model.php
 * Location: ./application/modules/admin/models/General_model.php */
