
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
    <title>Туристическое агенство «1001 Тур Тверь»</title>
    <meta charset="utf-8">
    <meta name="description" content="Бюро путешествий «1001 Тур Тверь»">
    <meta name="keywords" content="1001 Тур Тверь ТУРИСТИЧЕСКОЕ АГЕНТСТВО ТУРФИРМА в тверь горящие туры дешевые туры турагентство на клыкова тверь языковые курсы за рубежом учеба за рубежом бюро путешествий отдых в украине краснодарский край туры в россию Австрия, аквапарк, Арктика, Беларусь, Болгария, Водопады, Гейзеры, Горы, Греция, Достопримечательности, Жалобы и просьбы, зимний отдых, Индия, Интересное, Испания, Италия, Карпаты, Кипр, Китай, Климат, Круизы, Молдова, Мосты, Новая Зеландия, ОАЭ, Океанариум, Острова, Отели, поход, Россия, Северный Кавказ, Сингапур, Советы, Таиланд, туризм, Турция, туры, Удивительное, Украина, Фестиваль, Финляндия, Хорватия, Чехия, Эксклюзивные туры, Экскурсии, Экстрим Туризм по всем направлениям. Авиа, ж.д. билеты. Страхование путешественника. Индивидуальные туры. Автобусные туры в Европу и экскурсионные туры по России ЗАПОЛНЕНИЕ АНКЕТ НА ЗАГРАНИЧНЫЙ ПАСПОРТ ЗАГРАНПАСПОРТ">
    <meta name="viewport" content="width=device-width, initial-scale = 0.3, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name='yandex-verification' content='7e466fa10e39b6c8' />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <!--======================|Styles|==========================-->
    <link rel="stylesheet" type="text/css" href="/_assets/_landing/_css/template.css">
    <link rel="stylesheet" type="text/css" href="/_assets/_landing/_css/reset.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,500,500i,700,700i&subset=cyrillic" rel="stylesheet">

    <link rel="stylesheet" href="/_assets/_landing/_css/jquery.fancybox.css" type="text/css" media="screen" />
    <!--link rel="stylesheet" href="assets/css/styles.css" /-->
    <link rel="stylesheet" href="/_assets/_landing/_css/jquery.countdown.css" />

    <!--scroll-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/_assets/_landing/_js/jquery.localscroll.js"></script>
    <script type="text/javascript" src="/_assets/_landing/_js/jquery.scrollto.js"></script>
    <script type="text/javascript">
        $(function($) {
            $.localScroll({
                duration: 1000,
                hash: false });
        });
    </script>
    <!--scrol end-->

    <script type="text/javascript" src="/_assets/_landing/_js/style.js"></script>
    <script type="text/javascript" src="/_assets/_landing/_js/jquery.countdown.js"></script>
    <script type="text/javascript" src="/_assets/_landing/_js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="/_assets/_landing/_js/script.js"></script>
    <script type="text/javascript" src="/_assets/_landing/_js/jquery.fancybox.pack.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".fphone").keypress(function (e) {
                //if the letter is not digit then don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });

            $(".fancybox").fancybox({maxWidth: 800 });

            // Подставляем название тура в форму заявки
            $('.tour_desc .fancybox').click(function(){
                var tourName = $(this).siblings('.tour_name').text();
                $('input[name="selected-tour"]').val(tourName);
            });
        });
    </script>
</head>
<body>
<!--menu-->
<div class="menu_wrap">
    <div class="menu block_960">
        <ul>
            <li><a href="#hot-tours">Горящие туры</a></li>
            <li><a href="#why-we">Почему мы</a></li>
            <li><a href="#tour-selection">Подбор тура</a></li>
            <li><a href="#reviews">Отзывы</a></li>
            <li><a href="#contacts">Контакты</a></li>
        </ul>
    </div>
</div>
<!--menu_end-->

