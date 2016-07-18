(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectMemberRemoveController', ProjectMemberRemoveController);

	ProjectMemberRemoveController.$inject = ['$scope', '$location', '$routeParams', 'ProjectMember'];

	function ProjectMemberRemoveController($scope, $location, $routeParams, ProjectMember){
		$scope.projectMember = ProjectMember.getUser({projectMemberId: $routeParams.memberId});

		$scope.remove = function(){
			$scope.projectMember.$delete({id: $routeParams.id, projectMemberId: $routeParams.memberId}).then(function(){
				$location.path('/project/' + $routeParams.id + '/members');
			});
		}

	};
})();