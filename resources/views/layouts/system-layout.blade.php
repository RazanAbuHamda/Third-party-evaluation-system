@include('sub-views.header')
@yield('content')
@include('sub-views.footer')
<script type="text/javascript">
    $(function() {
        if( '{{$active}}' == 'enterAc'){
            // remove classes from all
            $("li").removeClass("active");

            // add class to the one we clicked
            $('.enterprises').addClass("active");
            $(' .tab-content custom-menu-content ').addClass("active");
            $(' .tab-pane in active notika-tab-menu-bg animated flipInX ').addClass("active");
        }
        else if('{{$active}}' == 'userAct'){

            $("li").removeClass("active");
            // add class to the one we clicked
            $('.users ').addClass("active");
        }
        else if('{{$active}}' == 'formAct'){

            $("li").removeClass("active");
            // add class to the one we clicked
            $('.forms ').addClass("active");
        }

    });
</script>
