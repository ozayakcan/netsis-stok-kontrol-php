<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('stok');
    }
    public function json()
    {
        $draw = $this->input->post("draw");
        $start = $this->input->post("start");
        $length = $this->input->post("length");
        $search = $this->input->post("search");
        if(isset($search)){
            if(isset($search["value"]) && !empty($search["value"])){
                $search = $search["value"];
            }else{
                $search = "";
            }
        }else{
            $search = "";
        }
        $order = $this->input->post("order");
        $columns = $this->input->post("columns");
        $stoklar = $this->Stok_Model->stoklar($start, $length, $search);
        $filtreliStokSayisi = $this->Stok_Model->stoklar(0, 0, $search)->num_rows();
        $stokSayisi = $this->Stok_Model->stoklar()->num_rows();
        $result = array();
        $result["draw"] = $draw;
        $result["recordsTotal"] = $stokSayisi;
        $result["recordsFiltered"] = $filtreliStokSayisi;
        $result["data"] = $this->Stok_Model->stok_donustur($stoklar);
        echo json_encode($result);
    }
    public function hareket($kod = "")
    {
        if (strlen($kod) > 0) {
            $this->load->view('stok_hareket', array("kod" => $kod));
        } else {
            redirect(base_url());
        }
    }
}