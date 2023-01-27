<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donusturucu_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public $bozukHarfler = array(
        'ý',
        'Ý',
        'ð',
        'Ð',
        'þ',
        'Þ'
    );
    public $buyukHarfler = array(
        'i',
        'İ',
        'ğ',
        'Ğ',
        'ş',
        'Ş'
    );
    public function turkceKarakter($str)
    {
        return str_replace($this->bozukHarfler, $this->buyukHarfler, $str);
    }
    public $aramaKarakterler = array(
        'i',
        'İ',
        'ğ',
        'Ğ',
        'ş',
        'Ş'
    );
    public $aramaSemboller = array(
        'Ý',
        'Ý',
        'Ð',
        'Ð',
        'Þ',
        'Þ'
    );
    public function turkceKarakterArama($str)
    {
        return str_replace($this->aramaKarakterler, $this->aramaSemboller, $str);
    }
    public function decimal($sayi){
        return number_format((float)$sayi, 2, ',', '');
    }
}
