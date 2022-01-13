<div>
    <!doctype html>
    <html lang="en">
    <head>
        <x-backend.header-layout :title="$title"/>
        <style type="text/css"> .notify{ z-index: 1000000; margin-top: 5%; } </style>
        @notifyCss
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- START: Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
                <x-backend.navbar-layout :total-notif="$totalNotif"/>
            <!-- /.navbar -->

            <!-- Start: Sidebar -->
            <x-backend.sidebar-layout :tagSubMenu="$tagSubMenu"/>
            <!-- End: Sidebar -->


            <!-- Start: Konten -->
            {{$slot}}
            <!-- End: Konten -->

            <!-- Start: Footer -->
            <x-backend.footer-layout />
        </div>
        <!-- END: ./wrapper -->
    </body>
    @notifyJs
    </html>

</div>
