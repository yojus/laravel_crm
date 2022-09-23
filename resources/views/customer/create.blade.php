<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>新規登録画面</h1>

    @if ($errors->any())
        <div class="error">
            <p>
                <b>{{ count($errors) }}件のエラーがあります。</b>
            </p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.store') }}" method="post">
        @csrf
        <p>
            <label for="name">名前</label>
            <input type="text" id="name" name="name">
            {{-- value="{{ old('name') }}" --}}
        </p>
        <p>
            <label for="email">メールアドレス</label>
            <input type="text" id="email" name="email">
            {{-- value="{{ old('email') }}" --}}
        </p>
        <p>
            <label for="post_code">郵便番号</label>
            <input type="text" id="post_code" name="post_code" value="{{ old('post_code', $post_code) }}">
        </p>
        <p>
            <label for="address">住所</label>
            <textarea name="address" id="address" cols="20" rows="2">{{ old('address', $address) }}</textarea>
        </p>
        <p>
            <label for="tel">電話番号</label>
            <input type="text" id="tel" name="tel">
            {{-- value="{{ old('tel') }}" --}}
        </p>

        <input type="submit" value="登録">
    </form>
    <button type="button" onclick="location.href='/customers/search' ">郵便番号検索に戻る</button>
</body>

</html>