<!--header-->
<div class="header_wrap">
    <div class="top">
        <div class="block_960">
            <div class="logo_wrap">
                <img src="/_assets/_landing/_img/logo.png">
            </div>
            <div class="phone_wrap">
                <div class="phone_number bold"><p>Звоните <a href="tel:+7-4822-63-32-50">+7 (4822) 63-32-50</a></p></div>
                <div class="adres"><p>г. Тверь, Трёхсвятская 6К1, 1 этаж, офис 010</p></div>
            </div>
        </div>
    </div>
    <div class="heading block_960">
        <h1 class="bold heading_top">Хотите найти лучшие предложения?</h1>
        <h2 class="desc_heading">Оставьте заявку <span class="bold">прямо сейчас,</span><br>и получите тур по <span class="bold">специальной цене!</span></h2>
    </div>
    <div class="header block_960">
        <div class="header_left">
            <img src="/_assets/_landing/_img/header_arrow.png" class="header_arrow phone_arr">
        </div>
        <div class="header_right">
            <div class="header_form_wrap">
                <!--======================| form-block |==========================-->
                <div class="form-block form_style">
                    <div class="form_heading">
                        <div class="form_big_h big30 bold"><p>Бесплатный подбор тура</p></div>
                        <div class="form_little little15"><p>Оставьте заявку и мы подберем вам тур совершенно бесплатно</p></div>
                    </div>

                    <script type='text/javascript'>
                        function validate(){

                            //Считаем значения из полей name и email в переменные x и y
                            var x=document.forms['form']['name'].value;
                            var y=document.forms['form']['email'].value;
                            var z=document.forms['form']['phone'].value;

                            //Если поле name пустое выведем сообщение и предотвратим отправку формы
                            if (x.length==0){
                                $('#namef').html('*Заполните ваше Имя');
                                return false;
                            }
                            if (z.length==0){
                                document.getElementById('phonef').innerHTML='*Заполните ваш Телефон';
                                return false;
                            }

                            if (y.length==0){
                                document.getElementById('emailf').innerHTML='*Заполните ваш E-mail';
                                return false;
                            }

                            //Проверим содержит ли значение введенное в поле email символы @ и .
                            at=y.indexOf("@");
                            dot=y.indexOf(".");
                            //Если поле не содержит эти символы знач email введен не верно
                            if (at<1 || dot <1){
                                document.getElementById('emailf').innerHTML='*email введен не верно';
                                return false;
                            }
                            reachGoalSend();

                            return true;
                        }
                    </script>
                    <div>
                        <form name='form' action="send.php" method="post" onsubmit="return validate()">
                            <input class="fformname" type="hidden" name="formid" value="Бесплатный подбор">
                            <input type="hidden" id="f-utm" value="">
                            <input type="hidden" name="fefers" class="refer" value="">
                            <input type="text" name="name" class="input_style_1 fname" placeholder="Введите ваше имя" required> <span style='color:red' id='namef'></span><br />
                            <input type="text" name="phone" class="input_style_1 fphone" placeholder="Введите ваш телефон" required> <span style='color:red' id='phonef'></span><br />
                            <input type="email" name="email" class="input_style_1  " placeholder="Введите ваш email" required> <span style='color:red' id='emailf'></span><br />
                            <button  class="send-btn yellow_style size_1"><span>Подобрать</span></button>
                        </form>
                    </div>
                </div>
                <!--======================| .form-block |==========================-->
            </div>
        </div>
    </div>
</div>
<!--header_end-->

<!--eggs-->
<div class="eggs_wrap">
    <div class="eggs block_960">
        <div class="heading_block">Туристическое агентство 1001 Тур Тверь — это:</div>
        <div class="eggs_list profits scroll-animate">
            <!--=========| 1 |===========-->
            <div class="egg anim">
                <div class="number_egg"><em>1625</em></div>
                <div class="desc_egg">туристов за 2014-2015 год</div>
            </div>
            <!--=========| 2 |===========-->
            <div class="egg anim">
                <div class="number_egg"><em>64</em></div>
                <div class="desc_egg">посещенные страны нашими туристами</div>
            </div>
            <!--=========| 3 |===========-->
            <div class="egg anim">
                <div class="number_egg"><em>12</em></div>
                <div class="desc_egg">лет успешной работы</div>
            </div>
            <!--=========| 4 |===========-->
            <div class="egg anim">
                <div class="number_egg"><em>84</em>%</div>
                <div class="desc_egg">постоянных клиентов</div>
            </div>
        </div>
    </div>
</div>
<!--eggs_end-->

