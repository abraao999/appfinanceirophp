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

define('BD', 'gxro80s41bhliuv3');
define('USER', 'xhhf3tbt916na77s');
define('SENHA', 'zqjj4c8ytlrapnc3');
define('HOST', 'mzj2x67aktl2o6q2n.cbetxkdyhwsb.us-east-1.rds.amazonaws.com');

$mysqli = new mysqli(HOST, USER, SENHA, BD);


?>
