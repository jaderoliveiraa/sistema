<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//rotas formas de pagamentos
$route['pagamentos'] = 'Formas_pagamentos/index';
$route['pagamentos/add'] = 'Formas_pagamentos/add';
$route['pagamentos/edit/(:num)'] = 'Formas_pagamentos/edit/$1';
$route['pagamentos/del/(:num)'] = 'Formas_pagamentos/del/$1';

//rotas de ordens de serviço
$route['os'] = 'Ordem_servicos/index';
$route['os/add'] = 'Ordem_servicos/add';
$route['os/edit/(:num)'] = 'Ordem_servicos/edit/$1';
$route['os/del/(:num)'] = 'Ordem_servicos/del/$1';