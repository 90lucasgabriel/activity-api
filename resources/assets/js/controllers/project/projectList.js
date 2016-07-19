(
function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectListController', ProjectListController);

	ProjectListController.$inject = ['$scope', '$routeParams', 'Project'];

	function ProjectListController($scope, $routeParams, Project){
		$scope.projects = [];
		$scope.totalProjects = 0;
		$scope.projectsPerPage = 3; 

		$scope.pagination = {
		    current: 1
		};

		$scope.pageChanged = function(newPage) {
		    getResultsPage(newPage);
		};

		
		function getResultsPage(pageNumber) {
			//$scope.projects = Project.query({);
			Project.query({
				page: pageNumber,
				limit: $scope.projectsPerPage
			}, function(data){
				$scope.projects = data.data;
				$scope.totalProjects = data.meta.pagination.total;
			});
		}

		getResultsPage(1);
	};
	
})();
