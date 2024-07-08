@include('katsudo.layouts.header')
<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Departemen</h2>
            <p>Kegiatan Kegiatan Berbagai Departemen</p>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        <div class="discover-nft-random bg-white py-3">
            <div class="content-NFTs-body">
                <div class="item-card-nft">
                    <picture>
                        <source srcset="/images/dept/{{Auth::guard('pendaftar')->user()->dpt->nama}}.png" type="image/webp">
                        <img class="big-image" src="/images/dept/{{Auth::guard('pendaftar')->user()->dpt->nama}}.png" alt="">
                    </picture>
                    <div class="btn-like-click">
                        <div class="btnLike">
                            <span class="count-likes">{{Auth::guard('pendaftar')->user()->dpt->anggotas->count()}}</span>
                            <i class="ri-user-fill"></i>
                        </div>
                    </div>
                    <a href="{{route('dpt.detail', ['dpt' => Auth::guard('pendaftar')->user()->dpt->getSlugAttribute()])}}" class="un-info-card visited">
                        <div class="block-left">
                            <h4>{{Auth::guard('pendaftar')->user()->dpt->nama}}</h4>
                            <div class="user">
                                <picture>
                                    <source srcset="/images/avatar/{{$kyokuchopp}}" type="image/webp">
                                    <img class="img-avatar" src="images/avatar/{{$kyokuchopp}}" alt="">
                                </picture>
                                <h5>@if ($kyokucho == NULL)
                                    Kyokuchō
                                @else
                                    {{Auth::guard('pendaftar')->user()->dpt->koor->NamaLengkap}}
                                @endif
                                </h5>
                            </div>
                        </div>
                        <div class="block-right">
                            <h6>Kegiatan</h6>
                            <p>
                                {{-- <span>($3,650)</span> --}}
                                {{Auth::guard('pendaftar')->user()->dpt->katsudos->where('periode', $latestperiode)->count()}}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="un-navMenu-default pt-3 pb-0">
            <div class="sub-title-pkg py-0">
                <h2>Departemen Lain</h2>
            </div>
        </div>
        <div class="discover-nft-random bg-white">
            <div class="content-NFTs-body">
                @foreach ($alldept->except(Auth::guard('pendaftar')->user()->dpt->id) as $dept)
                    <!-- item-sm-card-NFTs -->
                    <a href="{{route('dpt.detail', ['dpt' => $dept->getSlugAttribute()])}}" class="item-sm-card-NFTs">
                        <div class="cover-image">
                            <div class="default"></div>
                            <picture>
                                <source srcset="{{$dept->img}}" type="image/webp">
                                <img class="big-image" src="{{$dept->img}}" alt="">
                            </picture>
                            <div class="content-text">
                                <div class="btn-like-click">
                                    <div class="btnLike">
                                        <span class="count-likes">{{$dept->anggotas->count()}}</span>
                                        <i class="ri-user-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="user-text">
                                <div class="user-avatar">
                                    <span>{{$dept->nama}}</span>
                                </div>
                                <div class="number-eth">
                                    <span class="main-price">{{$dept->katsudos->where('periode', $latestperiode)->count()}}</span>
                                    <span>Kegiatan</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="space-items"></div>


    </div>
    <!-- End.content-comp -->
</section>


@include('katsudo.layouts.footer')
