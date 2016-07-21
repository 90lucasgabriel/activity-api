(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectMyDashboardController', ProjectMyDashboardController);

	ProjectMyDashboardController.$inject = ['$scope', '$location', '$routeParams', 'Project'];

	function ProjectMyDashboardController($scope, $location, $routeParams, Project){
		$scope.project = {};
		$scope.tab = [
				true,
				false,
				false,
				false,
			];

		$scope.project = Project.queryIsMember({
			orderBy: 'created_at',
			sortedBy: 'desc',
			limit: 8
		}, function(response){
			$scope.projects = response.data;
		});

		$scope.showProject = function(project){
			$scope.project = project;
		}

		$scope.showTab = function(value){
			for(var i=0; i<$scope.tab.length; i++){
				if(value == i) $scope.tab[i] = true;
				else $scope.tab[i] = false;
			}
		}
	};
})();