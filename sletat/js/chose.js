var ajaxUri = '/sletat/';
allToursData = null;
sletatGetcheck = 0;
function parseGetParams() { 
   var $_GET = {}; 
   var __GET = window.location.search.substring(1).split("&"); 
   for(var i=0; i<__GET.length; i++) { 
      var getVar = __GET[i].split("="); 
      $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1]; 
   } 
   return $_GET; 
}
function ifGet(){
    if(sletatGetcheck !== 0){
        return false;
    }
    sletatGetcheck++;
    if(parseGetParams()['sta'] === '1'){
       $("#country [value='"+parseGetParams()['countryId']+"']").attr("selected", "selected");
       $("#townFrom [value='"+parseGetParams()['townFrom']+"']").attr("selected", "selected");
       $("[name='nights'] [value='"+parseGetParams()['nights']+"']").attr("selected", "selected");
       var month = parseGetParams()['month'];
       if(month !== undefined && month !== ''){
           $('#datepicker').val(month.replace('%2F','/').replace('%2F','/'));
       }
       GetCities();
       $('.button5').click();
    }
}
function GetDepartCities(){
    $.ajax({
             type: "POST",
             url: ajaxUri+"core/core.php",
             data: {auth:false, method:'GetDepartCities'},
             success: function(Obj) {
                //console.log(Obj)
                 var dptTown = JSON.parse(Obj);
                 dptTown = dptTown.GetDepartCitiesResult.Data;
                 var line = '';
                 for (var p in dptTown){
                     line += '<option value="'+dptTown[p].Id+'">'+dptTown[p].Name+'</option>';
                 }
				 $('#townFrom').empty();
                 $('#townFrom').append(line);
                 $('#townFrom').prepend($('#townFrom option[value="1331"]'));
                 $('#townFrom').prepend($('#townFrom option[value="1293"]'));
                 $('#townFrom').prepend($('#townFrom option[value="832"]'));
                 $('#townFrom').prepend($('#townFrom option[value="1286"]'));
                 $('#townFrom option[value="1286"]').prop('selected', true);
                 $('#townFrom option[value="1264"]').insertBefore($('#townFrom option[value="1271"]'));
                 GetCountries();
             }
    });
}
/*setTimeout(GetDepartCities, 4000)*/
function GetCountries(){
    var selectedCountry = $('#country :selected').val()
    var townFromId = $('#townFrom :selected').val();
    if(selectedCountry === undefined)selectedCountry = 40;
    $.ajax({
             type: "POST",
             url: ajaxUri+"core/core.php",
             data: {auth:false, method:'GetCountries',  townFromId: townFromId},
             success: function(Obj) {
                 var countries = JSON.parse(Obj);
                 a = countries;
                 countries = countries.GetCountriesResult.Data;
                 var line = '';
                 for (var p in countries){
                     line += '<option value="'+countries[p].Id+'">'+countries[p].Name+'</option>';
                 }
                 $('#country').empty();
                 $('#country').append(line);
                 $("#country [value='"+selectedCountry+"']").attr("selected", "selected");
                 GetCities();
                 ifGet();
             }
    });
}

function GetCities(){
   var countryId = $('#country').val();
        $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: {auth:false, method:'GetCities', countryId: countryId},
                success: function(html) {
                    var obj = JSON.parse(html);
                    obj = obj.GetCitiesResult.Data;
                    var line = '<option selected="selected" value="all">Все</option>';
                    for (var p in obj){
                        line += '<option value="'+obj[p].Id+'">'+obj[p].Name+'</option>';
                    }
                    $('#cities').empty();
                    $('#cities').append(line);
                    $("#cities [value='"+parseGetParams()['resort']+"']").attr("selected", "selected");
                    GetHotels();
                }
        });
}

function GetHotels(check){
   var countryId = $('#country').val();
   if($('#cities').val() === 'all')check = false;
   if(check){
       var towns = $('#cities').val();
       var data = {auth:false, method:'GetHotels', countryId: countryId, count: -1, towns: towns};
   }else{
   var data = {auth:false, method:'GetHotels', countryId: countryId, count: -1};
   }
        $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: data,
                success: function(html) {
                    var obj = JSON.parse(html);
                    obj = obj.GetHotelsResult.Data;
                    var line = '<option selected="selected" value="all">Все</option>';
                    for (var p in obj){
                        line += '<option value="'+obj[p].Id+'">'+obj[p].Name+'</option>';
                    }
                    $('#hotel').empty();
                    $('#hotel').append(line);
                }
        });
}

