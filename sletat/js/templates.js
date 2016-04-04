var form = '<form class="templateForm" method="post">';
    form += '<select id="townFrom" onchange="GetCountries();" name="townFrom"></select>';
        form += '<hr>';
        form += '<select id="country" onchange="GetCities();GetHotelStars();" name="countryId"></select>';
        form += '<hr>';
            form += '<select id="cities" name="cities"><option value="---">---</option></select>';
            form += '<hr>';
            form += 'Количество ночей от:<input name="nightsMin" type="text" value="7"> до: <input name="nightsMax" type="text" value="14">';
            form += '<hr>';
            form += '<div><input type="radio" name="rangeType" checked="checked" value="nextDate">Показывать на следующие <input type="text" name="nextDate" value="7"> дней<br></div>';
            form += '<div><input type="radio" name="rangeType" value="rangeDate">Диапазон дат от: <input type="text" name="dateRange[0]" class="datepicker date1" value="" /> до:<input type="text" name="dateRange[1]" class="datepicker date2" value="" /><br></div>';
            form += '<div><input type="radio" name="rangeType" value="rangeToday">Показывать на <input type="text" name="rangeToday1" value="7"> - <input type="text" value="14" name="rangeToday2"> дней от текущей даты</div>';
            form += '<hr>';
            form += '<div id="hotelStars"></div>';
            form += '<hr>';
            form += '<div id="meals">';
                form += '<input type="checkbox" name="meals[0]" checked="checked" value="115"><label>AI</label>';
                form += '<input type="checkbox" name="meals[1]" checked="checked" value="114"><label>BB</label>';
                form += '<input type="checkbox" name="meals[2]" checked="checked" value="112"><label>FB</label>';
                form += '<input type="checkbox" name="meals[3]" checked="checked" value="121"><label>FB+</label>';
                form += '<input type="checkbox" name="meals[4]" checked="checked" value="113"><label>HB</label>';
                form += '<input type="checkbox" name="meals[5]" checked="checked" value="122"><label>HB+</label>';
                form += '<input type="checkbox" name="meals[6]" checked="checked" value="117"><label>RO</label>';
                form += '<input type="checkbox" name="meals[7]" checked="checked" value="116"><label>UAI</label>';
            form += '</div>';
            form += '<hr>';
            form += '<input type="checkbox" checked="checked" name="hotelStop" value="true"><label>отель не в стопе</label>';
            form += '<input type="checkbox" checked="checked" name="ticketsInclud" value="true"><label>билеты включены (с перелетом)</label>';
            form += '<input type="checkbox" checked="checked" name="hasTickets" value="true"><label>есть билеты</label>';
            form += '<hr>';
            form += 'Максимальная цена тура:<input type="text" name="maxPrice"><br>';
            form += 'Снижение цены:<input type="text" name="discount"> %';
            form += '<hr>';
            form += '<input type="hidden" name="countryName" id="cName" value="">';
            form += '<input type="hidden" name="townName" id="tName" value="">';
            form += '<input type="hidden" name="citiesName" id="rName" value="">';
            form += '<div class="submit">';
            form += '<input type="submit" value="Включить шаблон" onclick="changeState(true);">';
            form += '<input type="submit" value="Отключить шаблон" onclick="changeState(false);">';
            form += '<input type="submit" value="Сохранить шаблон" onclick="saveTemplate();">';
            form += '</div></form>';

var ajaxUri = '/sletat/';

function changeState(check){
    if(check){
        var state = 'enable';
    }else{
        state = 'disabled';
    }
    var uri = ajaxUri+"core/changeState.php";
    $('form.templateForm').submit(false);
    $.ajax({
                type: "POST",
                url: uri,
                data: {state: state, id: tplId},
                success: function(html) {
                    console.log(html)
                }
        });
}

