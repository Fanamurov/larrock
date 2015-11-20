;(function ($, window, document, undefined) {

    var pluginName = "metisMenu",
        defaults = {
            toggle: true
        };

    function Plugin(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {
        init: function () {

            var $this = $(this.element),
                $toggle = this.settings.toggle;

            $this.find('li.active').has('ul').children('ul').addClass('collapse in');
            $this.find('li').not('.active').has('ul').children('ul').addClass('collapse');

            $this.find('li').has('ul').children('a').on('click', function (e) {
                e.preventDefault();

                $(this).parent('li').toggleClass('active').children('ul').collapse('toggle');

                if ($toggle) {
                    $(this).parent('li').siblings().removeClass('active').children('ul.in').collapse('hide');
                }
            });
        }
    };

    $.fn[ pluginName ] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);

/*
  Bootstrap - File Input
  ======================

  This is meant to convert all file input tags into a set of elements that displays consistently in all browsers.

  Converts all
  <input type="file">
  into Bootstrap buttons
  <a class="btn">Browse</a>

*/
(function($) {

$.fn.bootstrapFileInput = function() {

  this.each(function(i,elem){

    var $elem = $(elem);

    // Maybe some fields don't need to be standardized.
    if (typeof $elem.attr('data-bfi-disabled') != 'undefined') {
      return;
    }

    // Set the word to be displayed on the button
    var buttonWord = 'Browse';

    if (typeof $elem.attr('title') != 'undefined') {
      buttonWord = $elem.attr('title');
    }

    var className = '';

    if (!!$elem.attr('class')) {
      className = ' ' + $elem.attr('class');
    }

    // Now we're going to wrap that input field with a Bootstrap button.
    // The input will actually still be there, it will just be float above and transparent (done with the CSS).
    $elem.wrap('<a class="file-input-wrapper btn btn-default ' + className + '"></a>').parent().prepend($('<span></span>').html(buttonWord));
  })

  // After we have found all of the file inputs let's apply a listener for tracking the mouse movement.
  // This is important because the in order to give the illusion that this is a button in FF we actually need to move the button from the file input under the cursor. Ugh.
  .promise().done( function(){

    // As the cursor moves over our new Bootstrap button we need to adjust the position of the invisible file input Browse button to be under the cursor.
    // This gives us the pointer cursor that FF denies us
    $('.file-input-wrapper').mousemove(function(cursor) {

      var input, wrapper,
        wrapperX, wrapperY,
        inputWidth, inputHeight,
        cursorX, cursorY;

      // This wrapper element (the button surround this file input)
      wrapper = $(this);
      // The invisible file input element
      input = wrapper.find("input");
      // The left-most position of the wrapper
      wrapperX = wrapper.offset().left;
      // The top-most position of the wrapper
      wrapperY = wrapper.offset().top;
      // The with of the browsers input field
      inputWidth= input.width();
      // The height of the browsers input field
      inputHeight= input.height();
      //The position of the cursor in the wrapper
      cursorX = cursor.pageX;
      cursorY = cursor.pageY;

      //The positions we are to move the invisible file input
      // The 20 at the end is an arbitrary number of pixels that we can shift the input such that cursor is not pointing at the end of the Browse button but somewhere nearer the middle
      moveInputX = cursorX - wrapperX - inputWidth + 20;
      // Slides the invisible input Browse button to be positioned middle under the cursor
      moveInputY = cursorY- wrapperY - (inputHeight/2);

      // Apply the positioning styles to actually move the invisible file input
      input.css({
        left:moveInputX,
        top:moveInputY
      });
    });

    $('body').on('change', '.file-input-wrapper input[type=file]', function(){

      var fileName;
      fileName = $(this).val();

      // Remove any previous file names
      $(this).parent().next('.file-input-name').remove();
      if (!!$(this).prop('files') && $(this).prop('files').length > 1) {
        fileName = $(this)[0].files.length+' files';
      }
      else {
        fileName = fileName.substring(fileName.lastIndexOf('\\') + 1, fileName.length);
      }

      // Don't try to show the name if there is none
      if (!fileName) {
        return;
      }

      var selectedFileNamePlacement = $(this).data('filename-placement');
      if (selectedFileNamePlacement === 'inside') {
        // Print the fileName inside
        $(this).siblings('span').html(fileName);
        $(this).attr('title', fileName);
      } else {
        // Print the fileName aside (right after the the button)
        $(this).parent().after('<span class="file-input-name">'+fileName+'</span>');
      }
    });

  });

};

// Add the styles before the first stylesheet
// This ensures they can be easily overridden with developer styles
var cssHtml = '<style>'+
  '.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }'+
  '.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }'+
  '.file-input-name { margin-left: 8px; }'+
  '</style>';
$('link[rel=stylesheet]').eq(0).before(cssHtml);

})(jQuery);

// Custom scripts
$(document).ready(function () {

    // MetsiMenu
    $('#side-menu').metisMenu();

    // Collapse ibox function
    $('.collapse-link').click( function() {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });

    // Close ibox function
    $('.close-link').click( function() {
        var content = $(this).closest('div.ibox');
        content.remove();
    });

    // Small todo handler
    $('.check-link').click( function(){
        var button = $(this).find('i');
        var label = $(this).next('span');
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        label.toggleClass('todo-completed');
        return false;
    });

    // minimalize menu
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    var width_window = $(window).width();
    if(width_window < 768){
        $("body").addClass("mini-navbar");
        SmoothlyMenu();
    }

    // tooltips
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });

    // Full height of sidebar
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");
    }
    fix_height();

    // Fixed Sidebar
    // unComment this only whe you have a fixed-sidebar
            //    $(window).bind("load", function() {
            //        if($("body").hasClass('fixed-sidebar')) {
            //            $('.sidebar-collapse').slimScroll({
            //                height: 'auto',
            //                railOpacity: 0.9,
            //            });
            //        }
            //    })

    $(window).bind("load resize click scroll", function() {
        if(!$("body").hasClass('body-small')) {
            fix_height();
        }
    });

    $("[data-toggle=popover]").popover();
});


// For demo purpose - animation css script
function animationHover(element, animation){
    element = $(element);
    element.hover(
        function() {
            element.addClass('animated ' + animation);
        },
        function(){
            //wait for animation to finish before removing classes
            window.setTimeout( function(){
                element.removeClass('animated ' + animation);
            }, 2000);
        });
}

// Minimalize menu when screen is less than 768px
$(function() {
    $(window).bind("load resize", function() {
        if ($(this).width() < 769) {
            $('body').addClass('body-small')
        } else {
            $('body').removeClass('body-small')
        }
    })
})

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')){
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}

// Dragable panels
function WinMove() {
    $("div.ibox").not('.no-drop')
        .draggable({
            revert: true,
            zIndex: 2000,
            cursor: "move",
            handle: '.ibox-title',
            opacity: 0.8,
            drag: function(){
                var finalOffset = $(this).offset();
                var finalxPos = finalOffset.left;
                var finalyPos = finalOffset.top;
                // Add div with above id to see position of panel
                $('#posX').text('Final X: ' + finalxPos);
                $('#posY').text('Final Y: ' + finalyPos);
            },
        })
        .droppable({
            tolerance: 'pointer',
            drop: function (event, ui) {
                var draggable = ui.draggable;
                var droppable = $(this);
                var dragPos = draggable.position();
                var dropPos = droppable.position();
                draggable.swap(droppable);
                setTimeout(function () {
                    var dropmap = droppable.find('[id^=map-]');
                    var dragmap = draggable.find('[id^=map-]');
                    if (dragmap.length > 0 || dropmap.length > 0) {
                        dragmap.resize();
                        dropmap.resize();
                    }
                    else {
                        draggable.resize();
                        droppable.resize();
                    }
                }, 50);
                setTimeout(function () {
                    draggable.find('[id^=map-]').resize();
                    droppable.find('[id^=map-]').resize();
                }, 250);
            }
        });
}
jQuery.fn.swap = function (b) {
    b = jQuery(b)[0];
    var a = this[0];
    var t = a.parentNode.insertBefore(document.createTextNode(''), a);
    b.parentNode.insertBefore(a, b);
    t.parentNode.insertBefore(b, t);
    t.parentNode.removeChild(t);
    return this;
};

/*

 bootpag - jQuery plugin for dynamic pagination

 Copyright (c) 2013 botmonster@7items.com

 Licensed under the MIT license:
 http://www.opensource.org/licenses/mit-license.php

 Project home:
 http://botmonster.com/jquery-bootpag/

 Version:  1.0.4

 */
(function(f,q){f.fn.bootpag=function(p){function k(e,b){var c,d=0==a.maxVisible?1:a.maxVisible,n=1==a.maxVisible?0:1,m=Math.floor((b-1)/d)*d,g=e.find("li");a.page=b=0>b?0:b>a.total?a.total:b;g.removeClass("disabled");c=1>b-1?1:a.leaps&&b-1>=a.maxVisible?Math.floor((b-1)/d)*d:b-1;g.first().toggleClass("disabled",1===b).attr("data-lp",c).find("a").attr("href",h(c));n=1==a.maxVisible?0:1;c=b+1>a.total?a.total:a.leaps&&b+1<a.total-a.maxVisible?m+a.maxVisible+n:b+1;g.last().toggleClass("disabled",b===
a.total).attr("data-lp",c).find("a").attr("href",h(c));d=g.filter("[data-lp="+b+"]");if(!d.not(".next,.prev").length){var k=b<=m?-a.maxVisible:0;g.not(".next,.prev").each(function(b){c=b+1+m+k;f(this).attr("data-lp",c).toggle(c<=a.total).find("a").html(c).attr("href",h(c))});d=g.filter("[data-lp="+b+"]")}d.addClass("disabled");l.trigger("page",b);l.data("settings",a)}function h(e){return a.href.replace(a.hrefVariable,e)}var l=this,a=f.extend({total:0,page:1,maxVisible:null,leaps:!0,href:"javascript:void(0);",
    hrefVariable:"{{number}}",next:"&raquo;",prev:"&laquo;"},l.data("settings")||{},p||{});if(0>=a.total)return this;!f.isNumeric(a.maxVisible)&&!a.maxVisible&&(a.maxVisible=a.total);l.data("settings",a);return this.each(function(){var e,b,c=f(this),d=['<ul class="bootpag">'];a.prev&&d.push('<li data-lp="1" class="prev"><a href="'+h(1)+'">'+a.prev+"</a></li>");for(b=1;b<=Math.min(a.total,a.maxVisible);b++)d.push('<li data-lp="'+b+'"><a href="'+h(b)+'">'+b+"</a></li>");a.next&&(b=a.leaps&&a.total>a.maxVisible?
    Math.min(a.maxVisible+1,a.total):2,d.push('<li data-lp="'+b+'" class="next"><a href="'+h(b)+'">'+a.next+"</a></li>"));d.push("</ul>");c.find("ul.bootpag").remove();c.append(d.join("")).addClass("pagination");e=c.find("ul.bootpag");c.find("li").click(function(){var a=f(this);a.hasClass("disabled")||k(e,parseInt(a.attr("data-lp"),10))});k(e,a.page)})}})(jQuery,window);
/*!
 * pickadate.js v1.3.5 - 30 November, 2012
 * By Amsul (http://amsul.ca)
 * Hosted on https://github.com/amsul/pickadate.js
 * Licensed under MIT ("expat" flavour) license.
 */
;(function(e,i,j,b){var p=7,h=6,g=h*p,o="div",n="pickadate__",a=e(i),f=Array.isArray||function(q){return{}.toString.call(q)=="[object Array]"},c=function(s,r,q){if(typeof s=="function"){return s.apply(r,q)}},d=function(q){return(q<10?"0":"")+q},m=function(t,s,q,r){s=f(s)?s.join(""):s;q=q?' class="'+q+'"':"";r=r?" "+r:"";return"<"+t+q+r+">"+s+"</"+t+">"},l=function(q){if(f(q)){q=new Date(q[0],q[1],q[2])}else{if(!isNaN(q)){q=new Date(q)}else{q=new Date();q.setHours(0,0,0,0)}}return{YEAR:q.getFullYear(),MONTH:q.getMonth(),DATE:q.getDate(),DAY:q.getDay(),TIME:q.getTime()}},k=function(L,ae){var X={id:~~(Math.random()*1000000000)},M={d:function(){return S.DATE},dd:function(){return d(S.DATE)},ddd:function(){return ae.weekdaysShort[S.DAY]},dddd:function(){return ae.weekdaysFull[S.DAY]},m:function(){return S.MONTH+1},mm:function(){return d(S.MONTH+1)},mmm:function(){return ae.monthsShort[S.MONTH]},mmmm:function(){return ae.monthsFull[S.MONTH]},yy:function(){return S.YEAR.toString().substr(2,2)},yyyy:function(){return S.YEAR},toArray:function(ag){return ag.split(/(?=\b)(d{1,4}|m{1,4}|y{4}|yy)+(\b)/g)}},y={40:7,38:-7,39:1,37:-1},x={open:function(){w();return this},close:function(){s();return this},show:function(ah,ag){O(--ah,ag);return this},getDate:N,setDate:function(ah,aj,ag,ai){C(r([ah,--aj,ag]),ai);return this}},Q=ae.klass,q=l(),z=H(ae.dateMin),ab=H(ae.dateMax,1),t=(function(ag){if(f(ag)){if(ag[0]===true){X.disabled=ag.shift()}return ag.map(function(ah){if(!isNaN(ah)){return --ah+ae.firstDay}--ah[1];return l(ah)})}})(ae.datesDisabled),G=(function(){var ag=function(ah){return this.TIME==ah.TIME||t.indexOf(this.DAY)>-1};return X.disabled?function(ah,ai,aj){return(aj.map(ag,this).indexOf(true)<0)}:ag})(),V=(function(ag){ag.autofocus=(ag==j.activeElement);ag.type="text";ag.readOnly=true;return ag})(L[0]),A=(function(ag){return r(isNaN(ag)?q:ag)})(Date.parse(V.value)),S=A,W=A,P=ae.formatSubmit?e("<input type=hidden name="+V.name+ae.hiddenSuffix+">").val(V.value?N(ae.formatSubmit):"")[0]:null,I,T=(function(ag){if(ae.firstDay){ag.push(ag.splice(0,1)[0])}return m("thead",m("tr",ag.map(function(ah){return m("th",ah,Q.weekdays)})))})((ae.showWeekdaysShort?ae.weekdaysShort:ae.weekdaysFull).slice(0)),v=(function(){I=e(m(o,E(),Q.holder)).on({click:K});L.on({"focusin click":w,keydown:function(ah){var ag=ah.keyCode;if(ag==8||!X.isOpen&&y[ag]){ah.preventDefault();ah.stopPropagation();if(ag!=8){w()}}}}).after([I,P]);ac();if(V.autofocus){w()}c(ae.onStart,x)})();function u(){var ag=function(ai){if((ai&&W.YEAR>=ab.YEAR&&W.MONTH>=ab.MONTH)||(!ai&&W.YEAR<=z.YEAR&&W.MONTH<=z.MONTH)){return""}var ah="month"+(ai?"Next":"Prev");return m(o,ae[ah],Q[ah],"data-nav="+(ai||-1))};return ag()+ag(1)}function J(){var ag=ae.showMonthsFull?ae.monthsFull:ae.monthsShort;return(ae.monthSelector)?m("select",ag.map(function(ah,ai){return m("option",ah,0,"value="+ai+(W.MONTH==ai?" selected":"")+(F(ai,W.YEAR," disabled")||""))}),Q.monthSelector,"tabindex="+(X.isOpen?0:-1)):m(o,ag[W.MONTH],Q.month)}function Z(){var an=W.YEAR,al=ae.yearSelector;if(al){al=al===true?5:~~(al/2);var ai=[],ag=an-al,am=aa(ag,z.YEAR),ak=an+al+(am-ag),aj=aa(ak,ab.YEAR,1);al=ak-aj;if(al){am=aa(ag-al,z.YEAR)}for(var ah=0;ah<=aj-am;ah+=1){ai.push(am+ah)}return m("select",ai.map(function(ao){return m("option",ao,0,"value="+ao+(an==ao?" selected":""))}),Q.yearSelector,"tabindex="+(X.isOpen?0:-1))}return m(o,an,Q.year)}function B(){var am,ag,aj,an=[],al="",ao=D(W.YEAR,W.MONTH),ah=R(W.DATE,W.DAY),ak=function(aq,ar){var at=false,ap=[Q.day,(ar?Q.dayInfocus:Q.dayOutfocus)];if(aq.TIME<z.TIME||aq.TIME>ab.TIME||(t&&t.filter(G,aq).length)){at=true;ap.push(Q.dayDisabled)}if(aq.TIME==q.TIME){ap.push(Q.dayToday)}if(aq.TIME==A.TIME){ap.push(Q.dayHighlighted)}if(aq.TIME==S.TIME){ap.push(Q.daySelected)}return[ap.join(" "),"data-"+(at?"disabled":"date")+"="+[aq.YEAR,aq.MONTH,aq.DATE,aq.DAY,aq.TIME].join("/")]};for(var ai=0;ai<g;ai+=1){ag=ai-ah;am=l([W.YEAR,W.MONTH,ag]);aj=ak(am,(ag>0&&ag<=ao));an.push(m("td",m(o,am.DATE,aj[0],aj[1])));if((ai%p)+1==p){al+=m("tr",an.splice(0,p))}}return m("tbody",al,Q.calendarBody)}function E(){return m(o,m(o,m(o,u(),Q.monthNav)+m(o,J(),Q.monthWrap)+m(o,Z(),Q.yearWrap)+m("table",[T,B()],Q.calendarTable),Q.calendar),Q.calendarWrap)}function aa(ai,ag,ah){return((ah&&ai<ag)||(!ah&&ai>ag)?ai:ag)}function D(ag,ai){var ah=ai>6?true:false;if(ai==1){return((ag%400)===0||(ag%100)!==0)&&(ag%4)===0?29:28}if(ai%2){return ah?31:30}return ah?30:31}function R(ah,ai){var ag=ah%p,aj=ai-ag+(ae.firstDay?-1:0);return(ai>=ag)?aj:p+aj}function C(ai,ah,ag){A=ai;W=ai;if(ah){ad()}else{af(ai,1)}}function af(ah,ag){S=ah;V.value=N();if(P){P.value=N(ae.formatSubmit)}if(ag){ad()}c(ae.onSelect,x)}function U(ah,ag){return(W=l([ag,ah,1]))}function N(ag){return M.toArray(ag||ae.format).map(function(ah){return c(M[ah])||ah}).join("")}function Y(ag){return I.find("."+ag)}function O(ah,ag){ag=ag||W.YEAR;ah=F(ah,ag)||ah;U(ah,ag);ad()}function H(ag,ah){if(ag===true){return q}if(f(ag)){--ag[1];return l(ag)}if(ag&&!isNaN(ag)){return l([q.YEAR,q.MONTH,q.DATE+ag])}ag=ah?Infinity:-Infinity;return{YEAR:ag,MONTH:ag,TIME:ag}}function r(ag,ai){ag=!ag.TIME?l(ag):ag;if(t){var ah=ag;while(t.filter(G,ag).length){ag=l([ag.YEAR,ag.MONTH,ag.DATE+(ai||1)]);if(ag.MONTH!=ah.MONTH){ag=l([ah.YEAR,ah.MONTH,ai>0?++ah.DATE:--ah.DATE]);ah=ag}}}if(ag.TIME<z.TIME){ag=r(z)}else{if(ag.TIME>ab.TIME){ag=r(ab,-1)}}return ag}function F(ai,ah,ag){if(ah<=z.YEAR&&ai<z.MONTH){return ag||z.MONTH}if(ah>=ab.YEAR&&ai>ab.MONTH){return ag||ab.MONTH}}function ad(){I.html(E());ac()}function ac(){X.selectMonth=Y(Q.monthSelector).on({change:function(){O(+this.value);Y(Q.monthSelector).focus()},click:function(ag){ag.stopPropagation()}})[0];X.selectYear=Y(Q.yearSelector).on({change:function(){O(W.MONTH,+this.value);Y(Q.yearSelector).focus()},click:function(ag){ag.stopPropagation()}})[0]}function w(){if(X.isOpen){return}X.isOpen=true;L.addClass(Q.inputFocus);I.addClass(Q.open);if(X.selectMonth){X.selectMonth.tabIndex=0}if(X.selectYear){X.selectYear.tabIndex=0}a.on("click.P"+X.id,function(ag){if(ag.target!=V){s()}}).on("keydown.P"+X.id,function(ai){if(ai.target==V){var ag=ai.keyCode,ah=y[ag]||0;if(!ai.metaKey&&ag!=9){ai.preventDefault()}if(ag==13){af(A,1);s();return}if(ag==27){s();return}if(ah){C(r([W.YEAR,W.MONTH,A.DATE+ah],ah),1)}}}).on("focusin.P"+X.id,function(ag){if(ag.target==X.selectMonth||ag.target==X.selectYear){L.removeClass(Q.inputFocus);return}if(ag.target!=V&&ag.target!=X.selectMonth&&ag.target!=X.selectYear){s();return}});c(ae.onOpen,x)}function s(){X.isOpen=false;L.removeClass(Q.inputFocus);I.removeClass(Q.open);if(X.selectMonth){X.selectMonth.tabIndex=-1}if(X.selectYear){X.selectYear.tabIndex=-1}a.off(".P"+X.id);c(ae.onClose,x)}function K(ah){var ag=e(ah.target),aj=ag.data();ah.stopPropagation();L.focus();if(aj.date){var ai=aj.date.split("/");ai={YEAR:+ai[0],MONTH:+ai[1],DATE:+ai[2],DAY:+ai[3],TIME:+ai[4]};C(ai,false,ag);s()}if(aj.nav){O(W.MONTH+aj.nav)}}return x};k.defaults={monthsFull:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],weekdaysFull:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],monthPrev:"&#9664;",monthNext:"&#9654;",showMonthsFull:true,showWeekdaysShort:true,format:"d mmmm, yyyy",formatSubmit:false,hiddenSuffix:"_submit",firstDay:0,monthSelector:false,yearSelector:false,dateMin:false,dateMax:false,datesDisabled:false,disablePicker:false,onOpen:null,onClose:null,onSelect:null,onStart:null,klass:{inputFocus:n+"input--focused",holder:n+"holder",open:n+"holder--opened",calendar:n+"calendar",calendarWrap:n+"calendar--wrap",calendarTable:n+"calendar--table",calendarBody:n+"calendar--body",year:n+"year",yearWrap:n+"year--wrap",yearSelector:n+"year--selector",month:n+"month",monthWrap:n+"month--wrap",monthSelector:n+"month--selector",monthNav:n+"month--nav",monthPrev:n+"month--prev",monthNext:n+"month--next",week:n+"week",weekdays:n+"weekday",day:n+"day",dayDisabled:n+"day--disabled",daySelected:n+"day--selected",dayHighlighted:n+"day--highlighted",dayToday:n+"day--today",dayInfocus:n+"day--infocus",dayOutfocus:n+"day--outfocus"}};e.fn.pickadate=function(q){var r="pickadate";q=e.extend(true,{},k.defaults,q);if(q.disablePicker){return this}return this.each(function(){var s=e(this);if(this.nodeName=="INPUT"&&!s.data(r)){s.data(r,new k(s,q))}})}})(jQuery,window,document);
/*!
 Chosen, a Select Box Enhancer for jQuery and Prototype
 by Patrick Filler for Harvest, http://getharvest.com

 Version 1.1.0
 Full source at https://github.com/harvesthq/chosen
 Copyright (c) 2011 Harvest http://getharvest.com

 MIT License, https://github.com/harvesthq/chosen/blob/master/LICENSE.md
 This file is generated by `grunt build`, do not edit it by hand.
 */

