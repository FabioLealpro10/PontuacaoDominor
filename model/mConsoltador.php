<?php 


function verificarCredenciais($admin, $senhaADM) {
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE nome = ? AND senha = ?");
    $stmt->bind_param("ss", $admin, $senhaADM);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $stmt->close();
    $conexao->close();
    return $resultado->num_rows > 0;
   
    
}




function cListarUsuario(){
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->query("SELECT codigo, nome, pontos FROM usuarios WHERE codigo!=1 ;");
    $resultado = $stmt->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conexao->close();
    return $resultado;

}


function informaçõesUsuario($cod)
{
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE codigo = ?");
    $stmt->bind_param("i", $cod);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $conexao->close();
    return $resultado['nome']; // Retorna o nome ou uma string vazia se não encontrado
} 


function cadastrarUsuario($nome)
{
    $nome = strtoupper(trim($nome));
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->prepare("INSERT INTO usuarios (nome, pontos) VALUES (?, 0)");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}

function atualizarUsuario($codigo, $nome)
{
    $nome = strtoupper(trim($nome));
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->prepare("UPDATE usuarios SET nome = ? WHERE codigo = ?");
    $stmt->bind_param("si", $nome, $codigo);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}


function excluirUsuario($codigo)
{
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->prepare("DELETE FROM usuarios WHERE codigo = ?");
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $stmt->close();
    $conexao->close();
    
}


function atualizarPontos($codigo, $ponto)
{
    var_dump($ponto);
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->prepare("UPDATE usuarios SET pontos = pontos + ? WHERE codigo = ?");
    $stmt->bind_param("ii", $ponto, $codigo);
    $stmt->execute();

    $stmt = $conexao->prepare("SELECT nome FROM usuarios WHERE codigo = ?");
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $resultado = $resultado->fetch_assoc();
    $stmt->close();
    $conexao->close();
    return $resultado['nome']; // Retorna o nome do usuário excluído ou uma string vazia se não encontrado
}


function ZerarPontos()
{
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->prepare("UPDATE usuarios SET pontos = 0 WHERE codigo != 1");
    $stmt->execute();
    $stmt->close();
    $conexao->close();
}



function cListarUsuarioPorRanke() {
    include 'model/cofBanco.php';
    $conexao = new mysqli($serveB, $usuarioB, $senhaB, $nomeBanco);
    $stmt = $conexao->query("SELECT nome, pontos FROM usuarios where codigo != 1 order by pontos DESC ");
    $resultado = $stmt->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conexao->close();
    
    return $resultado;
}

?>