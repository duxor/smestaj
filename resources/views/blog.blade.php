@foreach ($posts as $post)
                                <article>
                                    <h2>{{ $post->created_at }}</h2>
                                    {{ $post->naslov }}
                                </article>
                            @endforeach

                            {!! $posts->render() !!}