<?php 




function cListarUsuarioPontos() {
    
    $usuarios = cListarUsuarioPorRanke();
    $hml = '';
    foreach ($usuarios as $indece => $usuario) 
    {
        $hml .= '<tr>';
        $hml .= '<td>' .($indece+1). '</td>';
        $hml .= '<td>' . $usuario['nome'] . '</td>';
        $hml .= '<td>' . $usuario['pontos'] . '</td>';

    }
    return $hml;
        
    
}





include 'model/mConsoltador.php';
$html = file_get_contents("visao/vMostrarPontuacao.php");
$usuarios = cListarUsuarioPontos();
$html = str_replace('{{dados}}', $usuarios, $html);
echo $html;
?>

