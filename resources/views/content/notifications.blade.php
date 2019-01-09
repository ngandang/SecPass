@foreach(Auth::user()->Notifications as $notification)
<a href="{{ $notification->data['url'] }}" class="m-list-timeline__item">
  @if($notification->read_at != null)
  <span class="m-list-timeline__badge"></span>
  @else
  <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
  @endif
  <input type="hidden" name=id value="{{ $notification->id }}">
  <span class="m-list-timeline__text">
    {{ $notification->data['data'] }}
  </span>
  <br>
  <span class="m-list-timeline__time">
    {{ $notification->created_at->diffForHumans() }}
  </span>
</a>
@endforeach
