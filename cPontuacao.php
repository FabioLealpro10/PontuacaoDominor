<?php 

function jogadores()
{
    $usuario = cListarUsuario();
    $jogado = '';
    $pontos = '';
    $pontosTotal = '<tr>';
    $desfazerJogada = '';
    $pontuaçõesAntigas = json_decode(urldecode($_GET['participantes']), true);
    $pontuaçõesAntigas = urlencode(json_encode($pontuaçõesAntigas));

    foreach ($usuario as $jogador) 
    {
            $jogado.= "<th><h2>{$jogador['nome']}</h2></th>";
            $pontosTotal .= "<td><h1>{$jogador['pontos']}</h1></td>";
            $desfazerJogada .= '<td><form action="cPontuacao.php" method="get">
            <input type="submit" value="Desfazer último ponto" name="desfazer">
            <input type="hidden" name="codigo" value="'. $jogador['codigo'] . '">
            <input type="hidden" name="jogador" value="'.$jogador['nome'].'">
            <input type="hidden" name="participantes" value="'.$pontuaçõesAntigas.'">
        </form></td>';
            
    }
    $pontosTotal .= '</tr>';
    for ($i=5; $i <= 50 ; $i+=5) 
    { 
        $pontos .= "<tr>";
        foreach ($usuario as $jogador) 
        {
                $pontos.= '<td><form action="cPontuacao.php" >
                <input type="submit" value="+ '.$i.'">';
                $pontos.= '<input type="hidden" name="codigo" value="'. $jogador['codigo'] . '">';
                $pontos.= '<input type="hidden" name="participantes" value="'.$pontuaçõesAntigas.'">';
                $pontos.= '<input type="hidden" name="ponto" value="'.$i.'"> </form></td>';
        }
        $pontos .= "</tr>";
    }
    $pontos .= $desfazerJogada;
    $pontos.= $pontosTotal;
    return [$jogado, $pontos ];
}



function EventosPontontos()
{

    $pontuaçõesAntigas = json_decode(urldecode($_GET['participantes']), true);
    if(isset($_GET['voltar']) ) {
        ZerarPontos();
        header('Location: cListarUsuario.php');
        exit();
    }
   
    else if(isset($_GET['zerar'])) {
        $usuario = cListarUsuario();
        foreach ($usuario as $linha) {
            $pontuaçõesAntigas[$linha['nome']] = []; 
        }
        ZerarPontos();
        $pontuaçõesAntigas = urlencode(json_encode($pontuaçõesAntigas));
        header('Location: cPontuacao.php?participantes='.$pontuaçõesAntigas);
        exit();
        
    }
    else if(isset($_GET['desfazer'])) {
        
        $codigo = $_GET['codigo'];
        $jogador = $_GET['jogador'];
        $ultimoPonto = end($pontuaçõesAntigas[$jogador]);
        // Remove o último ponto do jogador
        array_pop($pontuaçõesAntigas[$jogador]);
        // Atualiza os pontos do jogador no banco de dados
        $ultimoPonto =  ($ultimoPonto === null)? 0 : $ultimoPonto; 
        atualizarPontos($codigo, -$ultimoPonto);
        // Reencoda os participantes para a URL
        $pontuaçõesAntigas = urlencode(json_encode($pontuaçõesAntigas));
        // Redireciona para a mesma página com os participantes atualizados
        header('Location: cPontuacao.php?participantes='.$pontuaçõesAntigas);
        exit();
        
    }
    else if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
        $ponto = $_GET['ponto'];
        $usuario = atualizarPontos($codigo, $ponto);
        $pontuaçõesAntigas[$usuario][] = $ponto;
        $pontuaçõesAntigas = urlencode(json_encode($pontuaçõesAntigas));
        header('Location: cPontuacao.php?participantes='.$pontuaçõesAntigas);
        exit();
        
    }

}


include 'cGeral.php';
VerificarSecaoAtiva();
include 'model/mConsoltador.php';
$html = file_get_contents('visao/vPontuacao.php');
EventosPontontos();
$jogadores = jogadores();
$html = str_replace('{{jogadores}}', $jogadores[0], $html);
$html = str_replace('{{dados}}', $jogadores[1], $html);

echo $html;

?>




