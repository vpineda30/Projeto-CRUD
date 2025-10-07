<?php 

function create($nome, $email, $senha){
    include_once '../db/connect.php';
    global $pdo;

    $sql = "INSERT INTO users (nome, email, senha) VALUES(:nome, :email, :senha);";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':senha', $senha);

    if($stmt->execute()){
        echo "Usuário cadastrado com sucesso.";
    }else{
        echo "Erro ao cadastrar o usuário. Tente novamente.";
    }
}

function read() {
    include_once '../db/connect.php';
    global $pdo;

    try {
        $sql = "SELECT * FROM users";
        $stmt = $pdo->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            echo $user['id'] . " - " . $user['nome'] . " - " . $user['email'] . "<br>";
        }  
    }catch (PDOException $e) {
        echo "Erro ao ler dados da tabela.";
    }
}

function update($id, $nome, $email) {
    include_once '../db/connect.php';
    global $pdo;

    $sql = "UPDATE users SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':id', $id);

    if($stmt->execute()){
        echo "Usuário atualizado com sucesso.";
    }else{
        echo "Erro ao atualizar tabela";
    }
}

function delete($id){
    include_once '../db/connect.php';
    global $pdo;

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);

    if($stmt->execute()){
        echo "Usuário deletado com sucesso.";
    }else{
        echo "Erro ao deletar usuário.";
    }
}

?>