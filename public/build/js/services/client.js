(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('Client', Client);

	Client.$inject = ['$resource','appConfig'];

	function Client($resource, appConfig){
		return $resource(appConfig.baseUrl + '/client/:id', {id: '@id'},
		{
			query: {
				isArray: false
			},
			save: {
				method: 'POST',
				headers: {
			        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
			    }
			},
			update: {
				method: 'PUT',
				headers: {
			        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
			    }
			}
		});
	};
	
})();
