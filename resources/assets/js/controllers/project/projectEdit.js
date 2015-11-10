(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectEditController', ProjectEditController);

	ProjectEditController.$inject = [
		'$scope', '$routeParams', '$location', '$cookies', 
		'Project', 'Client', 'appConfig'];

	function ProjectEditController(
		$scope, $routeParams, $location, $cookies, 
		Project, Client, appConfig){

		$scope.project = Project.get({id: $routeParams.id});
		$scope.clients = Client.query();
		$scope.status  = appConfig.project.status;

		$scope.save = function(){
			if($scope.form.$valid){
				$scope.project.owner_id = $cookies.getObject('user').id;

				Project.update(
					{id: $scope.project.id}, 
					$scope.project, 
					function(){
						$location.path('/project');	
					}
				);
			}
		}

	};
})();