<!--leedform (экономь с нами 40%)-->
<div class="leedform_wrap blue_pattern">
    <div class="leedform block_960 profits scroll-animate">
        <div class="leedform_left margintop90">
            <div class="leddform_heading anim"><p>Экономь с нами до 40%</p></div>
            <div class="leddform_desc anim"><p>Наше агентство предлагает своим клиентам единственную в Твери депозитную систему бронирования тура, при которой наши туристы экономят до 40% от стоимости тура</p></div>
            <img src="/_assets/_landing/_img/arrow_b_1.png" class="arrow_b anim phone_arr">
        </div>
        <div class="leedform_form anim">
            <!--======================| form-block |==========================-->
            <div class="form-block form_style">
                <div class="form_heading">
                    <div class="form_big_h big27 bold"><p>Узнайте как сэкономить до 40%</p></div>
                    <div class="form_little little14"><p>Оставьте заявку и мы расскажем вам, как сэкономить на стоимости тура</p></div>
                </div>

                <script type='text/javascript'>
                    function validatef(){
                        //Считаем значения из полей name и email в переменные x и y
                        var x=document.forms['formf']['name'].value;
                        var y=document.forms['formf']['email'].value;
                        var z=document.forms['formf']['phone'].value;

                        //Если поле name пустое выведем сообщение и предотвратим отправку формы
                        if (x.length==0){
                            document.getElementById('nameff').innerHTML='*Заполните ваше Имя';
                            return false;
                        }
                        if (z.length==0){
                            document.getElementById('phoneff').innerHTML='*Заполните ваш Телефон';
                            return false;
                        }

                        if (y.length==0){
                            document.getElementById('emailff').innerHTML='*Заполните ваш E-mail';
                            return false;
                        }

                        //Проверим содержит ли значение введенное в поле email символы @ и .
                        at=y.indexOf("@");
                        dot=y.indexOf(".");
                        //Если поле не содержит эти символы знач email введен не верно
                        if (at<1 || dot <1){
                            document.getElementById('emailff').innerHTML='*email введен не верно';
                            return false;
                        }
                        return true;
                    }
                </script>
                <div>
                    <form name='formf' onsubmit='return validatef()'  action="send.php" method="post">
                        <input class="fformname" type="hidden" name="formid" value="Как сэкономить">
                        <input type="hidden" id="f-utm" value="">
                        <input type="text" name="name" class="input_style_1 fname" placeholder="Введите ваше имя" required> <span style='color:red' id='nameff'></span><br />
                        <input type="text" name="phone" class="input_style_1 fphone" placeholder="Введите ваш телефон" required> <span style='color:red' id='phoneff'></span><br />
                        <input type="email" name="email" class="input_style_1" placeholder="Введите ваш email" required> <span style='color:red' id='emailff'></span><br />
                        <button class="send-btn yellow_style size_1"><span>Узнать</span></button>
                    </form>
                </div>
            </div>
            <!--======================| .form-block |==========================-->
        </div>
    </div>
</div>
<!--leedform_end-->
<!--hot_tours-->
<a name="hot-tours" class="scroll-link"></a>
<div class="hot_tours_wrap profits scroll-animate">
    <div class="hot_tours block_960">
        <h3 class="heading_block">Горящие туры на Сентябрь 2016 года</h3>
        <div class="hot_tours_list">

            <!--=========| 1 |===========-->
            <div class="hot_tour anim">
                <img src="/_assets/_landing/_img/hot_tour_1.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>ОАЭ</p></div>
                    <div class="tour_price"><p>от 20 450 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>
            <!--=========| 2 |===========-->
            <div class="hot_tour anim">
                <img src="/_assets/_landing/_img/hot_tour_2.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>Вьетнам</p></div>
                    <div class="tour_price"><p>от 22 000 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>
            <!--=========| 3 |===========-->
            <div class="hot_tour anim">
                <img src="/_assets/_landing/_img/hot_tour_3.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>Таиланд</p></div>
                    <div class="tour_price"><p>от 32 200 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>
            <!--=========| 4 |===========-->
            <div class="hot_tour anim">
                <img src="/_assets/_landing/_img/hot_tour_4.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>Индия</p></div>
                    <div class="tour_price"><p>от 16 127 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>
            <!--=========| 5 |===========-->
            <div class="hot_tour anim">
                <img src="/_assets/_landing/_img/hot_tour_5.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>Куба</p></div>
                    <div class="tour_price"><p>от 63 100 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>
            <!--=========| 6 |===========-->
            <div class="hot_tour anim">
                <!--div class="tour_mark">Автобусные туры из Твери</div-->
                <img src="/_assets/_landing/_img/hot_tour_6.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>Доминикана</p></div>
                    <div class="tour_price"><p>от 50 200 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>

            <!--=========| 7 |===========-->
            <div class="hot_tour anim">
                <img src="/_assets/_landing/_img/hot_tour_7.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>Мексика</p></div>
                    <div class="tour_price"><p>от 55 900 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>

            <!--=========| 10 |===========-->
            <div class="hot_tour anim">
                <img src="/_assets/_landing/_img/hot_tour_10.jpg" class="hot_tour_img">
                <div class="tour_desc">
                    <div class="tour_name"><p>Шри-Ланка</p></div>
                    <div class="tour_price"><p>от 34 650 рублей</p></div>
                    <a class="fancybox" href="#modal-fire"><button class="yellow_style size_2"><span>Узнать подробнее</span></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--hot_tours_end-->

