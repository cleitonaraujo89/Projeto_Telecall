<?php
class Usuario
{

    private $pdo;

    // CONEXÃO
    public function __construct(array $dbConfig)
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}",
                $dbConfig['user'],
                $dbConfig['password']
            );
        } catch (PDOException $e) {
            echo "Erro com o Banco de Dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico: " . $e->getMessage();
        }
    }

    // LOGIN
    public function logar($login, $senha)
    {
        $res = array(); // vazio para evitar erros
        $senhaMD5 = md5($senha);
        $cmd = $this->pdo->prepare("SELECT nome, sexo, login, email, admin FROM cad_usuarios WHERE login = :l AND senha = :s AND ativo = 1");
        $cmd->bindValue(":l", $login);
        $cmd->bindValue(":s", $senhaMD5);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);

        return $res;

    }

    // 2FA Master
    public function master($email)
    {
        $res = array(); // vazio para evitar erros
        $n = random_int(1, 3); // gera numeros aleatorios criptografados
        $p = "pergunta_$n"; // monta uma string com o numero
        $cmd = $this->pdo->prepare("SELECT id, $p  FROM perguntas WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();

        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        if (!$res) {
            // se n encontrar retorna o false para bloquear no html
            return $res;
        } else { // caso contrario...
            // atribui o valor aleatório dentro do array que será retornado
            $res['n'] = $n;
            return $res;
        }
    }

    //CONSULTA PERGUNTAS E RESPOSTAS MASTER
    public function checaResposta($resposta, $numero, $id)
    {
        $res = array(); // vazio para evitar erros
        $respostaComNumero = "resposta_$numero";

        $cmd = $this->pdo->prepare("SELECT EXISTS(SELECT 1 FROM perguntas WHERE id = :id AND $respostaComNumero = :res) AS resultado");
        $cmd->bindValue(":id", $id);
        $cmd->bindValue(":res", $resposta);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        //return $res;
        if ($res['resultado'] == 1) {
            return true;
        } else {
            return false;
        }

    }


    // CADASTRO
    public function cadastrarUsuario($nome, $data, $cpf, $nomeMae, $sexo, $email, $telefone, $telefoneFixo, $cep, $estado, $rua, $numero, $complemento, $bairro, $cidade, $login, $senha)
    {
        // 1º checamos se existe no BD o e-mail, login ou o cpf
        $cmd = $this->pdo->prepare("SELECT id FROM cad_usuarios WHERE email = :e or cpf = :c or login = :l");
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":c", $cpf);
        $cmd->bindValue(":l", $login);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            try {
                // Depois formatamos a data para o formato do BD
                $dataDoFormulario = $data;
                $dataFormatada = date("Y-m-d", strtotime($dataDoFormulario));
                $senhaMD5 = md5($senha); // e hashiamos a senha

                // e por fim fazemos a inserção dos dados na tabela usuarios
                $cmd = $this->pdo->prepare("INSERT INTO cad_usuarios (nome, data, cpf, nomeMae, sexo, email, telefone, telefoneFixo, login, senha) VALUES (:n, :d, :c, :nm, :s, :e, :t, :tf, :l, :sen)");

                $cmd->bindValue(":n", $nome);
                $cmd->bindValue(":d", $dataFormatada);
                $cmd->bindValue(":c", $cpf);
                $cmd->bindValue(":nm", $nomeMae);
                $cmd->bindValue(":s", $sexo);
                $cmd->bindValue(":e", $email);
                $cmd->bindValue(":t", $telefone);
                $cmd->bindValue(":tf", $telefoneFixo);
                $cmd->bindValue(":l", $login);
                $cmd->bindValue(":sen", $senhaMD5);
                $cmd->execute();

                // depois na tabela residencia
                $cmd = $this->pdo->prepare("INSERT INTO residencia (id_usuario, rua, numero, complemento, bairro, cidade, estado, cep) VALUES ((SELECT id FROM cad_usuarios WHERE cpf = :c), :rua, :num, :comp, :bai, :ct, :uf, :cep)");

                $cmd->bindValue(":c", $cpf);
                $cmd->bindValue(":cep", $cep);
                $cmd->bindValue(":uf", $estado);
                $cmd->bindValue(":rua", $rua);
                $cmd->bindValue(":num", $numero);
                $cmd->bindValue(":comp", $complemento);
                $cmd->bindValue(":bai", $bairro);
                $cmd->bindValue(":ct", $cidade);

                $cmd->execute();
                return true;

                //caso algo dê errado checa se foi salvo algo e apaga
            } catch (Exception $e) { 

                $cmd = $this->pdo->prepare("DELETE FROM cad_usuarios WHERE cpf = :c");
                $cmd->bindValue(":c", $cpf);
                $cmd->execute();
                
            }

        }
    }

    // ALTERAÇÃO DE SENHA
    public function alterarSenha($login, $senha, $novaSenha)
    {

        $senhaMD5 = md5($senha);
        $cmd = $this->pdo->prepare("SELECT id FROM cad_usuarios WHERE login = :l AND senha = :s");
        $cmd->bindValue(":l", $login);
        $cmd->bindValue(":s", $senhaMD5);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);

        if (!$res) { //caso não encontremos o login e senha informado
            return false;
        } else {
            $novaSenhaMD5 = md5($novaSenha);
            $id = $res["id"];
            $cmd = $this->pdo->prepare("UPDATE cad_usuarios SET senha = :ns WHERE id = $id");
            $cmd->bindValue(":ns", $novaSenhaMD5);
            $cmd->execute();
            return true;
        }

    }

    public function consultar($arrayItens)
    {
        $consulta = array();
        // --- VARIAVEIS PARA O SELECT
        $id = "id";
        $nome = "";
        $cpf = "";
        $email = "";
        $data = "";
        $sexo = "";
        $telefone = "";
        $telefoneFixo = "";
        $endereco = "";
        $complemento = "";
        $nomeMae = "";
        $nome_digitado = "";
        $cpf_digitado = "";
        $email_digitado = "";
        $id_digitado = "";
        $nomeConsulta = "";
        $cpfConsulta = "";
        $emailConsulta = "";
        $idConsulta = "";
        // ----- controle de condições
        $contador = 0;
        $and1 = "";
        $and2 = "";
        $and3 = "";
        $and4 = "";



        // addslashes e montando as strings
        foreach ($arrayItens as $campo => $valor) {
            if ($arrayItens[$campo] != "") {
                $consulta[$campo] = addslashes($arrayItens[$campo]);

                $contador += 1;
                if (count($arrayItens) - 4 == 1) {

                    $id = "id,";
                    $$campo = $consulta[$campo];
                    // ATENÇÃO COM ESSA LINHA ACIMA
                }
                if ($contador < count($arrayItens) - 4) {

                    $id = "id,";
                    $$campo = $consulta[$campo] . ",";
                    // ATENÇÃO COM ESSA LINHA ACIMA
                } else {
                    $$campo = $consulta[$campo];
                }

            }


        }
        $contador = 0;

        //--- ATIVANDO OS FILTROS

        if ($nome_digitado != "") {
            $nomeConsulta = "nome LIKE \"%$nome_digitado%\" ";
            $and1 = " AND ";
        }

        if ($cpf_digitado != "") {
            $cpfConsulta = "cpf = \"$cpf_digitado\" ";
            $and2 = " AND ";
        }

        if ($email_digitado != "") {
            $emailConsulta = "email LIKE \"%$email_digitado%\" ";
            $and3 = " AND ";
        }

        if ($id_digitado != "") {
            $idConsulta = "id = $id_digitado ";
            $and4 = " AND ";
        }
        if ($id == 'id') { // verificação para caso haja o select * from...
            $id = "id, ";
            $nome = "nome, ";
            $cpf = "cpf, ";
            $email = "email, ";
            $data = "data, ";
            $sexo = "sexo, ";
            $telefone = "telefone, ";
            $telefoneFixo = "telefoneFixo, ";
            $endereco = "endereco, ";
            $complemento = "complemento, ";
            $nomeMae = "nomeMae ";
        }
        $cmd = $this->pdo->prepare("SELECT $id $nome $cpf $email $data $sexo $telefone $telefoneFixo $endereco $complemento $nomeMae FROM cad_usuarios WHERE $nomeConsulta $and1 $cpfConsulta $and2 $emailConsulta $and3 $idConsulta $and4 admin = 0 AND ativo = 1 ORDER BY nome");
        /*   $cmd->bindValue(":nc", $nomeConsulta);
          $cmd->bindValue(":cc", $cpfConsulta);
          $cmd->bindValue(":ec", $emailConsulta);
          $cmd->bindValue(":lc", $idConsulta); */
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $res;

        /* $testando = "SELECT $id $nome $cpf $email $data $sexo $telefone $telefoneFixo $endereco $complemento $nomeMae FROM cad_usuarios WHERE $nomeConsulta $and1 $cpfConsulta $and2 $emailConsulta $and3 $idConsulta $and4 admin = 0 AND ativo = 1";
       
        return $testando; */
    }

    //EXCLUSÃO LOGICA
    public function excluirCadastro($id)
    {
        $cmd = $this->pdo->prepare("UPDATE cad_usuarios SET ativo = 0 WHERE id = :id AND admin = 0"); //protegendo admins
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
    // --------------------- outras nao implementadas ----------



    // CONSULTA GENÉRICA
    public function buscarDados()
    {
        $res = array(); // declarada vazia para evitar erros caso a consulta nao rotorne ninguem.
        //$cmd = $this->$pdo->prepare("SELECT * FROM cadastro WHERE nome LIKE :txt ORDER BY nome");
        $cmd = $this->pdo->prepare("SELECT * FROM cad_usuarios ORDER BY nome");
        //$cmd-> bindValue(":txt", "%$txt%", PDO::PARAM_STR);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    //BUSCAR DADOS DE UMA PESSOA
    public function buscarDadosPessoa($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM cad_usuarios WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }



    /*    //ATUALIZAR DADOS
       public function atualizarDados($id, $nome, $telefone, $email){

          
           $cmd = $this->pdo->prepare("UPDATE cad_usuarios SET nome = :n, telefone = :t, email = :e WHERE id = :id");
           $cmd->bindValue(":n", $nome);
           $cmd->bindValue(":t", $telefone);
           $cmd->bindValue(":e", $email);
           $cmd->bindValue(":id", $id);
           $cmd->execute();
           return true;
           
       } */

    /*    public function test($teste){
           $teste['TO_VENDO'] = 'TOMARA';
           return $teste;
       } */


}

