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

		$scope.login = function(){
			OAuth.getAccessToken($scope.user).then(function(){
				$location.path('home');
			}, function(){
				alert('Login Invalid');
			});
		}
	};
}());