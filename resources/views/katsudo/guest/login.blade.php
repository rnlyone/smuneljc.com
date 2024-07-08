@include('katsudo.layouts.header')

<section class="account-section padding-20">
    <div class="display-title">
        @if (Session::get('pesantix') == null)
            <h1>Irasshaimase!! 😆</h1>
        @endif
        <p>Masuk dengan akun Katsudō kamu disini</p>
    <div class="content__form margin-t-24">
        <form id="loginform" action="{{route('klogin')}}" method="POST">
            @csrf
            <div class="form-group icon-left">
                <label>NISN</label>
                <div class="input_group">
                    <input name="NISN" type="number" class="form-control" placeholder="e. g. &quot;61341263471&quot;"
                        required="" value="{{old('NISN')}}">
                    <div class="icon">
                        <i class="ri-hashtag"></i>
                    </div>
                </div>
            </div>
            <div class="form-group icon-left">
                <label>PIN</label>
                <div class="input_group">
                    <input name="PIN" type="password" class="form-control" placeholder="e. g. &quot;000000&quot;" required="" inputmode="numeric" onkeypress="submitForm(event)" maxlength="6">
                    <div class="icon">
                        <i class="ri-lock-password-line"></i>
                    </div>
                </div>
            </div>
        </form>
        <script>
            function submitForm(event) {
              if (event.key === "Enter") {
                event.preventDefault(); // Menghentikan default "Enter" key behavior
                document.getElementById("loginform").submit(); // Ganti "yourFormId" dengan ID formulir Anda
              }
            }
            </script>
    </div>
</section>

<footer class="footer-account">
    <div class="env-pb">
        <div class="display-actions">
            <a href="#" onclick="document.getElementById('loginform').submit()" class="btn btn-sm-arrow bg-primary visited">
                <p>Sign In</p>
                <div class="ico">
                    <i class="ri-arrow-drop-right-line"></i>
                </div>
            </a>
        </div>
        <div class="support">
            <p>Need help? <a href="page-help.html" class="visited">Contact our support team</a></p>
        </div>
    </div>
</footer>

@include('katsudo.layouts.footer')