function saveTemplate(){
    $('#cName').val($('#country :selected').text());
    $('#rName').val($('#cities :selected').text());
    $('#tName').val($('#townFrom :selected').text());
    var data = $('form.templateForm').serialize();
    var input = $('.submit input');
    $('.submit').html('<p class="loading">Шаблон сохраняется</p>');
    var uri = ajaxUri+"core/addTemplate.php";
     if(checkAdd){
        data += '&id='+tplId;
        uri = ajaxUri+"core/editTemplate.php";
    }
    $.ajax({
                type: "POST",
                url: uri,
                data: data+'&citiName='+$('#cities :selected').text(),
                success: function(e) {
                    console.log(e)
                setTimeout(function(){$('.submit').html(input);}, 3000);
                }
        });
        $('form.templateForm').submit(false);
        if(checkAdd){
            $('form.templateForm').parent().prev().find('span.desten').text($('#townFrom :selected').text()+'-->'+$('#country :selected').text());
        }else{
            $('#loadTemplates').empty();
            $.ajax({
                type: "POST",
                url: ajaxUri+"core/selectTemplate.php",
                success: function(html) {
                    $('#loadTemplates').append(html);
                }
        });
    }
}

function setTemplateProp(){
    $("input").prop('checked',false);
    if(templateObject['hotelStop'])$("[name='hotelStop']").prop('checked',true);
    if(templateObject['ticketsInclud'])$("[name='ticketsInclud']").prop('checked',true);
    if(templateObject['hasTickets'])$("[name='hasTickets']").prop('checked',true);
    
    var stars = templateObject['starsId'].split(',');
    var starsLength = stars.length;
    for(var i=0;i<starsLength;i++){
        $("#hotelStars input[value='"+stars[i]+"']").prop('checked',true);
    }
    if(templateObject['mealsId']===''){
        $("#meals input").prop('checked',true);
    }else{
        var meals = templateObject['mealsId'].split(',');
        var mealsLength = meals.length;
        for(var i=0;i<mealsLength;i++){
            $("#meals input[value='"+meals[i]+"']").prop('checked',true);
        }
    }
    if(templateObject['maxTourPrice']!=='0')$("input[name='maxPrice']").val(templateObject['maxTourPrice']);
    if(templateObject['discount']!=='0')$("input[name='discount']").val(templateObject['discount']);
    $("input[name='rangeType'][value='"+templateObject['dataRangeType']+"']").prop('checked',true);
    $("input[name='nightsMin']").val(templateObject['minNight']);
    $("input[name='nightsMax']").val(templateObject['maxNight']);
    if(templateObject['dataRangeType']==='nextDate'){
       $("input[name='rangeType']:checked").next().val(templateObject['dataRangeMax']) ;
    }else{
        $("input[name='rangeType']:checked").next().val(templateObject['dataRangeMin']).next().val(templateObject['dataRangeMax']);
    }
}

function GetHotelStars(){
   countryId = $('#country').val();
        $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: {auth:false, method:'GetHotelStars', countryId: countryId},
                success: function(html) {
                    var obj = JSON.parse(html);
                    obj = obj.GetHotelStarsResult.Data;
                    var line = "";
                    for (var p in obj){
                        line += '<input type="checkbox" checked="checked" name="star['+p+']" value="'+obj[p].Id+'"><label>'+obj[p].Name+'</label>';
                    }
                    $('#hotelStars').empty();
                    $('#hotelStars').append(line);
                    if(checkAdd)setTemplateProp();
                }
        });
}

function GetCities(cng){
   countryId = $('#country').val();
        $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: {auth:false, method:'GetCities', countryId: countryId},
                success: function(html) {
                    var obj = JSON.parse(html);
                    obj = obj.GetCitiesResult.Data;
                    var line = "<option value='---'>---</option>";
                    for (var p in obj){
                        line += '<option value="'+obj[p].Id+'">'+obj[p].Name+'</option>';
                    }
                    $('#cities').empty();
                    $('#cities').append(line);
                    GetHotelStars();
                    //if(cng)$("select option[value="+templateObject['citiesId']+"]").attr('selected', 'true');
                    if(cng)$("select option[value="+cng+"]").attr('selected', 'true');
                }
        });
}