(function() {
    var $, AbstractChosen, Chosen, SelectParser, _ref,
        __hasProp = {}.hasOwnProperty,
        __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

    SelectParser = (function() {
        function SelectParser() {
            this.options_index = 0;
            this.parsed = [];
        }

        SelectParser.prototype.add_node = function(child) {
            if (child.nodeName.toUpperCase() === "OPTGROUP") {
                return this.add_group(child);
            } else {
                return this.add_option(child);
            }
        };

        SelectParser.prototype.add_group = function(group) {
            var group_position, option, _i, _len, _ref, _results;
            group_position = this.parsed.length;
            this.parsed.push({
                array_index: group_position,
                group: true,
                label: this.escapeExpression(group.label),
                children: 0,
                disabled: group.disabled
            });
            _ref = group.childNodes;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                option = _ref[_i];
                _results.push(this.add_option(option, group_position, group.disabled));
            }
            return _results;
        };

        SelectParser.prototype.add_option = function(option, group_position, group_disabled) {
            if (option.nodeName.toUpperCase() === "OPTION") {
                if (option.text !== "") {
                    if (group_position != null) {
                        this.parsed[group_position].children += 1;
                    }
                    this.parsed.push({
                        array_index: this.parsed.length,
                        options_index: this.options_index,
                        value: option.value,
                        text: option.text,
                        html: option.innerHTML,
                        selected: option.selected,
                        disabled: group_disabled === true ? group_disabled : option.disabled,
                        group_array_index: group_position,
                        classes: option.className,
                        style: option.style.cssText
                    });
                } else {
                    this.parsed.push({
                        array_index: this.parsed.length,
                        options_index: this.options_index,
                        empty: true
                    });
                }
                return this.options_index += 1;
            }
        };

        SelectParser.prototype.escapeExpression = function(text) {
            var map, unsafe_chars;
            if ((text == null) || text === false) {
                return "";
            }
            if (!/[\&\<\>\"\'\`]/.test(text)) {
                return text;
            }
            map = {
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;",
                "`": "&#x60;"
            };
            unsafe_chars = /&(?!\w+;)|[\<\>\"\'\`]/g;
            return text.replace(unsafe_chars, function(chr) {
                return map[chr] || "&amp;";
            });
        };

        return SelectParser;

    })();

    SelectParser.select_to_array = function(select) {
        var child, parser, _i, _len, _ref;
        parser = new SelectParser();
        _ref = select.childNodes;
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            child = _ref[_i];
            parser.add_node(child);
        }
        return parser.parsed;
    };

    AbstractChosen = (function() {
        function AbstractChosen(form_field, options) {
            this.form_field = form_field;
            this.options = options != null ? options : {};
            if (!AbstractChosen.browser_is_supported()) {
                return;
            }
            this.is_multiple = this.form_field.multiple;
            this.set_default_text();
            this.set_default_values();
            this.setup();
            this.set_up_html();
            this.register_observers();
        }

        AbstractChosen.prototype.set_default_values = function() {
            var _this = this;
            this.click_test_action = function(evt) {
                return _this.test_active_click(evt);
            };
            this.activate_action = function(evt) {
                return _this.activate_field(evt);
            };
            this.active_field = false;
            this.mouse_on_container = false;
            this.results_showing = false;
            this.result_highlighted = null;
            this.allow_single_deselect = (this.options.allow_single_deselect != null) && (this.form_field.options[0] != null) && this.form_field.options[0].text === "" ? this.options.allow_single_deselect : false;
            this.disable_search_threshold = this.options.disable_search_threshold || 0;
            this.disable_search = this.options.disable_search || false;
            this.enable_split_word_search = this.options.enable_split_word_search != null ? this.options.enable_split_word_search : true;
            this.group_search = this.options.group_search != null ? this.options.group_search : true;
            this.search_contains = this.options.search_contains || false;
            this.single_backstroke_delete = this.options.single_backstroke_delete != null ? this.options.single_backstroke_delete : true;
            this.max_selected_options = this.options.max_selected_options || Infinity;
            this.inherit_select_classes = this.options.inherit_select_classes || false;
            this.display_selected_options = this.options.display_selected_options != null ? this.options.display_selected_options : true;
            return this.display_disabled_options = this.options.display_disabled_options != null ? this.options.display_disabled_options : true;
        };

        AbstractChosen.prototype.set_default_text = function() {
            if (this.form_field.getAttribute("data-placeholder")) {
                this.default_text = this.form_field.getAttribute("data-placeholder");
            } else if (this.is_multiple) {
                this.default_text = this.options.placeholder_text_multiple || this.options.placeholder_text || AbstractChosen.default_multiple_text;
            } else {
                this.default_text = this.options.placeholder_text_single || this.options.placeholder_text || AbstractChosen.default_single_text;
            }
            return this.results_none_found = this.form_field.getAttribute("data-no_results_text") || this.options.no_results_text || AbstractChosen.default_no_result_text;
        };

        AbstractChosen.prototype.mouse_enter = function() {
            return this.mouse_on_container = true;
        };

        AbstractChosen.prototype.mouse_leave = function() {
            return this.mouse_on_container = false;
        };

        AbstractChosen.prototype.input_focus = function(evt) {
            var _this = this;
            if (this.is_multiple) {
                if (!this.active_field) {
                    return setTimeout((function() {
                        return _this.container_mousedown();
                    }), 50);
                }
            } else {
                if (!this.active_field) {
                    return this.activate_field();
                }
            }
        };

        AbstractChosen.prototype.input_blur = function(evt) {
            var _this = this;
            if (!this.mouse_on_container) {
                this.active_field = false;
                return setTimeout((function() {
                    return _this.blur_test();
                }), 100);
            }
        };

        AbstractChosen.prototype.results_option_build = function(options) {
            var content, data, _i, _len, _ref;
            content = '';
            _ref = this.results_data;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                data = _ref[_i];
                if (data.group) {
                    content += this.result_add_group(data);
                } else {
                    content += this.result_add_option(data);
                }
                if (options != null ? options.first : void 0) {
                    if (data.selected && this.is_multiple) {
                        this.choice_build(data);
                    } else if (data.selected && !this.is_multiple) {
                        this.single_set_selected_text(data.text);
                    }
                }
            }
            return content;
        };

        AbstractChosen.prototype.result_add_option = function(option) {
            var classes, option_el;
            if (!option.search_match) {
                return '';
            }
            if (!this.include_option_in_results(option)) {
                return '';
            }
            classes = [];
            if (!option.disabled && !(option.selected && this.is_multiple)) {
                classes.push("active-result");
            }
            if (option.disabled && !(option.selected && this.is_multiple)) {
                classes.push("disabled-result");
            }
            if (option.selected) {
                classes.push("result-selected");
            }
            if (option.group_array_index != null) {
                classes.push("group-option");
            }
            if (option.classes !== "") {
                classes.push(option.classes);
            }
            option_el = document.createElement("li");
            option_el.className = classes.join(" ");
            option_el.style.cssText = option.style;
            option_el.setAttribute("data-option-array-index", option.array_index);
            option_el.innerHTML = option.search_text;
            return this.outerHTML(option_el);
        };

        AbstractChosen.prototype.result_add_group = function(group) {
            var group_el;
            if (!(group.search_match || group.group_match)) {
                return '';
            }
            if (!(group.active_options > 0)) {
                return '';
            }
            group_el = document.createElement("li");
            group_el.className = "group-result";
            group_el.innerHTML = group.search_text;
            return this.outerHTML(group_el);
        };

        AbstractChosen.prototype.results_update_field = function() {
            this.set_default_text();
            if (!this.is_multiple) {
                this.results_reset_cleanup();
            }
            this.result_clear_highlight();
            this.results_build();
            if (this.results_showing) {
                return this.winnow_results();
            }
        };

        AbstractChosen.prototype.reset_single_select_options = function() {
            var result, _i, _len, _ref, _results;
            _ref = this.results_data;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                result = _ref[_i];
                if (result.selected) {
                    _results.push(result.selected = false);
                } else {
                    _results.push(void 0);
                }
            }
            return _results;
        };

        AbstractChosen.prototype.results_toggle = function() {
            if (this.results_showing) {
                return this.results_hide();
            } else {
                return this.results_show();
            }
        };

        AbstractChosen.prototype.results_search = function(evt) {
            if (this.results_showing) {
                return this.winnow_results();
            } else {
                return this.results_show();
            }
        };

        AbstractChosen.prototype.winnow_results = function() {
            var escapedSearchText, option, regex, regexAnchor, results, results_group, searchText, startpos, text, zregex, _i, _len, _ref;
            this.no_results_clear();
            results = 0;
            searchText = this.get_search_text();
            escapedSearchText = searchText.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
            regexAnchor = this.search_contains ? "" : "^";
            regex = new RegExp(regexAnchor + escapedSearchText, 'i');
            zregex = new RegExp(escapedSearchText, 'i');
            _ref = this.results_data;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                option = _ref[_i];
                option.search_match = false;
                results_group = null;
                if (this.include_option_in_results(option)) {
                    if (option.group) {
                        option.group_match = false;
                        option.active_options = 0;
                    }
                    if ((option.group_array_index != null) && this.results_data[option.group_array_index]) {
                        results_group = this.results_data[option.group_array_index];
                        if (results_group.active_options === 0 && results_group.search_match) {
                            results += 1;
                        }
                        results_group.active_options += 1;
                    }
                    if (!(option.group && !this.group_search)) {
                        option.search_text = option.group ? option.label : option.html;
                        option.search_match = this.search_string_match(option.search_text, regex);
                        if (option.search_match && !option.group) {
                            results += 1;
                        }
                        if (option.search_match) {
                            if (searchText.length) {
                                startpos = option.search_text.search(zregex);
                                text = option.search_text.substr(0, startpos + searchText.length) + '</em>' + option.search_text.substr(startpos + searchText.length);
                                option.search_text = text.substr(0, startpos) + '<em>' + text.substr(startpos);
                            }
                            if (results_group != null) {
                                results_group.group_match = true;
                            }
                        } else if ((option.group_array_index != null) && this.results_data[option.group_array_index].search_match) {
                            option.search_match = true;
                        }
                    }
                }
            }
            this.result_clear_highlight();
            if (results < 1 && searchText.length) {
                this.update_results_content("");
                return this.no_results(searchText);
            } else {
                this.update_results_content(this.results_option_build());
                return this.winnow_results_set_highlight();
            }
        };

        AbstractChosen.prototype.search_string_match = function(search_string, regex) {
            var part, parts, _i, _len;
            if (regex.test(search_string)) {
                return true;
            } else if (this.enable_split_word_search && (search_string.indexOf(" ") >= 0 || search_string.indexOf("[") === 0)) {
                parts = search_string.replace(/\[|\]/g, "").split(" ");
                if (parts.length) {
                    for (_i = 0, _len = parts.length; _i < _len; _i++) {
                        part = parts[_i];
                        if (regex.test(part)) {
                            return true;
                        }
                    }
                }
            }
        };

        AbstractChosen.prototype.choices_count = function() {
            var option, _i, _len, _ref;
            if (this.selected_option_count != null) {
                return this.selected_option_count;
            }
            this.selected_option_count = 0;
            _ref = this.form_field.options;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                option = _ref[_i];
                if (option.selected) {
                    this.selected_option_count += 1;
                }
            }
            return this.selected_option_count;
        };

        AbstractChosen.prototype.choices_click = function(evt) {
            evt.preventDefault();
            if (!(this.results_showing || this.is_disabled)) {
                return this.results_show();
            }
        };

        AbstractChosen.prototype.keyup_checker = function(evt) {
            var stroke, _ref;
            stroke = (_ref = evt.which) != null ? _ref : evt.keyCode;
            this.search_field_scale();
            switch (stroke) {
                case 8:
                    if (this.is_multiple && this.backstroke_length < 1 && this.choices_count() > 0) {
                        return this.keydown_backstroke();
                    } else if (!this.pending_backstroke) {
                        this.result_clear_highlight();
                        return this.results_search();
                    }
                    break;
                case 13:
                    evt.preventDefault();
                    if (this.results_showing) {
                        return this.result_select(evt);
                    }
                    break;
                case 27:
                    if (this.results_showing) {
                        this.results_hide();
                    }
                    return true;
                case 9:
                case 38:
                case 40:
                case 16:
                case 91:
                case 17:
                    break;
                default:
                    return this.results_search();
            }
        };

        AbstractChosen.prototype.clipboard_event_checker = function(evt) {
            var _this = this;
            return setTimeout((function() {
                return _this.results_search();
            }), 50);
        };

        AbstractChosen.prototype.container_width = function() {
            if (this.options.width != null) {
                return this.options.width;
            } else {
                return "" + this.form_field.offsetWidth + "px";
            }
        };

        AbstractChosen.prototype.include_option_in_results = function(option) {
            if (this.is_multiple && (!this.display_selected_options && option.selected)) {
                return false;
            }
            if (!this.display_disabled_options && option.disabled) {
                return false;
            }
            if (option.empty) {
                return false;
            }
            return true;
        };

        AbstractChosen.prototype.search_results_touchstart = function(evt) {
            this.touch_started = true;
            return this.search_results_mouseover(evt);
        };

        AbstractChosen.prototype.search_results_touchmove = function(evt) {
            this.touch_started = false;
            return this.search_results_mouseout(evt);
        };

        AbstractChosen.prototype.search_results_touchend = function(evt) {
            if (this.touch_started) {
                return this.search_results_mouseup(evt);
            }
        };

        AbstractChosen.prototype.outerHTML = function(element) {
            var tmp;
            if (element.outerHTML) {
                return element.outerHTML;
            }
            tmp = document.createElement("div");
            tmp.appendChild(element);
            return tmp.innerHTML;
        };

        AbstractChosen.browser_is_supported = function() {
            if (window.navigator.appName === "Microsoft Internet Explorer") {
                return document.documentMode >= 8;
            }
            if (/iP(od|hone)/i.test(window.navigator.userAgent)) {
                return false;
            }
            if (/Android/i.test(window.navigator.userAgent)) {
                if (/Mobile/i.test(window.navigator.userAgent)) {
                    return false;
                }
            }
            return true;
        };

        AbstractChosen.default_multiple_text = "Select Some Options";

        AbstractChosen.default_single_text = "Select an Option";

        AbstractChosen.default_no_result_text = "No results match";

        return AbstractChosen;

    })();

    $ = jQuery;

    $.fn.extend({
        chosen: function(options) {
            if (!AbstractChosen.browser_is_supported()) {
                return this;
            }
            return this.each(function(input_field) {
                var $this, chosen;
                $this = $(this);
                chosen = $this.data('chosen');
                if (options === 'destroy' && chosen) {
                    chosen.destroy();
                } else if (!chosen) {
                    $this.data('chosen', new Chosen(this, options));
                }
            });
        }
    });

    Chosen = (function(_super) {
        __extends(Chosen, _super);

        function Chosen() {
            _ref = Chosen.__super__.constructor.apply(this, arguments);
            return _ref;
        }

        Chosen.prototype.setup = function() {
            this.form_field_jq = $(this.form_field);
            this.current_selectedIndex = this.form_field.selectedIndex;
            return this.is_rtl = this.form_field_jq.hasClass("chosen-rtl");
        };

        Chosen.prototype.set_up_html = function() {
            var container_classes, container_props;
            container_classes = ["chosen-container"];
            container_classes.push("chosen-container-" + (this.is_multiple ? "multi" : "single"));
            if (this.inherit_select_classes && this.form_field.className) {
                container_classes.push(this.form_field.className);
            }
            if (this.is_rtl) {
                container_classes.push("chosen-rtl");
            }
            container_props = {
                'class': container_classes.join(' '),
                'style': "width: " + (this.container_width()) + ";",
                'title': this.form_field.title
            };
            if (this.form_field.id.length) {
                container_props.id = this.form_field.id.replace(/[^\w]/g, '_') + "_chosen";
            }
            this.container = $("<div />", container_props);
            if (this.is_multiple) {
                this.container.html('<ul class="chosen-choices"><li class="search-field"><input type="text" value="' + this.default_text + '" class="default" autocomplete="off" style="width:25px;" /></li></ul><div class="chosen-drop"><ul class="chosen-results"></ul></div>');
            } else {
                this.container.html('<a class="chosen-single chosen-default" tabindex="-1"><span>' + this.default_text + '</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" /></div><ul class="chosen-results"></ul></div>');
            }
            this.form_field_jq.hide().after(this.container);
            this.dropdown = this.container.find('div.chosen-drop').first();
            this.search_field = this.container.find('input').first();
            this.search_results = this.container.find('ul.chosen-results').first();
            this.search_field_scale();
            this.search_no_results = this.container.find('li.no-results').first();
            if (this.is_multiple) {
                this.search_choices = this.container.find('ul.chosen-choices').first();
                this.search_container = this.container.find('li.search-field').first();
            } else {
                this.search_container = this.container.find('div.chosen-search').first();
                this.selected_item = this.container.find('.chosen-single').first();
            }
            this.results_build();
            this.set_tab_index();
            this.set_label_behavior();
            return this.form_field_jq.trigger("chosen:ready", {
                chosen: this
            });
        };

        Chosen.prototype.register_observers = function() {
            var _this = this;
            this.container.bind('mousedown.chosen', function(evt) {
                _this.container_mousedown(evt);
            });
            this.container.bind('mouseup.chosen', function(evt) {
                _this.container_mouseup(evt);
            });
            this.container.bind('mouseenter.chosen', function(evt) {
                _this.mouse_enter(evt);
            });
            this.container.bind('mouseleave.chosen', function(evt) {
                _this.mouse_leave(evt);
            });
            this.search_results.bind('mouseup.chosen', function(evt) {
                _this.search_results_mouseup(evt);
            });
            this.search_results.bind('mouseover.chosen', function(evt) {
                _this.search_results_mouseover(evt);
            });
            this.search_results.bind('mouseout.chosen', function(evt) {
                _this.search_results_mouseout(evt);
            });
            this.search_results.bind('mousewheel.chosen DOMMouseScroll.chosen', function(evt) {
                _this.search_results_mousewheel(evt);
            });
            this.search_results.bind('touchstart.chosen', function(evt) {
                _this.search_results_touchstart(evt);
            });
            this.search_results.bind('touchmove.chosen', function(evt) {
                _this.search_results_touchmove(evt);
            });
            this.search_results.bind('touchend.chosen', function(evt) {
                _this.search_results_touchend(evt);
            });
            this.form_field_jq.bind("chosen:updated.chosen", function(evt) {
                _this.results_update_field(evt);
            });
            this.form_field_jq.bind("chosen:activate.chosen", function(evt) {
                _this.activate_field(evt);
            });
            this.form_field_jq.bind("chosen:open.chosen", function(evt) {
                _this.container_mousedown(evt);
            });
            this.form_field_jq.bind("chosen:close.chosen", function(evt) {
                _this.input_blur(evt);
            });
            this.search_field.bind('blur.chosen', function(evt) {
                _this.input_blur(evt);
            });
            this.search_field.bind('keyup.chosen', function(evt) {
                _this.keyup_checker(evt);
            });
            this.search_field.bind('keydown.chosen', function(evt) {
                _this.keydown_checker(evt);
            });
            this.search_field.bind('focus.chosen', function(evt) {
                _this.input_focus(evt);
            });
            this.search_field.bind('cut.chosen', function(evt) {
                _this.clipboard_event_checker(evt);
            });
            this.search_field.bind('paste.chosen', function(evt) {
                _this.clipboard_event_checker(evt);
            });
            if (this.is_multiple) {
                return this.search_choices.bind('click.chosen', function(evt) {
                    _this.choices_click(evt);
                });
            } else {
                return this.container.bind('click.chosen', function(evt) {
                    evt.preventDefault();
                });
            }
        };

        Chosen.prototype.destroy = function() {
            $(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action);
            if (this.search_field[0].tabIndex) {
                this.form_field_jq[0].tabIndex = this.search_field[0].tabIndex;
            }
            this.container.remove();
            this.form_field_jq.removeData('chosen');
            return this.form_field_jq.show();
        };

        Chosen.prototype.search_field_disabled = function() {
            this.is_disabled = this.form_field_jq[0].disabled;
            if (this.is_disabled) {
                this.container.addClass('chosen-disabled');
                this.search_field[0].disabled = true;
                if (!this.is_multiple) {
                    this.selected_item.unbind("focus.chosen", this.activate_action);
                }
                return this.close_field();
            } else {
                this.container.removeClass('chosen-disabled');
                this.search_field[0].disabled = false;
                if (!this.is_multiple) {
                    return this.selected_item.bind("focus.chosen", this.activate_action);
                }
            }
        };

        Chosen.prototype.container_mousedown = function(evt) {
            if (!this.is_disabled) {
                if (evt && evt.type === "mousedown" && !this.results_showing) {
                    evt.preventDefault();
                }
                if (!((evt != null) && ($(evt.target)).hasClass("search-choice-close"))) {
                    if (!this.active_field) {
                        if (this.is_multiple) {
                            this.search_field.val("");
                        }
                        $(this.container[0].ownerDocument).bind('click.chosen', this.click_test_action);
                        this.results_show();
                    } else if (!this.is_multiple && evt && (($(evt.target)[0] === this.selected_item[0]) || $(evt.target).parents("a.chosen-single").length)) {
                        evt.preventDefault();
                        this.results_toggle();
                    }
                    return this.activate_field();
                }
            }
        };

        Chosen.prototype.container_mouseup = function(evt) {
            if (evt.target.nodeName === "ABBR" && !this.is_disabled) {
                return this.results_reset(evt);
            }
        };

        Chosen.prototype.search_results_mousewheel = function(evt) {
            var delta;
            if (evt.originalEvent) {
                delta = -evt.originalEvent.wheelDelta || evt.originalEvent.detail;
            }
            if (delta != null) {
                evt.preventDefault();
                if (evt.type === 'DOMMouseScroll') {
                    delta = delta * 40;
                }
                return this.search_results.scrollTop(delta + this.search_results.scrollTop());
            }
        };

        Chosen.prototype.blur_test = function(evt) {
            if (!this.active_field && this.container.hasClass("chosen-container-active")) {
                return this.close_field();
            }
        };

        Chosen.prototype.close_field = function() {
            $(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action);
            this.active_field = false;
            this.results_hide();
            this.container.removeClass("chosen-container-active");
            this.clear_backstroke();
            this.show_search_field_default();
            return this.search_field_scale();
        };

        Chosen.prototype.activate_field = function() {
            this.container.addClass("chosen-container-active");
            this.active_field = true;
            this.search_field.val(this.search_field.val());
            return this.search_field.focus();
        };

        Chosen.prototype.test_active_click = function(evt) {
            var active_container;
            active_container = $(evt.target).closest('.chosen-container');
            if (active_container.length && this.container[0] === active_container[0]) {
                return this.active_field = true;
            } else {
                return this.close_field();
            }
        };

        Chosen.prototype.results_build = function() {
            this.parsing = true;
            this.selected_option_count = null;
            this.results_data = SelectParser.select_to_array(this.form_field);
            if (this.is_multiple) {
                this.search_choices.find("li.search-choice").remove();
            } else if (!this.is_multiple) {
                this.single_set_selected_text();
                if (this.disable_search || this.form_field.options.length <= this.disable_search_threshold) {
                    this.search_field[0].readOnly = true;
                    this.container.addClass("chosen-container-single-nosearch");
                } else {
                    this.search_field[0].readOnly = false;
                    this.container.removeClass("chosen-container-single-nosearch");
                }
            }
            this.update_results_content(this.results_option_build({
                first: true
            }));
            this.search_field_disabled();
            this.show_search_field_default();
            this.search_field_scale();
            return this.parsing = false;
        };

        Chosen.prototype.result_do_highlight = function(el) {
            var high_bottom, high_top, maxHeight, visible_bottom, visible_top;
            if (el.length) {
                this.result_clear_highlight();
                this.result_highlight = el;
                this.result_highlight.addClass("highlighted");
                maxHeight = parseInt(this.search_results.css("maxHeight"), 10);
                visible_top = this.search_results.scrollTop();
                visible_bottom = maxHeight + visible_top;
                high_top = this.result_highlight.position().top + this.search_results.scrollTop();
                high_bottom = high_top + this.result_highlight.outerHeight();
                if (high_bottom >= visible_bottom) {
                    return this.search_results.scrollTop((high_bottom - maxHeight) > 0 ? high_bottom - maxHeight : 0);
                } else if (high_top < visible_top) {
                    return this.search_results.scrollTop(high_top);
                }
            }
        };

        Chosen.prototype.result_clear_highlight = function() {
            if (this.result_highlight) {
                this.result_highlight.removeClass("highlighted");
            }
            return this.result_highlight = null;
        };

        Chosen.prototype.results_show = function() {
            if (this.is_multiple && this.max_selected_options <= this.choices_count()) {
                this.form_field_jq.trigger("chosen:maxselected", {
                    chosen: this
                });
                return false;
            }
            this.container.addClass("chosen-with-drop");
            this.results_showing = true;
            this.search_field.focus();
            this.search_field.val(this.search_field.val());
            this.winnow_results();
            return this.form_field_jq.trigger("chosen:showing_dropdown", {
                chosen: this
            });
        };

        Chosen.prototype.update_results_content = function(content) {
            return this.search_results.html(content);
        };

        Chosen.prototype.results_hide = function() {
            if (this.results_showing) {
                this.result_clear_highlight();
                this.container.removeClass("chosen-with-drop");
                this.form_field_jq.trigger("chosen:hiding_dropdown", {
                    chosen: this
                });
            }
            return this.results_showing = false;
        };

        Chosen.prototype.set_tab_index = function(el) {
            var ti;
            if (this.form_field.tabIndex) {
                ti = this.form_field.tabIndex;
                this.form_field.tabIndex = -1;
                return this.search_field[0].tabIndex = ti;
            }
        };

        Chosen.prototype.set_label_behavior = function() {
            var _this = this;
            this.form_field_label = this.form_field_jq.parents("label");
            if (!this.form_field_label.length && this.form_field.id.length) {
                this.form_field_label = $("label[for='" + this.form_field.id + "']");
            }
            if (this.form_field_label.length > 0) {
                return this.form_field_label.bind('click.chosen', function(evt) {
                    if (_this.is_multiple) {
                        return _this.container_mousedown(evt);
                    } else {
                        return _this.activate_field();
                    }
                });
            }
        };

        Chosen.prototype.show_search_field_default = function() {
            if (this.is_multiple && this.choices_count() < 1 && !this.active_field) {
                this.search_field.val(this.default_text);
                return this.search_field.addClass("default");
            } else {
                this.search_field.val("");
                return this.search_field.removeClass("default");
            }
        };

        Chosen.prototype.search_results_mouseup = function(evt) {
            var target;
            target = $(evt.target).hasClass("active-result") ? $(evt.target) : $(evt.target).parents(".active-result").first();
            if (target.length) {
                this.result_highlight = target;
                this.result_select(evt);
                return this.search_field.focus();
            }
        };

        Chosen.prototype.search_results_mouseover = function(evt) {
            var target;
            target = $(evt.target).hasClass("active-result") ? $(evt.target) : $(evt.target).parents(".active-result").first();
            if (target) {
                return this.result_do_highlight(target);
            }
        };

        Chosen.prototype.search_results_mouseout = function(evt) {
            if ($(evt.target).hasClass("active-result" || $(evt.target).parents('.active-result').first())) {
                return this.result_clear_highlight();
            }
        };

        Chosen.prototype.choice_build = function(item) {
            var choice, close_link,
                _this = this;
            choice = $('<li />', {
                "class": "search-choice"
            }).html("<span>" + item.html + "</span>");
            if (item.disabled) {
                choice.addClass('search-choice-disabled');
            } else {
                close_link = $('<a />', {
                    "class": 'search-choice-close',
                    'data-option-array-index': item.array_index
                });
                close_link.bind('click.chosen', function(evt) {
                    return _this.choice_destroy_link_click(evt);
                });
                choice.append(close_link);
            }
            return this.search_container.before(choice);
        };

        Chosen.prototype.choice_destroy_link_click = function(evt) {
            evt.preventDefault();
            evt.stopPropagation();
            if (!this.is_disabled) {
                return this.choice_destroy($(evt.target));
            }
        };

        Chosen.prototype.choice_destroy = function(link) {
            if (this.result_deselect(link[0].getAttribute("data-option-array-index"))) {
                this.show_search_field_default();
                if (this.is_multiple && this.choices_count() > 0 && this.search_field.val().length < 1) {
                    this.results_hide();
                }
                link.parents('li').first().remove();
                return this.search_field_scale();
            }
        };

        Chosen.prototype.results_reset = function() {
            this.reset_single_select_options();
            this.form_field.options[0].selected = true;
            this.single_set_selected_text();
            this.show_search_field_default();
            this.results_reset_cleanup();
            this.form_field_jq.trigger("change");
            if (this.active_field) {
                return this.results_hide();
            }
        };

        Chosen.prototype.results_reset_cleanup = function() {
            this.current_selectedIndex = this.form_field.selectedIndex;
            return this.selected_item.find("abbr").remove();
        };

        Chosen.prototype.result_select = function(evt) {
            var high, item;
            if (this.result_highlight) {
                high = this.result_highlight;
                this.result_clear_highlight();
                if (this.is_multiple && this.max_selected_options <= this.choices_count()) {
                    this.form_field_jq.trigger("chosen:maxselected", {
                        chosen: this
                    });
                    return false;
                }
                if (this.is_multiple) {
                    high.removeClass("active-result");
                } else {
                    this.reset_single_select_options();
                }
                item = this.results_data[high[0].getAttribute("data-option-array-index")];
                item.selected = true;
                this.form_field.options[item.options_index].selected = true;
                this.selected_option_count = null;
                if (this.is_multiple) {
                    this.choice_build(item);
                } else {
                    this.single_set_selected_text(item.text);
                }
                if (!((evt.metaKey || evt.ctrlKey) && this.is_multiple)) {
                    this.results_hide();
                }
                this.search_field.val("");
                if (this.is_multiple || this.form_field.selectedIndex !== this.current_selectedIndex) {
                    this.form_field_jq.trigger("change", {
                        'selected': this.form_field.options[item.options_index].value
                    });
                }
                this.current_selectedIndex = this.form_field.selectedIndex;
                return this.search_field_scale();
            }
        };

        Chosen.prototype.single_set_selected_text = function(text) {
            if (text == null) {
                text = this.default_text;
            }
            if (text === this.default_text) {
                this.selected_item.addClass("chosen-default");
            } else {
                this.single_deselect_control_build();
                this.selected_item.removeClass("chosen-default");
            }
            return this.selected_item.find("span").text(text);
        };

        Chosen.prototype.result_deselect = function(pos) {
            var result_data;
            result_data = this.results_data[pos];
            if (!this.form_field.options[result_data.options_index].disabled) {
                result_data.selected = false;
                this.form_field.options[result_data.options_index].selected = false;
                this.selected_option_count = null;
                this.result_clear_highlight();
                if (this.results_showing) {
                    this.winnow_results();
                }
                this.form_field_jq.trigger("change", {
                    deselected: this.form_field.options[result_data.options_index].value
                });
                this.search_field_scale();
                return true;
            } else {
                return false;
            }
        };

        Chosen.prototype.single_deselect_control_build = function() {
            if (!this.allow_single_deselect) {
                return;
            }
            if (!this.selected_item.find("abbr").length) {
                this.selected_item.find("span").first().after("<abbr class=\"search-choice-close\"></abbr>");
            }
            return this.selected_item.addClass("chosen-single-with-deselect");
        };

        Chosen.prototype.get_search_text = function() {
            if (this.search_field.val() === this.default_text) {
                return "";
            } else {
                return $('<div/>').text($.trim(this.search_field.val())).html();
            }
        };

        Chosen.prototype.winnow_results_set_highlight = function() {
            var do_high, selected_results;
            selected_results = !this.is_multiple ? this.search_results.find(".result-selected.active-result") : [];
            do_high = selected_results.length ? selected_results.first() : this.search_results.find(".active-result").first();
            if (do_high != null) {
                return this.result_do_highlight(do_high);
            }
        };

        Chosen.prototype.no_results = function(terms) {
            var no_results_html;
            no_results_html = $('<li class="no-results">' + this.results_none_found + ' "<span></span>"</li>');
            no_results_html.find("span").first().html(terms);
            this.search_results.append(no_results_html);
            return this.form_field_jq.trigger("chosen:no_results", {
                chosen: this
            });
        };

        Chosen.prototype.no_results_clear = function() {
            return this.search_results.find(".no-results").remove();
        };

        Chosen.prototype.keydown_arrow = function() {
            var next_sib;
            if (this.results_showing && this.result_highlight) {
                next_sib = this.result_highlight.nextAll("li.active-result").first();
                if (next_sib) {
                    return this.result_do_highlight(next_sib);
                }
            } else {
                return this.results_show();
            }
        };

        Chosen.prototype.keyup_arrow = function() {
            var prev_sibs;
            if (!this.results_showing && !this.is_multiple) {
                return this.results_show();
            } else if (this.result_highlight) {
                prev_sibs = this.result_highlight.prevAll("li.active-result");
                if (prev_sibs.length) {
                    return this.result_do_highlight(prev_sibs.first());
                } else {
                    if (this.choices_count() > 0) {
                        this.results_hide();
                    }
                    return this.result_clear_highlight();
                }
            }
        };

        Chosen.prototype.keydown_backstroke = function() {
            var next_available_destroy;
            if (this.pending_backstroke) {
                this.choice_destroy(this.pending_backstroke.find("a").first());
                return this.clear_backstroke();
            } else {
                next_available_destroy = this.search_container.siblings("li.search-choice").last();
                if (next_available_destroy.length && !next_available_destroy.hasClass("search-choice-disabled")) {
                    this.pending_backstroke = next_available_destroy;
                    if (this.single_backstroke_delete) {
                        return this.keydown_backstroke();
                    } else {
                        return this.pending_backstroke.addClass("search-choice-focus");
                    }
                }
            }
        };

        Chosen.prototype.clear_backstroke = function() {
            if (this.pending_backstroke) {
                this.pending_backstroke.removeClass("search-choice-focus");
            }
            return this.pending_backstroke = null;
        };

        Chosen.prototype.keydown_checker = function(evt) {
            var stroke, _ref1;
            stroke = (_ref1 = evt.which) != null ? _ref1 : evt.keyCode;
            this.search_field_scale();
            if (stroke !== 8 && this.pending_backstroke) {
                this.clear_backstroke();
            }
            switch (stroke) {
                case 8:
                    this.backstroke_length = this.search_field.val().length;
                    break;
                case 9:
                    if (this.results_showing && !this.is_multiple) {
                        this.result_select(evt);
                    }
                    this.mouse_on_container = false;
                    break;
                case 13:
                    evt.preventDefault();
                    break;
                case 38:
                    evt.preventDefault();
                    this.keyup_arrow();
                    break;
                case 40:
                    evt.preventDefault();
                    this.keydown_arrow();
                    break;
            }
        };

        Chosen.prototype.search_field_scale = function() {
            var div, f_width, h, style, style_block, styles, w, _i, _len;
            if (this.is_multiple) {
                h = 0;
                w = 0;
                style_block = "position:absolute; left: -1000px; top: -1000px; display:none;";
                styles = ['font-size', 'font-style', 'font-weight', 'font-family', 'line-height', 'text-transform', 'letter-spacing'];
                for (_i = 0, _len = styles.length; _i < _len; _i++) {
                    style = styles[_i];
                    style_block += style + ":" + this.search_field.css(style) + ";";
                }
                div = $('<div />', {
                    'style': style_block
                });
                div.text(this.search_field.val());
                $('body').append(div);
                w = div.width() + 25;
                div.remove();
                f_width = this.container.outerWidth();
                if (w > f_width - 10) {
                    w = f_width - 10;
                }
                return this.search_field.css({
                    'width': w + 'px'
                });
            }
        };

        return Chosen;

    })(AbstractChosen);

}).call(this);

