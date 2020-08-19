<div class="kt-widget24">
    <div class="kt-widget24__details">
        <div class="kt-widget24__info">
            <h4 class="kt-widget24__title">
                {{$title}}
            </h4>
            <span class="kt-widget24__desc">{{$description}}</span>
        </div>
        <span class="kt-widget24__stats kt-font-{{$type}}">{{$value}}</span>
    </div>
    <div class="progress progress--sm">
        <div class="progress-bar kt-bg-{{$type}}" role="progressbar" style="width: {{$percent}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>
