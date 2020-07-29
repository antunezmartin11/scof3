 var app = angular.module("myapp",[]).config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})
 app.controller("usercontroller", function($scope){  
      $scope.companiaList = [  
           "Antamina", "Barrick"  
      ];  
      $scope.complete = function(string){  
           $scope.hidethis = false;  
           var output = [];  
           angular.forEach($scope.companiaList, function(compania){  
                if(compania.toLowerCase().indexOf(string.toLowerCase()) >= 0)  
                {  
                     output.push(compania);  
                }  
           });  
           $scope.filterCompania = output;  
      }  
      $scope.fillTextbox = function(string){  
           $scope.compania = string;  
           $scope.hidethis = true;  
      }  
 });  
 