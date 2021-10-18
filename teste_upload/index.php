<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Upload Image/File with AngularJS and PHP - softAOX</title>  
           <link rel="stylesheet" href="bootstrap.css" />  
           <script src="angular.min.js"></script>  
           <style>
            .files input {
                outline: 2px dashed #92b0b3;
                outline-offset: -10px;
                -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
                transition: outline-offset .15s ease-in-out, background-color .15s linear;
                padding: 120px 0px 85px 35%;
                text-align: center !important;
                margin: 0;
                width: 100% !important;
            }
            .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
                -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
                transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
            }
            .files{ position:relative}
            .files:after {  pointer-events: none;
                position: absolute;
                top: 60px;
                left: 0;
                width: 50px;
                right: 0;
                height: 56px;
                content: "";
                background-image: url(download_icon.png);
                display: block;
                margin: 0 auto;
                background-size: 100%;
                background-repeat: no-repeat;
            }
            .btn {
                margin: 0 auto;
                display: block;
                width: 300px;
            }
            .file_list {
                border: 1px solid #eaeaea;
                height: 410px;
                overflow-y: scroll;
            }
           </style>
      </head>  
      <body align="center">  
           <br />  
           <h2>Upload Image/File with AngularJS and PHP</h2><br />  
           <br />  
           <div class="container" ng-app="saApp" ng-controller="saController" ng-init="select()">  
                <div class="col-md-offset-4 col-md-4">  
                       <div class="form-group files">
                        <label>Upload Your File </label>
                        <input type="file" file-input="files" class="form-control">
                    </div>
                </div>  
                <div class="col-md-12">  
                     <button class="btn btn-success" ng-click="uploadFile()"> Upload</button>  
                </div>  
                <div style="clear:both"></div>  
                <br/>
                <p><b>Note:</b> Once you successfully uploaded the image or file, you get automatically preview to display the image can't file</p>
               <div class="col-md-12 file_list"> 
                       <div class="col-md-3" ng-repeat="myimages in listaimages">  
                        <img ng-src="uploads/{{myimages.name}}" width="150" height="150" style="padding:3px; border:1px solid #dcdcdc; margin:5px;" />  
                    </div>  
                </div>
           </div> 
           <script>  
               var app = angular.module("saApp", []);  
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
               app.controller("saController", function($scope, $http){  
                    $scope.listaimages = [];
                    $scope.uploadFile = function(){  
                         var form_data = new FormData();  
                         angular.forEach($scope.files, function(file){  
                              form_data.append('file', file);  
                         });  
                         $http.post('upload.php', form_data,  
                         {  
                              transformRequest: angular.identity,  
                              headers: {'Content-Type': undefined,'Process-Data': false}  
                         }).success(function(response){  
                              alert(response);  
                              $scope.select();  
                         });  
                    }  
                    $scope.select = function(){  
                         $http.get("fetch.php")  
                         .success(function(data){  
                              $scope.images = data;  
                         });  
                    }  
               });  
          </script>   
      </body>  
 </html>