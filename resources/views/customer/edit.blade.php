<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>編集画面</h1>

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

    <form action="{{ route('customers.update', $customer->id) }}" method="post">
        @csrf
        @method('PATCH')
        <p>
            <label for="name">名前</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}">
        </p>
        <p>
            <label for="email">メールアドレス</label>
            <input type="text" name="email" value="{{ old('email', $customer->email) }}">
        </p>
        <p>
            <label for="post_code">郵便番号</label>
            <input type="text" name="post_code" value="{{ old('post_code', $customer->post_code) }}">
        </p>
        <p>
            <label for="address">住所</label>
            <textarea name="address" id="address" cols="20" rows="2">{{ old('address', $customer->address) }}</textarea>
        </p>
        <p>
            <label for="tel">電話番号</label>
            <input type="text" name="tel" value="{{ old('tel', $customer->tel) }}">
        </p>

        <input type="submit" value="更新">
    </form>
    <button type="button" onclick="location.href='{{ route('customers.show', $customer->id) }}' ">戻る</button>
</body>

</html>
