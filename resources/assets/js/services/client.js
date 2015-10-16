(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('Client', Client);

	Client.$inject = ['$resource','appConfig'];

	function Client($resource, appConfig){
		return $resource(appConfig.baseUrl + '/client/:id', {id: '@id'});
	};
})();
