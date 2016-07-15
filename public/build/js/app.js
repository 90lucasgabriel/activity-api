(function () {
	"use strict";

	var app = angular.module('app', [
		'ngRoute', 
		'app.controllers', 'app.services', 'app.filters', 'app.directives', 
		'angular-oauth2', 'ui.bootstrap.typeahead', 'ui.bootstrap.datepicker','ui.bootstrap.tpls', 'ngFileUpload'
	]);

	angular.module('app.controllers', ['ngMessages', 'angular-oauth2']);
	angular.module('app.filters', []);
	angular.module('app.directives', []);
	angular.module('app.services', ['ngResource']);


	app.provider('appConfig', appConfig);
	appConfig.$inject = ['$httpParamSerializerProvider']

	function appConfig($httpParamSerializerProvider){
		var config = {
			baseUrl: 'http://localhost:8000',
			project: {
				status: [
					{value: 1, label: "Não iniciado"},
					{value: 2, label: "Iniciado"},
					{value: 3, label: "Concluído"}
				]
			},
			projectTask: {
				status: [
					{value: 1, label: "Incompleta"},
					{value: 2, label: "Completa"}
				]
			},

			urls:{
				projectFile: '/project/{{id}}/file/{{fileId}}'
			},		
			utils: {
				transformRequest: function(data){
					if(angular.isObject(data)){
						return $httpParamSerializerProvider.$get()(data);
					}
					return data;
				},
				transformResponse: function(data, headers){
					var headersGetter = headers();
					if(headersGetter['content-type'] == 'application/json' || headersGetter['content-type'] == 'text/json'){
						var dataJson = JSON.parse(data); /*angular.fromJson(data)*/
						if(dataJson.hasOwnProperty('data')){
							dataJson = dataJson.data;
						}
						return dataJson;
					}

					return data;
				}
			}
		};

		return {
			config: config,
			$get: function(){
				return config;
			}
		}
	};

	app.config([
		'$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
		function($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider){
			$httpProvider.defaults.headers.post['content-type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
			$httpProvider.defaults.headers.put['content-type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

			$httpProvider.defaults.transformRequest =  appConfigProvider.config.utils.transformRequest;
			$httpProvider.defaults.transformResponse =  appConfigProvider.config.utils.transformResponse;
			

			$routeProvider
			.when('/login', {
				templateUrl: 'build/views/login.html',
				controller:  'LoginController'
			})
			.when('/logout', {
				resolve: {
					logout: ['$location', 'OAuthToken', function($location, OAuthToken){
						OAuthToken.removeToken();
						$location.path('/login');
					}]
				}
			})
			.when('/home', {
				templateUrl: 'build/views/home.html',
				controller:  'HomeController'
			})

			//CLIENT ----------------------------------------------------------------
			.when('/clients/new', {
				templateUrl: 'build/views/client/new.html',
				controller:  'ClientNewController'
			})
			.when('/clients/:id/edit', {
				templateUrl: 'build/views/client/edit.html',
				controller:  'ClientEditController'
			})
			.when('/clients/:id/remove', {
				templateUrl: 'build/views/client/remove.html',
				controller:  'ClientRemoveController'
			})
			.when('/clients/:id', {
				templateUrl: 'build/views/client/view.html',
				controller:  'ClientViewController'
			})
			.when('/clients', {
				templateUrl: 'build/views/client/list.html',
				controller:  'ClientListController'
			})

			//PROJECT FILE -------------------------------------------------------
			.when('/project/:id/file', {
				templateUrl: 'build/views/project-file/list.html',
				controller:  'ProjectFileListController'
			})
			.when('/project/:id/file/new', {
				templateUrl: 'build/views/project-file/new.html',
				controller:  'ProjectFileNewController'
			})
			.when('/project/:id/file/:fileId/edit', {
				templateUrl: 'build/views/project-file/edit.html',
				controller:  'ProjectFileEditController'
			})
			.when('/project/:id/file/:fileId/remove', {
				templateUrl: 'build/views/project-file/remove.html',
				controller:  'ProjectFileRemoveController'
			})


			//PROJECT NOTE ----------------------------------------------------------
			.when('/project/:id/notes/new', {
				templateUrl: 'build/views/project-note/new.html',
				controller:  'ProjectNoteNewController'
			})
			.when('/project/:id/notes/:noteId/edit', {
				templateUrl: 'build/views/project-note/edit.html',
				controller:  'ProjectNoteEditController'
			})
			.when('/project/:id/notes/:noteId/remove', {
				templateUrl: 'build/views/project-note/remove.html',
				controller:  'ProjectNoteRemoveController'
			})
			.when('/project/:id/notes/:noteId', {
				templateUrl: 'build/views/project-note/view.html',
				controller:  'ProjectNoteViewController'
			})
			.when('/project/:id/notes', {
				templateUrl: 'build/views/project-note/list.html',
				controller:  'ProjectNoteListController'
			})

			//PROJECT TASKS ----------------------------------------------------------
			.when('/project/:id/tasks/new', {
				templateUrl: 'build/views/project-task/new.html',
				controller:  'ProjectTaskNewController'
			})
			.when('/project/:id/tasks/:taskId/edit', {
				templateUrl: 'build/views/project-task/edit.html',
				controller:  'ProjectTaskEditController'
			})
			.when('/project/:id/tasks/:taskId/remove', {
				templateUrl: 'build/views/project-task/remove.html',
				controller:  'ProjectTaskRemoveController'
			})
			.when('/project/:id/tasks/:taskId', {
				templateUrl: 'build/views/project-task/view.html',
				controller:  'ProjectTaskViewController'
			})
			.when('/project/:id/tasks', {
				templateUrl: 'build/views/project-task/list.html',
				controller:  'ProjectTaskListController'
			})

			//PROJECT MEMBERS ----------------------------------------------------------
			.when('/project/:id/members/:memberId/remove', {
				templateUrl: 'build/views/project-member/remove.html',
				controller:  'ProjectMemberRemoveController'
			})
			.when('/project/:id/members', {
				templateUrl: 'build/views/project-member/list.html',
				controller:  'ProjectMemberListController'
			})


			//PROJECT --------------------------------------------------------------
			.when('/project/new', {
				templateUrl: 'build/views/project/new.html',
				controller:  'ProjectNewController'
			})
			.when('/project/:id/edit', {
				templateUrl: 'build/views/project/edit.html',
				controller:  'ProjectEditController'
			})
			.when('/project/:id/remove', {
				templateUrl: 'build/views/project/remove.html',
				controller:  'ProjectRemoveController'
			})
			.when('/project/:id', {
				templateUrl: 'build/views/project/view.html',
				controller:  'ProjectViewController'
			})						
			.when('/project', {
				templateUrl: 'build/views/project/list.html',
				controller:  'ProjectListController'
			});
			


			OAuthProvider.configure({
				baseUrl: appConfigProvider.config.baseUrl,
				clientId: 'appId1',
	      		clientSecret: 'secret', // optional
	      		grantPath: 'oauth/access_token'
	      	});

			OAuthTokenProvider.configure({
				name: 'token',
				options: {
					secure: false
				}
			});
		}])


app.run(['$rootScope', '$location', '$window', 'OAuth', function($rootScope, $location, $window, OAuth) {
	$rootScope.$on('$routeChangeStart', function(event, next, current){
		if(next.$$route.originalPath != '/login'){
			if(!OAuth.isAuthenticated()){
				$location.path('/login');
			}
		}
	});

	$rootScope.$on('oauth:error', function(event, rejection) {
			// Ignore `invalid_grant` error - should be catched on `LoginController`.
			if ('invalid_grant' === rejection.data.error) {
				return;
			}

			// Refresh token when a `invalid_token` error occurs.
			if ('invalid_token' === rejection.data.error) {
				return OAuth.getRefreshToken();
			}

			// Redirect to `/login` with the `error_reason`.
			return $window.location.href = '/login?error_reason=' + rejection.data.error;
		})
}]);

})();

