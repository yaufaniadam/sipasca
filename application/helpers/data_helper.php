<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// -----------------------------------------------------------------------------
function getUserbyId($id)
{

    $CI = &get_instance();
    return $CI->db->get_where('ci_users', array('id' => $id))->row_array()['firstname'];
}

function getProdiById($id)
{

    $CI = &get_instance();
    return $CI->db->get_where('prodi', array('id_prodi' => $id))->row_array()['prodi'];
}