function GetRequestResult(check){
    $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: data,
                success: function(html) {
                 toursObj = JSON.parse(html);
                 toursCount = toursObj.GetToursResult.Data.iTotalRecords;
                 var loadOperators = parseInt($('#operatorsNum').text());
                 $('#minPrice').html('');
                 if(loadOperators === countOperators && toursCount === 0){
                    $('#content_otel').empty();
                    $('#content_otel').append('<h2 style="text-align:center">По заданным параметрам туров не найдено</h2>');
                    return false;
                }
                        if(typeof minPrices == 'undefined' || minPrices>toursObj.GetToursResult.Data.aaData[0][42]){
                            minPrices = toursObj.GetToursResult.Data.aaData[0][42];
                        }
                     $('#minPrice').empty();
                     var tours = declOfNum(toursCount, ['тур','тура','туров']); 
                     $('#minPrice').append('<span>Найдено </span>'+toursCount+' '+tours+' по цене: от <span class="minPrice">'+minPrices+' руб.</span>');
                     if(check)return false;
                if(toursObj.GetToursResult.Data.visaRange !== null){
                visaRange = toursObj.GetToursResult.Data.visaRange[1];
                visaCurrencyName = toursObj.GetToursResult.Data.visaRange[0];
                }else{
                  visaRange = null;
                  visaCurrencyName = null;
                }
                toursCountCheck = toursCount;
                drawTours(toursObj);
              }
            });
}

function getTours(){
    $('#operators').html('');
    $('#minPrice').html('');
    if(typeof minPrices != 'undefined')minPrices = undefined;
    $('form#form').submit(false);
    $('#operators').empty();
     $('.SLbutton').detach();
    $('#minPrice').empty();
    $('#content_otel').empty();
    $('#paginator').empty();
    var adults = parseInt($('[name=adults] :selected').val());
    var kids = parseInt($('[name=kids] :selected').val());
    peopleCount = adults+kids;
data = new Object();
data.cityFromId = $('#townFrom').val();
data.countryId = $('#country').val();
if($('#cities').val() !== 'all')data.cities = $('#cities').val();
if($('[name="meal]"').val() !== 'all')data.meals = $('[name="meal]').val();
if($('#stars').val() !== 'all')data.stars = $('#stars').val();
if($('#hotel').val() !== 'all')data.hotels = $('#hotel').val();
data.s_adults = adults;
if(kids !== 0)data.s_kids = kids;
data.s_nightsMin = parseInt($('#nights').val());
data.s_nightsMax = data.s_nightsMin+7;
if($('[name="minPrice"]').val() !== '')data.s_priceMin = $('[name="minPrice"]').val();
if($('[name="maxPrice"]').val() !== '')data.s_priceMax = $('[name="maxPrice"]').val();
data.currencyAlias = 'RUB';
data.s_departFrom = $('#datepicker').val();
data.s_departTo = getNextWeek(data.s_departFrom);
data.s_hotelIsNotInStop = true;
data.s_hasTickets = true;
data.s_ticketsIncluded = true;
data.pageSize = 5;
data.pageNumber = 1;
data.includeDescriptions = 1;
data.includeOilTaxesAndVisa = 1;
data.auth = true;
data.method = 'GetTours';
    $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: data,
                success: function(html) {
                    aaa = html;
                    var load = JSON.parse(html);
                    requestId = load.GetToursResult.Data.requestId;
                    GetRequestState();
                }
        });
}

function GetRequestState(){
    var wait = false;
    var firstLoad = false;
    var j = 0;
    $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: {auth:true, method:'GetLoadState', requestId: requestId},
                success: function(html) {
                    load = JSON.parse(html);
                    loadRes = load.GetLoadStateResult.Data;
                    countOperators = Object.keys(loadRes).length;
                    for(var p in loadRes){
                        if(loadRes[p].IsProcessed === false)wait = true;
                        if(loadRes[p].IsProcessed === true){
                            if(loadRes[p].RowsCount !== 0 && $('.currentPage').text() === '')firstLoad = true;
                            j++;
                        }
                    }
                    if(firstLoad){
                        GetRequestResult();
                        setTimeout(GetRequestState,1000);
                        return false;
                    }
                    $('#operators').empty();
                    $('.SLbutton').detach();
                    $('#operators').append('Загружено операторов: <span id="operatorsNum">'+j+'</span> из '+countOperators);
                    $('#operators').after('<div class="SLbutton" onclick="GetRequestResult();pagination();">Показать</div>');
                    GetRequestResult(true);
                    if(wait) setTimeout(GetRequestState,1000);
                }
        });
}

function drawTours(obj){
    $('#holder').detach();
    $('#content_otel').empty();
        allToursData = obj.GetToursResult.Data.aaData;
        allToursDataLenght = obj.GetToursResult.Data.iTotalRecords;
            for (var p in allToursData){
            drawOneTour(allToursData[p],p);
            }
            if($('.currentPage').text() === ''){
                pagination();
            }else{
                pagRedraw();
            }
}

