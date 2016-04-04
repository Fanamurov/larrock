<div class="block-module_listHotTours">
    <h1>Горящие туры, путевки из Хабаровска.</h1>
    <h2>Авиабилеты и гостиницы Вьетнама, Тайланда, Китая</h2>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">ОАЭ</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Тайланд</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Вьетнам</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Россия</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            @for($i=0; $i < 3; $i++)
            <div class="row">
                <div class="col-xs-12 col-sm-5">
                    <img src="/test/hotTours/2e670c1e20f29b7aa3757f950c49437b.jpg" alt="">
                </div>
                <div class="col-xs-12 col-sm-5">
                    <a href="#">Marco Polo Hotel 4*</a>
                    <p>Дубай</p>
                </div>
                <div class="col-xs-12 col-sm-3">13.04.2016</div>
                <div class="col-xs-12 col-sm-5">7 ночей</div>
                <div class="col-xs-12 col-sm-5">От 31 386 руб. <span class="glyphicon glyphicon-chevron-right"></span></div>
            </div><hr/>
            @endfor
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">...</div>
        <div role="tabpanel" class="tab-pane" id="messages">...</div>
        <div role="tabpanel" class="tab-pane" id="settings">...</div>
    </div>
</div>