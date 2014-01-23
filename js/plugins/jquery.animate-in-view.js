define(['jquery', 'jquery.easing', 'jquery.animate-css-rotate-scale'], function ($) {
    var elements = null;
    var elementsData = [];
    var methods = {
        init : function( options ) {
            elements = this;
            elements.each(function(){
                var el = $(this),
                    data = {};
                el.stop();
                data.el = el;
                data.css = (el.data('css')) ? methods.parseJSON(el.data('css')) : {};
                data.animation = (el.data('animation')) ? methods.parseJSON(el.data('animation')) : {};
                data.duration = (el.data('duration')) ? parseFloat(el.data('duration')) * 1000 : 1000;
                data.delay = (el.data('delay')) ? parseFloat(el.data('delay')) * 1000 : 0;
                data.loop = (el.data('loop')) ? true : false;
                elementsData.push(data);
                methods.setToEndPosition( data );
                el.show();
                data.offsetTop = el.offset().top;
                el.hide();
                if( methods.canAnimate( data ) ){
                    methods.animate(data);
                }

                //Hack
                if(data.el.hasClass('relative') && data.css.opacity && data.animation.opacity){
                    data.el.show();
                    data.el.css({opacity: 0});
                }
            });

            $(window).scroll( function(){
                methods.onScroll();
            });
        },
        setToEndPosition : function( data ){
            if(data.el.length > 0){
                data.el.css(data.animation);
            }
        },
        canAnimate : function ( data ){
            var windowHeight = $(window).height(),
                bottomScrollPosition = windowHeight + $(window).scrollTop() - (windowHeight / 2) + 100;
            if(data.offsetTop < bottomScrollPosition && (data.el.is(':hidden') || data.el.css('opacity') == 0)){
                return true;
            }
            return false;
        },
        animate : function( data ) {
            if(data.el.length > 0){
                setTimeout(function(){
                    if(data.css.rotate){
                        data.el.rotate(data.css.rotate);
                    }
                    data.el.show();
                    data.el.css(data.css);
                    data.el.animate(data.animation, data.duration, function(){
                        if(data.loop){
                            methods.animate(data);
                        }
                    });
                }, data.delay);
            }
        },
        onScroll : function(){
            for( i in elementsData ){
                var data = elementsData[i];
                if( methods.canAnimate( data ) ){
                    methods.animate(data);
                }
            }   
        },
        parseJSON : function( str ) { 
            str = str.replace(/\s+/g, '');
            str = str.replace(/[\s{}]/g, '');
            var ary = str.split(',');
            str = '';
            $.each(ary, function(i){
                var data = ary[i].split(':');
                var property = data[0];
                var value = data[1];
                str += '"'+property+'":"'+value+'"';
                if(i != ary.length - 1) str += ',';
            });
            str = '{'+str+'}';
            return $.parseJSON(str);
        }
    };

    $.fn.animateInView = function( method ) {

        if ( methods[method] ) {
            return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.animateInView' );
        }    

    };

});