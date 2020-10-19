<?php
 
use Carbon\Carbon;
 
function tglIndo($tgl)
{
    $tgl = new Carbon($tgl);
    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US');
    return $tgl->formatLocalized('%d %B %Y');
}

function longdate_indo($tgl)
{
    $tgl = new Carbon($tgl);
    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US');
    return $tgl->formatLocalized('%A, %d %B %Y');
}

function bulan($bulan)
{
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
        default:
            $bulan = Date('F');
            break;
    }
    return $bulan;
}