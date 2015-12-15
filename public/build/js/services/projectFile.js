(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('ProjectFile', ProjectFile);

	ProjectFile.$inject = [
		'$resource',
		'appConfig', 'Url'];

	function ProjectFile(
		$resource, 
		appConfig, Url){

		return $resource(appConfig.baseUrl + '/project/:id/file/:fileId', 
		{
			id: '@id',
			fileId: '@fileId'
		},
		{
			update: {
				method: 'PUT',
				headers: {
			        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
			    }
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
