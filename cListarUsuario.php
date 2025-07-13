<?php 

function verificarEvento(){
    
    if(isset($_GET['excluir'])){
        $codigo = $_GET['excluir'];
        excluirUsuario($codigo);
        header('Location: cListarUsuario.php');
        exit();
    }
}
function TodosUsuarios()
{
    $usuarios = [];
    $usuario = cListarUsuario();
    $html = '';
    foreach ($usuario as $linha)
    {
        $html .= '<tr>';
        $html .= '<td>' . $linha['nome'] . '</td>';
        $html .= '<td><a href="cCadastrarAtu.php?codigo=' . $linha['codigo'] . '">Editar</a> <a href="cListarUsuario.php?excluir=' . $linha['codigo'] . '">Excluir</a></td>';
        $html .= '</tr>';

        $usuarios["{$linha['nome']}"] = [];
    }
    $usuarios = urlencode(json_encode($usuarios));
    return [$html, $usuarios];
}

include 'cGeral.php';
VerificarSecaoAtiva();
include 'model/mConsoltador.php';
$html = file_get_contents('visao/vListarUsuario.php');
verificarEvento();
$dados = TodosUsuarios();
$participantes = $dados[1];
$dados = $dados[0];
$html = str_replace('{{participantes}}', $participantes, $html);
$html = str_replace('{{dados}}', $dados, $html);
echo $html;
?>


