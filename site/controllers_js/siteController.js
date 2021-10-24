var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('siteController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.lista_lancamentos = [1,2,3,4,5,6];
    $scope.usuario = JSON.parse(usuario);
    $scope.lista_carrinho = JSON.parse(carrinho);
    $scope.qtd_carrinho = qtd;
    // if(localStorage.lista_carrinho && $scope.usuario != 0){
    //     $scope.lista_carrinho = JSON.parse(localStorage.getItem("lista_carrinho"));
    // }else{
    //     $scope.lista_carrinho = [];
    //     localStorage.removeItem("lista_carrinho");
    // }
    
    $scope.getEventos = function(){ 
        $http({
            url: 'controllers_php/Evento/getEventos.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_lancamentos = retorno.data;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setCarrinho = function(dados,tipo=4){
        if($scope.usuario==0){
            swal({
                title: "",
                text: "Você deve logar para adicionar ao carrinho!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-warning",
                confirmButtonText: "Logar",
                cancelButtonText: "Cancelar"
              },
              function(){
                window.location = "login.php"
              });
        }else{
            dados.tipo = tipo;
            $http({
                url: 'controllers_php/Carrinho/setCarrinho.php',
                method: 'POST',
                data: dados
            }).then(function (retorno) {
                $scope.lista_carrinho = retorno.data.carrinho;
                $scope.qtd_carrinho = retorno.data.qtd;
                if(tipo==4){
                    swal({
                        title: 'Adicionado com sucesso!',
                        text: '',
                        type: 'success',
                        timer: 1,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                }
                
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.openDetalhesEvento = function(dados){
        $scope.objEvento = angular.copy(dados);
        $('#modalDetalhesEvento').modal('show');
    }

    var array_column_search = function(lista,coluna,id,tipo=1){
        if(tipo==1){
            var index = lista.map(e => e[coluna]).indexOf(id);
            return index>=0?1:0;
        }else{
            return lista.map(e => e[coluna]).filter(x => x === id).length
        }
    }

    $scope.getEventos();
}]);
