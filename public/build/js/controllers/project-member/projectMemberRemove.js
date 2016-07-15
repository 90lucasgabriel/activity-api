(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectMemberRemoveController', ProjectMemberRemoveController);

	ProjectMemberRemoveController.$inject = ['$scope', '$location', '$routeParams', 'ProjectMember'];

	function ProjectMemberRemoveController($scope, $location, $routeParams, ProjectMember){
		$scope.projectMember = ProjectMember.get({id: $routeParams.id, projectMemberId: $routeParams.projectMemberId});
		$scope.remove = function(){
			$scope.projectMember.$delete({id: $routeParams.id, projectMemberId: $routeParams.projectMemberId}).then(function(){
				$location.path('/project/' + $routeParams.id + '/members');
			});
		}

	};
})();