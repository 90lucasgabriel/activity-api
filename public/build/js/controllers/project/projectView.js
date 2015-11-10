(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectViewController', ProjectNoteViewController);

	ProjectNoteViewController.$inject = ['$scope', '$location', '$routeParams', 'ProjectNote'];

	function ProjectNoteViewController($scope, $location, $routeParams, ProjectNote){
		$scope.projectNote = ProjectNote.get({id: $routeParams.id, noteId: $routeParams.noteId});
	};
})();