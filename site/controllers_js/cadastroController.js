var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask']);
app.controller('cadastroController', ['$scope', '$http','$filter','$timeout','$location','$anchorScroll', function($scope,$http,$filter,$timeout,$location,$anchorScroll) {
    $scope.login = {};
    $scope.lista_cidades = [];
    $scope.lista_msg = [];
    
    $scope.cad = {
        // nm_cadastro:"João da Silva",
        // nr_cpf:"43129870091",
        // nr_rg:"55555c54",
        // dt_nascto:"05/11/1990",
        // sexo:"F",
        // nr_telefone: null,
        // nr_contato: null,
        // nr_cep:"88810563",
        // cd_cidade:"70",
        // nr_endereco:"111",
        // ed_cadastro:"teste endereco",
        // ba_cadastro:"bairro teste",
        // co_complemento:null,
        // ed_email:"teste@gmail22.com",
        // nm_usuario:"testão.silva22",
        // senha:"123456ã",
        // confirm_senha:"123456ã"
    };

    $scope.setCadastro = function(){ 
        $scope.mensagem = "";
        if($scope.form_cadastro.$valid && $scope.cad.senha == $scope.cad.confirm_senha){
            $scope.carregando = true;
            $scope.cadastro = 1;
            $http({
                url: 'controllers_php/Cadastro/setCadastro.php',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                if(retorno.data.sucesso == 1){
                    $scope.login = retorno.data.login;
                    $scope.setSessao();
                }else{
                    $scope.mensagem = "Erro ao cadastrar.";
                    $location.hash("mensagens");
                    $anchorScroll();
                }
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }else{
            $location.hash("mensagens");
            $anchorScroll();
        }
    }

    $scope.setSessao = function(){ 
        $scope.mensagem = "";
        $scope.carregando = true;
        $scope.login.cadastro = cadastro;
        $http({
            url: 'controllers_php/Cadastro/setSessao.php',
            method: 'POST',
            data: $scope.login
        }).then(function (retorno) {
            if(retorno.data==1){
                window.location = "index.php";
            }else{
                $scope.mensagem = "Usuário ou senha inválida.";
                $scope.carregando = false;
            }
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getCidades = function(){ 
        $http({
            url: 'controllers_php/Cidade/getCidades.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_cidades = retorno.data;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getVerificaColunas = function(dados,coluna,tabela){ 
        if($scope.form_cadastro.$valid && $scope.cad.senha == $scope.cad.confirm_senha){
            $scope.lista_msg = [];
            $http({
                url: 'controllers_php/Cadastro/getVerificaColunas.php',
                method: 'GET',
                params:{dados:$scope.cad}
            }).then(function (retorno) {
                if(retorno.data.length <=0){
                    $scope.setCadastro();
                }else{
                    $scope.lista_msg = retorno.data;
                    $anchorScroll();
                }
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    if(cadastro==1){
        $scope.getCidades();
    }
}]);
