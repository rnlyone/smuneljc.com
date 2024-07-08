<footer class="un-bottom-navigation filter-blur">
    <div class="em_body_navigation border-0">
        <div class="item_link  {{$homenav ?? ''}}">
            <a href="{{route('katsudo.home')}}" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                    <i class="ri-home-5-line"></i>
                </div>
                <div class="icon_active">
                    <i class="ri-home-5-fill"></i>
                </div>
            </a>
        </div>
        <div class="item_link {{$deptnav ?? ''}}">
            <a href="{{route('fdpt')}}" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                    <i class="ri-instance-line"></i>
                </div>
                <div class="icon_active">
                    <i class="ri-instance-fill"></i>
                </div>
            </a>
        </div>
        <div class="item_link">
            <a href="{{route('fscan')}}" name="uploadItem" aria-label="uploadItem" class="btn btn_navLink without_active">
                <div class="btn btnCircle_default icon_current">
                    <i class="ri-qr-scan-line"></i>
                </div>
            </a>
        </div>
        <div class="item_link {{$lombanav ?? ''}}">
            <a href="" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                    <i class="ri-award-line"></i>
                </div>
                <div class="icon_active">
                    <i class="ri-award-fill"></i>
                </div>
            </a>
        </div>
        <div class="item_link {{$usernav ?? ''}}">
            <a href="{{route('katsudo.index')}}" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                    <i class="ri-user-4-line"></i>
                </div>
                <div class="icon_active">
                    <i class="ri-user-4-fill"></i>
                </div>
            </a>
        </div>
    </div>
</footer>
