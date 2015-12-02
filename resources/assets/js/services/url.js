(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('Url', Url);

	Url.$inject = ['$interpolate'];

	function Url($interpolate){
		return {
			getUrlFromAngularSymbol: function(url, params){
				var urlMod = $interpolate(url)(params);
				return urlMod.replace(/\/\//g, '/')
				.replace(/\/$/,'');
			},
			getUrlResource: function(url){
				return url.replace(new RegExp('{{','g'), ':')
				.replace(new RegExp('}}','g'), '');
			}
		}
	};
	
})();