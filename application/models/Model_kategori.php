<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_kategori extends CI_Model
{
    var $table = 'kategori';
    var $column_order = array(null, 'id_kategori', 'kode_kategori', 'nama_kategori', null);
    var $column_search = array('kode_kategori', 'nama_kategori');
    var $order = array('id_kategori' => 'desc');

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



    function cek_kode_kategori($kode_kategori)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('kode_kategori', $kode_kategori);
        $Q = $this->db->get('kategori');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function cek_kategori($nama_kategori)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('nama_kategori', $nama_kategori);
        $Q = $this->db->get('kategori');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    public function get_by_id($id_kategori)
    {
        $this->db->from($this->table);
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->delete($this->table);
    }

    function total_rows()
    {
        return $this->db->get('kategori')->num_rows();
    }
}
