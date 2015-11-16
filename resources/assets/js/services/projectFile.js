(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('ProjectFile', ProjectFile);

	ProjectFile.$inject = ['$resource','appConfig'];

	function ProjectFile($resource, appConfig){
		return $resource(appConfig.baseUrl + '/project/:id/files/:noteId', 
			{
				id: '@id',
				fileId: '@fileId'
			},
			{
				update: {
					method: 'PUT'
				}
			}
		);
	};
	
})();