function pagination(){
    $('#paginator').empty();
    toursOnPage = 5;
    totalPage = Math.ceil(allToursDataLenght/toursOnPage);
    var line = '<a href="#" class="prev"><img src="/sletat/images/prev.png"></a>';
	line+= '<div class="num_paginator">';
        if($('.currentPage').text() === ''){
            line+= '<a href="#" class="currentPage">1</a>';
        }else{
            line+= '<a href="#">1</a>';
        }
	
        var i = 2;
        if(totalPage<5){
            for(i;i<totalPage;i++){
                line+= '<a href="#">'+i+'</a>';  
            }
        }
        if(totalPage>8){
            for(i;i<8;i++){
                line+= '<a href="#">'+i+'</a>';  
            }
            line+= ' ... ';
            line+= '<a href="#">'+totalPage+'</a>';
        }
        
	line+= '</div>';
	line+= '<a href="#" class="next"><img src="/sletat/images/next.png"></a>';
        $('#paginator').empty();
        $('#paginator').append(line);
}

function drawOneTour(obj,i){
console.log(obj);
    var visaLine = '';
    if(visaRange !== null){
        for (var p in visaRange){
            if(obj[1] === visaRange[p][0]){
                if(visaRange[p][2] != null){
                  visaLine = '<span class="no_doplaty">Виза '+visaRange[p][1]+'-'+visaRange[p][2]+' '+visaCurrencyName+'</span>';  
                }else{
                  visaLine = '<span class="no_doplaty">Виза '+visaRange[p][1]+' '+visaCurrencyName+'</span>';
                }
                var minVisa = visaRange[p][1];
                var maxVisa = visaRange[p][2];
            }
        }
        if(maxVisa === 0)visaLine='';
    }
    var oilLine = '';
    if(toursObj.GetToursResult.Data.oilTaxes !== null && toursObj.GetToursResult.Data.oilTaxes[0] !== undefined){
       var oilTax = toursObj.GetToursResult.Data.oilTaxes;
       for (var p in oilTax){
            if(obj[1] === oilTax[p][0] && oilTax[p][3] !== 0){
                oilLine = '<span class="no_doplaty">Топливо '+oilTax[p][3]+' '+oilTax[p][4]+'</span>';
            }
        }
    }
//console.log(obj)
    var upline = visaLine + ' ' + oilLine;
    if(upline === ' ')upline = '<span class="no_doplaty">Нет информации</span>';
    var star = obj[8];
    star = star.slice(0,1);
    var Price = Math.ceil(obj[42]/(obj[16]+obj[17]));
    var checkInDate = obj[12];
    var outDay = parseInt(checkInDate.slice(0,2))+obj[14];
    var outMonth = parseInt(checkInDate.slice(3,5));
    var outYear = parseInt(checkInDate.slice(6));;
    var priceStr = obj.Price;
    var dayInMonth = 32 - new Date(outYear, outMonth, 32).getDate();
    if(outDay>dayInMonth){
        outDay = outDay - dayInMonth;
        outMonth++;
        if(outMonth === 13){
            outMonth = 1;
            outYear++;
            }
        }
    if(outDay<10){
        outDay = '0'+outDay;
    }
    if(outMonth<10){
        outMonth = '0'+outMonth;
    }
    var imgSrc = 'http://hotels.sletat.ru/i/p/'+obj[3]+'_0_210_190_1.jpg';
    if(obj[3] === 0)imgSrc = '/sletat/images/hotel1.png';
    var rate = Math.ceil(obj[35]);
    var line='';
    line='<div id="block-otel'+i+'" class="block_otel position clearfix">';
    line+= '<div class="block_title clearfix">';
    line+= '<div class="flag" style="background:url(\'http:\/\/static.sletat.ru\/images\/flags\/'+obj[30]+'.png\') no-repeat"></div>';
    line+= '<div class="name_country">'+obj[31]+'</div>';
    line+= '<div class="title_otel">'+obj[7]+' '+star+'</div>';
    line+= '<div class="zvezda"></div>';
    line+= '</div>';
    line+= '<div class="block_process clearfix position"><span>рейтинг отеля</span><div class="progress-bar proBar'+rate+'"><div class="process"></div></div>';
    line+= '<span class="num-process">'+rate+'</span></div><div class="clear"></div><div class="block_info position clearfix">';
    line+= '<div class="img_country_u" style="background:url('+imgSrc+')" class="img_country"></div>';
    line+= '<img class="imgCheck" src="'+imgSrc+'" id="img" onerror="onError(this)" style="display:none" />';
    line+= '<table class="table_info">';
    line+= '<tr><td class="bold">Вылет:</td><td>'+checkInDate+'</td></tr>';
    line+= '<tr><td class="bold">Обратно:</td><td>'+outDay+'.'+outMonth+'.'+outYear+'</td></tr>';
    line+= '<tr><td class="bold">Кол-во ночей:</td><td>'+obj[14]+'</td></tr>';
    line+= '<tr><td class="bold arr_n">Номер:</td><td>'+obj[53]+' <span>('+obj[37]+')</span></td></tr>';
    line+= '<tr><td class="bold">Питание:</td><td>'+obj[10]+' <span>('+obj[36]+')</span></td></tr>';
    line+= '</table>';
    line+= '<div class="block_price position">';
    line+= '<div class="price"><span class="price_tur">Цена за человека:</span><span class="price_">'+Price.toString().slice(0,-3)+' '+Price.toString().slice(-3)+' руб.</span></div>';
    line+= '<div class="blokc_doplaty"><span class="doplaty">доплаты:</span>'+upline+'</div>';
    line+= '<a href="/goryashchie-tury/tour-card.php?requestId='+requestId+'&sourceId='+obj[1]+'&offerId='+obj[0]+'&pCount='+peopleCount+'&hid='+obj[3]+'" target="_blank"><input type="image" class="button2" src="/sletat/images/button2.png"></a></div></div></div>';
    $('#content_otel').append(line);
}

