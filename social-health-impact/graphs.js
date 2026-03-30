(function (window, document, $, undefined) {
    'use strict';

    var doobJs = {
        i: function (e) {
            doobJs.d();
            doobJs.methods();
        },

        d: function (e) {
            this._window = $(window),
            this._document = $(document),
            this._body = $('body'),
            this._html = $('html')
        },
        
        methods: function (e) {
            doobJs.radialProgress();
        },

        radialProgress: function () {
            $('.radial-progress').waypoint(function () {
                $('.radial-progress').easyPieChart({
                    lineWidth: 10,
                    scaleLength: 0,
                    rotate: 0,
                    trackColor: false,
                    lineCap: 'round',
                    size: 130
                });
            }, {
                triggerOnce: true,
                offset: 'bottom-in-view'
            });
        },
    }
    doobJs.i();

})(window, document, jQuery)



