var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('formasPagamentoController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.cad = {};
    $scope.lista_formas_pagamento = [];

    $scope.openModalCad = function(dados = {}){
        $scope.cad = angular.copy(dados);

        $scope.txt_modal = (typeof $scope.cad.cd_fpagto != 'undefined'?" Editar":"Cadastrar")+" Forma de Pagamento";
        $('#cadFormaPagamento').modal('show');
    }

    $scope.getFormasPagamento = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/FormasPagamento/getFormasPagamento.php',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_tipos_eventos = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setFormaPagamento = function(){
        if($scope.form_forma_pagamento.$valid){
            $scope.carregando = true;

            $http({
                url: 'controllers_php/FormasPagamento/setFormaPagamento.php',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                $('#cadFormaPagamento').modal('hide');
                $scope.cad = {};
                if(retorno.data!=1){
                    swal({
                        title: 'Erro ao salvar!',
                        text: '',
                        type: 'warning'
                    });
                }else{
                    $scope.getFormasPagamento();
                    $scope.form_forma_pagamento.$submitted = false;
                }
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getFormasPagamento();
}]);