/*!
 @package noty - jQuery Notification Plugin
 @version version: 2.2.8
 @contributors https://github.com/needim/noty/graphs/contributors

 @documentation Examples and Documentation - http://needim.github.com/noty/

 @license Licensed under the MIT licenses: http://www.opensource.org/licenses/mit-license.php
 */
"function"!=typeof Object.create&&(Object.create=function(a){function b(){}return b.prototype=a,new b}),function(a){var b={init:function(b){return this.options=a.extend({},a.noty.defaults,b),this.options.layout=this.options.custom?a.noty.layouts.inline:a.noty.layouts[this.options.layout],a.noty.themes[this.options.theme]?this.options.theme=a.noty.themes[this.options.theme]:b.themeClassName=this.options.theme,delete b.layout,delete b.theme,this.options=a.extend({},this.options,this.options.layout.options),this.options.id="noty_"+(new Date).getTime()*Math.floor(1e6*Math.random()),this.options=a.extend({},this.options,b),this._build(),this},_build:function(){var b=a('<div class="noty_bar noty_type_'+this.options.type+'"></div>').attr("id",this.options.id);if(b.append(this.options.template).find(".noty_text").html(this.options.text),this.$bar=null!==this.options.layout.parent.object?a(this.options.layout.parent.object).css(this.options.layout.parent.css).append(b):b,this.options.themeClassName&&this.$bar.addClass(this.options.themeClassName).addClass("noty_container_type_"+this.options.type),this.options.buttons){this.options.closeWith=[],this.options.timeout=!1;var c=a("<div/>").addClass("noty_buttons");null!==this.options.layout.parent.object?this.$bar.find(".noty_bar").append(c):this.$bar.append(c);var d=this;a.each(this.options.buttons,function(b,c){var e=a("<button/>").addClass(c.addClass?c.addClass:"gray").html(c.text).attr("id",c.id?c.id:"button-"+b).appendTo(d.$bar.find(".noty_buttons")).on("click",function(){a.isFunction(c.onClick)&&c.onClick.call(e,d)})})}this.$message=this.$bar.find(".noty_message"),this.$closeButton=this.$bar.find(".noty_close"),this.$buttons=this.$bar.find(".noty_buttons"),a.noty.store[this.options.id]=this},show:function(){var b=this;return b.options.custom?b.options.custom.find(b.options.layout.container.selector).append(b.$bar):a(b.options.layout.container.selector).append(b.$bar),b.options.theme&&b.options.theme.style&&b.options.theme.style.apply(b),"function"===a.type(b.options.layout.css)?this.options.layout.css.apply(b.$bar):b.$bar.css(this.options.layout.css||{}),b.$bar.addClass(b.options.layout.addClass),b.options.layout.container.style.apply(a(b.options.layout.container.selector)),b.showing=!0,b.options.theme&&b.options.theme.style&&b.options.theme.callback.onShow.apply(this),a.inArray("click",b.options.closeWith)>-1&&b.$bar.css("cursor","pointer").one("click",function(a){b.stopPropagation(a),b.options.callback.onCloseClick&&b.options.callback.onCloseClick.apply(b),b.close()}),a.inArray("hover",b.options.closeWith)>-1&&b.$bar.one("mouseenter",function(){b.close()}),a.inArray("button",b.options.closeWith)>-1&&b.$closeButton.one("click",function(a){b.stopPropagation(a),b.close()}),-1==a.inArray("button",b.options.closeWith)&&b.$closeButton.remove(),b.options.callback.onShow&&b.options.callback.onShow.apply(b),b.$bar.animate(b.options.animation.open,b.options.animation.speed,b.options.animation.easing,function(){b.options.callback.afterShow&&b.options.callback.afterShow.apply(b),b.showing=!1,b.shown=!0}),b.options.timeout&&b.$bar.delay(b.options.timeout).promise().done(function(){b.close()}),this},close:function(){if(!(this.closed||this.$bar&&this.$bar.hasClass("i-am-closing-now"))){var b=this;if(this.showing)return b.$bar.queue(function(){b.close.apply(b)}),void 0;if(this.$bar.dequeue(),!this.shown&&!this.showing){var c=[];return a.each(a.noty.queue,function(a,d){d.options.id!=b.options.id&&c.push(d)}),a.noty.queue=c,void 0}b.$bar.addClass("i-am-closing-now"),b.options.callback.onClose&&b.options.callback.onClose.apply(b),b.$bar.clearQueue().stop().animate(b.options.animation.close,b.options.animation.speed,b.options.animation.easing,function(){b.options.callback.afterClose&&b.options.callback.afterClose.apply(b)}).promise().done(function(){b.options.modal&&(a.notyRenderer.setModalCount(-1),0==a.notyRenderer.getModalCount()&&a(".noty_modal").fadeOut("fast",function(){a(this).remove()})),a.notyRenderer.setLayoutCountFor(b,-1),0==a.notyRenderer.getLayoutCountFor(b)&&a(b.options.layout.container.selector).remove(),"undefined"!=typeof b.$bar&&null!==b.$bar&&(b.$bar.remove(),b.$bar=null,b.closed=!0),delete a.noty.store[b.options.id],b.options.theme.callback&&b.options.theme.callback.onClose&&b.options.theme.callback.onClose.apply(b),b.options.dismissQueue||(a.noty.ontap=!0,a.notyRenderer.render()),b.options.maxVisible>0&&b.options.dismissQueue&&a.notyRenderer.render()})}},setText:function(a){return this.closed||(this.options.text=a,this.$bar.find(".noty_text").html(a)),this},setType:function(a){return this.closed||(this.options.type=a,this.options.theme.style.apply(this),this.options.theme.callback.onShow.apply(this)),this},setTimeout:function(a){if(!this.closed){var b=this;this.options.timeout=a,b.$bar.delay(b.options.timeout).promise().done(function(){b.close()})}return this},stopPropagation:function(a){a=a||window.event,"undefined"!=typeof a.stopPropagation?a.stopPropagation():a.cancelBubble=!0},closed:!1,showing:!1,shown:!1};a.notyRenderer={},a.notyRenderer.init=function(c){var d=Object.create(b).init(c);return d.options.killer&&a.noty.closeAll(),d.options.force?a.noty.queue.unshift(d):a.noty.queue.push(d),a.notyRenderer.render(),"object"==a.noty.returns?d:d.options.id},a.notyRenderer.render=function(){var b=a.noty.queue[0];"object"===a.type(b)?b.options.dismissQueue?b.options.maxVisible>0?a(b.options.layout.container.selector+" li").length<b.options.maxVisible&&a.notyRenderer.show(a.noty.queue.shift()):a.notyRenderer.show(a.noty.queue.shift()):a.noty.ontap&&(a.notyRenderer.show(a.noty.queue.shift()),a.noty.ontap=!1):a.noty.ontap=!0},a.notyRenderer.show=function(b){b.options.modal&&(a.notyRenderer.createModalFor(b),a.notyRenderer.setModalCount(1)),b.options.custom?0==b.options.custom.find(b.options.layout.container.selector).length?b.options.custom.append(a(b.options.layout.container.object).addClass("i-am-new")):b.options.custom.find(b.options.layout.container.selector).removeClass("i-am-new"):0==a(b.options.layout.container.selector).length?a("body").append(a(b.options.layout.container.object).addClass("i-am-new")):a(b.options.layout.container.selector).removeClass("i-am-new"),a.notyRenderer.setLayoutCountFor(b,1),b.show()},a.notyRenderer.createModalFor=function(b){if(0==a(".noty_modal").length){var c=a("<div/>").addClass("noty_modal").addClass(b.options.theme).data("noty_modal_count",0);b.options.theme.modal&&b.options.theme.modal.css&&c.css(b.options.theme.modal.css),c.prependTo(a("body")).fadeIn("fast"),a.inArray("backdrop",b.options.closeWith)>-1&&c.on("click",function(){a.noty.closeAll()})}},a.notyRenderer.getLayoutCountFor=function(b){return a(b.options.layout.container.selector).data("noty_layout_count")||0},a.notyRenderer.setLayoutCountFor=function(b,c){return a(b.options.layout.container.selector).data("noty_layout_count",a.notyRenderer.getLayoutCountFor(b)+c)},a.notyRenderer.getModalCount=function(){return a(".noty_modal").data("noty_modal_count")||0},a.notyRenderer.setModalCount=function(b){return a(".noty_modal").data("noty_modal_count",a.notyRenderer.getModalCount()+b)},a.fn.noty=function(b){return b.custom=a(this),a.notyRenderer.init(b)},a.noty={},a.noty.queue=[],a.noty.ontap=!0,a.noty.layouts={},a.noty.themes={},a.noty.returns="object",a.noty.store={},a.noty.get=function(b){return a.noty.store.hasOwnProperty(b)?a.noty.store[b]:!1},a.noty.close=function(b){return a.noty.get(b)?a.noty.get(b).close():!1},a.noty.setText=function(b,c){return a.noty.get(b)?a.noty.get(b).setText(c):!1},a.noty.setType=function(b,c){return a.noty.get(b)?a.noty.get(b).setType(c):!1},a.noty.clearQueue=function(){a.noty.queue=[]},a.noty.closeAll=function(){a.noty.clearQueue(),a.each(a.noty.store,function(a,b){b.close()})};var c=window.alert;a.noty.consumeAlert=function(b){window.alert=function(c){b?b.text=c:b={text:c},a.notyRenderer.init(b)}},a.noty.stopConsumeAlert=function(){window.alert=c},a.noty.defaults={layout:"top",theme:"defaultTheme",type:"alert",text:"",dismissQueue:!0,template:'<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',animation:{open:{height:"toggle"},close:{height:"toggle"},easing:"swing",speed:500},timeout:!1,force:!1,modal:!1,maxVisible:5,killer:!1,closeWith:["click"],callback:{onShow:function(){},afterShow:function(){},onClose:function(){},afterClose:function(){},onCloseClick:function(){}},buttons:!1},a(window).on("resize",function(){a.each(a.noty.layouts,function(b,c){c.container.style.apply(a(c.container.selector))})})}(jQuery),window.noty=function(a){return jQuery.notyRenderer.init(a)},function(a){a.noty.layouts.bottom={name:"bottom",options:{},container:{object:'<ul id="noty_bottom_layout_container" />',selector:"ul#noty_bottom_layout_container",style:function(){a(this).css({bottom:0,left:"5%",position:"fixed",width:"90%",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:9999999})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none"},addClass:""}}(jQuery),function(a){a.noty.layouts.bottomCenter={name:"bottomCenter",options:{},container:{object:'<ul id="noty_bottomCenter_layout_container" />',selector:"ul#noty_bottomCenter_layout_container",style:function(){a(this).css({bottom:20,left:0,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),a(this).css({left:(a(window).width()-a(this).outerWidth(!1))/2+"px"})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.bottomLeft={name:"bottomLeft",options:{},container:{object:'<ul id="noty_bottomLeft_layout_container" />',selector:"ul#noty_bottomLeft_layout_container",style:function(){a(this).css({bottom:20,left:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({left:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.bottomRight={name:"bottomRight",options:{},container:{object:'<ul id="noty_bottomRight_layout_container" />',selector:"ul#noty_bottomRight_layout_container",style:function(){a(this).css({bottom:20,right:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({right:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.center={name:"center",options:{},container:{object:'<ul id="noty_center_layout_container" />',selector:"ul#noty_center_layout_container",style:function(){a(this).css({position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7});var b=a(this).clone().css({visibility:"hidden",display:"block",position:"absolute",top:0,left:0}).attr("id","dupe");a("body").append(b),b.find(".i-am-closing-now").remove(),b.find("li").css("display","block");var c=b.height();b.remove(),a(this).hasClass("i-am-new")?a(this).css({left:(a(window).width()-a(this).outerWidth(!1))/2+"px",top:(a(window).height()-c)/2+"px"}):a(this).animate({left:(a(window).width()-a(this).outerWidth(!1))/2+"px",top:(a(window).height()-c)/2+"px"},500)}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.centerLeft={name:"centerLeft",options:{},container:{object:'<ul id="noty_centerLeft_layout_container" />',selector:"ul#noty_centerLeft_layout_container",style:function(){a(this).css({left:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7});var b=a(this).clone().css({visibility:"hidden",display:"block",position:"absolute",top:0,left:0}).attr("id","dupe");a("body").append(b),b.find(".i-am-closing-now").remove(),b.find("li").css("display","block");var c=b.height();b.remove(),a(this).hasClass("i-am-new")?a(this).css({top:(a(window).height()-c)/2+"px"}):a(this).animate({top:(a(window).height()-c)/2+"px"},500),window.innerWidth<600&&a(this).css({left:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.centerRight={name:"centerRight",options:{},container:{object:'<ul id="noty_centerRight_layout_container" />',selector:"ul#noty_centerRight_layout_container",style:function(){a(this).css({right:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7});var b=a(this).clone().css({visibility:"hidden",display:"block",position:"absolute",top:0,left:0}).attr("id","dupe");a("body").append(b),b.find(".i-am-closing-now").remove(),b.find("li").css("display","block");var c=b.height();b.remove(),a(this).hasClass("i-am-new")?a(this).css({top:(a(window).height()-c)/2+"px"}):a(this).animate({top:(a(window).height()-c)/2+"px"},500),window.innerWidth<600&&a(this).css({right:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.inline={name:"inline",options:{},container:{object:'<ul class="noty_inline_layout_container" />',selector:"ul.noty_inline_layout_container",style:function(){a(this).css({width:"100%",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:9999999})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none"},addClass:""}}(jQuery),function(a){a.noty.layouts.top={name:"top",options:{},container:{object:'<ul id="noty_top_layout_container" />',selector:"ul#noty_top_layout_container",style:function(){a(this).css({top:0,left:"5%",position:"fixed",width:"90%",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:9999999})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none"},addClass:""}}(jQuery),function(a){a.noty.layouts.topCenter={name:"topCenter",options:{},container:{object:'<ul id="noty_topCenter_layout_container" />',selector:"ul#noty_topCenter_layout_container",style:function(){a(this).css({top:20,left:0,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),a(this).css({left:(a(window).width()-a(this).outerWidth(!1))/2+"px"})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.topLeft={name:"topLeft",options:{},container:{object:'<ul id="noty_topLeft_layout_container" />',selector:"ul#noty_topLeft_layout_container",style:function(){a(this).css({top:20,left:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({left:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.layouts.topRight={name:"topRight",options:{},container:{object:'<ul id="noty_topRight_layout_container" />',selector:"ul#noty_topRight_layout_container",style:function(){a(this).css({top:20,right:20,position:"fixed",width:"310px",height:"auto",margin:0,padding:0,listStyleType:"none",zIndex:1e7}),window.innerWidth<600&&a(this).css({right:5})}},parent:{object:"<li />",selector:"li",css:{}},css:{display:"none",width:"310px"},addClass:""}}(jQuery),function(a){a.noty.themes.bootstrapTheme={name:"bootstrapTheme",modal:{css:{position:"fixed",width:"100%",height:"100%",backgroundColor:"#000",zIndex:1e4,opacity:.6,display:"none",left:0,top:0}},style:function(){var b=this.options.layout.container.selector;switch(a(b).addClass("list-group"),this.$closeButton.append('<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>'),this.$closeButton.addClass("close"),this.$bar.addClass("list-group-item"),this.options.type){case"alert":case"notification":this.$bar.addClass("list-group-item-info");break;case"warning":this.$bar.addClass("list-group-item-warning");break;case"error":this.$bar.addClass("list-group-item-danger");break;case"information":this.$bar.addClass("list-group-item-info");break;case"success":this.$bar.addClass("list-group-item-success")}},callback:{onShow:function(){},onClose:function(){}}}}(jQuery),function(a){a.noty.themes.defaultTheme={name:"defaultTheme",helpers:{borderFix:function(){if(this.options.dismissQueue){var b=this.options.layout.container.selector+" "+this.options.layout.parent.selector;switch(this.options.layout.name){case"top":a(b).css({borderRadius:"0px 0px 0px 0px"}),a(b).last().css({borderRadius:"0px 0px 5px 5px"});break;case"topCenter":case"topLeft":case"topRight":case"bottomCenter":case"bottomLeft":case"bottomRight":case"center":case"centerLeft":case"centerRight":case"inline":a(b).css({borderRadius:"0px 0px 0px 0px"}),a(b).first().css({"border-top-left-radius":"5px","border-top-right-radius":"5px"}),a(b).last().css({"border-bottom-left-radius":"5px","border-bottom-right-radius":"5px"});break;case"bottom":a(b).css({borderRadius:"0px 0px 0px 0px"}),a(b).first().css({borderRadius:"5px 5px 0px 0px"})}}}},modal:{css:{position:"fixed",width:"100%",height:"100%",backgroundColor:"#000",zIndex:1e4,opacity:.6,display:"none",left:0,top:0}},style:function(){switch(this.$bar.css({overflow:"hidden",background:"url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABsAAAAoCAYAAAAPOoFWAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAPZJREFUeNq81tsOgjAMANB2ov7/7ypaN7IlIwi9rGuT8QSc9EIDAsAznxvY4pXPKr05RUE5MEVB+TyWfCEl9LZApYopCmo9C4FKSMtYoI8Bwv79aQJU4l6hXXCZrQbokJEksxHo9KMOgc6w1atHXM8K9DVC7FQnJ0i8iK3QooGgbnyKgMDygBWyYFZoqx4qS27KqLZJjA1D0jK6QJcYEQEiWv9PGkTsbqxQ8oT+ZtZB6AkdsJnQDnMoHXHLGKOgDYuCWmYhEERCI5gaamW0bnHdA3k2ltlIN+2qKRyCND0bhqSYCyTB3CAOc4WusBEIpkeBuPgJMAAX8Hs1NfqHRgAAAABJRU5ErkJggg==') repeat-x scroll left top #fff"}),this.$message.css({fontSize:"13px",lineHeight:"16px",textAlign:"center",padding:"8px 10px 9px",width:"auto",position:"relative"}),this.$closeButton.css({position:"absolute",top:4,right:4,width:10,height:10,background:"url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAACXBIWXMAAAsTAAALEwEAmpwYAAAKT2lDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjanVNnVFPpFj333vRCS4iAlEtvUhUIIFJCi4AUkSYqIQkQSoghodkVUcERRUUEG8igiAOOjoCMFVEsDIoK2AfkIaKOg6OIisr74Xuja9a89+bN/rXXPues852zzwfACAyWSDNRNYAMqUIeEeCDx8TG4eQuQIEKJHAAEAizZCFz/SMBAPh+PDwrIsAHvgABeNMLCADATZvAMByH/w/qQplcAYCEAcB0kThLCIAUAEB6jkKmAEBGAYCdmCZTAKAEAGDLY2LjAFAtAGAnf+bTAICd+Jl7AQBblCEVAaCRACATZYhEAGg7AKzPVopFAFgwABRmS8Q5ANgtADBJV2ZIALC3AMDOEAuyAAgMADBRiIUpAAR7AGDIIyN4AISZABRG8lc88SuuEOcqAAB4mbI8uSQ5RYFbCC1xB1dXLh4ozkkXKxQ2YQJhmkAuwnmZGTKBNA/g88wAAKCRFRHgg/P9eM4Ors7ONo62Dl8t6r8G/yJiYuP+5c+rcEAAAOF0ftH+LC+zGoA7BoBt/qIl7gRoXgugdfeLZrIPQLUAoOnaV/Nw+H48PEWhkLnZ2eXk5NhKxEJbYcpXff5nwl/AV/1s+X48/Pf14L7iJIEyXYFHBPjgwsz0TKUcz5IJhGLc5o9H/LcL//wd0yLESWK5WCoU41EScY5EmozzMqUiiUKSKcUl0v9k4t8s+wM+3zUAsGo+AXuRLahdYwP2SycQWHTA4vcAAPK7b8HUKAgDgGiD4c93/+8//UegJQCAZkmScQAAXkQkLlTKsz/HCAAARKCBKrBBG/TBGCzABhzBBdzBC/xgNoRCJMTCQhBCCmSAHHJgKayCQiiGzbAdKmAv1EAdNMBRaIaTcA4uwlW4Dj1wD/phCJ7BKLyBCQRByAgTYSHaiAFiilgjjggXmYX4IcFIBBKLJCDJiBRRIkuRNUgxUopUIFVIHfI9cgI5h1xGupE7yAAygvyGvEcxlIGyUT3UDLVDuag3GoRGogvQZHQxmo8WoJvQcrQaPYw2oefQq2gP2o8+Q8cwwOgYBzPEbDAuxsNCsTgsCZNjy7EirAyrxhqwVqwDu4n1Y8+xdwQSgUXACTYEd0IgYR5BSFhMWE7YSKggHCQ0EdoJNwkDhFHCJyKTqEu0JroR+cQYYjIxh1hILCPWEo8TLxB7iEPENyQSiUMyJ7mQAkmxpFTSEtJG0m5SI+ksqZs0SBojk8naZGuyBzmULCAryIXkneTD5DPkG+Qh8lsKnWJAcaT4U+IoUspqShnlEOU05QZlmDJBVaOaUt2ooVQRNY9aQq2htlKvUYeoEzR1mjnNgxZJS6WtopXTGmgXaPdpr+h0uhHdlR5Ol9BX0svpR+iX6AP0dwwNhhWDx4hnKBmbGAcYZxl3GK+YTKYZ04sZx1QwNzHrmOeZD5lvVVgqtip8FZHKCpVKlSaVGyovVKmqpqreqgtV81XLVI+pXlN9rkZVM1PjqQnUlqtVqp1Q61MbU2epO6iHqmeob1Q/pH5Z/YkGWcNMw09DpFGgsV/jvMYgC2MZs3gsIWsNq4Z1gTXEJrHN2Xx2KruY/R27iz2qqaE5QzNKM1ezUvOUZj8H45hx+Jx0TgnnKKeX836K3hTvKeIpG6Y0TLkxZVxrqpaXllirSKtRq0frvTau7aedpr1Fu1n7gQ5Bx0onXCdHZ4/OBZ3nU9lT3acKpxZNPTr1ri6qa6UbobtEd79up+6Ynr5egJ5Mb6feeb3n+hx9L/1U/W36p/VHDFgGswwkBtsMzhg8xTVxbzwdL8fb8VFDXcNAQ6VhlWGX4YSRudE8o9VGjUYPjGnGXOMk423GbcajJgYmISZLTepN7ppSTbmmKaY7TDtMx83MzaLN1pk1mz0x1zLnm+eb15vft2BaeFostqi2uGVJsuRaplnutrxuhVo5WaVYVVpds0atna0l1rutu6cRp7lOk06rntZnw7Dxtsm2qbcZsOXYBtuutm22fWFnYhdnt8Wuw+6TvZN9un2N/T0HDYfZDqsdWh1+c7RyFDpWOt6azpzuP33F9JbpL2dYzxDP2DPjthPLKcRpnVOb00dnF2e5c4PziIuJS4LLLpc+Lpsbxt3IveRKdPVxXeF60vWdm7Obwu2o26/uNu5p7ofcn8w0nymeWTNz0MPIQ+BR5dE/C5+VMGvfrH5PQ0+BZ7XnIy9jL5FXrdewt6V3qvdh7xc+9j5yn+M+4zw33jLeWV/MN8C3yLfLT8Nvnl+F30N/I/9k/3r/0QCngCUBZwOJgUGBWwL7+Hp8Ib+OPzrbZfay2e1BjKC5QRVBj4KtguXBrSFoyOyQrSH355jOkc5pDoVQfujW0Adh5mGLw34MJ4WHhVeGP45wiFga0TGXNXfR3ENz30T6RJZE3ptnMU85ry1KNSo+qi5qPNo3ujS6P8YuZlnM1VidWElsSxw5LiquNm5svt/87fOH4p3iC+N7F5gvyF1weaHOwvSFpxapLhIsOpZATIhOOJTwQRAqqBaMJfITdyWOCnnCHcJnIi/RNtGI2ENcKh5O8kgqTXqS7JG8NXkkxTOlLOW5hCepkLxMDUzdmzqeFpp2IG0yPTq9MYOSkZBxQqohTZO2Z+pn5mZ2y6xlhbL+xW6Lty8elQfJa7OQrAVZLQq2QqboVFoo1yoHsmdlV2a/zYnKOZarnivN7cyzytuQN5zvn//tEsIS4ZK2pYZLVy0dWOa9rGo5sjxxedsK4xUFK4ZWBqw8uIq2Km3VT6vtV5eufr0mek1rgV7ByoLBtQFr6wtVCuWFfevc1+1dT1gvWd+1YfqGnRs+FYmKrhTbF5cVf9go3HjlG4dvyr+Z3JS0qavEuWTPZtJm6ebeLZ5bDpaql+aXDm4N2dq0Dd9WtO319kXbL5fNKNu7g7ZDuaO/PLi8ZafJzs07P1SkVPRU+lQ27tLdtWHX+G7R7ht7vPY07NXbW7z3/T7JvttVAVVN1WbVZftJ+7P3P66Jqun4lvttXa1ObXHtxwPSA/0HIw6217nU1R3SPVRSj9Yr60cOxx++/p3vdy0NNg1VjZzG4iNwRHnk6fcJ3/ceDTradox7rOEH0x92HWcdL2pCmvKaRptTmvtbYlu6T8w+0dbq3nr8R9sfD5w0PFl5SvNUyWna6YLTk2fyz4ydlZ19fi753GDborZ752PO32oPb++6EHTh0kX/i+c7vDvOXPK4dPKy2+UTV7hXmq86X23qdOo8/pPTT8e7nLuarrlca7nuer21e2b36RueN87d9L158Rb/1tWeOT3dvfN6b/fF9/XfFt1+cif9zsu72Xcn7q28T7xf9EDtQdlD3YfVP1v+3Njv3H9qwHeg89HcR/cGhYPP/pH1jw9DBY+Zj8uGDYbrnjg+OTniP3L96fynQ89kzyaeF/6i/suuFxYvfvjV69fO0ZjRoZfyl5O/bXyl/erA6xmv28bCxh6+yXgzMV70VvvtwXfcdx3vo98PT+R8IH8o/2j5sfVT0Kf7kxmTk/8EA5jz/GMzLdsAAAAgY0hSTQAAeiUAAICDAAD5/wAAgOkAAHUwAADqYAAAOpgAABdvkl/FRgAAATpJREFUeNoszrFqVFEUheG19zlz7sQ7ijMQBAvfYBqbpJCoZSAQbOwEE1IHGytbLQUJ8SUktW8gCCFJMSGSNxCmFBJO7j5rpXD6n5/P5vM53H3b3T9LOiB5AQDuDjM7BnA7DMPHDGBH0nuSzwHsRcRVRNRSysuU0i6AOwA/02w2+9Fae00SEbEh6SGAR5K+k3zWWptKepCm0+kpyRoRGyRBcpPkDsn1iEBr7drdP2VJZyQXERGSPpiZAViTBACXKaV9kqd5uVzCzO5KKb/d/UZSDwD/eyxqree1VqSu6zKAF2Z2RPJJaw0rAkjOJT0m+SuT/AbgDcmnkmBmfwAsJL1dXQ8lWY6IGwB1ZbrOOb8zs8thGP4COFwx/mE8Ho9Go9ErMzvJOW/1fY/JZIJSypqZfXX3L13X9fcDAKJct1sx3OiuAAAAAElFTkSuQmCC)",display:"none",cursor:"pointer"}),this.$buttons.css({padding:5,textAlign:"right",borderTop:"1px solid #ccc",backgroundColor:"#fff"}),this.$buttons.find("button").css({marginLeft:5}),this.$buttons.find("button:first").css({marginLeft:0}),this.$bar.on({mouseenter:function(){a(this).find(".noty_close").stop().fadeTo("normal",1)},mouseleave:function(){a(this).find(".noty_close").stop().fadeTo("normal",0)}}),this.options.layout.name){case"top":this.$bar.css({borderRadius:"0px 0px 5px 5px",borderBottom:"2px solid #eee",borderLeft:"2px solid #eee",borderRight:"2px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"});break;case"topCenter":case"center":case"bottomCenter":case"inline":this.$bar.css({borderRadius:"5px",border:"1px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"}),this.$message.css({fontSize:"13px",textAlign:"center"});break;case"topLeft":case"topRight":case"bottomLeft":case"bottomRight":case"centerLeft":case"centerRight":this.$bar.css({borderRadius:"5px",border:"1px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"}),this.$message.css({fontSize:"13px",textAlign:"left"});break;case"bottom":this.$bar.css({borderRadius:"5px 5px 0px 0px",borderTop:"2px solid #eee",borderLeft:"2px solid #eee",borderRight:"2px solid #eee",boxShadow:"0 -2px 4px rgba(0, 0, 0, 0.1)"});break;default:this.$bar.css({border:"2px solid #eee",boxShadow:"0 2px 4px rgba(0, 0, 0, 0.1)"})}switch(this.options.type){case"alert":case"notification":this.$bar.css({backgroundColor:"#FFF",borderColor:"#CCC",color:"#444"});break;case"warning":this.$bar.css({backgroundColor:"#FFEAA8",borderColor:"#FFC237",color:"#826200"}),this.$buttons.css({borderTop:"1px solid #FFC237"});break;case"error":this.$bar.css({backgroundColor:"red",borderColor:"darkred",color:"#FFF"}),this.$message.css({fontWeight:"bold"}),this.$buttons.css({borderTop:"1px solid darkred"});break;case"information":this.$bar.css({backgroundColor:"#57B7E2",borderColor:"#0B90C4",color:"#FFF"}),this.$buttons.css({borderTop:"1px solid #0B90C4"});break;case"success":this.$bar.css({backgroundColor:"lightgreen",borderColor:"#50C24E",color:"darkgreen"}),this.$buttons.css({borderTop:"1px solid #50C24E"});break;default:this.$bar.css({backgroundColor:"#FFF",borderColor:"#CCC",color:"#444"})}},callback:{onShow:function(){a.noty.themes.defaultTheme.helpers.borderFix.apply(this)},onClose:function(){a.noty.themes.defaultTheme.helpers.borderFix.apply(this)}}}}(jQuery);
/* =============================================================
 * bootstrap3-typeahead.js v3.1.0
 * https://github.com/bassjobsen/Bootstrap-3-Typeahead
 * =============================================================
 * Original written by @mdo and @fat
 * =============================================================
 * Copyright 2014 Bass Jobsen @bassjobsen
 *
 * Licensed under the Apache License, Version 2.0 (the 'License');
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an 'AS IS' BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


(function (root, factory) {

    'use strict';

    // CommonJS module is defined
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = factory(require('jquery'));
    }
    // AMD module is defined
    else if (typeof define === 'function' && define.amd) {
        define(['jquery'], function ($) {
            return factory ($);
        });
    } else {
        factory(root.jQuery);
    }

}(this, function ($) {

    'use strict';
    // jshint laxcomma: true


    /* TYPEAHEAD PUBLIC CLASS DEFINITION
     * ================================= */

    var Typeahead = function (element, options) {
        this.$element = $(element);
        this.options = $.extend({}, $.fn.typeahead.defaults, options);
        this.matcher = this.options.matcher || this.matcher;
        this.sorter = this.options.sorter || this.sorter;
        this.select = this.options.select || this.select;
        this.autoSelect = typeof this.options.autoSelect == 'boolean' ? this.options.autoSelect : true;
        this.highlighter = this.options.highlighter || this.highlighter;
        this.render = this.options.render || this.render;
        this.updater = this.options.updater || this.updater;
        this.displayText = this.options.displayText || this.displayText;
        this.source = this.options.source;
        this.delay = this.options.delay;
        this.$menu = $(this.options.menu);
        this.$appendTo = this.options.appendTo ? $(this.options.appendTo) : null;
        this.shown = false;
        this.listen();
        this.showHintOnFocus = typeof this.options.showHintOnFocus == 'boolean' ? this.options.showHintOnFocus : false;
        this.afterSelect = this.options.afterSelect;
        this.addItem = false;
    };

    Typeahead.prototype = {

        constructor: Typeahead,

        select: function () {
            var val = this.$menu.find('.active').data('value');
            this.$element.data('active', val);
            if(this.autoSelect || val) {
                var newVal = this.updater(val);
                this.$element
                    .val(this.displayText(newVal) || newVal)
                    .change();
                this.afterSelect(newVal);
            }
            return this.hide();
        },

        updater: function (item) {
            return item;
        },

        setSource: function (source) {
            this.source = source;
        },

        show: function () {
            var pos = $.extend({}, this.$element.position(), {
                height: this.$element[0].offsetHeight
            }), scrollHeight;

            scrollHeight = typeof this.options.scrollHeight == 'function' ?
                this.options.scrollHeight.call() :
                this.options.scrollHeight;

            (this.$appendTo ? this.$menu.appendTo(this.$appendTo) : this.$menu.insertAfter(this.$element))
                .css({
                    top: pos.top + pos.height + scrollHeight
                    , left: pos.left
                })
                .show();

            this.shown = true;
            return this;
        },

        hide: function () {
            this.$menu.hide();
            this.shown = false;
            return this;
        },

        lookup: function (query) {
            var items;
            if (typeof(query) != 'undefined' && query !== null) {
                this.query = query;
            } else {
                this.query = this.$element.val() ||  '';
            }

            if (this.query.length < this.options.minLength) {
                return this.shown ? this.hide() : this;
            }

            var worker = $.proxy(function() {

                if($.isFunction(this.source)) this.source(this.query, $.proxy(this.process, this));
                else if (this.source) {
                    this.process(this.source);
                }
            }, this);

            clearTimeout(this.lookupWorker);
            this.lookupWorker = setTimeout(worker, this.delay);
        },

        process: function (items) {
            var that = this;

            items = $.grep(items, function (item) {
                return that.matcher(item);
            });

            items = this.sorter(items);

            if (!items.length && !this.options.addItem) {
                return this.shown ? this.hide() : this;
            }

            if (items.length > 0) {
                this.$element.data('active', items[0]);
            } else {
                this.$element.data('active', null);
            }

            // Add item
            if (this.options.addItem){
                items.push(this.options.addItem);
            }

            if (this.options.items == 'all') {
                return this.render(items).show();
            } else {
                return this.render(items.slice(0, this.options.items)).show();
            }
        },

        matcher: function (item) {
            var it = this.displayText(item);
            return ~it.toLowerCase().indexOf(this.query.toLowerCase());
        },

        sorter: function (items) {
            var beginswith = []
                , caseSensitive = []
                , caseInsensitive = []
                , item;

            while ((item = items.shift())) {
                var it = this.displayText(item);
                if (!it.toLowerCase().indexOf(this.query.toLowerCase())) beginswith.push(item);
                else if (~it.indexOf(this.query)) caseSensitive.push(item);
                else caseInsensitive.push(item);
            }

            return beginswith.concat(caseSensitive, caseInsensitive);
        },

        highlighter: function (item) {
            var html = $('<div></div>');
            var query = this.query;
            var i = item.toLowerCase().indexOf(query.toLowerCase());
            var len, leftPart, middlePart, rightPart, strong;
            len = query.length;
            if(len === 0){
                return html.text(item).html();
            }
            while (i > -1) {
                leftPart = item.substr(0, i);
                middlePart = item.substr(i, len);
                rightPart = item.substr(i + len);
                strong = $('<strong></strong>').text(middlePart);
                html
                    .append(document.createTextNode(leftPart))
                    .append(strong);
                item = rightPart;
                i = item.toLowerCase().indexOf(query.toLowerCase());
            }
            return html.append(document.createTextNode(item)).html();
        },

        render: function (items) {
            var that = this;
            var self = this;
            var activeFound = false;
            items = $(items).map(function (i, item) {
                var text = self.displayText(item);
                i = $(that.options.item).data('value', item);
                i.find('a').html(that.highlighter(text));
                if (text == self.$element.val()) {
                    i.addClass('active');
                    self.$element.data('active', item);
                    activeFound = true;
                }
                return i[0];
            });

            if (this.autoSelect && !activeFound) {
                items.first().addClass('active');
                this.$element.data('active', items.first().data('value'));
            }
            this.$menu.html(items);
            return this;
        },

        displayText: function(item) {
            return item.name || item;
        },

        next: function (event) {
            var active = this.$menu.find('.active').removeClass('active')
                , next = active.next();

            if (!next.length) {
                next = $(this.$menu.find('li')[0]);
            }

            next.addClass('active');
        },

        prev: function (event) {
            var active = this.$menu.find('.active').removeClass('active')
                , prev = active.prev();

            if (!prev.length) {
                prev = this.$menu.find('li').last();
            }

            prev.addClass('active');
        },

        listen: function () {
            this.$element
                .on('focus',    $.proxy(this.focus, this))
                .on('blur',     $.proxy(this.blur, this))
                .on('keypress', $.proxy(this.keypress, this))
                .on('keyup',    $.proxy(this.keyup, this));

            if (this.eventSupported('keydown')) {
                this.$element.on('keydown', $.proxy(this.keydown, this));
            }

            this.$menu
                .on('click', $.proxy(this.click, this))
                .on('mouseenter', 'li', $.proxy(this.mouseenter, this))
                .on('mouseleave', 'li', $.proxy(this.mouseleave, this));
        },

        destroy : function () {
            this.$element.data('typeahead',null);
            this.$element.data('active',null);
            this.$element
                .off('focus')
                .off('blur')
                .off('keypress')
                .off('keyup');

            if (this.eventSupported('keydown')) {
                this.$element.off('keydown');
            }

            this.$menu.remove();
        },

        eventSupported: function(eventName) {
            var isSupported = eventName in this.$element;
            if (!isSupported) {
                this.$element.setAttribute(eventName, 'return;');
                isSupported = typeof this.$element[eventName] === 'function';
            }
            return isSupported;
        },

        move: function (e) {
            if (!this.shown) return;

            switch(e.keyCode) {
                case 9: // tab
                case 13: // enter
                case 27: // escape
                    e.preventDefault();
                    break;

                case 38: // up arrow
                    // with the shiftKey (this is actually the left parenthesis)
                    if (e.shiftKey) return;
                    e.preventDefault();
                    this.prev();
                    break;

                case 40: // down arrow
                    // with the shiftKey (this is actually the right parenthesis)
                    if (e.shiftKey) return;
                    e.preventDefault();
                    this.next();
                    break;
            }

            e.stopPropagation();
        },

        keydown: function (e) {
            this.suppressKeyPressRepeat = ~$.inArray(e.keyCode, [40,38,9,13,27]);
            if (!this.shown && e.keyCode == 40) {
                this.lookup();
            } else {
                this.move(e);
            }
        },

        keypress: function (e) {
            if (this.suppressKeyPressRepeat) return;
            this.move(e);
        },

        keyup: function (e) {
            switch(e.keyCode) {
                case 40: // down arrow
                case 38: // up arrow
                case 16: // shift
                case 17: // ctrl
                case 18: // alt
                    break;

                case 9: // tab
                case 13: // enter
                    if (!this.shown) return;
                    this.select();
                    break;

                case 27: // escape
                    if (!this.shown) return;
                    this.hide();
                    break;
                default:
                    this.lookup();
            }

            e.stopPropagation();
            e.preventDefault();
        },

        focus: function (e) {
            if (!this.focused) {
                this.focused = true;
                if (this.options.showHintOnFocus) {
                    this.lookup('');
                }
            }
        },

        blur: function (e) {
            this.focused = false;
            if (!this.mousedover && this.shown) this.hide();
        },

        click: function (e) {
            e.stopPropagation();
            e.preventDefault();
            this.select();
            this.$element.focus();
        },

        mouseenter: function (e) {
            this.mousedover = true;
            this.$menu.find('.active').removeClass('active');
            $(e.currentTarget).addClass('active');
        },

        mouseleave: function (e) {
            this.mousedover = false;
            //if (!this.focused && this.shown) this.hide();
        }

    };


    /* TYPEAHEAD PLUGIN DEFINITION
     * =========================== */

    var old = $.fn.typeahead;

    $.fn.typeahead = function (option) {
        var arg = arguments;
        if (typeof option == 'string' && option == 'getActive') {
            return this.data('active');
        }
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('typeahead')
                , options = typeof option == 'object' && option;
            if (!data) $this.data('typeahead', (data = new Typeahead(this, options)));
            if (typeof option == 'string') {
                if (arg.length > 1) {
                    data[option].apply(data, Array.prototype.slice.call(arg ,1));
                } else {
                    data[option]();
                }
            }
        });
    };

    $.fn.typeahead.defaults = {
        source: []
        , items: 8
        , menu: '<ul class="typeahead dropdown-menu" role="listbox"></ul>'
        , item: '<li><a href="#" role="option"></a></li>'
        , minLength: 1
        , scrollHeight: 0
        , autoSelect: true
        , afterSelect: $.noop
        , addItem: false
        , delay: 0
    };

    $.fn.typeahead.Constructor = Typeahead;


    /* TYPEAHEAD NO CONFLICT
     * =================== */

    $.fn.typeahead.noConflict = function () {
        $.fn.typeahead = old;
        return this;
    };


    /* TYPEAHEAD DATA-API
     * ================== */

    $(document).on('focus.typeahead.data-api', '[data-provide="typeahead"]', function (e) {
        var $this = $(this);
        if ($this.data('typeahead')) return;
        $this.typeahead($this.data());
    });

}));
/*jshint eqnull:true */
/*!
 * jQuery Cookie Plugin v1.2
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function ($, document, undefined) {

  var pluses = /\+/g;

  function raw(s) {
    return s;
  }

  function decoded(s) {
    return decodeURIComponent(s.replace(pluses, ' '));
  }

  $.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (value !== undefined && !/Object/.test(Object.prototype.toString.call(value))) {
      options = $.extend({}, $.cookie.defaults, options);

      if (value === null) {
        options.expires = -1;
      }

      if (typeof options.expires === 'number') {
        var days = options.expires, t = options.expires = new Date();
        t.setDate(t.getDate() + days);
      }

      value = String(value);

      return (document.cookie = [
        encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
        options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
        options.path    ? '; path=' + options.path : '',
        options.domain  ? '; domain=' + options.domain : '',
        options.secure  ? '; secure' : ''
      ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || $.cookie.defaults || {};
    var decode = options.raw ? raw : decoded;
    var cookies = document.cookie.split('; ');
    for (var i = 0, parts; (parts = cookies[i] && cookies[i].split('=')); i++) {
      if (decode(parts.shift()) === key) {
        return decode(parts.join('='));
      }
    }

    return null;
  };

  $.cookie.defaults = {};

  $.removeCookie = function (key, options) {
    if ($.cookie(key, options) !== null) {
      $.cookie(key, null, options);
      return true;
    }
    return false;
  };

})(jQuery, document);
/* liteUploader v2.1.2 | https://github.com/burt202/lite-uploader | Aaron Burtnyk (http://www.burtdev.net) */

