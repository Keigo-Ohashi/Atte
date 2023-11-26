<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
  @yield('title')
</head>

<body>
  <header class="header">

    <div class="header__logo">
      <a href="/">Atte</a>
    </div>

    @if (Auth::check())
      <nav>

        <ul class="header-nav">

          <li class="header-nav__item">
            <a class="header-nav__link" href="/">ホーム</a>
          </li>

          <li class="header-nav__item">
            <a class="header-nav__link" href="/attendance">日付一覧</a>
          </li>

          <li class="header-nav__item">
            <form class="logout-form" method="post" action="/logout">
              @csrf
              <button class="header-nav__button">ログアウト</button>
            </form>
          </li>

        </ul>

      </nav>
    @endif

  </header>

  <main class="main">
    @yield('main')
  </main>

  <footer class="footer">
    <div class="footer__inner">
      <small class="credit">Atte, inc.</small>
    </div>
  </footer>
</body>

</html>
