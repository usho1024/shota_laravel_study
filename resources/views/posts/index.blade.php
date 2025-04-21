@foreach($posts as $post)
    <div>title : {{ $post->title }}</div>
    <div>content : {{ $post->content }}</div>
@endforeach