
@foreach($category as $item)
    <table>
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
        </tr>
    </table>
@endforeach

<hr>

@foreach($post as $article)
    <table>
        <tr>
            <td>{{$article->id}} : </td>
            <td>{{$article->text}}</td>
        </tr>
    </table>
@endforeach

<hr>

@auth
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endauth

