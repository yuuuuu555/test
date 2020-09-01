window.onload = function() {
    $('#login_name,#login_psw,#login_phone_conven,#conven_code,#login_verifycode').val('');
};
if (typeof loginPath == "undefined") {
    var loginPath = 'https://yisuapi.yisu.com/index.php/Speed/Uc/doLogin?callback=?';
}
if (typeof loginFastPath == "undefined") {
    var loginFastPath = 'https://yisuapi.yisu.com/index.php/Speed/Uc/doLoginFastNew?callback=?';
}
(function(){
    var timer_wechat = setInterval(animating,1600);
    $('.otherway').mouseenter(function(){
        clearInterval(timer_wechat);
    });
    $('.otherway').mouseleave(function(){
        timer_wechat = setInterval(animating,1600);
    })

    function animating () {
        if($('.other-login').hasClass('animate-login')){
            $('.other-login').removeClass('animate-login');
        }else{
            $('.other-login').addClass('animate-login');
        }
    }

    //        2018-10-24 js 二维码登录
    $('.use_help').hover(function(){
        $('.help_img').show();
    },function(){
        $('.help_img').hide();
    });

    $('.back_link').click(function(){
        $(this).hide().siblings('.erweima_login').hide().siblings('.user_pwd_login').show();
        $('.login-title').hide();
        $('.login_way').show();
    });

    $('.login-wechat').click(function(){
        $('.login_way').hide();
        toWeixinQRCode();
        $('.login-title').show();
    });


    var curError,
        UA = navigator.userAgent.toLowerCase(),
        isOpenQQBind = false,
        html;

    var error = {
        error_name_empty : "请输入用户名！",
        error_psw_empty: "请输入密码！",
        error_code_empty: "请输入验证码！",
        error_phone_empty : "请输入手机号！",
        error_phone_code_empty : "请输入短信验证码！",
        error_login_fail: "登录失败！",
        error_phone_error : "手机号码格式不正确",
        error_phone_code_error : "短信验证码格式不正确",
        error_phone_notex : "手机号码不存在",
        error_parent_name : "请输入父账号",
    };

    var _html = '';
    _html += '<div class="login-shdow" style="display:none;">';
    _html += '<div class="login-modal">';
    _html += '<div class="step-body">';
    _html += '<div class="step-title">绑定亿速云账号<span class="qq-close-btn" style="cursor:pointer;">×</span></div>';
    _html += '<div class="step-one" style="display: block;">';
    _html += '<p>如果您还没有注册亿速云账号，请</p>';
    _html += '<a href="/reg/">立即注册</a>';
    _html += '<p class="mt16">如果您已注册过亿速云账号，请</p>';
    _html += '<a href="javascript:;" id="gobind">立即绑定</a>';
    _html += '</div>';
    _html += '<div class="step-two" style="display:none;">';
    _html += '<form action="#" onsubmit="return false">';
    _html += '<input type="text" class="qq-dc-ipt" autocomplete="off" id="reg_cc" placeholder="请输入亿速云账号/手机号" maxlength="20" />';
    _html += '<input type="password" style="display:none;width:0px;height:0px;">';
    _html += '<input type="text" class="qq-dc-ipt" type="password" id="reg_psw"  placeholder="请输入密码" maxlength="20" onfocus="this.type=\'password\',this.autocomplete=\'new-password\'" autocomplete="off" />';
    _html += '<input type="text" style="z-index: -20;display: none;">';
    _html += '<div class="matchbox">';
    _html += '<input type="text" class="qq-dc-ipt" type="text" id="reg_code"  placeholder="请输入验证码"/><span><img src="https://yisuapi.yisu.com/index.php/Home/Index/verify/" alt="点击重新获取验证码" id="reg_code_img" alt=""/></span>';
    _html += '</div>';
    _html += '<div class="bind-login-error" style="line-height: 16px;margin-top: 20px;font-size: 16px;color: #FF6666;display: none;"></div>';
    _html += '<button type="submit"  class="qq-dc-bind" type="button" id="btnBinded" >绑定</button>';
    _html += '</form>';
    _html += '</div>';
    _html += '</div>';
    _html += '</div>';
    _html += '</div>';

    // 点击立即绑定
    $(document).on('click', '#gobind', function(){
        $('.login-shdow .step-two').show();
        $('.login-shdow .step-one').hide();
    });

    /* 登录方式切换 */
    $('.login_way ul li a').on('click',function(e){
        $(this).addClass('active').parent().siblings().children('a').removeClass('active');
        if($(e.target).is('.login_phone')){
            $('.phone_login').show().siblings('.pwd_login').hide().siblings('.select').hide().siblings('.loginbtn').css('margin-top',0 + 'px');
            $('#btnSubmit').hide();
            $('#btnSubmit_fast').show();
            $('#conven_code').val('');
        }else{
            $('.phone_login').hide().siblings('.pwd_login').show().siblings('.select').show().siblings('.loginbtn').css('margin-top',24 + 'px');
            $('#btnSubmit').show();
            $('#btnSubmit_fast').hide();
        }
        $('.login-error').text('');
    })

    // html = '<div class="qq-dialog-conts" style="display:none;">' +
    // 	   '  <div class="qq-opt"></div>' +
    // 	   '  <div id="choose" class="qq-dc-cms-con">' +
    // 	   '    <div class="qq-dc-main">' +
    // 	   '        <div class="qq-dialog-title">亲爱的用户</div>' +
    // 	   '        <i class="qq-close-btn" title="关闭"></i>' +
    // 	   '        <ul class="qq-dcc-con">' +
    // 	   '            <li>' +
    // 	   '              <span>如果之前您未注册过亿速云账号，请</span>' +
    // 	   '            </li>' +
    // 	   '            <li>' +
    // 	   '              <button type="button" id="btnReg" style="border-radius: 3px;display: block; border: 0; width: 250px; overflow: hidden; cursor: pointer; outline: none; height: 42px; line-height: 42px; font-size: 14px; color: #fff; background: #e6002d; transition: all linear .2s;margin-left: 55px;">立即注册亿速云账号</button>' +
    // 	   '            </li>' +
    // 	   '            <li>' +
    // 	   '              <span>如果您已注册过亿速云账号，请</span>' +
    // 	   '            </li>' +
    // 	   '            <li>' +
    // 	   '              <button type="button" id="btnBind" style="border-radius: 3px;display: block; border: 0; width: 250px; overflow: hidden; cursor: pointer; outline: none; height: 42px; line-height: 42px; font-size: 14px; color: #fff; background: #e6002d; transition: all linear .2s;margin-left: 55px;">绑定亿速云账号</button>' +
    // 	   '            </li>' +
    // 	   '        </ul>' +
    // 	   '    </div>' +
    // 	   '  </div>' +
    // 	   '  <div id="bind" class="qq-dc-cms-con">' +
    // 	   '    <div class="qq-dc-main" style="position:relative;">' +
    // 	   '        <div class="qq-dialog-title">绑定已有亿速云账号</div>' +
    // 	   '        <i class="qq-close-btn" title="关闭"></i>' +
    // 	   '        <ul class="qq-dcc-con">' +
    // 	   '            <li>' +
    // 	   '              <div style="width:100%; text-align:center;"><input class="qq-dc-ipt" type="text" id="reg_cc" value="" /></div>' +
    // 	   '            </li>' +
    // 	   '            <li>' +
    // 	   '              <div style="width:100%; text-align:center;"><input class="qq-dc-ipt" type="password" id="reg_psw" value="" /></div>' +
    // 	   '            </li>' +
    // 	   '            <li>' +
    // 	   '              <div style="width:100%; text-align:center; position:relative;"><input class="qq-dc-ipt" type="text" id="reg_code" value="" /><img class="yzm" src="https://yisuapi.yisu.com/index.php/Home/Index/verify/" alt="点击重新获取验证码" id="reg_code_img" style="position:absolute; top:1px; right:43px; width:100px; height:44px; border-left: 1px solid #c6c6c6;"></div>' +
    // 	   '            </li>' +
    // 	   '            <li>' +
    // 	   '              <div><input class="qq-dc-bind" type="button" id="btnBinded" /><input class="qq-dc-back" type="button" id="btnBack" /></div>' +
    // 	   '            </li>' +
    // 	   '        </ul>' +
    // 	   '    </div>' +
    // 	   '  </div>' +
    //    '</div>';

    $("#login_name").val('');
    $("#login_psw").val('');
    createPlaceholder('login_name','帐号/手机号',3,0);
    createPlaceholder('login_psw','密码',3,0);
    createPlaceholder('login_phone_conven','手机号',3,0);
    createPlaceholder('conven_code','短信验证码',3,0);
    $(document.body).append( _html );
    $('#reg_code_img').on('click',resetCode);
    $('.qq-close-btn').click(function(){
        // $('.qq-dialog-conts').hide();
        $('.login-shdow').hide();
    });
    $(".log-regs-mod").click(function(e){
        if(e && e.stopPropagation){
            e.stopPropagation();
        }else{
            window.event.cancelBubble = true;
        }
    });
    $(".log-product").click(function(){
        window.location.href = 'https://www.yisu.com/huodong/2020xinnian.html';
    });

    //cookie只保留1小时
    var ms = Date.parse(new Date()) + 1000 * 60 * 60 * 1, expires = new Date(ms);

    //获取 cookie 的值
    var login_in = '';
    var cookies = document.cookie ? document.cookie.split('; ') : [];
    for (var i = 0, l = cookies.length; i < l; i++) {
        var parts = cookies[i].split('=');
        var name = parts.shift();
        var value = parts.join('=');
        if( 'previousUrl'==name ) login_in = value;
    }

    //验证码
    var time ,timer,Forgo=false;
    function remainningTime_fast(){
        time--;
        if(time<=0){
            clearInterval(timer);
            $(".sendBtn_fast").removeClass("sent").html("重新获取");
        }else{
            $(".sendBtn_fast").html("重新获取("+time+"S)");
        }
    }

    $('#reg_cc,#reg_psw,#reg_code').keydown(function(event){
        if(event.keyCode == 13) $('#btnBinded').click();
    });

    //window.document.onkeydown = keySubmit;

    $(".log-product").click(function(){
        window.location.href = '/cloud/?id=9-1-1-2-0';
    });

    window.toQQLogin = function(){
        document.domain = 'yisu.com';
        childWindow = window.open("https://yisuapi.yisu.com/index.php/Speed/Uc/qqlogin", "TencentLogin", "width=800,height=600,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
    }

    window.toAlipayLogin = function(){
        document.domain = 'yisu.com';
        childWindow = window.open("https://yisuapi.yisu.com/index.php/Speed/Uc/alipaylogin", "TencentLogin", "width=800,height=600,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
    };

    window.toWeixinLogin = function(){
        document.domain = 'yisu.com';
        childWindow = window.open("https://yisuapi.yisu.com/index.php/Speed/Uc/weixinlogin", "TencentLogin", "width=800,height=600,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
    };

    window.toWeixinQRCode = function(){
        $('.login-title').css('text-align','left');
        $('.user_pwd_login').hide();
        $('.back_link,.erweima_login').show();
        $('.erweima_img').hide();
        $('#loading').show();
        var url = "https://weixin.yisu.com/index.php/Speed/Uc/weixinqrcode/?callback=?";
        $.ajax({
            type: "GET",
            url: url,
            dataType: "jsonp",
            data: {},
            timeout: 30000,
            success: function(data){
                if( 1==data.status )
                {
                    $('.erweima_img').show();
                    $('#loading').hide();
                    $('#qrcodeimg img').attr('src',data.data.img);
                    var t1 = window.setInterval(function () {
                        var url = "https://weixin.yisu.com/index.php/Speed/Uc/wechatqrlogin";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {code:data.data.code},
                            dataType: "json",
                            async:true,
                            timeout: 2000,
                            xhrFields: { withCredentials: true },
                            success: function(data){
                                if( 1==data.status )
                                {
                                    window.location.href = "https://www.yisu.com/";
                                }else if(2==data.status){
                                    window.openDiv();
                                    window.clearInterval(t1);
                                }else if(0==data.status){
                                    $('#getqrcode').hide();
                                    $('#qrerrorinfo').text('请求超时！');
                                    $('#qrcodenot').show();
                                    window.clearInterval(t1);
                                }
                            },
                            error:function (err) {
                                $('#getqrcode').hide();
                                $('#qrerrorinfo').text('请求错误！');
                                $('#qrcodenot').show();
                                window.clearInterval(t1);
                            }
                        });
                    }, 2000);

                    $('#getqrcode').show();
                    $('#qrcodenot').hide();
                }else{
                    $('#getqrcode').hide();
                    $('#qrcodenot').show();
                }
            },
            error:function (err) {
                $('#getqrcode').hide();
                $('#qrcodenot').show();
            }
        });
    };

    window.getScript = function(url){
        $.getScript(url);
    };

    var isFirst = false;
    window.openDiv = function(){
        if( !isFirst ){
            createPlaceholder('reg_cc','亿速云账号/手机号',18,45);
            createPlaceholder('reg_psw','亿速云密码',18,45);
            createPlaceholder('reg_code','验证码',18,45);
            isFirst = true;
        }
        resetCode();

        $(".login-shdow .qq-dc-cms-con").css({
            top: ($(window).scrollTop() + 150) + "px"
        });
        $(".login-shdow").css({
            height: (window.innerHeight) + "px"
        });
        $(".login-shdow").show(300);
        $('#reg_cc,#reg_psw,#reg_code').val('');
    };

    $("#btnReg").on('click',function(){
        window.location.href = "/index/reg/";
    });

    $("#btnBind").on('click',function(){
        $("#choose").hide();
        $("#reg").hide();
        $("#bind").show();
        isOpenQQBind = true;
    });

    //绑定已有账号
    $(document).on('click','#btnBinded',function () {
        $('.bind-login-error').text('').hide();
        var reg_cc = $.trim( $('#reg_cc').val() ),
            reg_psw = $.trim( $('#reg_psw').val() ),
            reg_code = $.trim( $('#reg_code').val() );

        if( ''==reg_cc ){
            $('.bind-login-error').text('请输入亿速云账号').show();
            $('#reg_cc').focus();
            return false;
        }
        if( ''==reg_psw ){
            $('.bind-login-error').text('请输入密码').show();
            $('#reg_psw').focus();
            return false;
        }
        if( ''==reg_code ){
            $('.bind-login-error').text('请输入验证码').show();
            $('#reg_code').focus();
            return false;
        }

        var url = "https://yisuapi.yisu.com/index.php/Speed/Uc/loginbind";

        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {name:reg_cc, password: reg_psw, code: reg_code},
            xhrFields: { withCredentials: true },
            cache: false,
            async: false,
            success: function(data)
            {
                if( 0 == data.error ) {
                    $('.bind-login-error').text('绑定亿速云账号成功！').show();
                    document.cookie = "previousUrl=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
                    if( -1!=login_in.indexOf("login") ){
                        login_in = "https://www.yisu.com/";
                    }
                    if(''==login_in){
                        login_in = "https://www.yisu.com/";
                    }
                    setTimeout(function(){
                        $(".login-shdow").hide(300);
                        window.location.href = decodeURIComponent(login_in);
                    },1500);
                } else if( 2 == data.error ) {
                    resetCode();
                    $('.bind-login-error').text('验证码错误，请重新输入！').show();
                    return false;
                } else {
                    $('.bind-login-error').text(data.msg).show();
                    return false;
                }
            }
        });
    });

    $("#btnBack").on('click',function(){
        $("#choose").show();
        $("#reg").hide();
        $("#bind").hide();
        isOpenQQBind = false;
    });


    /*function keySubmit(evt){
        evt = window.event || evt;
        if(evt.keyCode==13){
            btnSubmitEvent();
        }
    }*/

    $('#login_name,#login_psw,#login_verifycode').keydown(function(event){
        if(event.keyCode == 13) btnSubmitEvent();
    });

    $('#conven_code').keydown(function(event){
        if(event.keyCode == 13) btnSubmit_fast();
    });

    $('#login_phone_conven').keydown(function(event){
        if(event.keyCode == 13) $('.sendBtn_fast').click();
    });

    $('.sendBtn_fast').on('click',function(){
        var cigs = $('#code_img').trigger('click');
        $.when(cigs).done(function () {
            var conven_phone = $.trim($('#login_phone_conven').val());
            // var conven_code = $.trim($('#conven_code').val());
            var issend = false,Forgo = false;
            if(conven_phone == ''){
                return showMsg('error_phone_empty','login_phone_conven');
            }
            if(!/^(((13[0-9]{1})|(15[0-9]{1})|(14[1-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(19[0-9]{1}))+\d{8})$/.test(conven_phone)){
                return showMsg('error_phone_error','login_phone_conven');
            }
            setTimeout(function () {
                $.ajax({
                    type: 'GET',
                    url : 'https://yisuapi.yisu.com/index.php/Speed/Uc/isExistsTelLogin?callback=?',
                    dataType: 'jsonp',
                    data: {phone:conven_phone},
                    async: false,
                    success:function(res){
                        if(res == 1){
                            if(!$('.sendBtn_fast').hasClass("sent")){
                                time=100;
                                $('.sendBtn_fast').addClass("sent");
                                remainningTime_fast();
                                timer=setInterval(remainningTime_fast,1000);
                                var Forgo = true;
                                if(!Forgo) return false;
                                $('#conven_code').focus();
                                var tokensl =  $('#tokens').val();
                                $.ajax({
                                    type: 'GET',
                                    url : 'https://yisuapi.yisu.com/index.php/Speed/Uc/getSmsCodeReg?callback=?',
                                    dataType: 'jsonp',
                                    data: {phone:conven_phone,code:tokensl,type:'fastYisuLognPhone'},
                                    success:function(res){
                                        if(res == 1){
                                            issend = true;
                                            $('#conven_code').focus();
                                            $('.login-error').text('');
                                        }else if(res == 0){
                                            $('.login-error').text('短信验证码发送失败，请稍候重新获取');
                                            return false;
                                        }else if(res == -1){
                                            $('.login-error').text('请不要频繁获取短信验证码');
                                            return false;
                                        }else if(res == -2){
                                            $('.login-error').text('手机号码不能为空');
                                            return false;
                                        }else if(res == -3){
                                            $('.login-error').text('手机号码格式不正确');
                                            return false;
                                        }
                                        if(!issend){
                                            time = 0;
                                            $(".sendBtn").removeClass("sent").html("重新获取");
                                            $('.login-error').text('');
                                        }
                                    }
                                });
                            }
                        }else{
                            $('.login-error').text('');
                            return showMsg('error_phone_notex','login_phone_conven');
                        }
                    }
                });
            },500);
        });
    });

    $.getJSON("https://yisuapi.yisu.com/index.php/Speed/Uc/doTryccSet/?callback=?",function(res){if(res>3){$('.verifycodeFirstno').show();}},'JSONP');
    function btnSubmitEvent(e){
        //e.preventDefault();
        var login_name = $("#login_name").val(), login_psw = $("#login_psw").val();
        var login_verifycode = $("#login_verifycode").val();

        var login_pname = $("#login_pname").val();

        if (login_pname != undefined) {
            login_pname = $.trim(login_pname);
            if( ''==login_pname ) {
                return showMsg('error_parent_name','login_pname');
            }
        }
        login_name = $.trim(login_name);
        login_psw = $.trim(login_psw);
        if( ''==login_name ) {
            return showMsg('error_name_empty','login_name');
        }
        if( ''==login_psw ){
            return showMsg('error_psw_empty','login_psw');
        }

        var trydo = $.getJSON("https://yisuapi.yisu.com/index.php/Speed/Uc/doTrycc/?callback=?",function(res){window.doTry = res.data;},'JSONP');
        login_name = window.btoa(login_name);
        login_psw  = window.btoa(login_psw);
        login_pname  = window.btoa(login_pname);

        $('#btnSubmit').text('正在跳转...');

        /* url传跳转过来地址，然后页面登录后，再返回那个地址 */
        var href = window.location.href, match = href.match(/\?from=(.+?)$/);

        if(match && match[1]) login_in = match[1];

        $.when(trydo).done(function () {
            //所做操作
            var url = loginPath,
                data = "name="+ encodeURIComponent(window.btoa(login_name)) +"&password="+ encodeURIComponent(window.btoa(login_psw)) +"&md5=0" + "&nowtimes=" +  window.btoa(new Date().getTime()) + "&cctry=" + encodeURIComponent(window.doTry) + "&verifycode=" + encodeURIComponent(login_verifycode)+"&pname="+encodeURIComponent(window.btoa(login_pname));
            $.ajax({
                type: "get",
                url: url,
                dataType: "jsonp",
                data: data,
                timeout: 30000,
                xhrFields: { withCredentials: true },
                async: false,
                cache: false,
                success: function(data) {
                    if( 1==data.status ) {
                        document.cookie = "login_error_count=; expires=" + new Date(0).toUTCString() + "; path=/; ";
                        //var agent = data.data.agent;
                        // var username = data.data.username;

                        //登录成功，跳转到之前的页面
                        if( -1!=login_in.indexOf("login") ){
                            login_in = "https://www.yisu.com/";
                        }
                        if(''==login_in){
                            login_in = "https://www.yisu.com/";
                        }

                        //$('html').after(data.data.synlogin);
                        document.cookie = "previousUrl=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/"; //使login_in的cookie过期
                        // document.cookie="userName="+username;
                        setTimeout(function(){
                            window.location.href = decodeURIComponent(login_in);
                        },500);
                    }else{
                        if('display'==data.data){
                            $('.verifycodeFirstno').show();
                            $('#code_img').trigger('click');
                        }else{
                            $('.verifycodeFirstno').hide();
                        }
                        $('#btnSubmit').text('登 录');
                        $('#login_psw,#login_verifycode,#conven_code').val('');
                        $('.login-error').text(data.msg);
                        return false;
                    }
                    /*}else{
                        $('#btnSubmit').val('登 录');
                        return showMsg('error_login_fail');
                    }*/
                },
                error: function(){
                    if('display'==data.data){
                        $('.verifycodeFirstno').show();
                    }else{
                        $('.verifycodeFirstno').hide();
                        $('.login-error').text('');
                    }
                    $('#btnSubmit').text('登 录');
                    $('#login_psw,#login_verifycode,#conven_code').val('');
                    return showMsg('error_login_fail');
                }
            });
        });

    }

    function btnSubmit_fast(e){
        var login_pname = $('#phone_login_pname').val()
        var conven_phone = $.trim($('#login_phone_conven').val());
        var conven_code = $.trim($('#conven_code').val());
        var fastGologin = false;

        if (login_pname !== undefined) {
            login_pname = $.trim(login_pname);
            if( ''===login_pname ) {
                return showMsg('error_parent_name','phone_login_pname');
            }
        }

        if(conven_phone == ''){
            return showMsg('error_phone_empty','login_phone_conven');
        }
        if(!/^(((13[0-9]{1})|(15[0-9]{1})|(14[1-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(19[0-9]{1}))+\d{8})$/.test(conven_phone)){
            return showMsg('error_phone_error','login_phone_conven');
        }

        if(conven_code == ''){
            return showMsg('error_phone_code_empty','conven_code');
        }
        if(conven_code.length != 6){
            return showMsg('error_phone_code_error','conven_code');
        }

        $.ajax({
            type: 'POST',
            url : 'https://yisuapi.yisu.com/index.php/Speed/Uc/checkSmsCode',
            dataType: 'json',
            async: false,
            data: {code:conven_code},
            xhrFields: { withCredentials: true },
            success:function(res){
                if(res == -4){
                    $('.login-error').text('对不起，您还没有获取短信验证码');
                    return false;
                }else if(res == -3){
                    $('.login-error').text('短信验证码已输错三次');
                    window.setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                    return false;
                }else if(res == -1){
                    $('.login-error').text('短信验证码已超时失效,请重新获取');
                    return false;
                }else if(res == 0){
                    $('.login-error').text('短信验证码错误');
                    return false;
                }else{
                    $('.login-error').text('');
                    fastGologin = true;
                }
            }
        });

        if(!fastGologin) return false;
        var url = loginFastPath, data = "name="+ encodeURIComponent(conven_phone) + "&pname="+ encodeURIComponent(login_pname) + "&code=" + encodeURIComponent(conven_code) + "&nowtimes=" + new Date().getTime();                     //传入验证码参数进行检测
        $('#btnSubmit_fast').text('正在跳转...');

        /* url传跳转过来地址，然后页面登录后，再返回那个地址 */
        var href = window.location.href, match = href.match(/\?from=(.+?)$/);
        if(match && match[1]) login_in = match[1];
        $.ajax({
            type: "get",
            url: url,
            dataType: "jsonp",
            data: data,
            timeout: 30000,
            xhrFields: { withCredentials: true },
            cache: false,
            success: function(data) {
                if( 1==data.status ) {
                    document.cookie = "login_error_count=; expires=" + new Date(0).toUTCString() + "; path=/; ";
                    //var agent = data.data.agent;
                    // var username = data.data.username;

                    //登录成功，跳转到之前的页面
                    if( -1!=login_in.indexOf("login") ) login_in = "https://www.yisu.com/";
                    if(''==login_in) login_in = "https://www.yisu.com/";

                    document.cookie = "previousUrl=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/"; //使login_in的cookie过期
                    setTimeout(function(){
                        window.location.href = decodeURIComponent(login_in);
                    },500);
                }else{
                    $('#btnSubmit_fast').text('登 录');
                    $('#login_psw,#login_verifycode,#conven_code').val('');
                    $('.login-error').text( data.msg);
                    return false;
                }
            },
            error: function(){
                $('#btnSubmit_fast').text('登 录');
                $('#login_psw,#login_verifycode,#conven_code').val('');
                $('.login-error').text('');
                return false;
            }
        });

    }

    $('#code_img').on('click',function () {
        var ids = $(this).attr('id');
        var fast_code_set = $(this).attr('src', 'https://yisuapi.yisu.com/Home/Index/verifyNoAgo?' + Math.random());
        $.when(fast_code_set).done(function () {
            $('#login_verifycode').val('');
            if(ids = 'code_img'){
                setTimeout(function () {
                    $.getJSON("http://yisuapi.yisu.com/index.php/Home/Index/goFastNumSet/?callback=?",function(res){$('#tokens').val(res);},"JSONP");
                },200);
            }
        });
    });

    $('#btnSubmit').on('click',function () {
        btnSubmitEvent();
    });

    $('#btnSubmit_fast').on('click',function () {
        btnSubmit_fast();
    });

    $('#login_name').blur(function() {
        var value = this.value;
        value = $.trim(value);
        if( ''!=value && curError=='error_name_empty' ){
            hideMsg();
        }
        $('#login_psw').val('');
    });

    $('#login_name').on('input propertychange', function () {
        $('#login_psw,#conven_code,#login_verifycode').val('');
    })

    $('#login_phone_conven').on('input propertychange', function () {
        $('#login_psw,#conven_code,#login_verifycode').val('');
    })

    $('.index_first_banner').click(function(){
        window.location.href = "/coupon/";
    })

    $('.loginbox').click(function(e){
        e.stopPropagation();
    });

    function showMsg( msgID ,ids){
        if(/msie 6/ig.test(UA)){
            // return alert(error[msgID]);
            return $('.login-error').text(error[msgID]);
        }
        // if( msgID ) alert(error[msgID]);
        $('.login-error').text(error[msgID]);
        curError = msgID;
        $('#' + ids).focus();
    }

    /*function showMsg( msgID ){
        if(/msie 6/ig.test(UA)){
            return alert(error[msgID]);
        }
        var obj = $('#error');
        if( msgID ){
            obj.html( error[msgID] );
        }
        obj.css('visibility','visible');
        curError = msgID;
    }*/

    function hideMsg(){
        var obj = $('#error');
        obj.css('visibility','hidden');
        curError = '';
    }

    function resetCode() {
        var url = "https://yisuapi.yisu.com/index.php/Home/Index/verify/r/" + Math.random();
        $('#reg_code_img').attr('src', url);
        $('#reg_code').val('');
    }

    function createPlaceholder(id,text,top,left){
        top = top || 0;
        left = left || 0;

        var obj = $('#' + id)[0];

        if( undefined!==obj.placeholder ){
            obj.placeholder = text;
            return;
        }

        var parent = obj.parentNode,
            clickEvent = function(){
                $(div)[0].style.visibility = 'hidden';
                var target = this.nextSibling;
                if( target.nodeName=='#text' ){
                    target = target.nextSibling;
                }
                target.focus();
            },
            blurEvent = function(){
                var value = $.trim(this.value);
                if( value=='' )
                {
                    $(div)[0].style.visibility = 'visible';
                }
            },
            focusEvent = function(){
                $(div)[0].style.visibility = 'hidden';
            };

        $(parent).css({position: 'relative'});

        var div = document.createElement('div');
        div.innerHTML = text;
        $(div).css({position: 'absolute', top: top, left: left, color: "#999",'font-size':'14px','z-index':'99999'});
        parent.insertBefore(div,obj);
        $(div).click(clickEvent);
        $(obj).blur(blurEvent);
        $(obj).focus(focusEvent);
    }
})();