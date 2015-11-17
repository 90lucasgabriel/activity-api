(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectRemoveController', ProjectRemoveController);

	ProjectRemoveController.$inject = ['$scope', '$location', '$routeParams', 'Project'];

	function ProjectRemoveController($scope, $location, $routeParams, Project){
		$scope.project = Project.get({id: $routeParams.id});
		
		$scope.remove = function(){
			$scope.project.$delete({id: $routeParams.id}).then(function(){
				$location.path('/project');
			});
		}

	};
})();