$.fn.liteUploader = function (options) {
    var defaults = {
        script: null,
        rules: {
            allowedFileTypes: null,
            maxSize: null
        },
        params: {},
        changeHandler: true,
        clickElement: null
    };

    return this.each(function () {
        $.data(this, 'liteUploader', new LiteUploader(this, $.extend(defaults, options)));
    });
};

function LiteUploader (element, options) {
    this.el = $(element);
    this.options = options;
    this.params = options.params;
    this.xhr = this._buildXhrObject();

    this._init();
}

LiteUploader.prototype = {
    _init: function () {
        if (this.options.changeHandler) {
            this.el.change(function () {
                this._start();
            }.bind(this));
        }

        if (this.options.clickElement) {
            this.options.clickElement.click(function () {
                this._start();
            }.bind(this));
        }
    },

    _buildXhrObject: function () {
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener('progress', this._onProgress.bind(this), false);
        return xhr;
    },

    _onProgress: function (evt) {
        if (evt.lengthComputable) {
            this.el.trigger('lu:progress', Math.floor((evt.loaded / evt.total) * 100));
        }
    },

    _start: function () {
        var files = this.el.get(0).files;

        if (this._validateInput(files)) {
            this._resetInput();
            return;
        }

        if (this._validateFiles(files)) {
            this._resetInput();
            return;
        }

        this.el.trigger('lu:before', [files]);
        this._performUpload(this._collateFormData(files));
    },

    _resetInput: function () {
        this.el.val('');
    },

    _validateInput: function (files) {
        var errors = [];

        if (!this.el.attr('name')) {
            //errors.push('the file input element must have a name attribute');
        }

        if (!this.options.script) {
            errors.push('the script option is required');
        }

        /*if (files.length === 0) {
            errors.push('at least one file must be selected');
        }*/

        this.el.trigger('lu:errors', [[{
            name: 'liteUploader_input',
            errors: errors
        }]]);

        /*if (errors.length > 0) {
            return true;
        }*/
        return false;
    },

    _validateFiles: function (files) {
        var errorsPresent = false,
            errorReporter = [];

        $.each(files, function (i) {
            var errorsFound = this._findErrors(files[i]);

            errorReporter.push({
                name: files[i].name,
                errors: errorsFound
            });

            /*if (errorsFound.length > 0) {
                errorsPresent = true;
            }*/
        }.bind(this));

        this.el.trigger('lu:errors', [errorReporter]);
        return errorsPresent;
    },

    _findErrors: function (file) {
        var errorsArray = [];

        $.each(this.options.rules, function (key, value) {
            if (key === 'allowedFileTypes' && value && $.inArray(file.type, value.split(',')) === -1) {
                errorsArray.push({'type': 'type', 'rule': value, 'given': file.type});
            }

            if (key === 'maxSize' && value && file.size > value) {
                errorsArray.push({'type': 'size', 'rule': value, 'given': file.size});
            }
        });

        return errorsArray;
    },

    _getFormDataObject: function () {
        return new FormData();
    },

    _collateFormData: function (files) {
        var formData = this._getFormDataObject();

        if (this.el.attr('id')) {
            formData.append('liteUploader_id', this.el.attr('id'));
            formData.append('type_connect', this.el.attr('data-type_connect'));
            formData.append('type', this.el.attr('data-type'));
            formData.append('id_connect', this.el.attr('data-id_connect'));
            formData.append('param', this.el.attr('data-param'));
        }

        $.each(this.params, function (key, value) {
            formData.append(key, value);
        });

        $.each(files, function (i) {
            formData.append(this.el.attr('name'), files[i]);
        }.bind(this));

        return formData;
    },

    _performUpload: function (formData) {
        $.ajax({
            xhr: function () {
                return this.xhr;
            }.bind(this),
            url: this.options.script,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
            .done(function(response){
                this.el.trigger('lu:success', response);
            }.bind(this))
            .fail(function(jqXHR) {
                this.el.trigger('lu:fail', jqXHR);
            }.bind(this))
            .always(function() {
                this._resetInput();
            }.bind(this));
    },

    addParam: function (key, value) {
        this.params[key] = value;
    },

    cancelUpload: function () {
        this.xhr.abort();
        this.el.trigger('lu:cancelled');
        this._resetInput();
    }
};
(function ($) {
    // defining compatibility of upload control object
    var xhrUploadFlag = false;
    if (window.XMLHttpRequest) {
        var testXHR = new XMLHttpRequest();
        xhrUploadFlag = (testXHR.upload != null);
    }

    // utility object for checking browser compatibility
    $.extend($.support, {
        fileSelecting: (window.File != null) && (window.FileList != null),
        fileReading: (window.FileReader != null),
        fileSending: (window.FormData != null),
        uploadControl: xhrUploadFlag
    });

    // generating uniq id
    var uniq = function (length, prefix) {
        length = parseInt(length);
        prefix = prefix || '';
        if ((length == 0) || isNaN(length)) {
            return prefix;
        }
        var ch = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
        return prefix + ch + uniq(--length);
    };

    var checkIsFile = function (item) {
        return (item instanceof File) || (item instanceof Blob);
    };

    ////////////////////////////////////////////////////////////////////////////
    // plugin code
    $.fn.damnUploader = function (params) {

        if (this.length == 0) {
            return this;
        } else if (this.length > 1) {
            return this.each(function() {
                $(this).damnUploader(params);
            });
        }

        // context
        var self = this;

        // locals
        var queue = self._damnUploaderQueue;
        var set = self._damnUploaderSettings || {};

        ////////////////////////////////////////////////////////////////////////
        // initialization
        /* default settings */
        self._damnUploaderSettings = $.extend({
            url: '/admin/ajax/uploadImage',
            multiple: true,
            fieldName: 'file',
            dropping: true,
            dropBox: true,
            limit: false,
            onSelect: true,
            onLimitExceeded: false,
            onAllComplete: false
        }, params || {});

        /* private properties */
        self._damnUploaderQueue = {};
        self._damnUploaderItemsCount = 0;
        queue = self._damnUploaderQueue;
        set = self._damnUploaderSettings;

        /* private items-adding method */
        self._damnUploaderFilesAddMap = function (files, callback) {
            var callbackDefined = $.isFunction(callback);
            if (!$.support.fileSelecting) {
                if (self._damnUploaderItemsCount === set.limit) {
                    return $.isFunction(set.onLimitExceeded) ? set.onLimitExceeded.call(self) : false;
                }
                var file = {
                    fake: true,
                    name: files.value,
                    inputElement: files
                };
                if (callbackDefined) {
                    if (!callback.call(self, file)) {
                        return true;
                    }
                }
                self.duAdd(file);
                return true;
            }
            if (files instanceof FileList) {
                $.each(files, function (i, file) {
                    if (self._damnUploaderItemsCount === set.limit) {
                        if (self._damnUploaderItemsCount === set.limit) {
                            return $.isFunction(set.onLimitExceeded) ? set.onLimitExceeded.call(self) : false;
                        }
                    }
                    if (callbackDefined) {
                        if (!callback.call(self, file)) {
                            return true;
                        }
                    }
                    self.duAdd({ file: file });
                });
            }
            return true;
        };


        /* private file-uploading method */
        self._damnUploaderUploadItem = function (url, item) {
            if (!checkIsFile(item.file)) {
                return false;
            }
            var xhr = new XMLHttpRequest();
            var progress = 0;
            var uploaded = false;

            if (xhr.upload) {
                xhr.upload.addEventListener("progress", function (e) {
                    if (e.lengthComputable) {
                        progress = (e.loaded * 100) / e.total;
                        if ($.isFunction(item.onProgress)) {
                            item.onProgress.call(item, Math.round(progress));
                        }
                    }
                }, false);

                xhr.upload.addEventListener("load", function (e) {
                    progress = 100;
                    uploaded = true;
                }, false);
            } else {
                uploaded = true;
            }

            xhr.onreadystatechange = function () {
                var callbackDefined = $.isFunction(item.onComplete);
                if (this.readyState == 4) {
                    item.cancelled = item.cancelled || false;
                    if (this.status < 400) {
                        if (!uploaded) {
                            if (callbackDefined) {
                                item.onComplete.call(item, false, null, 0);
                            }
                        } else {
                            if ($.isFunction(item.onProgress)) {
                                item.onProgress.call(item, 100);
                            }
                            if (callbackDefined) {
                                item.onComplete.call(item, true, this.responseText);
                            }
                        }
                    } else {
                        if (callbackDefined) {
                            item.onComplete.call(item, false, null, this.status);
                        }
                    }
                }
            };

            var filename = item.replaceName || item.file.name;
            xhr.open("POST", url);

            if ($.support.fileSending) {
                // W3C (Chrome, Safari, Firefox 4+)
                var formData = new FormData();
                formData.append((item.fieldName || 'file'), item.file);
                var type_connect_image = $('#upload_images').attr('data-type_connect_image');
                var type_image = $('#upload_images').attr('data-type_image');
                var id_image = $('#upload_images').attr('data-id_image');
                var group_image = $('input[name=url]').val();
                formData.append("type[]", type_image);
                formData.append("type_connect[]", type_connect_image);
                formData.append("id_image[]", id_image);
                formData.append("group_image[]", group_image);
                xhr.send(formData);
            } else {
                // Other
                xhr.setRequestHeader('Upload-Filename', item.file.name);
                xhr.setRequestHeader('Upload-Size', item.file.size);
                xhr.setRequestHeader('Upload-Type', item.file.type);
                xhr.send(item.file);
            }
            item.xhr = xhr;
        };



        /* binding callbacks */
        var isFileField = ((self.get(0).tagName == 'INPUT') && (this.attr('type') == 'file'));

        if (isFileField) {
            var myName = self.eq(0).attr('name');
            if (!$.support.fileSelecting) {
                if (myName.charAt(myName.length - 1) != ']') {
                    myName += '[]';
                }
                self.attr('name', myName);
                self.attr('multiple', false);
                var action = self.parents('form').attr('action');
                self._damnUploaderFakeForm = $('<form/>').attr({
                    method: 'post',
                    enctype: 'multipart/form-data',
                    action: action
                }).hide().appendTo('body');
            } else {
                self.attr('multiple', true);
            }

            self._damnUploaderChangeCallback = function () {
                self._damnUploaderFilesAddMap($.support.fileSelecting ? this.files : this, set.onSelect);
            };

            self.on({
                change: self._damnUploaderChangeCallback
            });
        }

        if (set.dropping) {
            self.on({
                drop: function (e) {
                    self._damnUploaderFilesAddMap(e.originalEvent.dataTransfer.files, set.onSelect);
                    return false;
                }
            });
            if (set.dropBox) {
                $(set.dropBox).on({
                    drop: function (e) {
                        self._damnUploaderFilesAddMap(e.originalEvent.dataTransfer.files, set.onSelect);
                        return false;
                    }
                });
            }
        }

        self.duStart = function () {
            if (!set.url) {
                return self;
            }
            if (!$.support.fileSelecting) {
                self._damnUploaderFakeForm.submit();
                return self;
            }
            $.each(queue, function (queueId, item) {
                var compl = item.onComplete;
                item.fieldName = item.fieldName || set.fieldName;
                item.onComplete = function (successful, data, error) {
                    if (!this.cancelled) {
                        delete queue[queueId];
                        self._damnUploaderItemsCount--;
                    }
                    if ($.isFunction(compl)) {
                        compl.call(this, successful, data, error);
                    }
                    if ((self._damnUploaderItemsCount == 0) && ($.isFunction(set.onAllComplete))) {
                        set.onAllComplete.call(self);
                    }
                };
                self._damnUploaderUploadItem(set.url, item);
            });
            return self;
        };

        self.duCancel = function (queueId) {
            if (queueId && self._damnUploaderItemsCount > 0) {
                if (!$.support.fileSelecting) {
                    var removingItem = $('#' + queueId);
                    if (removingItem.length > 0) {
                        removingItem.remove();
                        self._damnUploaderItemsCount--;
                    }
                    return self;
                }

                if (queue[queueId] !== undefined) {
                    if (queue[queueId].xhr) {
                        queue[queueId].cancelled = true;
                        queue[queueId].xhr.abort();
                    }
                    delete queue[queueId];
                    self._damnUploaderItemsCount--;
                }
            }
            return self;
        };

        self.duCancelAll = function () {
            if (!$.support.fileSelecting) {
                self._damnUploaderItemsCount = 0;
                self._damnUploaderFakeForm.empty();
                return self;
            }
            $.each(queue, function (key, item) {
                self.duCancel(key);
            });
            return self;
        };

        self.duAdd = function (uploadItem) {
            if (!uploadItem || !uploadItem.file) {
                return false;
            }
            var queueId = uniq(5);

            if (uploadItem.file.fake) {
                var input = $(uploadItem.file.inputElement);
                var cloned = $(input).clone();
                $(input).before(cloned);
                $(input).attr('id', queueId);
                $(input).appendTo(self._damnUploaderFakeForm);
                cloned.on({
                    change: self._damnUploaderChangeCallback
                });
                self._damnUploaderItemsCount++;
                return queueId;
            }
            if (!checkIsFile(uploadItem.file)) {
                return false;
            }
            queue[queueId] = uploadItem;
            self._damnUploaderItemsCount++;
            return queueId;
        };

        self.duCount = function () {
            return self._damnUploaderItemsCount;
        };

        self.duOption = function (name, value) {
            var acceptParams = ['url', 'multiple', 'fieldName', 'limit'];
            if (value === undefined) {
                return self._damnUploaderSettings[name];
            }
            if ($.isPlainObject(name)) {
                $.each(name, function (key, val) {
                    self.duOption(key, val);
                });
            } else {
                $.inArray(name, acceptParams) && (self._damnUploaderSettings[key] = value);
            }
            return self;
        };


        return self;
    };
})(window.jQuery);

$(document).ready(function() {

    // Консоль
    var $console = $("#console");
    // Инфа о выбранных файлах
    var countInfo = $("#info-count");
    var sizeInfo = $("#info-size");
    // ul-список, содержащий миниатюрки выбранных файлов
    var imgList = $('#img-list');
    // Контейнер, куда можно помещать файлы методом drag and drop
    var dropBox = $('#dropbox');
    // Счетчик всех выбранных файлов и их размера
    var imgCount = 0;
    var imgSize = 0;
    // Стандарный input для файлов
    var fileInput = $('#file-field');

    ////////////////////////////////////////////////////////////////////////////
    // Подключаем и настраиваем плагин загрузки

    fileInput.damnUploader({
        // куда отправлять
        url: '/admin/ajax/uploadImage',
        // имитация имени поля с файлом (будет ключом в $_FILES, если используется PHP)
        fieldName:  'images',
        // дополнительно: элемент, на который можно перетащить файлы (либо объект jQuery, либо селектор)
        dropBox: dropBox,
        // максимальное кол-во выбранных файлов (если не указано - без ограничений)
        //limit: 20,
        autostartOn: true,
        // когда максимальное кол-во достигнуто (вызывается при каждой попытке добавить еще файлы)
        onLimitExceeded: function() {
            log('<div class="alert alert-danger">Допустимое кол-во файлов уже выбрано</div>');
        },
        // ручная обработка события выбора файла (в случае, если выбрано несколько, будет вызвано для каждого)
        // если обработчик возвращает true, файлы добавляются в очередь автоматически
        onSelect: function(file) {
            addFileToQueue(file);
            return false;
        },
        // когда все загружены
        onAllComplete: function() {
            log('<div class="alert alert-success">Все загрузки завершены!</div>');
            imgCount = 0;
            imgSize = 0;
            hidden_action('/admin/ajax/clearCache/true', false, false, false, false, false);
            updateInfo();
            addTriggerNew();
        }
    });

    ////////////////////////////////////////////////////////////////////////////
    // Вспомогательные функции
    // Вывод в консоль
    function log(str) {
        $('<p/>').html(str).prependTo($console);
        if (window.console !== undefined) {
            //window.
        }
    }

    // Вывод инфы о выбранных
    function updateInfo() {
        countInfo.text( (imgCount == 0) ? 'Изображений не выбрано' : ('Изображений выбрано: '+imgCount));
        sizeInfo.text( (imgSize == 0) ? '-' : Math.round(imgSize / 1024));
    }

    // Обновление progress bar'а
    function updateProgress(bar, value) {
        var width = bar.width();
        var bgrValue = -width + (value * (width / 100));
        bar.attr('rel', value).css('background-position', bgrValue+'px center').text(value+'%');
    }

    // Отображение выбраных файлов, создание миниатюр и ручное добавление в очередь загрузки.
    function addFileToQueue(file) {

        // Создаем элемент li и помещаем в него название, миниатюру и progress bar
        var li = $('<li/>').appendTo(imgList);
        var title = $('<div/>').text(file.name+' ').attr({class: 'upload-list-item'}).appendTo(li);
        var cancelButton = $('<a/>').attr({
            href: '#cancel',
            title: 'отменить',
            class: 'btn btn-small remove-upload-list'
        }).text('X').appendTo(title);

        // Если браузер поддерживает выбор файлов (иначе передается специальный параметр fake,
        // обозночающий, что переданный параметр на самом деле лишь имитация настоящего File)
        if(!file.fake) {

            // Отсеиваем не картинки
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                log('Файл отсеян: `'+file.name+'` (тип '+file.type+')');
                return true;
            }

            // Добавляем картинку и прогрессбар в текущий элемент списка
            var img = $('<img/>').appendTo(li);
            var pBar = $('<div/>').addClass('progress').attr('rel', '0').text('0%').appendTo(li);

            // Создаем объект FileReader и по завершении чтения файла, отображаем миниатюру и обновляем
            // инфу обо всех файлах (только в браузерах, подерживающих FileReader)
            if($.support.fileReading) {
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.attr('src', e.target.result);
                        aImg.attr('width', 150);
                    };
                })(img);
                reader.readAsDataURL(file);
            }

            //log('Картинка добавлена: `'+file.name + '` (' +Math.round(file.size / 1024) + ' Кб)');
            imgSize += file.size;
        } else {
            //log('Файл добавлен: '+file.name);
        }

        imgCount++;
        $('#actions').removeClass('hidden');
        updateInfo();

        // Создаем объект загрузки
        var uploadItem = {
            file: file,
            onProgress: function(percents) {
                updateProgress(pBar, percents);
            },
            onComplete: function(successfully, data, errorCode) {
                if(successfully) {
                    $('#img-list').html('');
                    log('<div class="alert alert-success">Файл `'+this.file.name+'` загружен</div>'+data+'<br/>');
                } else {
                    if(!this.cancelled) {
                        log('<div class="alert alert-error">Файл `'+this.file.name+'`: ошибка при загрузке. Код: '+errorCode+'</div>');
                    }
                }
            }
        };

        // ... и помещаем его в очередь
        var queueId = fileInput.duAdd(uploadItem);

        // обработчик нажатия ссылки "отмена"
        cancelButton.click(function() {
            //fileInput.trigger('uploader.test', queueId);
            //fileInput.damnUploader('cancel', queueId);
            //fileInput.trigger('uploader.cancel', queueId);
            fileInput.duCancel(queueId);
            li.remove();
            imgCount--;
            imgSize -= file.fake ? 0 : file.size;
            updateInfo();
            log(file.name+' удален из очереди');
            return false;
        });
        return uploadItem;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Обработчики событий
    // Обработка событий drag and drop при перетаскивании файлов на элемент dropBox
    dropBox.bind({
        dragenter: function() {
            $(this).addClass('highlighted');
            return false;
        },
        dragover: function() {
            return false;
        },
        dragleave: function() {
            $(this).removeClass('highlighted');
            return false;
        }
    });

    // Обаботка события нажатия на кнопку "Загрузить все".
    // стартуем все загрузки
    $("#upload-all").click(function() {
        fileInput.duStart();
    });

    // Обработка события нажатия на кнопку "Отменить все"
    $("#cancel-all").click(function() {
        fileInput.duCancelAll();
        imgCount = 0;
        imgSize = 0;
        updateInfo();
        log('*** Все загрузки отменены ***');
        imgList.empty();
        $('#actions').addClass('hidden');
    });

    function addTriggerNew(){
        //
        $('.upload_images_trumbs_item_new').find('.image_group').focusout(function(){
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'param';
            var table = 'images';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Группа картинки изменена', false, false, false);
        });
        /* Изменение веса картинки */
        $('.upload_images_trumbs_item_new').find('.image_position').focusout(function(){
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'position';
            var table = 'images';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, false);
        });

        /* Изменение описания картинки */
        $('.upload_images_trumbs_item_new').find('.image_description').focusout(function(){
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'description';
            var table = 'images';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Описание картинки изменено', false, false, false);
        });

        /* Удаление загруженной картинки */
        $('.upload_images_trumbs_item_new').find('.delete_image').on('click', function(){
            if (confirm('Точно удалить из материала?')) {
                var clear = 'false';
                if (confirm('Удалить с сервера?')) {
                    clear = 'true';
                }
                var id = $(this).attr('data-imageid');
                var table = $(this).attr('data-table');
                var name = $(this).attr('alt');
                var id_content = $(this).attr('data-id_content');
                var row = $(this).parent().parent();
                var row_desc = $(row).next('.uploaded_image_desc');
                var data = {id: id, clear: clear, table: table, id_content: id_content, name: name};
                //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
                hidden_action('/admin/ajax/deletePicture', data, 'Фото удалено', false, false, true);

                $(row).fadeOut('slow');
                $(row).parents('.upload_images_trumbs_item').fadeOut('slow');
                $(row).parents('.upload_images_trumbs_item').next().next().fadeOut('slow');
                $(row_desc).fadeOut('slow');
            }
        });
    }

    /**
     * Метод для выполнения ajax-операций
     * string       @param url              URL для вызова
     * array        @param send_data        Пересылаемые данные /false
     * bool/string  @param good_message     Кастомное сообщение об успехе операции /false
     * object       @param button           объект с кнопкой, на которую нажали /false
     * bool/string  @param redirect_url     Если передан string с адресом страницы, то будет выполнен редирект /false
     * bool         @param clearcache       Если true, то очистит кеш сайта /false
     */
    function hidden_action(url, send_data, good_message, button, redirect_url) {
        var request = $.ajax({
            data: send_data,
            type: "POST",
            dataType: "json",
            url: url
        });
        request.done(function (msg) {
            if(msg.blank){
                return false;
            }
            if(msg.good){
                if ((good_message !== false) && (good_message !== undefined)) {
                    notify_show('success', good_message);
                }else{
                    notify_show('success', msg.good);
                }
            }
            if(good_message !== false){
                if(msg.error){
                    notify_show('success', msg.error);
                    return false;
                }
            }
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            if ((redirect_url !== false) && (redirect_url !== undefined)) {
                window.location = redirect_url;
            }
            return true;
        });
        request.fail(function (jqXHR, status, statusText) {
            //
            if(status == 'parsererror'){
                notify_show('success', 'Ничего не произошло');
                return false;
            }
            notify_show('error', statusText);
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            //
            return false;

        });
    }

    /* Подгрузка существующих галерей */
    $('#exist_gallery').change(function(){
        $("#my_select :selected").remove();
        var param = $('#exist_gallery option:selected').val();
        var request = $.ajax({
            data: {param: param},
            type: "POST",
            url: '/admin/ajax/getImageGallery'
        });
        request.done(function (msg) {
            $('#console').after('<div class="clearfix"></div><br/> '+msg);
            addTriggerNew();
            notify_show('success', 'Галерея подгружена');
            $('#upload_images_trumbs').find('.alert').hide();
        });
        request.fail(function(){
            notify_show('error', 'Галерею не удалось подгрузить');
        })
    });

    /**
     * Уведомления в сплывающих окнах от процессов
     * string @param type  Тип события (good, error)
     * string @param message   Сообщение на вывод
     */
    function notify_show(type, message) {
        if(type == 'error'){
            noty({
                text: message,
                type: type,
                layout: 'top'
            });
        }else{
            noty({
                text: message,
                type: type,
                layout: 'topRight'
            });
        }
    }
});
(function ($) {
    // defining compatibility of upload control object
    var xhrUploadFlag = false;
    if (window.XMLHttpRequest) {
        var testXHR = new XMLHttpRequest();
        xhrUploadFlag = (testXHR.upload != null);
    }

    // utility object for checking browser compatibility
    $.extend($.support, {
        fileSelecting: (window.File != null) && (window.FileList != null),
        fileReading: (window.FileReader != null),
        fileSending: (window.FormData != null),
        uploadControl: xhrUploadFlag
    });

    // generating uniq id
    var uniq = function (length, prefix) {
        length = parseInt(length);
        prefix = prefix || '';
        if ((length == 0) || isNaN(length)) {
            return prefix;
        }
        var ch = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
        return prefix + ch + uniq(--length);
    };

    var checkIsFile = function (item) {
        return (item instanceof File) || (item instanceof Blob);
    };

    ////////////////////////////////////////////////////////////////////////////
    // plugin code
    $.fn.damnUploader2 = function (params) {

        if (this.length == 0) {
            return this;
        } else if (this.length > 1) {
            return this.each(function() {
                $(this).damnUploader2(params);
            });
        }

        // context
        var self = this;

        // locals
        var queue = self._damnUploader2Queue;
        var set = self._damnUploader2Settings || {};

        ////////////////////////////////////////////////////////////////////////
        // initialization
        /* default settings */
        self._damnUploader2Settings = $.extend({
            url: '/admin/ajax/uploadImagesb',
            multiple: true,
            fieldName: 'file',
            dropping: true,
            dropBox: true,
            limit: false,
            onSelect: true,
            onLimitExceeded: false,
            onAllComplete: false
        }, params || {});


        /* private properties */
        self._damnUploader2Queue = {};
        self._damnUploader2ItemsCount = 0;
        queue = self._damnUploader2Queue;
        set = self._damnUploader2Settings;

        /* private items-adding method */
        self._damnUploader2FilesAddMap = function (files, callback) {
            var callbackDefined = $.isFunction(callback);
            if (!$.support.fileSelecting) {
                if (self._damnUploader2ItemsCount === set.limit) {
                    return $.isFunction(set.onLimitExceeded) ? set.onLimitExceeded.call(self) : false;
                }
                var file = {
                    fake: true,
                    name: files.value,
                    inputElement: files
                };
                if (callbackDefined) {
                    if (!callback.call(self, file)) {
                        return true;
                    }
                }
                self.duAdd(file);
                return true;
            }
            if (files instanceof FileList) {
                $.each(files, function (i, file) {
                    if (self._damnUploader2ItemsCount === set.limit) {
                        if (self._damnUploader2ItemsCount === set.limit) {
                            return $.isFunction(set.onLimitExceeded) ? set.onLimitExceeded.call(self) : false;
                        }
                    }
                    if (callbackDefined) {
                        if (!callback.call(self, file)) {
                            return true;
                        }
                    }
                    self.duAdd({ file: file });
                });
            }
            return true;
        };


        /* private file-uploading method */
        self._damnUploader2UploadItem = function (url, item) {
            if (!checkIsFile(item.file)) {
                return false;
            }
            var xhr = new XMLHttpRequest();
            var progress = 0;
            var uploaded = false;

            if (xhr.upload) {
                xhr.upload.addEventListener("progress", function (e) {
                    if (e.lengthComputable) {
                        progress = (e.loaded * 100) / e.total;
                        if ($.isFunction(item.onProgress)) {
                            item.onProgress.call(item, Math.round(progress));
                        }
                    }
                }, false);

                xhr.upload.addEventListener("load", function (e) {
                    progress = 100;
                    uploaded = true;
                }, false);
            } else {
                uploaded = true;
            }

            xhr.onreadystatechange = function () {
                var callbackDefined = $.isFunction(item.onComplete);
                if (this.readyState == 4) {
                    item.cancelled = item.cancelled || false;
                    if (this.status < 400) {
                        if (!uploaded) {
                            if (callbackDefined) {
                                item.onComplete.call(item, false, null, 0);
                            }
                        } else {
                            if ($.isFunction(item.onProgress)) {
                                item.onProgress.call(item, 100);
                            }
                            if (callbackDefined) {
                                item.onComplete.call(item, true, this.responseText);
                            }
                        }
                    } else {
                        if (callbackDefined) {
                            item.onComplete.call(item, false, null, this.status);
                        }
                    }
                }
            };

            var filename = item.replaceName || item.file.name;
            xhr.open("POST", url);

            if ($.support.fileSending) {
                // W3C (Chrome, Safari, Firefox 4+)
                var formData = new FormData();
                formData.append((item.fieldName || 'file'), item.file);
                var type_connect_image = $('#upload_images2').attr('data-type_connect_image');
                var type_image = $('#upload_images2').attr('data-type_image');
                var id_image = $('#upload_images2').attr('data-id_image');
                var group_image = $('input[name=url]').val();
                formData.append("type[]", type_image);
                formData.append("type_connect[]", type_connect_image);
                formData.append("id_image[]", id_image);
                formData.append("group_image[]", group_image);
                xhr.send(formData);
            } else {
                // Other
                xhr.setRequestHeader('Upload-Filename', item.file.name);
                xhr.setRequestHeader('Upload-Size', item.file.size);
                xhr.setRequestHeader('Upload-Type', item.file.type);
                xhr.send(item.file);
            }
            item.xhr = xhr;
        };



        /* binding callbacks */
        var isFileField = ((self.get(0).tagName == 'INPUT') && (this.attr('type') == 'file'));

        if (isFileField) {
            var myName = self.eq(0).attr('name');
            if (!$.support.fileSelecting) {
                if (myName.charAt(myName.length - 1) != ']') {
                    myName += '[]';
                }
                self.attr('name', myName);
                self.attr('multiple', false);
                var action = self.parents('form').attr('action');
                self._damnUploader2FakeForm = $('<form/>').attr({
                    method: 'post',
                    enctype: 'multipart/form-data',
                    action: action
                }).hide().appendTo('body');
            } else {
                self.attr('multiple', true);
            }

            self._damnUploader2ChangeCallback = function () {
                self._damnUploader2FilesAddMap($.support.fileSelecting ? this.files : this, set.onSelect);
            };

            self.on({
                change: self._damnUploader2ChangeCallback
            });
        }

        if (set.dropping) {
            self.on({
                drop: function (e) {
                    self._damnUploader2FilesAddMap(e.originalEvent.dataTransfer.files, set.onSelect);
                    return false;
                }
            });
            if (set.dropBox) {
                $(set.dropBox).on({
                    drop: function (e) {
                        self._damnUploader2FilesAddMap(e.originalEvent.dataTransfer.files, set.onSelect);
                        return false;
                    }
                });
            }
        }

        self.duStart = function () {
            if (!set.url) {
                return self;
            }
            if (!$.support.fileSelecting) {
                self._damnUploader2FakeForm.submit();
                return self;
            }
            $.each(queue, function (queueId, item) {
                var compl = item.onComplete;
                item.fieldName = item.fieldName || set.fieldName;
                item.onComplete = function (successful, data, error) {
                    if (!this.cancelled) {
                        delete queue[queueId];
                        self._damnUploader2ItemsCount--;
                    }
                    if ($.isFunction(compl)) {
                        compl.call(this, successful, data, error);
                    }
                    if ((self._damnUploader2ItemsCount == 0) && ($.isFunction(set.onAllComplete))) {
                        set.onAllComplete.call(self);
                    }
                };
                self._damnUploader2UploadItem(set.url, item);
            });
            return self;
        };

        self.duCancel = function (queueId) {
            if (queueId && self._damnUploader2ItemsCount > 0) {
                if (!$.support.fileSelecting) {
                    var removingItem = $('#' + queueId);
                    if (removingItem.length > 0) {
                        removingItem.remove();
                        self._damnUploader2ItemsCount--;
                    }
                    return self;
                }

                if (queue[queueId] !== undefined) {
                    if (queue[queueId].xhr) {
                        queue[queueId].cancelled = true;
                        queue[queueId].xhr.abort();
                    }
                    delete queue[queueId];
                    self._damnUploader2ItemsCount--;
                }
            }
            return self;
        };

        self.duCancelAll = function () {
            if (!$.support.fileSelecting) {
                self._damnUploader2ItemsCount = 0;
                self._damnUploader2FakeForm.empty();
                return self;
            }
            $.each(queue, function (key, item) {
                self.duCancel(key);
            });
            return self;
        };

        self.duAdd = function (uploadItem) {
            if (!uploadItem || !uploadItem.file) {
                return false;
            }
            var queueId = uniq(5);

            if (uploadItem.file.fake) {
                var input = $(uploadItem.file.inputElement);
                var cloned = $(input).clone();
                $(input).before(cloned);
                $(input).attr('id', queueId);
                $(input).appendTo(self._damnUploader2FakeForm);
                cloned.on({
                    change: self._damnUploader2ChangeCallback
                });
                self._damnUploader2ItemsCount++;
                return queueId;
            }
            if (!checkIsFile(uploadItem.file)) {
                return false;
            }
            queue[queueId] = uploadItem;
            self._damnUploader2ItemsCount++;
            return queueId;
        };

        self.duCount = function () {
            return self._damnUploader2ItemsCount;
        };

        self.duOption = function (name, value) {
            var acceptParams = ['url', 'multiple', 'fieldName', 'limit'];
            if (value === undefined) {
                return self._damnUploader2Settings[name];
            }
            if ($.isPlainObject(name)) {
                $.each(name, function (key, val) {
                    self.duOption(key, val);
                });
            } else {
                $.inArray(name, acceptParams) && (self._damnUploader2Settings[key] = value);
            }
            return self;
        };


        return self;
    };
})(window.jQuery);

