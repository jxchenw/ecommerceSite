'use strict';

var app = angular.module("main", ['ngRoute', 'ngCookies', 'ui.calendar', 'ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('FilterCtrl', ['$scope', 'http', 'cookies', function($scope, Shttp, $cookies) {
	var serviceBase = '../api/';
	$http.get(serviceBase + 'categories').then(function (results) {
		$scope.categories = results.data;
	});
}]);
