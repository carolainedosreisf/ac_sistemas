var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('albunsEventoController', ['$scope', '$http','$filter','$window', function($scope,$http,$filter,$window) {
    $scope.lista_albuns = [];
    $scope.lista = [];
    $scope.objEvento = {};
    $scope.cad = {};

    $scope.getAbunsEvento = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getAbunsEvento.php',
            method: 'GET',
            params:{id}
        }).then(function (retorno) {
            $scope.lista_albuns = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEvento = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getEvento.php',
            method: 'GET',
            params:{id}
        }).then(function (retorno) {
            $scope.objEvento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setAlbum = function(){
        if($scope.form_album.$valid && $scope.files){
            $scope.mensagem = "";
            var form_data = new FormData();  
            angular.forEach($scope.files, function(file){  
                form_data.append('file', file);  
            });

            $http.post('controllers_php/Evento/uploadAlbum.php', form_data,  
            {  
                transformRequest: angular.identity,  
                headers: {'Content-Type': undefined,'Process-Data': false}  
            }).success(function(response){ 
                $scope.carregando = false;
                if(response.erro_tipo){
                    $scope.mensagem = "Extensão de imagem inválida!";
                }else{
                    $scope.cad.ft_caminho = response;
                    $scope.cad.cd_evento = id;
                    $http({
                        url: 'controllers_php/Evento/setAlbum.php',
                        method: 'POST',
                        data: $scope.cad
                    }).then(function (retorno) {
                        if(retorno.data == 1){
                            $window.location.reload();
                        }else{
                            $scope.carregando = false;
                            swal({
                                title: 'Erro ao salvar!',
                                text: '',
                                type: 'warning'
                            });
                        }
                    },
                    function (retorno) {
                        console.log('Error: '+retorno.status);
                    });
                }
                
            });  
            $scope.carregando = true;
        }else{
            if(!($scope.files)){
                $scope.mensagem = "Selecione uma imagem!";
            }
        }
    }

    $scope.deleteAlbum = function(dados){
        swal({
            title: "",
            text: "Deseja realmente apagar a imagem?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          },
          function(){
            $http({
                url: 'controllers_php/Evento/deleteAlbum.php',
                method: 'POST',
                data: dados
            }).then(function (retorno) {
                if(retorno.data == 1){
                    $scope.getAbunsEvento();
                }else{
                    $scope.carregando = false;
                    $scope.mensagem = "Erro ao apagar.";
                }
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        });
    }

    $scope.getAbunsEvento();
    $scope.getEvento();
    
}]);

app.directive("fileInput", function($parse){  
    return{  
         link: function($scope, element, attrs){  
              element.on("change", function(event){  
                   var files = event.target.files;  
                   $parse(attrs.fileInput).assign($scope, element[0].files);  
                   $scope.$apply();  
              });  
         }  
    }  
});  
