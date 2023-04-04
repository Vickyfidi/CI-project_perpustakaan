<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_jabatan extends CI_Model
{
    var $table = 'jabatan';
    var $column_order = array(null, 'id_jabatan', 'nama_jabatan', null);
    var $column_search = array('nama_jabatan');
    var $order = array('id_jabatan' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }



    function cek_jabatan($nama_jabatan)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('nama_jabatan', $nama_jabatan);
        $Q = $this->db->get('jabatan');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    public function get_by_id($id_jabatan)
    {
        $this->db->from($this->table);
        $this->db->where('id_jabatan', $id_jabatan);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id_jabatan)
    {
        $this->db->where('id_jabatan', $id_jabatan);
        $this->db->delete($this->table);
    }

    function total_rows()
    {
        return $this->db->get('jabatan')->num_rows();
    }
}