<!--why-->
<a name="why-we" class="scroll-link"></a>
<div class="why_wrap">
    <div class="why block_960">
        <div class="heading_block">Почему именно мы</div>
        <div class="why_list profits scroll-animate">
            <div class="why_punkt anim"><div class="yellow_style ico_wrap"><img src="/_assets/_landing/_img/why_we_ico_1.png" class="why_img_st"></div><p>С нами вы можете экономить до 40% по депозитной системе бронирования тура</p></div>
            <div class="why_punkt anim"><div class="yellow_style ico_wrap"><img src="/_assets/_landing/_img/why_we_ico_2.png" class="why_img_st"></div><p>Круглосуточная поддержка туристов за границей</p></div>
            <div class="why_punkt anim"><div class="yellow_style ico_wrap"><img src="/_assets/_landing/_img/why_we_ico_3.png" class="why_img_st"></div><p>У нас вы можете приобрести тур в рассрочку без переплат и комиссий</p></div>
            <div class="why_punkt anim"><div class="yellow_style ico_wrap"><img src="/_assets/_landing/_img/why_we_ico_4_1.png" class="why_img_st"></div><p>Возможность вылета из любого города России и СНГ</p></div>
            <div class="why_punkt anim"><div class="yellow_style ico_wrap"><img src="/_assets/_landing/_img/why_we_ico_5.png" class="why_img_st"></div><p>Возможность дополнительного страхования</p></div>
            <div class="why_punkt anim"><div class="yellow_style ico_wrap"><img src="/_assets/_landing/_img/why_we_ico_6.png" class="why_img_st"></div><p>84% клиентов приходят к нам снова</p></div>
            <div class="why_punkt anim"><div class="yellow_style ico_wrap"><img src="/_assets/_landing/_img/why_we_ico_7.png" class="why_img_st"></div><p>Мы предлагаем высококачественный продукт от ведущих туроператоров</p></div>
        </div>
    </div>
</div>
<!--why_end-->

<!--podbor-->
<a name="tour-selection" class="scroll-link"></a>
<div class="podbor_wrap">
    <div class="podbor block_960 profits scroll-animate animate">
        <div class="heading_block">Подбор тура</div>
        <div class="podbor_over">
            <!--=========| 1 |===========-->

            <script type='text/javascript'>
                function validatefffffs(){
                    //Считаем значения из полей name и email в переменные x и y
                    var z=document.forms['formffsafd']['phone'].value;
                    if (z.length==0){
                        document.getElementById('phonefffdsa').innerHTML='*Заполните ваш Телефон';
                        return false;
                    }

                    return true;
                }
            </script>

            <form name="formffsafd" onsubmit="return validatefffffs()" action="choise.php" method="post">
                <div class="pod_line anim" style="opacity: 1; transform: scale(1, 1);">
                    <div class="pod_step">1</div>
                    <div class="pod_znach">
                        <div class="pod_select_wrap">
                            <div class="pod_select_label">Куда</div>
                            <div class="inputs">
                                <div class="select_long_wrap">
                                    <select class="select select_long fwhere" name="country">
                                        <option>Австрия</option>
                                        <option>Болгария</option>
                                        <option>Вьетнам</option>
                                        <option>Греция</option>
                                        <option>Доминикана</option>
                                        <option>Египет</option>
                                        <option>Израиль</option>
                                        <option>Индия</option>
                                        <option>Индонезия</option>
                                        <option>Иордания</option>
                                        <option>Испания</option>
                                        <option>Италия</option>
                                        <option>Кипр</option>
                                        <option>Китай</option>
                                        <option>Куба</option>
                                        <option>Маврикий</option>
                                        <option>Мальдивы</option>
                                        <option>Марокко</option>
                                        <option>Мексика</option>
                                        <option selected="selected">ОАЭ</option>
                                        <option>Сейшелы</option>
                                        <option>Сингапур</option>
                                        <option>Таиланд</option>
                                        <option>Тунис</option>
                                        <option>Турция</option>
                                        <option>Франция</option>
                                        <option>Хорватия</option>
                                        <option>Черногория</option>
                                        <option>Чехия</option>
                                        <option>Шри-Ланка</option>
                                    </select><span style="color:red" id="countryq"></span></br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--=========| 2 |===========-->
                <div class="pod_line anim" style="opacity: 1; transform: scale(1, 1);">
                    <div class="pod_step">2</div>
                    <div class="pod_znach">
                        <div class="pod_select_wrap">
                            <div class="pod_select_label">Когда</div>
                            <div class="inputs">
                                <div class="date_long_wrap">
                                    <input class="select select_long date_style fwhen" placeholder="дд-мм-гг" name="time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=========| 3 |===========-->
                <div class="pod_line anim" style="opacity: 1; transform: scale(1, 1);">
                    <div class="pod_step">3</div>
                    <div class="pod_znach">
                        <div class="pod_select_wrap">
                            <div class="pod_select_label">Продолжительность</div>
                            <div class="inputs">
                                <div class="select_small_wrap">
                                    <select class="select select_small fhowmanyfrom" name="from">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                    </select>
                                </div>
                                <span class="def_input">-</span>
                                <div class="select_small_wrap">
                                    <select class="select select_small fhowmanyto" name="to">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                    </select>
                                </div>
                                <span class="def_input">ночей</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=========| 4 |===========-->
                <div class="pod_line anim" style="opacity: 1; transform: scale(1, 1);">
                    <div class="pod_step">4</div>
                    <div class="pod_znach">
                        <div class="pod_select_wrap">
                            <div class="pod_select_label">Кто едет</div>
                            <div class="inputs">
                                <span class="def_input last_def_input">Взрослые:</span>
                                <div class="select_small_wrap">
                                    <select class="select select_small fadults" name="adult">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                    </select>
                                </div>
                                <span class="def_input">Дети:</span>
                                <div class="select_small_wrap">
                                    <select class="select select_small fchildren" name="children">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--=========| 5 |===========-->
                <div class="pod_line anim" style="opacity: 1; transform: scale(1, 1);">
                    <div class="pod_step">5</div>
                    <div class="pod_znach">
                        <div class="pod_select_wrap">
                            <div class="inputs">
                                <input class="input_style_1 fphone" placeholder="Ваш телефон" name="phone"  ><br /><span style='color:red' id='phonefffdsa'></span><br />
                            </div>
                        </div>
                    </div>
                </div>

                <!--=========| 6 |===========-->
                <div class="pod_line align-centr anim" style="opacity: 1; transform: scale(1, 1);">
                    <button class="yellow_style size_3 show-1" type="submit"><span>Подобрать тур</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--podbor_end-->