function GetCountries(idCountry){
    townFromId = $('#townFrom').val();
       $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: {auth:false, method:'GetCountries', townFromId: townFromId},
                success: function(html) {
                    var obj = JSON.parse(html);
                    obj = obj.GetCountriesResult.Data;
                    var line = "";
                    for (var p in obj){
                        line += '<option value="'+obj[p].Id+'">'+obj[p].Name+'</option>';
                    }
                    $('#country').empty();
                    $('#country').append(line);
                    if(idCountry)$("select option[value="+idCountry+"]").attr('selected', 'true');
                    GetCities(true);
                    
                }
        });
}

function addDate(){
    var date = new Date();
    var nextMonth = date.getMonth()+2;
    var thisYear = date.getFullYear();
    if(nextMonth===13){
        nextMonth=1;
        ++thisYear;
    }
    if(nextMonth<10)nextMonth = '0'+nextMonth;
    var daysInNextMonth = 32 - new Date(date.getFullYear(), date.getMonth()+1, 32).getDate();
    var date1 = '01.'+nextMonth+'.'+thisYear;
    var date2 = daysInNextMonth+'.'+nextMonth+'.'+thisYear;
    $('.date1').val(date1);
    $('.date2').val(date2);
}
function GetDepartCities(idTown,idCountry){
       $.ajax({
                type: "POST",
                url: ajaxUri+"core/core.php",
                data: {auth:false, method:'GetDepartCities'},
                success: function(html) {
                    var obj = JSON.parse(html);
                    obj = obj.GetDepartCitiesResult.Data;
                    var line = "";
                    for (var p in obj){
                        line += '<option value="'+obj[p].Id+'">'+obj[p].Name+'</option>';
                    }
                    $('#townFrom').append(line);
                    if(idTown)$("select option[value="+idTown+"]").attr('selected', 'true');
                    GetCountries(idCountry);
                    addDate();
                }
        });
}

function datePic(){
  $('.datepicker').datepicker({
        dateFormat:'dd.mm.yy',
  	rangeSelect: true,
  	yearRange: '2000:2020',
  	firstDay: 1,
        showOn:'focus',
        showOtherMonths: true
  });
}

$(document).ready(function(){
checkAdd = false;
$('#createTemplate').append(form);
datePic();
GetDepartCities();

$('body').on('click', '#createTemplate.hideAdd', function(e) {
        $('.oneRow form').detach();
        $('#createTemplate').empty().append(form).removeClass('hideAdd');
        checkAdd = false;
        datePic();
        GetDepartCities();
});
$('body').on('click', '.deleteTemplate', function(e) {
    tplId = $(this).prev().find('.templateId').text();
    if(confirm('Вы действительно хотите удалить шаблон №'+tplId+' ?')){
    var _this = $(this);
    _this.prev().detach();
    _this.next().detach();
    _this.detach();
    $.ajax({
                type: "POST",
                url: ajaxUri+"core/deleteTemplate.php",
                data: {id: tplId},
                success: function(obj) {

                }
        });
    }
});

$('body').on('click', '.templatesRow', function(e) {
    $('#createTemplate').html('<p class="addTpl">Добавить шаблон</p>').addClass('hideAdd');
    $('.oneRow form').detach();
    $(this).addClass('showForm').next().next().append(form);
    tplId = $(this).find('.templateId').text();
    checkAdd = true;
    datePic();
    $.ajax({
                type: "POST",
                url: ajaxUri+"core/oneTemplate.php",
                data: {id: tplId},
                success: function(obj) {
                    templateObject = JSON.parse(obj);
                    GetDepartCities(templateObject[1],templateObject[3]);
                }
        });
});

        $.ajax({
                type: "POST",
                url: ajaxUri+"core/selectTemplate.php",
                success: function(html) {
                    $('#loadTemplates').append(html);
                }
        });

});
