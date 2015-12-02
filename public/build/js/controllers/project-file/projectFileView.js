(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectFileViewController', ProjectFileViewController);

	ProjectFileViewController.$inject = ['$scope', '$location', '$routeParams', 'ProjectNote'];

	function ProjectFileViewController($scope, $location, $routeParams, ProjectNote){
		$scope.projectNote = ProjectNote.get({id: $routeParams.id, noteId: $routeParams.noteId});
	};
})();