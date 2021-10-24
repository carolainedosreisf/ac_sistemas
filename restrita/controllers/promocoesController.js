var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('promocoesController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.cad = {};
    $scope.lista_promocoes = [];

    $scope.openModalCad = function(dados = {}){
        $scope.cad = angular.copy(dados);

        $scope.txt_modal = (typeof $scope.cad.cd_promossao != 'undefined'?" Editar":"Cadastrar")+" Promoção";
        $('#cadPromocao').modal('show');
    }

    $scope.getPromocoes = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Promocao/getPromocoes.php',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_promocoes = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setPromocao = function(){
        if($scope.form_promocao.$valid){
            $scope.carregando = true;

            $http({
                url: 'controllers_php/Promocao/setPromocao.php',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                $('#cadPromocao').modal('hide');
                $scope.cad = {};
                if(retorno.data!=1){
                    swal({
                        title: 'Erro ao salvar!',
                        text: '',
                        type: 'warning'
                    });
                }else{
                    $scope.getPromocoes();
                }
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getPromocoes();
}]);
