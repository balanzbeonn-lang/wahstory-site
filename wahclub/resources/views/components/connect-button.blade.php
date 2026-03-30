<div class="designation connect-btns">
    <a href="/wahclub/{{ $user->slug_username }}" class="btn tj-btn-primary">Visit Profile</a>

    <!-- Render the connect button HTML dynamically -->
    {!! $component->getButtonHtml() !!}
</div>
