(function () {
	"use strict";

	var app = angular.module('app.directives');
	app.directive('loginForm', loginForm);

	loginForm.$inject = ['appConfig'];

	function loginForm(appConfig){

		return {
			restrict: 		'E',
			templateUrl: 	appConfig.baseUrl + '/build/views/templates/form-login.html',
			scope: false			
		};
	};

})();
