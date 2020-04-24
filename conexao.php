<?PHP


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With'); 
header('Content-Type: application/json; charset=utf-8');   



date_default_timezone_set('America/Sao_Paulo');

//CONEXAO LOCAL
/*
define('BD', 'appfinanceiro');
define('USER', 'root');
define('SENHA', '');
define('HOST', 'localhost');
*/

//CONEXAO HOSPEDADA

define('BD', 'appfinaceiro');
define('USER', 'abraao');
define('SENHA', 'tv84361033');
define('HOST', 'mysql669.umbler.com');

$mysqli = new mysqli(HOST, USER, SENHA, BD);


?>