<!--leedform (шенгенская виза)-->
<div class="leedform_wrap blue_pattern profits scroll-animate">
    <div class="leedform block_960">
        <div class="leedform_left margintop50">
            <div class="leddform_heading anim"><p>Внимание, акция!</p></div>
            <div class="leddform_heading anim"><p>Один день к вашему отдыху бесплатно!</p></div>
            <div class="timer_js anim">
                <div class="timer_label">До конца акции осталось:</div>
                <div id="countdown"></div>
            </div>
            <img src="/_assets/_landing/_img/arrow_b_1.png" class="arrow_b_2 anim phone_arr">
        </div>
        <div class="leedform_form anim">
            <!--======================| form-block |==========================-->
            <div class="form-block form_style">
                <div class="form_heading">
                    <div class="form_big_h bold"><p>Оставьте заявку и получите день к вашему отдыху бесплатно</p></div>
                </div>

                <script type='text/javascript'>
                    function validateff(){
                        //Считаем значения из полей name и email в переменные x и y
                        var x=document.forms['formff']['name'].value;
                        var y=document.forms['formff']['email'].value;
                        var z=document.forms['formff']['phone'].value;

                        //Если поле name пустое выведем сообщение и предотвратим отправку формы
                        if (x.length==0){
                            document.getElementById('namefff').innerHTML='*Заполните ваше Имя';
                            return false;
                        }
                        if (z.length==0){
                            document.getElementById('phonefff').innerHTML='*Заполните ваш Телефон';
                            return false;
                        }

                        if (y.length==0){
                            document.getElementById('emailfff').innerHTML='*Заполните ваш E-mail';
                            return false;
                        }

                        //Проверим содержит ли значение введенное в поле email символы @ и .
                        at=y.indexOf("@");
                        dot=y.indexOf(".");
                        //Если поле не содержит эти символы знач email введен не верно
                        if (at<1 || dot <1){
                            document.getElementById('emailff').innerHTML='*email введен не верно';
                            return false;
                        }

                        return true;
                    }
                </script>

                <div>
                    <form name='formff' onsubmit='return validateff()' action="send.php" method="post">
                        <input class="fformname" type="hidden" name="formid" value="Акция">
                        <input type="hidden" id="f-utm" value="">
                        <input type="text" name="name" class="input_style_1 fname" placeholder="Введите ваше имя" required> <span style='color:red' id='namefff'></span><br />
                        <input type="text" name="phone" class="input_style_1 fphone" placeholder="Введите ваш телефон" required> <span style='color:red' id='phonefff'></span><br />
                        <input type="email" name="email" class="input_style_1" placeholder="Введите ваш email" required> <span style='color:red' id='emailfff'></span><br />
                        <button class="send-btn yellow_style size_1"><span>Получить</span></button>
                    </form>
                </div>
                <script type="text/javascript" src="http://app.getresponse.com/view_webform.js?wid=8985001&mg_param1=1&u=Tx54"></script>
            </div>
            <!--======================| .form-block |==========================-->
        </div>
    </div>
</div>
<!--leedform_end-->

<!--reviews-->
<a name="reviews" class="scroll-link"></a>

