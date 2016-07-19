(function () {
    "use strict";

    var app = angular.module('app.services');
    app.service('oauthFixInterceptor', oauthFixInterceptor);

    oauthFixInterceptor.$inject = [
        '$q', '$rootScope', 
        'OAuthToken'
    ];

    function oauthFixInterceptor(
        $q, $rootScope, 
        OAuthToken
    ) {
    
        return {
            request: function request(config) {
                config.headers = config.headers || {};
                if (!config.headers.hasOwnProperty("Authorization") && OAuthToken.getAuthorizationHeader()) {
                    config.headers.Authorization = OAuthToken.getAuthorizationHeader();
                }
                return config;
            },
            responseError: function responseError(rejection) {
                var deferred = $q.defer();
                if (400 === rejection.status && rejection.data && ("invalid_request" === rejection.data.error || "invalid_grant" === rejection.data.error)) {
                    OAuthToken.removeToken();
                    $rootScope.$emit("oauth:error", { rejection: rejection, deferred: deferred});
                }
                if (401 === rejection.status 
                && rejection.data && "access_denied" === rejection.data.error || rejection.headers("www-authenticate") 
                && 0 === rejection.headers("www-authenticate").indexOf("Bearer")) {
                    $rootScope.$emit("oauth:error", { rejection: rejection, deferred: deferred});
                    return deferred.promise;
                }
                return $q.reject(rejection);
            }
            
        };
    };
    
})();