$(document).ready(function() {

    // Консоль
    var $console = $("#console2");
    // Инфа о выбранных файлах
    var countInfo = $("#info-count2");
    var sizeInfo = $("#info-size2");
    // ul-список, содержащий миниатюрки выбранных файлов
    var imgList = $('#img-list2');
    // Контейнер, куда можно помещать файлы методом drag and drop
    var dropBox = $('#dropbox2');
    // Счетчик всех выбранных файлов и их размера
    var imgCount = 0;
    var imgSize = 0;
    // Стандарный input для файлов
    var fileInput = $('#file-field2');

    ////////////////////////////////////////////////////////////////////////////
    // Подключаем и настраиваем плагин загрузки

    fileInput.damnUploader2({
        // куда отправлять
        url: '/admin/ajax/uploadImagesb',
        // имитация имени поля с файлом (будет ключом в $_FILES, если используется PHP)
        fieldName:  'images2',
        // дополнительно: элемент, на который можно перетащить файлы (либо объект jQuery, либо селектор)
        dropBox: dropBox,
        // максимальное кол-во выбранных файлов (если не указано - без ограничений)
        //limit: 20,
        autostartOn: true,
        // когда максимальное кол-во достигнуто (вызывается при каждой попытке добавить еще файлы)
        onLimitExceeded: function() {
            log('<div class="alert alert-danger">Допустимое кол-во файлов уже выбрано</div>');
        },
        // ручная обработка события выбора файла (в случае, если выбрано несколько, будет вызвано для каждого)
        // если обработчик возвращает true, файлы добавляются в очередь автоматически
        onSelect: function(file) {
            addFileToQueue(file);
            return false;
        },
        // когда все загружены
        onAllComplete: function() {
            log('<div class="alert alert-success">Все загрузки завершены!</div>');
            imgCount = 0;
            imgSize = 0;
            hidden_action('/admin/ajax/clearCache/true', false, false, false, false, false);
            updateInfo();
            addTriggerNew();
        }
    });

    ////////////////////////////////////////////////////////////////////////////
    // Вспомогательные функции
    // Вывод в консоль
    function log(str) {
        $('<p/>').html(str).prependTo($console);
        if (window.console !== undefined) {
            //window.
        }
    }

    // Вывод инфы о выбранных
    function updateInfo() {
        countInfo.text( (imgCount == 0) ? 'Изображений не выбрано' : ('Изображений выбрано: '+imgCount));
        sizeInfo.text( (imgSize == 0) ? '-' : Math.round(imgSize / 1024));
    }

    // Обновление progress bar'а
    function updateProgress(bar, value) {
        var width = bar.width();
        var bgrValue = -width + (value * (width / 100));
        bar.attr('rel', value).css('background-position', bgrValue+'px center').text(value+'%');
    }

    // Отображение выбраных файлов, создание миниатюр и ручное добавление в очередь загрузки.
    function addFileToQueue(file) {

        // Создаем элемент li и помещаем в него название, миниатюру и progress bar
        var li = $('<li/>').appendTo(imgList);
        var title = $('<div/>').text(file.name+' ').attr({class: 'upload-list-item'}).appendTo(li);
        var cancelButton = $('<a/>').attr({
            href: '#cancel',
            title: 'отменить',
            class: 'btn btn-small remove-upload-list'
        }).text('X').appendTo(title);

        // Если браузер поддерживает выбор файлов (иначе передается специальный параметр fake,
        // обозночающий, что переданный параметр на самом деле лишь имитация настоящего File)
        if(!file.fake) {

            // Отсеиваем не картинки
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                log('Файл отсеян: `'+file.name+'` (тип '+file.type+')');
                return true;
            }

            // Добавляем картинку и прогрессбар в текущий элемент списка
            var img = $('<img/>').appendTo(li);
            var pBar = $('<div/>').addClass('progress').attr('rel', '0').text('0%').appendTo(li);

            // Создаем объект FileReader и по завершении чтения файла, отображаем миниатюру и обновляем
            // инфу обо всех файлах (только в браузерах, подерживающих FileReader)
            if($.support.fileReading) {
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.attr('src', e.target.result);
                        aImg.attr('width', 150);
                    };
                })(img);
                reader.readAsDataURL(file);
            }

            //log('Картинка добавлена: `'+file.name + '` (' +Math.round(file.size / 1024) + ' Кб)');
            imgSize += file.size;
        } else {
            //log('Файл добавлен: '+file.name);
        }

        imgCount++;
        $('#actions2').removeClass('hidden');
        updateInfo();

        // Создаем объект загрузки
        var uploadItem = {
            file: file,
            onProgress: function(percents) {
                updateProgress(pBar, percents);
            },
            onComplete: function(successfully, data, errorCode) {
                if(successfully) {
                    $('#img-list2').html('');
                    log('<div class="alert alert-success">Файл `'+this.file.name+'` загружен</div>'+data+'<br/>');
                } else {
                    if(!this.cancelled) {
                        log('<div class="alert alert-error">Файл `'+this.file.name+'`: ошибка при загрузке. Код: '+errorCode+'</div>');
                    }
                }
            }
        };

        // ... и помещаем его в очередь
        var queueId = fileInput.duAdd(uploadItem);

        // обработчик нажатия ссылки "отмена"
        cancelButton.click(function() {
            //fileInput.trigger('uploader.test', queueId);
            //fileInput.damnUploader2('cancel', queueId);
            //fileInput.trigger('uploader.cancel', queueId);
            fileInput.duCancel(queueId);
            li.remove();
            imgCount--;
            imgSize -= file.fake ? 0 : file.size;
            updateInfo();
            log(file.name+' удален из очереди');
            return false;
        });
        return uploadItem;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Обработчики событий
    // Обработка событий drag and drop при перетаскивании файлов на элемент dropBox
    dropBox.bind({
        dragenter: function() {
            $(this).addClass('highlighted');
            return false;
        },
        dragover: function() {
            return false;
        },
        dragleave: function() {
            $(this).removeClass('highlighted');
            return false;
        }
    });

    // Обаботка события нажатия на кнопку "Загрузить все".
    // стартуем все загрузки
    $("#upload-all2").click(function() {
        fileInput.duStart();
    });

    // Обработка события нажатия на кнопку "Отменить все"
    $("#cancel-all2").click(function() {
        fileInput.duCancelAll();
        imgCount = 0;
        imgSize = 0;
        updateInfo();
        log('*** Все загрузки отменены ***');
        imgList.empty();
        $('#actions2').addClass('hidden');
    });

    function addTriggerNew(){
        //
        $('.upload_images_trumbs_item_new').find('.image_group').focusout(function(){
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'param';
            var table = 'images';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Группа картинки изменена', false, false, false);
        });
        /* Изменение веса картинки */
        $('.upload_images_trumbs_item_new').find('.image_position').focusout(function(){
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'position';
            var table = 'images';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, false);
        });

        /* Изменение описания картинки */
        $('.upload_images_trumbs_item_new').find('.image_description').focusout(function(){
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'description';
            var table = 'images';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Описание картинки изменено', false, false, false);
        });

        /* Удаление загруженной картинки */
        $('.upload_images_trumbs_item_new').find('.delete_image').on('click', function(){
            if (confirm('Точно удалить из материала?')) {
                var clear = 'false';
                if (confirm('Удалить с сервера?')) {
                    clear = 'true';
                }
                var id = $(this).attr('data-imageid');
                var table = $(this).attr('data-table');
                var name = $(this).attr('alt');
                var id_content = $(this).attr('data-id_content');
                var row = $(this).parent().parent();
                var row_desc = $(row).next('.uploaded_image_desc');
                var data = {id: id, clear: clear, table: table, id_content: id_content, name: name};
                //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
                hidden_action('/admin/ajax/deletePicture', data, 'Фото удалено', false, false, true);

                $(row).fadeOut('slow');
                $(row).parents('.upload_images_trumbs_item').fadeOut('slow');
                $(row).parents('.upload_images_trumbs_item').next().next().fadeOut('slow');
                $(row_desc).fadeOut('slow');
            }
        });
    }

    /**
     * Метод для выполнения ajax-операций
     * string       @param url              URL для вызова
     * array        @param send_data        Пересылаемые данные /false
     * bool/string  @param good_message     Кастомное сообщение об успехе операции /false
     * object       @param button           объект с кнопкой, на которую нажали /false
     * bool/string  @param redirect_url     Если передан string с адресом страницы, то будет выполнен редирект /false
     * bool         @param clearcache       Если true, то очистит кеш сайта /false
     */
    function hidden_action(url, send_data, good_message, button, redirect_url) {
        var request = $.ajax({
            data: send_data,
            type: "POST",
            dataType: "json",
            url: url
        });
        request.done(function (msg) {
            if(msg.blank){
                return false;
            }
            if(msg.good){
                if ((good_message !== false) && (good_message !== undefined)) {
                    notify_show('success', good_message);
                }else{
                    notify_show('success', msg.good);
                }
            }
            if(good_message !== false){
                if(msg.error){
                    notify_show('success', msg.error);
                    return false;
                }
            }
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            if ((redirect_url !== false) && (redirect_url !== undefined)) {
                window.location = redirect_url;
            }
            return true;
        });
        request.fail(function (jqXHR, status, statusText) {
            //
            if(status == 'parsererror'){
                notify_show('success', 'Ничего не произошло');
                return false;
            }
            notify_show('error', statusText);
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            //
            return false;

        });
    }

    /* Подгрузка существующих галерей */
    $('#exist_gallery2').change(function(){
        $("#my_select2 :selected").remove();
        var param = $('#exist_gallery2 option:selected').val();
        var request = $.ajax({
            data: {param: param},
            type: "POST",
            url: '/admin/ajax/getImageGallery'
        });
        request.done(function (msg) {
            $('#console2').after('<div class="clearfix"></div><br/> '+msg);
            addTriggerNew();
            notify_show('success', 'Галерея подгружена');
            $('#upload_images_trumbs2').find('.alert').hide();
        });
        request.fail(function(){
            notify_show('error', 'Галерею не удалось подгрузить');
        })
    });

    /**
     * Уведомления в сплывающих окнах от процессов
     * string @param type  Тип события (good, error)
     * string @param message   Сообщение на вывод
     */
    function notify_show(type, message) {
        if(type == 'error'){
            noty({
                text: message,
                type: type,
                layout: 'top'
            });
        }else{
            noty({
                text: message,
                type: type,
                layout: 'topRight'
            });
        }
    }
});
$(document).ready(function(){
    paceOptions = {
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: true
    };

    //$('.typeahead').typeahead();
    $('*[data-toggle=tooltip]').tooltip();
    $('input[type=file]').bootstrapFileInput();

    $('input[name=date], input.date').pickadate({
        monthSelector: true,
        yearSelector: true,
        formatSubmit: 'yyyy-mm-dd',
        firstDay: 1,
        monthsFull: [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        weekdaysShort: [ 'Вск', 'Пон', 'Вт', 'Ср', 'Чт', 'Пт', 'Суб' ],
        format: 'yyyy-mm-dd'
    });

    $('#r-row-user_name').change(function(){
        $('input[name=user_phone]').removeClass('notEmpty').parent().parent().parent().removeClass('has-error');
        valid_forms();
    });

    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    };
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    /* Импорт ImportCSV4 */
    $('.start_import_category').click(function(){
        var row_success = 0;
        var row_error = 0;
        var count_import = 0;
        var count_import_complete = 0;

        Pace.restart();
        notify_show('message', 'Импорт запущен');

        $('.import_js_category').each(function(){
            var row_table = $(this);
            row_table.removeClass('alert-success').removeClass('alert-danger').addClass('alert-info');
            var type = $(this).attr('data-type');
            var row = $(this).attr('data-row');

            //
            if(type === 'category'){
                ++count_import;
                var request = $.ajax({
                    data: {row: row},
                    type: "POST",
                    dataType: "json",
                    async: false,
                    url: '/api/catalog/'+type +'/add?key=446dgkv4G4v990'
                });
                request.done(function (message) {
                    //
                    if(message.code == 'success'){
                        row_success = row_success +1;
                        row_table.addClass('alert-success');
                        //notify_show('message', message.header)
                    }else{
                        row_error = row_error +1;
                        
                        row_table.addClass('alert-danger');
                        //notify_show('error', message.header)
                    }
                });
                request.fail(function(message){
                    row_error = row_error +1;
                    
                    row_table.addClass('alert-danger');
                    //notify_show('error', 'Запрос к API провалился')
                });
                request.complete(function(){
                    ++count_import_complete;
                    if(count_import_complete === count_import){
                        if(count_import !== row_success){
                            notify_show('error', 'Импорт раздела прошел с ошибками: '+ row_error +'/'+ count_import)
                        }else{
                            //notify_show('message', 'Импорт раздела завершен: '+ count_import +'/'+ count_import)
                        }
                    }
                })
            }
        });
        notify_show('message', 'Импорт раздела завершен:')
    });

    $('.start_import_tovar').click(function(){
        var row_success = 0;
        var row_error = 0;
        var count_import = 0;
        var count_import_complete = 0;

        Pace.restart();
        notify_show('message', 'Импорт запущен');

        $('.import_js').each(function(){
            var row_table = $(this);
            var type = $(this).attr('data-type');
            var row = $(this).attr('data-row');
            row_table.removeClass('hidden').removeClass('alert-success').removeClass('alert-danger');
            //
            if(type === 'tovar'){
                ++count_import;
                var request = $.ajax({
                    data: {row: row},
                    type: "POST",
                    //async: false,
                    dataType: "json",
                    url: '/api/catalog/'+type +'/add?key=446dgkv4G4v990'
                });
                request.done(function (message) {
                    //
                    if(message.code == 'success'){
                        row_success = row_success +1;
                        row_table.addClass('alert-success');
                        //notify_show('message', message.header)
                    }
                    if(message.code == 'error'){
                        row_table.removeClass('hidden');
                        row_error = row_error +1;
                        
                        row_table.addClass('alert-danger');
                        //notify_show('error', message.header)
                        row_table.show();
                    }
                });
                request.fail(function(message){
                    row_error = row_error +1;
                    
                    row_table.addClass('alert-danger');
                    //notify_show('error', 'Запрос к API провалился');
                    row_table.show();
                });
                request.complete(function(){
                    ++count_import_complete;
                    if(count_import_complete === count_import){
                        if(count_import !== row_success){
                            notify_show('error', 'Импорт товаров раздела прошел с ошибками: '+ row_error +'/'+ count_import)
                        }else{
                            notify_show('message', 'Импорт товаров раздела завершен: '+ count_import +'/'+ count_import)
                        }
                    }
                })
            }
        });
    });

    $('pre.accordion').each(function(){
        $(this).css('height', '100px');
        $(this).css('opacity', '.4');
        $(this).click(function(){
            $(this).css('height', 'auto');
            $(this).css('opacity', '1');
        });
    });

    $('.show-rows').hide();
    $('.show-rows-settings').click(function(){
        $('.show-rows').show();
    });

    /*
     * Универсальный обработчик для выделения блока как ссылки
     * Ищет внутри блока ссылку и присваивает ее всему блоку
     */
    $('.link_block').click(function(){window.location = $(this).find('a').attr('href');});
    $('.link_block_this').click(function(){window.location = $(this).attr('data-href');});

    $('.show-please').click(function(){
        var target = $(this).attr('data-target');
        $('.'+ target).removeClass('hidden');
        $(this).remove();
    });

    /** TREE */
    $('.catalog_tree').find('.active')
        .parent('ul').prev('li').addClass('active')
        .parent('ul').prev('li').addClass('active');

    /** Сохранение настроек меню в админке */
    $('.navbar-minimalize').click(function(){
        var request = $.ajax({
            data: {settings_key: 'sidebar', settings_value: 'mini'},
            type: "POST",
            url: '/adminmodule/moduleadminmenu/settings'
        });
        request.done(function () {
            $('body').removeClass('gorizont-navbar');
            notify_show('message', 'Настройки обновлены')
        });
    });

    $('.navbar-max').click(function(){
        var request = $.ajax({
            data: {settings_key: 'sidebar', settings_value: 'full'},
            type: "POST",
            url: '/adminmodule/moduleadminmenu/settings'
        });
        request.done(function () {
            $('body').removeClass('mini-navbar').removeClass('gorizont-navbar');
            notify_show('message', 'Настройки обновлены')
        });
    });

    $('.navbar-gorizont').click(function(){
        var request = $.ajax({
            data: {settings_key: 'sidebar', settings_value: 'gorizont'},
            type: "POST",
            url: '/adminmodule/moduleadminmenu/settings'
        });
        request.done(function () {
            $('body').removeClass('mini-navbar').addClass('gorizont-navbar');
            notify_show('message', 'Настройки обновлены')
        });
    });
    $('.gorizont-navbar').find('.nav-second-level.collapse.in').removeClass('in');

    //Показ/скрытие полей в корзине в админке
    $('.show-hidden-rows').click(function(){
        $(this).hide();
        var id = $(this).attr('data-id');
        $('.hidden-full').toggleClass('hidden-full');
        $('.small-full').removeClass('small-full');
        $('.rows-'+id).removeClass('hidden-full');
        $('.project-list').find('.collapse').show();
    });
    $('.show_full').click(function(){
        var target = $(this).attr('data-id');
        $('.order-id-'+target).find('.hidden-full').toggleClass('show');
        $('.order-id-'+target).find('.collapse').toggleClass('show');
    });

    //Подгрузка выбранных товаров (добавление товара в корзине в админке)
    $('.row-items').find('.chosen-drop').click(function(){
        var tovars_chosen = [];
        $(this).parent().find('.search-choice').find('span').each(function(){
            if($(this).find('span').html() === undefined){
                tovars_chosen.push($(this).html());
            }
        });
        var request = $.ajax({
            data: {tovars: tovars_chosen},
            type: "POST",
            url: '/admin/ajax/getTovars'
        });
        request.done(function (msg) {
            $('.data-ajax').html(msg);
            delete_tovar_ajax();
        });
    });

    delete_tovar_ajax();
    function delete_tovar_ajax(){
        $('.row-items').find('.search-choice-close').click(function(){
            var tovars_chosen = [];
            $('.search-choice').each(function(){
                tovars_chosen.push($(this).find('span').html());
            });
            
            var request = $.ajax({
                data: {tovars: tovars_chosen},
                type: "POST",
                url: '/admin/ajax/getTovars'
            });
            request.done(function (msg) {
                $('.data-ajax').html(msg);
            });
        });
    }

    $('select.tovars-choosen').each(function(){
        var tovars_chosen =[];
        var id = $(this).attr('data-id');
        $(this).find('option:selected').each(function(){
            tovars_chosen.push($(this).val());
        });
        var request = $.ajax({
            data: {tovars: tovars_chosen, id: id},
            type: "POST",
            url: '/admin/ajax/getTovars'
        });
        request.done(function (msg) {
            $('.data-ajax').html(msg);
        });
    });

    //Подгрузка данных покупателя по базе зареганных пользователей
    $('select#r-row-user_name').change(function(){
        var username = $(this).find('option:selected').val();
        if(username.length > 0){
            var request = $.ajax({
                data: {username: username},
                type: "POST",
                url: '/admin/ajax/getUser'
            });
            request.done(function (msg){
                
            });
        }
    });

    $('.change_rule').change(function(){
        var rule_id = $(this).attr('data-rule');
        var value = 'allow';
        if($(this).prop("checked")){
        }else{
            value = 'deny';
        }
        var data = { value_where: rule_id, row_where: 'id', value: value, row: 'type', event: 'edit', table: 'rules' };
        hidden_action('/admin/ajax/changeRow', data, 'Изменено', false, false, true);
    });

    /** Редактирование полей в админке каталога */
    $('.table-admin-catalog').find('input').click(function(){
        $(this).parent().parent().find('.edit-row-admin-catalog').removeClass('hidden');
        $(this).focusout(function(){
            var value_where = $(this).attr('data-tovar-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = $(this).attr('name');
            var table = 'catalog';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            hidden_action('/admin/ajax/changeRow', data, 'Изменено', false, false, true);
            $(this).parent().parent().find('.edit-row-admin-catalog').addClass('hidden');
        })
    });

    $('.update-cost-row').change(function(){
        var kolvo = $(this).val();
        var cost = $(this).attr('data-cost');
        var row = $(this).attr('data-row');
        $('#'+row).find('.row-cost-data').html(parseInt(kolvo)*parseInt(cost) +' рублей');
    });

    /** Добавление нового поля с модификацией */
    $('.btn-new-modify').click(function(){
        var name = $(this).attr('data-name');
        $(this).before('<div class="clearfix"></div><div class="row">' +
        '<div class="col-md-4"><input class="form-control" type="text" placeholder="Имя модификации" name="'+ name +'[]"></div>' +
        '<div class="col-md-4"><input class="form-control" type="text" placeholder="Цена (опционально)" name="modifycost'+ name +'[]"></div></div>');
    });
    /** Удаление модификации товара */
    $('.remove-modify').click(function(){
        $(this).parent().parent().empty();
    });

    /**
     * Универсальный обработчик для выделения блока как ссылки
     * Ищет внутри блока ссылку и присваивает ее всему блоку
     */
    $('.link_block').click(function(){window.location = $(this).find('a').attr('href');});
    $('.link_block_this')
        .click(function(){window.location = $(this).attr('data-href');})
        .hover(function(){
            $(this).toggleClass('active');
        });

    //Wizard/step2/Ручное создание новых полей
    $('.btn-new-row-wizard').click(function(){
        var tr = '<tr>'+ $('.table-custom-rows').find('tbody').find('tr:first').html() +'</tr>';
        $('.table-custom-rows').find('tbody').find('tr:last').after(tr);
        $('.table-custom-rows').find('tbody').find('tr:last').find('.btn-new-row-wizard-remove').removeClass('hidden');
        $('.btn-new-row-wizard-remove').on('click', function(){
            $(this).parentsUntil('tr').parent().remove();
        });
    });

    /** Автоподсказчик для поиска разделов */
    function typehead_category() {
        $('#typehead_category').attr('disabled', 'disabled').attr('placeholder', 'Подгрузка списка разделов');
        $.getJSON("/ajax/fastsearch/1/true", function () {})
            .done(function (data) {
                var items = [];
                $.each(data, function (key, val) {
                    items.push(val);
                });
                $('#typehead_category').removeAttr('disabled').attr('placeholder', 'Автоподсказчик разделов').typeahead({
                    source: items,
                    updater: function (obj) {
                        /* Для тех.описаний в каталоге */
                        var select_contains = $("select[name=connect] :contains(" + obj + ")");
                        $('select[name=connect] option:selected').each(function () {
                            this.selected = false;
                            $(this).removeAttr('selected');
                            $("select[name=connect]").val('212');
                        });
                        if (select_contains.is(':disabled') == false) {
                            select_contains.attr("selected", "selected");
                        }
                        else {
                            notify_show('error', 'Раздел не доступен для выбора');
                        }

                        /* Для обычных разделов */
                        $('select[name=catagory] option:selected').each(function () {
                            this.selected = false;
                            $(this).removeAttr('selected');
                            $("select[name=catagory]").val('212');
                        });
                        if (select_contains.is(':disabled') == false) {
                            select_contains.attr("selected", "selected");
                        }
                        else {
                            notify_show('error', 'Раздел не доступен для выбора');
                        }
                    }
                });
            })
            .fail(function () {
                
                $('#typehead_category').attr('placeholder', 'Автоподсказчик не работает');
            })
    }
    $('#typehead_category').on('click', function(){
        typehead_category();
    });

    /** Автоподсказчик для поиска контента */
    function typehead_content(){
        var table = $('#typehead_content').attr('data-table');
        var row = $('#typehead_content').attr('data-row');
        $.getJSON("/ajax/fastsearchContent/"+table+"/"+row, function () {})
            .done(function (data) {
                var items = [];
                $.each(data, function (key, val) {
                    items.push(val);
                });
                $('#typehead_content').removeAttr('disabled').attr('placeholder', 'Автоподсказчик заголовков').typeahead({
                    source: items,
                    updater: function (obj) {
                        window.location = '/admin/'+table+'/?search_word='+obj+'&search_row='+ row +'&search_table='+ table;
                    }
                });
            })
            .fail(function () {
                
                $('#typehead_content').attr('placeholder', 'Автоподсказчик не работает');
            })
    }
    $('#typehead_content').one('click', function(){
        typehead_content();
    });

    /** Автоподсказчик в модуле списка материалов */
    function typehead_module_list_search(){
        var element = $('#typehead_module_list_search');
        var table = element.attr('data-table');
        var row = element.attr('data-row');
        var app = element.attr('data-app');
        $.getJSON("/ajax/fastsearchContent/"+table+"/"+row+"", function () {})
            .done(function (data) {
                var items = [];
                $.each(data, function (key, val) {
                    items.push(val);
                });
                $('#typehead_module_list_search').removeAttr('disabled').attr('placeholder', 'Автоподсказчик заголовков').typeahead({
                    source: items,
                    updater: function (obj) {
                        $.getJSON("/ajax/getData/"+table+"/"+obj+"/id/"+row+"", function () {})
                            .done(function (result) {
                                $('#module_list_search_result').removeClass('hidden');
                                var items_result = [];
                                $.each(result, function (key_result, val_result) {
                                    items_result.push(val_result);
                                    $('#module_list_search_result').find('li')
                                        .after('<li><a href="/admin/'+app+'/edit?id='+val_result+'">'+obj+'</a> <small class="muted">/admin/'+app+'/edit?id='+val_result+'</small></li>');
                                });
                            });
                    }
                });
            })
            .fail(function () {
                
                $('#typehead_content').attr('placeholder', 'Автоподсказчик не работает');
            })
    }

    $('#typehead_module_list_search').one('click', function(){
        typehead_module_list_search();
    });

    /** Если присвоить класс change-form селекту в форме, то при клике будет происходить сабмит формы */
    $('select.change-form, input[type=checkbox].change-form').change(function(){
        $(this).parents('form').submit();
    });

    $('input[type=text].change-form').focusout(function(){
        $(this).parents('form').submit();
    });

    /** Пропуск определенных полей в визарде */
    $('.not-import').click(function () {
        $(this).parents('tr').slideUp('slow').html('');
        var row = $(this).attr('data-row');
        $('tr[data-row=' + row + ']').slideUp('slow').html('');
    });


    /**
     * Метод для выполнения ajax-операций
     * string       @param url              URL для вызова
     * array        @param send_data        Пересылаемые данные /false
     * bool/string  @param good_message     Кастомное сообщение об успехе операции /false
     * object       @param button           объект с кнопкой, на которую нажали /false
     * bool/string  @param redirect_url     Если передан string с адресом страницы, то будет выполнен редирект /false
     * bool         @param clearcache       Если true, то очистит кеш сайта /false
     */
    function hidden_action(url, send_data, good_message, button, redirect_url, clearcache) {
        Pace.restart();
        var request = $.ajax({
            data: send_data,
            type: "POST",
            dataType: "json",
            url: url
        });
        request.done(function (msg) {
            if(msg.blank){
                return false;
            }
            if(msg.good){
                if ((good_message !== false) && (good_message !== undefined)) {
                    notify_show('success', good_message);
                }else{
                    notify_show('success', msg.good);
                }
            }
            if(good_message !== false){
                if(msg.error){
                    notify_show('error', msg.error);
                    return false;
                }
            }
            if (clearcache === true) {
                clear_cache();
            }
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            if ((redirect_url !== false) && (redirect_url !== undefined)) {
                window.location = redirect_url;
            }
            return true;
        });
        request.fail(function (jqXHR, status, statusText) {
            if(status == 'parsererror'){
                notify_show('success', 'Ничего не произошло');
                return false;
            }
            notify_show('error', statusText);
            if ((button !== false) && (redirect_url !== undefined)) {
                $(button).removeClass('action_button').removeAttr('disabled');
            }
            Pace.stop();
            return false;
        });
    }

    $('.switch_active').find('.switch_on').click(function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = 'id';
        var value = '1';
        var row = 'active';
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Элемент включен', false, false, true);
        $(this).removeClass('ajax').removeClass('label-transparent').addClass('label-success');
        $(this).parent().find('.switch_off').removeClass('label-warning').addClass('ajax');
    });
    $('.switch_active').find('.switch_off').click(function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = 'id';
        var value = '0';
        var row = 'active';
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Элемент выключен', false, false, true);
        $(this).removeClass('ajax').removeClass('label-transparent').addClass('label-warning');
        $(this).parent().find('.switch_on').removeClass('label-success').addClass('ajax');
    });

    $('.switch_status').find('.switch_on').click(function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = 'id';
        var value = 'new';
        var row = 'status';
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Элемент объявлен непрочитанным', false, false, true);
        $(this).removeClass('ajax').addClass('label').addClass('label-success');
        $(this).parent().find('.switch_off').removeClass('label-warning').removeClass('label').addClass('ajax');
    });
    $('.switch_status').find('.switch_off').click(function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = 'id';
        var value = 'archive';
        var row = 'status';
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Элемент помещен в архив', false, false, true);
        $(this).removeClass('ajax').addClass('label').addClass('label-warning');
        $(this).parent().find('.switch_on').removeClass('label-success').removeClass('label').addClass('ajax');
    });

    $('.switch_role').find('.switch_on').click(function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = 'id';
        var value = 'allow';
        var row = 'type';
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Элемент включен', false, false, true);
        $(this).removeClass('ajax').addClass('label').addClass('label-success');
        $(this).parent().find('.switch_off').removeClass('label-warning').removeClass('label').addClass('ajax');
    });
    $('.switch_role').find('.switch_off').click(function(){
        var value_where = $(this).attr('data-value_where');
        var row_where = 'id';
        var value = 'deny';
        var row = 'type';
        var table = $(this).attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Элемент выключен', false, false, true);
        $(this).removeClass('ajax').addClass('label').addClass('label-warning');
        $(this).parent().find('.switch_on').removeClass('label-success').removeClass('label').addClass('ajax');
    });

    /**
     * Уведомления в сплывающих окнах от процессов
     * string @param type  Тип события (good, error)
     * string @param message   Сообщение на вывод
     */
    function notify_show(type, message) {
        // http://ned.im/noty/#installation
        if(type == 'error'){
            noty({
                text: message,
                type: type,
                layout: 'top'
            });
        }else{
            noty({
                text: message,
                type: type,
                layout: 'topRight',
                timeout: 2000
            });
        }
    }

    /** Переключение двух дивов с классами switch_true и switch_false */
    $('.switch_true').click(function(){
        $(this).hide().parent().find('.switch_false').show();
    });
    $('.switch_false').click(function(){
        $(this).hide().parent().find('.switch_true').show();
    });

    /** APP. Включение/отключение */
    $('.app_off').click(function(){
        var value_where = $(this).attr('data-app');
        var row_where = 'id';
        var value = '0';
        var row = 'active';
        var table = 'apps';
        var event = 'edit';
        var active_app = $('.active-'+value_where);
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Компонент отключен', false, false, true);

        active_app.find('.app_on_switch').hide().find('.app_off_switch').show('slow');
        active_app.find('.app_off_switch').show('slow');
    });
    $('.app_on').click(function(){
        var value_where = $(this).attr('data-app');
        var row_where = 'id';
        var value = '1';
        var row = 'active';
        var table = 'apps';
        var event = 'edit';
        var active_app = $('.active-'+value_where);
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Компонент включен', false, false, true);

        active_app.find('.app_off_switch').hide().find('.app_on_switch').show('slow');
        active_app.find('.app_on_switch').show('slow');
    });
    $('.app_settings_show').click(function(){
        var app = $(this).attr('data-app');
        $('.settings-'+app).slideToggle('fast');
    });

    /** РЕДАКТИРОВАНИЕ SEO по URL(актуально для каталога) */
    $('input.seo_edit_url').on('focusout', function () {
        var url_connect = $(this).attr('data-url_connect');
        var type_connect = $(this).attr('data-type_connect');
        var value = $(this).val();
        var data = { url_connect: url_connect, type_connect: type_connect, title: value };
        hidden_action('/admin/ajax/updateSeoTitleUrl', data, 'Успешно сохранено', false, false, true);
    });

    $('select[name=csv_row]').change(function () {
        var text = $(this).val();
        var data_id = $(this).attr('data-id');
        $('input.lang'+data_id+'').val(text);
    });

    /** Purge site cache function */
    function clear_cache() {
        hidden_action('/admin/ajax/clearCache/true', false, false, false, false, false);
    }
    $('#clear_cache').bind('click', function () {
        clear_cache();
    });

    /** Удаление контента */
    $('.delete_data').on('click', function () {
        var row = $(this).parents('tr');
        var id = $(this).attr('data-id');
        var table = $(this).attr('data-table');
        var app = $(this).attr('data-app');
        var send_data = { id: id, table: table, app: app};
        if (confirm('Точно удалить?')) {
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/delete', send_data, 'Успешно удалено', false, false, true);
            row.fadeOut('slow').next('tr.edit_tr').fadeOut('slow');
            $('tr[data-id='+id+']').fadeOut();
        }
    });

    /** Изменение веса контента */
    $('td.edit_position_new').find('input').on('focusout', function () {
        var value_where = $(this).parent().attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'position';
        var table = $(this).parent().attr('data-table');
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, true);
    });

    /** Изменение веса контента ONLY ASIABUS */
    $('td.edit_position_index').find('input').on('focusout', function () {
        var value_where = $(this).attr('data-id');
        var table       = $(this).attr('data-table');
        var row_where   = 'id';
        var value       = $(this).val();
        var row         = 'position_index';
        var event       = 'edit';
        var data        = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, true);
    });

    $('.image_position').focusout(function () {
        var value_where = $(this).attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'position';
        var table = 'images';
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Вес изменен', false, false, false);
    });

    /** Изменение описания картинки */
    $('.image_description').focusout(function () {
        var value_where = $(this).attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'description';
        var table = 'images';
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Описание картинки изменено', false, false, false);
    });

    /** Изменение группы картинки */
    $('.image_group').focusout(function () {
        var value_where = $(this).attr('data-id');
        var row_where = 'id';
        var value = $(this).val();
        var row = 'param';
        var table = 'images';
        var event = 'edit';
        var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changeRow', data, 'Группа картинки изменена', false, false, false);
    });

    /** Песборка sitemap */
    $('.generate_sitemap').click(function () {
        var data = { showStatus: true };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/sitemapUpdate', data, 'Sitemap перезаписан', false, false, false);
    });

    /** WIZARD :: Переразбор xls в csv */
    $('.reload-csv').click(function () {
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        clear_cache();
        hidden_action('/phpExcelReader/exportXLS.php', false, 'Прайс успешно разобран. Обновляем страницу', false, '/admin/wizard/step1', true);
    });

    /** Удаление документа */
    $('.delete').click(function () {
        if (confirm('Точно удалить?')) {
            var id = this.id;
            var table = $(this).parent().find('input[name=table]').val();
            var data = {id: id, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/delete', data, 'Удалено', false, false, true);
            $(this).parent().parent().hide('slow');
            $(this).parent().parent().next('tr.edit_tr').html();
        }
    });

    /** WIZARD :: Изменение сопоставления поля импорта */
    $('select.csv_row').change(function () {
        var label = $(this).parent().parent().find('.label-important').hide('slow');
        var id = $(this).attr('data-id');
        var csv_row = $(this).val();
        var data = {id: id, csv_row: csv_row };
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/importChangeConfig', data, 'Сопоставление изменено', false, false, true);
    });

    /** WIZARD :: Изменение типа вывода поля в админке */
    $('input[name=lang], .changeconfigrow').change(function () {
        var config_key = $(this).attr('data-config_key');
        var lang = $(this).parent().parent().find('input.lang').val();
        var type_row = $(this).parent().parent().find('select.type_row').val();
        var filters = $(this).parent().parent().find('select.filters').val();
        var template_output = $(this).parent().parent().find('select.template_output').val();
        var parser = $(this).parent().parent().find('select.parser').val();
        var category_synch = false;
        if ($(this).parent().parent().find('input.category_synch').is(":checked")) {
            category_synch = $(this).parent().parent().find('input.category_synch').val();
        }

        var data = {config_key: config_key, type_row: type_row, filters: filters, template_output: template_output, lang: lang, parser: parser, category_synch: category_synch};
        //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
        hidden_action('/admin/ajax/changerowconfig', data, 'Конфиг полей изменен', false, false, true);
    });


    /** Удаление загруженной картинки */
    $('.delete_image').on('click', function () {
        if (confirm('Точно удалить из материала?')) {
            var clear = 'false';
            if (confirm('Удалить с сервера?')) {
                clear = 'true';
            }
            var id = $(this).attr('data-imageid');
            var table = $(this).attr('data-table');
            var name = $(this).attr('alt');
            var id_content = $(this).attr('data-id_content');
            var row = $(this).parent().parent();
            var row_desc = $(row).next('.uploaded_image_desc');
            var data = {id: id, clear: clear, table: table, id_content: id_content, name: name};
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/deletePicture', data, 'Фото удалено', false, false, true);

            $(row).fadeOut('slow');
            $(row).parents('.upload_images_trumbs_item').fadeOut('slow');
            $(row).parents('.upload_images_trumbs_item').next().next().fadeOut('slow');
            $(row_desc).fadeOut('slow');
        }
    });

    /** Conform alert. Уверены что хотите сделать это?) */
    $('.please_conform, .btn-danger').on('click', function () {
        var href = $(this).attr('href');
        return confirm('Уверены?');
    });

    $('.fileUpload').liteUploader({
        script: '/admin/ajax/uploadFile',
        rules: {
            //allowedFileTypes: 'image/jpeg,image/png,image/gif',
            maxSize: 250000
        }
    })
    .on('lu:errors', function (e, errors) {
        var isErrors = false;
        $('#display').html('');
        $.each(errors, function (i, error) {
            if (error.errors.length > 0) {
                isErrors = true;
                $.each(error.errors, function (i, errorInfo) {
                    $('#display').append('<br />ERROR! File: ' + error.name + ' - Info: ' + JSON.stringify(errorInfo));
                    //notify_show('error', 'Файл не загружен '+ errorInfo);
                });
            }
        });
    })
    .on('lu:before', function (e, files) {
        $('#display').append('<br />Uploading ' + files.length + ' file(s)...');
    })
    .on('lu:progress', function (e, percentage) {
        
    })
    .on('lu:cancelled', function () {
        alert('upload aborted!')
    })
    .on('lu:success', function (e, response) {
        var response = $.parseJSON(response);
        $('#previews').html('');
        $.each(response.urls, function(i, url) {
            notify_show('success', 'Файл '+ url +' загружен');
        });
        //$('#display').append(response.message);

        var form = $('.fileUpload');
        var id_connect = form.attr('data-id_connect');
        var type = form.attr('data-type');
        var request = $.ajax({
            data: {id_connect: id_connect, type: type},
            type: "POST",
            dataType: "html",
            url: '/admin/ajax/uploadFileShow'
        });
        request.done(function (msg) {
            $('#file-uploader').html(msg);
            notify_show('success', 'Все загрузки завершены');
            addTriggerFile();
        });
    });

    /** Метод для связывания данных загруженных по ajax(загрузка файлов) и событий на изменения данных о них */
    function addTriggerFile(){
        /** Изменение группы файла */
        $('.file_group').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'param';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Группа файла изменена', false, false, false);
        });

        /** Изменение описания файла */
        $('.file_description').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'description';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Описание файла изменена', false, false, false);
        });

        /** Изменение описания файла */
        $('.file_photo').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'param_photo';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Прикрепленное фото изменено', false, false, false);
        });

        /** Изменение веса файла */
        $('.file_position').focusout(function () {
            var value_where = $(this).attr('data-id');
            var row_where = 'id';
            var value = $(this).val();
            var row = 'position';
            var table = 'files';
            var event = 'edit';
            var data = { value_where: value_where, row_where: row_where, value: value, row: row, event: event, table: table };
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/changeRow', data, 'Вес файла изменен', false, false, false);
        });

        /** Удаление загруженного файла */
        $('.remove_file').on('click', function () {
            var clear = 'false';
            if (confirm('Удалить с сервера?')) {
                clear = 'true';
            }
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var folder = $(this).attr('data-folder');
            var filename = $(this).attr('data-filename');
            var id_content = $(this).attr('data-id_content');
            var row = $(this).parents('tr');
            var data = {id: id, clear: clear, type: type, filename: filename, id_content: id_content, folder: folder};
            //hidden_action(url, send_data, good_message, button, redirect_url, clearcache)
            hidden_action('/admin/ajax/deleteFile', data, 'Успешно удалено', false, false, true);
            $(row).fadeOut('slow');
        });
    }
    addTriggerFile();

    /**
     * Создание URL для страниц
     * @reference function change_url
     */
    $('input[name=title]').focusout(function(){
        var title = $(this).val();
        var form = $(this).closest('form');
        var url_input = $(form).find('input[name=url]').val();
        if(url_input !== undefined){
            if(url_input.length < 1){
                var table = $(this).attr('data-table');
                change_url(title, table, form);
            }
        }
    });
    $('.refresh-url').click(function () {
        var input = $('input[name=title]');
        var title = input.val();
        var form = $(this).closest('form');
        var table = input.attr('data-table');
        change_url(title, table, form);
    });

    /**
     * Создание url для страницы и вставка значения в input[name=url]
     * string @param title  Текст для транслитерации (обычно input[name=title])
     * string @param table  Имя таблицы для проверки уникальности url (опционально, можно передать пустое значение)
     * string @param form   Форма в которой проводятся операции
     */
    function change_url(title, table, form){
        $.ajax({
            type: "POST",
            data: { words: title, table: table},
            dataType: 'json',
            url: "/admin/ajax/translit",
            success: function (data) {
                var url_input = $(form).find('input[name=url]');
                if (data.good) {
                    url_input.val(data.good);
                    notify_show('info', 'Материалу будет присвоен url: '+data.good);
                    valid_forms();
                }else{
                    url_input.val(data.error);
                    notify_show('info', 'Материалу присвоен url: '+data.error +' с солью');
                    valid_forms();
                }
            }
        });
    }

    /** Alert Подтверждение удаления */
    $('.conform').click(function () {
        if (confirm('Точно удалить?')) {
            window.location = $(this).attr('data-event');
        }else{
            window.location = $(this).attr('data-back');
        }
    });

    /** Открытие строки таблицы */
    $('tr.open_tr').click(function(){
        $(this).next('tr').fadeToggle();
    });
    $('td.open_td, td:has(.icon-edit), td:has(.show-edit)').click(function () {
        $(this).parents('tr').next('tr').show();
    });

    /**
     * По нажатию на кнопку .new_list будет создан input с name= data-row-name кнопки
     * Позволяет вносить в списки кастомные значения
     * */
    $('.new_list').click(function () {
        $(this).hide();
        var row_name = $(this).attr('data-row-name');
        $('select[name='+row_name+']').before('<input class="form-control" placeholder="Новое значение" type="text" name="' + row_name + '" value="">').remove();
    });
    $('.new_list_multiply').click(function () {
        $(this).hide();
        var row_name = $(this).attr('data-row-name');
        $('select[id=r-row-'+row_name+']').before('<input class="form-control" placeholder="Новые значения через ;" type="text" name="' + row_name + '_new_list" value="">');
        //$('#r_row_'+row_name+'_chosen').remove();
    });

    /* TODO: wtf Создание полей на лету */
    $('.new_rows').click(function () {
        $(this).hide();
        var exploded_row_name = $(this).attr('data-row-name').split(',');
        var row_name_placeholder = $(this).attr('data-row-placeholder').split(',');
        var items = [];
        var count = 0;
        $(this).prev().remove();
        $.each(exploded_row_name, function () {
            items.push('<input class="form-control" placeholder="' + row_name_placeholder[count] + '" type="text" name="' + this + '" value="">');
            count++;
        });
        $(this).before(items.join(''));
    });

    /** Выделить все чекбоксы для кнопки удалить все  */
    $('input[name=checked_all]:not(.checked)').click(function () {
        $(this).addClass('checked');
        $('input[name^=delete]:visible').attr('checked', 'checked');
    });

    /**
     * Пагинация для таблиц
     * Сработает для все table:not(.not-pagination)
     * @reference function paginator
     */
    var table = $('table.table:not(.not-pagination)');
    $(table).each(function(){
        paginator(table, 100);
    });

    /**
     * Метод пагинации для таблиц
     * object   @param table    таблица
     * string   @param on_page  количество элементов на страницу
     */
    function paginator(table, on_page){
        var row_content = $(table).find('tbody > tr');
        var count_rows = $(row_content).length;
        var total = Math.ceil(count_rows / on_page);

        if (total > 1) {
            $(table).find('tbody > tr').hide();
            $(table).find('tbody > tr:lt(' + on_page + ')').fadeIn('slow');

            $('.pagination').bootpag({
                total: total,
                maxVisible: 100,
                page: 1,
                href: "#pro-page-{{number}}",
                leaps: false,
                next: 'далее',
                prev: 'назад'
            }).on("page", function (event, /* page number here */ num) {
                var visible_start = num * on_page - on_page;
                var visible_end = num * on_page - 1;
                $(table).find('tbody > tr').hide();
                $(table).find('tbody > tr:gt(' + visible_start + '):lt(' + visible_end + ')').show('slow');
                $(table).find('tbody > tr:eq(' + visible_start + ')').show('slow');
            });
        }else{
            $('.pagination').remove();
        }
    }
});