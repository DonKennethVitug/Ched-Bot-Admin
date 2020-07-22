(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
 
                event.preventDefault();
            }
        });
    };
  });

  app.directive('autosize', function($document) {
    return {
      require: 'ngModel',
      link: function(scope, element, attrs, ctrl) {
        var placeholder, span, resize;
      
        placeholder = element.attr('placeholder') || '';  
        
        span = angular.element('<span></span>');
        span[0].style.cssText = getComputedStyle(element[0]).cssText;
        span.css('display', 'none')
            .css('visibility', 'hidden')
            .css('width', 'auto');
        
        $document.find('body').append(span);
      
        resize = function(value) {
          if (value.length < placeholder.length) {
            value = placeholder;
          }
          span.text(value);
          span.css('display', '');
          try {
            element.css('width', span.prop('offsetWidth') + 'px');
          }
          finally {
            span.css('display', 'none');
          }
        };
        
        ctrl.$parsers.unshift(function(value) {
          resize(value);
          return value;
        });
        
        ctrl.$formatters.unshift(function(value) {
          resize(value);
          return value;
        })
      }
    };
  });
}(angular))