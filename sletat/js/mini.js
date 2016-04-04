$(document).ready(function(){
    sletat.GetDictionaries();
});

sletat = new Object;
sletat.depart = '#departTownId'; //Id селекта города вылета
sletat.defaultDptCity = '832'; //Id города вылета по умолчанию
sletat.country = '#countryId'; //Id селекта направления
sletat.defaultCountry = '113'; //Id страны по умолчанию
sletat.proxy = '/sletat/core/core.php'; //Адрес основного прокси

sletat.GetCountries = function(){
    var thisCountry = $(sletat.country);
    var thisDptCity = $(sletat.depart);
    var selectedCountry = $(sletat.country).val();
    if(selectedCountry === null)selectedCountry = sletat.defaultCountry;
        $.ajax({
                type: "POST",
                url: sletat.proxy,
                data: {auth: false, method: 'GetCountries', townFromId: thisDptCity.val()},
                success: function(Obj) {
                        var result = JSON.parse(Obj);
                        result = result.GetCountriesResult.Data;
                        var line = '';
                        for (var p in result){
                            line+='<option value="'+result[p].Id+'">'+result[p].Name+'</option>';
                        }
                        thisCountry.empty();
                        thisCountry.append(line);
                        thisCountry.find('[value="'+selectedCountry+'"]').prop('selected','selected');
                        }
                });
        };
        
sletat.GetDictionaries = function(){
        $.ajax({
                type: "POST",
                url: sletat.proxy,
                data: {auth: false, method: 'GetDepartCities'},
                success: function(Obj) {
                        var result = JSON.parse(Obj);
                        result = result.GetDepartCitiesResult.Data;
                        var line = '';
                        for (var p in result){
                          line+='<option value="'+result[p].Id+'">'+result[p].Name+'</option>';
                        }
                        $(sletat.depart).empty();
                        $(sletat.depart).append(line);
                 $('#townFrom').append(line);
                 
                 $('#departTownId').prepend($('#departTownId option[value="1331"]'));
                 $('#departTownId').prepend($('#departTownId option[value="1293"]'));
                 $('#departTownId').prepend($('#departTownId option[value="832"]'));
                 $('#departTownId').prepend($('#departTownId option[value="1286"]'));
                 $('#departTownId option[value="1286"]').prop('selected', true);
                        
                        sletat.GetCountries();
                        }
                });
        };