var app = angular.module('appCadastro', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask']);
app.controller('cadastroController', ['$scope', '$http','$filter','$timeout', function($scope,$http,$filter,$timeout) {
    $scope.cad = {
        nm_cadastro:"João da Silva",
        nr_cpf:"88347398097",
        nr_rg:"fdssfdsdf4",
        dt_nascto:"05/11/1990",
        nr_telefone:"8888855555",
        nr_contato:"8888855555",
        nr_cep:"88810563",
        cd_cidade:"1",
        nr_endereco:"111",
        ed_cadastro:"teste endereco",
        ba_cadastro:"bairro teste",
        co_complemento:"teste complemento",
        ed_email:"teste@gmail.com",
        senha:"123456",
        confirm_senha:"123456"
    };

    $scope.setCadastro = function(){

    }
}]);
