<div class="blockForecast">
    <div class="main_icon">
        <ul class="list-unstyled">
            <li class="basecloud"></li>
            <li class="icon-drizzle icon-sunny"></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-10 temp_today">
            @if($forecast->var[1]->data->forecast[0]->attributes()->value > 0) + @endif
            {{ $forecast->var[1]->data->forecast[0]->attributes()->value }}<sup>o</sup>
        </div>
        <div class="col-xs-14 forecast-desc">
            <strong><?$explode = explode(' ', $forecast->attributes()->city); echo $explode['0']?></strong><br/>
            <small>{{ \Carbon\Carbon::now()->day }} апреля, {{ $forecast->var[4]->data->forecast[0]->attributes()->value }}</small>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-24">
            <table class="table">
                <tr>
                    <td>{{ \Carbon\Carbon::now()->addDay(1)->day }} апреля, {{ $forecast->var[4]->data->forecast[1]->attributes()->value }}</td>
                    <td class="temp">
                        @if($forecast->var[1]->data->forecast[1]->attributes()->value > 0) +@endif
                        {{ $forecast->var[1]->data->forecast[1]->attributes()->value }}<sup>o</sup>
                    </td>
                    <td><i class="icon-sun"></i></td>
                </tr>
                <tr>
                    <td>{{ \Carbon\Carbon::now()->addDay(2)->day }} апреля, {{ $forecast->var[4]->data->forecast[2]->attributes()->value }}</td>
                    <td class="temp">
                        @if($forecast->var[1]->data->forecast[2]->attributes()->value > 0) +@endif
                        {{ $forecast->var[1]->data->forecast[2]->attributes()->value }}<sup>o</sup>
                    </td>
                    <td><i class="icon-sun"></i></td>
                </tr><tr>
                    <td>{{ \Carbon\Carbon::now()->addDay(3)->day }} апреля, {{ $forecast->var[4]->data->forecast[3]->attributes()->value }}</td>
                    <td class="temp">
                        @if($forecast->var[1]->data->forecast[2]->attributes()->value > 0) +@endif
                        {{ $forecast->var[1]->data->forecast[2]->attributes()->value }}<sup>o</sup>
                    </td>
                    <td><i class="icon-sun"></i></td>
                </tr>
            </table>
        </div>
    </div>
</div>