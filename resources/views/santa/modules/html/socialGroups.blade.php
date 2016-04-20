<br/><br/><br/>
<div class="row">
    <div class="col-xs-8">
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
        <div id="vk_groups"></div>
        <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 0, width: "220", height: "300", color1: 'FFFFFF', color2: '2B587A', color3: '507296'}, 55600044);
        </script>
    </div>
    <div class="col-xs-8">
        <div id="ok_group_widget"></div>
        <script>
            !function (d, id, did, st) {
                var js = d.createElement("script");
                js.src = "http://connect.ok.ru/connect.js";
                js.onload = js.onreadystatechange = function () {
                    if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                        if (!this.executed) {
                            this.executed = true;
                            setTimeout(function () {
                                OK.CONNECT.insertGroupWidget(id,did,st);
                            }, 0);
                        }
                    }}
                d.documentElement.appendChild(js);
            }(document,"ok_group_widget","53664952418315","{width:220,height:300}");
        </script>
    </div>
    <div class="col-xs-8">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like-box" data-href="https://www.facebook.com/santaavia" data-width="220" data-height="300"
             data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
    </div>
</div>