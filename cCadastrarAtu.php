<?php 


function verificar()
{
    include 'model/mConsoltador.php';
    $cod = '';
    $infor = '';
    if (isset($_GET['codigo'])) {
        $cod = $_GET['codigo'];
        $infor = informaçõesUsuario($cod);  
        $cod = '<input type="hidden" name="codigo" value="'. $cod . '">';
        
    }
    if (isset($_POST['codigo']) ) {
        
      
        
        if (isset($_POST['confirmar'])) {
            var_dump('ola') ;
            $codigo = $_POST['codigo'];
            $nome = $_POST['nome'];
            // atualizar o usuário
            atualizarUsuario($codigo, $nome);
            header('Location: cListarUsuario.php');
            exit();
            
           
        }
        
    }else if(isset($_POST['confirmar'])) {
            $nome = $_POST['nome'];
            // cadastrar o usuário
            cadastrarUsuario($nome);
            header('Location: cListarUsuario.php');
            exit();
            
    }
    return [$cod, $infor];
}

include 'cGeral.php';
VerificarSecaoAtiva();
$html = file_get_contents('visao/vCadastrar.php');


$ifo = verificar();

$html = str_replace('{{cod}}', $ifo[0], $html);
$html = str_replace('{{dados}}', $ifo[1], $html);
$html = str_replace('{{tela}}', ($ifo[0] == '' )?'Cadastrar':'Atualizar', $html);
echo $html;

?>
