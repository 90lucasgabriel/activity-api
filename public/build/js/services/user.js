(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('User', User);

	User.$inject = ['$resource','appConfig'];

	function User($resource, appConfig){
		return $resource(appConfig.baseUrl + '/user', {},
		{
			authenticated: {
				url: appConfig.baseUrl + '/user/authenticated',
				method: 'GET'
			}
		});
	};
	
})();
