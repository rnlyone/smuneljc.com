@include('katsudo.layouts.header')

@php
    $myDept = Auth::guard('pendaftar')->user()->dpt;
    $deptCover = fn ($d) => $d && $d->img ? $d->img : '/images/katsudo_merah.svg';
@endphp

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Departemen</h2>
            <p>Kegiatan Kegiatan Berbagai Departemen</p>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        {{-- ════════════ DEPARTEMEN SAYA ════════════ --}}
        <div class="un-navMenu-default pt-2 pb-0">
            <div class="sub-title-pkg py-0">
                <h2>Departemen Saya</h2>
            </div>
        </div>

        <div class="discover-nft-random bg-white py-3">
            <div class="content-NFTs-body">
                <div class="item-card-nft">
                    <picture>
                        <img class="big-image" src="{{ $deptCover($myDept) }}" alt="{{ $myDept->nama }}">
                    </picture>
                    <div class="btn-like-click">
                        <div class="btnLike">
                            <span class="count-likes">{{ $myDept->anggotas->count() }}</span>
                            <i class="ri-user-fill"></i>
                        </div>
                    </div>
                    <a href="{{ route('dpt.detail', ['dpt' => $myDept->getSlugAttribute()]) }}" class="un-info-card visited">
                        <div class="block-left">
                            <h4>{{ $myDept->nama }}</h4>
                            <div class="user">
                                <picture>
                                    <img class="img-avatar" src="/images/avatar/{{ $kyokuchopp }}" alt="">
                                </picture>
                                <h5>@if ($kyokucho == NULL)
                                    Kyokuchō
                                @else
                                    {{ $myDept->koor->NamaLengkap }}
                                @endif
                                </h5>
                            </div>
                        </div>
                        <div class="block-right">
                            <h6>Kegiatan</h6>
                            <p>{{ $myDept->katsudos->count() }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- ════════════ DEPARTEMEN LAIN ════════════ --}}
        <div class="un-navMenu-default pt-3 pb-0">
            <div class="sub-title-pkg py-0">
                <h2>Departemen Lain</h2>
            </div>
        </div>
        <div class="discover-nft-random bg-white">
            <div class="content-NFTs-body">
                @foreach ($alldept->except($myDept->id) as $dept)
                    <a href="{{ route('dpt.detail', ['dpt' => $dept->getSlugAttribute()]) }}" class="item-sm-card-NFTs">
                        <div class="cover-image">
                            <div class="default"></div>
                            <picture>
                                <img class="big-image" src="{{ $deptCover($dept) }}" alt="{{ $dept->nama }}">
                            </picture>
                            <div class="content-text">
                                <div class="btn-like-click">
                                    <div class="btnLike">
                                        <span class="count-likes">{{ $dept->anggotas->count() }}</span>
                                        <i class="ri-user-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="user-text">
                                <div class="user-avatar">
                                    <span>{{ $dept->nama }}</span>
                                </div>
                                <div class="number-eth">
                                    <span class="main-price">{{ $dept->katsudos->count() }}</span>
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
