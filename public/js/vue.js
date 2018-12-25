/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ 17:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(18);
module.exports = __webpack_require__(92);


/***/ }),

/***/ 18:
/***/ (function(module, __webpack_exports__) {

"use strict";
throw new Error("Module build failed: SyntaxError: C:/Users/98max1/laravel_projects/DAD_PROJETO/resources/js/vue.js: Unexpected token (40:0)\n\n\u001b[0m \u001b[90m 38 | \u001b[39m\u001b[36mconst\u001b[39m user \u001b[33m=\u001b[39m \u001b[33mVue\u001b[39m\u001b[33m.\u001b[39mcomponent(\u001b[32m'user'\u001b[39m\u001b[33m,\u001b[39mrequire(\u001b[32m'./components/user.vue'\u001b[39m))\u001b[33m;\u001b[39m\n \u001b[90m 39 | \u001b[39m\u001b[36mconst\u001b[39m profile \u001b[33m=\u001b[39m \u001b[33mVue\u001b[39m\u001b[33m.\u001b[39mcomponent(\u001b[32m'profile'\u001b[39m\u001b[33m,\u001b[39m require(\u001b[32m'./components/profile.vue'\u001b[39m))\u001b[33m;\u001b[39m\n\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 40 | \u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<\u001b[39m \u001b[33mHEAD\u001b[39m\n \u001b[90m    | \u001b[39m\u001b[31m\u001b[1m^\u001b[22m\u001b[39m\n \u001b[90m 41 | \u001b[39m\u001b[36mconst\u001b[39m profileEdit \u001b[33m=\u001b[39m \u001b[33mVue\u001b[39m\u001b[33m.\u001b[39mcomponent(\u001b[32m'profileEdit'\u001b[39m\u001b[33m,\u001b[39m require(\u001b[32m'./components/profileEdit.vue'\u001b[39m))\u001b[33m;\u001b[39m\n \u001b[90m 42 | \u001b[39m\u001b[36mconst\u001b[39m login \u001b[33m=\u001b[39m \u001b[33mVue\u001b[39m\u001b[33m.\u001b[39mcomponent(\u001b[32m'login'\u001b[39m\u001b[33m,\u001b[39mrequire(\u001b[32m'./components/login.vue'\u001b[39m))\u001b[33m;\u001b[39m\n \u001b[90m 43 | \u001b[39m\u001b[36mconst\u001b[39m logout \u001b[33m=\u001b[39m \u001b[33mVue\u001b[39m\u001b[33m.\u001b[39mcomponent(\u001b[32m'logout'\u001b[39m\u001b[33m,\u001b[39mrequire(\u001b[32m'./components/logout.vue'\u001b[39m))\u001b[33m;\u001b[39m\u001b[0m\n");

/***/ }),

/***/ 92:
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })

/******/ });