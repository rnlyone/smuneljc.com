        <!-- ===================================
          START THE BOTTOM NAVIGATION
        ==================================== -->
        @include('katsudo.layouts.navigator')
    </div>
    <!-- ===================================
      START THE MODAL SIDEBAR MENU - CONNECTED
    ==================================== -->
        @include('katsudo.layouts.toast')
    <!-- ===================================
      START STATUS CONNECTION
    ==================================== -->
    <div class="d-flex justify-content-center">
        <div class="toast status-connection" role="alert" aria-live="assertive" aria-atomic="true"></div>
    </div>


    @include('katsudo.layouts.jses')

</body>

</html>
