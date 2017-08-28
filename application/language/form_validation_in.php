<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']		= '{field} tidak boleh kosong.';
$lang['form_validation_isset']			= '{field} harus memiliki nilai.';
$lang['form_validation_valid_email']		= '{field} tidak berisi format email yang valid.';
$lang['form_validation_valid_emails']		= '{field} tidak semua berisi format email yang valid.';
$lang['form_validation_valid_url']		= '{field} tidak berisi URL yang valid.';
$lang['form_validation_valid_ip']		= '{field} tidak berisi IP yang valid.';
$lang['form_validation_min_length']		= '{field} terlalu pendek (minimal {param} karakter).';
$lang['form_validation_max_length']		= '{field} terlalu panjang (maksimal {param} karakter).';
$lang['form_validation_exact_length']		= '{field} harus berisi {param} karakter.';
$lang['form_validation_alpha']			= '{field} hanya bisa diisi dengan huruf alfabet.';
$lang['form_validation_alpha_numeric']		= '{field} hanya bisa diisi dengan huruf alfabet dan angka.';
$lang['form_validation_alpha_numeric_spaces']	= '{field} hanya bisa diisi dengan huruf alfabet, angka, dan spasi.';
$lang['form_validation_alpha_dash']		= '{field} hanya bisa diisi dengan huruf alfabet, angka, underscore (_) dan hyphen (-).';
$lang['form_validation_numeric']		= '{field} hanya bisa diisi dengan bilangan. Bilangan hanya boleh disusun dengan angka, titik sebagai pengganti koma, dan tanda negatif/positif.';
$lang['form_validation_is_numeric']		= '{field} hanya bisa diisi dengan bilangan. Bilangan hanya boleh disusun dengan angka, titik sebagai pengganti koma, dan tanda negatif/positif.';
$lang['form_validation_integer']		= '{field} hanya bisa diisi dengan bilangan bulat.';
$lang['form_validation_regex_match']		= '{field} tidak mengikuti format yang tepat.';
$lang['form_validation_matches']		= '{field} tidak sama dengan {param}.';
$lang['form_validation_differs']		= '{field} harus berbeda dengan {param}.';
$lang['form_validation_is_unique'] 		= '{field} sudah terdapat pada sistem. Silahkan tentukan {field} yang berbeda.';
$lang['form_validation_is_natural']		= '{field} hanya bisa diisi dengan bilangan yang tersusun dari angka 0-9.';
$lang['form_validation_is_natural_no_zero']	= '{field} hanya bisa diisi dengan bilangan yang tersusun dari angka 0-9 dan bernilai lebih dari 0.';
$lang['form_validation_decimal']		= '{field} hanya bisa diisi dengan bilangan desimal (boleh didahului dengan tanda positif/negatif).';
$lang['form_validation_less_than']		= 'Nilai {field} harus lebih kecil dari {param}.';
$lang['form_validation_less_than_equal_to']	= 'Nilai {field} harus lebih kecil atau sama dengan {param}.';
$lang['form_validation_greater_than']		= 'Nilai {field} harus lebih besar dari {param}.';
$lang['form_validation_greater_than_equal_to']	= 'Nilai {field} harus lebih besar atau sama dengan {param}.';
$lang['form_validation_error_message_not_set']	= 'Pesan kesalahan untuk {field} tidak ditemukan. Silahkan kontak teknisi sistem.';
$lang['form_validation_in_list']		= '{field} harus bernilai salah satu dari pilihan berikut: {param}.';