<div class="reviews_wrap profits scroll-animate">
    <div class="reviews block_960">
        <div class="heading_block">Отзывы наших клиентов</div>
        <div class="reviewes_list">
            <div class="reviews_col rcol_1">
                <!--=========| 1-1 |===========-->
                <div class="review anim">
                    <img src="/_assets/_landing/_img/rev_ico.png" class="rew_ico_st">
                    <div class="rev_text">
                        <div class="rev_heading"><p>Спасибо Турагентству в Твери 1001 ТУР</p></div>
                        <div class="rev_user_text">
                            <p>Спасибо Турагентству в Твери "1001 ТУР" за индивидуальный подход к моим желаниям по отдыху в Турцию! Хотелось просто Солнца и Моря покупая тур в Турцию, а в итоге пришлось получить еще кучу незабываемых впечатлений! ;)</p>
                        </div>
                    </div>
                    <div class="user_info">
                        <div class="user_name">ИГОРЬ ВЛАДИМИРОВИЧ</div>
                        <img src="/_assets/_landing/_img/photo_1.jpg">
                        <a class="fancybox" href="#modal-want"><button class="yellow_style size_2 show-w-1"><span>Хочу также!</span></button></a>
                    </div>
                </div>

                <!--=========| 1-2 |===========-->
                <div class="review anim">
                    <img src="/_assets/_landing/_img/rev_ico.png" class="rew_ico_st">
                    <div class="rev_text">
                        <div class="rev_heading"><p>СПАСИБО турагентству в Твери "1001 тур"</p></div>
                        <div class="rev_user_text">
                            <p>1000 и 1 раз хочу сказать СПАСИБО турагентству в Твери "1001 ТУР" за то, что смогли услышать, понять и реализовать наши желания, предложив сказочный тур в Турцию! Спасибо Вам!!!</p>
                        </div>
                    </div>
                    <div class="user_info">
                        <div class="user_name">ЕЛЕНА ЛОБАЗЕВА<br></div>
                        <img src="/_assets/_landing/_img/photo_3.jpg">
                        <a class="fancybox" href="#modal-want"><button class="yellow_style size_2 show-w-1"><span>Хочу также!</span></button></a>
                    </div>
                </div>


            </div>
            <div class="reviews_col rcol_2">
                <!--=========| 2-1 |===========-->
                <div class="review anim">
                    <img src="/_assets/_landing/_img/rev_ico.png" class="rew_ico_st">
                    <div class="rev_text">
                        <div class="rev_heading"><p>Турфирма в Твери стала первым звеном</p></div>
                        <div class="rev_user_text">
                            <p>Турфирма в Твери стала первым звеном в цепочке замечательных организаций, которые устроили наш отдых, передавая нас из рук в руки. Мы с мужем почувствовали себя уже в отпуске, когда выбирали путёвку в Египет, это было интересно, в следующий раз обязательно купим у Вас тур в Тайланд</p>
                        </div>
                    </div>
                    <div class="user_info">
                        <div class="user_name">ЕЛЕНА КОМИССАРОВА</div>
                        <img src="/_assets/_landing/_img/photo_2.jpg">
                        <a class="fancybox" href="#modal-want"><button class="yellow_style size_2 show-w-1"><span>Хочу также!</span></button></a>
                    </div>
                </div>

                <!--=========| 2-2 |===========-->
                <div class="review anim">
                    <img src="/_assets/_landing/_img/rev_ico.png" class="rew_ico_st">
                    <div class="rev_text">
                        <div class="rev_heading"><p>Дорогое турагентство «1001 Тур»!</p></div>
                        <div class="rev_user_text">
                            <p>Дорогое турагентство «1001 Тур»! Большое спасибо за вашу работу! Было очень приятно и правильно доверить вам наш отдых) будем летать с вами в Тайланд, Вьетнам, Грецию, Доминикану и много других стран. Нам очень понравилось, что есть такое замечательно турагентство у нас в Твери!</p>
                        </div>
                    </div>
                    <div class="user_info">
                        <div class="user_name">ОЛЬГА МЕЛЬНИКОВА</div>
                        <img src="/_assets/_landing/_img/photo_5.jpg">
                        <a class="fancybox" href="#modal-want"><button class="yellow_style size_2 show-w-1"><span>Хочу также!</span></button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--reviews_end-->

<!--our_partners-->
<div class="our_partners_wrap profits scroll-animate">
    <div class="our_partners block_960">
        <div class="heading_block">Наши партнеры</div>
        <img src="/_assets/_landing/_img/our_partners.jpg" class="our_part_img anim">
    </div>
