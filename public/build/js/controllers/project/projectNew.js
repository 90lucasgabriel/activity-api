(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectNewController', ProjectNewController);

	ProjectNewController.$inject = ['$scope', '$location', '$cookies', 'Project', 'Client', 'appConfig'];

	function ProjectNewController($scope, $location, $cookies, Project, Client, appConfig){
		$scope.project = new Project();
		$scope.clients = Client.query();
		$scope.status  = appConfig.project.status;

		$scope.save = function(){
			if($scope.form.$valid){
				$scope.project.owner_id = $cookies.getObject('user').id;
				//console.log("before save: ");
				//console.log($scope.project);
				$scope.project.$save()
				.then(function(){	
					//console.log("success save: ");
					//console.log($scope.project);
					$location.path('/project');
				});
			}
		}

	};
})();