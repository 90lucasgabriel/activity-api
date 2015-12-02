(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('ProjectFile', ProjectFile);

	ProjectFile.$inject = ['$resource','appConfig'];

	function ProjectFile($resource, appConfig){
		return $resource(appConfig.baseUrl + '/project/:id/files/:fileId', 
		{
			id: '@id',
			fileId: '@fileId'
		},
		{
			update: {
				method: 'PUT'
			},
			download: {
				url: appConfig.baseUrl +
				Url.getUrlResource(appConfig.urls.projectFile) + '/download',
				method: 'GET'
			}
		}
		);
	};
	
})();
