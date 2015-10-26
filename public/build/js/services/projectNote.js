(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('ProjectNote', ProjectNote);

	ProjectNote.$inject = ['$resource','appConfig'];

	function ProjectNote($resource, appConfig){
		return $resource(appConfig.baseUrl + '/project/:id/notes/:noteId', 
			{
				id: '@id',
				noteId: '@noteId'
			},
			{
				update: {
					method: 'PUT'
				}
			}
		);
	};
	
})();
