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
            <table class="table">
                @for($i=0; $i < 3; $i++)
                <tr>
                    <td>
                        <img src="/test/hotTours/2e670c1e20f29b7aa3757f950c49437b.jpg" alt="">
                    </td>
                    <td>
                        <a href="#">Marco Polo Hotel 4*</a>
                        <p>Дубай</p>
                    </td>
                    <td>13.04.2016</td>
                    <td>7 ночей</td>
                    <td>От 31 386 руб.</td>
                    <td><span class="glyphicon glyphicon-chevron-right"></span></td>
                </tr>
                @endfor
            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">...</div>
        <div role="tabpanel" class="tab-pane" id="messages">...</div>
        <div role="tabpanel" class="tab-pane" id="settings">...</div>
    </div>
</div>