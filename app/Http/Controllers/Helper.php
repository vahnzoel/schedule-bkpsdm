<?php

namespace App\Http\Controllers;

use DateTime;
use Livewire\Component;

class Helper extends Component
{

    public function terbilang($angka)
    {
        // Validasi input
        if (!is_numeric($angka)) {
            return "Masukan harus berupa angka!";
        }
        if ($angka < 0 || $angka > 999999999999999) {
            return "Angka harus di antara 0 dan 999.999.999.999.999!";
        }

        // Sanitasi input
        $angka = abs($angka); //mengubah angka agar menjadi bernilai positif
        $angka = floor($angka); //mengubah angka agar menjadi bilangan bulat

        $angka_huruf = [
            "", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"
        ];

        if ($angka < 12) {
            return $angka_huruf[$angka];
        } elseif ($angka < 20) {
            return $this->terbilang($angka - 10) . " Belas";
        } elseif ($angka < 100) {
            return $this->terbilang($angka / 10) . " Puluh " . $this->terbilang($angka % 10);
        } elseif ($angka < 200) {
            return "seratus " . $this->terbilang($angka - 100);
        } elseif ($angka < 1000) {
            return $this->terbilang($angka / 100) . " Ratus " . $this->terbilang($angka % 100);
        } elseif ($angka < 2000) {
            return "seribu " . $this->terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            return $this->terbilang($angka / 1000) . " Ribu " . $this->terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            return $this->terbilang($angka / 1000000) . " Juta " . $this->terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            return $this->terbilang($angka / 1000000000) . " Miliar " . $this->terbilang($angka % 1000000000);
        } else {
            return $this->terbilang($angka / 1000000000000) . " Triliun " . $this->terbilang($angka % 1000000000000);
        }
    }

    public function hari($tgl)
    {
        switch ($tgl) {
            case '1':
                $hari_kalimat = 'Senin';
                break;
            case '2':
                $hari_kalimat = 'Selasa';
                break;
            case '3':
                $hari_kalimat = 'Rabu';
                break;
            case '4':
                $hari_kalimat = 'Kamis';
                break;
            case '5':
                $hari_kalimat = "Jum'at";
                break;
            case '6':
                $hari_kalimat = 'Sabtu';
                break;
            case '7':
                $hari_kalimat = 'Minggu';
                break;
            default:
                $hari_kalimat = '';
                break;
        }

        // Gabungkan bagian-bagian tanggal menjadi kalimat
        $kalimat = $hari_kalimat;

        return $kalimat;
    }

    public function bulan($tgl)
    {
        // Validasi input
        if (!preg_match('/^\d{2}-\d{2}-\d{4}$/', $tgl)) {
            return "Format tanggal tidak valid!";
        }

        // Pecah tanggal menjadi bagian tahun, bulan, dan hari
        list($tanggal, $bulan, $tahun) = explode('-', $tgl);

        // Konversi bulan ke dalam format teks
        switch ($bulan) {
            case '01':
                $bulan_kalimat = 'Januari';
                break;
            case '02':
                $bulan_kalimat = 'Februari';
                break;
            case '03':
                $bulan_kalimat = 'Maret';
                break;
            case '04':
                $bulan_kalimat = 'April';
                break;
            case '05':
                $bulan_kalimat = 'Mei';
                break;
            case '06':
                $bulan_kalimat = 'Juni';
                break;
            case '07':
                $bulan_kalimat = 'Juli';
                break;
            case '08':
                $bulan_kalimat = 'Agustus';
                break;
            case '09':
                $bulan_kalimat = 'September';
                break;
            case '10':
                $bulan_kalimat = 'Oktober';
                break;
            case '11':
                $bulan_kalimat = 'November';
                break;
            case '12':
                $bulan_kalimat = 'Desember';
                break;
            default:
                $bulan_kalimat = '';
                break;
        }

        $kalimat = $bulan_kalimat;

        return $kalimat;
    }