</div>
<!--our_partners_end-->
<!--leedform (Остались вопросы)-->
<a name="contacts" class="scroll-link"></a>
<div class="leedform_wrap blue_pattern leedcall profits scroll-animate">
    <div class="leedform block_960">
        <div class="leedform_left margintop20">
            <div class="leddform_heading anim"><p>Остались вопросы?</p></div>
            <div class="leddform_desc anim"><p>Позвоните нам или оставьте заявку на сайте и наш менеджер ответит на все ваши вопросы</p></div>
            <img src="/_assets/_landing/_img/arrow_b_2.png" class="arrow_b_3 anim phone_arr">
        </div>
        <div class="leedform_form">
            <div class="leed_form_phone">
                <div class="phone_number_leed"><p><a href="tel:+7-4822-63-32-50">+7 (4822) 63-32-50</a></p></div>
                <a class="fancybox" href="#modal-callback"><button class="yellow_style size_3 show-2"><span>Заказать звонок</span></button></a>
            </div>
        </div>
    </div>
</div>
<!--leedform_end-->

<!--where-->
<div class="where_wrap">
    <div class="where block_960 profits scroll-animate">
        <div class="heading_block">Где мы находимся</div>
        <img src="/_assets/_landing/_img/map_mark.png" class="anim">
        <div class="contacts anim">
            <div class="comp_name_cont"><p>Туристическое агентство<br>«1001 Тур Тверь»</p></div>
            <div class="comp_adr_cont"><p>г. Тверь,<br> Трёхсвятская 6К1, 1 этаж, офис 010</p></div>
            <div class="comp_phone_cont">
                <p>+7 (4822) 63-32-50</p>
                <p>10:00 - 20:00</p>
                <p class="bold">без перерыва и выходных</p>
            </div>
        </div>
    </div>
</div>
<!--where_end-->

<!--footer-->
<div class="footer_wrap">
    <div class="footer block_960">
        <div class="footer_center">
            <p>© 2016 «1001 Тур Тверь»</p>
            <p><a class="fancybox" href="#modal-conf">политика конфиденциальности</a></p>
        </div>
        <div class="footer_rigth">

        </div>
    </div>
</div>
<!--footer_end-->

<!--====| modal windows |====-->

<!--=============================|Модальное окно (хочу так же)|=================================-->
<!--======================| form-block |==========================-->
<div class="form-block form_style" id="modal-want" style="display: none">
    <div class="form_heading">
        <div class="form_big_h big23 bold"><p>Хотите так же? Оставьте заявку и мы свяжемся с вами</p></div>
        <div class="form_little little14"></div>
    </div>
    <script type='text/javascript'>
        function validateffs(){
            //Считаем значения из полей name и email в переменные x и y
            var x=document.forms['formffs']['name'].value;
            var y=document.forms['formffs']['email'].value;
            var z=document.forms['formffs']['phone'].value;

            //Если поле name пустое выведем сообщение и предотвратим отправку формы
            if (x.length==0){
                document.getElementById('namefffa').innerHTML='*Заполните ваше Имя';
                return false;
            }
            if (z.length==0){
                document.getElementById('phonefffa').innerHTML='*Заполните ваш Телефон';
                return false;
            }

            if (y.length==0){
                document.getElementById('emailfffa').innerHTML='*Заполните ваш E-mail';
                return false;
            }

            //Проверим содержит ли значение введенное в поле email символы @ и .
            at=y.indexOf("@");
            dot=y.indexOf(".");
            //Если поле не содержит эти символы знач email введен не верно
            if (at<1 || dot <1){
                document.getElementById('emailff').innerHTML='*email введен не верно';
                return false;
            }

            return true;
        }
    </script>
    <div id="WFItem8985001" class="wf-formTpl">
        <form  name='formffs' onsubmit='return validateffs()' action="otzv.php" method="post">
            <input class="fformname" type="hidden" name="formid" value="Хотите также?">
            <input type="hidden" id="f-utm" value="">
            <input type="text" name="name" class="input_style_1 fname" placeholder="Введите ваше имя"> <span style='color:red' id='namefffa'></span><br />
            <input type="text" name="phone" class="input_style_1 fphone" placeholder="Введите ваш телефон"> <span style='color:red' id='phonefffa'></span><br />
            <input type="email" name="email" class="input_style_1" placeholder="Введите ваш email"> <span style='color:red' id='emailfffa'></span><br />
            <button class="send-btn yellow_style size_1" type="submit"><span>Получить</span></button>
        </form>
    </div>
</div>
<!--======================| .form-block |==========================-->

