<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public $tblStok = "TBLSTSABIT";
    public $stokKodu = "STOK_KODU";
    public $stokAdi = "STOK_ADI";
    public $alisFiat1 = "ALIS_FIAT1";
    public $alisFiat2 = "ALIS_FIAT2";
    public $alisFiat3 = "ALIS_FIAT3";
    public $alisFiat4 = "ALIS_FIAT4";
    public $satisFiat1 = "SATIS_FIAT1";
    public $satisFiat2 = "SATIS_FIAT2";
    public $satisFiat3 = "SATIS_FIAT3";
    public $satisFiat4 = "SATIS_FIAT4";
    public $kdvOrani = "KDV_ORANI";
    public $olcuBr1 = "OLCU_BR1";
    public $olcuBr2 = "OLCU_BR2";
    public $olcuBr3 = "OLCU_BR3";

    // Tablo ek
    public $tblStokEk = "TBLSTSABITEK";
    public $kayitTarihi = "KAYITTARIHI";

    // Hareketler
    public $tblStHar = "TBLSTHAR";
    public $stHarTarih = "STHAR_TARIH";
    public $fisNo = "FISNO";
    public $stHarNF = "STHAR_NF";
    public $stharGcKod = "STHAR_GCKOD";
    public $stokHarGiris = "G";
    public $stokHarCikis = "C";
    public $stharGCMIK = "STHAR_GCMIK";
    public $stharAciklama = "STHAR_ACIKLAMA";

    public function stoklar($stokKod, $sira = 0, $ogeSayisi = 0, $ara = "")
    {
        $query = $this->db->reset_query();
        $query->select($this->tblStok . "." . $this->stokKodu . "," . $this->tblStok . "." . $this->stokAdi . "," . $this->tblStok . "." . $this->alisFiat1 . "," . $this->tblStok . "." . $this->alisFiat2 . "," . $this->tblStok . "." . $this->alisFiat3 . "," . $this->tblStok . "." . $this->alisFiat4 . "," . $this->tblStok . "." . $this->satisFiat1 . "," . $this->tblStok . "." . $this->satisFiat2 . "," . $this->tblStok . "." . $this->satisFiat3 . "," . $this->tblStok . "." . $this->satisFiat4 . "," . $this->tblStok . "." . $this->kdvOrani . "," . $this->tblStok . "." . $this->olcuBr1 . "," . $this->tblStok . "." . $this->olcuBr2 . "," . $this->tblStok . "." . $this->olcuBr3 . "," . $this->tblStokEk . "." . $this->kayitTarihi)->from($this->tblStok);

        if (strlen($ara) > 0) {
            $ara = $this->Donusturucu_Model->turkceKarakterArama($ara);
            $query->like($this->tblStok . "." . $this->stokKodu, $ara)->or_like($this->tblStok . "." . $this->stokAdi, $ara);
        }
        if(strlen($stokKod) > 0){
            $query->where($this->tblStok.".".$this->stokKodu, $this->Donusturucu_Model->turkceKarakterArama($stokKod));
        }
        $query->join($this->tblStokEk, $this->tblStok . "." . $this->stokKodu . " = " . $this->tblStokEk . "." . $this->stokKodu);
        $query->order_by($this->tblStokEk . "." . $this->kayitTarihi, "DESC");
        if ($ogeSayisi > 0) {
            $query->limit($ogeSayisi, $sira);
        }
        return $query->get();
    }
    public function stok_donustur($stoklar, $hareketleri_goster = TRUE)
    {
        $stoklar = $stoklar->result_array();
        for ($i = 0; $i < count($stoklar); $i++) {
            $alisFiyatiSayisi = 0;
            $alisFiyati = "";
            if ($stoklar[$i][$this->alisFiat1] > 0) {
                $alisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->alisFiat1]);
                $alisFiyatiSayisi++;
            }
            if ($stoklar[$i][$this->alisFiat2] > 0) {
                if ($alisFiyatiSayisi > 0) {
                    $alisFiyati .= ', ';
                }
                $alisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->alisFiat2]);
                $alisFiyatiSayisi++;
            }
            if ($stoklar[$i][$this->alisFiat3] > 0) {
                if ($alisFiyatiSayisi > 0) {
                    $alisFiyati .= ', ';
                }
                $alisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->alisFiat3]);
                $alisFiyatiSayisi++;
            }
            if ($stoklar[$i][$this->alisFiat4] > 0) {
                if ($alisFiyatiSayisi > 0) {
                    $alisFiyati .= ', ';
                }
                $alisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->alisFiat4]);
            }
            $satisFiyatiSayisi = 0;
            $satisFiyati = "";
            if ($stoklar[$i][$this->satisFiat1] > 0) {
                $satisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->satisFiat1]);
                $satisFiyatiSayisi++;
            }
            if ($stoklar[$i][$this->satisFiat2] > 0) {
                if ($satisFiyatiSayisi > 0) {
                    $satisFiyati .= ', ';
                }
                $satisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->satisFiat2]);
                $satisFiyatiSayisi++;
            }
            if ($stoklar[$i][$this->satisFiat3] > 0) {
                if ($satisFiyatiSayisi > 0) {
                    $satisFiyati .= ', ';
                }
                $satisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->satisFiat3]);
                $satisFiyatiSayisi++;
            }
            if ($stoklar[$i][$this->satisFiat4] > 0) {
                if ($satisFiyatiSayisi > 0) {
                    $satisFiyati .= ', ';
                }
                $satisFiyati .= $this->Donusturucu_Model->decimal($stoklar[$i][$this->satisFiat4]);
            }
            $olcuBrSayisi = 0;
            $olcuBrimi = "";
            if ($stoklar[$i][$this->olcuBr1] > 0) {
                $olcuBrimi .= $stoklar[$i][$this->olcuBr1];
                $olcuBrSayisi++;
            }
            if ($stoklar[$i][$this->olcuBr2] > 0) {
                if ($olcuBrSayisi > 0) {
                    $olcuBrimi .= ', ';
                }
                $olcuBrimi .= $stoklar[$i][$this->olcuBr2];
                $olcuBrSayisi++;
            }
            if ($stoklar[$i][$this->olcuBr3] > 0) {
                if ($olcuBrSayisi > 0) {
                    $olcuBrimi .= ', ';
                }
                $olcuBrimi .= $stoklar[$i][$this->olcuBr3];
                $olcuBrSayisi++;
            }
            $yeniStoklar = array(
                $this->Donusturucu_Model->turkceKarakter($stoklar[$i][$this->stokKodu]),
                $this->Donusturucu_Model->turkceKarakter($stoklar[$i][$this->stokAdi]),
                $alisFiyati,
                $satisFiyati,
                $this->Donusturucu_Model->decimal($stoklar[$i][$this->kdvOrani]),
                $olcuBrimi,
                substr($stoklar[$i][$this->kayitTarihi], 0, 10)
            );
            if($hareketleri_goster){
                array_push($yeniStoklar, 
                '<a href="' . base_url("stok/hareket/" . $this->Donusturucu_Model->turkceKarakter($stoklar[$i][$this->stokKodu])) . '" class="btn btn-primary">Hareketler</a>');
            }
            $stoklar[$i] = $yeniStoklar;
        }
        return $stoklar;
    }
    public function stok_hareket($kod, $sira = 0, $ogeSayisi = 0, $ara = "")
    {
        $query = $this->db->reset_query();
        $query->select($this->stHarTarih . "," . $this->fisNo . "," . $this->stHarNF . "," . $this->stharGcKod . "," . $this->stharGCMIK . "," . $this->stharAciklama);
        $query->where($this->stokKodu, $this->Donusturucu_Model->turkceKarakterArama($kod));
        $query->order_by($this->stHarTarih, "DESC");
        
        if (strlen($ara) > 0) {
            $ara = $this->Donusturucu_Model->turkceKarakterArama($ara);
            $query->like($this->stharAciklama, $ara);
        }
        if ($ogeSayisi > 0) {
            $query->limit($ogeSayisi, $sira);
        }
        return $query->get($this->tblStHar);
    }
    public function stok_hareket_donustur($stok_hareket)
    {
        $stok_hareket = $stok_hareket->result_array();
        $bakiye = 0;
        for ($i = count($stok_hareket) - 1; $i >= 0; $i--) {
            if ($stok_hareket[$i][$this->stharGcKod] == $this->stokHarGiris) {
                $bakiye += $stok_hareket[$i][$this->stharGCMIK];
            } else if ($stok_hareket[$i][$this->stharGcKod] == $this->stokHarCikis) {
                $bakiye -= $stok_hareket[$i][$this->stharGCMIK];
            }
            $stok_hareket[$i] = array(
                substr($stok_hareket[$i][$this->stHarTarih], 0, 10),
                $stok_hareket[$i][$this->fisNo],
                $stok_hareket[$i][$this->stHarNF],
                $stok_hareket[$i][$this->stharGcKod] == $this->stokHarGiris ? $stok_hareket[$i][$this->stharGCMIK] : "",
                $stok_hareket[$i][$this->stharGcKod] == $this->stokHarCikis ? $stok_hareket[$i][$this->stharGCMIK] : "",
                $this->Donusturucu_Model->decimal($bakiye),
                $this->Donusturucu_Model->turkceKarakter($stok_hareket[$i][$this->stharAciklama]),
            );
        }
        return $stok_hareket;
    }
}
