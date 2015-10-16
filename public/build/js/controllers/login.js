(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('LoginController', LoginController);

	LoginController.$inject = ['$scope', '$location', 
		'OAuth'];

	function LoginController($scope, $location,
		OAuth){
		$scope.user = {
			username: '',
			password: ''
		};

		$scope.error = {
			message: '',
			error: false
		};


		$scope.login = function(){
			OAuth.getAccessToken($scope.user).then(function(){
				$location.path('home');
			}, function(data){
				$scope.error.error = true;
				$scope.error.message = data.data.error_description;
			});
		}
	};
})();