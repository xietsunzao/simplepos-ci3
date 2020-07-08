<?php

function chek_session()
{
    $CI = &get_instance();
    $session = $CI->session->userdata;
    if ($session['status_login'] != 'oke') {
        redirect('auth/login');
    }
}

function chek_role()
{
    $CI = &get_instance();
    $session = $CI->session->userdata;
    if ($session['status_login'] != 'oke') {
        redirect('auth/login');
    } else if ($session['akses'] != 1) {
        show_error('Hanya administrator yang dapat mengakses halaman ini', 403, 'akses terlarang');
    }
}
