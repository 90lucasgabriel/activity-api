(function () {
	"use strict";

	var app = angular.module('app.directives');
	app.directive('projectFileDownload', projectFileDownload);

	projectFileDownload.$inject = [
		'$timeout', '$window',
		'appConfig', 'ProjectFile'];

	function projectFileDownload(
		$timeout, $window,
		appConfig, ProjectFile){

		return {
			restrict: 		'E',
			templateUrl: 	appConfig.baseUrl + '/build/views/templates/projectFileDownload.html',
			link: 			
				function (scope, element, attr){
					var anchor = element.children()[0];
					scope.$on('salvar-arquivo', function(event, data){
						$(anchor).removeClass('disabled');
						$(anchor).text('Download');
						blobUtil.base64StringToBlob(data.file).then(function (blob) {
							$(anchor).attr({
								href: $window.URL.createObjectURL(blob, data.mime_type),
								download: data.name
							});
						});

						$timeout(function() 
						{
							scope.downloadFile = function(){

							}
							$(anchor)[0].click();
						});
					});
				},
			controller: 	projectFileDownloadControllerDirective
		};
	};

	projectFileDownloadControllerDirective.$inject = [
		'$scope', '$element', '$attrs', '$routeParams',
		'ProjectFile'];
	
	function projectFileDownloadControllerDirective(
		$scope, $element, $attrs, $routeParams,
		ProjectFile){

		$scope.downloadFile = function(){
			var anchor = $element.children()[0];
			$(anchor).addClass('disabled');
			$(anchor).text('Loading');
			ProjectFile.download({
				id: $routeParams.id,
				fileId: $attrs.fileId
			}, function(data){
				$scope.$emit('salvar-arquivo', data);
			});
		}
	}

})();