function onError(image){
    $(image).prev().css('background','url(/sletat/images/hotel1.png)');
}

function declOfNum(number, titles){  
    cases = [2, 0, 1, 1, 1, 2];  
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}

function pagRedraw(){
    var currentPage = parseInt($('.currentPage').text());
    if(currentPage > 5 && currentPage < totalPage-4){
        var line= '<a href="#">1</a>';
        line+= ' ... ';
        var maxPage = currentPage + 3;
        var i = currentPage-3;
        for (i;i<maxPage;i++){
            if(i === currentPage){
                line+= '<a href="#" class="currentPage">'+i+'</a>';
            }else{
                line+= '<a href="#">'+i+'</a>';
            }
        }
        line+= ' ... ';
        line+= '<a href="#">'+totalPage+'</a>';
        $('div.num_paginator').empty();
        $('div.num_paginator').append(line);
    }else if(currentPage < 5 && currentPage < totalPage-4){
        var maxPage = currentPage + 5;
        line = '';
        var i = 1;
        for (i;i<maxPage;i++){
            if(i === currentPage){
                line+= '<a href="#" class="currentPage">'+i+'</a>';
            }else{
                line+= '<a href="#">'+i+'</a>';
            }
        }
        line+= ' ... ';
        line+= '<a href="#">'+totalPage+'</a>';
        $('div.num_paginator').empty();
        $('div.num_paginator').append(line);
    }else if(currentPage > 5 && currentPage > totalPage-5){
        var line= '<a href="#">1</a>';
        line+= ' ... ';
        var maxPage = totalPage;
        var i = currentPage-6;
        for (i;i<=maxPage;i++){
            if(i === currentPage){
                line+= '<a href="#" class="currentPage">'+i+'</a>';
            }else{
                line+= '<a href="#">'+i+'</a>';
            }
        }
        $('div.num_paginator').empty();
        $('div.num_paginator').append(line);
    }else{
        return false;
    }
}

function getNextWeek(data)
{
   data = data.split('/');
   data = new Date(data[2], +data[1]-1, +data[0], 168, 0, 0, 0);
   data = [data.getDate(),data.getMonth()+1,data.getFullYear()];
   data = data.join('/').replace(/(^|\/)(\d)(?=\/)/g,"$10$2");
   return data
}


$(document).ready(function(){
$('body').on('click', '.num_paginator a', function(e) {
    var clickPage = parseInt($(this).text());
    $('.num_paginator .currentPage').removeClass('currentPage');
    $('#content_otel').empty();
    data.pageNumber = clickPage;
    GetRequestResult();
    $(this).addClass('currentPage');
});

$('body').on('click', 'a.next', function(e) {
    var a = $('.num_paginator .currentPage');
    var clickPage = parseInt(a.text())+1;
    var lastPage = parseInt($('div.num_paginator a:last').text());
    if(clickPage-1 !== lastPage){
        a.next().addClass('currentPage');
        a.removeClass('currentPage');
    }else{
        return false;
    }
    $('#content_otel').empty();
    data.pageNumber = clickPage;
    GetRequestResult();
});

$('body').on('click', 'a.prev', function(e) {
    var a = $('.num_paginator .currentPage');
    var clickPage = parseInt(a.text());
    var firstPage = parseInt($('div.num_paginator a:first').text());
    if(clickPage !== firstPage){
        a.prev().addClass('currentPage');
        a.removeClass('currentPage');
    }else{
        return false;
    }
    $('#content_otel').empty();
    data.pageNumber = clickPage-1;
    GetRequestResult();
});


    GetDepartCities();
});