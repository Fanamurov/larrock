function declOfNum(number, titles){  
    var cases = [2, 0, 1, 1, 1, 2];  
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}
function bestTours(id){
      $.getScript("/sletat/tours/"+id+".js", function(){
                  var tours = sletatTemplate.GetToursResult.Data.aaData;
                  var toursLenght = Object.keys(tours).length;
                  var tourCards = 6;
				  var s3 = 0;
                  if(toursLenght<tourCards)tourCards=toursLenght;
                  var line='';
					var i = 0;
                  var check = 0;
                  for (var p in tours){
					if(i === 0){
						line+='<div class="blocks-wrapper"><h2 class="bl-title"><span>Лучшие цены</span><a href="/goryashchie-tury/tour-search.php?sta=1&townFrom='+tours[p][32]+'&countryId='+tours[p][30]+'&resort='+tours[p][5]+'">Смотреть все</a></h2><div class="blocks-inner">';
						i++;
					}
                  var imgSrc = 'http://hotels.sletat.ru/i/p/'+tours[p][3]+'_0_145_215_1.jpg';
                  if(tours[p][3] === 0)continue;
                      if(check === 6)break;
                        var hotel = tours[p][7];
                        if(hotel.length > 32){
                            hotel = hotel.slice(0,30)+'...';
                        }
                      var nights = declOfNum(tours[p][14], ['ночь','ночи','ночей']); 
                      var s = tours[p][45];
					  if(s3<3 && s != 402)continue;
					  if(s3>=3 && (s == 402 || s == 401 || s == 400))continue;
                      if(s === 400){
                          var n = 1;
                      }else if(s === 401){
                          n = 2;
                      }else if(s === 402){
                          n = 3;
						  s3++;
                      }else if(s === 403 || s === 410){
                          n = 4;
                      }else if(s === 404 || s === 405 || s === 406 || s === 411){
                          n = 5;
                      }
                      line+='<div class="blockBest"><span><small>'+tours[p][19]+', '+tours[p][31]+'</span></small>';
                      line+='<div class="img"><a href="/goryashchie-tury/tour-card.php?requestId='+sletatTemplate.GetToursResult.Data.requestId+'&sourceId='+tours[p][1]+'&offerId='+tours[p][0]+'&pCount=2&hid='+tours[p][3]+'&discount='+id+'" target="_blank"><img style="width: 215px;" src="'+imgSrc+'" onerror="this.src=\'http://sletat.ru/module/styles/images/hotel.jpg\'" alt=""></a></div>';
                      line+='<p class="desc">с '+tours[p][12]+', на '+tours[p][14]+' '+nights+'</p>';
                      line+='<div class="hotel-name"><p class="name"><strong>'+hotel+'</strong></p><div class="stars">';
                      for (var i = 0;i<n;i++){
                         line+='<img src="/sletat/images/star.png" alt="">'; 
                      }
var price = Math.ceil((tours[p][42]/100)*sletatDiscount);
                      line+='</div></div><a href="/goryashchie-tury/tour-card.php?requestId='+sletatTemplate.GetToursResult.Data.requestId+'&sourceId='+tours[p][1]+'&offerId='+tours[p][0]+'&pCount=2&hid='+tours[p][3]+'&discount='+id+'" target="_blank"><p class="price">'+price+' р</p></a></div>';
                      check++;
                  };
                  line+='</div></div>';
                  $('#ToursHolder').append(line);
				
				  $('.blockBest').find('.price').each( function(){ 
				  $(this).text($(this).text().replace(/\B(?=(\d{3})+(?!\d))/g, " "))
				}); 
				  
    });    
};