<?php
    require '../../conexao.php';

    $dados = json_decode($_GET['dados'],true);

    $verificacoes[0] = ['coluna' => 'nr_rg','dado' => $dados['nr_rg'],'nome' => 'RG','tabela' => 'cadastro'];
    $verificacoes[1] = ['coluna' => 'nr_cpf','dado' => $dados['nr_cpf'],'nome' => 'CPF','tabela' => 'cadastro'];
    $verificacoes[2] = ['coluna' => 'ed_email','dado' => $dados['ed_email'],'nome' => 'email','tabela' => 'cadastro'];
    $verificacoes[3] = ['coluna' => 'nm_usuario','dado' => $dados['nm_usuario'],'nome' => 'nome de usuário','tabela' => 'login'];

    $error = [];
    foreach ($verificacoes as $key => $v) {
        $sql = "SELECT 1 FROM {$v['tabela']} WHERE {$v['coluna']} = '{$v['dado']}'";
        $query = mysqli_query($conexao, $sql);
        $qtd =  mysqli_num_rows($query);
        if($qtd > 0){
            $error[] = $v;
        }
    }

    echo json_encode($error);

?>
