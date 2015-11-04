(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('LoginController', LoginController);

	LoginController.$inject = [
		'$scope', '$location', '$cookies',
		'User', 'OAuth'
	];

	function LoginController(
		$scope, $location, $cookies,
		User, OAuth
	){
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
				User.authenticated(null, null, function(data){
					$cookies.putObject('user', data);
					$location.path('home');
				});
			}, function(data){
				$scope.error.error = true;
				$scope.error.message = data.data.error_description;
			});
		}
	};
})();