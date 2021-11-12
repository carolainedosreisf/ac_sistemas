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
        if($scope.form_cadastro.$valid && $scope.cad.senha == $scope.cad.confirm_senha && $scope.erro_idade==0 && !($scope.erro_cep)){
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
                window.location = "../restrita/index.php";
            }else if(retorno.data==2){
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

    $scope.getCidadeCep = function(cidade,uf){ 
        $http({
            url: 'controllers_php/Cidade/getCidadeCep.php',
            method: 'GET',
            params:{cidade,uf}
        }).then(function (retorno) {
            $scope.cad.cd_cidade = retorno.data;
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

    $scope.calculaIdade = function(){ 
        var dataNasc = $scope.cad.dt_nascto;
        var dataAtual = new Date();
        var anoAtual = dataAtual.getFullYear();
        var anoNascParts = dataNasc.split('/');
        var diaNasc = anoNascParts[0];
        var mesNasc = anoNascParts[1];
        var anoNasc = anoNascParts[2];
        var idade = anoAtual - anoNasc;
        var mesAtual = dataAtual.getMonth() + 1; 
        //Se mes atual for menor que o nascimento, nao fez aniversario ainda;  
        if(mesAtual < mesNasc){
            idade--; 
        } else {
            //Se estiver no mes do nascimento, verificar o dia
            if(mesAtual == mesNasc){ 
                if(new Date().getDate() < diaNasc ){ 
                //Se a data atual for menor que o dia de nascimento ele ainda nao fez aniversario
                    idade--; 
                }
            }
        } 
        $scope.erro_idade = idade <18?1:0;
    }

    $scope.buscaCep = function(){
        if ($scope.cad.nr_cep != undefined) {
            if ($scope.cad.nr_cep.length==8) {
                $scope.carregando = true;
                $http({
                    url: `https://viacep.com.br/ws/${$scope.cad.nr_cep}/json/`,
                    method: 'GET'
                }).then(function (retorno) {
                    console.log(retorno.data);
                    if(!(retorno.data.erro)){
                        $scope.erro_cep = false;
                        $scope.cad.ed_cadastro = retorno.data.logradouro;
                        $scope.cad.ba_cadastro = retorno.data.bairro;

                        if(retorno.data.localidade){
                            $scope.getCidadeCep(retorno.data.localidade,retorno.data.uf);
                            
                            $scope.cad.bairro = "";
                        }else{
                            zerarEndereco();
                        }
                    }else{
                        zerarEndereco();
                        $scope.erro_cep = true;
                    }
                    $scope.carregando = false;
                },
                function (retorno) {
                    //alert('Erro ao carregar CEP.');
                    $scope.carregando = false;
                });
            }else{
                zerarEndereco();
            }
        }
    }

    var zerarEndereco = function(){
        $scope.cad.cd_cidade = null;
        $scope.cad.ed_cadastro = "";
        $scope.cad.ba_cadastro = "";
    }

    if(cadastro==1){
        $scope.getCidades();
    }
}]);
