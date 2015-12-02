(function () {
	"use strict";

	var app = angular.module('app.directives');
	app.directive('projectFileDownload', projectFileDownload);

	projectFileDownload.$inject = ['appConfig'];
	function projectFileDownload(appConfig){
		return {
			restrict: 'E',
			templateUrl: appConfig.baseUrl + '/build/views/templates/projectFileDownload.html',
			link: function(scope, element, attr){

			},
			controller: app.controller('projectFileDownloadControllerDirective',projectFileDownloadControllerDirective)
		};
	};


	projectFileDownloadControllerDirective.$inject = ['$scope', '$element', '$attrs'];
	function projectFileDownloadControllerDirective($scope, $element, $attrs){
		$scope.downloadFile = function(){
			var anchor = $element.children()[0];
			$(anchor).addClass('disabled');
			$(anchor).text('Loading');
			//console.log($attrs.fileId);
			ProjectFile.download({
				id: $routeParams.project_id,
				fileId: $attrs.idFile
			}, function(data){

			});
		}
	}

})();