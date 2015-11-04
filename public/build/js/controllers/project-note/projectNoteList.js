(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectNoteListController', ProjectNoteListController);

	ProjectNoteListController.$inject = ['$scope', '$routeParams', 'ProjectNote'];

	function ProjectNoteListController($scope, $routeParams, ProjectNote){
		$scope.project = {id: $routeParams.id};
		$scope.projectNotes = ProjectNote.query({id: $routeParams.id});
	};
	
})();