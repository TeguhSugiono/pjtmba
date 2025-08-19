<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_function extends CI_Model {

    function __construct() { // untuk awalan membuat class atau lawan kata nya index
        parent::__construct();
        $this->dblogin = $this->load->database('db_login_tpp', TRUE);
        $this->dbpjt = $this->load->database('db_pjt', TRUE);
    }

    function query_to_tag_dimension($query,$database)
    {
        $sql            = $this->$database->query($query);
        $sql            = $this->$database->last_query();
        $query_data     = $this->$database->query($sql)->result_array();
        $query_tagname     = $this->$database->query($sql)->list_fields();

        $data = array();
        $a=0 ;
        foreach ($query_data as $row) {

            foreach ($query_tagname as $field) {
                "$" . $field = $field;
                $tagname = $field;
                $data[$a][$tagname] = $row[$tagname];
            }

            $a++;
        }

        return $data;
    }

    function GetFieldValue($customselect = "",$fieldvalue,$database = "" , $where = array() , $nmtable){
        // $query  = $this->$database->query(" select ".$cari." from ".$table);
        // $data   = "" ;
        // foreach ($query->result() as $row) {
        //     $data = $row->data ;
        // }
        // return $data;

        $returndata = "" ;

        if($customselect != ""){
            $this->$database->select($customselect);
        }

        if(count($where) > 0){
            $this->$database->where($where);
        }

        $query = $this->$database->get($nmtable);
        //echo $this->$database->last_query();
        foreach ($query->result() as $row) {
            $returndata = $row->$fieldvalue ;
        }

        return $returndata;

    }

    //membuat comobobox id dan nama, beserta id dan nama set awal
    public function create_combobox($field_Search = "", $field_id = "", $field_name = "", $where = array(), $orderby = "", $table_name = "", $set_id = "", $set_name = "", $where_in_field = "", $where_in_value = array()) {
        $this->db->distinct();
        $this->db->select($field_Search);

        if (count(array($where)) > 0) {
            $this->db->where($where);
        }

        if ($where_in_field != "") {
            $this->db->where_in($where_in_field, $where_in_value);
        }

        if ($orderby != "") {
            $this->db->order_by($orderby);
        }

        $result = $this->db->get($table_name);

        //echo "</br>".$this->db->last_query(); die;
        $dapatdata[$set_id] = $set_name;
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                if ($row->$field_id <> '') {
                    $dapatdata[$row->$field_id] = $row->$field_name;
                }
            }
        }

        //print_r($dapatdata) ; die;

        return $dapatdata;
    }

    public function CreateCombo1($arraydata, $namecbo, $setname, $setclass) {
        $data['$namecbo'] = form_dropdown($namecbo, $arraydata, $setname, 'id="' . $namecbo . '" class="form-control ' . $setclass . '" style="width: 100%"');
        return $data['$namecbo'];
    }

    public function CreateCombo2($param_array) {

        //contoh penggunaan
//        $param_array1 = array(
//            'field_Search'  => 'Tarif_Category_ID,NamaCategory',
//            'field_id'      => 'Tarif_Category_ID',
//            'field_name'    => 'NamaCategory',
//            'where'         => array(),
//            'where_in'      => array('name' => '', 'value' => array()),
//            'where_not_in'  => array('name' => '', 'value' => array()),                   
//            'table_name'    => 'tpp_m_tarif_category',
//            'orderby'       => 'Tarif_Category_ID asc',
//            'set_data'      => array('set_id' => '01','set_name' => 'Storage'),   
//            'attribute'     => array('idname' => 'CboCategory','class' => 'select3'),
//        );

        $this->db->distinct();
        $this->db->select($param_array['field_Search']);

        $where = isset($param_array['where']) ? $param_array['where'] : array();
        if (count((array) $where) > 0) {
            $this->db->where($param_array['where']);
        }

        $where_in = isset($param_array['where_in']) ? $param_array['where_in'] : array();
        if (count((array) $where_in) > 0) {
            $this->db->where_in($param_array['where_in']['name'], $param_array['where_in']['value']);
        }

//        $where_not_in = isset($param_array['where_not_in']) ? $param_array['where_not_in'] : array();
//        if (count((array) $where_not_in) > 0) {
//            $this->db->where_not_in($param_array['where_not_in']['name'],$param_array['where_not_in']['value']);
//        }

        $orderby = isset($param_array['orderby']) ? $param_array['orderby'] : '';
        if ($orderby != '') {
            $this->db->order_by($param_array['orderby']);
        }

        $result = $this->db->get($param_array['table_name']);
        //echo "</br>".$this->db->last_query(); die;

        $dapatdata[$param_array['set_data']['set_id']] = $param_array['set_data']['set_name'];
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $field_id = $param_array['field_id'];
                if ($row->$field_id <> '') {
                    $idku = $param_array['field_id'];
                    $nameku = $param_array['field_name'];
                    $dapatdata[$row->$idku] = $row->$nameku;
                }
            }
        }

        $attribute = 'id="' . $param_array['attribute']['idname'] . '" class="form-control ' . $param_array['attribute']['class'] . '" style="width:100%" ';
        $selected = $this->input->post("'" . $param_array['attribute']['idname'] . "'") ? $this->input->post("'" . $param_array['attribute']['idname'] . "'") : '';
        return form_dropdown($param_array['attribute']['idname'], $dapatdata, $selected, $attribute);
    }

    function ArrayToInSql($array) {
        $SqlID = "";
        if (count((array) $array) > 0) {
            if (count((array) $array) == 1) {
                $SqlID = "'" . $array[0] . "'";
            } else {
                for ($a = 0; $a < count((array) $array); $a++) {
                    if ($a == 0) {
                        $SqlID = "'" . $array[$a] . "'";
                    } else {
                        $SqlID = $SqlID . ",'" . $array[$a] . "'";
                    }
                }
            }
        }

        $SqlID = "(" . $SqlID . ")";

        return $SqlID;
    }

    function GetIDtoArray($Table, $Id) {
        $this->db->select($Id);
        $this->db->group_by($Id);
        $data = $this->db->get($Table)->result();
        $array_data = array('-');
        foreach ($data as $row) {
            array_push($array_data, $row->$Id);
        }
        return $array_data;
    }

    public function cek_data($table, $where = "") {
        $data = $this->dblogin->get_where($table, $where);
        return $data;
    }

    public function select_max_where($table, $max, $where) {
        $this->db->select("ifnull(MAX($max),0) AS $max");
        $this->db->from($table);
        if ($where != '') {
            $this->db->where($where);
        }
        $data = $this->db->get()->result();
        //echo $this->db->last_query(); 
        //die;
        foreach ($data as $row) {
            $id = $row->$max;
        }
        return $id + 1;
    }

    public function StringToSession($NameSession, $ValueSession) {
        $this->session->unset_userdata($NameSession);
        $datasession = array($NameSession => $ValueSession);
        $this->session->set_userdata($datasession);
    }

    public function StringArrayToSession($StringArray) {
        foreach ($StringArray as $key => $value) {
            $this->StringToSession($key, $value);
        }
    }

    public function NotUnsetStringToSession($NameSession, $ValueSession) {
        //$this->session->unset_userdata($NameSession);
        $datasession = array($NameSession => $ValueSession);
        $this->session->set_userdata($datasession);
    }

    public function code_uniq_form() {

        $tglskrg = date_ymd();

        $where = array(
            'Number_Code' => 'uniq_form',
            "date_format(Last_Generated,'%Y-%m-%d')" => $tglskrg,
        );
        $result = $this->getvalue('Last_Number', 'tpp_r_number', $where, '', '');

        if ($result == "") {

            $this->db->query(" delete from  tpp_r_number  where  Number_Code='uniq_form' ") ;

            $data = array(
                'Number_Code' => 'uniq_form',
                'Last_Number' => 1,
                'Last_Generated' => tanggal_sekarang(),
            );

            $this->save_data('tpp_r_number', $data);
            return 1;
        } else {
            $result = $result + 1;
            $data = array(
                'Last_Number' => $result,
            );
            $where = array(
                'Number_Code' => 'uniq_form',
            );

            $this->update_data('tpp_r_number', $data, $where);

            return $result;
        }
    }

    // $select = 'id_manifest_detail' ;
    // $form = 'tbl_manifest_detail' ;
    // $where = array(
    //     ''
    // );
    // $limit = '' ;
    // $orderby = '' ;
    function getvalue($select = '', $form = '', $where = array(), $limit = '', $orderby = '') {
        $this->db->select($select);
        $this->db->from($form);
        $this->db->where($where);

        if ($orderby != '') {
            $this->db->order_by($orderby);
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }

        $data = $this->db->get();
//        echo $this->db->last_query();
//        die;
        $dpt = '';
        foreach ($data->result() as $row) {
            $dpt = $row->$select;
        }
        return $dpt;
    }

    function getvalueArray($select = '', $form = '', $where = array(), $limit = '') {
        $this->db->select($select);
        $this->db->from($form);
        $this->db->where($where);

        if ($limit != '') {
            $this->db->limit($limit);
        }

        $data = $this->db->get();
        return $data->result_array();
    }

    function save_data($table, $data) {
        $data = $this->db->insert($table, $data);
        return $data;
    }

    function update_data($table, $data, $where) {
        $res = $this->db->update($table, $data, $where);
        // echo $this->db2->last_query();
        // die;
        return $res;
    }

    function update_data_custom($database,$table,$data,$where) {
        $res = $this->$database->update($table, $data, $where);
        // echo $this->$database->last_query();
        // die;
        return $res;
    }

    function delete_data($table, $where) {
        $this->db->where($where);
        $res = $this->db->delete($table);
//        echo $this->db->last_query();
//        die;
        return $res;
    }

    function get_datatables($select = '', $form = '', $join = '', $where = '', $where_term = '', $column_order = '', $column_search = '', $order = array(), $group = '', $where_in_field = '', $where_in_value = array(), $where_like = array(), $custom_where = '') {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term, $select, $form, $join, $where, $where_term, $column_order, $column_search, $order, $group, $where_in_field, $where_in_value, $where_like, $custom_where);
        if ($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function _get_datatables_query($term = '', $select = '', $form = '', $join = '', $where = '', $where_term = '', $column_order = '', $column_search = '', $order = array(), $group = '', $where_in_field = '', $where_in_value = array(), $where_like = array(), $custom_where = '') {

        if ($select != "") {
            $this->db->select($select);
        }

        $this->db->from($form);
        for ($a = 0; $a < count($join); $a++) {
            $this->db->join($join[$a][0], $join[$a][1], $join[$a][2]);
        }

        if ($where != '') {
            $this->db->where($where);
        }

        if ($custom_where != '') {
            $this->db->where($custom_where);
        }

        if ($where_in_field != '') {
            $this->db->where_in($where_in_field, $where_in_value);
        }

        for ($a = 0; $a < count($where_like); $a++) {
            $this->db->like($where_like[$a][0], $where_like[$a][1]);
        }

        if ($term != "") {

            if (count($where_term) == 1) {
                $this->db->like($where_term[0], $term);
            } else {

                $this->db->group_start();

                for ($a = 0; $a < count($where_term); $a++) {
                    if ($a == 0) {
                        $this->db->like($where_term[$a], $term);
                    } else {
                        $this->db->or_like($where_term[$a], $term);
                    }
                }

                $this->db->group_end();
            }
        }

        if ($group != '') {
            $this->db->group_by($group);
        }

//        $data = $this->db->get();
//         echo "</br>".$this->db->last_query(); die;

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered($select = '', $form = '', $join = '', $where = '', $where_term = '', $column_order = '', $column_search = '', $order = array(), $group = '', $where_in_field = '', $where_in_value = array(), $where_like = array(), $custom_where = '') {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term, $select, $form, $join, $where, $where_term, $column_order, $column_search, $order, $group, $where_in_field, $where_in_value, $where_like, $custom_where);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($form = '', $join = '', $where = '', $group = '', $where_in_field = '', $where_in_value = array(), $where_like = array(), $custom_where = '') {


        $this->db->select($group);
        $this->db->from($form);

        for ($a = 0; $a < count($join); $a++) {
            $this->db->join($join[$a][0], $join[$a][1], $join[$a][2]);
        }

        $this->db->where($where);

        if ($custom_where != '') {
            $this->db->where($custom_where);
        }

        if ($where_in_field != '') {
            $this->db->where_in($where_in_field, $where_in_value);
        }

        for ($a = 0; $a < count($where_like); $a++) {
            $this->db->like($where_like[$a][0], $where_like[$a][1]);
        }

        if ($group != '') {
            $this->db->group_by($group);
        }

        return $this->db->count_all_results();
    }

    function get_datatables2($array_table) {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query2($term, $array_table);
        if ($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        $query = $this->db->get();

        // $query_data = $this->db->last_query();
        // $this->session->unset_userdata('query_data');
        // $datasession = array('query_data' => $query_data);
        // $this->session->set_userdata($datasession);


        return $query->result();
    }

    function _get_datatables_query2($term = '', $array_table) {
        $select = isset($array_table['select']) ? $array_table['select'] : '';
        $form = isset($array_table['form']) ? $array_table['form'] : '';
        $join = isset($array_table['join']) ? $array_table['join'] : array();
        $where = isset($array_table['where']) ? $array_table['where'] : array();
        $where_like = isset($array_table['where_like']) ? $array_table['where_like'] : array();
        $where_in = isset($array_table['where_in']) ? $array_table['where_in'] : array();
        $where_not_in = isset($array_table['where_not_in']) ? $array_table['where_not_in'] : array();
        $where_term = isset($array_table['where_term']) ? $array_table['where_term'] : array();
        $column_order = isset($array_table['column_order']) ? $array_table['column_order'] : array();
        $group = isset($array_table['group']) ? $array_table['group'] : '';
        $order = isset($array_table['order']) ? $array_table['order'] : array();

        if ($select != '') {
            $this->db->select($select);
        }

        if ($form != '') {
            $this->db->from($form);
        }

        if (count((array) $join) > 0) {
            for ($a = 0; $a < count($join); $a++) {
                $this->db->join($join[$a][0], $join[$a][1], $join[$a][2]);
            }
        }

        if (count((array) $where) > 0) {
            $this->db->where($where);
        }

        if (count((array) $where_like) > 0) {
            if (count((array) $where_like) == 1) {
                $this->db->like($where_like[0]['field'], $where_like[0]['value']);
            } else {
                $this->db->group_start();
                for ($a = 0; $a < count((array) $where_like); $a++) {
                    if ($a == 0) {
                        $this->db->like($where_like[$a]['field'], $where_like[$a]['value']);
                    } else {
                        $this->db->or_like($where_like[$a]['field'], $where_like[$a]['value']);
                    }
                }
                $this->db->group_end();
            }
        }

        if (count((array) $where_in) > 0) {
            if (count((array) $where_in) == 1) {
                $this->db->where_in($where_in[0]['field'], $where_in[0]['value']);
            } else {
                $this->db->group_start();
                for ($a = 0; $a < count((array) $where_in); $a++) {
                    if ($a == 0) {
                        $this->db->where_in($where_in[$a]['field'], $where_in[$a]['value']);
                    } else {
                        $this->db->or_where_in($where_in[$a]['field'], $where_in[$a]['value']);
                    }
                }
                $this->db->group_end();
            }
        }

        if (count((array) $where_not_in) > 0) {
            if (count((array) $where_not_in) == 1) {
                $this->db->where_not_in($where_not_in[0]['field'], $where_not_in[0]['value']);
            } else {
                $this->db->group_start();
                for ($a = 0; $a < count((array) $where_not_in); $a++) {
                    if ($a == 0) {
                        $this->db->where_not_in($where_not_in[$a]['field'], $where_not_in[$a]['value']);
                    } else {
                        $this->db->or_where_not_in($where_not_in[$a]['field'], $where_not_in[$a]['value']);
                    }
                }
                $this->db->group_end();
            }
        }

        if ($term != "") {
            if (count((array) $where_term) == 1) {
                $this->db->like($where_term[0], $term);
            } else {

                $this->db->group_start();

                for ($a = 0; $a < count((array) $where_term); $a++) {
                    if ($a == 0) {
                        $this->db->like($where_term[$a], $term);
                    } else {
                        $this->db->or_like($where_term[$a], $term);
                    }
                }

                $this->db->group_end();
            }
        }

        if ($group != '') {
            $this->db->group_by($group);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered2($array_table) {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query2($term, $array_table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all2($array_table) {
        $select = isset($array_table['select']) ? $array_table['select'] : '';
        $form = isset($array_table['form']) ? $array_table['form'] : '';
        $join = isset($array_table['join']) ? $array_table['join'] : array();
        $where = isset($array_table['where']) ? $array_table['where'] : array();
        $where_like = isset($array_table['where_like']) ? $array_table['where_like'] : array();
        $where_in = isset($array_table['where_in']) ? $array_table['where_in'] : array();
        $where_not_in = isset($array_table['where_not_in']) ? $array_table['where_not_in'] : array();
        $where_term = isset($array_table['where_term']) ? $array_table['where_term'] : array();
        $column_order = isset($array_table['column_order']) ? $array_table['column_order'] : array();
        $group = isset($array_table['group']) ? $array_table['group'] : '';
        $order = isset($array_table['order']) ? $array_table['order'] : array();

        if ($select != '') {
            $this->db->select($select);
        }

        if ($form != '') {
            $this->db->from($form);
        }

        if (count((array) $join) > 0) {
            for ($a = 0; $a < count($join); $a++) {
                $this->db->join($join[$a][0], $join[$a][1], $join[$a][2]);
            }
        }

        if (count((array) $where) > 0) {
            $this->db->where($where);
        }

        if (count((array) $where_like) > 0) {
            if (count((array) $where_like) == 1) {
                $this->db->like($where_like[0]['field'], $where_like[0]['value']);
            } else {
                $this->db->group_start();
                for ($a = 0; $a < count((array) $where_like); $a++) {
                    if ($a == 0) {
                        $this->db->like($where_like[$a]['field'], $where_like[$a]['value']);
                    } else {
                        $this->db->or_like($where_like[$a]['field'], $where_like[$a]['value']);
                    }
                }
                $this->db->group_end();
            }
        }

        if (count((array) $where_in) > 0) {
            if (count((array) $where_in) == 1) {
                $this->db->where_in($where_in[0]['field'], $where_in[0]['value']);
            } else {
                $this->db->group_start();
                for ($a = 0; $a < count((array) $where_in); $a++) {
                    if ($a == 0) {
                        $this->db->where_in($where_in[$a]['field'], $where_in[$a]['value']);
                    } else {
                        $this->db->or_where_in($where_in[$a]['field'], $where_in[$a]['value']);
                    }
                }
                $this->db->group_end();
            }
        }

        if (count((array) $where_not_in) > 0) {
            if (count((array) $where_not_in) == 1) {
                $this->db->where_not_in($where_not_in[0]['field'], $where_not_in[0]['value']);
            } else {
                $this->db->group_start();
                for ($a = 0; $a < count((array) $where_not_in); $a++) {
                    if ($a == 0) {
                        $this->db->where_not_in($where_not_in[$a]['field'], $where_not_in[$a]['value']);
                    } else {
                        $this->db->or_where_not_in($where_not_in[$a]['field'], $where_not_in[$a]['value']);
                    }
                }
                $this->db->group_end();
            }
        }

        if ($group != '') {
            $this->db->group_by($group);
        }

        return $this->db->count_all_results();
    }

    function goto_temporary_out($table_name){

        $this->drop_temporary_out($table_name);

        $query = " insert into testmsa.temporary_table(table_name) values ('".$table_name."') " ;
        $this->db->query($query);    
    }

    function drop_temporary_out($table_name){

        $this->db->query('CREATE DATABASE IF NOT EXISTS testmsa');

        $create_table = " CREATE TABLE IF NOT EXISTS testmsa.temporary_table (
                          id int(11) NOT NULL AUTO_INCREMENT,
                          table_name varchar(200) DEFAULT NULL,
                          PRIMARY KEY (id)
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1" ;
        $this->db->query($create_table);                

        $this->db->like('table_name', $table_name);
        $this->db->group_by('table_name');
        $data = $this->db->get('testmsa.temporary_table');
        foreach($data->result() as $row){
            $table_name = $row->table_name;            
            $this->db->query('DROP TABLE IF EXISTS testmsa.'.$table_name);
        }

        $query = "delete from  testmsa.temporary_table where table_name like'%".$table_name."%' " ;
        $this->db->query($query);

    }

    function goto_temporary($table_name){

        $this->drop_temporary();

        $query = " insert into testmsa.temporary_table(table_name) values ('".$table_name."') " ;
        $this->db->query($query);      
    }

    function drop_temporary(){

        $this->db->query('CREATE DATABASE IF NOT EXISTS testmsa');

        $create_table = " CREATE TABLE IF NOT EXISTS testmsa.temporary_table (
                          id int(11) NOT NULL AUTO_INCREMENT,
                          table_name varchar(200) DEFAULT NULL,
                          PRIMARY KEY (id)
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1" ;
        $this->db->query($create_table);                


        $user = $this->session->userdata('t_username') ;

        $this->db->like('table_name', $user);
        $this->db->group_by('table_name');
        $data = $this->db->get('testmsa.temporary_table');
        foreach($data->result() as $row){
            $table_name = $row->table_name;            
            $this->db->query('DROP TABLE IF EXISTS testmsa.'.$table_name);
        }

        $query = "delete from  testmsa.temporary_table where table_name like'%".$user."%' " ;
        $this->db->query($query);
    }

    //object yang dilempar result_array()
    function array_one_rows($array_data){
        $array_one_rows = array();
        for($a=0;$a<count($array_data);$a++){
            array_push($array_one_rows,$array_data[$a]['T_In_Detail_ID']);
        }

        //array_push($array_one_rows,count($array_data));

        //print("<pre>".print_r($array_one_rows,true)."</pre>"); 
        //die;
        return $array_one_rows;
    }

    function CreateServerSide($comp){
        $response = array();

        $postData = $comp['array_postData'] ;
        $array_search_term = $comp['array_search_term'] ;
        $string_select_from = $comp['string_select_from'] ;
        $string_select_orderby = $comp['string_select_orderby'] ;
        $array_select_tag_field = $comp['array_select_tag_field'] ;

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column']; 
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        $searchQuerydata = "" ;
        if($searchValue != ''){
            $searchQuerydata = " and " ;
            for($t=0 ; $t<count($array_search_term) ; $t++){
                $searchQuerydata.= "(".$array_search_term[$t]." like '%".$searchValue."%')" ;                
                if((count($array_search_term)-1) != $t){
                    $searchQuerydata.= ' or ' ;
                }
            }
        }

        $sql_query = $string_select_from ;

        $totalRecords = $this->db->query($sql_query)->num_rows();        

        $totalRecordwithFilter = $this->db->query($sql_query.' '.$searchQuerydata)->num_rows();            

        $orderdata = $string_select_orderby ;        

        $limitdata = " limit $start,$rowperpage " ;
        
        $records = $this->db->query($sql_query.' '.$searchQuerydata.' '.$orderdata.' '.$limitdata)->result_array();

        $data = array();
        $no=1;
        foreach($records as $record ){
            $arraydata = array();
            $arraydata['Nomor'] = $no++ ;
            for($ax=0 ; $ax < count($array_select_tag_field) ; $ax++ ){
                $arraydata[$array_select_tag_field[$ax]] = $record[$array_select_tag_field[$ax]] ;
            }   
            $data[] = $arraydata ;
        }


        // print_r($data);
        //     die;
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response; 
    }

    function getDataTable($postData=null){
        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // echo 'start ==> '.$start.'<br>' ;
        // echo 'rowperpage ==> '.$rowperpage.'<br>' ;
        // echo 'columnIndex ==> '.$columnIndex.'<br>' ;
        // echo 'columnName ==> '.$columnName.'<br>' ;
        // echo 'columnSortOrder ==> '.$columnSortOrder.'<br>' ;
        // die;

        ## Search 
        $searchQuerydata = "" ;

        if($searchValue != ''){
            $searchQuerydata = " and (if(((b.NoKontainer = _latin1'') or (b.ex_kontainer <> _latin1'')),`b`.`ex_kontainer`, b.NoKontainer) 
            like '%".$searchValue."%') or (b.KdCtr like '%".$searchValue."%') or (Status like'%".$searchValue."%')
            or (c.Keterangan like'%".$searchValue."%') or (b.TglTiba like'%".$searchValue."%')  or (b.TglMasuk like'%".$searchValue."%') 
            or (b.TglCacah like'%".$searchValue."%') or (b.TglStripping like'%".$searchValue."%') 
            or (b.OverWeight like'%".$searchValue."%') or (b.UkuranCargo like'%".$searchValue."%')
            or (b.Category like'%".$searchValue."%') or (a.Consignee like'%".$searchValue."%') 
            or (a.Vessel like'%".$searchValue."%') or (b.Location like'%".$searchValue."%') 
            or (b.CatLoc like'%".$searchValue."%') or (a.NoBAP like'%".$searchValue."%') 
            or (a.TglBAP like'%".$searchValue."%') or (a.NoBCF like'%".$searchValue."%') 
            or (a.TglBCF like'%".$searchValue."%') or (b.Sling like'%".$searchValue."%') 
            or (b.Low_Bed like'%".$searchValue."%') or (b.Keterangan like'%".$searchValue."%') 
            or (d.Kd_Tarif like'%".$searchValue."%') or (b.FlagCacah like'%".$searchValue."%') 
            or (b.NamaBrg1 like'%".$searchValue."%') or (b.NamaBrg2 like'%".$searchValue."%') 
            or (b.ContStatus like'%".$searchValue."%') or (b.Storage like'%".$searchValue."%') 
            or (b.Penarikan like'%".$searchValue."%') or (c.BiayaStorage like'%".$searchValue."%') 
            or ((a.BiayaTPS + a.BiayaTPSmekanik) like'%".$searchValue."%') or ((a.BiayaLainTPS + a.BiayaLainTPSmekanik) like'%".$searchValue."%') 
            or (a.FlagBiayaTPS like'%".$searchValue."%') or (b.Pencacahan like'%".$searchValue."%') 
            or (a.KdTPS like'%".$searchValue."%') or (b.no_segel_merah like'%".$searchValue."%') 
            or (b.no_buka_segel_merah like'%".$searchValue."%') or (b.Cometto like'%".$searchValue."%') 
            or (b.Doly like'%".$searchValue."%') or (b.Sleading like'%".$searchValue."%') 
            or (b.T_In_Detail_ID like'%".$searchValue."%') or (a.T_In_ID like'%".$searchValue."%') 
            or (b.RecID like'%".$searchValue."%') " ;
        }


      //query
        $sql_query = " SELECT 'no' as Nomor,
            if(((b.NoKontainer = _latin1'') or (b.ex_kontainer <> _latin1'')), `b`.`ex_kontainer`, b.NoKontainer) AS NoKontainer, 
            `b`.`KdCtr` AS `KdCtr`, `b`.`Status` AS `Status`, `b`.`Tipe_Cargo` AS `Tipe_Cargo`, `a`.`KdBC` AS `KdBC`, 
            `c`.`Keterangan` AS `TPS`, `b`.`TglTiba` AS `TglTiba`, `b`.`TglMasuk` AS `TglMasuk`, `b`.`TglCacah` AS `TglCacah`, 
            `b`.`TglStripping` AS `TglStripping`, `b`.`OverWeight` AS `OverWeight`, `b`.`UkuranCargo` AS `UkuranCargo`, 
            `b`.`Category` AS `Category`, `a`.`Consignee` AS `Consignee`, `a`.`Vessel` AS `Vessel`, `b`.`Location` AS `Location`, 
            `b`.`CatLoc` AS `CatLoc`, `a`.`NoBAP` AS `NoBAP`, `a`.`TglBAP` AS `TglBAP`, `a`.`NoBCF` AS `NoBCF`, `a`.`TglBCF` AS `TglBCF`, 
            `b`.`Sling` AS `Sling`, `b`.`Low_Bed` AS `Low_Bed`, `b`.`Keterangan` AS `Keterangan`, `d`.`Kd_Tarif` AS `Kd_Tarif`, 
            `b`.`FlagCacah` AS `FlagCacah`, `b`.`NamaBrg1` AS `NamaBrg1`, `b`.`NamaBrg2` AS `NamaBrg2`, `b`.`ContStatus` AS `ContStatus`, 
            `b`.`Storage` AS `Storage`, `b`.`Penarikan` AS `Penarikan`, `c`.`BiayaStorage` AS `BiayaStorage`, 
            (a.BiayaTPS + a.BiayaTPSmekanik) AS BiayaTPS, (a.BiayaLainTPS + a.BiayaLainTPSmekanik) AS BiayaLainTPS, 
            `a`.`FlagBiayaTPS` AS `FlagBiayaTPS`, `b`.`Pencacahan` AS `Pencacahan`, `a`.`KdTPS` AS `KdTPS`, 
            `b`.`no_segel_merah` AS `no_segel_merah`, `b`.`no_buka_segel_merah` AS `no_buka_segel_merah`, 
            `b`.`Cometto` AS `Cometto`, `b`.`Doly` AS `Doly`, `b`.`Sleading` AS `Sleading`, `b`.`T_In_Detail_ID` AS `T_In_Detail_ID`, 
            `a`.`T_In_ID` AS `T_In_ID`, `b`.`RecID` AS `RecID`
            FROM `tpp_t_bap` as `a`
            INNER JOIN `tpp_t_bap_detail` as `b` ON `a`.`T_In_ID` = `b`.`T_In_ID` and `a`.`RecID` = 0 and `b`.`RecID` = 0
            INNER JOIN `tpp_m_tps` as `c` ON `a`.`KdTPS` = `c`.`KdTPS`
            LEFT JOIN `m_container` as `d` ON `b`.`KdCtr` = `d`.`KdCtr`
            WHERE `a`.`RecID` = 0 AND `b`.`RecID` = 0  " ;


        //where datatable    
        $T_In_Detail_ID_array = $this->input->post('T_In_Detail_ID_array');
        $NoBCF = $this->input->post('NoBCF');
        $NoKontainer = $this->input->post('NoKontainer');
        $RdCek = $this->input->post('RdCek');

        //print_r($T_In_Detail_ID_array);die;

        if ($NoBCF != '') {
            $sql_query.= " and a.NoBCF = '".$NoBCF."' " ;
        }

        if ($NoKontainer != '') {
            $sql_query.= " and (if(((b.NoKontainer = _latin1'') or (b.ex_kontainer <> _latin1'')),`b`.`ex_kontainer`, b.NoKontainer) 
            like '%".$NoKontainer."%') " ;
        }

        if ($RdCek != 'container') {
            if ($NoBCF == "" && $NoKontainer == "") {
                $sql_query.= " and a.NoBCF = 'AAAAAAAAAAAAAAAAAAAAAAAAAAA' " ;
            }
        }

        $T_In_Detail_ID = 111111111111111 ;
        if (count((array) $T_In_Detail_ID_array) > 0) {
            for($a=0 ; $a<count((array) $T_In_Detail_ID_array); $a++){
                $T_In_Detail_ID = $T_In_Detail_ID.','.$T_In_Detail_ID_array[$a] ;
            }
            $sql_query.= " and b.T_In_Detail_ID not in ($T_In_Detail_ID) " ;
        }

        ## Total number of records without filtering   
        $totalRecords = $this->db->query($sql_query)->num_rows();        

        ## Total number of record with filtering
        $totalRecordwithFilter = $this->db->query($sql_query.' '.$searchQuerydata)->num_rows();            

        ## Fetch records
        $orderdata = "" ;
        if($columnName == "NoKontainer"){ 
            $orderdata = " order by if(((b.NoKontainer = _latin1'') 
            or (b.ex_kontainer <> _latin1'')), `b`.`ex_kontainer`, b.NoKontainer) ".$columnSortOrder." " ; 
        }else{
            $orderdata = "order by ".$columnName." ".$columnSortOrder ;
        }
        

        $limitdata = " limit $start,$rowperpage " ;
        
        $records = $this->db->query($sql_query.' '.$searchQuerydata.' '.$orderdata.' '.$limitdata)->result();

        $data = array();
        $no=1;
        foreach($records as $record ){

            $data[] = array( 
                "Nomor" => $no++,
                "NoKontainer"=>$record->NoKontainer,
                "KdCtr"=>$record->KdCtr,
                "Status"=>$record->Status,
                "Tipe_Cargo"=>$record->Tipe_Cargo,
                "KdBC"=>$record->KdBC,
                "TPS"=>$record->TPS,
                "TglTiba"=>showdate_indo($record->TglTiba),
                "TglMasuk"=>showdate_indo($record->TglMasuk),
                "TglCacah"=>showdate_indo($record->TglCacah),
                "TglStripping"=>showdate_indo($record->TglStripping),
                "OverWeight"=>$record->OverWeight,
                "UkuranCargo"=>$record->UkuranCargo,
                "Category"=>$record->Category,
                "Consignee"=>$record->Consignee,
                "Vessel"=>$record->Vessel,
                "Location"=>$record->Location,
                "CatLoc"=>$record->CatLoc,
                "NoBAP"=>$record->NoBAP,
                "TglBAP"=>showdate_indo($record->TglBAP),
                "NoBCF"=>$record->NoBCF,
                "TglBCF"=>showdate_indo($record->TglBCF),
                "Sling"=>$record->Sling,
                "Low_Bed"=>$record->Low_Bed,
                "Keterangan"=>$record->Keterangan,
                "Kd_Tarif"=>$record->Kd_Tarif,
                "FlagCacah"=>$record->FlagCacah,
                "NamaBrg1"=>$record->NamaBrg1,
                "NamaBrg2"=>$record->NamaBrg2,
                "ContStatus"=>$record->ContStatus,
                "Storage"=>$record->Storage,
                "Penarikan"=>$record->Penarikan,
                "BiayaStorage"=>$record->BiayaStorage,
                "BiayaTPS"=>format_uang2($record->BiayaTPS),
                "BiayaLainTPS"=>format_uang2($record->BiayaLainTPS),
                "FlagBiayaTPS"=>$record->FlagBiayaTPS,
                "Pencacahan"=>$record->Pencacahan,
                "KdTPS"=>$record->KdTPS,
                "no_segel_merah"=>$record->no_segel_merah,
                "no_buka_segel_merah"=>$record->no_buka_segel_merah,
                "Cometto"=>$record->Cometto,
                "Doly"=>$record->Doly,
                "Sleading"=>$record->Sleading,
                "T_In_Detail_ID"=>$record->T_In_Detail_ID,
                "T_In_ID"=>$record->T_In_ID,
                "RecID"=>$record->RecID,
            ); 
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response; 
    }


    function get_ppn_aktif(){
        $jml_ppn  = 10 ;

        $cek = $this->db->get_where('tbl_setting_ppn',array('default' => 'Ya'));

        //jika dicek ppn ada default Ya maka
        if($cek->num_rows() > 0){
            foreach($cek->result_array() as $row){
                $jml_ppn = $row['jml_ppn'];
                return $jml_ppn ;
            }
        }

        $cek2 = $this->db->get_where('tbl_setting_ppn',array('default' => 'No'));
        //jika dicek ppn ada default No maka
        if($cek2->num_rows() > 0){
            $tanggal_sekarang = date_db(date('Y-m-d')) ;
            $query = "  SELECT * from tbl_setting_ppn 
                        where `default`='No' 
                        and '".$tanggal_sekarang."'>=begin_periode and '".$tanggal_sekarang."' <= end_periode
                        ORDER BY end_periode desc limit 1 " ;           

            $cek = $this->db->query($query);    

            foreach($cek->result_array() as $row){
                $jml_ppn = $row['jml_ppn'];
                return $jml_ppn ;
            }       

        }

        return $jml_ppn ;

    }

    function get_ppn_used($tglinv){
        $jml_ppn  = 10 ;

        $cek = $this->db->get_where('tbl_setting_ppn',array('default' => 'Ya'));

        //jika dicek ppn ada default Ya maka
        if($cek->num_rows() > 0){
            foreach($cek->result_array() as $row){
                $jml_ppn = $row['jml_ppn'];
                return $jml_ppn ;
            }
        }
        
        //echo "test ".$jml_ppn;
        
        $query = "  SELECT * from tbl_setting_ppn 
                    where `default`='No' 
                    and '".$tglinv."'>=begin_periode and '".$tglinv."' <= end_periode
                    ORDER BY end_periode desc limit 1 " ;   
        //echo $query ; die;
        $cek = $this->db->query($query);    
        
        foreach($cek->result_array() as $row){
            $jml_ppn = $row['jml_ppn'];
            return $jml_ppn ;
        }               

        return $jml_ppn ;           
    }

    function generator_xls_phpexcel($setting_xls) {

        $jumlah_sheet = $setting_xls['jumlah_sheet'];
        $nama_sheet = $setting_xls['nama_sheet'];
        $data_all_sheet = $setting_xls['data_all_sheet'];
        $nama_excel = $setting_xls['nama_excel'];

        // Inisialisasi PHPExcel
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $spreadsheet = new PHPExcel();

        for ($a = 0; $a < $jumlah_sheet; $a++) {

            $baris = 1;
            $kolom = 0;

            // Buat sheet baru jika lebih dari satu
            if ($a > 0) {
                $spreadsheet->createSheet();
            }

            // Pilih sheet yang aktif
            $spreadsheet->setActiveSheetIndex($a);
            $spreadsheet->getActiveSheet()->setTitle($nama_sheet[$a]);
            $sheet = $spreadsheet->getActiveSheet();

            // JUDUL TABEL
            foreach ($setting_xls['data_all_sheet'][$a][0] as $key => $value) {
                $sheet->setCellValueByColumnAndRow($kolom, $baris, $key);
                $kolom++;
            }

            $baris++;
            $nomor = 1;

            // ISI TABEL
            for ($v = 0; $v < count($setting_xls['data_all_sheet'][$a]); $v++) {
                $array_value = array_values($setting_xls['data_all_sheet'][$a][$v]);

                $kolom = 0;
                for ($b = 0; $b < count($array_value); $b++) {
                    if ($b == 0 && $array_value[$b] == "nomor") {
                        $sheet->setCellValueByColumnAndRow($kolom, $baris, $nomor);
                    } else {
                        $sheet->setCellValueByColumnAndRow($kolom, $baris, trim($array_value[$b]));
                    }
                    $kolom++;
                }
                $baris++;
                $nomor++;
            }

            // Otomatis atur ukuran kolom
            $kolom = 1;
            foreach ($setting_xls['data_all_sheet'][0][0] as $key => $value) {
                $sheet->getColumnDimensionByColumn($kolom)->setAutoSize(true);
                $kolom++;
            }
        }

        $spreadsheet->setActiveSheetIndex(0);

        // Buat objek Writer untuk PHPExcel
        $writer = PHPExcel_IOFactory::createWriter($spreadsheet, 'Excel2007');

        // Set header untuk download file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $nama_excel . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    // function generator_xls($setting_xls){

    //     $jumlah_sheet = $setting_xls['jumlah_sheet'] ;
    //     $nama_sheet = $setting_xls['nama_sheet'] ;
    //     $data_all_sheet = $setting_xls['data_all_sheet'] ;
    //     $nama_excel = $setting_xls['nama_excel'] ; 

    //     $spreadsheet = new Spreadsheet();
    //     for($a=0;$a<$jumlah_sheet;$a++){

    //         $baris = 1 ;
    //         $kolom = 1 ;

    //         $spreadsheet->createSheet();

    //         $spreadsheet->setActiveSheetIndex($a);
    //         $spreadsheet->getActiveSheet()->setTitle($nama_sheet[$a]);
    //         $sheet = $spreadsheet->getActiveSheet();

    //         //JUDUL TABLE
    //         foreach($setting_xls['data_all_sheet'][$a][0] as $key=>$value){
    //             $sheet->setCellValueByColumnAndRow($kolom, $baris, $key);
    //             $kolom++;
    //         }

    //         $baris++;
    //         $nomor = 1;
    //         //ISI TABLE TABLE
    //         for($v=0;$v<count($setting_xls['data_all_sheet'][$a]);$v++){
    //             $array_value = array_values($setting_xls['data_all_sheet'][$a][$v]);

                
    //             $kolom = 1 ;
    //             for($b=0;$b<count($array_value);$b++){                    
    //                 if($b==0 && $array_value[$b] == "nomor"){
    //                     $sheet->setCellValueByColumnAndRow($kolom, $baris, $nomor);
    //                 }else{
    //                     $sheet->setCellValueByColumnAndRow($kolom, $baris, trim($array_value[$b]));
    //                 }
    //                 $kolom++;
    //             }
    //             $baris++;
    //             $nomor++;
    //         }

    //         $kolom = 1 ;
    //         foreach($setting_xls['data_all_sheet'][0][0] as $key=>$value){
    //             $sheet->getColumnDimensionByColumn($kolom)->setAutoSize(true);
    //             $kolom++;
    //         }
    //     }


    //     $spreadsheet->setActiveSheetIndex(0);        
    //     $writer = new Xlsx($spreadsheet);

    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="' . $nama_excel . '.xlsx"');
    //     header('Cache-Control: max-age=0');

    //     $writer->save('php://output');
    // }
    

          

}
