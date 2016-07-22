
(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('LoginModalController', LoginModalController);

	LoginModalController.$inject = [
		'$scope', '$rootScope', '$location', '$cookies', '$modalInstance',
		'User', 'OAuth', 'authService', 'OAuthToken'
	];

	function LoginModalController(
		$scope, $rootScope, $location, $cookies, $modalInstance,
		User, OAuth, authService, OAuthToken
	){
		$scope.user = {
			username: '',
			password: ''
		};

		$scope.error = {
			message: '',
			error: false
		};

		$scope.$on('event:auth-loginConfirmed', function(){
			$rootScope.loginModalOpened = false;
			$modalInstance.close();
		});

		$scope.$on('$routeChangeStart', function(){
			$rootScope.loginModalOpened = false;
			$modalInstance.dismiss('cancel');
		});

		$scope.$on('event:auth-loginConfirmed', function(){
			OAuthToken.removeToken();
		});


		$scope.login = function(){
			OAuth.getAccessToken($scope.user).then(function(){
				User.authenticated(null, null, function(data){
					$cookies.putObject('user', data);
					authService.loginConfirmed();
					$location.path('home');
				});
			}, function(data){
				$scope.error.error = true;
				$scope.error.message = data.data.error_description;
			});
		}



		$scope.cancel = function(){
			authService.loginCancelled();
			$location.path('login');
		}
	};
})();