    public function tanggal_ke_kalimat($tgl)
    {
        // Validasi input
        if (!preg_match('/^\d{2}-\d{2}-\d{4}$/', $tgl)) {
            return "Format tanggal tidak valid!";
        }

        // Pecah tanggal menjadi bagian tahun, bulan, dan hari
        list($tanggal, $bulan, $tahun) = explode('-', $tgl);

        // Konversi bulan ke dalam format teks
        switch ($bulan) {
            case '01':
                $bulan_kalimat = 'Januari';
                break;
            case '02':
                $bulan_kalimat = 'Februari';
                break;
            case '03':
                $bulan_kalimat = 'Maret';
                break;
            case '04':
                $bulan_kalimat = 'April';
                break;
            case '05':
                $bulan_kalimat = 'Mei';
                break;
            case '06':
                $bulan_kalimat = 'Juni';
                break;
            case '07':
                $bulan_kalimat = 'Juli';
                break;
            case '08':
                $bulan_kalimat = 'Agustus';
                break;
            case '09':
                $bulan_kalimat = 'September';
                break;
            case '10':
                $bulan_kalimat = 'Oktober';
                break;
            case '11':
                $bulan_kalimat = 'November';
                break;
            case '12':
                $bulan_kalimat = 'Desember';
                break;
            default:
                $bulan_kalimat = '';
                break;
        }

        switch ($tanggal) {
            case '1':
                $hari_kalimat = 'Senin';
                break;
            case '2':
                $hari_kalimat = 'Selasa';
                break;
            case '3':
                $hari_kalimat = 'Rabu';
                break;
            case '4':
                $hari_kalimat = 'Kamis';
                break;
            case '5':
                $hari_kalimat = "Jum'at";
                break;
            case '6':
                $hari_kalimat = 'Sabtu';
                break;
            case '7':
                $hari_kalimat = 'Minggu';
                break;
            default:
                $hari_kalimat = '';
                break;
        }

        // Konversi hari ke dalam format teks
        $tanggal_kalimat = $this->terbilang($tanggal);

        // Konversi tahun ke dalam format teks
        $tahun_kalimat = $this->terbilang($tahun);

        // Gabungkan bagian-bagian tanggal menjadi kalimat
        $kalimat = $hari_kalimat . ' Tanggal ' . $tanggal_kalimat . ' Bulan ' . $bulan_kalimat . ' Tahun ' . $tahun_kalimat;

        return $kalimat;
    }

    public function tanggal($tgl)
    {
        $a = explode('T', $tgl);
        if ($a > 1) {
            $t = $a[0];
        } else {
            $t = $tgl;
        }
        // Pecah tanggal menjadi bagian tahun, bulan, dan hari
        list($tahun, $bulan, $tanggal) = explode('-', $t);

        // Konversi bulan ke dalam format teks
        switch ($bulan) {
            case '01':
                $bulan_kalimat = 'Januari';
                break;
            case '02':
                $bulan_kalimat = 'Februari';
                break;
            case '03':
                $bulan_kalimat = 'Maret';
                break;
            case '04':
                $bulan_kalimat = 'April';
                break;
            case '05':
                $bulan_kalimat = 'Mei';
                break;
            case '06':
                $bulan_kalimat = 'Juni';
                break;
            case '07':
                $bulan_kalimat = 'Juli';
                break;
            case '08':
                $bulan_kalimat = 'Agustus';
                break;
            case '09':
                $bulan_kalimat = 'September';
                break;
            case '10':
                $bulan_kalimat = 'Oktober';
                break;
            case '11':
                $bulan_kalimat = 'November';
                break;
            case '12':
                $bulan_kalimat = 'Desember';
                break;
            default:
                $bulan_kalimat = '';
                break;
        }
        // Gabungkan bagian-bagian tanggal menjadi kalimat
        $tanggal = $tanggal . ' ' . $bulan_kalimat . ' ' . $tahun;

        return $tanggal;
    }

    public function past($date, $tgl)
    {
        $text = '';
        $now = new DateTime($date);
        $pas = new DateTime($tgl);
        if ($pas > $now) {
            $text = 'future';
        }

        return $text;
    }
}