<!--=============================|Модальное окно (горящие туры)|=================================-->
<!--======================| form-block |==========================-->
<div class="form-block form_style" id="modal-fire" style="display: none">
    <div class="form_heading">
        <div class="form_big_h big23 bold"><p>Оставьте заявку чтобы узнать подробнее</p></div>
        <div class="form_little little14"></div>
    </div>
    <script type='text/javascript'>
        function validateffss(){
            //Считаем значения из полей name и email в переменные x и y
            var x=document.forms['formffss']['name'].value;
            var y=document.forms['formffss']['email'].value;
            var z=document.forms['formffss']['phone'].value;

            //Если поле name пустое выведем сообщение и предотвратим отправку формы
            if (x.length==0){
                document.getElementById('namefffas').innerHTML='*Заполните ваше Имя';
                return false;
            }
            if (z.length==0){
                document.getElementById('phonefffas').innerHTML='*Заполните ваш Телефон';
                return false;
            }

            if (y.length==0){
                document.getElementById('emailfffas').innerHTML='*Заполните ваш E-mail';
                return false;
            }

            //Проверим содержит ли значение введенное в поле email символы @ и .
            at=y.indexOf("@");
            dot=y.indexOf(".");
            //Если поле не содержит эти символы знач email введен не верно
            if (at<1 || dot <1){
                document.getElementById('emailff').innerHTML='*email введен не верно';
                return false;
            }
            return true;
        }
    </script>
    <div>
        <form name='formffss' onsubmit='return validateffss()' action="send.php" method="post">
            <input type="hidden" name="selected-tour" value="">
            <input class="fformname" type="hidden" name="formid" value="Горящий тур">
            <input type="text" name="name" class="input_style_1 fname" placeholder="Введите ваше имя" required> <span style='color:red' id='namefffas'></span><br />
            <input type="text" name="phone" class="input_style_1 fphone" placeholder="Введите ваш телефон" required> <span style='color:red' id='phonefffas'></span><br />
            <input type="email" name="email" class="input_style_1" placeholder="Введите ваш email" required> <span style='color:red' id='emailfffas'></span><br />
            <button class="send-btn yellow_style size_1" type="submit"><span>Получить</span></button>
        </form>
    </div>
    <script type="text/javascript" src="http://app.getresponse.com/view_webform.js?wid=8985001&mg_param1=1&u=Tx54"></script>
</div>
<!--======================| .form-block |==========================-->

<!--=============================|Модальное окно (заказать звонок)|=================================-->
<!--======================| form-block |==========================-->
<div class="form-block form_style" id="modal-callback" style="display: none">
    <div class="form_heading">
        <div class="form_big_h big23 bold"><p>Заказать звонок</p></div>
        <div class="form_little little14"></div>
    </div>
    <script type='text/javascript'>
        function validateffssg(){
            //Считаем значения из полей name и email в переменные x и y
            var x=document.forms['formffssg']['name'].value;
            var y=document.forms['formffssg']['email'].value;
            var z=document.forms['formffssg']['phone'].value;

            //Если поле name пустое выведем сообщение и предотвратим отправку формы
            if (x.length==0){
                document.getElementById('namefffasg').innerHTML='*Заполните ваше Имя';
                return false;
            }
            if (z.length==0){
                document.getElementById('phonefffasg').innerHTML='*Заполните ваш Телефон';
                return false;
            }

            if (y.length==0){
                document.getElementById('emailfffasg').innerHTML='*Заполните ваш E-mail';
                return false;
            }

            //Проверим содержит ли значение введенное в поле email символы @ и .
            at=y.indexOf("@");
            dot=y.indexOf(".");
            //Если поле не содержит эти символы знач email введен не верно
            if (at<1 || dot <1){
                document.getElementById('emailfffasg').innerHTML='*email введен не верно';
                return false;
            }
            return true;
        }
    </script>
    <div>
        <form name='formffssg' onsubmit='return validateffssg()' action="send.php" method="post">
            <input class="fformname" type="hidden" name="formid" value="Заказать звонок">
            <input type="text" name="name" class="input_style_1 fname" placeholder="Введите ваше имя" required> <span style='color:red' id='namefffasg'></span><br />
            <input type="text" name="phone" class="input_style_1 fphone" placeholder="Введите ваш телефон" required> <span style='color:red' id='phonefffasg'></span><br />
            <input type="email" name="email" class="input_style_1  " placeholder="Введите ваш email" required> <span style='color:red' id='emailfffasg'></span><br />
            <button class="send-btn yellow_style size_1" type="submit"><span>Заказать</span></button>
        </form>
    </div>
</div>
<!--======================| .form-block |==========================-->

<!--=============================|Модальное окно (политика конфидециальности)|=================================-->
<!--======================| form-block |==========================-->
<p class="conf_text" id="modal-conf" style="display: none">
    Оставляя заявку на сайте 1001tver.ru Вы даете свое согласие на обработку Ваших персональных данных.Полученные персональные данные не подлежат представлению третьим лицам без Вашего письменного согласия и используются исключительно для достижения вышеизложенной цели. Полученные персональные данные обрабатываются в течение одного дня с момента их получения. Срок хранения персональных данных составляет 14 дней с момента их получения. Обработка персональных данных осуществляется в соответствии с Федеральным законом от 27.07.2006 N 152-ФЗ (ред. от 23.07.2013) "О персональных данных"
</p>
<!--======================| .form-block |==========================-->

</body>
</html>