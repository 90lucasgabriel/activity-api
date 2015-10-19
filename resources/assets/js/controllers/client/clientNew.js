(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ClientNewController', ClientNewController);

	ClientNewController.$inject = ['$scope', '$location', 'Client'];

	function ClientNewController($scope, $location, Client){
		$scope.client = new Client();


		$scope.save = function(){
			if($scope.form.$valid){
				$scope.client.$save().then(function(){
					$location.path('/clients');
				});
			}
		}

	};
})();