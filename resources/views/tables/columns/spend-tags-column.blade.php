<div>

        @foreach($getState() as $state)
            <span
                class="
                    inline-flex items-center justify-center min-h-6 px-2 py-0.5 text-sm font-medium
                    tracking-tight rounded-xl text-white whitespace-normal
                "
                style="background: {{$state->color}}  ; "
            >
                {{$state->name}}
            </span>
        @endforeach
</div>
