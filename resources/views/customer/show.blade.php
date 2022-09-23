<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif
    <h1>顧客詳細画面</h1>
    <table border="3">
        <tr>
            <th>顧客ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>郵便番号</th>
            <th>住所</th>
            <th>電話番号</th>
        </tr>
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->post_code }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->tel }}</td>
        </tr>
    </table>
    <div>
        <button type="button" onclick="location.href='{{ route('customers.edit', $customer->id) }}' ">編集画面</button>
    </div>
    <button type="submit" form="delete-form" onclick="if(!confirm('本当に削除していいですか？')){return false};">削除する</button>
    <form action="{{ route('customers.destroy', $customer->id) }}" method="post" id="delete-form">
        @csrf
        @method('DELETE')
    </form>
    <div>
        <button type="button" onclick="location.href='{{ route('customers.index') }}' ">一覧に戻る</button>
    </div>
</body>

</html>
