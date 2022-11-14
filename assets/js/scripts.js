;(function($){
    $(function() {
        var tnc_cookie_param = location.search;
        var tnc_cookie_query = tnc_cookie_param.split('=');
        if( '?cookie' === tnc_cookie_query[0] ) {
            location.href = tnc_redirect_admin.tnc_redirect;
        }
    });
}(jQuery));
